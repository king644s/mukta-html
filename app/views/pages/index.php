<?php
/**
 * Homepage View
 */
$imagekit = IMAGEKIT_CDN;
?>
      <!-- Hero -->
      <section id="hero" class="hero-section">
        <div class="hero-slider swiper">
          <div class="swiper-wrapper">
            <div
              class="hero-slide swiper-slide"
              data-eyebrow="Authentic India"
              data-title="Mukta Exports: The Pure Essence of India"
              data-lead="Unlocking the authentic flavors of India with traceable sourcing, ethical partnerships, and export precision."
              data-support="We connect discerning kitchens worldwide to premium spices cultivated by farmers who treat soil with reverence."
            >
              <img src="<?php echo $imagekit; ?>/export-hero.webp" alt="Export ready spices" />
            </div>
            <div
              class="hero-slide swiper-slide"
              data-eyebrow="Whole Spice Masters"
              data-title="Bold Aromas Straight From The Estates"
              data-lead="From Malabar pepper to Alleppey turmeric, our whole spices travel fresh, fragrant, and fully traceable."
              data-support="Partner with a sourcing house that curates terroir-specific lots and preserves every volatile oil."
            >
              <img src="<?php echo $imagekit; ?>/spices-hero.webp" alt="Premium whole spices" />
            </div>
            <div
              class="hero-slide swiper-slide"
              data-eyebrow="Seeds & Powders"
              data-title="Precision-Milled Seeds, Powders, And Blends"
              data-lead="Oil seeds, decoctions, and ready-to-pack powders milled in BRC-ready facilities for seamless export."
              data-support="We deliver consistent granulation, microbiology compliance, and private-label-ready documentation."
            >
              <img src="<?php echo $imagekit; ?>/seeds-hero.webp" alt="High-quality seeds" />
            </div>
          </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="text-center fade-in" data-fade>
            <p class="section-eyebrow text-white-50 hero-eyebrow">Authentic India</p>
            <h1 class="hero-title hero-heading">Mukta Exports: The Pure Essence of India</h1>
            <p class="lead fw-semibold hero-lead">Unlocking the authentic flavors of India with traceable sourcing, ethical partnerships, and export precision.</p>
            <p class="fs-5 hero-support">We connect discerning kitchens worldwide to premium spices cultivated by farmers who treat soil with reverence.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
              <a href="/products/spices" class="btn btn-light btn-lg text-primary fw-semibold px-4">Explore Our Spices <i class="bi bi-arrow-up-right ms-2"></i></a>
              <a href="/contact" class="btn btn-outline-light btn-lg fw-semibold px-4">Contact Our Team</a>
            </div>
          </div>
        </div>
        <div class="hero-controls">
          <div class="hero-arrows">
            <button class="hero-arrow hero-arrow-prev" type="button" aria-label="Previous slide">
              <i class="bi bi-arrow-left"></i>
            </button>
            <button class="hero-arrow hero-arrow-next" type="button" aria-label="Next slide">
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
          <div class="hero-dots"></div>
        </div>
      </section>

      <!-- Welcome -->
      <section id="welcome" class="py-5 py-md-6 bg-white">
        <div class="container">
          <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-fade>
              <p class="section-eyebrow mb-3">Welcome</p>
              <h2 class="section-title mb-4">Welcome to Mukta Exports</h2>
              <p class="fs-5 text-muted-custom mb-4">We are your new, trusted partner for sourcing premium-quality Indian spices. Based in India, Mukta Exports was founded to bridge the gap between our agricultural heritage and the globe's most discerning kitchens.</p>
              <p class="text-muted-custom">We are not just traders—we are culinary ambassadors dedicated to sharing vibrant, authentic flavors that make Indian cuisine globally celebrated.</p>
            </div>
            <div class="col-lg-6" data-fade>
              <div class="bg-soft p-4 p-lg-5 h-100">
                <h3 class="fw-bold mb-3">Our Vision</h3>
                <p class="text-muted-custom">To connect every international kitchen with the purest spices India has to offer through honest sourcing, respectful farmer partnerships, and a relentless focus on quality.</p>
                <div class="row text-center mt-4 g-4">
                  <div class="col-6">
                    <p class="display-5 fw-bold text-primary"><span data-counter="50" data-suffix="+">0</span></p>
                    <p class="text-muted-custom mb-0">Farmer partners</p>
                  </div>
                  <div class="col-6">
                    <p class="display-5 fw-bold text-primary"><span data-counter="10" data-suffix="+" data-duration="1800">0</span></p>
                    <p class="text-muted-custom mb-0">Countries served</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Philosophy -->
      <section id="stories" class="py-5 bg-light">
        <div class="container">
          <div class="text-center mb-5" data-fade>
            <p class="section-eyebrow mb-3">Our Philosophy</p>
            <h2 class="section-title mb-4">The "Mukta" Promise</h2>
            <p class="fs-5 text-muted-custom">Mukta (मुक्ता) means "pearl"—pure, rare, and treasured. Every batch we export is a hand-selected gem, sourced for its aroma, color, and flavor profile.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4" data-fade>
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mb-4"><i class="bi bi-droplet fs-4"></i></div>
                <h5 class="fw-bold mb-3">Purity First</h5>
                <p class="text-muted-custom mb-0">Premium flavors come from the purest sources. Our farmers prioritize organic practices, traceability, and respect for the soil.</p>
              </div>
            </div>
            <div class="col-md-4" data-fade>
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mb-4"><i class="bi bi-people fs-4"></i></div>
                <h5 class="fw-bold mb-3">Human Partnerships</h5>
                <p class="text-muted-custom mb-0">We nurture transparent, sustainable relationships so every community we work with thrives alongside us.</p>
              </div>
            </div>
            <div class="col-md-4" data-fade>
              <div class="card-glow p-4 h-100">
                <div class="icon-pill mb-4"><i class="bi bi-patch-check fs-4"></i></div>
                <h5 class="fw-bold mb-3">Global Confidence</h5>
                <p class="text-muted-custom mb-0">Every shipment carries certifications, lab reports, and compliance documentation for smooth trade.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Mission -->
      <section class="py-5 bg-white">
        <div class="container text-center" data-fade>
          <p class="section-eyebrow mb-3">Our Mission</p>
          <h2 class="section-title mb-4">To be the world's most trusted source for premium Indian spices.</h2>
          <p class="fs-5 text-muted-custom">We commit to uncompromising quality, transparent sourcing, and sustainable farmer partnerships. From soil to shipment, every decision honors authenticity, safety, and flavor.</p>
        </div>
      </section>

      <!-- Differentiators -->
      <section id="differentiators" class="py-5 bg-light border-top border-bottom">
        <div class="container">
          <div class="row g-lg-5 differentiator-layout">
            <div class="col-lg-5">
              <div class="mb-4" data-fade>
                <p class="section-eyebrow mb-3 text-lg-start text-center">What Makes Us Different?</p>
                <h2 class="section-title mb-3">Tradition, traceability, and export rigor.</h2>
                <p class="text-muted-custom fs-5">We marry generational sourcing wisdom with export discipline so your procurement, QA, and brand teams can trust every dispatch.</p>
              </div>
              <ul class="list-unstyled text-muted-custom fw-semibold small differentiator-points">
                <li><i class="bi bi-check2-circle text-primary me-2"></i>Direct farm partnerships across 7 agro-climatic zones.</li>
                <li><i class="bi bi-check2-circle text-primary me-2"></i>On-site QC labs + third-party verification before sailing.</li>
                <li><i class="bi bi-check2-circle text-primary me-2"></i>Private-label playbooks that compress lead times.</li>
              </ul>
            </div>
            <div class="col-lg-7">
              <div class="diff-scroll-area">
                <div class="diff-wrapper">
                  <div class="diff-cards">
                    <div class="diff-card-wrapper" data-card-index="1">
                      <article class="diff-card card-one">
                        <div class="diff-card-icon">
                          <span class="icon-pill"><i class="bi bi-flower3"></i></span>
                        </div>
                        <div>
                          <p class="card-label">Field-To-Port</p>
                          <h3>Direct & Ethical Sourcing</h3>
                          <p>We contract-grow in Kerala, Andhra, and Rajasthan to lock in freshness, traceability, and fair premiums for farmers.</p>
                        </div>
                      </article>
                    </div>
                    <div class="diff-card-wrapper" data-card-index="2">
                      <article class="diff-card card-two">
                        <div class="diff-card-icon">
                          <span class="icon-pill"><i class="bi bi-shield-check"></i></span>
                        </div>
                        <div>
                          <p class="card-label">Guarded Quality</p>
                          <h3>Uncompromising Lab Control</h3>
                          <p>ISO, FSSAI, and EU compliance reports accompany every lot, with aflatoxin, moisture, and volatile oil audits on record.</p>
                        </div>
                      </article>
                    </div>
                    <div class="diff-card-wrapper" data-card-index="3">
                      <article class="diff-card card-three">
                        <div class="diff-card-icon">
                          <span class="icon-pill"><i class="bi bi-globe2"></i></span>
                        </div>
                        <div>
                          <p class="card-label">Global Operators</p>
                          <h3>Logistics With Local Roots</h3>
                          <p>We navigate certificates of origin, phyto, fumigation, and last-mile drayage so your warehouse receives ready-to-pack goods.</p>
                        </div>
                      </article>
                    </div>
                    <div class="diff-card-wrapper" data-card-index="4">
                      <article class="diff-card card-four">
                        <div class="diff-card-icon">
                          <span class="icon-pill"><i class="bi bi-box-seam"></i></span>
                        </div>
                        <div>
                          <p class="card-label">Private Label+</p>
                          <h3>Packaging & Compliance Studio</h3>
                          <p>Custom bottle, pouch, or bulk specs with artwork checks, palletization playbooks, and retailer-ready documentation.</p>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
                <div class="diff-spacer"></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Products -->
      <section id="products" class="py-5">
        <div class="container">
          <div class="text-center mb-5" data-fade>
            <p class="section-eyebrow mb-3">Our Portfolio</p>
            <h2 class="section-title mb-3">Our Products</h2>
            <p class="fs-5 text-muted-custom">We offer a curated portfolio of India's finest spices in whole, ground, and custom blends.</p>
          </div>
          <div class="row g-4 products-grid">
            <div class="col-md-4" data-fade>
              <div class="card h-100">
                <img src="<?php echo $imagekit; ?>/spices-hero.webp" class="card-img-top" alt="Whole spices" />
                <div class="card-body">
                  <h5 class="card-title fw-bold">Whole Spices</h5>
                  <p class="card-text text-muted-custom">Turmeric, cardamom, cinnamon, nutmeg, cloves, and more with intact essential oils.</p>
                  <a class="btn btn-link px-0" href="/contact">View catalog <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-4" data-fade>
              <div class="card h-100">
                <img src="<?php echo $imagekit; ?>/seeds-hero.webp" class="card-img-top" alt="Seeds" />
                <div class="card-body">
                  <h5 class="card-title fw-bold">Seeds</h5>
                  <p class="card-text text-muted-custom">Cumin, mustard, fennel, fenugreek, coriander, and custom seed mixes for global palates.</p>
                  <a class="btn btn-link px-0" href="/contact">Source with us <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-4" data-fade>
              <div class="card h-100">
                <img src="<?php echo $imagekit; ?>/powders-hero.webp" class="card-img-top" alt="Spice powders" />
                <div class="card-body">
                  <h5 class="card-title fw-bold">Powders & Blends</h5>
                  <p class="card-text text-muted-custom">Finely milled turmeric, chilli, garam masala, garlic, onion, and bespoke blends.</p>
                  <a class="btn btn-link px-0" href="/contact">Request samples <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-5" data-fade>
            <div class="col-lg-10 mx-auto">
              <p class="fw-semibold mb-3">Our flagship varieties:</p>
              <ul class="check-list row g-3">
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Fiery Red Chillies (Guntur, Byadgi)</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Aromatic Black Pepper (Malabar, Tellicherry)</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Golden Turmeric (Alleppey, Salem)</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Fragrant Cardamom (Green & Black)</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Rich Cumin & Coriander</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Delicate Mace & Nutmeg</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Premium Ajwain Seeds</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Dry Ginger Powder</li>
                <li class="col-md-6"><i class="bi bi-check-circle-fill"></i> Custom blends tailored for your market</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <!-- Partner CTA -->
      <section id="contact" class="py-5 bg-white">
        <div class="container">
          <div class="partner-cta" data-fade>
            <div class="row g-4 g-lg-5 align-items-center">
              <div class="col-lg-7">
                <p class="section-eyebrow mb-3">Partner With Us</p>
                <h2 class="section-title mb-4">Mukta Exports is more than a supplier—we are your partner in flavor.</h2>
                <p class="fs-5 text-muted-custom mb-0">We build lasting relationships with importers, distributors, food processors, and retailers who share our passion for purity and authenticity.</p>
              </div>
              <div class="col-lg-5">
                <div class="partner-cta-action">
                  <button class="btn btn-primary btn-lg w-100 w-lg-auto px-5 py-3" data-download="brochure">
                    Browse Our Product Catalog <i class="bi bi-arrow-right ms-2"></i>
                  </button>
                  <p class="text-muted-custom small mt-3 mb-0 text-center text-lg-start">Request samples, pricing, and custom blends tailored to your market.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
