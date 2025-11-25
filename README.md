# Sailing Business Website

A professional, multi-language website for a sailing business in Crete, Greece.

## Features

- **Multi-language Support**: English, Greek (Ελληνικά), German (Deutsch), French (Français)
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Modern Stack**: PHP 8.4, Bootstrap 5.3, SCSS
- **Trip Types**: Private sailing, full-day trips, half-day trips (morning & sunset)
- **Booking System**: Online booking form with validation
- **Photo Galleries**: Lightbox galleries on all pages
- **Hero Video**: Autoplay video background on homepage

## Pages

1. **Home** (`index.php`) - Hero section, welcome, trip overview, gallery
2. **Private Sailing** (`private-sailing.php`) - Private charter information
3. **Full Day Sailing** (`full-day-sailing.php`) - Full day trip to Dia Island
4. **Half Day Sailing** (`half-day-sailing.php`) - Morning & sunset options
5. **Booking** (`booking.php`) - Online booking form
6. **Contact** (`contact.php`) - Contact form and map

## Structure

```
/
├── index.php                    # Homepage
├── private-sailing.php          # Private trip page
├── full-day-sailing.php         # Full day trip page
├── half-day-sailing.php         # Half day trip page
├── booking.php                  # Booking form
├── contact.php                  # Contact page
├── includes/
│   ├── content.php              # All translations and content
│   ├── functions.php            # Helper functions
│   ├── header.php               # Navigation and header
│   └── footer.php               # Footer and scripts
├── assets/
│   ├── scss/style.scss          # Source SCSS
│   ├── css/style.css            # Compiled CSS
│   ├── js/main.js               # JavaScript
│   ├── images/                  # All images
│   │   ├── logo/                # Logo files
│   │   ├── gallery/             # Gallery images
│   │   └── trips/               # Trip-specific images
│   └── videos/                  # Hero video files
└── package.json                 # Build scripts

```

## Setup Instructions

### Requirements

- PHP 8.4 or higher
- Node.js and npm (for SCSS compilation)
- Web server (Apache, Nginx, or PHP built-in server)

### Installation

1. Clone or download this repository

2. Install dependencies:
   ```bash
   npm install
   ```

3. Replace placeholder images:
   - Add your logo to `assets/images/logo/`
   - Add gallery photos to `assets/images/gallery/`
   - Add trip photos to `assets/images/trips/`
   - Add hero video to `assets/videos/sailing-hero.mp4`
   - See `assets/README.md` for specifications

4. Compile SCSS (optional, already compiled):
   ```bash
   npm run sass
   ```

5. Start PHP server:
   ```bash
   php -S localhost:8000
   ```

6. Visit http://localhost:8000

### Development

- **Watch SCSS changes**: `npm run sass:watch`
- **Build for production**: `npm run build`

## Language Configuration

The default language is English. The website automatically detects browser language and shows the appropriate translation.

To change the default language, edit `includes/functions.php`:
```php
const DEFAULT_LANGUAGE = 'en'; // Change to 'el', 'de', or 'fr'
```

## Content Management

All content and translations are centralized in `includes/content.php`. To update any text:

1. Open `includes/content.php`
2. Find the relevant section (nav, hero, trips, etc.)
3. Update the text for each language
4. Save the file

Example:
```php
'nav' => [
    'home' => [
        'en' => 'Home',
        'el' => 'Αρχική',
        'de' => 'Startseite',
        'fr' => 'Accueil'
    ]
]
```

## Customization

### Colors

Edit `assets/scss/style.scss` variables:
```scss
$primary-color: #0077b6;
$secondary-color: #00b4d8;
$accent-color: #90e0ef;
```

Then compile: `npm run sass`

### Images

Replace placeholder SVG files in:
- `assets/images/gallery/` - Gallery photos (12 images recommended)
- `assets/images/trips/` - Trip-specific photos (6 per trip type)
- `assets/images/logo/` - Your business logo

See `assets/README.md` for image specifications.

### Video

Add your video to `assets/videos/sailing-hero.mp4`
- Resolution: 1920x1080
- Duration: 20-40 seconds (loop)
- Format: MP4 (H.264)
- Max size: 10MB

See `assets/videos/README.md` for optimization tips.

## Features Included

### Security
- CSRF protection on forms
- Input sanitization
- Session management
- Email validation

### SEO
- Meta descriptions for each page
- Semantic HTML
- Alt text on images
- Language-specific meta tags

### User Experience
- Smooth scrolling
- Navbar scroll effect
- Mobile-responsive menu
- Form validation
- Photo lightbox
- Loading states

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Technologies Used

- **PHP 8.4**: Server-side logic
- **Bootstrap 5.3**: CSS framework
- **SCSS**: CSS preprocessing
- **GLightbox**: Photo gallery lightbox
- **Bootstrap Icons**: Icon font

## Deployment

### Production Checklist

- [ ] Replace all placeholder images with real photos
- [ ] Add hero video (`sailing-hero.mp4`)
- [ ] Update contact information (phone, email, address)
- [ ] Add Google Maps API key (if needed)
- [ ] Test all forms
- [ ] Test on mobile devices
- [ ] Compile and minify CSS: `npm run build`
- [ ] Enable HTTPS
- [ ] Set up proper email handling for forms
- [ ] Test all language versions

### Hosting Requirements

- PHP 8.4+
- HTTPS certificate (Let's Encrypt recommended)
- Email capability for form submissions
- Minimum 100MB storage

## License

This is a custom website. All rights reserved.

## Support

For questions or support, please contact the developer.

---

**Built with ❤️ for Cretan Sailing**
