<?php
/**
 * Base Controller
 */

require_once __DIR__ . '/../config/config.php';

class Controller {
    protected $viewPath;
    protected $data = [];
    
    public function __construct() {
        $this->viewPath = VIEWS_PATH;
    }
    
    protected function view($view, $data = []) {
        $this->data = array_merge($this->data, $data);
        extract($this->data);
        
        // Start output buffering
        ob_start();
        
        // Include header
        include COMPONENTS_PATH . '/header.php';
        
        // Include main view
        $viewFile = $this->viewPath . '/' . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "View not found: " . $view;
        }
        
        // Include footer
        include COMPONENTS_PATH . '/footer.php';
        
        // Get and return content
        $content = ob_get_clean();
        echo $content;
    }
    
    protected function renderComponent($component, $data = []) {
        extract($data);
        $componentFile = COMPONENTS_PATH . '/' . $component . '.php';
        if (file_exists($componentFile)) {
            include $componentFile;
        }
    }
}
