<?php
declare(strict_types=1);

$pageTitle = null;
require_once __DIR__ . '/includes/header.php';
$pageTitle = t('meta.contact_title');

// Handle form submission
$formSubmitted = false;
$formError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
        $formError = true;
    } else {
        // Sanitize inputs
        $name = sanitizeInput($_POST['name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $subject = sanitizeInput($_POST['subject'] ?? '');
        $message = sanitizeInput($_POST['message'] ?? '');

        // Validate required fields
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $formError = true;
        } elseif (!isValidEmail($email)) {
            $formError = true;
        } else {
            // In production, send email here
            // For now, just mark as submitted
            $formSubmitted = true;
        }
    }
}

// Generate CSRF token
$csrfToken = generateCsrfToken();
?>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1><?= t('contact.title') ?></h1>
            <p><?= t('contact.subtitle') ?></p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langUrl('index.php') ?>"><?= t('nav.home') ?></a></li>
                    <li class="breadcrumb-item active"><?= t('nav.contact') ?></li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="form-section">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5">
                    <h3 class="mb-4"><?= t('contact.get_in_touch') ?></h3>

                    <div class="contact-info-card mb-4">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="contact-content">
                                <h5><?= t('contact.address') ?></h5>
                                <p><?= t('contact.address_value') ?></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="contact-content">
                                <h5><?= t('contact.phone') ?></h5>
                                <p><a href="tel:+301234567890">+30 123 456 7890</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="contact-content">
                                <h5><?= t('contact.email') ?></h5>
                                <p><a href="mailto:info@cretansailing.com">info@cretansailing.com</a></p>
                            </div>
                        </div>

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

                    <!-- Map -->
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3256.773936557766!2d25.139611!3d35.341875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x149a5b01b2f0f7d1%3A0x400bd2ce2b9f830!2sHeraklion%20Port!5e0!3m2!1sen!2sgr!4v1699000000000!5m2!1sen!2sgr"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <h3 class="mb-4"><?= t('contact.form_title') ?></h3>

                    <?php if ($formSubmitted): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= t('contact.success_message') ?>
                        </div>
                    <?php elseif ($formError): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?= t('booking.error_message') ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label"><?= t('contact.name') ?> *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label"><?= t('contact.email') ?> *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label"><?= t('contact.subject') ?> *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label"><?= t('contact.message') ?> *</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="bi bi-send me-2"></i>
                            <?= t('contact.send') ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2><?= t('hero.title') ?></h2>
            <p><?= t('hero.subtitle') ?></p>
            <a href="<?= langUrl('booking.php') ?>" class="cta-btn">
                <?= t('common.book_now') ?>
            </a>
        </div>
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
