<?php
/**
 * Page Model - Handles page data and metadata
 */

class PageModel {
    private $config;
    
    public function __construct() {
        $this->config = [
            'site_name' => SITE_NAME,
            'site_email' => SITE_EMAIL,
            'site_phone' => SITE_PHONE,
            'site_address' => SITE_ADDRESS,
            'base_url' => BASE_URL,
            'imagekit_cdn' => IMAGEKIT_CDN,
        ];
    }
    
    public function getPageData($page) {
        $pages = $this->getAllPages();
        return $pages[$page] ?? $pages['index'];
    }
    
    public function getAllPages() {
        return [
            'index' => [
                'title' => 'Mukta Exports — Premium Indian Spices, Seeds & Powders Exporter | Mumbai, India',
                'description' => 'Mukta Exports is India\'s trusted exporter of premium quality spices, seeds, and powders. We source turmeric, cardamom, cumin, black pepper, and 50+ spice varieties with FSSAI, GMP & FDA certifications for global markets.',
                'keywords' => 'Indian spice exporter, premium spices India, turmeric exporter, cardamom supplier, cumin seeds wholesale, black pepper exporter, spice powders, FSSAI certified spices, bulk spice supplier Mumbai, garam masala exporter',
                'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
                'active_nav' => 'home',
            ],
            'about' => [
                'title' => 'About Mukta Exports | Premium Indian Spice Exporter Since 2023',
                'description' => 'Learn about Mukta Exports - India\'s trusted spice exporter founded by Yash Ghaghda. We connect global markets with premium Indian spices through ethical sourcing, quality control, and transparent partnerships.',
                'keywords' => 'about Mukta Exports, Yash Ghaghda, Indian spice company, spice exporter Mumbai, ethical spice sourcing, premium spice supplier, spice trade India',
                'og_image' => IMAGEKIT_CDN . '/founder-image.webp',
                'active_nav' => 'about',
            ],
            'products' => [
                'title' => 'Premium Indian Spices, Seeds & Powders | Mukta Exports Products',
                'description' => 'Explore Mukta Exports\' complete range of premium Indian spices, oil seeds, and spice powders. Turmeric, cardamom, cumin, coriander, garam masala, and 50+ export-ready products with FSSAI certification.',
                'keywords' => 'Indian spices wholesale, turmeric powder, cumin seeds, coriander seeds, garam masala, chilli powder, cardamom, black pepper, fennel seeds, fenugreek, bulk spices India',
                'og_image' => IMAGEKIT_CDN . '/spices-hero.webp',
                'active_nav' => 'products',
            ],
            'contact' => [
                'title' => 'Contact Mukta Exports | Request Quote for Indian Spices',
                'description' => 'Contact Mukta Exports for premium Indian spices, seeds, and powders. Request quotes, samples, or inquire about bulk orders. Based in Mumbai, India. Email: info@muktaexports.com, Phone: +91 76666 66985',
                'keywords' => 'contact Mukta Exports, spice supplier contact, Indian spices quote, bulk spice order, spice exporter Mumbai, wholesale spices inquiry',
                'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
                'active_nav' => 'contact',
            ],
            'certificates' => [
                'title' => 'Certifications & Quality Standards | Mukta Exports',
                'description' => 'Mukta Exports maintains FSSAI, GMP, FDA, GST, MSME, and DGFT certifications ensuring premium quality and compliance for global spice exports.',
                'keywords' => 'FSSAI certified spices, GMP certification, FDA approved spices, spice exporter certifications, quality standards India',
                'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
                'active_nav' => 'certificates',
            ],
            'blog' => [
                'title' => 'Spice Blog | Indian Spices News & Insights | Mukta Exports',
                'description' => 'Read articles about Indian spices, export trends, culinary insights, and spice industry news from Mukta Exports.',
                'keywords' => 'spice blog, Indian spices news, spice industry insights, culinary spices, spice export trends',
                'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
                'active_nav' => 'blog',
            ],
        ];
    }
    
    public function getConfig() {
        return $this->config;
    }
}
