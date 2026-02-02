const animateCounter = (element) => {
  const target = Number(element.dataset.counter || 0);
  const duration = Number(element.dataset.duration || 1500);
  const startTime = performance.now();

  const update = (now) => {
    const progress = Math.min((now - startTime) / duration, 1);
    const current = Math.floor(progress * target);
    element.textContent = `${current}${element.dataset.suffix || ""}`;

    if (progress < 1) {
      requestAnimationFrame(update);
    } else {
      element.textContent = `${target}${element.dataset.suffix || ""}`;
    }
  };

  requestAnimationFrame(update);
};

const initCounters = () => {
  const counters = document.querySelectorAll("[data-counter]");
  if (!counters.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting && !entry.target.dataset.animated) {
        entry.target.dataset.animated = "true";
        animateCounter(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach((counter) => observer.observe(counter));
};

const initScrollAnimations = () => {
  const animatedBlocks = document.querySelectorAll("[data-fade]");
  if (!animatedBlocks.length) return;

  // On mobile devices, make elements visible immediately
  const isMobile = window.innerWidth <= 767;
  if (isMobile) {
    animatedBlocks.forEach((block) => {
      block.style.opacity = "1";
      block.style.transform = "none";
      block.style.visibility = "visible";
      block.classList.add("fade-in");
      
      // Also ensure all nested elements are visible
      const nestedElements = block.querySelectorAll("*");
      nestedElements.forEach((el) => {
        el.style.opacity = "1";
        el.style.transform = "none";
        el.style.visibility = "visible";
      });
    });
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in");
      }
    });
  }, { threshold: 0.25 });

  animatedBlocks.forEach((block) => observer.observe(block));
};

const initBrochureDownload = () => {
  const triggers = document.querySelectorAll('[data-download="brochure"]');
  if (!triggers.length) return;

  triggers.forEach((button) =>
    button.addEventListener("click", () => {
      const link = document.createElement("a");
      link.href = "https://ik.imagekit.io/nce7bwsse/website-assets/mukta-brochure.pdf";
      link.download = "Mukta-Exports-Brochure.pdf";
      link.target = "_blank";
      link.rel = "noopener noreferrer";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    })
  );
};

const initSmoothScroll = () => {
  const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');

  navLinks.forEach((link) =>
    link.addEventListener("click", (event) => {
      const target = document.querySelector(link.getAttribute("href"));
      if (target) {
        event.preventDefault();
        const offset = target.getBoundingClientRect().top + window.pageYOffset - 80;
        window.scrollTo({ top: offset, behavior: "smooth" });
        const collapse = document.querySelector(".navbar-collapse.show");
        if (collapse) {
          const bsCollapse = bootstrap.Collapse.getInstance(collapse);
          bsCollapse?.hide();
        }
      }
    })
  );
};

let scrollTriggerRegistered = false;

const ensureScrollTrigger = () => {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return false;
  }

  if (!scrollTriggerRegistered) {
    gsap.registerPlugin(ScrollTrigger);
    scrollTriggerRegistered = true;
  }

  return true;
};

const heroCopyElements = {
  eyebrow: null,
  heading: null,
  lead: null,
  support: null,
};

const hydrateHeroCopyRefs = () => {
  heroCopyElements.eyebrow = heroCopyElements.eyebrow || document.querySelector(".hero-eyebrow");
  heroCopyElements.heading = heroCopyElements.heading || document.querySelector(".hero-heading");
  heroCopyElements.lead = heroCopyElements.lead || document.querySelector(".hero-lead");
  heroCopyElements.support = heroCopyElements.support || document.querySelector(".hero-support");
};

const setHeroCopyFromSlide = (slide) => {
  hydrateHeroCopyRefs();
  if (!slide) return;

  const { eyebrow, heading, lead, support } = heroCopyElements;
  if (eyebrow && slide.dataset.eyebrow) {
    eyebrow.textContent = slide.dataset.eyebrow;
  }
  if (heading && slide.dataset.title) {
    heading.textContent = slide.dataset.title;
  }
  if (lead && slide.dataset.lead) {
    lead.textContent = slide.dataset.lead;
  }
  if (support && slide.dataset.support) {
    support.textContent = slide.dataset.support;
  }
};

