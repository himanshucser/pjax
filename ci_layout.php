<?php
if (isset($_GET['partial']) && $_GET['partial']) {
    if (isset($_GET['layout']) && $_GET['layout'] == 'main') {
?>
        <div id="main-content" data-title="<?= $this->renderSection('title') ?>">
            <?= view('common/message_alert'); ?>
            <?= $this->renderSection('style') ?>
            <?= $this->renderSection('content') ?>
            <?= $this->renderSection('script') ?>
        </div>
    <?php
    } else {
        echo 'reload';
    }
} else {
    $locale = request()->getLocale();
    $setting = setting();
    ?>
    <!DOCTYPE html>
    <html lang="<?= $locale; ?>" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="theme/assets/" data-template="vertical-menu-template-no-customizer">

    <head>
        <meta charset="utf-8">
        <base href="<?= base_url(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="<?= $locale; ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <?= $this->renderSection('title') ?> | <?= APP_NAME ?></title>
        <link rel="shortcut icon" href="<?= APP_FAVICON; ?>" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <?= $this->renderSection('styles') ?>
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
            <div class="layout-container">
                <!-- Navbar -->
                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="container-xxl">
                        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                            <a href="<?= base_url(); ?>" class="app-brand-link gap-2">
                                <span class="avatar me-2">
                                    <img src="<?= APP_LOGO; ?>" alt="<?= APP_NAME ?>" class="rounded" />
                                </span>
                            </a>
                            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                                <i class="ti ti-x ti-sm align-middle"></i>
                            </a>
                        </div>
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="ti ti-menu-2 ti-sm"></i>
                            </a>
                        </div>
                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <!-- User -->
                                <li class="menu-item pjax">
                                    <a href="login" class="menu-link pjax">
                                        <div data-i18n="Home" style="padding-right: 10px;">Home</div>
                                    </a>
                                </li>
                                <li class="menu-item pjax">
                                    <a href="login" class="menu-link pjax">
                                        <div data-i18n="Login" style="padding-right: 10px;">Login</div>
                                    </a>
                                </li>
                                <br>
                                <li class="menu-item pjax">
                                    <a href="register" class="menu-link pjax">
                                        <div data-i18n="Register">Register</div>
                                    </a>
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>
                        <!-- Search Small Screens -->
                        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
                            <input type="text" class="form-control search-input border-0" placeholder="Search..." aria-label="Search..." />
                            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                        </div>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Menu -->
                        <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                            <div class="container-xxl d-flex h-100">
                                <ul class="menu-inner">
                                    <li class="menu-item pjax">
                                        <a href="<?= base_url() ?>" class="menu-link pjax" data-pjax-cache="true">
                                            <i class="menu-icon tf-icons ti ti-mail"></i>
                                            <div data-i18n="Home">Home</div>
                                        </a>
                                    </li>
                                    <li class="menu-item pjax">
                                        <a href="<?= route('contact') ?>" class="menu-link pjax" data-pjax-cache="true">
                                            <i class="menu-icon tf-icons ti ti-calendar"></i>
                                            <div data-i18n="Contact">Contact</div>
                                        </a>
                                    </li>
                                    <li class="menu-item pjax">
                                        <a href="<?= route('about') ?>" class="menu-link pjax" data-pjax-cache="true">
                                            <i class="menu-icon tf-icons ti ti-calendar"></i>
                                            <div data-i18n="About">About</div>
                                        </a>
                                </ul>
                            </div>
                        </aside>
                        <!-- / Menu -->
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y" id="main-container" data-layout="main">
                            <div id="main-content" data-title="<?= $this->renderSection('title') . ' | ' . APP_NAME ?>">
                                <?= view('common/message_alert'); ?>
                                <?= $this->renderSection('content') ?>
                            </div>
                        </div>
                        <!--/ Content -->
                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl">
                                <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                    <div>
                                        ©<?= date('Y') ?> , made by <a href="<?= base_url(); ?>" target="_blank" class="fw-semibold"><?= APP_NAME ?></a>
                                    </div>
                                    <div>
                                        <a target="_blank" href="page/terms-conditions">Terms & Condition</a> |
                                        <a target="_blank" href="page/Cullen-Patrick">Cullen Patrick</a> |
                                        <a target="_blank" href="page/privacy-policy">Privacy Policy</a>
                                    </div>
                                </div>
                            </div>

                        </footer>
                        <!-- / Footer -->
                    </div>
                    <!--/ Content wrapper -->
                </div>
                <!--/ Layout container -->
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>

        <!-- build:js assets/vendor/js/core.js -->
        <script src="jquery.js"></script>
        <script src="pjax.js"></script>
        <?= $this->renderSection('script') ?>
        <script>
            $(document).ready(function() {
                pjax.init();
                runDocumentReady();
            });
        </script>
    </body>
    </html>
<?php } ?>