<?php
/**
 * Meta Tags Component
 */
$pageData = $pageData ?? [];
$config = $config ?? [];
$title = $pageData['title'] ?? 'Mukta Exports';
$description = $pageData['description'] ?? '';
$keywords = $pageData['keywords'] ?? '';

// Use dynamic canonical URL generation - always matches current page URL
// This ensures every page has a canonical tag pointing to itself, fixing Google Search Console issues
// Only override if explicitly set (for special cases like redirects)
$canonical = isset($pageData['canonical']) ? $pageData['canonical'] : getCanonicalUrl();

$ogImage = $pageData['og_image'] ?? IMAGEKIT_CDN . '/export-hero.webp';
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo htmlspecialchars($title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($description); ?>" />
<meta name="author" content="<?php echo SITE_NAME; ?>" />
<meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="google-site-verification" content="<?php echo GOOGLE_SITE_VERIFICATION; ?>" />

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>" />

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="<?php echo IMAGEKIT_CDN; ?>/mukta-icon.svg" />
<link rel="apple-touch-icon" href="<?php echo IMAGEKIT_CDN; ?>/mukta-icon.svg" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>" />
<meta property="og:title" content="<?php echo htmlspecialchars($title); ?>" />
<meta property="og:description" content="<?php echo htmlspecialchars($description); ?>" />
<meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="<?php echo SITE_NAME; ?>" />
<meta property="og:site_name" content="<?php echo SITE_NAME; ?>" />
<meta property="og:locale" content="en_US" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="<?php echo htmlspecialchars($canonical); ?>" />
<meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>" />
<meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>" />
<meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage); ?>" />

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="IN-MH" />
<meta name="geo.placename" content="Mumbai" />
<meta name="geo.position" content="19.2542;72.8568" />
<meta name="ICBM" content="19.2542, 72.8568" />

<!-- Preconnect for performance -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="preconnect" href="https://ik.imagekit.io" />
<link rel="dns-prefetch" href="https://www.googletagmanager.com" />

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_TRACKING_ID; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo GA_TRACKING_ID; ?>');
</script>
