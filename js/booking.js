// ========================================
// Booking Form - Multi-step Navigation
// ========================================

let currentStep = 1;
const totalSteps = 3;

function nextStep() {
    if (validateStep(currentStep)) {
        // Hide current step
        document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
        document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
        document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('completed');

        // Show next step
        currentStep++;
        document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
        document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');

        // If moving to confirmation step, update summary
        if (currentStep === 3) {
            updateBookingSummary();
        }

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function prevStep() {
    // Hide current step
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
    document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

    // Show previous step
    currentStep--;
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
    document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
    document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('completed');

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function validateStep(step) {
    if (step === 1) {
        // Validate trip selection
        const tripType = document.querySelector('input[name="trip-type"]:checked');
        if (!tripType) {
            alert('Please select a trip type');
            return false;
        }
    } else if (step === 2) {
        // Validate personal details
        const firstName = document.getElementById('first-name').value.trim();
        const lastName = document.getElementById('last-name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const tripDate = document.getElementById('trip-date').value;
        const guests = document.getElementById('guests').value;

        if (!firstName || !lastName) {
            alert('Please enter your full name');
            return false;
        }

        if (!email || !validateEmail(email)) {
            alert('Please enter a valid email address');
            return false;
        }

        if (!phone) {
            alert('Please enter your phone number');
            return false;
        }

        if (!tripDate) {
            alert('Please select your preferred trip date');
            return false;
        }

        // Check if date is in the past
        const selectedDate = new Date(tripDate);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (selectedDate < today) {
            alert('Please select a future date');
            return false;
        }

        if (!guests || guests < 1) {
            alert('Please enter the number of guests');
            return false;
        }
    }

    return true;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function updateBookingSummary() {
    // Get trip type
    const tripType = document.querySelector('input[name="trip-type"]:checked');
    const tripNames = {
        'private': 'Private Sailing Trip',
        'full-day': 'Full Day Sailing Trip',
        'half-day-morning': 'Half Day Trip - Morning',
        'half-day-sunset': 'Half Day Trip - Sunset'
    };
    document.getElementById('summary-trip').textContent = tripNames[tripType.value];

    // Get personal details
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;
    document.getElementById('summary-name').textContent = `${firstName} ${lastName}`;

    document.getElementById('summary-email').textContent = document.getElementById('email').value;
    document.getElementById('summary-phone').textContent = document.getElementById('phone').value;

    // Get trip details
    const tripDate = document.getElementById('trip-date').value;
    const dateObj = new Date(tripDate);
    document.getElementById('summary-date').textContent = dateObj.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    document.getElementById('summary-guests').textContent = document.getElementById('guests').value;

    // Get additional options
    const options = [];
    if (document.getElementById('snorkeling').checked) {
        options.push('Snorkeling Equipment');
    }
    if (document.getElementById('paddleboard').checked) {
        options.push('Paddle Board');
    }

    const dietary = document.getElementById('dietary').value.trim();
    if (dietary) {
        options.push(`Dietary Requirements: ${dietary}`);
    }

    const special = document.getElementById('special-requests').value.trim();
    if (special) {
        options.push(`Special Request: ${special}`);
    }

    const optionsSection = document.getElementById('options-section');
    const optionsSummary = document.getElementById('summary-options');

    if (options.length > 0) {
        optionsSection.style.display = 'block';
        optionsSummary.innerHTML = options.map(opt =>
            `<div class="summary-item"><span class="summary-value">• ${opt}</span></div>`
        ).join('');
    } else {
        optionsSection.style.display = 'none';
    }
}

// ========================================
// Form Submission
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('booking-form');

    if (bookingForm) {
        bookingForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Check terms agreement
            if (!document.getElementById('terms').checked) {
                showBookingMessage('Please agree to the terms and conditions', 'error');
                return;
            }

            // Get all form data
            const formData = {
                tripType: document.querySelector('input[name="trip-type"]:checked').value,
                firstName: document.getElementById('first-name').value,
                lastName: document.getElementById('last-name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                country: document.getElementById('country').value,
                nationality: document.getElementById('nationality').value,
                tripDate: document.getElementById('trip-date').value,
                guests: document.getElementById('guests').value,
                alternativeDates: document.getElementById('alternative-dates').value,
                snorkeling: document.getElementById('snorkeling').checked,
                paddleboard: document.getElementById('paddleboard').checked,
                dietary: document.getElementById('dietary').value,
                specialRequests: document.getElementById('special-requests').value,
                newsletter: document.getElementById('newsletter').checked
            };

            // Log form data (in production, send to server)
            console.log('Booking Request:', formData);

            // Show success message
            showBookingMessage(
                'Thank you for your booking request! We will contact you within 24 hours to confirm your reservation.',
                'success'
            );

            // Optionally, scroll to message
            document.getElementById('booking-form-message').scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });

            // Disable submit button temporarily
            const submitBtn = bookingForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Request Submitted';

            // Reset after 5 seconds (optional)
            setTimeout(function() {
                // You might want to redirect to a thank you page instead
                // window.location.href = 'booking-confirmation.html';
            }, 3000);
        });
    }
});

function showBookingMessage(message, type) {
    const messageDiv = document.getElementById('booking-form-message');
    messageDiv.textContent = message;
    messageDiv.className = 'form-message ' + type;
    messageDiv.style.display = 'block';

    // Hide after 10 seconds
    setTimeout(function() {
        messageDiv.style.display = 'none';
    }, 10000);
}

// ========================================
// Set minimum date to today
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('trip-date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});

// ========================================
// Trip Type Selection Visual Feedback
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const tripOptions = document.querySelectorAll('.trip-option input[type="radio"]');

    tripOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Remove selected class from all
            document.querySelectorAll('.trip-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add selected class to checked option's parent
            if (this.checked) {
                this.closest('.trip-option').classList.add('selected');
            }
        });
    });
});
