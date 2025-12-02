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
      link.href = "assets/brochure.pdf";
      link.download = "Mukta-Exports-Brochure.pdf";
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

// Validation functions
const validators = {
  name: (value) => {
    if (!value || value.trim().length === 0) {
      return "Full name is required";
    }
    if (value.trim().length < 2) {
      return "Name must be at least 2 characters long";
    }
    if (value.trim().length > 100) {
      return "Name must be less than 100 characters";
    }
    if (!/^[a-zA-Z\s'-]+$/.test(value.trim())) {
      return "Name can only contain letters, spaces, hyphens, and apostrophes";
    }
    return null;
  },
  
  email: (value) => {
    if (!value || value.trim().length === 0) {
      return "Email address is required";
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(value.trim())) {
      return "Please enter a valid email address";
    }
    if (value.trim().length > 255) {
      return "Email address is too long";
    }
    return null;
  },
  
  phone: (value) => {
    if (!value || value.trim().length === 0) {
      return "Phone number is required";
    }
    // Remove spaces, dashes, parentheses, and plus signs for validation
    const cleaned = value.replace(/[\s\-\(\)\+]/g, "");
    if (!/^\d{10,15}$/.test(cleaned)) {
      return "Please enter a valid phone number (10-15 digits)";
    }
    return null;
  },
  
  company: (value) => {
    // Company is optional, but if provided, validate it
    if (value && value.trim().length > 0) {
      if (value.trim().length < 2) {
        return "Company name must be at least 2 characters long";
      }
      if (value.trim().length > 100) {
        return "Company name must be less than 100 characters";
      }
    }
    return null;
  },
  
  customerType: (value) => {
    if (!value || value === "") {
      return "Please select a customer type";
    }
    if (value !== "b2b" && value !== "individual") {
      return "Please select a valid customer type";
    }
    return null;
  },
  
  message: (value) => {
    if (!value || value.trim().length === 0) {
      return "Message is required";
    }
    if (value.trim().length < 10) {
      return "Message must be at least 10 characters long";
    }
    if (value.trim().length > 1000) {
      return "Message must be less than 1000 characters";
    }
    return null;
  }
};

const showFieldError = (input, errorMessage) => {
  // Remove existing error message
  const existingError = input.parentElement.querySelector(".invalid-feedback");
  if (existingError) {
    existingError.remove();
  }
  
  // Add error class
  input.classList.add("is-invalid");
  input.classList.remove("is-valid");
  
  // Create and insert error message
  const errorDiv = document.createElement("div");
  errorDiv.className = "invalid-feedback";
  errorDiv.textContent = errorMessage;
  input.parentElement.appendChild(errorDiv);
};

const showFieldSuccess = (input) => {
  // Remove existing error message
  const existingError = input.parentElement.querySelector(".invalid-feedback");
  if (existingError) {
    existingError.remove();
  }
  
  // Add success class
  input.classList.remove("is-invalid");
  input.classList.add("is-valid");
};

const validateField = (input, validator) => {
  const value = input.value;
  const error = validator(value);
  
  if (error) {
    showFieldError(input, error);
    return false;
  } else {
    showFieldSuccess(input);
    return true;
  }
};

const validateForm = (form) => {
  let isValid = true;
  
  // Validate name
  const nameInput = form.querySelector('input[name="name"]');
  if (nameInput && !validateField(nameInput, validators.name)) {
    isValid = false;
  }
  
  // Validate email
  const emailInput = form.querySelector('input[name="email"]');
  if (emailInput && !validateField(emailInput, validators.email)) {
    isValid = false;
  }
  
  // Validate phone
  const phoneInput = form.querySelector('input[name="phone"]');
  if (phoneInput && !validateField(phoneInput, validators.phone)) {
    isValid = false;
  }
  
  // Validate company (optional)
  const companyInput = form.querySelector('input[name="company"]');
  if (companyInput && companyInput.value.trim().length > 0) {
    if (!validateField(companyInput, validators.company)) {
      isValid = false;
    }
  }
  
  // Validate customer type
  const customerTypeInput = form.querySelector('select[name="customerType"]');
  if (customerTypeInput && !validateField(customerTypeInput, validators.customerType)) {
    isValid = false;
  }
  
  // Validate message
  const messageInput = form.querySelector('textarea[name="message"]');
  if (messageInput && !validateField(messageInput, validators.message)) {
    isValid = false;
  }
  
  return isValid;
};

const handleContactForm = (formId, messageId) => {
  const form = document.getElementById(formId);
  const messageDiv = document.getElementById(messageId);
  
  if (!form || !messageDiv) return;

  // Add real-time validation on blur
  const nameInput = form.querySelector('input[name="name"]');
  const emailInput = form.querySelector('input[name="email"]');
  const phoneInput = form.querySelector('input[name="phone"]');
  const companyInput = form.querySelector('input[name="company"]');
  const customerTypeInput = form.querySelector('select[name="customerType"]');
  const messageInput = form.querySelector('textarea[name="message"]');

  if (nameInput) {
    nameInput.addEventListener("blur", () => validateField(nameInput, validators.name));
    nameInput.addEventListener("input", () => {
      if (nameInput.classList.contains("is-invalid")) {
        validateField(nameInput, validators.name);
      }
    });
  }

  if (emailInput) {
    emailInput.addEventListener("blur", () => validateField(emailInput, validators.email));
    emailInput.addEventListener("input", () => {
      if (emailInput.classList.contains("is-invalid")) {
        validateField(emailInput, validators.email);
      }
    });
  }

  if (phoneInput) {
    phoneInput.addEventListener("blur", () => validateField(phoneInput, validators.phone));
    phoneInput.addEventListener("input", () => {
      if (phoneInput.classList.contains("is-invalid")) {
        validateField(phoneInput, validators.phone);
      }
    });
  }

  if (companyInput) {
    companyInput.addEventListener("blur", () => {
      if (companyInput.value.trim().length > 0) {
        validateField(companyInput, validators.company);
      }
    });
    companyInput.addEventListener("input", () => {
      if (companyInput.classList.contains("is-invalid") && companyInput.value.trim().length > 0) {
        validateField(companyInput, validators.company);
      }
    });
  }

  if (customerTypeInput) {
    customerTypeInput.addEventListener("change", () => validateField(customerTypeInput, validators.customerType));
  }

  if (messageInput) {
    messageInput.addEventListener("blur", () => validateField(messageInput, validators.message));
    messageInput.addEventListener("input", () => {
      if (messageInput.classList.contains("is-invalid")) {
        validateField(messageInput, validators.message);
      }
    });
  }

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    
    // Clear previous messages
    messageDiv.style.display = "none";
    
    // Validate all fields
    if (!validateForm(form)) {
      messageDiv.className = "mt-3 text-center text-danger";
      messageDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill me-2"></i>Please correct the errors in the form before submitting.';
      messageDiv.style.display = "block";
      
      // Scroll to first error
      const firstError = form.querySelector(".is-invalid");
      if (firstError) {
        firstError.scrollIntoView({ behavior: "smooth", block: "center" });
        firstError.focus();
      }
      return;
    }
    
    const formData = new FormData(form);
    const data = {
      name: formData.get("name").trim(),
      email: formData.get("email").trim(),
      phone: formData.get("phone").trim(),
      company: formData.get("company")?.trim() || "N/A",
      customerType: formData.get("customerType"),
      message: formData.get("message").trim(),
    };

    // Create mailto link with form data
    const subject = encodeURIComponent(`Contact Form Submission - ${data.customerType === "b2b" ? "B2B" : "Individual"} Customer`);
    const body = encodeURIComponent(
      `Name: ${data.name}\n` +
      `Email: ${data.email}\n` +
      `Phone: ${data.phone}\n` +
      `Company: ${data.company}\n` +
      `Customer Type: ${data.customerType === "b2b" ? "B2B Customer (Wholesale/Business)" : "Individual Customer"}\n\n` +
      `Message:\n${data.message}`
    );
    
    const mailtoLink = `mailto:info@muktaexports.com?subject=${subject}&body=${body}`;
    
    // Show success message
    messageDiv.className = "mt-3 text-center text-success";
    messageDiv.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Thank you! Your message has been prepared. Opening your email client...';
    messageDiv.style.display = "block";
    
    // Open mailto link
    window.location.href = mailtoLink;
    
    // Reset form after a delay
    setTimeout(() => {
      form.reset();
      // Remove validation classes
      form.querySelectorAll(".is-valid, .is-invalid").forEach(el => {
        el.classList.remove("is-valid", "is-invalid");
      });
      form.querySelectorAll(".invalid-feedback").forEach(el => el.remove());
      messageDiv.style.display = "none";
    }, 5000);
  });
};

const initContactForms = () => {
  handleContactForm("contactForm", "formMessage");
  handleContactForm("contactFormHome", "formMessageHome");
};

const init = () => {
  initCounters();
  initScrollAnimations();
  initBrochureDownload();
  initSmoothScroll();
  initHeroSlider();
  initDifferentiatorCardsAnimation();
  setFooterYear();
  initContactForms();
};

document.addEventListener("DOMContentLoaded", init);
