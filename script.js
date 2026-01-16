// ============================================
// Novel Homes - Naija Pop Theme
// JavaScript Interactivity
// ============================================

// ============================================
// Countdown Timer for Flash Deals
// ============================================
function updateCountdown() {
  // Set deal end time (24 hours from now for demo)
  const dealEndTime = new Date();
  dealEndTime.setHours(dealEndTime.getHours() + 24);

  function updateTimer() {
    const now = new Date().getTime();
    const distance = dealEndTime - now;

    // Calculate time units
    const hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update DOM
    const timeValues = document.querySelectorAll(".time-value");
    if (timeValues.length >= 3) {
      timeValues[0].textContent = String(hours).padStart(2, "0");
      timeValues[1].textContent = String(minutes).padStart(2, "0");
      timeValues[2].textContent = String(seconds).padStart(2, "0");
    }

    // If countdown finished
    if (distance < 0) {
      clearInterval(timerInterval);
      timeValues.forEach((val) => (val.textContent = "00"));
    }
  }

  // Update immediately and then every second
  updateTimer();
  const timerInterval = setInterval(updateTimer, 1000);
}

// ============================================
// Smooth Scroll for CTA Button
// ============================================
function initSmoothScroll() {
  const ctaBtn = document.querySelector(".cta-btn");
  if (ctaBtn) {
    ctaBtn.addEventListener("click", (e) => {
      e.preventDefault();
      const target = document.querySelector("#products");
      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  }
}

// ============================================
// Add to Cart Animation
// ============================================
function initAddToCartButtons() {
  const addToCartBtns = document.querySelectorAll(".add-to-cart-btn");

  addToCartBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      // Visual feedback
      const originalText = this.textContent;
      this.textContent = "✓ Added!";
      this.style.backgroundColor = "#00A896";

      // Update cart badge
      const cartBadge = document.querySelector(".cart-badge");
      if (cartBadge) {
        const currentCount = parseInt(cartBadge.textContent.match(/\d+/)[0]);
        cartBadge.textContent = `${currentCount + 1} items`;

        // Animate cart badge
        cartBadge.style.transform = "scale(1.3)";
        setTimeout(() => {
          cartBadge.style.transform = "scale(1)";
        }, 200);
      }

      // Reset button after 2 seconds
      setTimeout(() => {
        this.textContent = originalText;
        this.style.backgroundColor = "";
      }, 2000);
    });
  });
}

// ============================================
// Search Bar Enhancement
// ============================================
function initSearchBar() {
  const searchInput = document.querySelector(".search-bar input");
  const searchBtn = document.querySelector(".search-btn");

  if (searchInput && searchBtn) {
    searchBtn.addEventListener("click", (e) => {
      e.preventDefault();
      const query = searchInput.value.trim();

      if (query) {
        // Visual feedback
        searchBtn.textContent = "Searching...";
        setTimeout(() => {
          alert(
            `Searching for: "${query}". This will be connected to your product database.`
          );
          searchBtn.textContent = "Search";
        }, 500);
      }
    });

    // Search on Enter key
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        e.preventDefault();
        searchBtn.click();
      }
    });
  }
}

// ============================================
// Category Bubble Click Handler
// ============================================
function initCategoryBubbles() {
  const bubbles = document.querySelectorAll(".category-bubble");

  bubbles.forEach((bubble) => {
    bubble.addEventListener("click", function () {
      const category = this.querySelector(".bubble-label").textContent;
      alert(
        `Navigating to ${category} category. This will be linked to category pages.`
      );
    });
  });
}

// ============================================
// Product Card Hover Effects (Enhanced)
// ============================================
function initProductCardEffects() {
  const productCards = document.querySelectorAll(".product-card");

  productCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) rotate(1deg)";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "";
    });
  });
}

// ============================================
// Initialize All Functions on Page Load
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  console.log("🎉 Novel Homes - Naija Pop Theme Loaded!");

  // Initialize all features
  updateCountdown();
  initSmoothScroll();
  initAddToCartButtons();
  initSearchBar();
  initCategoryBubbles();
  initProductCardEffects();

  console.log("✅ All interactive features initialized successfully!");
});
