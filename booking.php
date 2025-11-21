<?php
declare(strict_types=1);

$pageTitle = null;
require_once __DIR__ . '/includes/header.php';
$pageTitle = t('meta.booking_title');

// Handle form submission
$formSubmitted = false;
$formError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
        $formError = true;
    } else {
        // Sanitize inputs
        $tripType = sanitizeInput($_POST['trip_type'] ?? '');
        $preferredDate = sanitizeInput($_POST['preferred_date'] ?? '');
        $numGuests = (int)($_POST['num_guests'] ?? 1);
        $fullName = sanitizeInput($_POST['full_name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $phone = sanitizeInput($_POST['phone'] ?? '');
        $specialRequests = sanitizeInput($_POST['special_requests'] ?? '');
        $snorkeling = isset($_POST['snorkeling']) ? 'Yes' : 'No';
        $paddleBoard = isset($_POST['paddle_board']) ? 'Yes' : 'No';

        // Validate required fields
        if (empty($tripType) || empty($preferredDate) || empty($fullName) || empty($email)) {
            $formError = true;
        } elseif (!isValidEmail($email)) {
            $formError = true;
        } else {
            // In production, send email or save to database here
            // For now, just mark as submitted
            $formSubmitted = true;
        }
    }
}

// Get pre-selected trip from URL
$preselectedTrip = sanitizeInput($_GET['trip'] ?? '');

// Generate CSRF token
$csrfToken = generateCsrfToken();
?>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1><?= t('booking.title') ?></h1>
            <p><?= t('booking.subtitle') ?></p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langUrl('index.php') ?>"><?= t('nav.home') ?></a></li>
                    <li class="breadcrumb-item active"><?= t('nav.booking') ?></li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Booking Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if ($formSubmitted): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= t('booking.success_message') ?>
                        </div>
                    <?php elseif ($formError): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?= t('booking.error_message') ?>
                        </div>
                    <?php endif; ?>

                    <form class="booking-form" method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

                        <!-- Trip Selection -->
                        <div class="mb-4">
                            <label for="trip_type" class="form-label"><?= t('booking.select_trip') ?> *</label>
                            <select class="form-select" id="trip_type" name="trip_type" required>
                                <option value=""><?= t('booking.select_option') ?></option>
                                <option value="private" <?= $preselectedTrip === 'private' ? 'selected' : '' ?>>
                                    <?= t('trips.private.title') ?>
                                </option>
                                <option value="full_day" <?= $preselectedTrip === 'full_day' ? 'selected' : '' ?>>
                                    <?= t('trips.full_day.title') ?>
                                </option>
                                <option value="half_day_morning" <?= $preselectedTrip === 'half_day_morning' ? 'selected' : '' ?>>
                                    <?= t('booking.morning_trip') ?>
                                </option>
                                <option value="half_day_sunset" <?= $preselectedTrip === 'half_day_sunset' ? 'selected' : '' ?>>
                                    <?= t('booking.sunset_trip') ?>
                                </option>
                            </select>
                        </div>

                        <div class="row">
                            <!-- Date -->
                            <div class="col-md-6 mb-4">
                                <label for="preferred_date" class="form-label"><?= t('booking.preferred_date') ?> *</label>
                                <input type="date" class="form-control" id="preferred_date" name="preferred_date"
                                       min="<?= date('Y-m-d') ?>" required>
                            </div>

                            <!-- Number of Guests -->
                            <div class="col-md-6 mb-4">
                                <label for="num_guests" class="form-label"><?= t('booking.num_guests') ?> *</label>
                                <select class="form-select" id="num_guests" name="num_guests" required>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="mb-4">
                            <label for="full_name" class="form-label"><?= t('booking.full_name') ?> *</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label"><?= t('booking.email') ?> *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label"><?= t('booking.phone') ?></label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>

                        <!-- Optional Equipment -->
                        <div class="mb-4">
                            <label class="form-label"><?= t('booking.equipment_title') ?></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="snorkeling" name="snorkeling">
                                        <label class="form-check-label" for="snorkeling">
                                            <i class="bi bi-water me-1"></i> <?= t('booking.snorkeling') ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="paddle_board" name="paddle_board">
                                        <label class="form-check-label" for="paddle_board">
                                            <i class="bi bi-tsunami me-1"></i> <?= t('booking.paddle_board') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-4">
                            <label for="special_requests" class="form-label"><?= t('booking.special_requests') ?></label>
                            <textarea class="form-control" id="special_requests" name="special_requests" rows="4"
                                      placeholder="<?= t('booking.special_requests_placeholder') ?>"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="submit-btn">
                                <i class="bi bi-send me-2"></i>
                                <?= t('booking.submit') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-info-card">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5><?= t('contact.phone') ?></h5>
                                        <p><a href="tel:+301234567890">+30 123 456 7890</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5><?= t('contact.email') ?></h5>
                                        <p><a href="mailto:info@cretansailing.com">info@cretansailing.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5><?= t('contact.hours') ?></h5>
                                        <p><?= t('contact.hours_value') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
