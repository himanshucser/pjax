<?php if (!(isset($_GET['partial']) && $_GET['partial'] && isset($_GET['layout']) && $_GET['layout'] == 'main')) { ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; <?= date('Y'); ?> PJAX Library Demo. Built with Vanilla JS and Bootstrap 5.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" crossorigin="anonymous"></script>
    
    <!-- PJAX Library -->
    <script src="../../pjax.js"></script>
    
    <script>
        function onlinkClick(target) {
            target = $(target);
            if (target.hasClass("menu-link")) {
                // Update active state for Bootstrap nav-links
                $(".nav-link").removeClass("active");
                target.addClass("active");
            }
        }
        $(document).ready(function() {
            pjax.init(onlinkClick);
        });
    </script>
</body>
</html>
<?php } ?>