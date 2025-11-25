# Video Assets for Sailing Website

## Required Video

### sailing-hero.mp4
Main hero video for the homepage hero section.

**Specifications:**
- Resolution: 1920x1080 (Full HD)
- Duration: 20-40 seconds (short loop recommended)
- Format: MP4 (H.264 codec)
- Audio: Optional (muted on autoplay)
- File size: <10MB (optimized for web)
- Frame rate: 30fps
- Bitrate: 3-5 Mbps

**Content suggestions:**
- Sailing boat on open sea
- Views of Dia Island
- Sunset sailing
- Crystal blue waters of Crete
- Aerial/drone footage of the boat
- Heraklion coastline

## How to Optimize Your Video

### Using FFmpeg (recommended)
```bash
# Basic compression
ffmpeg -i input.mp4 -vcodec h264 -acodec aac -b:v 3M -maxrate 3M -bufsize 6M sailing-hero.mp4

# Remove audio (for autoplay)
ffmpeg -i input.mp4 -vcodec h264 -an -b:v 3M sailing-hero.mp4

# Create web-optimized version
ffmpeg -i input.mp4 -vcodec h264 -movflags +faststart -b:v 3M sailing-hero.mp4
```

### Using HandBrake
1. Open your video in HandBrake
2. Select "Fast 1080p30" preset
3. Set video quality to RF 23-25
4. Enable "Web Optimized"
5. Remove audio track if not needed
6. Save as sailing-hero.mp4

## Poster Image

Create a poster image (first frame or best frame) for the video:
- Name it: `sailing-hero-poster.jpg`
- Resolution: 1920x1080
- File size: <200KB

This will show before the video loads.

## Alternative: Use Stock Video

If you don't have original footage, you can use stock videos:

**Free sources:**
- Pexels Videos (pexels.com/videos)
- Pixabay Videos (pixabay.com/videos)
- Videvo (videvo.net)

**Search terms:**
- sailing yacht mediterranean
- greece sailing
- crete coastline
- blue ocean sailing
- yacht sunset

## Fallback

The website has an animated gradient fallback that displays if:
- Video file is not found
- Video fails to load
- User has data saver mode enabled

No action needed - this is automatic.

## Copyright

Ensure your video:
- Is owned by you or properly licensed
- Credits videographer if required
- Has appropriate permissions for commercial use
