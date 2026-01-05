<?php
/**
 * Simple Router for MVC
 */

class Router {
    private $routes = [];
    
    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        // Remove query string
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Remove leading slash
        $path = ltrim($path, '/');
        
        // Default to index if empty
        if (empty($path)) {
            $path = 'index';
        }
        
        // Remove .php extension if present
        $path = str_replace('.php', '', $path);
        
        // Try to find matching route
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $path) {
                $controllerName = $route['controller'];
                $action = $route['action'];
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        return $controller->$action();
                    }
                }
            }
        }
        
        // Fallback: try to load controller based on path
        $controllerName = $this->pathToController($path);
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $action = 'index';
            if (method_exists($controller, $action)) {
                return $controller->$action();
            }
        }
        
        // 404
        http_response_code(404);
        $controller = new PageController();
        $controller->notFound();
    }
    
    private function pathToController($path) {
        $parts = explode('/', $path);
        $controllerName = '';
        foreach ($parts as $part) {
            $controllerName .= ucfirst(str_replace('-', '', ucwords($part, '-')));
        }
        return $controllerName . 'Controller';
    }
}
