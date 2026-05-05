<?php
if (isset($_GET['partial']) && $_GET['partial']) {
    if (isset($_GET['layout']) && $_GET['layout'] == 'main') {
?>
        <div id="main-content" data-title="@yield('title') | {{config('setting.app_name')}}">
            {{ view('common/message_alert') }}
            @stack('styles')
            @yield('content')
            @stack('scripts')
        </div>
    <?php
    } else {
        echo 'reload';
    }
} else {
?><!DOCTYPE html>
    <html lang="{{ Config::get('app.locale') }}" class="layout-navbar-fixed layout-wide"  data-assets-path="theme/assets/" data-template="front-pages">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <base href="{{ URL::to('/') }}/">
        <meta http-equiv="Content-Language" content="{{ Config::get('app.locale') }}">
        <meta name="keywords" content="{{$metaData['keyword']}}">
        <meta name="description" content="{{$metaData['description']}}">
        <title>@yield('title') | {{config('setting.app_name')}}</title>
        <script>
            var documentReadyFunctions = [];
            function documentReady(fn) {
                documentReadyFunctions.push(fn);
            }
        </script>
    </head>
    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar layout-without-menu">
             <!-- Layout container -->
                <div class="layout-container">
                    <!-- Layout page -->
                        <div class="layout-page">
                            <!-- Navbar -->
                            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                                <div class="container-xxl d-flex h-100">
                                    <ul class="menu-inner">
                                        <li class="menu-item pjax">
                                            <a href="home" class="menu-link pjax" data-pjax-cache="true">
                                                <i class="menu-icon tf-icons ti ti-mail"></i>
                                                <div data-i18n="Home">Home</div>
                                            </a>
                                        </li>
                                        <li class="menu-item pjax">
                                            <a href="contact" class="menu-link pjax" data-pjax-cache="true">
                                                <i class="menu-icon tf-icons ti ti-calendar"></i>
                                                <div data-i18n="Contact">Contact</div>
                                            </a>
                                        </li>
                                        <li class="menu-item pjax">
                                            <a href="faq" class="menu-link pjax" data-pjax-cache="true">
                                                <div data-i18n="FAQ">FAQ</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                            <!-- / Navbar -->
                
                            <!-- Content wrapper -->
                            <div class="content-wrapper">
                                    <!-- Content -->
                                    <div class="container-xxl flex-grow-1 container-p-y">
                                        <div id="main-container" data-layout="main">
                                            <div id="main-content" data-title="@yield('title') | {{config('setting.app_name')}}">
                                                {{ view('common/message_alert') }}
                                                @yield('content')
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Content -->
                                    <!-- Footer -->
                                    <footer class="content-footer footer bg-footer-theme">
                                        <div class="container-xxl">
                                            <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                                <div class="mb-2 mb-md-0">
                                                    ©{{date('Y')}} , made by <a href="{{route('home')}}" target="_blank" class="fw-semibold footer-link">{{ config('setting.app_name') }}</a>
                                                </div>
                                                <div class="d-none d-lg-inline-block">
                                                    <a target="_blank" href="page/terms-condition" class="footer-link me-4">Terms & Condition</a>
                                                    <a target="_blank" href="page/Cullen-Patrick" class="footer-link me-4">Cullen Patrick</a>
                                                    <a target="_blank" href="page/privacy-policy" class="footer-link">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </footer>
                                    <!-- / Footer -->
                                    <div class="content-backdrop fade"></div>
                            </div>
                            <!--/ Content wrapper -->  
                        </div>
                    <!--/ Layout page -->
                </div>
              <!--/ Layout container -->
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>

        <script src="jquery.js"></script>
        <script src="pjax.js"></script>
        <script>
            $(document).ready(function() {
                pjax.onLinkClick = function (target) {
                    target = $(target);
                    if (target.hasClass("menu-link")) {
                        // Update active state for Bootstrap nav-links
                        $(".menu-link").removeClass("active");
                        target.addClass("active");
                    }
                };
                pjax.init();
            });
        </script>
    </body>
    </html>
<?php } ?>