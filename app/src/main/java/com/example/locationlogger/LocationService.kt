package com.example.locationlogger

import android.app.Notification
import android.app.NotificationChannel
import android.app.NotificationManager
import android.app.PendingIntent
import android.app.Service
import android.content.Context
import android.content.Intent
import android.os.Binder
import android.os.Build
import android.os.IBinder
import android.os.Looper
import android.util.Log
import androidx.core.app.NotificationCompat
import com.google.android.gms.location.FusedLocationProviderClient
import com.google.android.gms.location.LocationCallback
import com.google.android.gms.location.LocationRequest
import com.google.android.gms.location.LocationResult
import com.google.android.gms.location.LocationServices
import com.google.android.gms.location.Priority
import java.io.File
import java.text.SimpleDateFormat
import java.util.Date
import java.util.Locale

class LocationService : Service() {

    companion object {
        private const val TAG = "LocationService"
        private const val NOTIFICATION_ID = 1001
        private const val CHANNEL_ID = "location_channel"
        const val DEFAULT_INTERVAL_MS = 30000L // 30 seconds default

        const val ACTION_START = "com.example.locationlogger.ACTION_START"
        const val ACTION_STOP = "com.example.locationlogger.ACTION_STOP"
        const val EXTRA_INTERVAL = "interval_ms"
    }

    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var locationCallback: LocationCallback
    private var intervalMs: Long = DEFAULT_INTERVAL_MS
    private var isTracking = false

    private val binder = LocalBinder()

    inner class LocalBinder : Binder() {
        fun getService(): LocationService = this@LocationService
    }

    override fun onCreate() {
        super.onCreate()
        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this)
        createNotificationChannel()
        setupLocationCallback()
    }

    override fun onBind(intent: Intent?): IBinder {
        return binder
    }

    override fun onStartCommand(intent: Intent?, flags: Int, startId: Int): Int {
        when (intent?.action) {
            ACTION_START -> {
                intervalMs = intent.getLongExtra(EXTRA_INTERVAL, DEFAULT_INTERVAL_MS)
                startLocationTracking()
            }
            ACTION_STOP -> {
                stopLocationTracking()
                stopSelf()
            }
        }
        return START_STICKY
    }

    private fun createNotificationChannel() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            val channel = NotificationChannel(
                CHANNEL_ID,
                "Location Tracking",
                NotificationManager.IMPORTANCE_LOW
            ).apply {
                description = "Shows when location is being tracked"
            }
            val notificationManager = getSystemService(NotificationManager::class.java)
            notificationManager.createNotificationChannel(channel)
        }
    }

    private fun createNotification(): Notification {
        val notificationIntent = Intent(this, MainActivity::class.java)
        val pendingIntent = PendingIntent.getActivity(
            this, 0, notificationIntent,
            PendingIntent.FLAG_UPDATE_CURRENT or PendingIntent.FLAG_IMMUTABLE
        )

        val stopIntent = Intent(this, LocationService::class.java).apply {
            action = ACTION_STOP
        }
        val stopPendingIntent = PendingIntent.getService(
            this, 0, stopIntent,
            PendingIntent.FLAG_UPDATE_CURRENT or PendingIntent.FLAG_IMMUTABLE
        )

        return NotificationCompat.Builder(this, CHANNEL_ID)
            .setContentTitle("Location Logger")
            .setContentText("Tracking location every ${intervalMs / 1000} seconds")
            .setSmallIcon(android.R.drawable.ic_menu_mylocation)
            .setContentIntent(pendingIntent)
            .addAction(android.R.drawable.ic_media_pause, "Stop", stopPendingIntent)
            .setOngoing(true)
            .build()
    }

    private fun setupLocationCallback() {
        locationCallback = object : LocationCallback() {
            override fun onLocationResult(locationResult: LocationResult) {
                locationResult.lastLocation?.let { location ->
                    logLocation(location.latitude, location.longitude, location.accuracy)
                }
            }
        }
    }

    private fun startLocationTracking() {
        if (isTracking) return

        try {
            val locationRequest = LocationRequest.Builder(Priority.PRIORITY_HIGH_ACCURACY, intervalMs)
                .setMinUpdateIntervalMillis(intervalMs / 2)
                .setWaitForAccurateLocation(false)
                .build()

            startForeground(NOTIFICATION_ID, createNotification())

            fusedLocationClient.requestLocationUpdates(
                locationRequest,
                locationCallback,
                Looper.getMainLooper()
            )

            isTracking = true
            Log.i(TAG, "Location tracking started with interval: ${intervalMs}ms")
        } catch (e: SecurityException) {
            Log.e(TAG, "Location permission not granted", e)
        }
    }

    private fun stopLocationTracking() {
        if (!isTracking) return

        fusedLocationClient.removeLocationUpdates(locationCallback)
        isTracking = false
        Log.i(TAG, "Location tracking stopped")
    }

    private fun logLocation(latitude: Double, longitude: Double, accuracy: Float) {
        val timestamp = SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault()).format(Date())
        val logEntry = "$timestamp | Lat: $latitude, Lng: $longitude, Accuracy: ${accuracy}m"

        // Log to Android logcat
        Log.i(TAG, logEntry)

        // Write to file
        writeToLogFile(logEntry)

        // Broadcast for UI updates
        val intent = Intent("com.example.locationlogger.LOCATION_UPDATE").apply {
            putExtra("latitude", latitude)
            putExtra("longitude", longitude)
            putExtra("accuracy", accuracy)
            putExtra("timestamp", timestamp)
        }
        sendBroadcast(intent)
    }

    private fun writeToLogFile(logEntry: String) {
        try {
            val logFile = File(getExternalFilesDir(null), "location_log.txt")
            logFile.appendText("$logEntry\n")
        } catch (e: Exception) {
            Log.e(TAG, "Error writing to log file", e)
        }
    }

    fun isTracking(): Boolean = isTracking

    fun getLogFile(): File? {
        return try {
            File(getExternalFilesDir(null), "location_log.txt")
        } catch (e: Exception) {
            null
        }
    }

    override fun onDestroy() {
        super.onDestroy()
        stopLocationTracking()
    }
}
