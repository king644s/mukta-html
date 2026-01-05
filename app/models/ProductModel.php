<?php
/**
 * Product Model - Handles product data
 */

class ProductModel {
    private $products = [];
    
    public function __construct() {
        $this->loadProducts();
    }
    
    private function loadProducts() {
        // Spices
        $this->products['spices'] = [
            'turmeric' => [
                'name' => 'Turmeric',
                'title' => 'Premium Turmeric Fingers Exporter | High Curcumin 2.5%-5% | Mukta Exports',
                'description' => 'Export-quality Turmeric Fingers with 2.5%-5% curcumin content. Salem, Erode, Nizamabad & Alleppey varieties. Sun-dried, deep golden-yellow color. FSSAI certified from India.',
                'keywords' => 'turmeric exporter, turmeric fingers, high curcumin turmeric, Salem turmeric, Erode turmeric, Alleppey turmeric, turmeric wholesale India, organic turmeric, bulk turmeric supplier',
                'image' => 'turmeric.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Turmeric Fingers are the dried rhizomes of the Curcuma longa plant, known for their deep golden-yellow color, earthy aroma, and powerful medicinal properties. A staple in Indian kitchens and Ayurvedic medicine, turmeric is highly valued for its active compound curcumin, which has antioxidant and anti-inflammatory benefits.',
                'specifications' => [
                    'Curcumin Content: 2.5% – 5% (depending on variety)',
                    'Moisture: Maximum 10%',
                    'Varieties: Salem (3.0% - 3.5%), Erode (2.5% - 3.0%), Nizamabad (2.0% - 2.25%), Allepey (Above 5%)',
                    'Origin: India',
                    'Form: Whole fingers (sun-dried)',
                    'Color: Deep golden yellow',
                    'Aroma: Earthy, warm, and slightly bitter'
                ],
                'packaging' => [
                    '25kg jute bags',
                    '50kg jute bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Hand-selected premium fingers',
                    'High curcumin content for maximum health benefits',
                    'Sun-dried to preserve natural color and flavor',
                    'Free from additives and artificial colors',
                    'Export-grade quality with full traceability'
                ],
                'applications' => [
                    'Culinary use in curries, rice dishes, and marinades',
                    'Health supplements and wellness products',
                    'Natural food coloring agent',
                    'Spice blends and masala mixes',
                    'Pharmaceutical and cosmetic industries'
                ]
            ],
            'cardamom' => [
                'name' => 'Cardamom',
                'title' => 'Premium Green Cardamom Exporter | Extra Bold Pods | Mukta Exports',
                'description' => 'Export-quality green cardamom pods with intense aroma and uniform grading. Extra bold grade, moisture <8%. FSSAI certified from India.',
                'keywords' => 'cardamom exporter, green cardamom, cardamom pods, extra bold cardamom, cardamom wholesale India',
                'image' => 'cardamom.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Green Cardamom is one of the world\'s most expensive spices, known for its intense, sweet, and aromatic flavor. Our premium extra bold pods are carefully selected and graded to ensure consistent quality and maximum flavor.',
                'specifications' => [
                    'Grade: Extra Bold',
                    'Moisture: <8%',
                    'Origin: India',
                    'Form: Whole pods',
                    'Packaging: 10kg / 25kg bags'
                ],
                'packaging' => [
                    '10kg bags',
                    '25kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Hand-picked premium pods',
                    'Uniform size and color grading',
                    'High volatile oil content',
                    'Fresh, aromatic, and flavorful',
                    'Export-grade quality with full traceability'
                ],
                'applications' => [
                    'Spice blends and masala mixes',
                    'Beverages (tea, coffee, chai)',
                    'Desserts and confectionery',
                    'Savory dishes and curries',
                    'Pharmaceutical and aromatherapy'
                ]
            ],
            'cinnamon' => [
                'name' => 'Cinnamon',
                'title' => 'Premium Ceylon Cinnamon Exporter | Cinnamon Sticks | Mukta Exports',
                'description' => 'Export-quality Ceylon cinnamon sticks with essential oils intact. Length 5–10cm, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'cinnamon exporter, Ceylon cinnamon, cinnamon sticks, cinnamon wholesale India',
                'image' => 'cinnamon.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Ceylon cinnamon sticks are known for their delicate, sweet flavor and aromatic properties. Our premium cinnamon is carefully selected and processed to preserve its essential oils and natural flavor.',
                'specifications' => [
                    'Length: 5–10cm',
                    'Moisture: <10%',
                    'Origin: India',
                    'Form: Whole sticks'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Essential oils intact',
                    'Delicate, sweet flavor',
                    'Carefully selected and processed',
                    'Export-grade quality'
                ],
                'applications' => [
                    'Culinary use in desserts and beverages',
                    'Spice blends',
                    'Beverage industry',
                    'Confectionery products'
                ]
            ],
            'clove' => [
                'name' => 'Clove',
                'title' => 'Premium Whole Cloves Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality whole cloves with high oil content and strong aroma. Oil >15%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'clove exporter, whole cloves, clove wholesale India',
                'image' => 'clove.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Whole cloves are the dried flower buds of the clove tree, known for their warm, sweet, and aromatic flavor. Our premium cloves have high oil content for maximum flavor and aroma.',
                'specifications' => [
                    'Oil: >15%',
                    'Moisture: <8%',
                    'Origin: India',
                    'Form: Whole buds'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'High oil content',
                    'Strong aroma',
                    'Premium quality selection',
                    'Export-grade standards'
                ],
                'applications' => [
                    'Culinary use in spice blends',
                    'Beverage industry',
                    'Pharmaceutical uses',
                    'Aromatherapy'
                ]
            ],
            'nutmeg' => [
                'name' => 'Nutmeg',
                'title' => 'Premium Nutmeg Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality nutmeg with warm, rich flavor and essential oils preserved. Moisture <8%, Oil >25%. FSSAI certified from India.',
                'keywords' => 'nutmeg exporter, whole nutmeg, nutmeg wholesale India',
                'image' => 'nutmeg.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Nutmeg is known for its warm, rich flavor and aromatic properties. Our premium nutmeg is carefully selected to preserve essential oils and natural flavor.',
                'specifications' => [
                    'Moisture: <8%',
                    'Oil: >25%',
                    'Origin: India',
                    'Form: Whole seeds'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Warm, rich flavor',
                    'Essential oils preserved',
                    'Premium quality selection',
                    'Export-grade standards'
                ],
                'applications' => [
                    'Culinary use in desserts and savory dishes',
                    'Spice blends',
                    'Beverage industry',
                    'Pharmaceutical uses'
                ]
            ],
            'black-pepper' => [
                'name' => 'Black Pepper',
                'title' => 'Premium Black Pepper Exporter | High Piperine | Mukta Exports',
                'description' => 'Export-quality black pepper with bold pungency and high piperine. Piperine >5%, Moisture <12%. FSSAI certified from India.',
                'keywords' => 'black pepper exporter, whole black pepper, pepper wholesale India',
                'image' => 'black-pepper.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Black pepper is the world\'s most traded spice, known for its bold pungency and high piperine content. Our premium black pepper is sun-dried to preserve its natural flavor and heat.',
                'specifications' => [
                    'Piperine: >5%',
                    'Moisture: <12%',
                    'Origin: India',
                    'Form: Whole corns (sun-dried)'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Bold pungency',
                    'High piperine content',
                    'Sun-dried for natural flavor',
                    'Export-grade quality'
                ],
                'applications' => [
                    'Culinary use in all dishes',
                    'Spice blends',
                    'Food processing',
                    'Pharmaceutical uses'
                ]
            ],
            'mace' => [
                'name' => 'Mace',
                'title' => 'Premium Mace Exporter | Whole Blades | Mukta Exports',
                'description' => 'Export-quality mace with delicate, aromatic spice and warm, sweet flavor. Moisture <8%, Oil >12%. FSSAI certified from India.',
                'keywords' => 'mace exporter, whole mace, mace wholesale India',
                'image' => 'mace.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Mace is the delicate, lacy covering of the nutmeg seed, known for its warm, sweet flavor and aromatic properties. Our premium mace is carefully processed to preserve its essential oils.',
                'specifications' => [
                    'Moisture: <8%',
                    'Oil: >12%',
                    'Origin: India',
                    'Form: Whole blades'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Delicate, aromatic spice',
                    'Warm, sweet flavor',
                    'Essential oils preserved',
                    'Export-grade quality'
                ],
                'applications' => [
                    'Culinary use in desserts and savory dishes',
                    'Spice blends',
                    'Beverage industry',
                    'Pharmaceutical uses'
                ]
            ],
            'red-chilli' => [
                'name' => 'Dry Red Chilli',
                'title' => 'Premium Dry Red Chilli Exporter | Whole Chillies | Mukta Exports',
                'description' => 'Export-quality dry red chilli with fiery heat and vibrant color. Sun-dried whole chillies. Moisture <10%. FSSAI certified from India.',
                'keywords' => 'red chilli exporter, dry red chilli, whole chilli, chilli wholesale India',
                'image' => 'whole-chilli.webp',
                'category' => 'Whole Spices',
                'category_slug' => 'spices',
                'long_description' => 'Dry red chillies are known for their fiery heat and vibrant color. Our premium chillies are sun-dried to preserve their natural color and capsaicin content.',
                'specifications' => [
                    'Moisture: <10%',
                    'Capsaicin content: Varies by variety',
                    'Origin: Guntur, Byadgi varieties',
                    'Form: Whole chillies (sun-dried)'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Fiery heat',
                    'Vibrant color',
                    'Sun-dried for natural preservation',
                    'Export-grade quality'
                ],
                'applications' => [
                    'Culinary use in all spicy dishes',
                    'Spice blends',
                    'Food processing',
                    'Chilli powder production'
                ]
            ]
        ];
        
        // Seeds - Add seed products here
        $this->products['seeds'] = [
            'cumin-seeds' => [
                'name' => 'Cumin Seeds',
                'title' => 'Premium Cumin Seeds Exporter | High Quality | Mukta Exports',
                'description' => 'High-quality cumin seeds with strong aromatic flavor, uniform size, and maximum oil content. Purity >99%, Moisture <8%.',
                'keywords' => 'cumin seeds exporter, cumin seeds wholesale, Indian cumin seeds',
                'image' => 'cumin-seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Cumin seeds are known for their distinctive warm, earthy flavor and are a staple in Indian, Middle Eastern, and Mexican cuisines.',
                'specifications' => [
                    'Purity: >99%',
                    'Moisture: <8%',
                    'Packaging: 25kg / 50kg'
                ],
                'packaging' => [
                    '25kg bags',
                    '50kg bags',
                    'Custom packaging available'
                ],
                'quality_features' => [
                    'Strong aromatic flavor',
                    'Uniform size',
                    'High oil content'
                ],
                'applications' => [
                    'Culinary use in curries and spice blends',
                    'Oil extraction',
                    'Spice mixes'
                ]
            ],
            // Add more seeds as needed
        ];
        
        // Powders - Add powder products here
        $this->products['powders'] = [
            'turmeric-powder' => [
                'name' => 'Turmeric Powder',
                'title' => 'Premium Turmeric Powder Exporter | High Curcumin | Mukta Exports',
                'description' => 'High curcumin turmeric powder with vibrant color, mesh 60-80. Curcumin >3%, Moisture <10%.',
                'keywords' => 'turmeric powder exporter, turmeric powder wholesale, high curcumin powder',
                'image' => 'turmeric-powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Finely ground turmeric powder with high curcumin content, perfect for culinary and health applications.',
                'specifications' => [
                    'Curcumin: >3%',
                    'Moisture: <10%',
                    'Mesh: 60-80'
                ],
                'packaging' => [
                    'Custom packaging available',
                    'Private label supported'
                ],
                'quality_features' => [
                    'High curcumin content',
                    'Vibrant color',
                    'Fine consistency'
                ],
                'applications' => [
                    'Culinary use',
                    'Health supplements',
                    'Food coloring'
                ]
            ],
            // Add more powders as needed
        ];
    }
    
    public function getProduct($category, $slug) {
        if (isset($this->products[$category][$slug])) {
            return $this->products[$category][$slug];
        }
        return null;
    }
    
    public function getAllProducts($category = null) {
        if ($category) {
            return $this->products[$category] ?? [];
        }
        return $this->products;
    }
}
