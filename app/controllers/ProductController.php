<?php
/**
 * Product Controller
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PageModel.php';

class ProductController extends Controller {
    private $productModel;
    
    public function __construct() {
        parent::__construct();
        require_once __DIR__ . '/../models/ProductModel.php';
        $this->productModel = new ProductModel();
    }
    
    public function detail($category, $slug) {
        $product = $this->productModel->getProduct($category, $slug);
        
        if (!$product) {
            $pageController = new PageController();
            $pageController->notFound();
            exit;
        }
        
        $pageData = [
            'title' => $product['title'],
            'description' => $product['description'],
            'keywords' => $product['keywords'],
            'og_image' => IMAGEKIT_CDN . '/products/' . $product['image'],
            'active_nav' => $category,
            'structured_data' => $this->getProductStructuredData($product, $category, $slug),
        ];
        
        $this->view('products/detail', [
            'pageData' => $pageData,
            'product' => $product,
            'category' => $category
        ]);
    }
    
    private function getProductStructuredData($product, $category, $slug) {
        $breadcrumbs = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Products', 'item' => BASE_URL . '/products'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $product['category'], 'item' => BASE_URL . '/products/' . $category],
            ['@type' => 'ListItem', 'position' => 4, 'name' => $product['name'], 'item' => BASE_URL . '/products/' . $category . '/' . $slug],
        ];
        
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Product",
          "name": "' . addslashes($product['name']) . '",
          "description": "' . addslashes($product['description']) . '",
          "image": "' . IMAGEKIT_CDN . '/products/' . $product['image'] . '",
          "brand": {
            "@type": "Brand",
            "name": "Mukta Exports"
          },
          "category": "' . $product['category'] . '",
          "countryOfOrigin": "India",
          "offers": {
            "@type": "Offer",
            "availability": "https://schema.org/InStock",
            "priceCurrency": "USD",
            "seller": {
              "@type": "Organization",
              "name": "Mukta Exports"
            }
          }
        }
        </script>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": ' . json_encode($breadcrumbs) . '
        }
        </script>';
    }
    
    public function spices() {
        $pageData = [
            'title' => 'Premium Whole Spices Exporter | Turmeric, Cardamom, Black Pepper | Mukta Exports',
            'description' => 'Export-quality whole spices from India: Turmeric fingers, green cardamom, Ceylon cinnamon, cloves, nutmeg, mace, black pepper, and dry red chilli. FSSAI certified with full traceability.',
            'keywords' => 'whole spices exporter, turmeric fingers, cardamom pods, cinnamon sticks, whole cloves, nutmeg supplier, black pepper wholesale, dry red chilli, Indian spices bulk',
            'og_image' => IMAGEKIT_CDN . '/spices-hero.webp',
            'active_nav' => 'spices',
            'structured_data' => $this->getSpicesStructuredData(),
        ];
        
        $this->view('products/spices', [
            'pageData' => $pageData
        ]);
    }
    
    public function seeds() {
        $pageData = [
            'title' => 'Premium Oil Seeds Exporter | Cumin, Coriander, Fennel Seeds | Mukta Exports',
            'description' => 'High-quality oil seeds from India: Cumin seeds, coriander seeds, fennel seeds, fenugreek, mustard, ajwain, nigella (kalonji), dill, and caraway seeds. 99%+ purity with export documentation.',
            'keywords' => 'oil seeds exporter, cumin seeds wholesale, coriander seeds supplier, fennel seeds, fenugreek seeds, mustard seeds, ajwain seeds, nigella seeds, kalonji, dill seeds, Indian seeds bulk',
            'og_image' => IMAGEKIT_CDN . '/seeds-hero.webp',
            'active_nav' => 'seeds',
            'structured_data' => $this->getSeedsStructuredData(),
        ];
        
        $this->view('products/seeds', [
            'pageData' => $pageData
        ]);
    }
    
    public function powders() {
        $pageData = [
            'title' => 'Premium Spice Powders Exporter | Turmeric, Chilli, Garam Masala | Mukta Exports',
            'description' => 'Finely ground spice powders from India: Turmeric powder, red chilli powder, garam masala, coriander powder, garlic powder, ginger powder, and custom blends. Mesh 60-80, export-ready.',
            'keywords' => 'spice powder exporter, turmeric powder, chilli powder, garam masala, coriander powder, garlic powder, ginger powder, black pepper powder, custom spice blends, Indian spice powders',
            'og_image' => IMAGEKIT_CDN . '/powders-hero.webp',
            'active_nav' => 'powders',
            'structured_data' => $this->getPowdersStructuredData(),
        ];
        
        $this->view('products/powders', [
            'pageData' => $pageData
        ]);
    }
    
    private function getSpicesStructuredData() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "Premium Whole Spices",
          "description": "Export-quality whole spices from India",
          "url": "' . BASE_URL . '/products/spices",
          "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
              {"@type": "ListItem", "position": 1, "name": "Turmeric", "url": "' . BASE_URL . '/products/spices/turmeric"},
              {"@type": "ListItem", "position": 2, "name": "Cardamom", "url": "' . BASE_URL . '/products/spices/cardamom"},
              {"@type": "ListItem", "position": 3, "name": "Cinnamon", "url": "' . BASE_URL . '/products/spices/cinnamon"},
              {"@type": "ListItem", "position": 4, "name": "Clove", "url": "' . BASE_URL . '/products/spices/clove"},
              {"@type": "ListItem", "position": 5, "name": "Nutmeg", "url": "' . BASE_URL . '/products/spices/nutmeg"},
              {"@type": "ListItem", "position": 6, "name": "Black Pepper", "url": "' . BASE_URL . '/products/spices/black-pepper"},
              {"@type": "ListItem", "position": 7, "name": "Mace", "url": "' . BASE_URL . '/products/spices/mace"},
              {"@type": "ListItem", "position": 8, "name": "Dry Red Chilli", "url": "' . BASE_URL . '/products/spices/red-chilli"}
            ]
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Products', 'Whole Spices']);
    }
    
    private function getSeedsStructuredData() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "Premium Oil Seeds",
          "description": "High-quality oil seeds from India",
          "url": "' . BASE_URL . '/products/seeds",
          "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
              {"@type": "ListItem", "position": 1, "name": "Ajwain Seeds", "url": "' . BASE_URL . '/products/seeds/ajwain-seeds"},
              {"@type": "ListItem", "position": 2, "name": "Cumin Seeds", "url": "' . BASE_URL . '/products/seeds/cumin-seeds"},
              {"@type": "ListItem", "position": 3, "name": "Coriander Seeds", "url": "' . BASE_URL . '/products/seeds/coriander-seeds"},
              {"@type": "ListItem", "position": 4, "name": "Fennel Seeds", "url": "' . BASE_URL . '/products/seeds/fennel-seeds"},
              {"@type": "ListItem", "position": 5, "name": "Fenugreek Seeds", "url": "' . BASE_URL . '/products/seeds/fenugreek-seeds"},
              {"@type": "ListItem", "position": 6, "name": "Nigella Seeds", "url": "' . BASE_URL . '/products/seeds/nigella-seeds"},
              {"@type": "ListItem", "position": 7, "name": "Mustard Seeds (Black)", "url": "' . BASE_URL . '/products/seeds/mustard-black"},
              {"@type": "ListItem", "position": 8, "name": "Mustard Seeds (Brown)", "url": "' . BASE_URL . '/products/seeds/mustard-brown"},
              {"@type": "ListItem", "position": 9, "name": "Mustard Seeds (Yellow)", "url": "' . BASE_URL . '/products/seeds/mustard-yellow"},
              {"@type": "ListItem", "position": 10, "name": "Dill Seeds", "url": "' . BASE_URL . '/products/seeds/dill-seeds"},
              {"@type": "ListItem", "position": 11, "name": "Caraway Seeds", "url": "' . BASE_URL . '/products/seeds/caraway-seeds"}
            ]
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Products', 'Oil Seeds']);
    }
    
    private function getPowdersStructuredData() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "Premium Spice Powders",
          "description": "Finely ground spice powders from India",
          "url": "' . BASE_URL . '/products/powders",
          "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
              {"@type": "ListItem", "position": 1, "name": "Turmeric Powder", "url": "' . BASE_URL . '/products/powders/turmeric-powder"},
              {"@type": "ListItem", "position": 2, "name": "Coriander Powder", "url": "' . BASE_URL . '/products/powders/coriander-powder"},
              {"@type": "ListItem", "position": 3, "name": "Garlic Powder", "url": "' . BASE_URL . '/products/powders/garlic-powder"},
              {"@type": "ListItem", "position": 4, "name": "Mango Powder (Amchur)", "url": "' . BASE_URL . '/products/powders/mango-powder"},
              {"@type": "ListItem", "position": 5, "name": "Garam Masala", "url": "' . BASE_URL . '/products/powders/garam-masala"},
              {"@type": "ListItem", "position": 6, "name": "Nutmeg Powder", "url": "' . BASE_URL . '/products/powders/nutmeg-powder"},
              {"@type": "ListItem", "position": 7, "name": "Black Pepper Powder", "url": "' . BASE_URL . '/products/powders/black-pepper-powder"},
              {"@type": "ListItem", "position": 8, "name": "White Pepper Powder", "url": "' . BASE_URL . '/products/powders/white-pepper-powder"},
              {"@type": "ListItem", "position": 9, "name": "Clove Powder", "url": "' . BASE_URL . '/products/powders/clove-powder"},
              {"@type": "ListItem", "position": 10, "name": "Red Chilli Powder", "url": "' . BASE_URL . '/products/powders/red-chilli-powder"},
              {"@type": "ListItem", "position": 11, "name": "Ginger Powder", "url": "' . BASE_URL . '/products/powders/ginger-powder"}
            ]
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Products', 'Spice Powders']);
    }
    
    private function getBreadcrumbStructuredData($items) {
        $breadcrumbs = [];
        $position = 1;
        $urls = ['/' => BASE_URL . '/'];
        
        foreach ($items as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));
            if ($item === 'Home') {
                $url = BASE_URL . '/';
            } elseif ($item === 'Products') {
                $url = BASE_URL . '/products';
            } else {
                $url = BASE_URL . '/products/' . $slug;
            }
            
            $breadcrumbs[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item,
                'item' => $url
            ];
        }
        
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": ' . json_encode($breadcrumbs) . '
        }
        </script>';
    }
}
