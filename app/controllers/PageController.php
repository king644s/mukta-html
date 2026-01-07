<?php
/**
 * Page Controller
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PageModel.php';

class PageController extends Controller {
    private $pageModel;
    
    public function __construct() {
        parent::__construct();
        $this->pageModel = new PageModel();
    }
    
    public function index() {
        $pageData = $this->pageModel->getPageData('index');
        $config = $this->pageModel->getConfig();
        
        // Add structured data for homepage
        $pageData['structured_data'] = $this->getHomeStructuredData();
        
        $this->view('pages/index', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function about() {
        $pageData = $this->pageModel->getPageData('about');
        $config = $this->pageModel->getConfig();
        
        // Add structured data for about page
        $pageData['structured_data'] = $this->getAboutStructuredData();
        
        $this->view('pages/about', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function products() {
        $pageData = $this->pageModel->getPageData('products');
        $config = $this->pageModel->getConfig();
        
        // Add structured data
        $pageData['structured_data'] = $this->getProductsStructuredData();
        
        $this->view('pages/products', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function contact() {
        $pageData = $this->pageModel->getPageData('contact');
        $config = $this->pageModel->getConfig();
        
        // Add structured data
        $pageData['structured_data'] = $this->getContactStructuredData();
        
        $this->view('pages/contact', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function certificates() {
        $pageData = [
            'title' => 'Certifications & Quality Standards | Mukta Exports - FSSAI, GMP, FDA Certified',
            'description' => 'Mukta Exports holds FSSAI, GMP, FDA, Spice Board, DGFT, GST, and MSME certifications. Our export documentation meets international food safety and quality standards for global trade.',
            'keywords' => 'FSSAI certified spices, GMP certified exporter, FDA approved spices India, Spice Board registered, DGFT registered exporter, quality certified spices, food safety standards',
            'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
            'active_nav' => 'certificates',
            'structured_data' => $this->getLocalBusinessSchema() . $this->getBreadcrumbStructuredData(['Home', 'Certificates']),
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/certificates', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function blog() {
        $pageData = [
            'title' => 'Spice Industry Insights & News | Mukta Exports Blog',
            'description' => 'Expert insights on Indian spice export industry, sourcing trends, packaging innovations, and private-label solutions. Stay updated with Mukta Exports\' spice trade knowledge.',
            'keywords' => 'spice industry blog, Indian spices news, spice export trends, private label spices, spice packaging, spice sourcing, turmeric benefits, cumin uses',
            'og_image' => IMAGEKIT_CDN . '/products/whole-spices.webp',
            'active_nav' => 'blog',
            'structured_data' => $this->getLocalBusinessSchema() . $this->getBlogStructuredData(),
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/blog', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function notFound() {
        http_response_code(404);
        $pageData = [
            'title' => '404 - Page Not Found | Mukta Exports',
            'description' => 'The page you are looking for could not be found.',
            'active_nav' => 'home',
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/404', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    // Structured Data Helpers
    private function getHomeStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Mukta Exports",
          "alternateName": "Mukta Exports India",
          "url": "' . BASE_URL . '",
          "logo": "' . IMAGEKIT_CDN . '/muktalogo.svg",
          "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India. FSSAI, GMP, and FDA certified.",
          "foundingDate": "2023",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
            "addressLocality": "Dahisar East",
            "addressRegion": "Mumbai",
            "postalCode": "400068",
            "addressCountry": "IN"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "' . SITE_PHONE . '",
            "contactType": "sales",
            "email": "' . SITE_EMAIL . '",
            "availableLanguage": ["English", "Hindi"]
          },
          "sameAs": [],
          "areaServed": {
            "@type": "GeoCircle",
            "geoMidpoint": {
              "@type": "GeoCoordinates",
              "latitude": 19.2542,
              "longitude": 72.8568
            },
            "geoRadius": "50000"
          }
        }
        </script>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "Mukta Exports",
          "url": "' . BASE_URL . '",
          "description": "Premium Indian spices, seeds, and powders exporter",
          "publisher": {
            "@type": "Organization",
            "name": "Mukta Exports"
          }
        }
        </script>';
    }
    
    private function getLocalBusinessSchema() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "LocalBusiness",
          "@id": "' . BASE_URL . '/#business",
          "name": "Mukta Exports",
          "alternateName": "Mukta Exports India",
          "image": [
            "' . IMAGEKIT_CDN . '/export-hero.webp",
            "' . IMAGEKIT_CDN . '/muktalogo.svg"
          ],
          "logo": "' . IMAGEKIT_CDN . '/muktalogo.svg",
          "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India. FSSAI, GMP, and FDA certified spice exporter serving global markets.",
          "priceRange": "$$",
          "telephone": "' . SITE_PHONE . '",
          "email": "' . SITE_EMAIL . '",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
            "addressLocality": "Dahisar East",
            "addressRegion": "Maharashtra",
            "postalCode": "400068",
            "addressCountry": "IN"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 19.2542,
            "longitude": 72.8568
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
              "opens": "09:00",
              "closes": "18:00"
            }
          ],
          "url": "' . BASE_URL . '",
          "sameAs": [],
          "servesCuisine": "Indian Spices",
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Indian Spices, Seeds & Powders",
            "itemListElement": [
              {
                "@type": "OfferCatalog",
                "name": "Whole Spices",
                "url": "' . BASE_URL . '/products/spices"
              },
              {
                "@type": "OfferCatalog",
                "name": "Oil Seeds",
                "url": "' . BASE_URL . '/products/seeds"
              },
              {
                "@type": "OfferCatalog",
                "name": "Spice Powders",
                "url": "' . BASE_URL . '/products/powders"
              }
            ]
          },
          "areaServed": {
            "@type": "Country",
            "name": "Global"
          },
          "knowsAbout": [
            "Indian Spices Export",
            "Spice Sourcing",
            "Bulk Spice Supply",
            "FSSAI Certified Spices",
            "GMP Certified Exporter",
            "FDA Approved Spices"
          ]
        }
        </script>';
    }
    
    private function getAboutStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "AboutPage",
          "name": "About Mukta Exports",
          "description": "Learn about Mukta Exports - India\'s trusted spice exporter. We connect global markets with premium Indian spices through ethical sourcing and quality control.",
          "url": "' . BASE_URL . '/about",
          "mainEntity": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "founder": {
              "@type": "Person",
              "name": "Yash Ghaghda",
              "jobTitle": "Founder & Partner",
              "image": "' . IMAGEKIT_CDN . '/founder-image.webp"
            },
            "foundingDate": "2023",
            "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
              "addressLocality": "Dahisar East",
              "addressRegion": "Mumbai",
              "postalCode": "400068",
              "addressCountry": "IN"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'About']);
    }
    
    private function getProductsStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "Premium Indian Spices, Seeds & Powders",
          "description": "Complete range of premium Indian spices, oil seeds, and spice powders from Mukta Exports",
          "url": "' . BASE_URL . '/products",
          "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
              {
                "@type": "ListItem",
                "position": 1,
                "name": "Whole Spices",
                "url": "' . BASE_URL . '/products/spices",
                "description": "Premium whole spices including turmeric, cardamom, cinnamon, clove, nutmeg, and more"
              },
              {
                "@type": "ListItem",
                "position": 2,
                "name": "Oil Seeds",
                "url": "' . BASE_URL . '/products/seeds",
                "description": "High-quality oil seeds including cumin, coriander, fennel, fenugreek, and mustard seeds"
              },
              {
                "@type": "ListItem",
                "position": 3,
                "name": "Spice Powders",
                "url": "' . BASE_URL . '/products/powders",
                "description": "Finely ground spice powders including turmeric, chilli, garam masala, and custom blends"
              }
            ]
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Products']);
    }
    
    private function getContactStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "ContactPage",
          "name": "Contact Mukta Exports",
          "description": "Contact Mukta Exports for premium Indian spices, seeds, and powders. Request quotes or inquire about bulk orders.",
          "url": "' . BASE_URL . '/contact",
          "mainEntity": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "telephone": "' . SITE_PHONE . '",
            "email": "' . SITE_EMAIL . '",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
              "addressLocality": "Dahisar East",
              "addressRegion": "Mumbai",
              "postalCode": "400068",
              "addressCountry": "IN"
            },
            "openingHoursSpecification": {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
              "opens": "09:00",
              "closes": "18:00"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Contact']);
    }
    
    private function getBlogStructuredData() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Blog",
          "name": "Mukta Exports Blog",
          "description": "Expert insights on Indian spice export industry, sourcing trends, and packaging innovations",
          "url": "' . BASE_URL . '/blog",
          "publisher": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "logo": {
              "@type": "ImageObject",
              "url": "' . IMAGEKIT_CDN . '/muktalogo.svg"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Blog']);
    }
    
    private function getBreadcrumbStructuredData($items) {
        $breadcrumbs = [];
        $position = 1;
        $url = BASE_URL;
        
        foreach ($items as $item) {
            if ($item !== 'Home') {
                $url .= '/' . strtolower($item);
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
