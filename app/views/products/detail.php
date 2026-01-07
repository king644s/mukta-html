<?php
$imagekit = IMAGEKIT_CDN;
$categoryName = $product['category'];
$categorySlug = $product['category_slug'];
?>
      <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4" data-fade>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/products">Products</a></li>
            <li class="breadcrumb-item"><a href="/products/<?php echo $categorySlug; ?>"><?php echo $categoryName; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
          </ol>
        </nav>

        <div class="row g-5">
          <!-- Product Image -->
          <div class="col-lg-6" data-fade>
            <div class="product-image-wrapper">
              <img src="<?php echo (strpos($product['image'], 'http') === 0) ? $product['image'] : $imagekit . '/products/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid rounded-3 shadow-sm" />
            </div>
          </div>

          <!-- Product Details -->
          <div class="col-lg-6" data-fade>
            <h1 class="section-title mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="text-muted-custom fs-5 mb-4"><?php echo htmlspecialchars($product['long_description']); ?></p>

            <?php if (!empty($product['specifications'])): ?>
            <div class="card-glow p-4 mb-4">
              <h3 class="h5 fw-semibold mb-3">Product Specifications</h3>
              <ul class="list-unstyled mb-0">
                <?php foreach ($product['specifications'] as $spec): ?>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i><strong><?php echo htmlspecialchars($spec); ?></strong></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($product['packaging'])): ?>
            <div class="card-glow p-4 mb-4">
              <h3 class="h5 fw-semibold mb-3">Packaging Options</h3>
              <ul class="list-unstyled mb-0">
                <?php foreach ($product['packaging'] as $pkg): ?>
                <li class="mb-2"><i class="bi bi-box-seam text-primary me-2"></i><?php echo htmlspecialchars($pkg); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <div class="d-flex flex-column flex-sm-row gap-3">
              <a href="/contact" class="btn btn-primary btn-lg px-4">Request Quote</a>
              <a href="/products/<?php echo $categorySlug; ?>" class="btn btn-outline-primary btn-lg px-4">View All <?php echo $categoryName; ?></a>
            </div>
          </div>
        </div>

        <!-- Product Details Section -->
        <?php if (!empty($product['quality_features']) || !empty($product['applications'])): ?>
        <section class="mt-5" data-fade>
          <div class="row g-4">
            <?php if (!empty($product['quality_features'])): ?>
            <div class="col-md-6">
              <div class="card-glow p-4 h-100">
                <h3 class="h5 fw-semibold mb-3"><i class="bi bi-flower3 text-primary me-2"></i>Quality Features</h3>
                <ul class="text-muted-custom mb-0">
                  <?php foreach ($product['quality_features'] as $feature): ?>
                  <li><?php echo htmlspecialchars($feature); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($product['applications'])): ?>
            <div class="col-md-6">
              <div class="card-glow p-4 h-100">
                <h3 class="h5 fw-semibold mb-3"><i class="bi bi-globe2 text-primary me-2"></i>Applications</h3>
                <ul class="text-muted-custom mb-0">
                  <?php foreach ($product['applications'] as $app): ?>
                  <li><?php echo htmlspecialchars($app); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </section>
        <?php endif; ?>

        <!-- Certifications -->
        <section class="mt-5" data-fade>
          <div class="card-glow p-4">
            <h3 class="h5 fw-semibold mb-3">Certifications & Compliance</h3>
            <p class="text-muted-custom mb-3">Our products meet international quality standards and come with complete documentation:</p>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <div class="text-center p-3 bg-soft rounded">
                  <i class="bi bi-shield-check fs-3 text-primary mb-2 d-block"></i>
                  <p class="small mb-0 fw-semibold">FSSAI</p>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="text-center p-3 bg-soft rounded">
                  <i class="bi bi-shield-check fs-3 text-primary mb-2 d-block"></i>
                  <p class="small mb-0 fw-semibold">ISO 9001:2015</p>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="text-center p-3 bg-soft rounded">
                  <i class="bi bi-shield-check fs-3 text-primary mb-2 d-block"></i>
                  <p class="small mb-0 fw-semibold">HACCP</p>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="text-center p-3 bg-soft rounded">
                  <i class="bi bi-shield-check fs-3 text-primary mb-2 d-block"></i>
                  <p class="small mb-0 fw-semibold">EU Compliant</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
