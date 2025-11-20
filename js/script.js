// ========================================
// Mobile Menu Toggle
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
        });

        // Close menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = navMenu.contains(event.target);
            const isClickOnToggle = mobileMenuToggle.contains(event.target);

            if (!isClickInsideNav && !isClickOnToggle && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
        });
    }
});

// ========================================
// Gallery Modal
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('gallery-modal');
    const modalImg = document.getElementById('modal-image');
    const modalCaption = document.querySelector('.modal-caption');
    const closeBtn = document.querySelector('.modal-close');
    const prevBtn = document.querySelector('.modal-prev');
    const nextBtn = document.querySelector('.modal-next');
    const galleryItems = document.querySelectorAll('.gallery-item img');

    let currentIndex = 0;

    // Open modal when clicking on gallery image
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            modal.classList.add('active');
            modalImg.src = this.src;
            modalCaption.textContent = this.alt;
            currentIndex = index;
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
    });

    // Close modal
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    // Close modal when clicking outside the image
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Previous image
    if (prevBtn) {
        prevBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
            modalImg.src = galleryItems[currentIndex].src;
            modalCaption.textContent = galleryItems[currentIndex].alt;
        });
    }

    // Next image
    if (nextBtn) {
        nextBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            currentIndex = (currentIndex + 1) % galleryItems.length;
            modalImg.src = galleryItems[currentIndex].src;
            modalCaption.textContent = galleryItems[currentIndex].alt;
        });
    }

    // Keyboard navigation for gallery
    document.addEventListener('keydown', function(event) {
        if (modal.classList.contains('active')) {
            if (event.key === 'ArrowLeft') {
                prevBtn.click();
            } else if (event.key === 'ArrowRight') {
                nextBtn.click();
            }
        }
    });
});

// ========================================
// Contact Form Handling
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');

    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Get form values
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const tripType = document.getElementById('trip-type').value;
            const preferredDate = document.getElementById('preferred-date').value;
            const guests = document.getElementById('guests').value;
            const message = document.getElementById('message').value;
            const snorkeling = document.getElementById('snorkeling').checked;
            const paddleboard = document.getElementById('paddleboard').checked;
            const newsletter = document.getElementById('newsletter').checked;

            // Basic validation
            if (!firstName || !lastName || !email || !tripType || !message) {
                showFormMessage('Please fill in all required fields.', 'error');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showFormMessage('Please enter a valid email address.', 'error');
                return;
            }

            // Simulate form submission
            // In a real application, this would send data to a server
            console.log('Form Data:', {
                firstName,
                lastName,
                email,
                phone,
                tripType,
                preferredDate,
                guests,
                message,
                snorkeling,
                paddleboard,
                newsletter
            });

            // Show success message
            showFormMessage('Thank you for your inquiry! We will get back to you soon.', 'success');

            // Reset form
            contactForm.reset();

            // Scroll to message
            const formMessage = document.getElementById('form-message');
            formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    }

    function showFormMessage(message, type) {
        const formMessage = document.getElementById('form-message');
        formMessage.textContent = message;
        formMessage.className = 'form-message ' + type;
        formMessage.style.display = 'block';

        // Hide message after 5 seconds
        setTimeout(function() {
            formMessage.style.display = 'none';
        }, 5000);
    }
});

// ========================================
// Smooth Scroll for Anchor Links
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            const targetId = this.getAttribute('href');

            // Skip if it's just "#" or empty
            if (targetId === '#' || !targetId) {
                return;
            }

            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                event.preventDefault();
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetElement.offsetTop - navbarHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// ========================================
// Navbar Scroll Effect
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Add shadow when scrolled
        if (scrollTop > 10) {
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.15)';
        } else {
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }

        lastScrollTop = scrollTop;
    });
});

// ========================================
// Lazy Loading for Images
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                // Image will load naturally since src is already set
                // This observer is here for potential future enhancements
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => {
        imageObserver.observe(img);
    });
});

// ========================================
// Animation on Scroll
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements that should animate
    const animatedElements = document.querySelectorAll('.trip-card, .included-item, .gallery-item, .option-card');

    animatedElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });
});

// ========================================
// Video Auto-play Handler (for mobile)
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const heroVideo = document.querySelector('.hero-video video');

    if (heroVideo) {
        // Ensure video plays on mobile devices when possible
        heroVideo.play().catch(error => {
            console.log('Video autoplay prevented:', error);
            // Fallback: show poster image if video doesn't play
        });

        // Replay video when it ends
        heroVideo.addEventListener('ended', function() {
            this.currentTime = 0;
            this.play();
        });
    }
});

// ========================================
// Form Date Picker - Set minimum date to today
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('preferred-date');

    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});
