<?php
/**
 * Application Entry Point
 */

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/app/core/' . $class . '.php',
        __DIR__ . '/app/controllers/' . $class . '.php',
        __DIR__ . '/app/models/' . $class . '.php',
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Load configuration
require_once __DIR__ . '/app/config/config.php';

// Simple routing based on request URI
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string
$path = parse_url($requestUri, PHP_URL_PATH);

// Remove leading slash
$path = ltrim($path, '/');

// Remove .php extension if present
$path = str_replace('.php', '', $path);

// Default to index if empty
if (empty($path) || $path === 'index') {
    $controller = new PageController();
    $controller->index();
    exit;
}

// Route to appropriate controller method
$controller = new PageController();

// Map paths to methods
$routes = [
    'about' => 'about',
    'products' => 'products',
    'contact' => 'contact',
    'certificates' => 'certificates',
    'blog' => 'blog',
];

// Handle nested paths (e.g., products/spices, blog/slug)
$pathParts = explode('/', $path);
$mainPath = $pathParts[0];

// Handle blog detail pages (e.g., blog/why-world-loves-indian-spices)
if ($mainPath === 'blog' && isset($pathParts[1])) {
    $blogSlug = $pathParts[1];
    if (method_exists($controller, 'blogDetail')) {
        $controller->blogDetail($blogSlug);
        exit;
    }
}

// Handle product category pages
if ($mainPath === 'products' && isset($pathParts[1])) {
    $productController = new ProductController();
    $category = $pathParts[1];
    
    // Handle product detail pages (e.g., products/spices/turmeric)
    if (isset($pathParts[2])) {
        $productSlug = $pathParts[2];
        if (method_exists($productController, 'detail')) {
            $productController->detail($category, $productSlug);
            exit;
        }
    }
    
    // Handle category pages (spices, seeds, powders)
    if (in_array($category, ['spices', 'seeds', 'powders'])) {
        if (method_exists($productController, $category)) {
            $productController->$category();
            exit;
        }
    }
}

if (isset($routes[$mainPath])) {
    $method = $routes[$mainPath];
    if (method_exists($controller, $method)) {
        $controller->$method();
        exit;
    }
}

// 404
$controller->notFound();
