/**
 * Sun Rise Sr. Sec. School, Dobhi - Main JavaScript Controller
 * Lightbox, Mobile Navigation Drawer, FAQs, and Dynamic Gallery Handlers
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeaderOffsetSync();
  initMobileMenu();
  initNavDropdowns();
  initHeaderModals();
  initLightbox();
  initToppersModal();
  initHashSmoothScroll();
  initActiveSectionScrollSpy();
});

/* --------------------------------------------------------------------------
   Header Modals: Student Login & Mandatory Disclosure
   -------------------------------------------------------------------------- */
function initHeaderModals() {
  const loginModal = document.getElementById('studentLoginModal');
  const disclosureModal = document.getElementById('mandatoryDisclosureModal');

  const openLoginBtns = [
    document.getElementById('topNavStudentLogin'),
    document.getElementById('mobileStudentLoginBtn'),
    document.getElementById('footerStudentLoginBtn')
  ];

  const openDisclosureBtns = [
    document.getElementById('topNavDisclosure'),
    document.getElementById('mobileDisclosureBtn'),
    document.getElementById('footerDisclosureBtn')
  ];

  const closeLoginBtn = document.getElementById('closeStudentLoginModal');
  const closeDisclosureBtn = document.getElementById('closeDisclosureModal');

  function openModal(modal) {
    if (!modal) return;
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  openLoginBtns.forEach(btn => {
    if (btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const drawer = document.getElementById('mobileNavDrawer');
        const overlay = document.getElementById('mobileNavOverlay');
        if (drawer) drawer.classList.remove('open');
        if (overlay) overlay.classList.remove('open');
        openModal(loginModal);
      });
    }
  });

  openDisclosureBtns.forEach(btn => {
    if (btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const drawer = document.getElementById('mobileNavDrawer');
        const overlay = document.getElementById('mobileNavOverlay');
        if (drawer) drawer.classList.remove('open');
        if (overlay) overlay.classList.remove('open');
        openModal(disclosureModal);
      });
    }
  });

  if (closeLoginBtn) closeLoginBtn.addEventListener('click', () => closeModal(loginModal));
  if (closeDisclosureBtn) closeDisclosureBtn.addEventListener('click', () => closeModal(disclosureModal));

  [loginModal, disclosureModal].forEach(modal => {
    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal(modal);
      });
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeModal(loginModal);
      closeModal(disclosureModal);
    }
  });
}

/* --------------------------------------------------------------------------
   Desktop & Touch Navigation Dropdowns
   -------------------------------------------------------------------------- */
function initNavDropdowns() {
  const wrappers = document.querySelectorAll('.nav-dropdown-wrapper');

  wrappers.forEach(wrapper => {
    const btn = wrapper.querySelector('.nav-dropdown-btn');
    if (!btn) return;

    btn.addEventListener('click', (e) => {
      // If clicking the arrow specifically or if on a touch device without hover
      if (e.target.closest('.nav-arrow')) {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = wrapper.classList.contains('open');
        // Close all other dropdowns
        wrappers.forEach(w => {
          if (w !== wrapper) {
            w.classList.remove('open');
            const b = w.querySelector('.nav-dropdown-btn');
            if (b) b.setAttribute('aria-expanded', 'false');
          }
        });

        if (isOpen) {
          wrapper.classList.remove('open');
          btn.setAttribute('aria-expanded', 'false');
        } else {
          wrapper.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        }
      }
    });

    // Close dropdown immediately when any dropdown sublink is clicked
    const sublinks = wrapper.querySelectorAll('.nav-dropdown-item');
    sublinks.forEach(sublink => {
      sublink.addEventListener('click', () => {
        wrapper.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      });
    });
  });

  // Close dropdowns on outside click
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.nav-dropdown-wrapper')) {
      wrappers.forEach(w => {
        w.classList.remove('open');
        const b = w.querySelector('.nav-dropdown-btn');
        if (b) b.setAttribute('aria-expanded', 'false');
      });
    }
  });

  // Close dropdowns on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      wrappers.forEach(w => {
        w.classList.remove('open');
        const b = w.querySelector('.nav-dropdown-btn');
        if (b) b.setAttribute('aria-expanded', 'false');
      });
    }
  });
}

