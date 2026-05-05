<?php include 'layout/header.php'; ?>
<div id="main-content" data-title="About - PJAX Demo">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                
                <div class="card shadow-sm border-0 rounded-4 mb-4 mt-4 overflow-hidden">
                    <div class="bg-primary p-5 text-center text-white">
                        <h1 class="fw-bold mb-0">About PJAX</h1>
                    </div>
                    <div class="card-body p-5">
                        <h4 class="fw-bold mb-3">How it works</h4>
                        <p class="text-muted mb-4">
                            PJAX works by intercepting click events on links with the <code>.pjax</code> class. Instead of doing a normal page transition, it:
                        </p>
                        
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item px-0 py-3 d-flex align-items-start border-0">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Updates the URL</h6>
                                    <p class="text-muted mb-0 small">Uses <code>history.pushState()</code> to change the URL without reloading.</p>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-3 d-flex align-items-start border-0">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Fetches Content</h6>
                                    <p class="text-muted mb-0 small">Makes an AJAX request to the server, appending a <code>?partial=1</code> parameter.</p>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-3 d-flex align-items-start border-0">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Replaces DOM</h6>
                                    <p class="text-muted mb-0 small">The server responds with only the inner HTML. PJAX swaps it into the <code>#main-container</code>.</p>
                                </div>
                            </li>
                        </ul>

                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-outline-primary btn-lg rounded-pill px-5 pjax">
                                <i class="bi bi-arrow-left ms-2"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>