<?php 
function getBaseUrl() {
    // Detect protocol
    $isHttps = (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        $_SERVER['SERVER_PORT'] == 443
    );
    $protocol = $isHttps ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME']; 
    $path = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');
    return $protocol . $host . $path . '/';
}
$baseUrl = getBaseUrl();
if (!(isset($_GET['partial']) && $_GET['partial'] && isset($_GET['layout']) && $_GET['layout'] == 'main')) {
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PJAX Library Demo</title>
    <base href="<?= $baseUrl; ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        var documentReadyFunctions = [];
        function documentReady(fn) {
            documentReadyFunctions.push(fn);
        }
    </script>
    <style>
        /* Minimal custom styling for loader */
        .loading-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            font-size: 1.5rem;
            color: #6c757d;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold pjax" href="index.php">
                <i class="bi bi-lightning-charge-fill me-2 text-warning"></i>PJAX Demo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link menu-link pjax" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link pjax" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Container for PJAX -->
    <main id="main-container" data-layout="main" class="flex-grow-1 py-5">
<?php } ?>