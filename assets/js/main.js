/**
 * Sun Rise Sr. Sec. School, Dobhi - Main JavaScript Controller
 * Lightbox, Mobile Navigation Drawer, FAQs, and Dynamic Gallery Handlers
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initNavDropdowns();
  initHeaderModals();
  initLightbox();
  initToppersModal();
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
  const closeBtn = document.getElementById('mobileMenuClose');
  const drawer = document.getElementById('mobileNavDrawer');
  const overlay = document.getElementById('mobileNavOverlay');

  if (!toggleBtn || !drawer || !overlay) return;

  function openMenu() {
    drawer.classList.add('open');
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    drawer.classList.remove('open');
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  toggleBtn.addEventListener('click', openMenu);
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);
  overlay.addEventListener('click', closeMenu);

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

  const title = el.querySelector('h3, h4') ? el.querySelector('h3, h4').innerText : 'Campus Chronicle';
  const desc = el.querySelector('p') ? el.querySelector('p').innerText : 'Sun Rise Sr. Sec. School, Dobhi';

  if (imgElement && bgUrl) imgElement.src = bgUrl;
  if (titleElement) titleElement.innerText = title;
  if (descElement) descElement.innerText = desc;

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

