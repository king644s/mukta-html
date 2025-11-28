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

const initLayeredPanels = () => {
  if (!ensureScrollTrigger()) return;

  const container = document.querySelector("#layered-container");
  if (!container) return;

  gsap.to(".panel:not(:last-child)", {
    yPercent: -100,
    ease: "none",
    stagger: 0.5,
    scrollTrigger: {
      trigger: "#layered-container",
      start: "top bottom",
      end: "bottom bottom",
      scrub: true,
      pin: false,
      markers: true,
    }
  });
  
  gsap.set(".panel", {
    zIndex: (i, target, targets) => targets.length - i
  });
};

const setFooterYear = () => {
  const yearTag = document.getElementById("year");
  if (!yearTag) return;

  const currentYear = new Date().getFullYear();
  yearTag.textContent = currentYear;
};

const init = () => {
  initCounters();
  initScrollAnimations();
  initBrochureDownload();
  initSmoothScroll();
  initHeroSlider();
  initDifferentiatorCardsAnimation();
  initLayeredPanels();
  setFooterYear();
};

document.addEventListener("DOMContentLoaded", init);
