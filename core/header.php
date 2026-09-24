<?php
require_once __DIR__ . '/config.php';

$seo_title = isset($page_title) ? htmlspecialchars($page_title) . ' | ' . htmlspecialchars($site_name) : htmlspecialchars($site_name) . ' | Nurturing Knowledge, Character & Excellence';
$seo_desc = isset($page_description) ? htmlspecialchars($page_description) : 'Sun Rise Sr. Sec. School, Dobhi offers premier HBSE education from Pre-Primary to Senior Secondary streams with modern labs, sports, and holistic character development.';
$seo_keywords = isset($page_keywords) ? htmlspecialchars($page_keywords) : 'Sun Rise Sr. Sec. School Dobhi, HBSE school Hisar, best school Dobhi Haryana, admissions 2026-27, senior secondary school, academic excellence';
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <!-- Primary SEO Meta Tags -->
  <title><?= $seo_title ?></title>
  <meta name="description" content="<?= $seo_desc ?>"/>
  <meta name="keywords" content="<?= $seo_keywords ?>"/>
  <meta name="author" content="<?= htmlspecialchars($site_name) ?>"/>
  <meta name="robots" content="index, follow"/>
  <meta name="theme-color" content="#001129"/>
  <link rel="icon" type="image/png" href="<?= $site_logo ?>"/>
  <link rel="apple-touch-icon" href="<?= $site_logo ?>"/>

  <!-- Open Graph / Social Sharing -->
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="<?= $seo_title ?>"/>
  <meta property="og:description" content="<?= $seo_desc ?>"/>
  <meta property="og:image" content="<?= $site_logo ?>"/>
  <meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>"/>

  <!-- Twitter Meta -->
  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:title" content="<?= $seo_title ?>"/>
  <meta name="twitter:description" content="<?= $seo_desc ?>"/>
  <meta name="twitter:image" content="<?= $site_logo ?>"/>

  <!-- Resource Hints & Preconnect for Super Fast Asset Loading -->
  <link rel="dns-prefetch" href="https://fonts.googleapis.com"/>
  <link rel="dns-prefetch" href="https://fonts.gstatic.com"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <!-- Optimized Font Loading (Non-blocking with display=swap) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" media="print" onload="this.media='all'"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" media="print" onload="this.media='all'"/>
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
  </noscript>

  <!-- Tailwind CSS Engine (Served from local assets for 0ms network latency) -->
  <script src="assets/js/tailwind.min.js"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "surface-dim": "#dbdad7",
            "border-warm": "#E5E2DA",
            "on-tertiary-fixed": "#111c2c",
            "tertiary-fixed-dim": "#bcc7dd",
            "inverse-primary": "#b0c8f1",
            "text-charcoal": "#121926",
            "on-surface-variant": "#44474e",
            "surface-container-high": "#e9e8e5",
            "secondary-container": "#fdd275",
            "on-background": "#1a1c1a",
            "tertiary-container": "#1b2637",
            "on-tertiary": "#ffffff",
            "on-primary-fixed-variant": "#30476a",
            "surface-container-highest": "#e3e2df",
            "gold-light": "#F9F4E8",
            "surface-cream": "#F3EFEA",
            "tertiary-fixed": "#d8e3f9",
            "surface-bright": "#faf9f6",
            "error-container": "#ffdad6",
            "primary-container": "#0b2647",
            "surface-container-lowest": "#ffffff",
            "on-secondary": "#ffffff",
            "error": "#ba1a1a",
            "on-primary-fixed": "#001b3b",
            "primary-fixed-dim": "#b0c8f1",
            "surface-variant": "#e3e2df",
            "primary": "#001129",
            "surface-container": "#efeeeb",
            "on-primary": "#ffffff",
            "surface": "#faf9f6",
            "on-tertiary-fixed-variant": "#3c4759",
            "on-error": "#ffffff",
            "on-surface": "#1a1c1a",
            "on-primary-container": "#778eb4",
            "inverse-surface": "#2f312f",
            "secondary-fixed": "#ffdf9e",
            "on-error-container": "#93000a",
            "on-secondary-fixed": "#261a00",
            "gold-hover": "#B38C37",
            "tertiary": "#061121",
            "surface-container-low": "#f4f3f0",
            "on-tertiary-container": "#828da1",
            "primary-fixed": "#d5e3ff",
            "background": "#faf9f6",
            "outline": "#74777f",
            "outline-variant": "#c4c6cf",
            "secondary": "#795902",
            "surface-pure": "#FFFFFF",
            "on-secondary-container": "#775800",
            "on-secondary-fixed-variant": "#5b4300",
            "inverse-on-surface": "#f2f1ee",
            "secondary-fixed-dim": "#ebc166",
            "surface-tint": "#485f83"
          },
          fontFamily: {
            "eyebrow": ["Inter", "sans-serif"],
            "headline-lg": ["Poppins", "sans-serif"],
            "headline-md": ["Poppins", "sans-serif"],
            "headline-sm": ["Poppins", "sans-serif"],
            "display-hero": ["Poppins", "sans-serif"],
            "title-editorial": ["Poppins", "sans-serif"],
            "body-lg": ["Inter", "sans-serif"],
            "body-md": ["Inter", "sans-serif"],
            "body-sm": ["Inter", "sans-serif"],
            "heading": ["Poppins", "sans-serif"],
            "sans": ["Inter", "sans-serif"],
            "body": ["Inter", "sans-serif"]
          },
          fontSize: {
            "hero-h1": ["2rem", { lineHeight: "1.2", letterSpacing: "-0.015em", fontWeight: "700" }],
            "hero-h1-mobile": ["1.65rem", { lineHeight: "1.25", letterSpacing: "-0.015em", fontWeight: "700" }],
            "headline-lg": ["1.2rem", { lineHeight: "1.35", letterSpacing: "-0.01em", fontWeight: "700" }],
            "headline-lg-mobile": ["1.1rem", { lineHeight: "1.35", letterSpacing: "-0.01em", fontWeight: "700" }],
            "headline-md": ["1.15rem", { lineHeight: "1.35", fontWeight: "600" }],
            "headline-sm": ["1.1rem", { lineHeight: "1.35", fontWeight: "600" }]
          }
        }
      }
    }
  </script>

  <!-- Modular CSS Files Linked from assets/css/ -->
  <link rel="stylesheet" href="assets/css/style.css"/>
  <link rel="stylesheet" href="assets/css/navbar.css"/>
  <link rel="stylesheet" href="assets/css/footer.css"/>
  <link rel="stylesheet" href="assets/css/pages.css"/>

  <!-- Structured Schema Data (JSON-LD) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "<?= htmlspecialchars($site_name) ?>",
    "description": "<?= $seo_desc ?>",
    "telephone": "<?= $site_phone ?>",
    "email": "<?= $site_email ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $site_address ?>"
    }
  }
  </script>
