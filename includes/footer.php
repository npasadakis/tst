    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <!-- About -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand d-flex align-items-center mb-3">
                        <img src="<?= getImage('logo-white.svg', 'logo') ?>" alt="<?= t('meta.site_name') ?>" class="footer-logo me-2" width="45" height="45">
                        <span class="brand-text"><?= t('meta.site_name') ?></span>
                    </div>
                    <p class="footer-desc"><?= t('footer.description') ?></p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-tripadvisor"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title"><?= t('footer.quick_links') ?></h5>
                    <ul class="footer-links">
                        <li><a href="<?= langUrl('index.php') ?>"><?= t('nav.home') ?></a></li>
                        <li><a href="<?= langUrl('booking.php') ?>"><?= t('nav.booking') ?></a></li>
                        <li><a href="<?= langUrl('contact.php') ?>"><?= t('nav.contact') ?></a></li>
                    </ul>
                </div>

                <!-- Our Trips -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title"><?= t('footer.our_trips') ?></h5>
                    <ul class="footer-links">
                        <li><a href="<?= langUrl('private-sailing.php') ?>"><?= t('nav.private_sailing') ?></a></li>
                        <li><a href="<?= langUrl('full-day-sailing.php') ?>"><?= t('nav.full_day') ?></a></li>
                        <li><a href="<?= langUrl('half-day-sailing.php') ?>"><?= t('nav.half_day') ?></a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title"><?= t('footer.contact_info') ?></h5>
                    <ul class="footer-contact">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span><?= t('contact.address_value') ?></span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+30 123 456 7890</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>info@cretansailing.com</span>
                        </li>
                        <li>
                            <i class="bi bi-clock"></i>
                            <span><?= t('contact.hours_value') ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> <?= t('meta.site_name') ?>. <?= t('footer.copyright') ?></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
