/**
 * Sun Rise Sr. Sec. School, Dobhi - Hero Cinematic Multi-Pattern Mosaic Slider
 * Features unique, slow, cinematic transitions every 5 seconds (5000ms):
 *   1. Diagonal Wave Cascade (Corner-to-Corner Ripple)
 *   2. Radial Center-Out Ripple Burst
 *   3. Staggered Venetian Shutter Parallax
 *   4. Smooth Geometric Flow Assemble
 * Ultra-smooth, non-intrusive, zero-jump rotation with preloaded high-definition slides.
 */
(function() {
  function initHeroBoxSlider() {
    const slider = document.getElementById('hero-box-slider');
    if (!slider) return;

    let slides = [];
    try {
      const slidesData = slider.getAttribute('data-slides');
      if (slidesData) {
        slides = JSON.parse(slidesData);
      }
    } catch (e) {
      console.error('Error parsing hero slides data:', e);
    }

    if (!Array.isArray(slides) || slides.length === 0) return;

    const baseSlide = slider.querySelector('.hero-slide-base');
    const gridContainer = slider.querySelector('.hero-grid-container');
    const indicatorsContainer = document.getElementById('heroSliderIndicators');

    let currentIndex = 0;
    let isTransitioning = false;
    let autoPlayTimer = null;
    let isPaused = false;
    let patternCounter = 0;

    // 5.0 seconds auto-rotation interval as requested
    const SLIDE_DURATION = 5000;

    // Cache preloaded image natural dimensions
    const imgDimsCache = {};

    const heroSection = slider.closest('section');
    if (heroSection) {
      heroSection.style.paddingTop = '';
    }

    const mainImg = document.getElementById('hero-slider-img');
    if (mainImg && slides[0]) {
      mainImg.src = slides[0];
    }

    function preloadSingleSlide(src) {
      if (!src || imgDimsCache[src]) return;
      const img = new Image();
      img.onload = () => {
        imgDimsCache[src] = {
          w: img.naturalWidth || 1920,
          h: img.naturalHeight || 1080
        };
      };
      img.src = src;
    }

    // Preload all slides immediately for instant smooth rotation
    slides.forEach(src => {
      if (src) preloadSingleSlide(src);
    });

    // Set initial image on base slide
    if (baseSlide && slides.length > 0) {
      baseSlide.style.backgroundImage = `url("${slides[0]}")`;
    }

    // Build indicator dots
    if (indicatorsContainer && slides.length > 1) {
      indicatorsContainer.innerHTML = '';
      slides.forEach((_, idx) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'hero-slider-dot' + (idx === 0 ? ' active' : '');
        dot.setAttribute('aria-label', `View slide ${idx + 1}`);
        dot.title = `Slide ${idx + 1}`;
        dot.addEventListener('click', (e) => {
          e.preventDefault();
          if (isTransitioning || idx === currentIndex) return;
          resetTimer();
          goToSlide(idx);
        });
        indicatorsContainer.appendChild(dot);
      });
    }

    function updateIndicators(index) {
      if (!indicatorsContainer) return;
      const dots = indicatorsContainer.querySelectorAll('.hero-slider-dot');
      dots.forEach((dot, idx) => {
        dot.classList.toggle('active', idx === index);
      });
    }

    // Responsive grid configuration: balanced tiles for smooth assembly
    function getGridDimensions() {
      const w = window.innerWidth;
      if (w < 640) {
        return { cols: 4, rows: 4 }; // 16 tiles for mobile
      } else if (w < 1024) {
        return { cols: 6, rows: 4 }; // 24 tiles for tablet
      } else {
        return { cols: 8, rows: 5 }; // 40 tiles for desktop
      }
    }

    function goToSlide(nextIndex) {
      if (isTransitioning || slides.length <= 1) return;
      isTransitioning = true;

      const nextImgSrc = slides[nextIndex];
      const { cols, rows } = getGridDimensions();
      const rect = slider.getBoundingClientRect();
      const width = rect.width || window.innerWidth;
      const height = rect.height || (window.innerHeight * 0.85);

      const tileW = width / cols;
      const tileH = height / rows;

      // Scale tiles to fit exact container dimensions
      const natural = imgDimsCache[nextImgSrc] || { w: width, h: height };
      const scale = Math.max(width / natural.w, height / natural.h);
      const bgW = natural.w * scale;
      const bgH = natural.h * scale;
      const bgX = (width - bgW) / 2;
      const bgY = (height - bgH) / 2;

      // Reset grid container
      gridContainer.style.opacity = '1';
      gridContainer.innerHTML = '';

      const tiles = [];
      const cx = (cols - 1) / 2;
      const cy = (rows - 1) / 2;

      // Rotate transition pattern for unique visual variety
      const currentPattern = patternCounter % 4;
      patternCounter++;

      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          const tile = document.createElement('div');
          tile.className = 'hero-mosaic-tile';

          const x = c * tileW;
          const y = r * tileH;

          // 0.5px subpixel overlap
          tile.style.width = `${Math.ceil(tileW) + 0.5}px`;
          tile.style.height = `${Math.ceil(tileH) + 0.5}px`;
          tile.style.left = `${x}px`;
          tile.style.top = `${y}px`;

          tile.style.backgroundImage = `url("${nextImgSrc}")`;
          tile.style.backgroundColor = '#00122e';
          tile.style.backgroundSize = `${bgW.toFixed(1)}px ${bgH.toFixed(1)}px`;
          tile.style.backgroundPosition = `${(bgX - x).toFixed(1)}px ${(bgY - y).toFixed(1)}px`;

          let delay = 0;
          let startTransform = '';
          const duration = 880; // Slow, luxurious 880ms tile transition

          if (currentPattern === 0) {
            // Pattern 0: Diagonal Wave Flow (Top-Left to Bottom-Right)
            const diag = (r + c);
            delay = diag * 50;
            startTransform = 'translate3d(-12px, -12px, 0) scale(0.92)';
          } else if (currentPattern === 1) {
            // Pattern 1: Center-Out Radial Ripple Burst
            const distFromCenter = Math.hypot(c - cx, r - cy);
            delay = distFromCenter * 70;
            startTransform = 'translate3d(0, 0, 0) scale(0.85)';
          } else if (currentPattern === 2) {
            // Pattern 2: Staggered Venetian Shutter Parallax (Alternating Columns)
            const colDelay = c * 55;
            const rowOffset = (c % 2 === 0) ? -18 : 18;
            delay = colDelay + (r * 22);
            startTransform = `translate3d(0, ${rowOffset}px, 0) scale(0.94)`;
          } else {
            // Pattern 3: Reverse Diagonal Wave Flow (Bottom-Right to Top-Left)
            const reverseDiag = (rows - 1 - r) + (cols - 1 - c);
            delay = reverseDiag * 50;
            startTransform = 'translate3d(12px, 12px, 0) scale(0.92)';
          }

          tile.style.transform = startTransform;
          tile.style.opacity = '0';
          tile.style.boxShadow = 'inset 0 0 0 1px rgba(255, 255, 255, 0.15), 0 2px 10px rgba(0, 0, 0, 0.2)';

          gridContainer.appendChild(tile);

          tiles.push({
            el: tile,
            delay: delay,
            duration: duration
          });
        }
      }

      // Trigger animation smoothly
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          let maxTotalTime = 0;

          tiles.forEach(item => {
            const el = item.el;
            el.classList.add('tile-animating');
            el.style.transitionDuration = `${item.duration}ms`;
            el.style.transitionDelay = `${item.delay}ms`;

            // Final state: Slow lock-in to perfect image assembly
            el.style.transform = 'translate3d(0, 0, 0) scale(1)';
            el.style.opacity = '1';
            el.style.boxShadow = 'inset 0 0 0 0px transparent';

            const total = item.delay + item.duration;
            if (total > maxTotalTime) maxTotalTime = total;
          });

          // Handover when all tiles have finished their slow, graceful animation
          setTimeout(() => {
            if (baseSlide) {
              baseSlide.style.backgroundImage = `url("${nextImgSrc}")`;
            }

            setTimeout(() => {
              gridContainer.style.transition = 'opacity 0.25s ease';
              gridContainer.style.opacity = '0';

              setTimeout(() => {
                gridContainer.innerHTML = '';
                gridContainer.style.transition = '';
                gridContainer.style.opacity = '1';
                currentIndex = nextIndex;
                updateIndicators(currentIndex);
                isTransitioning = false;
              }, 260);
            }, 50);
          }, maxTotalTime + 30);
        });
      });
    }

    function nextSlide() {
      const nextIdx = (currentIndex + 1) % slides.length;
      goToSlide(nextIdx);
    }

    function startTimer() {
      stopTimer();
      autoPlayTimer = setInterval(() => {
        if (!document.hidden && !isTransitioning && !isPaused) {
          nextSlide();
        }
      }, SLIDE_DURATION);
    }

    function stopTimer() {
      if (autoPlayTimer) {
        clearInterval(autoPlayTimer);
        autoPlayTimer = null;
      }
    }

    function resetTimer() {
      stopTimer();
      startTimer();
    }

    // Pause on hover over hero section
    if (heroSection) {
      heroSection.addEventListener('mouseenter', () => { isPaused = true; });
      heroSection.addEventListener('mouseleave', () => { isPaused = false; });
    }

    // Tab visibility handling
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        stopTimer();
      } else {
        startTimer();
      }
    });

    // Start autoPlay loop
    startTimer();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroBoxSlider);
  } else {
    initHeroBoxSlider();
  }
})();