const initHeroSlider = () => {
  const slider = document.querySelector(".hero-slider");
  if (!slider || typeof Swiper === "undefined") return;

  const prevEl = document.querySelector(".hero-arrow-prev");
  const nextEl = document.querySelector(".hero-arrow-next");
  const paginationEl = document.querySelector(".hero-dots");

  const swiper = new Swiper(slider, {
    loop: true,
    effect: "fade",
    speed: 900,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    allowTouchMove: true,
    fadeEffect: { crossFade: true },
    navigation: prevEl && nextEl ? { prevEl, nextEl } : undefined,
    pagination: paginationEl
      ? {
          el: paginationEl,
          clickable: true,
        }
      : undefined,
    on: {
      init(instance) {
        setHeroCopyFromSlide(instance.slides[instance.activeIndex]);
      },
      slideChangeTransitionStart(instance) {
        setHeroCopyFromSlide(instance.slides[instance.activeIndex]);
      },
    },
  });

  // Ensure initial state is set even if Swiper init callback hasn't fired yet.
  setHeroCopyFromSlide(swiper.slides[swiper.activeIndex]);
};

const setDifferentiatorLayoutHeight = () => {
  const layout = document.querySelector(".differentiator-layout");
  const scrollArea = document.querySelector(".diff-scroll-area");
  const section = document.querySelector("#differentiators");
  const container = section?.querySelector(".container");
  const row = layout?.closest(".row");
  
  if (!layout || !scrollArea) return;
  
  // Ensure all parent elements have overflow visible for sticky to work
  if (section) section.style.overflow = 'visible';
  if (container) container.style.overflow = 'visible';
  if (row) row.style.overflow = 'visible';
  layout.style.overflow = 'visible';
  
  // Set the parent layout height to match the scrollable content height
  // This ensures sticky positioning works throughout the entire scroll
  const updateHeight = () => {
    if (window.innerWidth >= 992) { // Only on desktop (lg breakpoint)
      // Get the actual scroll height including all content
      const scrollHeight = scrollArea.scrollHeight;
      const wrapperHeight = scrollArea.querySelector('.diff-wrapper')?.scrollHeight || 0;
      const spacerHeight = scrollArea.querySelector('.diff-spacer')?.scrollHeight || 0;
      
      // Use the maximum height to ensure sticky works throughout
      const totalHeight = Math.max(scrollHeight, wrapperHeight + spacerHeight);
      
      if (totalHeight > 0) {
        layout.style.minHeight = `${totalHeight}px`;
      }
    } else {
      layout.style.minHeight = '';
    }
  };
  
  // Use requestAnimationFrame to ensure DOM is ready
  requestAnimationFrame(() => {
    updateHeight();
    
    // Also update after a short delay to account for GSAP animations
    setTimeout(updateHeight, 100);
    setTimeout(updateHeight, 500);
  });
  
  // Update on resize with debounce
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(updateHeight, 250);
  });
  
  // Update after images and all content load
  window.addEventListener('load', () => {
    setTimeout(updateHeight, 100);
  });
  
  // Update when GSAP ScrollTrigger refreshes
  if (typeof gsap !== 'undefined' && gsap.ScrollTrigger) {
    gsap.ScrollTrigger.addEventListener('refresh', updateHeight);
  }
};

const initDifferentiatorCardsAnimation = () => {
  if (!ensureScrollTrigger()) return;

  const wrappers = gsap.utils.toArray(".diff-card-wrapper");
  const cards = gsap.utils.toArray(".diff-card");
  
  if (!wrappers.length || !cards.length) return;

  wrappers.forEach((wrapper, i) => {
    const card = cards[i];
    if (!card) return;

    let scale = 1;
    let rotation = 0;
    
    if (i !== cards.length - 1) {
      scale = 0.9 + 0.025 * i;
      rotation = -10;
    }

    gsap.to(card, {
      scale: scale,
      rotationX: rotation,
      transformOrigin: "top center",
      ease: "none",
      scrollTrigger: {
        trigger: wrapper,
        start: "top-=100 top",
        end: "bottom-=350 top",
        endTrigger: ".diff-wrapper",
        scrub: true,
        pin: wrapper,
        pinSpacing: false,
        id: i + 1,
        // markers: true,
      },
    });
  });
};


