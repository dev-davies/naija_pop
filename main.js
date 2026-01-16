// ============================================
// Novel Homes - Main JavaScript File
// ============================================

// ============================================
// 1. Countdown Timer for Flash Deal Section
// ============================================
function initCountdownTimer() {
  const timerDiv = document.querySelector('.countdown-timer');
  
  if (!timerDiv) {
    console.warn('Countdown timer element not found');
    return;
  }

  // Set target time: 24 hours from now
  const targetTime = new Date();
  targetTime.setHours(targetTime.getHours() + 24);

  function updateTimer() {
    const now = new Date();
    const timeRemaining = targetTime - now;

    if (timeRemaining <= 0) {
      // Timer expired
      const timeValues = timerDiv.querySelectorAll('.time-value');
      timeValues.forEach(val => val.textContent = '00');
      return;
    }

    // Calculate time units
    const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Format with leading zeros
    const formattedHours = String(hours).padStart(2, '0');
    const formattedMinutes = String(minutes).padStart(2, '0');
    const formattedSeconds = String(seconds).padStart(2, '0');

    // Update DOM
    const timeValues = timerDiv.querySelectorAll('.time-value');
    if (timeValues.length >= 3) {
      timeValues[0].textContent = formattedHours;
      timeValues[1].textContent = formattedMinutes;
      timeValues[2].textContent = formattedSeconds;
    }
  }

  // Update immediately and then every second
  updateTimer();
  setInterval(updateTimer, 1000);
  
  console.log('✅ Countdown timer initialized');
}

// ============================================
// 2. Mobile Menu Toggle
// ============================================
function initMobileMenu() {
  // Create mobile menu toggle button if it doesn't exist
  const header = document.querySelector('.main-header .container');
  
  if (!header) {
    console.warn('Header not found');
    return;
  }

  // Check if toggle button already exists
  let menuToggle = document.querySelector('.mobile-menu-toggle');
  
  if (!menuToggle) {
    // Create toggle button
    menuToggle = document.createElement('button');
    menuToggle.className = 'mobile-menu-toggle';
    menuToggle.innerHTML = '☰';
    menuToggle.setAttribute('aria-label', 'Toggle navigation menu');
    
    // Insert at the beginning of header
    header.insertBefore(menuToggle, header.firstChild);
  }

  // Get the header content (navigation area)
  const headerContent = document.querySelector('.header-content');

  // Toggle menu on click
  menuToggle.addEventListener('click', function() {
    headerContent.classList.toggle('mobile-menu-active');
    
    // Change icon
    if (headerContent.classList.contains('mobile-menu-active')) {
      this.innerHTML = '✕';
    } else {
      this.innerHTML = '☰';
    }
  });

  console.log('✅ Mobile menu toggle initialized');
}

// ============================================
// 3. Add to Cart Animation
// ============================================
function initAddToCartAnimation() {
  const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
  const cartIcon = document.querySelector('.cart-link');

  if (!cartIcon) {
    console.warn('Cart icon not found');
    return;
  }

  addToCartButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      // Apply shake animation to cart icon
      cartIcon.classList.add('shake-animation');

      // Update button text temporarily
      const originalText = this.textContent;
      this.textContent = '✓ Added!';
      this.style.backgroundColor = '#00A896';

      // Update cart badge count
      const cartBadge = document.querySelector('.cart-badge');
      if (cartBadge) {
        const currentCount = parseInt(cartBadge.textContent.match(/\d+/)[0]);
        cartBadge.textContent = `${currentCount + 1} items`;
      }

      // Remove shake animation after 500ms
      setTimeout(() => {
        cartIcon.classList.remove('shake-animation');
      }, 500);

      // Reset button after 2 seconds
      setTimeout(() => {
        this.textContent = originalText;
        this.style.backgroundColor = '';
      }, 2000);
    });
  });

  console.log(`✅ Add to cart animation initialized for ${addToCartButtons.length} buttons`);
}

// ============================================
// Smooth Scroll for CTA Button
// ============================================
function initSmoothScroll() {
  const ctaBtn = document.querySelector('.cta-btn');
  
  if (ctaBtn) {
    ctaBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const targetSection = document.querySelector('#products');
      
      if (targetSection) {
        targetSection.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'start' 
        });
      }
    });
    
    console.log('✅ Smooth scroll initialized');
  }
}

// ============================================
// Initialize All Functions on Page Load
// ============================================
document.addEventListener('DOMContentLoaded', function() {
  console.log('🎉 Novel Homes - Initializing JavaScript...');
  
  // Initialize all features
  initCountdownTimer();
  initMobileMenu();
  initAddToCartAnimation();
  initSmoothScroll();
  
  console.log('✅ All scripts loaded successfully!');
});
