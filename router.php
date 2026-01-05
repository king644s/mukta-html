<?php
/**
 * Router for PHP Built-in Server
 * This ensures ALL requests go through PHP, including HTML files
 */

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Block direct access to HTML files - redirect to clean URLs
if (preg_match('/\.html$/', $path)) {
    $cleanPath = preg_replace('/\.html$/', '', $path);
    // Handle index.html -> /
    if (empty($cleanPath) || $cleanPath === '/index' || basename($cleanPath) === 'index') {
        $cleanPath = '/';
    }
    header('Location: ' . $cleanPath, true, 301);
    exit;
}

// Block direct access to .php files in root (except index.php)
if (preg_match('/\.php$/', $path) && basename($path) !== 'index.php' && strpos($path, '/app/') === false) {
    $cleanPath = preg_replace('/\.php$/', '', $path);
    if (empty($cleanPath) || $cleanPath === '/') {
        $cleanPath = '/';
    }
    header('Location: ' . $cleanPath, true, 301);
    exit;
}

// Serve static files (CSS, JS, images) if they exist
$staticExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'pdf'];
$pathInfo = pathinfo($path);
if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $staticExtensions)) {
    $filePath = __DIR__ . $path;
    if (file_exists($filePath) && is_file($filePath)) {
        return false; // Let PHP serve the static file
    }
}

// Block access to app directory files directly
if (strpos($path, '/app/') === 0) {
    http_response_code(403);
    exit('Access denied');
}

// All other requests go through index.php
if (file_exists(__DIR__ . '/index.php')) {
    include __DIR__ . '/index.php';
    return true;
}

// If index.php doesn't exist, return 404
http_response_code(404);
exit('Not Found');
