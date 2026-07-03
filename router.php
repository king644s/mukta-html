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

$mimeTypes = [
    'css' => 'text/css; charset=UTF-8',
    'js' => 'application/javascript; charset=UTF-8',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    'ico' => 'image/x-icon',
    'woff' => 'font/woff',
    'woff2' => 'font/woff2',
    'ttf' => 'font/ttf',
    'eot' => 'application/vnd.ms-fontobject',
    'pdf' => 'application/pdf',
    'xml' => 'application/xml; charset=UTF-8',
    'txt' => 'text/plain; charset=UTF-8',
];

$staticExtensions = array_keys($mimeTypes);
$pathInfo = pathinfo($path);
if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $staticExtensions, true)) {
    $filePath = __DIR__ . $path;
    if (file_exists($filePath) && is_file($filePath)) {
        $ext = strtolower($pathInfo['extension']);
        $basename = basename($path);

        if (preg_match('/\.v\d+\.(css|js)$/', $basename)) {
            header('Cache-Control: public, max-age=31536000, immutable');
        } elseif (in_array($ext, ['css', 'js'], true)) {
            header('Cache-Control: public, max-age=2592000, stale-while-revalidate=86400');
        } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot'], true)) {
            header('Cache-Control: public, max-age=31536000, immutable');
        } elseif ($basename === 'sitemap.xml' || $basename === 'robots.txt') {
            header('Cache-Control: public, max-age=86400, stale-while-revalidate=43200');
        } elseif ($ext === 'pdf') {
            header('Cache-Control: public, max-age=2592000');
        }

        header('Content-Type: ' . $mimeTypes[$ext]);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        return true;
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
