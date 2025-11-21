<?php
declare(strict_types=1);

$pageTitle = null; // Will be set after translations load
require_once __DIR__ . '/includes/header.php';
$pageTitle = t('meta.home_title');
?>

    <!-- Hero Section with Video -->
    <section class="hero">
        <!-- Video Background (placeholder - use an actual video in production) -->
        <video class="hero-video" autoplay muted loop playsinline poster="<?= getPlaceholderImage(1920, 1080, 'Sailing+Crete') ?>">
            <source src="assets/videos/sailing-hero.mp4" type="video/mp4">
            <!-- Fallback if no video available -->
        </video>
        <div class="hero-video-placeholder"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1><?= t('hero.title') ?></h1>
            <p><?= t('hero.subtitle') ?></p>
            <a href="#trips" class="hero-btn">
                <?= t('hero.cta') ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="scroll-indicator">
            <i class="bi bi-chevron-double-down"></i>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="welcome-content">
                        <h2><?= t('home.welcome_title') ?></h2>
                        <p><?= t('home.welcome_text') ?></p>
                        <ul class="inclusions-list mt-4">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= t('inclusions.meals') ?></span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= t('inclusions.drinks') ?></span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= t('inclusions.snorkeling') ?></span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= t('inclusions.paddle') ?></span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= t('inclusions.skipper') ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="welcome-image">
                        <img src="<?= getPlaceholderImage(600, 500, 'Cretan+Sailing') ?>" alt="Sailing in Crete" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trips Section -->
    <section id="trips" class="trips-section">
        <div class="container">
            <div class="section-title">
                <h2><?= t('home.trips_title') ?></h2>
            </div>

            <div class="row g-4">
                <!-- Private Sailing -->
                <div class="col-lg-4 col-md-6">
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="<?= getPlaceholderImage(600, 400, 'Private+Charter') ?>" alt="<?= t('trips.private.title') ?>">
                            <span class="trip-duration"><?= t('trips.private.duration') ?></span>
                        </div>
                        <div class="trip-content">
                            <h3><?= t('trips.private.title') ?></h3>
                            <p><?= t('trips.private.short_desc') ?></p>
                            <a href="<?= langUrl('private-sailing.php') ?>" class="trip-btn">
                                <?= t('common.learn_more') ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Full Day Trip -->
                <div class="col-lg-4 col-md-6">
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="<?= getPlaceholderImage(600, 400, 'Full+Day+Trip') ?>" alt="<?= t('trips.full_day.title') ?>">
                            <span class="trip-duration"><?= t('trips.full_day.duration') ?></span>
                        </div>
                        <div class="trip-content">
                            <h3><?= t('trips.full_day.title') ?></h3>
                            <p><?= t('trips.full_day.short_desc') ?></p>
                            <a href="<?= langUrl('full-day-sailing.php') ?>" class="trip-btn">
                                <?= t('common.learn_more') ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Half Day Trip -->
                <div class="col-lg-4 col-md-6">
                    <div class="trip-card">
                        <div class="trip-image">
                            <img src="<?= getPlaceholderImage(600, 400, 'Half+Day+Trip') ?>" alt="<?= t('trips.half_day.title') ?>">
                            <span class="trip-duration"><?= t('trips.half_day.duration') ?></span>
                        </div>
                        <div class="trip-content">
                            <h3><?= t('trips.half_day.title') ?></h3>
                            <p><?= t('trips.half_day.short_desc') ?></p>
                            <a href="<?= langUrl('half-day-sailing.php') ?>" class="trip-btn">
                                <?= t('common.learn_more') ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us-section">
        <div class="container">
            <div class="section-title">
                <h2><?= t('home.why_us_title') ?></h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="why-us-card">
                        <div class="icon-box">
                            <i class="bi bi-award"></i>
                        </div>
                        <h4><?= t('why_us.experience.title') ?></h4>
                        <p><?= t('why_us.experience.desc') ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="why-us-card">
                        <div class="icon-box">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4><?= t('why_us.safety.title') ?></h4>
                        <p><?= t('why_us.safety.desc') ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="why-us-card">
                        <div class="icon-box">
                            <i class="bi bi-star"></i>
                        </div>
                        <h4><?= t('why_us.service.title') ?></h4>
                        <p><?= t('why_us.service.desc') ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="why-us-card">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h4><?= t('why_us.location.title') ?></h4>
                        <p><?= t('why_us.location.desc') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="section-title">
                <h2><?= t('home.gallery_title') ?></h2>
            </div>

            <div class="gallery-grid">
                <?php
                $galleryImages = getGalleryImages('general', 6);
                foreach ($galleryImages as $image): ?>
                    <a href="<?= $image['src'] ?>" class="gallery-item glightbox" data-gallery="home-gallery">
                        <img src="<?= $image['thumb'] ?>" alt="<?= $image['caption'] ?>">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </a>
                <?php endforeach; ?>
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