/* --------------------------------------------------------------------------
   Mobile Navigation Drawer & Accordion
   -------------------------------------------------------------------------- */
function initMobileMenu() {
  const toggleBtn = document.getElementById('mobileMenuToggle');
  const drawer = document.getElementById('mobileNavDrawer');
  const overlay = document.getElementById('mobileNavOverlay');

  if (!toggleBtn || !drawer || !overlay) return;

  const toggleIcon = toggleBtn.querySelector('.material-symbols-outlined');

  function openMenu() {
    const header = document.querySelector('.site-header');
    if (header) {
      document.documentElement.style.setProperty('--header-height', `${header.offsetHeight}px`);
    }
    drawer.scrollTop = 0;
    drawer.classList.add('open');
    overlay.classList.add('open');
    toggleBtn.classList.add('open');
    if (toggleIcon) toggleIcon.textContent = 'close';
    toggleBtn.setAttribute('aria-expanded', 'true');
    toggleBtn.setAttribute('aria-label', 'Close Navigation Menu');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    drawer.classList.remove('open');
    overlay.classList.remove('open');
    toggleBtn.classList.remove('open');
    if (toggleIcon) toggleIcon.textContent = 'menu';
    toggleBtn.setAttribute('aria-expanded', 'false');
    toggleBtn.setAttribute('aria-label', 'Open Navigation Menu');
    document.body.style.overflow = '';
  }

  function toggleMenu() {
    if (drawer.classList.contains('open')) {
      closeMenu();
    } else {
      openMenu();
    }
  }

  toggleBtn.addEventListener('click', toggleMenu);
  overlay.addEventListener('click', closeMenu);

  // Close drawer when any link inside drawer is clicked
  const drawerLinks = drawer.querySelectorAll('a');
  drawerLinks.forEach(link => {
    link.addEventListener('click', () => {
      closeMenu();
    });
  });

  // Mobile Accordion items
  const groupBtns = drawer.querySelectorAll('.mobile-nav-group-btn');
  groupBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.closest('.mobile-nav-group');
      const sublist = group ? group.querySelector('.mobile-sublinks-list') : null;
      if (!group || !sublist) return;

      const isOpen = group.classList.contains('open');

      // Toggle current group
      if (isOpen) {
        group.classList.remove('open');
        sublist.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      } else {
        group.classList.add('open');
        sublist.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // Close when pressing Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('open')) {
      closeMenu();
    }
  });
}

/* --------------------------------------------------------------------------
   Academics Curriculum Tabs Switcher
   -------------------------------------------------------------------------- */
