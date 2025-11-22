package com.example.locationlogger

import android.Manifest
import android.content.BroadcastReceiver
import android.content.ComponentName
import android.content.Context
import android.content.Intent
import android.content.IntentFilter
import android.content.ServiceConnection
import android.content.pm.PackageManager
import android.net.Uri
import android.os.Build
import android.os.Bundle
import android.os.IBinder
import android.provider.Settings
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import com.example.locationlogger.databinding.ActivityMainBinding
import java.io.File

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private var locationService: LocationService? = null
    private var serviceBound = false
    private var intervalSeconds = 30L

    private val serviceConnection = object : ServiceConnection {
        override fun onServiceConnected(name: ComponentName?, service: IBinder?) {
            val binder = service as LocationService.LocalBinder
            locationService = binder.getService()
            serviceBound = true
            updateUI()
        }

        override fun onServiceDisconnected(name: ComponentName?) {
            locationService = null
            serviceBound = false
            updateUI()
        }
    }

    private val locationReceiver = object : BroadcastReceiver() {
        override fun onReceive(context: Context?, intent: Intent?) {
            intent?.let {
                val lat = it.getDoubleExtra("latitude", 0.0)
                val lng = it.getDoubleExtra("longitude", 0.0)
                val accuracy = it.getFloatExtra("accuracy", 0f)
                val timestamp = it.getStringExtra("timestamp") ?: ""

                binding.tvLastLocation.text = "Last: $lat, $lng\nAccuracy: ${accuracy}m\n$timestamp"
            }
        }
    }

    private val locationPermissionLauncher = registerForActivityResult(
        ActivityResultContracts.RequestMultiplePermissions()
    ) { permissions ->
        val fineLocationGranted = permissions[Manifest.permission.ACCESS_FINE_LOCATION] == true
        val coarseLocationGranted = permissions[Manifest.permission.ACCESS_COARSE_LOCATION] == true

        if (fineLocationGranted || coarseLocationGranted) {
            checkBackgroundLocationPermission()
        } else {
            Toast.makeText(this, "Location permission is required", Toast.LENGTH_LONG).show()
        }
    }

    private val backgroundLocationPermissionLauncher = registerForActivityResult(
        ActivityResultContracts.RequestPermission()
    ) { granted ->
        if (granted) {
            startLocationService()
        } else {
            showBackgroundPermissionDialog()
        }
    }

    private val notificationPermissionLauncher = registerForActivityResult(
        ActivityResultContracts.RequestPermission()
    ) { granted ->
        if (!granted) {
            Toast.makeText(this, "Notification permission denied", Toast.LENGTH_SHORT).show()
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setupUI()
        requestNotificationPermission()
    }

    private fun setupUI() {
        binding.etInterval.setText(intervalSeconds.toString())

        binding.btnStart.setOnClickListener {
            val inputInterval = binding.etInterval.text.toString().toLongOrNull()
            if (inputInterval != null && inputInterval >= 1) {
                intervalSeconds = inputInterval
                checkAndRequestPermissions()
            } else {
                Toast.makeText(this, "Please enter a valid interval (minimum 1 second)", Toast.LENGTH_SHORT).show()
            }
        }

        binding.btnStop.setOnClickListener {
            stopLocationService()
        }

        binding.btnViewLog.setOnClickListener {
            viewLogFile()
        }

        binding.btnClearLog.setOnClickListener {
            clearLogFile()
        }
    }

    private fun requestNotificationPermission() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.POST_NOTIFICATIONS)
                != PackageManager.PERMISSION_GRANTED) {
                notificationPermissionLauncher.launch(Manifest.permission.POST_NOTIFICATIONS)
            }
        }
    }

    private fun checkAndRequestPermissions() {
        when {
            hasLocationPermissions() -> {
                if (hasBackgroundLocationPermission()) {
                    startLocationService()
                } else {
                    checkBackgroundLocationPermission()
                }
            }
            else -> {
                locationPermissionLauncher.launch(
                    arrayOf(
                        Manifest.permission.ACCESS_FINE_LOCATION,
                        Manifest.permission.ACCESS_COARSE_LOCATION
                    )
                )
            }
        }
    }

    private fun hasLocationPermissions(): Boolean {
        return ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) ==
                PackageManager.PERMISSION_GRANTED ||
                ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) ==
                PackageManager.PERMISSION_GRANTED
    }

    private fun hasBackgroundLocationPermission(): Boolean {
        return if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
            ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_BACKGROUND_LOCATION) ==
                    PackageManager.PERMISSION_GRANTED
        } else {
            true
        }
    }

    private fun checkBackgroundLocationPermission() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
            if (!hasBackgroundLocationPermission()) {
                AlertDialog.Builder(this)
                    .setTitle("Background Location Required")
                    .setMessage("To track location when the app is in background, please grant 'Allow all the time' permission.")
                    .setPositiveButton("Grant") { _, _ ->
                        backgroundLocationPermissionLauncher.launch(Manifest.permission.ACCESS_BACKGROUND_LOCATION)
                    }
                    .setNegativeButton("Skip") { _, _ ->
                        startLocationService()
                    }
                    .show()
            } else {
                startLocationService()
            }
        } else {
            startLocationService()
        }
    }

    private fun showBackgroundPermissionDialog() {
        AlertDialog.Builder(this)
            .setTitle("Background Location")
            .setMessage("For continuous tracking, enable 'Allow all the time' in Settings. Continue with limited tracking?")
            .setPositiveButton("Open Settings") { _, _ ->
                val intent = Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS).apply {
                    data = Uri.fromParts("package", packageName, null)
                }
                startActivity(intent)
            }
            .setNegativeButton("Continue Anyway") { _, _ ->
                startLocationService()
            }
            .show()
    }

    private fun startLocationService() {
        val intent = Intent(this, LocationService::class.java).apply {
            action = LocationService.ACTION_START
            putExtra(LocationService.EXTRA_INTERVAL, intervalSeconds * 1000)
        }

        ContextCompat.startForegroundService(this, intent)
        bindService(intent, serviceConnection, Context.BIND_AUTO_CREATE)

        Toast.makeText(this, "Location tracking started", Toast.LENGTH_SHORT).show()
        updateUI()
    }

    private fun stopLocationService() {
        if (serviceBound) {
            unbindService(serviceConnection)
            serviceBound = false
        }

        val intent = Intent(this, LocationService::class.java).apply {
            action = LocationService.ACTION_STOP
        }
        startService(intent)

        locationService = null
        Toast.makeText(this, "Location tracking stopped", Toast.LENGTH_SHORT).show()
        updateUI()
    }

    private fun updateUI() {
        val isTracking = locationService?.isTracking() == true
        binding.btnStart.isEnabled = !isTracking
        binding.btnStop.isEnabled = isTracking
        binding.etInterval.isEnabled = !isTracking

        binding.tvStatus.text = if (isTracking) {
            "Status: Tracking (every ${intervalSeconds}s)"
        } else {
            "Status: Stopped"
        }
    }

    private fun viewLogFile() {
        val logFile = File(getExternalFilesDir(null), "location_log.txt")
        if (logFile.exists()) {
            val content = logFile.readText()
            if (content.isNotEmpty()) {
                AlertDialog.Builder(this)
                    .setTitle("Location Log")
                    .setMessage(content.takeLast(5000)) // Show last 5000 chars
                    .setPositiveButton("OK", null)
                    .show()
            } else {
                Toast.makeText(this, "Log file is empty", Toast.LENGTH_SHORT).show()
            }
        } else {
            Toast.makeText(this, "No log file found", Toast.LENGTH_SHORT).show()
        }
    }

    private fun clearLogFile() {
        val logFile = File(getExternalFilesDir(null), "location_log.txt")
        if (logFile.exists()) {
            logFile.delete()
            Toast.makeText(this, "Log cleared", Toast.LENGTH_SHORT).show()
        }
    }

    override fun onStart() {
        super.onStart()
        val filter = IntentFilter("com.example.locationlogger.LOCATION_UPDATE")
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            registerReceiver(locationReceiver, filter, Context.RECEIVER_NOT_EXPORTED)
        } else {
            registerReceiver(locationReceiver, filter)
        }

        // Try to bind to existing service
        val intent = Intent(this, LocationService::class.java)
        bindService(intent, serviceConnection, 0)
    }

    override fun onStop() {
        super.onStop()
        unregisterReceiver(locationReceiver)
        if (serviceBound) {
            unbindService(serviceConnection)
            serviceBound = false
        }
    }
}
