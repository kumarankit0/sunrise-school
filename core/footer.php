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
          <h4 class="footer-heading"><?= htmlspecialchars(get_text('general', 'footer_col1_title', 'Quick Contact')) ?></h4>
          <div class="footer-contact-list">
            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">domain</span>
              </div>
              <div>
                <span class="footer-school-name"><?= htmlspecialchars($site_name) ?></span>
                <p class="footer-school-address">
                  <?= nl2br(htmlspecialchars($site_address)) ?>
                </p>
              </div>
            </div>

            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">contact_phone</span>
              </div>
              <div>
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="footer-contact-phone">
                  <?= htmlspecialchars($site_phone) ?>
                </a>
                <?php if (!empty($site_phone_alt)): ?>
                  <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone_alt) ?>" class="footer-contact-phone text-xs block opacity-90">
                    <?= htmlspecialchars($site_phone_alt) ?>
                  </a>
                <?php endif; ?>
                <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="footer-contact-email mt-1 block">
                  <?= htmlspecialchars($site_email) ?>
                </a>
              </div>
            </div>

            <div class="footer-contact-block">
              <div class="footer-contact-icon-box">
                <span class="material-symbols-outlined text-[20px]">schedule</span>
              </div>
              <div class="footer-timing-info">
                <span class="footer-timing-heading"><?= htmlspecialchars(get_text('general', 'footer_timings_title', 'School Timings:')) ?></span>
                <span class="footer-timing-item"><strong>Summer:</strong> <?= htmlspecialchars($site_timings_summer) ?></span>
                <span class="footer-timing-item"><strong>Winter:</strong> <?= htmlspecialchars($site_timings_winter) ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="footer-col">
          <h4 class="footer-heading"><?= htmlspecialchars(get_text('general', 'footer_col2_title', 'Quick Links')) ?></h4>
          <nav class="footer-links-list" aria-label="Footer Quick Links">
            <a class="footer-link" href="<?= htmlspecialchars(get_text('general', 'footer_col2_link1_url', '#student-portal')) ?>" id="footerStudentLoginBtn">
              <span class="footer-chevron">&gt;</span> <?= htmlspecialchars(get_text('general', 'footer_col2_link1_text', 'Student & Staff ERP')) ?>
            </a>
            <a class="footer-link" href="<?= htmlspecialchars(get_text('general', 'footer_col2_link2_url', 'academics.php#academic-calendar')) ?>">
              <span class="footer-chevron">&gt;</span> <?= htmlspecialchars(get_text('general', 'footer_col2_link2_text', 'Annual Calendar')) ?>
            </a>
            <a class="footer-link" href="<?= htmlspecialchars(get_text('general', 'footer_col2_link3_url', 'admission.php')) ?>">
              <span class="footer-chevron">&gt;</span> <?= htmlspecialchars(get_text('general', 'footer_col2_link3_text', 'Admission Procedure')) ?>
            </a>
            <a class="footer-link" href="<?= htmlspecialchars(get_text('general', 'footer_col2_link4_url', 'about-us.php#mandatory-disclosure')) ?>" id="footerDisclosureBtn">
              <span class="footer-chevron">&gt;</span> <?= htmlspecialchars(get_text('general', 'footer_col2_link4_text', 'Mandatory Disclosure')) ?>
            </a>
            <a class="footer-link" href="<?= htmlspecialchars(get_text('general', 'footer_col2_link7_url', 'contact-us.php#careers')) ?>">
              <span class="footer-chevron">&gt;</span> <?= htmlspecialchars(get_text('general', 'footer_col2_link7_text', 'Careers & Vacancies')) ?>
            </a>
          </nav>
        </div>

        <!-- Column 3: Social Media & Connect (Replaced Other Projects) -->
        <div class="footer-col">
          <h4 class="footer-heading"><?= htmlspecialchars(get_text('general', 'footer_col3_title', 'Connect With Us')) ?></h4>
          <p class="text-xs text-slate-500 mb-2 leading-relaxed">
            <?= htmlspecialchars(get_text('general', 'footer_social_desc', 'Follow our official channels for news, event updates & announcements.')) ?>
          </p>
          <div class="footer-social-icons">
            <?php if (!empty($social_facebook)): ?>
              <a href="<?= htmlspecialchars($social_facebook) ?>" target="_blank" rel="noopener noreferrer" class="footer-social-btn social-facebook" title="Follow us on Facebook" aria-label="Facebook">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($social_instagram)): ?>
              <a href="<?= htmlspecialchars($social_instagram) ?>" target="_blank" rel="noopener noreferrer" class="footer-social-btn social-instagram" title="Follow us on Instagram" aria-label="Instagram">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($social_youtube)): ?>
              <a href="<?= htmlspecialchars($social_youtube) ?>" target="_blank" rel="noopener noreferrer" class="footer-social-btn social-youtube" title="Subscribe to YouTube" aria-label="YouTube">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              </a>
            <?php endif; ?>
            <?php if (!empty($social_whatsapp)): ?>
              <a href="<?= htmlspecialchars($social_whatsapp) ?>" target="_blank" rel="noopener noreferrer" class="footer-social-btn social-whatsapp" title="Chat on WhatsApp" aria-label="WhatsApp">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Column 4: Location Map -->
        <div class="footer-col">
          <h4 class="footer-heading"><?= htmlspecialchars(get_text('general', 'footer_col4_title', 'Location Map')) ?></h4>
          <div class="footer-map-frame">
            <iframe 
              title="Sun Rise Sr. Sec. School Location Map"
              src="<?= htmlspecialchars(get_text('general', 'footer_map_embed', 'https://maps.google.com/maps?q=Sun+Rise+Sr.+Sec.+School,+Dobhi,+Hisar,+Haryana&t=&z=14&ie=UTF8&iwloc=&output=embed')) ?>"
              width="100%" 
              height="100" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <a href="<?= htmlspecialchars(get_text('general', 'footer_map_btn_link', 'https://maps.google.com/?q=Sun+Rise+Sr.+Sec.+School+Dobhi+Hisar+Haryana')) ?>" target="_blank" rel="noopener" class="footer-map-link">
            <span class="material-symbols-outlined text-[15px]">pin_drop</span> <?= htmlspecialchars(get_text('general', 'footer_map_btn_text', 'View on Google Maps')) ?>
          </a>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom-bar">
        <div>
          &copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?>. <?= htmlspecialchars(get_text('general', 'footer_copyright_note', 'All rights reserved.')) ?>
        </div>
        <div class="flex items-center gap-4 text-xs">
          <a href="<?= htmlspecialchars(get_text('general', 'footer_bottom_link1_url', 'about-us.php')) ?>" class="hover:text-[#C9A24B] transition-colors"><?= htmlspecialchars(get_text('general', 'footer_bottom_link1_text', 'Privacy Policy')) ?></a>
          <span>•</span>
          <a href="<?= htmlspecialchars(get_text('general', 'footer_bottom_link2_url', 'about-us.php')) ?>" class="hover:text-[#C9A24B] transition-colors"><?= htmlspecialchars(get_text('general', 'footer_bottom_link2_text', 'Terms of Service')) ?></a>
          <span>•</span>
          <a href="<?= htmlspecialchars(get_text('general', 'footer_bottom_link3_url', 'contact-us.php')) ?>" class="hover:text-[#C9A24B] transition-colors"><?= htmlspecialchars(get_text('general', 'footer_bottom_link3_text', 'Sitemap')) ?></a>
          <span>•</span>
          <a href="<?= htmlspecialchars(get_text('general', 'footer_admin_link_url', 'admin/login.php')) ?>" class="hover:text-[#C9A24B] transition-colors inline-flex items-center gap-1 opacity-75 hover:opacity-100"><span class="material-symbols-outlined text-[13px]">lock</span> <?= htmlspecialchars(get_text('general', 'footer_admin_link_text', 'Admin Portal')) ?></a>
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
        <img src="assets/images/pop-up%20image.webp" alt="Sun Rise Sr. Sec. School 10th Class Board Result Toppers" class="toppers-modal-img" loading="lazy"/>
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

  <!-- Hero 4-Direction Box Slider Script (Deferred for maximum speed) -->
  <script src="assets/js/hero-box-slider.js" defer></script>
  <!-- Main JavaScript File (Deferred) -->
  <script src="assets/js/main.js" defer></script>
</body>
</html>
