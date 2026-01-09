<?php
/**
 * Footer Component
 */
$config = $config ?? [];
?>
    </main>

    <footer class="footer-main">
      <div class="container">
        <div class="footer-content">
          <div class="footer-section footer-brand">
            <div class="footer-brand-header">
              <img src="<?php echo IMAGEKIT_CDN; ?>/mukta-icon.svg" alt="<?php echo SITE_NAME; ?>" height="40" class="footer-logo" />
              <span class="footer-brand-name"><?php echo SITE_NAME; ?></span>
            </div>
            <p class="footer-tagline">Premium quality spices, seeds, and powders for global markets.</p>
          </div>
          
          <div class="footer-section footer-nav">
            <h5 class="footer-heading">Main Pages</h5>
            <ul class="footer-links">
              <li><a href="/#hero">Home</a></li>
              <li><a href="/about">About</a></li>
              <li><a href="/products">Products</a></li>
              <li><a href="/certificates">Certificates</a></li>
              <li><a href="/blog">Blog</a></li>
              <li style="display:none;"><a href="/brochure">E Brochure</a></li>
            </ul>
          </div>
          
          <div class="footer-section footer-nav">
            <h5 class="footer-heading">Company</h5>
            <ul class="footer-links">
              <li><a href="/contact">Contact Us</a></li>
              <li><a href="/about">About Us</a></li>
              <li><a href="/products">Services</a></li>
            </ul>
          </div>
          
          <div class="footer-section footer-contact">
            <h5 class="footer-heading">Contact</h5>
            <div class="footer-contact-info">
              <p><span>Email:</span> <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></p>
              <p><span>Phone:</span> <a href="tel:<?php echo str_replace(['-', ' '], '', SITE_PHONE); ?>"><?php echo SITE_PHONE; ?></a></p>
              <p class="footer-address">
                <?php echo SITE_ADDRESS; ?>
              </p>
            </div>
          </div>
        </div>
        
        <?php if (!isset($pageData['active_nav']) || $pageData['active_nav'] !== 'contact'): ?>
        <!-- Footer CTA - Show on all pages except contact page -->
        <div class="footer-cta">
          <div class="footer-cta-content">
            <div class="footer-cta-text">
              <h3 class="footer-cta-title">Ready to Start Your Spice Export Journey?</h3>
              <p class="footer-cta-description">Get in touch with us today for premium quality Indian spices, seeds, and powders. We're here to help with your export needs.</p>
            </div>
            <div class="footer-cta-action">
              <a href="/contact" class="footer-cta-btn">
                Contact Us <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <?php endif; ?>
        
        <div class="footer-copyright">
          <p class="mb-0">© <span id="year"><?php echo date('Y'); ?></span> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="/script.v1.js"></script>
  </body>
</html>