const setFooterYear = () => {
  const yearTag = document.getElementById("year");
  if (!yearTag) return;

  const currentYear = new Date().getFullYear();
  yearTag.textContent = currentYear;
};

const handleMobileFadeElements = () => {
  if (window.innerWidth <= 767) {
    const fadeElements = document.querySelectorAll("[data-fade]");
    fadeElements.forEach((el) => {
      el.style.opacity = "1";
      el.style.transform = "none";
      el.style.visibility = "visible";
      el.classList.add("fade-in");
      
      // Also ensure all nested elements are visible
      const nestedElements = el.querySelectorAll("*");
      nestedElements.forEach((nestedEl) => {
        nestedEl.style.opacity = "1";
        nestedEl.style.transform = "none";
        nestedEl.style.visibility = "visible";
      });
    });
  }
};

// Make first row of product cards visible immediately on all screen sizes
const ensureFirstRowVisible = () => {
  const productGrids = document.querySelectorAll("[data-fade].row");
  
  productGrids.forEach((grid) => {
    // Get all column children (product cards)
    const columns = grid.querySelectorAll(":scope > [class*='col-']");
    
    // Make first 3 cards visible (first row on desktop, adjusts on smaller screens)
    const firstRowCount = 3;
    columns.forEach((col, index) => {
      if (index < firstRowCount) {
        col.style.opacity = "1";
        col.style.transform = "none";
        col.style.visibility = "visible";
        
        // Also make the card inside visible
        const card = col.querySelector(".card");
        if (card) {
          card.style.opacity = "1";
          card.style.transform = "none";
          card.style.visibility = "visible";
        }
      }
    });
  });
};

const initContactForm = () => {
  const contactForm = document.getElementById('contactForm');
  if (!contactForm) return;

  const formMessage = document.getElementById('formMessage');
  const submitButton = contactForm.querySelector('button[type="submit"]');
  const originalButtonText = submitButton?.textContent || 'Send Message';

  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    if (!submitButton) return;
    
    // Disable submit button
    submitButton.disabled = true;
    submitButton.textContent = 'Sending...';
    
    // Hide previous messages
    if (formMessage) {
      formMessage.style.display = 'none';
      formMessage.className = 'mt-3 text-center';
    }
    
    // Get form data
    const formData = new FormData(contactForm);
    
    try {
      const response = await fetch(contactForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      
      const result = await response.json();
      
      if (response.ok && result.success) {
        // Success
        if (formMessage) {
          formMessage.className = 'mt-3 text-center text-success';
          formMessage.textContent = result.message || 'Thank you! Your message has been sent successfully. We will get back to you soon.';
          formMessage.style.display = 'block';
        }
        
        // Reset form
        contactForm.reset();
        
        // Scroll to message
        if (formMessage) {
          formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      } else {
        // Error
        if (formMessage) {
          formMessage.className = 'mt-3 text-center text-danger';
          formMessage.textContent = result.message || 'Sorry, there was an error sending your message. Please try again or contact us directly.';
          formMessage.style.display = 'block';
        }
      }
    } catch (error) {
      // Network or other error
      if (formMessage) {
        formMessage.className = 'mt-3 text-center text-danger';
        formMessage.textContent = 'Sorry, there was an error sending your message. Please try again or contact us directly.';
        formMessage.style.display = 'block';
      }
    } finally {
      // Re-enable submit button
      submitButton.disabled = false;
      submitButton.textContent = originalButtonText;
    }
  });
};

const init = () => {
  // Make first row of product cards visible immediately (before any animations)
  ensureFirstRowVisible();
  
  // On mobile, immediately make all fade elements visible
  handleMobileFadeElements();
  
  initCounters();
  initScrollAnimations();
  initBrochureDownload();
  initSmoothScroll();
  initHeroSlider();
  setDifferentiatorLayoutHeight();
  initDifferentiatorCardsAnimation();
  setFooterYear();
  initContactForm();
};

// Handle window resize for responsive fade elements
let resizeTimeout;
window.addEventListener("resize", () => {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(() => {
    handleMobileFadeElements();
  }, 250);
});

// Run immediately if DOM is already loaded, otherwise wait
if (document.readyState === 'loading') {
  document.addEventListener("DOMContentLoaded", init);
} else {
  init();
}
