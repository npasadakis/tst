<?php
declare(strict_types=1);

$pageTitle = null;
require_once __DIR__ . '/includes/header.php';
$pageTitle = t('meta.half_day_title');
?>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1><?= t('trips.half_day.title') ?></h1>
            <p><?= t('trips.half_day.short_desc') ?></p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langUrl('index.php') ?>"><?= t('nav.home') ?></a></li>
                    <li class="breadcrumb-item active"><?= t('nav.half_day') ?></li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Trip Detail Section -->
    <section class="trip-detail">
        <div class="container">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Featured Image -->
                    <div class="trip-featured-image mb-4">
                        <img src="<?= getPlaceholderImage(900, 500, 'Half+Day+Sailing') ?>" alt="<?= t('trips.half_day.title') ?>" class="img-fluid rounded-4">
                    </div>

                    <!-- Description -->
                    <div class="trip-description mb-5">
                        <h2><?= t('trips.half_day.title') ?></h2>
                        <p class="lead"><?= t('trips.half_day.full_desc') ?></p>
                    </div>

                    <!-- Trip Options -->
                    <div class="trip-options mb-5">
                        <div class="row g-4">
                            <!-- Morning Trip -->
                            <div class="col-md-6">
                                <div class="option-card">
                                    <div class="option-icon">
                                        <i class="bi bi-sunrise"></i>
                                    </div>
                                    <h4><?= t('trips.half_day.morning_title') ?></h4>
                                    <p><?= t('trips.half_day.morning_desc') ?></p>
                                </div>
                            </div>
                            <!-- Sunset Trip -->
                            <div class="col-md-6">
                                <div class="option-card">
                                    <div class="option-icon">
                                        <i class="bi bi-sunset"></i>
                                    </div>
                                    <h4><?= t('trips.half_day.sunset_title') ?></h4>
                                    <p><?= t('trips.half_day.sunset_desc') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Highlights -->
                    <div class="trip-highlights mb-5">
                        <h3><?= t('common.highlights') ?></h3>
                        <ul class="highlights-list">
                            <?php foreach (tArray('trips.half_day.highlights') as $highlight): ?>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><?= $highlight ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- What's Included -->
                    <div class="trip-inclusions mb-5">
                        <h3><?= t('common.included') ?></h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <ul class="inclusions-list">
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
                                        <span><?= t('inclusions.skipper') ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="inclusions-list">
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span><?= t('inclusions.fuel') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span><?= t('inclusions.snorkeling') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span><?= t('inclusions.paddle') ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <div class="trip-gallery">
                        <h3><?= t('common.gallery') ?></h3>
                        <div class="gallery-grid">
                            <?php
                            $galleryImages = getGalleryImages('half_day', 6);
                            foreach ($galleryImages as $image): ?>
                                <a href="<?= $image['src'] ?>" class="gallery-item glightbox" data-gallery="halfday-gallery">
                                    <img src="<?= $image['thumb'] ?>" alt="<?= $image['caption'] ?>">
                                    <div class="gallery-overlay">
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Trip Info -->
                    <div class="trip-info mb-4">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="info-content">
                                <h5><?= t('common.duration') ?></h5>
                                <p><?= t('trips.half_day.duration') ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="info-content">
                                <h5><?= t('common.departure') ?></h5>
                                <p><?= t('common.departure_point') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Sidebar -->
                    <div class="book-sidebar">
                        <h4><?= t('common.book_now') ?></h4>
                        <a href="<?= langUrl('booking.php?trip=half_day_morning') ?>" class="book-btn-large mb-2">
                            <?= t('booking.morning_trip') ?>
                        </a>
                        <a href="<?= langUrl('booking.php?trip=half_day_sunset') ?>" class="book-btn-large">
                            <?= t('booking.sunset_trip') ?>
                        </a>
                        <div class="contact-info">
                            <p><i class="bi bi-telephone"></i> <a href="tel:+301234567890">+30 123 456 7890</a></p>
                            <p><i class="bi bi-envelope"></i> <a href="mailto:info@cretansailing.com">info@cretansailing.com</a></p>
                        </div>
                    </div>
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
