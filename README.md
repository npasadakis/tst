# Location Logger

An Android app that logs the device's GPS location at configurable intervals.

## Features

- **Background Location Tracking**: Uses a foreground service to reliably track location even when the app is in the background
- **Configurable Interval**: Set the location update interval (default: 30 seconds)
- **Location Logging**: Saves location data (latitude, longitude, accuracy, timestamp) to a log file
- **Simple UI**: Start/stop tracking, view logs, and configure settings

## Requirements

- Android 8.0 (API 26) or higher
- Location permissions (fine and background location)
- Google Play Services

## Permissions

The app requires the following permissions:
- `ACCESS_FINE_LOCATION` - For precise GPS location
- `ACCESS_COARSE_LOCATION` - For approximate location
- `ACCESS_BACKGROUND_LOCATION` - For tracking when app is in background
- `FOREGROUND_SERVICE` - For running the location service
- `POST_NOTIFICATIONS` - For showing the tracking notification (Android 13+)

## Log File Location

Location data is saved to:
```
/Android/data/com.example.locationlogger/files/location_log.txt
```

Log format:
```
2024-01-15 10:30:45 | Lat: 37.7749, Lng: -122.4194, Accuracy: 15.0m
```

## Building

1. Open the project in Android Studio
2. Sync Gradle files
3. Build and run on a device or emulator

## Usage

1. Launch the app
2. Grant location permissions when prompted
3. Set the desired tracking interval (in seconds)
4. Tap "Start" to begin tracking
5. The app will show a notification while tracking
6. Tap "Stop" to end tracking
7. Use "View Log" to see recorded locations
