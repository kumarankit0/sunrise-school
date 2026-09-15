<?php
require_once __DIR__ . '/config.php';
?>
  </main>

  <!-- Site Footer -->
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-grid">
        <!-- Brand & Mission Column -->
        <div class="footer-col">
          <a href="index.php" class="footer-brand">
            <img alt="<?= htmlspecialchars($site_name) ?> Logo" class="footer-brand-img" src="<?= $site_logo ?>" width="36" height="36" loading="lazy"/>
            <span class="footer-brand-name">Sun Rise Sr. Sec. School</span>
          </a>
          <p class="footer-description">
            Providing exceptional HBSC education, cultivating wisdom, moral integrity, scientific inquiry, and academic excellence in every student.
          </p>
          <div class="footer-social-strip">
            <a href="https://facebook.com" target="_blank" rel="noopener" class="footer-social-icon" aria-label="Facebook">
              <span class="material-symbols-outlined text-[18px]">public</span>
            </a>
            <a href="https://twitter.com" target="_blank" rel="noopener" class="footer-social-icon" aria-label="Twitter">
              <span class="material-symbols-outlined text-[18px]">share</span>
            </a>
            <a href="https://instagram.com" target="_blank" rel="noopener" class="footer-social-icon" aria-label="Instagram">
              <span class="material-symbols-outlined text-[18px]">photo_camera</span>
            </a>
            <a href="https://youtube.com" target="_blank" rel="noopener" class="footer-social-icon" aria-label="YouTube">
              <span class="material-symbols-outlined text-[18px]">school</span>
            </a>
          </div>
        </div>

        <!-- Quick Navigation Links -->
        <div class="footer-col">
          <h4 class="footer-heading">Quick Links</h4>
          <nav class="footer-links-list" aria-label="Footer Navigation">
            <a class="footer-link" href="about-us.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> About Us</a>
            <a class="footer-link" href="academics.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> Academics</a>
            <a class="footer-link" href="faculty.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> Faculty &amp; Staff</a>
            <a class="footer-link" href="admission.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> Admissions</a>
            <a class="footer-link" href="campus.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> Campus Life</a>
            <a class="footer-link" href="gallery.php"><span class="material-symbols-outlined text-[14px]">chevron_right</span> Photo Gallery</a>
          </nav>
        </div>

        <!-- Contact Information -->
        <div class="footer-col">
          <h4 class="footer-heading">Contact Info</h4>
          <div class="footer-links-list">
            <p class="footer-contact-item">
              <span class="material-symbols-outlined footer-contact-icon">location_on</span>
              <span><?= htmlspecialchars($site_address) ?></span>
            </p>
            <p class="footer-contact-item">
              <span class="material-symbols-outlined footer-contact-icon">call</span>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="hover:text-primary transition-colors"><?= $site_phone ?></a>
            </p>
            <p class="footer-contact-item">
              <span class="material-symbols-outlined footer-contact-icon">mail</span>
              <a href="mailto:<?= $site_info_email ?>" class="hover:text-primary transition-colors"><?= $site_info_email ?></a>
            </p>
            <p class="footer-contact-item">
              <span class="material-symbols-outlined footer-contact-icon">schedule</span>
              <span>Mon - Sat: 8:00 AM - 3:00 PM</span>
            </p>
          </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer-col">
          <h4 class="footer-heading">Newsletter</h4>
          <p class="footer-description">
            Subscribe for official school updates, notices, admissions announcements, and newsletters.
          </p>
          <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Sun Rise Sr. Sec. School updates!'); this.reset();">
            <input class="newsletter-input" placeholder="Your email address" type="email" required aria-label="Email Address"/>
            <button class="newsletter-btn" type="submit">Join</button>
          </form>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom-bar">
        <div>
          &copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?>. All rights reserved.
        </div>
        <div class="flex items-center gap-4 text-xs">
          <a href="about-us.php" class="hover:text-primary transition-colors">Privacy Policy</a>
          <span>•</span>
          <a href="about-us.php" class="hover:text-primary transition-colors">Terms of Service</a>
          <span>•</span>
          <a href="contact-us.php" class="hover:text-primary transition-colors">Sitemap</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Lightbox Modal Component (Used in Gallery & Preview) -->
  <div id="lightboxModal" class="lightbox-modal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="lightbox-dialog">
      <button id="lightboxClose" class="lightbox-close" aria-label="Close Lightbox">
        <span class="material-symbols-outlined text-[20px]">close</span>
      </button>
      <img id="lightboxImg" class="lightbox-img" src="" alt="Enlarged Campus View" loading="lazy"/>
      <div class="lightbox-caption">
        <h3 id="lightboxTitle" class="font-headline-sm text-primary font-bold"></h3>
        <p id="lightboxDesc" class="text-body-sm text-on-surface-variant mt-1"></p>
      </div>
    </div>
  </div>

  <!-- Welcome Toppers Announcement Popup Modal -->
  <div id="toppersModal" class="toppers-modal" role="dialog" aria-modal="true" aria-label="Board Toppers Announcement" aria-hidden="true">
    <div class="toppers-modal-overlay" id="toppersOverlay"></div>
    <div class="toppers-modal-dialog">
      <!-- Cross Close Icon Button -->
      <button id="toppersModalClose" class="toppers-close-btn" aria-label="Close Announcement" type="button">
        <span class="material-symbols-outlined text-[24px]">close</span>
      </button>

      <!-- Modal Header / Banner -->
      <div class="toppers-modal-header">
        <div class="flex items-center gap-2">
          <span class="material-symbols-outlined text-[#C9A24B] text-[22px]">military_tech</span>
          <span class="font-bold text-xs sm:text-sm uppercase tracking-wider text-gold-light">Board Exam Merit Achievers</span>
        </div>
        <span class="text-[11px] bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded-full font-bold uppercase">100% Results</span>
      </div>

      <!-- Image Container for toppers.webp -->
      <div class="toppers-img-container">
        <img src="<?= school_img('toppers.webp') ?>" alt="Sun Rise Sr. Sec. School Board Toppers" class="toppers-modal-img" loading="eager"/>
      </div>

      <!-- Modal Footer -->
      <div class="toppers-modal-footer">
        <div class="flex flex-col gap-2 w-full">
          <div>
            <h3 class="font-headline-sm text-sm sm:text-base font-bold text-primary leading-tight">Sun Rise Sr. Sec. School, Dobhi</h3>
            <p class="text-body-sm text-[11px] sm:text-xs text-on-surface-variant mt-0.5">Congratulations to all star achievers on board exam distinctions!</p>
          </div>
          <div class="flex items-center gap-2 pt-1 border-t border-[#E5E2DA]">
            <a href="admission.php" class="btn-gold text-xs py-1.5 px-3 flex-1 text-center font-bold shadow-sm">Admissions Open</a>
            <button id="toppersModalDismiss" class="btn-primary text-xs py-1.5 px-3 flex-shrink-0" type="button">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Floating Action Buttons (WhatsApp / Chat & Direct Call) -->
  <div class="floating-action-group" aria-label="Quick Contact Actions">
    <a href="https://wa.me/919812345678" target="_blank" rel="noopener" class="floating-action-btn floating-btn-chat" title="Chat on WhatsApp" aria-label="WhatsApp Chat">
      <span class="material-symbols-outlined text-[24px]">chat</span>
    </a>
    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="floating-action-btn floating-btn-call" title="Call Admissions Helpline" aria-label="Call Helpline">
      <span class="material-symbols-outlined text-[24px]">call</span>
    </a>
  </div>

  <!-- Main JavaScript File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
