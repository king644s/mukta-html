<?php
$config = $config ?? [];
?>
      <div class="container">
        <section class="text-center mx-auto mb-5" style="max-width: 720px;" data-fade>
          <h1 class="section-title mb-3">Contact Us</h1>
          <p class="text-muted-custom fs-5">Get in touch with us for inquiries about our premium spices, seeds, and powders. We're here to help with your export needs.</p>
        </section>

        <section class="mb-5" data-fade>
          <h2 class="h4 fw-semibold text-center mb-4">Contact Information</h2>
          <div class="row g-4 text-center">
            <div class="col-md-4">
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mx-auto mb-3"><i class="bi bi-envelope"></i></div>
                <h3 class="h6 fw-semibold">Email Us</h3>
                <p class="text-muted-custom small mb-0"><a href="mailto:<?php echo SITE_EMAIL; ?>" style="text-decoration: underline;"><?php echo SITE_EMAIL; ?></a></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mx-auto mb-3"><i class="bi bi-telephone"></i></div>
                <h3 class="h6 fw-semibold">Call Us</h3>
                <p class="text-muted-custom small mb-1"><a href="tel:<?php echo str_replace(['-', ' '], '', SITE_PHONE); ?>" style="text-decoration: underline;"><?php echo SITE_PHONE; ?></a></p>
                <p class="text-muted-custom small mb-0">Mon - Fri: 9:00 AM - 6:00 PM IST</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mx-auto mb-3"><i class="bi bi-geo-alt"></i></div>
                <h3 class="h6 fw-semibold">Visit Us</h3>
                <p class="text-muted-custom small mb-0"><?php echo str_replace(',', ',<br />', SITE_ADDRESS); ?></p>
              </div>
            </div>
          </div>
        </section>

        <section class="card-glow p-4 p-lg-5 mb-5" data-fade>
          <h2 class="h4 fw-semibold mb-4 text-center">Get In Touch</h2>
          <p class="text-muted-custom text-center mb-4">Fill out the form below and we'll get back to you as soon as possible.</p>
          <form id="contactForm" class="contact-form" method="POST" action="<?php echo BASE_URL; ?>/contact">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required minlength="2" maxlength="100" pattern="^[a-zA-Z\s'-]+$" placeholder="Enter your full name">
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required maxlength="255" placeholder="your.email@example.com">
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="tel" class="form-control" id="phone" name="phone" required pattern="[\d\s\-\+\(\)]{10,20}" placeholder="+91 12345 67890">
              </div>
              <div class="col-md-6">
                <label for="company" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company" name="company" maxlength="100" placeholder="Your company name (optional)">
              </div>
              <div class="col-12">
                <label for="customerType" class="form-label">I am a <span class="text-danger">*</span></label>
                <select class="form-select" id="customerType" name="customerType" required>
                  <option value="">Select...</option>
                  <option value="b2b">B2B Customer (Wholesale/Business)</option>
                  <option value="individual">Individual Customer</option>
                </select>
              </div>
              <div class="col-12">
                <label for="message" class="form-label">Message/Inquiry <span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" name="message" rows="5" required minlength="10" maxlength="1000" placeholder="Please describe your inquiry or requirements..."></textarea>
                <div class="form-text">Minimum 10 characters, maximum 1000 characters</div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
              </div>
            </div>
            <div id="formMessage" class="mt-3 text-center" style="display: none;"></div>
          </form>
        </section>

        <section class="card-glow p-4 p-lg-5" data-fade>
          <h3 class="h5 fw-semibold mb-3">Business Inquiries</h3>
          <p class="text-muted-custom mb-3">We specialize in bulk exports of premium spices, seeds, and powders. Whether you're sourcing wholesale quantities or custom blends, we can help.</p>
          <ul class="text-muted-custom">
            <li>Bulk order inquiries</li>
            <li>Custom packaging solutions</li>
            <li>Quality certifications</li>
            <li>International shipping</li>
          </ul>
        </section>
      </div>
