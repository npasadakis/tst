/**
 * Sailing Business Website - Main JavaScript
 * Bootstrap 5.3 + GLightbox
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize GLightbox for galleries
    initLightbox();

    // Initialize navbar scroll effect
    initNavbarScroll();

    // Initialize smooth scrolling
    initSmoothScroll();

    // Initialize scroll indicator
    initScrollIndicator();

    // Initialize form validation enhancements
    initFormValidation();

    // Initialize video fallback
    initVideoFallback();
});

/**
 * Initialize GLightbox for photo galleries
 */
function initLightbox() {
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        openEffect: 'zoom',
        closeEffect: 'fade',
        cssEfects: {
            fade: { in: 'fadeIn', out: 'fadeOut' },
            zoom: { in: 'zoomIn', out: 'zoomOut' }
        }
    });
}

/**
 * Navbar scroll effect - add background on scroll
 */
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    const scrollThreshold = 100;

    function updateNavbar() {
        if (window.scrollY > scrollThreshold) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    // Initial check
    updateNavbar();

    // Listen for scroll events with throttling
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateNavbar();
                ticking = false;
            });
            ticking = true;
        }
    });
}

/**
 * Smooth scrolling for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - navbarHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Scroll indicator click handler
 */
function initScrollIndicator() {
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (!scrollIndicator) return;

    scrollIndicator.addEventListener('click', function() {
        const hero = document.querySelector('.hero');
        if (hero) {
            const nextSection = hero.nextElementSibling;
            if (nextSection) {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = nextSection.getBoundingClientRect().top + window.scrollY - navbarHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }
    });
}

/**
 * Enhanced form validation
 */
function initFormValidation() {
    const forms = document.querySelectorAll('.booking-form, .contact-form');

    forms.forEach(form => {
        // Add Bootstrap validation classes on submit
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });

        // Real-time validation for email fields
        const emailInputs = form.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateEmail(this);
            });
        });

        // Real-time validation for required fields
        const requiredInputs = form.querySelectorAll('[required]');
        requiredInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    });
}

/**
 * Validate email format
 */
function validateEmail(input) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (input.value && !emailRegex.test(input.value)) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
    } else if (input.value) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }
}

/**
 * Video fallback - hide placeholder if video loads
 */
function initVideoFallback() {
    const video = document.querySelector('.hero-video');
    const placeholder = document.querySelector('.hero-video-placeholder');

    if (video && placeholder) {
        video.addEventListener('canplay', function() {
            placeholder.style.display = 'none';
        });

        video.addEventListener('error', function() {
            // Keep placeholder visible if video fails
            placeholder.style.display = 'block';
        });
    }
}

/**
 * Animate elements on scroll (optional enhancement)
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.trip-card, .why-us-card, .gallery-item');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    animatedElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * Mobile menu close on click
 */
document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
    link.addEventListener('click', function() {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    });
});

/**
 * Date input - set minimum date to today
 */
document.querySelectorAll('input[type="date"]').forEach(input => {
    const today = new Date().toISOString().split('T')[0];
    input.setAttribute('min', today);
});
