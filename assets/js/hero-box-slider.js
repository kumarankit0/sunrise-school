/**
 * Sun Rise Sr. Sec. School, Dobhi - Hero 4-Direction Box Mosaic Slider
 * Transitions hero background images using smooth animated boxes coming from 4 directions
 * Seamless assembly: Boxes collect together to form the complete image with zero jump/jhatka.
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
    const SLIDE_DURATION = 3000; // 3.0s autoplay interval (fast rotation)

    // Cache preloaded image natural dimensions
    const imgDimsCache = {};

    // Clear any leftover inline paddingTop on hero section — height is driven by hero-slider-img
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

      // Scale tiles to fit the exact container height (height of image 1) cleanly using cover math
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

      for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
          const tile = document.createElement('div');
          tile.className = 'hero-mosaic-tile';

          const x = c * tileW;
          const y = r * tileH;

          // Seamless geometry (0.5px overlap eliminates any subpixel gaps)
          tile.style.width = `${Math.ceil(tileW) + 0.5}px`;
          tile.style.height = `${Math.ceil(tileH) + 0.5}px`;
          tile.style.left = `${x}px`;
          tile.style.top = `${y}px`;

          // Each tile displays its slice of the image, perfectly fitted to Image 1's height
          tile.style.backgroundImage = `url("${nextImgSrc}")`;
          tile.style.backgroundColor = '#00122e';
          tile.style.backgroundSize = `${bgW.toFixed(1)}px ${bgH.toFixed(1)}px`;
          tile.style.backgroundPosition = `${(bgX - x).toFixed(1)}px ${(bgY - y).toFixed(1)}px`;

          // Distance from 4 outer boundaries
          const dTop = r;
          const dBottom = rows - 1 - r;
          const dLeft = c;
          const dRight = cols - 1 - c;
          const minDist = Math.min(dTop, dBottom, dLeft, dRight);

          // In-Place Mosaic Reveal: Stay 100% within container bounds (never cross container edges or overlap navbar)
          const dirX = (c < cx) ? -1 : (c > cx ? 1 : 0);
          const dirY = (r < cy) ? -1 : (r > cy ? 1 : 0);
          const startX = dirX * 12;
          const startY = dirY * 10;
          const startRotate = (dirX * dirY !== 0) ? (dirX * dirY * 4) : (dirX * 3 + dirY * 3);

          // Delay: Outer boxes start first, then smoothly cascade inward swiftly
          const delay = (minDist * 40) + (Math.abs(c - cx) * 8);
          const duration = 460; // Snappy 460ms smooth entry

          // Initial starting transform: boxes scale up and assemble strictly within container
          tile.style.transform = `translate3d(${startX}px, ${startY}px, 0) scale(0.86) rotate(${startRotate}deg)`;
          tile.style.opacity = '0';
          tile.style.boxShadow = 'inset 0 0 0 1px rgba(255, 255, 255, 0.25), 0 2px 8px rgba(0, 0, 0, 0.25)';

          gridContainer.appendChild(tile);

          tiles.push({
            el: tile,
            delay: delay,
            duration: duration
          });
        }
      }

      // Trigger animation
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          let maxTotalTime = 0;

          tiles.forEach(item => {
            const el = item.el;
            el.classList.add('tile-animating');
            el.style.transitionDuration = `${item.duration}ms`;
            el.style.transitionDelay = `${item.delay}ms`;

            // Final state: Boxes collect smoothly and lock in place to form the complete image!
            el.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
            el.style.opacity = '1';
            el.style.boxShadow = 'inset 0 0 0 0px transparent';

            const total = item.delay + item.duration;
            if (total > maxTotalTime) maxTotalTime = total;
          });

          // Handover when all boxes have collected and formed the image
          setTimeout(() => {
            // Update underlying base slide to new image
            // Note: hero-slider-img is kept on Image 1 so the container height stays
            // perfectly locked to the exact height of the 1st image across all slides!
            if (baseSlide) {
              baseSlide.style.backgroundImage = `url("${nextImgSrc}")`;
            }

            // 2. Allow 1 frame for base slide paint, then crossfade grid container smoothly
            setTimeout(() => {
              gridContainer.style.transition = 'opacity 0.18s ease';
              gridContainer.style.opacity = '0';

              // 3. Clean up tiles after smooth fade, ready for next cycle
              setTimeout(() => {
                gridContainer.innerHTML = '';
                gridContainer.style.transition = '';
                gridContainer.style.opacity = '1';
                currentIndex = nextIndex;
                updateIndicators(currentIndex);
                isTransitioning = false;
              }, 190);
            }, 40);
          }, maxTotalTime + 20);
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


    // Pause on hover over hero section (heroSection already declared above)
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
