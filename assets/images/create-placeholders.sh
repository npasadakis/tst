#!/bin/bash
# Script to create placeholder SVG images for the website
# Replace these with actual photos before going live

# Function to create a placeholder SVG
create_placeholder() {
    local filename=$1
    local width=$2
    local height=$3
    local text=$4
    local color=${5:-"#0077b6"}

    cat > "$filename" << EOF
<svg width="$width" height="$height" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="grad_$RANDOM" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:$color;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#00b4d8;stop-opacity:0.8" />
    </linearGradient>
  </defs>
  <rect width="$width" height="$height" fill="url(#grad_$RANDOM)"/>
  <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="24" fill="white" text-anchor="middle" dominant-baseline="middle">$text</text>
  <!-- Decorative elements -->
  <circle cx="$((width/4))" cy="$((height/4))" r="40" fill="white" opacity="0.1"/>
  <circle cx="$((width*3/4))" cy="$((height*3/4))" r="60" fill="white" opacity="0.1"/>
  <path d="M 0 $((height/2)) Q $((width/4)) $((height/2-30)) $((width/2)) $((height/2)) T $width $((height/2))" stroke="white" stroke-width="2" fill="none" opacity="0.2"/>
</svg>
EOF
}

echo "Creating placeholder images..."

# Gallery images
for i in {1..12}; do
    create_placeholder "gallery/gallery-$i.svg" 1200 900 "Gallery Image $i" "#0077b6"
done

# Private sailing images
for i in {1..6}; do
    create_placeholder "trips/private-sailing-$i.svg" 800 600 "Private Sailing $i" "#023e8a"
done

# Full day trip images
for i in {1..6}; do
    create_placeholder "trips/full-day-$i.svg" 800 600 "Full Day Trip $i" "#0077b6"
done

# Half day trip images
for i in {1..6}; do
    create_placeholder "trips/half-day-$i.svg" 800 600 "Half Day Trip $i" "#00b4d8"
done

# Featured images
create_placeholder "hero-bg.svg" 1920 1080 "Hero Background" "#023e8a"
create_placeholder "dia-island.svg" 1920 1080 "Dia Island" "#0077b6"
create_placeholder "sailing-sunset.svg" 1920 1080 "Sailing at Sunset" "#ca6702"
create_placeholder "heraklion-port.svg" 1920 1080 "Heraklion Port" "#00b4d8"

echo "Placeholder images created successfully!"
echo "Replace these with actual photos before launching the website."
