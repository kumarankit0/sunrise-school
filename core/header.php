<?php
require_once __DIR__ . '/config.php';

$seo_title = isset($page_title) ? htmlspecialchars($page_title) . ' | ' . htmlspecialchars($site_name) : htmlspecialchars($site_name) . ' | Nurturing Knowledge, Character & Excellence';
$seo_desc = isset($page_description) ? htmlspecialchars($page_description) : 'Sun Rise Sr. Sec. School, Dobhi offers premier HBSC education from Pre-Primary to Senior Secondary streams with modern labs, sports, and holistic character development.';
$seo_keywords = isset($page_keywords) ? htmlspecialchars($page_keywords) : 'Sun Rise Sr. Sec. School Dobhi, HBSC school Hisar, best school Dobhi Haryana, admissions 2026-27, senior secondary school, academic excellence';
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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>

  <!-- Tailwind CSS Engine -->
  <script src="https://cdn.tailwindcss.com"></script>
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
            "eyebrow": ["Plus Jakarta Sans", "sans-serif"],
            "headline-lg": ["Playfair Display", "serif"],
            "headline-md": ["Playfair Display", "serif"],
            "headline-sm": ["Playfair Display", "serif"],
            "display-hero": ["Playfair Display", "serif"],
            "body-lg": ["Plus Jakarta Sans", "sans-serif"],
            "body-md": ["Plus Jakarta Sans", "sans-serif"],
            "body-sm": ["Plus Jakarta Sans", "sans-serif"]
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
    <!-- Top Utility Bar -->
    <div class="top-utility-bar">
      <div class="top-bar-inner">
        <div class="top-bar-contact">
          <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="top-bar-item">
            <span class="material-symbols-outlined text-[16px]">call</span> <?= $site_phone ?>
          </a>
          <a href="mailto:<?= $site_email ?>" class="top-bar-item hidden sm:inline-flex">
            <span class="material-symbols-outlined text-[16px]">mail</span> <?= $site_email ?>
          </a>
        </div>
        <div class="top-bar-actions">
          <a class="top-bar-link" href="admission.php">Apply Online</a>
          <span class="text-white/40">|</span>
          <div class="top-bar-icons">
            <a href="contact-us.php" title="Global Network" class="top-bar-icon-btn"><span class="material-symbols-outlined text-[16px]">globe</span></a>
            <a href="gallery.php" title="Social Sharing" class="top-bar-icon-btn"><span class="material-symbols-outlined text-[16px]">share</span></a>
            <a href="events.php" title="Community News" class="top-bar-icon-btn"><span class="material-symbols-outlined text-[16px]">public</span></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="nav-container">
      <a href="index.php" class="brand-logo-link" title="<?= htmlspecialchars($site_name) ?>">
        <img alt="<?= htmlspecialchars($site_name) ?> Crest" class="brand-logo-img" src="<?= $site_logo ?>" width="40" height="40"/>
        <div class="brand-logo-text-group">
          <span class="brand-logo-text"><?= htmlspecialchars($site_name) ?></span>
          <span class="brand-logo-sub">Dobhi, Hisar • HBSC</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu with Grouped Dropdowns -->
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
              <span class="material-symbols-outlined nav-arrow text-[18px]">keyboard_arrow_down</span>
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

      <!-- Right Actions (Enquire, Profile, Mobile Toggle) -->
      <div class="nav-actions">
        <a class="btn-nav-enquire" href="admission.php">Enquire Now</a>
        <a href="contact-us.php" class="nav-avatar-btn" title="Student & Staff Portal" aria-label="Portal Login">
          <span class="material-symbols-outlined text-[18px]">person</span>
        </a>
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
            <span class="font-bold text-primary text-sm sm:text-base font-sans truncate">Sun Rise Sr. Sec. School</span>
            <span class="text-[11px] text-on-surface-variant font-medium">Dobhi, Hisar • HBSC Affiliated</span>
          </div>
        </div>
        <button id="mobileMenuClose" class="mobile-close-btn" aria-label="Close Navigation Menu" type="button">
          <span class="material-symbols-outlined text-[22px]">close</span>
        </button>
      </div>

      <!-- Quick Student / Staff Portal Link inside Drawer -->
      <div class="mobile-portal-card">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-outlined text-[16px]">school</span>
          </div>
          <div class="flex flex-col">
            <span class="text-xs font-bold text-primary">Student & Staff Portal</span>
            <span class="text-[10px] text-on-surface-variant">Notices, Results & Admissions</span>
          </div>
        </div>
        <a href="contact-us.php" class="mobile-portal-link">Login</a>
      </div>

      <nav class="mobile-links-list" aria-label="Mobile Navigation Menu">
        <?php foreach ($nav_menu as $key => $item): 
          $has_sub = !empty($item['subitems']);
          $is_active = is_nav_active($key, $current_page);
        ?>
          <div class="mobile-nav-group <?= $is_active ? 'open' : '' ?>">
            <button class="mobile-nav-group-btn <?= $is_active ? 'active' : '' ?>" type="button" aria-expanded="<?= $is_active ? 'true' : 'false' ?>">
              <span class="font-bold"><?= htmlspecialchars($item['title']) ?></span>
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
      <a class="btn-gold w-full text-center" href="admission.php">Enquire Now / Apply Online</a>
      <div class="flex items-center justify-between gap-2 pt-2 border-t border-border-warm">
        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-primary">call</span> Call Us
        </a>
        <a href="https://wa.me/919812345678" target="_blank" rel="noopener" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-emerald-600">chat</span> WhatsApp
        </a>
        <a href="contact-us.php" class="mobile-footer-contact-item">
          <span class="material-symbols-outlined text-[15px] text-[#C9A24B]">location_on</span> Visit
        </a>
      </div>
    </div>
  </div>

  <main class="w-full pt-[102px] bg-surface">