function switchLevel(levelId) {
  // Update Buttons
  const buttons = document.querySelectorAll('.level-btn');
  buttons.forEach(btn => {
    if (btn.getAttribute('data-target') === levelId) {
      btn.classList.add('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.remove('bg-surface-container-low', 'text-primary');
    } else {
      btn.classList.remove('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.add('bg-surface-container-low', 'text-primary');
    }
  });

  // Update Content Panels
  const contents = document.querySelectorAll('.level-content');
  contents.forEach(content => {
    if (content.id === `content-${levelId}`) {
      content.classList.remove('hidden');
    } else {
      content.classList.add('hidden');
    }
  });
}

/* --------------------------------------------------------------------------
   Gallery Filtering & Lightbox Modal
   -------------------------------------------------------------------------- */
function filterGallery(category) {
  // Update Filter Buttons
  const filterBtns = document.querySelectorAll('.gallery-filter-btn');
  filterBtns.forEach(btn => {
    if (btn.getAttribute('data-filter') === category) {
      btn.classList.add('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.remove('bg-surface-container', 'text-on-surface-variant');
    } else {
      btn.classList.remove('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.add('bg-surface-container', 'text-on-surface-variant');
    }
  });

  // Filter Items
  const items = document.querySelectorAll('.gallery-item');
  items.forEach(item => {
    const itemCat = item.getAttribute('data-category');
    if (category === 'all' || itemCat === category) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

function initLightbox() {
  const modal = document.getElementById('lightboxModal');
  if (!modal) return;

  const closeBtn = document.getElementById('lightboxClose');
  if (closeBtn) {
    closeBtn.addEventListener('click', closeLightbox);
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeLightbox();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('open')) {
      closeLightbox();
    }
  });
}

function openLightbox(el) {
  const modal = document.getElementById('lightboxModal');
  const imgElement = document.getElementById('lightboxImg');
  const titleElement = document.getElementById('lightboxTitle');
  const descElement = document.getElementById('lightboxDesc');

  if (!modal) return;

  let bgUrl = '';
  const imgTag = el.querySelector('img');
  const bgDiv = el.querySelector('[style*="background-image"]');

  if (imgTag && imgTag.src) {
    bgUrl = imgTag.src;
  } else if (bgDiv) {
    const match = bgDiv.style.backgroundImage.match(/url\(["']?([^"']*)["']?\)/);
    if (match) bgUrl = match[1];
  } else if (el.style.backgroundImage) {
    const match = el.style.backgroundImage.match(/url\(["']?([^"']*)["']?\)/);
    if (match) bgUrl = match[1];
  }

  const title = el.querySelector('h3, h4') ? el.querySelector('h3, h4').innerText : '';
  const descElFound = el.querySelector('p');
  const desc = descElFound ? descElFound.innerText : '';

  if (imgElement && bgUrl) imgElement.src = bgUrl;
  if (titleElement) {
    titleElement.innerText = title;
    titleElement.style.display = title ? '' : 'none';
  }
  if (descElement) {
    descElement.innerText = desc;
    descElement.style.display = desc ? '' : 'none';
  }

  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  const modal = document.getElementById('lightboxModal');
  if (!modal) return;
  modal.classList.remove('open');
  document.body.style.overflow = '';
}

/* --------------------------------------------------------------------------
   Events Filtering
   -------------------------------------------------------------------------- */
function filterEvents(category) {
  const btns = document.querySelectorAll('.event-filter-btn');
  btns.forEach(btn => {
    if (btn.getAttribute('data-filter') === category) {
      btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.remove('bg-surface-container-high', 'text-on-surface');
    } else {
      btn.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.add('bg-surface-container-high', 'text-on-surface');
    }
  });

  const cards = document.querySelectorAll('.event-card');
  cards.forEach(card => {
    const cardCat = card.getAttribute('data-category');
    if (category === 'all' || cardCat === category) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

/* --------------------------------------------------------------------------
   FAQ Accordion Toggle
   -------------------------------------------------------------------------- */
function toggleFaq(button) {
  const panel = button.nextElementSibling;
  const icon = button.querySelector('.material-symbols-outlined');

  if (panel.classList.contains('hidden')) {
    panel.classList.remove('hidden');
    if (icon) icon.innerText = 'remove';
    button.classList.add('text-[#C9A24B]');
  } else {
    panel.classList.add('hidden');
    if (icon) icon.innerText = 'add';
    button.classList.remove('text-[#C9A24B]');
  }
}

/* --------------------------------------------------------------------------
   Welcome Toppers Announcement Popup Modal
   -------------------------------------------------------------------------- */
function initToppersModal() {
  const modal = document.getElementById('toppersModal');
  const overlay = document.getElementById('toppersOverlay');
  const closeBtn = document.getElementById('toppersModalClose');
  const dismissBtn = document.getElementById('toppersModalDismiss');

  if (!modal) return;

  function openModal() {
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (dismissBtn) dismissBtn.addEventListener('click', closeModal);
  if (overlay) overlay.addEventListener('click', closeModal);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('open')) {
      closeModal();
    }
  });

  // Automatically trigger popup when website opens (after short delay for smooth entrance)
  setTimeout(() => {
    openModal();
  }, 600);
}

/* --------------------------------------------------------------------------
   Dynamic Header Offset Synchronizer (Prevents Navbar from Hiding Hero Content)
   -------------------------------------------------------------------------- */
function initHeaderOffsetSync() {
  const header = document.querySelector('.site-header');
  const main = document.querySelector('main');
  if (!header) return;

  function updateOffset() {
    const headerHeight = header.offsetHeight;
    if (headerHeight > 40) {
      document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
      if (main) {
        main.style.paddingTop = `${headerHeight}px`;
      }
    }
  }

  updateOffset();
  window.addEventListener('resize', updateOffset, { passive: true });
  window.addEventListener('orientationchange', updateOffset, { passive: true });
  window.addEventListener('load', updateOffset, { passive: true });
}

/* --------------------------------------------------------------------------
   Hash & Anchor Smooth Scrolling Controller with Header Offset Sync
   -------------------------------------------------------------------------- */
function initHashSmoothScroll() {
  function scrollToTarget(hash) {
    if (!hash || hash === '#') return;
    try {
      const target = document.querySelector(hash);
      if (!target) return;

      // If inside campus.php and card is currently hidden by category filter, show all cards
      if (target.classList.contains('campus-card') || target.closest('.campus-card')) {
        const card = target.classList.contains('campus-card') ? target : target.closest('.campus-card');
        card.style.display = 'flex';

        // Reset filter bar buttons if present
        const filterBtns = document.querySelectorAll('.campus-filter-btn');
        if (filterBtns.length > 0) {
          filterBtns.forEach(b => {
            b.classList.remove('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
            b.classList.add('bg-surface-pure', 'text-on-surface-variant', 'border', 'border-border-warm');
          });
          const allBtn = document.querySelector('.campus-filter-btn[data-category="all"]');
          if (allBtn) {
            allBtn.classList.add('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
            allBtn.classList.remove('bg-surface-pure', 'text-on-surface-variant', 'border', 'border-border-warm');
          }
          document.querySelectorAll('.campus-card').forEach(c => c.style.display = 'flex');
        }
      }

      // Calculate header offset
      const header = document.querySelector('.site-header');
      const headerHeight = header ? header.getBoundingClientRect().height : 90;
      const scrollBaseEl = (target.tagName === 'SPAN' && target.offsetHeight === 0 && target.parentElement)
        ? target.parentElement
        : target;
      const elementPosition = scrollBaseEl.getBoundingClientRect().top + window.pageYOffset;
      const offsetPosition = Math.max(0, elementPosition - headerHeight - 20);

      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });

      // Highlight target with glowing pulse (or parent container if target is an invisible anchor span)
      const highlightElement = (target.tagName === 'SPAN' && target.parentElement)
        ? (target.parentElement.querySelector('.rounded-3xl, .rounded-2xl, .bg-gradient-to-br') || target.parentElement)
        : target;
      highlightElement.classList.add('highlight-target');
      setTimeout(() => {
        highlightElement.classList.remove('highlight-target');
      }, 2500);
    } catch (e) {
      console.warn('Scroll to hash error:', e);
    }
  }

  // Intercept clicks on links that point to the current page with a hash
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    if (!href) return;

    const hashIndex = href.indexOf('#');
    if (hashIndex === -1) return;

    const hash = href.substring(hashIndex);
    const pathWithQuery = href.substring(0, hashIndex);
    const path = pathWithQuery.split('?')[0];
    const currentFile = window.location.pathname.split('/').pop() || 'index.php';

    // If link points to current page (e.g. "gallery.php?cat=media#gallery-filters" or "campus.php#transport")
    if (path === '' || path === currentFile) {
      // Check if URL has a cat parameter for gallery filtering
      const urlMatch = href.match(/[?&]cat=([^&#]+)/);
      if (urlMatch && typeof filterGallery === 'function') {
        const cat = decodeURIComponent(urlMatch[1]);
        filterGallery(cat);
      }

      const target = document.querySelector(hash);
      if (target) {
        e.preventDefault();
        history.pushState(null, null, href);
        scrollToTarget(hash);

        // Close mobile drawer
        const drawer = document.getElementById('mobileNavDrawer');
        const overlay = document.getElementById('mobileNavOverlay');
        if (drawer) drawer.classList.remove('open');
        if (overlay) overlay.classList.remove('open');
        document.body.style.overflow = '';

        // Close desktop dropdowns
        document.querySelectorAll('.nav-dropdown-wrapper').forEach(w => {
          w.classList.remove('open');
          const b = w.querySelector('.nav-dropdown-btn');
          if (b) b.setAttribute('aria-expanded', 'false');
        });
      }
    }
  });

  // Handle hash / query on initial page load / refresh
  const urlParams = new URLSearchParams(window.location.search);
  const catParam = urlParams.get('cat');
  if (catParam && typeof filterGallery === 'function') {
    filterGallery(catParam);
  }

  if (window.location.hash) {
    setTimeout(() => {
      scrollToTarget(window.location.hash);
    }, 350);
  }
}

/* --------------------------------------------------------------------------
   ScrollSpy & Hash-based Active Dropdown Section Marker
   -------------------------------------------------------------------------- */
function initActiveSectionScrollSpy() {
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  const dropdownItems = document.querySelectorAll('.nav-dropdown-item, .mobile-sublink');

  // Collect all links belonging to the current page
  const pageLinks = [];
  dropdownItems.forEach(item => {
    const href = item.getAttribute('href');
    if (!href) return;

    const hashIdx = href.indexOf('#');
    const path = (hashIdx !== -1 ? href.substring(0, hashIdx) : href).split('?')[0];
    const hash = hashIdx !== -1 ? href.substring(hashIdx) : '';

    if (path === '' || path === currentPath) {
      let targetEl = null;
      if (hash) {
        try {
          targetEl = document.querySelector(hash);
        } catch (e) {}
      }
      pageLinks.push({ item, href, hash, targetEl });
    }
  });

  if (pageLinks.length === 0) return;

  function updateActiveLink() {
    const scrollPos = window.scrollY + 140; // account for sticky header offset
    const pageHeight = document.documentElement.scrollHeight;
    const windowHeight = window.innerHeight;
    const isAtBottom = (window.scrollY + windowHeight) >= (pageHeight - 60);

    // Find all target sections with their positions
    const sectionsWithPos = pageLinks
      .filter(l => l.targetEl)
      .map(l => {
        const rect = l.targetEl.getBoundingClientRect();
        const top = rect.top + window.scrollY;
        return { ...l, top };
      })
      .sort((a, b) => a.top - b.top);

    let activeHash = '';

    if (isAtBottom && sectionsWithPos.length > 0) {
      // If at very bottom of page, activate last section
      activeHash = sectionsWithPos[sectionsWithPos.length - 1].hash;
    } else {
      // Find the latest section that we have scrolled past
      for (let i = sectionsWithPos.length - 1; i >= 0; i--) {
        if (scrollPos >= sectionsWithPos[i].top - 60) {
          activeHash = sectionsWithPos[i].hash;
          break;
        }
      }
    }

    // Apply active class
    pageLinks.forEach(l => {
      if (activeHash) {
        if (l.hash === activeHash) {
          l.item.classList.add('active');
        } else {
          l.item.classList.remove('active');
        }
      } else {
        // If scrolled above the first hashed section (e.g. top of page),
        // activate the first link that has no hash (or the first link)
        if (!l.hash || l === pageLinks[0]) {
          l.item.classList.add('active');
        } else {
          l.item.classList.remove('active');
        }
      }
    });
  }

  // Run on scroll with RAF
  let isTicking = false;
  window.addEventListener('scroll', () => {
    if (!isTicking) {
      window.requestAnimationFrame(() => {
        updateActiveLink();
        isTicking = false;
      });
      isTicking = true;
    }
  }, { passive: true });

  // Run on hashchange & initial load
  window.addEventListener('hashchange', updateActiveLink);
  updateActiveLink();
}

