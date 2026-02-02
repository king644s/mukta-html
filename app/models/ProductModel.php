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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Turmeric.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Cardamom.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Cinnamon%20sticks.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Clove.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Nutmeg.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Black%20pepper.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Mace.webp',
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
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Red%20chilli.webp',
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
            'ajwain-seeds' => [
                'name' => 'Ajwain Seeds',
                'title' => 'Premium Ajwain Seeds Exporter | Carom Seeds | Mukta Exports',
                'description' => 'Export-quality ajwain seeds (carom seeds) with strong, pungent flavor and medicinal properties. Purity >99%, Moisture <8%, Oil >2%. FSSAI certified from India.',
                'keywords' => 'ajwain seeds exporter, carom seeds, ajwain wholesale India, ajwain seeds bulk',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Ajwain%20Seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Strong, pungent flavor with medicinal properties. Ajwain seeds are known for their digestive benefits and distinctive aroma. Perfect for culinary use and traditional medicine.',
                'specifications' => [
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 8%',
                    'Oil Content: Minimum 2%',
                    'Origin: India',
                    'Form: Whole seeds',
                    'Flavor: Strong, pungent, and aromatic'
                ],
                'packaging' => [
                    '25kg jute bags',
                    '50kg jute bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Hand-selected premium seeds',
                    'High oil content for maximum flavor',
                    'Strong, distinctive aroma',
                    'Free from impurities',
                    'Export-grade quality with full traceability'
                ],
                'applications' => [
                    'Culinary use in Indian dishes and breads',
                    'Spice blends and masala mixes',
                    'Traditional medicine and herbal remedies',
                    'Digestive aids and wellness products',
                    'Food processing and manufacturing'
                ]
            ],
            'cumin-seeds' => [
                'name' => 'Cumin Seeds',
                'title' => 'Premium Cumin Seeds Exporter | High Quality | Mukta Exports',
                'description' => 'High-quality cumin seeds with strong aromatic flavor, uniform size, and maximum oil content. Purity >99%, Moisture <8%.',
                'keywords' => 'cumin seeds exporter, cumin seeds wholesale, Indian cumin seeds',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Cumin%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Cumin seeds are known for their distinctive warm, earthy flavor and are a staple in Indian, Middle Eastern, and Mexican cuisines.',
                'specifications' => [
                    'Purity: >99%',
                    'Moisture: <8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg bags',
                    '50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Strong aromatic flavor',
                    'Uniform size',
                    'High oil content',
                    'Export-grade quality with full traceability'
                ],
                'applications' => [
                    'Culinary use in curries and spice blends',
                    'Oil extraction',
                    'Spice mixes',
                    'Food processing and manufacturing'
                ]
            ],
            'coriander-seeds' => [
                'name' => 'Coriander Seeds',
                'title' => 'Premium Coriander Seeds Exporter | Dhania Seeds | Mukta Exports',
                'description' => 'High-quality coriander seeds (dhania) with distinctive aroma and citrusy sweetness. Purity >99%, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'coriander seeds exporter, dhania seeds, coriander seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Coriander.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Coriander Seeds (Dhania) have a distinctive aroma and taste, that helps in enhancing the taste of a cuisine, when added. Coriander seeds are ground into a fine powder, which is then used to give flavor to the food items.',
                'specifications' => [
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'fennel-seeds' => [
                'name' => 'Fennel Seeds',
                'title' => 'Premium Fennel Seeds Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality fennel seeds with sweet, licorice-like flavor and high oil content. Available in Lime, Singapore, and Europe quality grades. Purity >99%, Moisture <10%.',
                'keywords' => 'fennel seeds exporter, fennel seeds wholesale, Indian fennel seeds',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Fennel%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Sweet, licorice-like flavor with high oil content. Available in Lime, Singapore, and Europe quality grades.',
                'specifications' => [
                    'Quality: Lime, Singapore, Europe',
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 10.00%',
                    'Oil Content: Minimum 1.5%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'fenugreek-seeds' => [
                'name' => 'Fenugreek Seeds',
                'title' => 'Premium Fenugreek Seeds Exporter | Methi Seeds | Mukta Exports',
                'description' => 'High-quality fenugreek seeds (methi) with high protein content. Protein >23%, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'fenugreek seeds exporter, methi seeds, fenugreek seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Fenugreek%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'The rhombic yellow to amber colored fenugreek seed, commonly called Methi, is frequently used in the preparation of pickles, curry powders and pastes, and is often encountered in the cuisine of the Indian subcontinent. The young leaves and sprouts of fenugreek are eaten as greens, and the fresh or dried leaves are used to flavor other dishes.',
                'specifications' => [
                    'Protein Content: Minimum 23%',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'nigella-seeds' => [
                'name' => 'Nigella Seeds',
                'title' => 'Premium Nigella Seeds Exporter | Kalonji Seeds | Mukta Exports',
                'description' => 'Export-quality nigella seeds (kalonji) with aromatic, slightly bitter, and peppery flavor. Purity >99%, Moisture <8%, Oil >1.5%. FSSAI certified from India.',
                'keywords' => 'nigella seeds exporter, kalonji seeds, nigella seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Kalonji.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Aromatic, slightly bitter, and peppery seeds with numerous health benefits. Perfect for Indian, Middle Eastern, and Mediterranean cuisines.',
                'specifications' => [
                    'Botanical Name: Nigella sativa',
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 8%',
                    'Oil Content: Minimum 1.5%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Small, black, angular seeds with uniform size',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'mustard-black' => [
                'name' => 'Mustard Seeds (Black)',
                'title' => 'Premium Black Mustard Seeds Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality black mustard seeds with pungent flavor and high oil content. Oil >35%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'black mustard seeds exporter, mustard seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Black%20mustard%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Pungent flavor with high oil content.',
                'specifications' => [
                    'Oil Content: Minimum 35%',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'mustard-brown' => [
                'name' => 'Mustard Seeds (Brown)',
                'title' => 'Premium Brown Mustard Seeds Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality brown mustard seeds with pungent flavor and high oil content. Oil >35%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'brown mustard seeds exporter, mustard seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Brown%20mustard%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Pungent flavor with high oil content.',
                'specifications' => [
                    'Oil Content: Minimum 35%',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'mustard-yellow' => [
                'name' => 'Mustard Seeds (Yellow)',
                'title' => 'Premium Yellow Mustard Seeds Exporter | High Oil Content | Mukta Exports',
                'description' => 'Export-quality yellow mustard seeds with mild flavor and high oil content. Oil >35%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'yellow mustard seeds exporter, mustard seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Yellow%20mustard%20seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Mild flavor with high oil content.',
                'specifications' => [
                    'Oil Content: Minimum 35%',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'dill-seeds' => [
                'name' => 'Dill Seeds',
                'title' => 'Premium Dill Seeds Exporter | High Quality | Mukta Exports',
                'description' => 'Export-quality dill seeds with distinctive flavor. Purity >99%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'dill seeds exporter, dill seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Dill%20Seeds.webp',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Distinctive flavor perfect for culinary applications.',
                'specifications' => [
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'caraway-seeds' => [
                'name' => 'Caraway Seeds',
                'title' => 'Premium Caraway Seeds Exporter | High Quality | Mukta Exports',
                'description' => 'Export-quality caraway seeds with distinctive flavor. Purity >99%, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'caraway seeds exporter, caraway seeds wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Cumin%20seeds.webp?updatedAt=1769595950959',
                'category' => 'Oil Seeds',
                'category_slug' => 'seeds',
                'long_description' => 'Distinctive flavor perfect for culinary applications.',
                'specifications' => [
                    'Purity: Minimum 99%',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Packaging: 25kg / 50kg bags'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ]
        ];
        
        // Powders - Add powder products here
        $this->products['powders'] = [
            'turmeric-powder' => [
                'name' => 'Turmeric Powder',
                'title' => 'Premium Turmeric Powder Exporter | High Curcumin | Mukta Exports',
                'description' => 'High curcumin turmeric powder with vibrant color, mesh 60-80. Curcumin >3%, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'turmeric powder exporter, turmeric powder wholesale, high curcumin powder',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Turmeric%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Finely ground turmeric powder with high curcumin content, perfect for culinary and health applications.',
                'specifications' => [
                    'Curcumin: >3%',
                    'Moisture: <10%',
                    'Mesh: 60-80',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'High curcumin content',
                    'Vibrant color',
                    'Fine consistency',
                    'Export-grade quality with full traceability'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Health supplements and wellness products',
                    'Natural food coloring agent',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing'
                ]
            ],
            'coriander-powder' => [
                'name' => 'Coriander Powder',
                'title' => 'Premium Coriander Powder Exporter | Finely Ground | Mukta Exports',
                'description' => 'Export-quality coriander powder with citrusy, sweet notes and preserved oils. Mesh 60-80, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'coriander powder exporter, dhania powder, coriander powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Coriander%20seeds%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Citrusy, sweet notes with preserved oils. Finely ground to mesh 60-80.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'garlic-powder' => [
                'name' => 'Garlic Powder',
                'title' => 'Premium Garlic Powder Exporter | Dry Garlic Powder | Mukta Exports',
                'description' => 'Export-quality dry garlic powder with strong pungency and fine consistency. Moisture <6%, Alliin >0.5%. FSSAI certified from India.',
                'keywords' => 'garlic powder exporter, dry garlic powder, garlic powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Dry%20garlic%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Strong pungency, fine consistency. Dehydrated and ground to perfection.',
                'specifications' => [
                    'Moisture: Maximum 6%',
                    'Alliin Content: Minimum 0.5%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'mango-powder' => [
                'name' => 'Mango Powder',
                'title' => 'Premium Mango Powder Exporter | Amchur Powder | Mukta Exports',
                'description' => 'Export-quality dry mango powder (amchur) with tangy, sour profile. Acidity >15%, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'mango powder exporter, amchur powder, mango powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Amchur%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Tangy, sour profile from sun-dried mangoes. Perfect for adding acidity to dishes.',
                'specifications' => [
                    'Acidity: Minimum 15%',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'garam-masala' => [
                'name' => 'Garam Masala',
                'title' => 'Premium Garam Masala Exporter | Traditional Blend | Mukta Exports',
                'description' => 'Export-quality garam masala with traditional blend and balanced warmth. Custom blends available. FSSAI certified from India.',
                'keywords' => 'garam masala exporter, garam masala powder, garam masala wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Garam%20masala.webp?updatedAt=1769595951076',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Traditional blend with balanced warmth. Custom blends available.',
                'specifications' => [
                    'Blend Type: Traditional Indian',
                    'Custom Blends: Available',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'nutmeg-powder' => [
                'name' => 'Nutmeg Powder',
                'title' => 'Premium Nutmeg Powder Exporter | Finely Ground | Mukta Exports',
                'description' => 'Export-quality nutmeg powder with warm, rich flavor. Mesh 60-80, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'nutmeg powder exporter, nutmeg powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Nutmeg%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Warm, rich flavor with fine consistency. Perfect for culinary applications.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'black-pepper-powder' => [
                'name' => 'Black Pepper Powder',
                'title' => 'Premium Black Pepper Powder Exporter | High Piperine | Mukta Exports',
                'description' => 'Export-quality black pepper powder with bold pungency and high piperine. Mesh 60-80, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'black pepper powder exporter, pepper powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Black%20pepper%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Bold pungency with high piperine content. Finely ground for maximum flavor.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'white-pepper-powder' => [
                'name' => 'White Pepper Powder',
                'title' => 'Premium White Pepper Powder Exporter | Finely Ground | Mukta Exports',
                'description' => 'Export-quality white pepper powder with mild heat and fine consistency. Mesh 60-80, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'white pepper powder exporter, white pepper powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/White%20pepper%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Mild heat with fine consistency. Perfect for light-colored dishes.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'clove-powder' => [
                'name' => 'Clove Powder',
                'title' => 'Premium Clove Powder Exporter | Finely Ground | Mukta Exports',
                'description' => 'Export-quality clove powder with warm, sweet flavor and high oil content. Mesh 60-80, Moisture <8%. FSSAI certified from India.',
                'keywords' => 'clove powder exporter, clove powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Clove%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Warm, sweet flavor with high oil content. Finely ground for maximum flavor.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 8%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'red-chilli-powder' => [
                'name' => 'Red Chilli Powder',
                'title' => 'Premium Red Chilli Powder Exporter | Kashmiri & Guntur | Mukta Exports',
                'description' => 'Export-quality Red Chilli Powder with vibrant color and controlled heat levels. Kashmiri, Guntur, Byadgi varieties. FSSAI certified bulk supplier from India.',
                'keywords' => 'red chilli powder exporter, lal mirch powder, Kashmiri chilli powder, Guntur chilli, deggi mirch, bulk chilli powder India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Red%20Chilli%20powder.webp',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Vibrant color with controlled heat levels. Perfect for adding spice and color.',
                'specifications' => [
                    'Heat Level: Customizable',
                    'Color: Vibrant red',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ],
            'ginger-powder' => [
                'name' => 'Ginger Powder',
                'title' => 'Premium Ginger Powder Exporter | Dry Ginger Powder | Mukta Exports',
                'description' => 'Export-quality ginger powder with warm, spicy flavor and fine consistency. Mesh 60-80, Moisture <10%. FSSAI certified from India.',
                'keywords' => 'ginger powder exporter, dry ginger powder, ginger powder wholesale India',
                'image' => 'https://ik.imagekit.io/nce7bwsse/website-assets/products/new-set/Dry%20ginger%20power.webp?updatedAt=1769595950920',
                'category' => 'Spice Powders',
                'category_slug' => 'powders',
                'long_description' => 'Warm, spicy flavor with fine consistency. Perfect for culinary and medicinal applications.',
                'specifications' => [
                    'Mesh Size: 60-80',
                    'Moisture: Maximum 10%',
                    'Origin: India',
                    'Processing: Hygienic, BRC-ready facilities'
                ],
                'packaging' => [
                    '25kg / 50kg bags',
                    'Custom packaging available',
                    'Private label packaging supported'
                ],
                'quality_features' => [
                    'Premium quality selection',
                    'Hygienic processing',
                    'Full traceability',
                    'Export-grade standards',
                    'Certified and compliant'
                ],
                'applications' => [
                    'Culinary use in various dishes',
                    'Spice blends and masala mixes',
                    'Food processing and manufacturing',
                    'Export and wholesale distribution',
                    'Private label packaging'
                ]
            ]
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
