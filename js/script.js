// =========================
// TIME ZONE DISPLAY
// =========================

function formatTime(date, timeZone) {
  return new Intl.DateTimeFormat("en-IN", {
    hour: "2-digit",
    minute: "2-digit",
    hour12: false,
    timeZone,
  }).format(date);
}

function updateTimes() {
  const now = new Date();
  const india = formatTime(now, "Asia/Kolkata");
  const china = formatTime(now, "Asia/Shanghai");
  const dubai = formatTime(now, "Asia/Dubai");

  const ids = [
    ["timeIndia", india],
    ["timeChina", china],
    ["timeDubai", dubai],
    ["networkIndia", india],
    ["networkChina", china],
    ["networkDubai", dubai],
  ];

  ids.forEach(([id, val]) => {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  });
}

document.addEventListener("DOMContentLoaded", function () {
  // Initial times
  updateTimes();
  setInterval(updateTimes, 60000);

  // Year in footer
  const yearNowEl = document.getElementById("yearNow");
  if (yearNowEl) {
    yearNowEl.textContent = new Date().getFullYear();
  }

  // Quote form (demo behavior)
  const quoteForm = document.querySelector("#quote form");
  if (quoteForm) {
    quoteForm.addEventListener("submit", function (e) {
      e.preventDefault();
      alert("Thank you. Your quote request has been captured for follow-up.");
    });
  }

  // =========================
  // HERO SLIDER
  // =========================

  const heroSection = document.querySelector(".ww-hero");
  const heroBg = document.querySelector(".ww-hero-bg");
  const slides = document.querySelectorAll(".hero-slide");
  const dotsContainer = document.querySelector(".ww-hero-dots");
  const prevBtn = document.querySelector("[data-hero-prev]");
  const nextBtn = document.querySelector("[data-hero-next]");

  if (!heroSection || !heroBg || slides.length === 0) {
    return;
  }

  let currentIndex = 0;
  let autoTimer = null;
  const AUTO_INTERVAL = 7000;

  // Create dots dynamically based on slides
  const dots = [];
  slides.forEach((slide, index) => {
    const dot = document.createElement("button");
    dot.type = "button";
    dot.className = "ww-hero-dot";
    dot.setAttribute("aria-label", `Go to slide ${index + 1}`);
    dot.addEventListener("click", () => {
      goToSlide(index);
      restartAutoPlay();
    });
    dots.push(dot);
    if (dotsContainer) dotsContainer.appendChild(dot);
  });

  function applyBackground(slide) {
    const bg = slide.getAttribute("data-bg");
    if (!bg) return;
    heroBg.style.backgroundImage = `url('${bg}')`;

    // Trigger fade
    heroBg.classList.remove("is-visible");
    // Use a tiny timeout to ensure the class removal is applied before re-adding
    setTimeout(() => {
      heroBg.classList.add("is-visible");
    }, 10);
  }

  function goToSlide(newIndex) {
    if (newIndex === currentIndex) return;

    slides[currentIndex].classList.remove("is-active");
    if (dots[currentIndex]) dots[currentIndex].classList.remove("is-active");

    currentIndex = (newIndex + slides.length) % slides.length;

    slides[currentIndex].classList.add("is-active");
    if (dots[currentIndex]) dots[currentIndex].classList.add("is-active");

    applyBackground(slides[currentIndex]);
  }

  function nextSlide() {
    goToSlide(currentIndex + 1);
  }

  function prevSlide() {
    goToSlide(currentIndex - 1);
  }

  function startAutoPlay() {
    autoTimer = setInterval(nextSlide, AUTO_INTERVAL);
  }

  function stopAutoPlay() {
    if (autoTimer) {
      clearInterval(autoTimer);
      autoTimer = null;
    }
  }

  function restartAutoPlay() {
    stopAutoPlay();
    startAutoPlay();
  }

  // Hook arrows
  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      nextSlide();
      restartAutoPlay();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", () => {
      prevSlide();
      restartAutoPlay();
    });
  }

  // Pause on hover for desktop
  heroSection.addEventListener("mouseenter", stopAutoPlay);
  heroSection.addEventListener("mouseleave", startAutoPlay);

  // Initialize first slide and background
  slides.forEach((slide, index) => {
    if (index === 0) {
      slide.classList.add("is-active");
    } else {
      slide.classList.remove("is-active");
    }
  });

  if (dots[0]) dots[0].classList.add("is-active");
  applyBackground(slides[0]);

  startAutoPlay();
});
