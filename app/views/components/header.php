<?php
/**
 * Header Component
 */
$activeNav = $pageData['active_nav'] ?? 'home';
$config = $config ?? [];
?>
<!doctype html>
<html lang="en">
  <head>
    <?php include __DIR__ . '/meta.php'; ?>
    <?php if (isset($pageData['structured_data'])): ?>
      <?php echo $pageData['structured_data']; ?>
    <?php endif; ?>
    <?php if ($activeNav === 'about'): ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <?php endif; ?>
    <link rel="stylesheet" href="/styles.v1.css" />
  </head>
  <body data-bs-spy="scroll" data-bs-target="#mainNav">
    <header class="sticky-top shadow-sm">
      <nav id="mainNav" class="navbar navbar-expand-lg bg-glass py-3">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center" href="/#hero">
            <img src="<?php echo IMAGEKIT_CDN; ?>/muktalogo.svg" alt="<?php echo SITE_NAME; ?>" height="48" class="me-2" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-3 justify-content-lg-center text-center text-lg-start">
              <li class="nav-item">
                <a class="nav-link <?php echo $activeNav === 'home' ? 'active' : ''; ?>" href="/#hero" <?php echo $activeNav === 'home' ? 'aria-current="page"' : ''; ?>>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $activeNav === 'about' ? 'active' : ''; ?>" href="/about" <?php echo $activeNav === 'about' ? 'aria-current="page"' : ''; ?>>About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo in_array($activeNav, ['products', 'spices', 'seeds', 'powders']) ? 'active' : ''; ?>" href="/products" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                  <li><a class="dropdown-item" href="/products/spices">Whole Spices</a></li>
                  <li><a class="dropdown-item" href="/products/seeds">Oil Seeds</a></li>
                  <li><a class="dropdown-item" href="/products/powders">Spice Powders</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $activeNav === 'certificates' ? 'active' : ''; ?>" href="/certificates" <?php echo $activeNav === 'certificates' ? 'aria-current="page"' : ''; ?>>Certificates</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $activeNav === 'blog' ? 'active' : ''; ?>" href="/blog" <?php echo $activeNav === 'blog' ? 'aria-current="page"' : ''; ?>>Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $activeNav === 'contact' ? 'active' : ''; ?>" href="/contact" <?php echo $activeNav === 'contact' ? 'aria-current="page"' : ''; ?>>Contact</a>
              </li>
            </ul>
            <div class="ms-lg-4 pt-3 pt-lg-0" style="display:none;">
              <a class="btn btn-primary px-4 py-2 rounded-3" href="/brochure">E Brochure</a>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <main<?php 
      $mainClass = '';
      if ($activeNav !== 'home' && !isset($pageData['is_blog_detail'])) {
        $mainClass = ' class="py-5"';
      } elseif (isset($pageData['is_blog_detail'])) {
        $mainClass = ' class="blog-detail-wrapper"';
      }
      echo $mainClass;
    ?>>
