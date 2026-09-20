<?php
require_once __DIR__ . '/config.php';
?>
  </main>

  <!-- Site Footer (Matching Reference Layout: Quick Contact, Quick Links, Other Projects, Location Map) -->
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-grid">
        <!-- Column 1: Quick Contact -->
        <div class="footer-col">
          <h4 class="footer-heading">Quick Contact</h4>
          <div class="footer-contact-list">
            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">domain</span>
              </div>
              <div>
                <span class="footer-school-name"><?= htmlspecialchars($site_name) ?></span>
                <p class="footer-school-address">
                  Main Road Dobhi, Near Primary Health Center,<br/>
                  Dobhi, Hisar (Haryana) - 125001
                </p>
              </div>
            </div>

            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">contact_phone</span>
              </div>
              <div>
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="footer-contact-phone">
                  <?= $site_phone ?>
                </a>
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone_alt) ?>" class="footer-contact-phone text-xs block opacity-90">
                  <?= $site_phone_alt ?>
                </a>
                <a href="mailto:<?= $site_email ?>" class="footer-contact-email mt-1 block">
                  <?= $site_email ?>
                </a>
              </div>
            </div>

            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">schedule</span>
              </div>
              <div class="text-xs text-slate-300">
                <span class="font-bold text-white block">School Timings:</span>
                <span>Summer: <?= $site_timings_summer ?></span><br/>
                <span>Winter: <?= $site_timings_winter ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="footer-col">
          <h4 class="footer-heading">Quick Links</h4>
          <nav class="footer-links-list" aria-label="Footer Quick Links">
            <a class="footer-link" href="#student-portal" id="footerStudentLoginBtn">
              <span class="footer-chevron">&gt;</span> Student &amp; Staff ERP
            </a>
            <a class="footer-link" href="academics.php#academic-calendar">
              <span class="footer-chevron">&gt;</span> Annual Calendar
            </a>
            <a class="footer-link" href="admission.php">
              <span class="footer-chevron">&gt;</span> Admission Procedure
            </a>
            <a class="footer-link" href="about-us.php#mandatory-disclosure" id="footerDisclosureBtn">
              <span class="footer-chevron">&gt;</span> Mandatory Disclosure
            </a>
            <a class="footer-link" href="admission.php#fee-structure">
              <span class="footer-chevron">&gt;</span> Fee Structure
            </a>
            <a class="footer-link" href="contact-us.php">
              <span class="footer-chevron">&gt;</span> TC &amp; Certificates
            </a>
          </nav>
        </div>

        <!-- Column 3: Other Projects / Facilities -->
        <div class="footer-col">
          <h4 class="footer-heading">Other Projects</h4>
          <nav class="footer-links-list" aria-label="School Initiatives & Facilities">
            <a class="footer-link" href="about-us.php">
              <span class="footer-chevron">&gt;</span> Sun Rise Educational Society
            </a>
            <a class="footer-link" href="campus.php#labs">
              <span class="footer-chevron">&gt;</span> Modern Science &amp; Computer Labs
            </a>
            <a class="footer-link" href="campus.php#sports">
              <span class="footer-chevron">&gt;</span> Sports &amp; Athletics Club
            </a>
            <a class="footer-link" href="campus.php#transport">
              <span class="footer-chevron">&gt;</span> Safe GPS Bus Transport Network
            </a>
            <a class="footer-link" href="academics.php#toppers">
              <span class="footer-chevron">&gt;</span> Board Exam Merit Achievers
            </a>
          </nav>
        </div>

        <!-- Column 4: Location Map -->
        <div class="footer-col">
          <h4 class="footer-heading">Location Map</h4>
          <div class="footer-map-frame">
            <iframe 
              title="Sun Rise Sr. Sec. School Location Map"
              src="https://maps.google.com/maps?q=Sun+Rise+Sr.+Sec.+School,+Dobhi,+Hisar,+Haryana&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
              width="100%" 
              height="145" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <a href="https://maps.google.com/?q=Sun+Rise+Sr.+Sec.+School+Dobhi+Hisar+Haryana" target="_blank" rel="noopener" class="footer-map-link">
            <span class="material-symbols-outlined text-[15px]">pin_drop</span> View on Google Maps
          </a>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom-bar">
        <div>
          &copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?>. All rights reserved.
        </div>
        <div class="flex items-center gap-4 text-xs">
          <a href="about-us.php" class="hover:text-[#C9A24B] transition-colors">Privacy Policy</a>
          <span>•</span>
          <a href="about-us.php" class="hover:text-[#C9A24B] transition-colors">Terms of Service</a>
          <span>•</span>
          <a href="contact-us.php" class="hover:text-[#C9A24B] transition-colors">Sitemap</a>
          <span>•</span>
          <a href="admin/login.php" class="hover:text-[#C9A24B] transition-colors inline-flex items-center gap-1 opacity-75 hover:opacity-100"><span class="material-symbols-outlined text-[13px]">lock</span> Admin Portal</a>
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

      <!-- Image Container for pop-up image.webp -->
      <div class="toppers-img-container">
        <img src="assets/images/pop-up%20image.webp" alt="Sun Rise Sr. Sec. School 10th Class Board Result Toppers" class="toppers-modal-img" loading="eager"/>
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
    <a href="https://wa.me/917015890094" target="_blank" rel="noopener" class="floating-action-btn floating-btn-chat" title="Chat on WhatsApp (+91 70158 90094)" aria-label="WhatsApp Chat">
      <span class="material-symbols-outlined text-[24px]">chat</span>
    </a>
    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="floating-action-btn floating-btn-call" title="Call Admissions Helpline" aria-label="Call Helpline">
      <span class="material-symbols-outlined text-[24px]">call</span>
    </a>
  </div>

  <!-- Hero 4-Direction Box Slider Script -->
  <script src="assets/js/hero-box-slider.js"></script>
  <!-- Main JavaScript File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
