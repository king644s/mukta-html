<?php
/**
 * Application Configuration
 */

// Base URL - Auto-detect from current request
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
// Remove www prefix to ensure base URL is always non-www
if (strpos($host, 'www.') === 0) {
    $host = substr($host, 4);
}
$baseUrl = $protocol . '://' . $host;
define('BASE_URL', $baseUrl);
define('BASE_PATH', __DIR__ . '/../..');

/**
 * Load environment variables from .env file
 */
function loadEnv($envPath = null) {
    if ($envPath === null) {
        $envPath = BASE_PATH . '/.env';
    }
    
    if (!file_exists($envPath)) {
        return false;
    }
    
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                $value = substr($value, 1, -1);
            }
            
            // Only set if not already defined
            if (!defined($key)) {
                define($key, $value);
            }
        }
    }
    
    return true;
}

// Load .env file if it exists
loadEnv();

// Site Information (can be overridden by .env)
if (!defined('SITE_NAME')) {
    define('SITE_NAME', 'Mukta Exports');
}
if (!defined('SITE_EMAIL')) {
    define('SITE_EMAIL', 'info@muktaexports.com');
}
if (!defined('SITE_PHONE')) {
    define('SITE_PHONE', '+91-76666-66985');
}
if (!defined('SITE_ADDRESS')) {
    define('SITE_ADDRESS', 'C/16, Beliram Industrial Estate, 1st Floor, S.V. Road, Dahisar East, Mumbai - 400068');
}

// Google Analytics (can be overridden by .env)
if (!defined('GA_TRACKING_ID')) {
    define('GA_TRACKING_ID', 'G-CP1VZ5BPY5');
}
if (!defined('GOOGLE_SITE_VERIFICATION')) {
    define('GOOGLE_SITE_VERIFICATION', '96ZDOxxn5GHM-lTUJ98SGNqOofpm12v0tLOszS5dhHY');
}

// SMTP Configuration for Contact Form (can be overridden by .env)
if (!defined('SMTP_HOST')) {
    define('SMTP_HOST', 'smtp-relay.brevo.com');
}
if (!defined('SMTP_PORT')) {
    define('SMTP_PORT', 587);
}
if (!defined('SMTP_USERNAME')) {
    define('SMTP_USERNAME', '9f9907001@smtp-brevo.com');
}
if (!defined('SMTP_PASSWORD')) {
    // Default empty - must be set in .env file
    define('SMTP_PASSWORD', '');
}
// SMTP_FROM_EMAIL - use SITE_EMAIL if not set or empty
if (!defined('SMTP_FROM_EMAIL')) {
    define('SMTP_FROM_EMAIL', SITE_EMAIL);
}

// SMTP_FROM_NAME - use SITE_NAME if not set or empty
if (!defined('SMTP_FROM_NAME')) {
    define('SMTP_FROM_NAME', SITE_NAME);
}

// ImageKit CDN
define('IMAGEKIT_CDN', 'https://ik.imagekit.io/nce7bwsse/website-assets');

// Paths
define('VIEWS_PATH', BASE_PATH . '/app/views');
define('COMPONENTS_PATH', VIEWS_PATH . '/components');
define('MODELS_PATH', BASE_PATH . '/app/models');
define('CONTROLLERS_PATH', BASE_PATH . '/app/controllers');
define('LOGS_PATH', BASE_PATH . '/app/logs');

/**
 * Generate canonical URL from current request
 * Ensures canonical URL matches the exact URL being accessed
 */
function getCanonicalUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    
    // Remove www prefix to ensure canonical URLs are always non-www
    if (strpos($host, 'www.') === 0) {
        $host = substr($host, 4);
    }
    
    // Get the current request URI without query string
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH);
    
    // Remove trailing slash except for homepage
    if ($path !== '/' && substr($path, -1) === '/') {
        $path = rtrim($path, '/');
    }
    
    // Build canonical URL
    $canonical = $protocol . '://' . $host . $path;
    
    return $canonical;
}