</head>
<body class="bg-surface font-body text-on-surface">

  <!-- Header Component -->
  <header class="site-header">
    <!-- Top Utility Bar (Exact layout from reference: Home, Student Login, Alumni, Mandatory Disclosure | Blinking Registration, Mail, Phone) -->
    <div class="top-utility-bar">
      <div class="top-bar-inner">
        <!-- Left Links -->
        <nav class="top-bar-left-links" aria-label="Quick Utility Navigation">
          <a href="<?= htmlspecialchars(get_text('general', 'top_link1_url', 'index.php')) ?>" class="top-nav-item <?= ($current_page === 'home') ? 'active' : '' ?>"><?= htmlspecialchars(get_text('general', 'top_link1_text', 'Home')) ?></a>
          <a href="<?= htmlspecialchars(get_text('general', 'top_link2_url', '#student-portal')) ?>" class="top-nav-item" id="topNavStudentLogin"><?= htmlspecialchars(get_text('general', 'top_link2_text', 'Student Login')) ?></a>
          <a href="<?= htmlspecialchars(get_text('general', 'top_link3_url', 'events.php#alumni')) ?>" class="top-nav-item"><?= htmlspecialchars(get_text('general', 'top_link3_text', 'Alumni')) ?></a>
          <a href="<?= htmlspecialchars(get_text('general', 'top_link4_url', '#mandatory-disclosure')) ?>" class="top-nav-item" id="topNavDisclosure"><?= htmlspecialchars(get_text('general', 'top_link4_text', 'Mandatory Disclosure')) ?></a>
        </nav>

        <!-- Right Elements: Blinking Registration, Mail Pulse, Phone -->
        <div class="top-bar-right-info">
          <a href="<?= htmlspecialchars(get_text('general', 'top_reg_url', 'admission.php#register-form')) ?>" class="top-nav-blink-registration" title="Click to Register Online for Session 2026-27">
            <span class="blink-dot"></span>
            <span class="blink-text"><span class="top-nav-reg-prefix">Online </span><?= htmlspecialchars(get_text('general', 'top_reg_text', 'Registration 2026-27')) ?></span>
          </a>
          <a href="mailto:<?= $site_email ?>" class="top-nav-info-link top-bar-email" title="Email School Desk">
            <span class="material-symbols-outlined text-[14px]">mail</span>
            <span><?= $site_email ?></span>
          </a>
          <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="top-nav-info-link top-bar-phone" title="Call Sun Rise Helpline">
            <span class="material-symbols-outlined text-[14px]">call</span>
            <span><?= $site_phone ?></span>
          </a>
        </div>
      </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="nav-container">
      <a href="index.php" class="brand-logo-link" title="<?= htmlspecialchars($site_name) ?>">
        <img alt="<?= htmlspecialchars($site_name) ?> Crest" class="brand-logo-img" src="<?= $site_logo ?>" width="46" height="46"/>
        <div class="brand-logo-text-group brand-stj-lockup">
          <div class="brand-stj-top">
            <span class="brand-stj-drop">S</span>
            <span class="brand-stj-rest">UN RISE</span>
          </div>
          <span class="brand-stj-bottom">SR. SEC. SCHOOL</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu (7 Uppercase Items matching Reference) -->
      <nav class="desktop-nav-menu" aria-label="Main Navigation">
        <?php foreach ($nav_menu as $key => $item): 
          $has_sub = !empty($item['subitems']);
          $is_active = is_nav_active($key, $current_page);
        ?>
          <div class="nav-dropdown-wrapper <?= $is_active ? 'active' : '' ?>">
            <button class="nav-link nav-dropdown-btn <?= $is_active ? 'active' : '' ?>" 
                    type="button"
                    aria-expanded="false" 
                    aria-haspopup="true">
              <span><?= htmlspecialchars($item['title']) ?></span>
              <span class="material-symbols-outlined nav-arrow">keyboard_arrow_down</span>
            </button>

            <?php if ($has_sub): ?>
              <div class="nav-dropdown-menu" role="menu">
                <div class="nav-dropdown-inner">
                  <?php foreach ($item['subitems'] as $subKey => $subItem): 
                    $is_sub_active = ($current_page === $subKey);
                  ?>
                    <a href="<?= $subItem['url'] ?>" 
                       class="nav-dropdown-item <?= $is_sub_active ? 'active' : '' ?>" 
                       role="menuitem">
                      <span class="nav-dropdown-icon">
                        <span class="material-symbols-outlined text-[18px]"><?= $subItem['icon'] ?? 'circle' ?></span>
                      </span>
                      <div class="nav-dropdown-text">
                        <span class="nav-dropdown-title"><?= htmlspecialchars($subItem['title']) ?></span>
                        <span class="nav-dropdown-desc"><?= htmlspecialchars($subItem['desc'] ?? '') ?></span>
                      </div>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </nav>

      <!-- Right Actions (Mobile Toggle) -->
      <div class="nav-actions">
        <button id="mobileMenuToggle" class="mobile-menu-toggle" aria-label="Open Navigation Menu" type="button">
          <span class="material-symbols-outlined text-[24px]">menu</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Navigation Overlay & Drawer -->
  <div id="mobileNavOverlay" class="mobile-nav-overlay" aria-hidden="true"></div>
  <div id="mobileNavDrawer" class="mobile-nav-drawer" role="dialog" aria-modal="true" aria-label="Mobile Navigation">
    <div class="mobile-drawer-body">
      <div class="mobile-drawer-header">
        <div class="flex items-center gap-2.5 min-w-0">
          <img src="<?= $site_logo ?>" alt="Logo" class="h-9 w-auto flex-shrink-0 object-contain"/>
          <div class="flex flex-col min-w-0">
            <span class="font-extrabold text-[#000c1e] text-sm sm:text-base font-sans leading-tight">Sun Rise</span>
            <span class="text-xs font-extrabold text-[#0a192f] uppercase tracking-wider leading-tight">Sr. Sec. School</span>
            <span class="text-[11px] text-[#1e293b] font-bold mt-0.5"><?= htmlspecialchars(get_text('general', 'nav_sub_title', 'Dobhi, Hisar • HBSE Affiliated')) ?></span>
          </div>
        </div>
        <button id="mobileMenuClose" class="mobile-close-btn" aria-label="Close Navigation Menu" type="button">
          <span class="material-symbols-outlined text-[22px]">close</span>
        </button>
      </div>

      <!-- Quick Blinking Online Registration in Mobile Drawer -->
      <div class="mb-3">
        <a href="<?= htmlspecialchars(get_text('general', 'top_reg_url', 'admission.php#register-form')) ?>" class="top-nav-blink-registration flex items-center justify-center py-2.5 text-center w-full">
          <span class="blink-dot"></span>
          <span class="blink-text"><?= htmlspecialchars(get_text('general', 'top_reg_text', 'Online Registration 2026-27')) ?></span>
        </a>
      </div>

      <!-- Quick Utility links for Mobile -->
      <div class="grid grid-cols-2 gap-2 mb-3">
        <button type="button" id="mobileStudentLoginBtn" class="px-3 py-2 text-xs font-semibold rounded-lg bg-surface-container-high text-primary flex items-center justify-center gap-1.5 border border-border-warm hover:border-[#C9A24B] transition-colors">
          <span class="material-symbols-outlined text-[16px]">school</span> Student Login
        </button>
        <button type="button" id="mobileDisclosureBtn" class="px-3 py-2 text-xs font-semibold rounded-lg bg-surface-container-high text-primary flex items-center justify-center gap-1.5 border border-border-warm hover:border-[#C9A24B] transition-colors">
          <span class="material-symbols-outlined text-[16px]">verified</span> Mandatory Info
        </button>
      </div>

      <nav class="mobile-links-list" aria-label="Mobile Navigation Menu">
        <?php foreach ($nav_menu as $key => $item): 
          $has_sub = !empty($item['subitems']);
          $is_active = is_nav_active($key, $current_page);
        ?>
          <div class="mobile-nav-group <?= $is_active ? 'open' : '' ?>">
            <button class="mobile-nav-group-btn <?= $is_active ? 'active' : '' ?>" type="button" aria-expanded="<?= $is_active ? 'true' : 'false' ?>">
              <span class="font-bold uppercase tracking-wider text-xs sm:text-sm"><?= htmlspecialchars($item['title']) ?></span>
              <span class="material-symbols-outlined mobile-group-arrow text-[20px]">expand_more</span>
            </button>
            <?php if ($has_sub): ?>
              <div class="mobile-sublinks-list <?= $is_active ? 'open' : '' ?>">
                <?php foreach ($item['subitems'] as $subKey => $subItem): 
                  $is_sub_active = ($current_page === $subKey);
                ?>
                  <a class="mobile-sublink <?= $is_sub_active ? 'active' : '' ?>" href="<?= $subItem['url'] ?>">
                    <span class="material-symbols-outlined text-[18px] text-[#C9A24B]"><?= $subItem['icon'] ?? 'chevron_right' ?></span>
                    <span><?= htmlspecialchars($subItem['title']) ?></span>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </nav>
    </div>
    <div class="mobile-drawer-footer">
      <a class="btn-gold w-full text-center" href="<?= htmlspecialchars(get_text('general', 'nav_mobile_cta_url', 'admission.php')) ?>"><?= htmlspecialchars(get_text('general', 'nav_mobile_cta_text', 'Enquire Now / Apply Online')) ?></a>
      <div class="flex items-center justify-between gap-2 pt-2 border-t border-border-warm">
        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-primary">call</span> Call Us
        </a>
        <a href="<?= htmlspecialchars(get_text('general', 'nav_mobile_wa_url', 'https://wa.me/917015890094')) ?>" target="_blank" rel="noopener" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-emerald-600">chat</span> WhatsApp
        </a>
        <a href="contact-us.php" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-[#C9A24B]">location_on</span> Visit
        </a>
      </div>
    </div>
  </div>

  <!-- Interactive Modal: Student & Parent Portal Login -->
  <div id="studentLoginModal" class="portal-modal-backdrop" aria-hidden="true" role="dialog" aria-labelledby="modalLoginTitle">
    <div class="portal-modal-card">
      <div class="portal-modal-header">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-primary text-gold flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-outlined text-[22px]">school</span>
          </div>
          <div>
            <h3 id="modalLoginTitle" class="text-base font-bold text-primary font-sans leading-tight">Student & Parent Portal</h3>
            <p class="text-xs text-on-surface-variant">Access Attendance, Fee Status & Exam Results</p>
          </div>
        </div>
        <button type="button" class="portal-modal-close" id="closeStudentLoginModal" aria-label="Close modal">
          <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
      </div>
      <form class="portal-modal-form" onsubmit="event.preventDefault(); alert('Student portal authenticated. Redirecting to student dashboard...'); this.reset(); document.getElementById('studentLoginModal').classList.remove('open');">
        <div class="form-group">
          <label for="studentRoll">Admission / Roll Number <span class="text-error">*</span></label>
          <input type="text" id="studentRoll" placeholder="e.g. SR-2026-0842" required class="portal-input"/>
        </div>
        <div class="form-group">
          <label for="studentPassword">Password / Date of Birth (DDMMYYYY) <span class="text-error">*</span></label>
          <input type="password" id="studentPassword" placeholder="••••••••" required class="portal-input"/>
        </div>
        <div class="flex items-center justify-between text-xs text-on-surface-variant">
          <label class="flex items-center gap-1.5 cursor-pointer">
            <input type="checkbox" checked class="accent-primary rounded"/> Remember me
          </label>
          <a href="contact-us.php" class="text-[#C9A24B] hover:underline font-medium">Forgot Password?</a>
        </div>
        <button type="submit" class="portal-btn-submit">
          Sign In to Portal
        </button>
        <div class="pt-2 text-center text-xs text-on-surface-variant border-t border-border-warm mt-2">
          Faculty or Administrator? <a href="admin/login.php" class="text-primary font-bold hover:underline">Staff Login Here</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Interactive Modal: Mandatory Disclosure -->
  <div id="mandatoryDisclosureModal" class="portal-modal-backdrop" aria-hidden="true" role="dialog" aria-labelledby="modalDisclosureTitle">
    <div class="portal-modal-card max-w-xl">
      <div class="portal-modal-header">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-primary text-gold flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-outlined text-[22px]">verified</span>
          </div>
          <div>
            <h3 id="modalDisclosureTitle" class="text-base font-bold text-primary font-sans leading-tight">Mandatory Public Disclosure</h3>
            <p class="text-xs text-on-surface-variant">Haryana Board of School Education (HBSE) Compliance</p>
          </div>
        </div>
        <button type="button" class="portal-modal-close" id="closeDisclosureModal" aria-label="Close modal">
          <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
      </div>
      <div class="p-5 max-h-[65vh] overflow-y-auto space-y-4 text-xs sm:text-sm">
        <div class="rounded-lg bg-surface-cream p-3 border border-border-warm">
          <p class="font-bold text-primary mb-1">General Information</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-on-surface-variant text-[11px] sm:text-xs">
            <div><strong>School Name:</strong> Sun Rise Sr. Sec. School</div>
            <div><strong>Affiliation:</strong> HBSE (Affiliated since 2011)</div>
            <div><strong>Estd. Year:</strong> 2007 (Founder &amp; Director: Mr. Bhader Singh Swami)</div>
            <div><strong>Location:</strong> Main Road Dobhi, Near PHC, Hisar (125001)</div>
            <div><strong>Principal:</strong> Mr. Rajbir Singh (M.A., B.Ed.)</div>
            <div><strong>Coordinator:</strong> Mr. Indra Dev (LL.M., Ex-GM RBI)</div>
            <div><strong>School Timings (Summer):</strong> 7:30 AM – 1:30 PM</div>
            <div><strong>School Timings (Winter):</strong> 8:30 AM – 2:30 PM</div>
          </div>
        </div>
        <div class="space-y-2">
          <div class="flex items-center justify-between p-2.5 rounded-md bg-surface border border-border-warm">
            <span class="font-medium text-primary">HBSE Affiliation Certificate</span>
            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">VERIFIED</span>
          </div>
          <div class="flex items-center justify-between p-2.5 rounded-md bg-surface border border-border-warm">
            <span class="font-medium text-primary">Fire Safety &amp; Emergency Certificate</span>
            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">RENEWED</span>
          </div>
          <div class="flex items-center justify-between p-2.5 rounded-md bg-surface border border-border-warm">
            <span class="font-medium text-primary">Building Safety &amp; Structural Audit</span>
            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">COMPLIANT</span>
          </div>
          <div class="flex items-center justify-between p-2.5 rounded-md bg-surface border border-border-warm">
            <span class="font-medium text-primary">Safe Drinking Water &amp; Sanitation Certificate</span>
            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[10px]">ACTIVE</span>
          </div>
        </div>
        <div class="flex justify-end pt-2">
          <a href="about-us.php#mandatory-disclosure" class="px-4 py-2 rounded-lg bg-primary text-white text-xs font-bold hover:bg-[#0B2647] transition-colors">
            View Complete Disclosure Page
          </a>
        </div>
      </div>
    </div>
  </div>

  <main class="w-full pt-[102px] sm:pt-[108px] lg:pt-[110px] bg-surface relative z-0">

