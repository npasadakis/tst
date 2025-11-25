<?php
declare(strict_types=1);

require_once __DIR__ . '/content.php';
require_once __DIR__ . '/functions.php';

$currentLang = getCurrentLanguage();
$langUrls = getLanguageSwitcherUrls();
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= t('meta.description') ?>">
    <title><?= $pageTitle ?? t('meta.site_name') ?></title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Lightbox CSS -->
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= langUrl('index.php') ?>">
                <img src="<?= getImage('logo-white.svg', 'logo') ?>" alt="<?= t('meta.site_name') ?>" class="navbar-logo me-2" width="45" height="45">
                <span class="brand-text"><?= t('meta.site_name') ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= getNavActiveClass('index.php') ?>" href="<?= langUrl('index.php') ?>">
                            <?= t('nav.home') ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?= t('nav.trips') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?= getNavActiveClass('private-sailing.php') ?>" href="<?= langUrl('private-sailing.php') ?>">
                                    <?= t('nav.private_sailing') ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= getNavActiveClass('full-day-sailing.php') ?>" href="<?= langUrl('full-day-sailing.php') ?>">
                                    <?= t('nav.full_day') ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= getNavActiveClass('half-day-sailing.php') ?>" href="<?= langUrl('half-day-sailing.php') ?>">
                                    <?= t('nav.half_day') ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= getNavActiveClass('booking.php') ?>" href="<?= langUrl('booking.php') ?>">
                            <?= t('nav.booking') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= getNavActiveClass('contact.php') ?>" href="<?= langUrl('contact.php') ?>">
                            <?= t('nav.contact') ?>
                        </a>
                    </li>
                </ul>

                <!-- Language Switcher -->
                <div class="dropdown language-switcher">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-globe me-1"></i>
                        <?= $translations['languages'][$currentLang] ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach ($langUrls as $code => $langInfo): ?>
                            <li>
                                <a class="dropdown-item <?= $langInfo['active'] ? 'active' : '' ?>" href="<?= $langInfo['url'] ?>">
                                    <?= $langInfo['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Book Now Button -->
                <a href="<?= langUrl('booking.php') ?>" class="btn btn-primary ms-lg-3 book-btn">
                    <?= t('common.book_now') ?>
                </a>
            </div>
        </div>
    </nav>
