# Heraklion Sailing Adventures Website

A professional, responsive website for a sailing business based in Heraklion, Crete, offering sailing trips to Dia Island.

## Overview

This website showcases three types of sailing trips:
1. **Private Sailing Trip** - Charter a boat for one or more days
2. **Full Day Sailing Trip** - Morning to sunset trip to Dia Island
3. **Half Day Sailing Trip** - Morning or sunset trip to Dia Island

## Features

- **Responsive Design** - Works perfectly on desktop, tablet, and mobile devices
- **Hero Video Section** - Eye-catching video background on homepage
- **Image Galleries** - Beautiful photo galleries on all pages with modal viewer
- **Contact Form** - Functional contact form with validation
- **Modern UI/UX** - Clean, professional design with smooth animations
- **Mobile Navigation** - Hamburger menu for mobile devices
- **SEO Friendly** - Proper meta tags and semantic HTML

## Website Structure

```
.
├── index.html              # Homepage with hero video and trip overview
├── private-trip.html       # Private sailing trip details
├── full-day-trip.html      # Full day trip details
├── half-day-trip.html      # Half day trip details
├── contact.html            # Contact page with form
├── css/
│   └── styles.css         # All styling and responsive design
├── js/
│   └── script.js          # Interactive features and functionality
├── images/                # Image assets (placeholders included)
│   ├── logo-placeholder.svg
│   └── [various image placeholders]
├── videos/                # Video assets
│   └── sailing-hero.mp4  # Hero section video (placeholder)
├── ASSETS.md             # Guide for adding images and videos
└── README.md             # This file
```

## Pages

### Homepage (index.html)
- Hero section with video background
- Trip overview with three trip types
- "What's Included" section
- Photo gallery
- Call-to-action sections

### Private Trip Page (private-trip.html)
- Detailed information about private charters
- Flexible itinerary details
- Pricing information
- Booking sidebar
- Gallery specific to private trips

### Full Day Trip Page (full-day-trip.html)
- Complete itinerary from 9 AM to 8 PM
- Detailed schedule
- Pricing (from €120 per person)
- What's included and excluded
- Trip-specific gallery

### Half Day Trip Page (half-day-trip.html)
- Two options: Morning or Sunset
- Separate itineraries for each option
- Pricing (from €75 per person)
- Comparison of both options
- Gallery showcasing both trip types

### Contact Page (contact.html)
- Contact form with validation
- Company contact information
- FAQ section
- Map placeholder (ready for Google Maps integration)

## Technologies Used

- **HTML5** - Semantic markup
- **CSS3** - Modern styling with Flexbox and Grid
- **Vanilla JavaScript** - No dependencies, pure JS
- **SVG** - Scalable vector graphics for logo
- **Responsive Design** - Mobile-first approach

## Key Features Explained

### Responsive Navigation
- Desktop: Horizontal menu
- Mobile: Hamburger menu with smooth toggle
- Sticky navigation that follows scroll

### Gallery Modal
- Click any gallery image to open in full-screen modal
- Navigate between images with arrows or keyboard
- Close with X button, Escape key, or click outside
- Smooth animations and transitions

### Contact Form
- Client-side validation
- Required field checking
- Email format validation
- Success/error messages
- Form reset after submission
- Minimum date validation for booking dates

### Animations
- Fade-in animations on scroll
- Smooth hover effects on cards and buttons
- Image zoom effects in galleries
- Smooth scrolling for anchor links

## Setup Instructions

1. **Clone or download** this repository
2. **Add images and videos** - See ASSETS.md for detailed guide
3. **Open index.html** in a web browser to view the site
4. **Customize content** - Update text, prices, and contact information
5. **Deploy** - Upload to your web hosting service

## Customization Guide

### Updating Colors
Edit the CSS variables in `css/styles.css`:
```css
:root {
    --primary-color: #0077be;      /* Main brand color */
    --primary-dark: #005a91;       /* Darker shade */
    --secondary-color: #ffa500;    /* Accent color */
}
```

### Updating Contact Information
Search and replace in all HTML files:
- Email: `info@heraklionsailing.com`
- Phone: `+30 123 456 7890`
- Location: `Heraklion Port, Crete`

### Updating Prices
Edit the price sections in:
- `full-day-trip.html` (currently €120)
- `half-day-trip.html` (currently €75)
- `private-trip.html` (contact for pricing)

### Adding Real Images
1. See `ASSETS.md` for complete list of required images
2. Replace placeholder files with actual images
3. Keep the same filenames to maintain functionality
4. Optimize images for web (recommended: under 500KB each)

### Adding Google Maps
Replace the map placeholder in `contact.html` with:
```html
<iframe src="YOUR_GOOGLE_MAPS_EMBED_URL" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
```

### Connecting Contact Form
The contact form currently logs to console. To make it functional:
1. Set up a backend service (PHP, Node.js, etc.)
2. Or use a service like Formspree, EmailJS, or Netlify Forms
3. Update the form submission handler in `js/script.js`

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Optimization

- All CSS in a single file
- All JavaScript in a single file
- Lazy loading for images
- Optimized animations
- Minimal dependencies (no external libraries)

## Deployment Options

### Option 1: Traditional Web Hosting
1. Upload all files via FTP
2. Ensure directory structure is maintained
3. Set index.html as the default page

### Option 2: GitHub Pages
1. Push to a GitHub repository
2. Enable GitHub Pages in repository settings
3. Select the main branch as source

### Option 3: Netlify/Vercel
1. Connect your repository
2. Configure build settings (none needed for static site)
3. Deploy automatically on push

## Future Enhancements

Potential features to add:
- Online booking system integration
- Multiple language support (Greek/English)
- Customer reviews section
- Blog for sailing tips and updates
- Social media feed integration
- Real-time availability calendar
- Payment gateway integration
- Email newsletter signup
- Instagram photo feed

## Support

For questions or issues:
1. Check ASSETS.md for image/video guidelines
2. Review the code comments for implementation details
3. Test in multiple browsers and devices

## License

This website template is provided as-is for the sailing business.

## Credits

- Design and Development: Custom built
- Logo: SVG placeholder (replace with actual logo)
- Images: Placeholders (add your own photos)

---

**Note:** Remember to replace all placeholder images and videos with actual content before launching the website. See ASSETS.md for detailed guidance.
