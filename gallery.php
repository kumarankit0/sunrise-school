<?php
$current_page = 'gallery';
$page_title = 'Visual Gallery & Campus Chronicle';
$page_description = 'Browse high-resolution photographs capturing academic exhibitions, sports events, award ceremonies, yoga sessions, and campus life at Sun Rise Sr. Sec. School, Dobhi.';
$page_keywords = 'photo gallery, campus photos, school life pictures, events photos, sports day, annual day, Sun Rise School gallery';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- Hero Section with Background Banner -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary text-on-primary">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('gallery', 'hero_banner', school_img('exhibition1.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="hero-content max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-12 relative z-10 flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-6">
      <span class="hero-badge text-gold-light uppercase font-bold tracking-widest bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1 sm:px-5 sm:py-2 rounded-full shadow-md"><?= get_text('gallery', 'hero_badge', 'Visual Chronicle') ?></span>
      <h1 class="hero-heading font-headline-lg font-bold text-white tracking-tight w-full max-w-4xl drop-shadow-md"><?= get_text('gallery', 'hero_title', 'Life & Moments at Sun Rise School') ?></h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl drop-shadow"><?= get_text('gallery', 'hero_subtitle', 'Explore photographs capturing academic curiosity, hands-on science exhibitions, athletic triumphs, yoga mornings, and merit celebrations across our Dobhi campus.') ?></p>
      <div class="hero-badge inline-flex items-center gap-1.5 sm:gap-2.5 bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1 sm:px-5 sm:py-2 rounded-full text-gold-light font-bold shadow-md">
        <span class="material-symbols-outlined text-[#C9A24B] text-[13px] sm:text-[16px]" style="font-variation-settings: 'FILL' 1;">photo_library</span>
        <span><?= get_text('gallery', 'hero_archive_badge', 'Official School Photo Archive • 100+ High-Resolution Moments') ?></span>
      </div>
      <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mt-2">
        <a class="btn-gold hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('gallery', 'hero_btn1_link', '#gallery-filters')) ?>">
          <span><?= get_text('gallery', 'hero_btn1_text', 'Browse Photo Categories') ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
        </a>
        <a class="btn-outline-white hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('gallery', 'hero_btn2_link', 'contact-us.php')) ?>">
          <span><?= get_text('gallery', 'hero_btn2_text', 'Schedule Campus Visit') ?></span>
          <span class="material-symbols-outlined text-[18px]">calendar_month</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Campus Visual Stats Strip -->
  <section class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 -mt-8 sm:-mt-10 relative z-30">
    <div class="bg-primary text-on-primary rounded-xl shadow-lg border border-white/10 grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-white/15 overflow-hidden">
      <div class="py-3.5 sm:py-4 px-3 sm:px-4 text-center flex flex-col items-center justify-center">
        <span class="text-xl sm:text-2xl font-bold text-[#C9A24B] tracking-tight"><?= get_text('gallery', 'stat1_num', '1,200+') ?></span>
        <span class="text-[11px] sm:text-xs font-medium text-white/90 mt-0.5"><?= get_text('gallery', 'stat1_lbl', 'Active Students') ?></span>
      </div>
      <div class="py-3.5 sm:py-4 px-3 sm:px-4 text-center flex flex-col items-center justify-center">
        <span class="text-xl sm:text-2xl font-bold text-[#C9A24B] tracking-tight"><?= get_text('gallery', 'stat2_num', '25+') ?></span>
        <span class="text-[11px] sm:text-xs font-medium text-white/90 mt-0.5"><?= get_text('gallery', 'stat2_lbl', 'Annual Events & Fests') ?></span>
      </div>
      <div class="py-3.5 sm:py-4 px-3 sm:px-4 text-center flex flex-col items-center justify-center">
        <span class="text-xl sm:text-2xl font-bold text-[#C9A24B] tracking-tight"><?= get_text('gallery', 'stat3_num', '5+ Acres') ?></span>
        <span class="text-[11px] sm:text-xs font-medium text-white/90 mt-0.5"><?= get_text('gallery', 'stat3_lbl', 'Lush Green Campus') ?></span>
      </div>
      <div class="py-3.5 sm:py-4 px-3 sm:px-4 text-center flex flex-col items-center justify-center">
        <span class="text-xl sm:text-2xl font-bold text-[#C9A24B] tracking-tight"><?= get_text('gallery', 'stat4_num', '100%') ?></span>
        <span class="text-[11px] sm:text-xs font-medium text-white/90 mt-0.5"><?= get_text('gallery', 'stat4_lbl', 'Memorable Moments') ?></span>
      </div>
    </div>
  </section>

  <!-- Filter Navigation Bar & Directory Intro -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pt-10 sm:pt-12 pb-6 sm:pb-8 w-full" id="gallery-filters">
    <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
      <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('gallery', 'gallery_intro_eyebrow', 'Curated Photographic Archive') ?></span>
      <h2 class="text-[1.25rem] sm:text-[1.5rem] lg:text-[1.75rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('gallery', 'gallery_intro_title', 'Moments That Define Our School') ?></h2>
      <p class="font-body-md text-on-surface-variant mt-2 sm:mt-3 text-sm sm:text-base"><?= get_text('gallery', 'gallery_intro_desc', 'Filter by category to explore science exhibitions, sports championships, national day celebrations, board exam toppers, campus facilities, and dedicated faculty.') ?></p>
    </div>
    <div class="flex flex-wrap items-center justify-center gap-2.5 border-b border-border-warm pb-4">
      <button class="gallery-filter-btn active" data-filter="all" onclick="filterGallery('all')">All Photos</button>
      <button class="gallery-filter-btn" data-filter="exhibitions" onclick="filterGallery('exhibitions')">Exhibitions &amp; Science</button>
      <button class="gallery-filter-btn" data-filter="events" onclick="filterGallery('events')">Events &amp; Awards</button>
      <button class="gallery-filter-btn" data-filter="sports" onclick="filterGallery('sports')">Sports &amp; Yoga</button>
      <button class="gallery-filter-btn" data-filter="toppers" onclick="filterGallery('toppers')">Toppers &amp; Merit</button>
      <button class="gallery-filter-btn" data-filter="campus" onclick="filterGallery('campus')">Campus &amp; Classes</button>
      <button class="gallery-filter-btn" data-filter="faculty" onclick="filterGallery('faculty')">Faculty &amp; Staff</button>
    </div>
  </section>

  <!-- Gallery Grid (12 Curated Showcase Cards) -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-12 sm:pb-16 w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="gallery-grid">

      <!-- Item 1: Exhibitions -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat1', 'exhibitions')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img1', school_img('exhibition.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag1', 'Exhibition') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow1', 'Science & Innovation') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title1', 'Annual Science Exhibition') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc1', 'Students presenting working models of solar technology and environmental systems.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 2: Events & Awards -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat2', 'events')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img2', school_img('award_ceremony.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag2', 'Awards') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow2', 'Felicitation') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title2', 'Annual Prize Distribution') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc2', 'Honoring academic and extracurricular achievers on stage with trophies.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 3: Sports & Fitness -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat3', 'sports')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img3', school_img('students_ground.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag3', 'Sports') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow3', 'Athletics') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title3', 'Outdoor Ground Activities') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc3', 'Students actively participating in outdoor sports, track drills, and team games.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 4: Yoga & Wellness -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat4', 'sports')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img4', school_img('yoga.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag4', 'Wellness') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow4', 'Morning Assembly') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title4', 'International Yoga Day') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc4', 'Mass yoga demonstration cultivating discipline, physical stamina, and peace of mind.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 5: Toppers & Merit -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat5', 'toppers')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img5', school_img('toppers.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag5', 'Board Toppers') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow5', 'Merit Ranks') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title5', 'HBSE Board Exam Toppers') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc5', 'Celebrating our star achievers securing top percentiles in Class 10 &amp; 12 exams.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 6: Shining Stars -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat6', 'toppers')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img6', school_img('shinning_stars.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag6', 'Merit Board') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow6', 'Star Performers') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title6', 'Shining Stars of Sun Rise') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc6', 'Outstanding scholarship winners and position holders across all school grades.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 7: Campus Building -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat7', 'campus')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img7', school_img('school_home1.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag7', 'Campus') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow7', 'Architecture') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title7', 'Sun Rise School Front Elevation') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc7', 'Grand campus frontage with landscaped green areas in Dobhi, Haryana.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 8: Classroom Sessions -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat8', 'campus')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img8', school_img('children_sitting.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag8', 'Classroom') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow8', 'Student Focus') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title8', 'Interactive Smart Classes') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc8', 'Students engaged in dynamic discussion and visual conceptual learning.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 9: Science Lab Class -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat9', 'exhibitions')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img9', school_img('lab_class.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag9', 'Science Lab') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow9', 'Practical Learning') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title9', 'Senior Science Lab Practicals') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc9', 'Hands-on experimentation under the supervision of experienced physics &amp; chemistry faculty.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 10: Faculty Group -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat10', 'faculty')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img10', school_img('all_staffmembers.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag10', 'Staff Team') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow10', 'Academic Mentors') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title10', 'Complete Teaching Faculty') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc10', 'The passionate educators steering Sun Rise Sr. Sec. School to educational greatness.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 11: Exhibition Project Display -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat11', 'exhibitions')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img11', school_img('exhibition3.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag11', 'Projects') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow11', 'Student Innovation') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title11', 'Interactive Science Models') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc11', 'Creative working models designed by students demonstrating physics principles.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 12: Independence Day Celebration -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="<?= htmlspecialchars(get_text('gallery', 'gallery_cat12', 'events')) ?>" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= get_image('gallery', 'gallery_img12', school_img('IMG_20210815_093156~2.webp')) ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/75 via-primary/10 to-transparent"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase"><?= get_text('gallery', 'gallery_tag12', 'National Day') ?></div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1"><?= get_text('gallery', 'gallery_eyebrow12', 'Patriotism') ?></span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1"><?= get_text('gallery', 'gallery_title12', 'Independence Day Celebration') ?></h3>
          <p class="text-body-sm text-surface-dim line-clamp-1"><?= get_text('gallery', 'gallery_desc12', 'Flag hoisting, patriotic songs, and cultural march-past by students.') ?></p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Campus Life Highlights & Traditions Section -->
  <section class="relative w-full py-10 sm:py-12 lg:py-14 px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" style="background-color: #F7EFE8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.10) 0%, transparent 42%), radial-gradient(circle at 85% 80%, rgba(184, 134, 102, 0.09) 0%, transparent 46%);">
    <!-- Subtle Warm Nude Geometric / Academic Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#8d6e53 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(141, 110, 83, 0.06) 1px, transparent 1px), linear-gradient(to bottom, rgba(141, 110, 83, 0.06) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Soft Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#e8d5c4]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-[#C9A24B]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
        <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('gallery', 'life_eyebrow', 'Holistic Student Experience') ?></span>
        <h2 class="text-[1.25rem] sm:text-[1.5rem] lg:text-[1.75rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('gallery', 'life_heading', 'Vibrant Campus Life Beyond Classrooms') ?></h2>
        <p class="font-body-md text-on-surface-variant mt-2 sm:mt-3 text-sm sm:text-base"><?= get_text('gallery', 'life_desc', 'At Sun Rise School, education flourishes through daily morning assemblies, active sports clubs, cultural celebrations, and community values.') ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
        <!-- Pillar 1: Morning Assembly & Moral Values -->
        <div class="bg-[#F5EEFD] p-5 sm:p-6 rounded-xl border border-[#E2CEFC] hover:border-[#7C3AED] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#8B5CF6] to-[#6D28D9] text-white shadow-sm flex items-center justify-center">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('gallery', 'life1_icon', 'self_improvement') ?></span>
            </div>
            <h3 class="font-headline-sm text-base sm:text-lg font-bold text-[#3B0764]"><?= get_text('gallery', 'life1_title', 'Morning Assembly & Moral Values') ?></h3>
            <p class="text-xs sm:text-sm text-[#581C87]/80 leading-relaxed line-clamp-2"><?= get_text('gallery', 'life1_desc', 'Daily prayer, news recitation, motivational thought sharing, and patriotic anthems shaping disciplined character.') ?></p>
          </div>
          <div class="pt-3 border-t border-[#E2CEFC]/60 mt-3 flex items-center text-xs font-semibold text-[#7C3AED] hover:text-[#5B21B6] transition-colors cursor-pointer" onclick="openLightbox(document.querySelector('.gallery-item[data-category=events]'))">
            <span>Read More</span>
            <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
          </div>
        </div>

        <!-- Pillar 2: Annual Cultural Pageants & Fests -->
        <div class="bg-[#FDF2F8] p-5 sm:p-6 rounded-xl border border-[#FBCFE8] hover:border-[#DB2777] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#EC4899] to-[#BE185D] text-white shadow-sm flex items-center justify-center">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('gallery', 'life2_icon', 'celebration') ?></span>
            </div>
            <h3 class="font-headline-sm text-base sm:text-lg font-bold text-[#831843]"><?= get_text('gallery', 'life2_title', 'Annual Cultural Pageants & Fests') ?></h3>
            <p class="text-xs sm:text-sm text-[#9D174D]/80 leading-relaxed line-clamp-2"><?= get_text('gallery', 'life2_desc', 'Theatrical productions, folk dance performances, music recitals, and national festival celebrations on campus.') ?></p>
          </div>
          <div class="pt-3 border-t border-[#FBCFE8]/60 mt-3 flex items-center text-xs font-semibold text-[#DB2777] hover:text-[#9D174D] transition-colors cursor-pointer" onclick="openLightbox(document.querySelector('.gallery-item[data-category=events]'))">
            <span>Read More</span>
            <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
          </div>
        </div>

        <!-- Pillar 3: Inter-House Athletics & Yoga Drills -->
        <div class="bg-[#ECFDF5] p-5 sm:p-6 rounded-xl border border-[#A7F3D0] hover:border-[#059669] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#10B981] to-[#047857] text-white shadow-sm flex items-center justify-center">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('gallery', 'life3_icon', 'sports_gymnastics') ?></span>
            </div>
            <h3 class="font-headline-sm text-base sm:text-lg font-bold text-[#064E3B]"><?= get_text('gallery', 'life3_title', 'Inter-House Athletics & Yoga Drills') ?></h3>
            <p class="text-xs sm:text-sm text-[#065F46]/80 leading-relaxed line-clamp-2"><?= get_text('gallery', 'life3_desc', 'Dedicated sports periods, athletics conditioning, yoga asanas, and district-level tournament coaching.') ?></p>
          </div>
          <div class="pt-3 border-t border-[#A7F3D0]/60 mt-3 flex items-center text-xs font-semibold text-[#059669] hover:text-[#047857] transition-colors cursor-pointer" onclick="openLightbox(document.querySelector('.gallery-item[data-category=sports]'))">
            <span>Read More</span>
            <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Experience Campus CTA Banner -->
  <section class="w-full py-10 sm:py-14 px-6 lg:px-12 bg-surface">
    <div class="max-w-7xl mx-auto rounded-2xl overflow-hidden relative shadow-xl">
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?= get_image('gallery', 'cta_bg', school_img('school_nightview.webp')) ?>')"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/85 to-primary/60"></div>
      <div class="relative z-10 px-6 py-8 sm:px-12 sm:py-12 max-w-2xl flex flex-col items-start gap-4 text-on-primary">
        <span class="hero-badge text-gold-light uppercase font-bold tracking-widest bg-white/10 px-3.5 py-1 rounded-full text-[11px] border border-[#C9A24B]/30"><?= get_text('gallery', 'cta_eyebrow', 'Experience In Person') ?></span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-headline-lg font-bold text-white leading-tight"><?= get_text('gallery', 'cta_heading', 'Witness the Vibrant Energy of Sun Rise School') ?></h2>
        <p class="text-xs sm:text-sm text-surface-cream/90 leading-relaxed"><?= get_text('gallery', 'cta_desc', 'Photographs only tell part of the story. Visit our Dobhi campus to experience our smart classrooms, open playgrounds, science labs, and meet our teachers.') ?></p>
        <div class="flex flex-wrap items-center gap-3.5 pt-1">
          <a class="btn-gold shadow-md hover:shadow-lg transition-all text-xs sm:text-sm py-2.5 px-5" href="<?= htmlspecialchars(get_text('gallery', 'cta_btn1_link', 'contact-us.php')) ?>">
            <span><?= get_text('gallery', 'cta_btn1_text', 'Schedule Campus Visit') ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
          <a class="btn-outline-white shadow-md hover:shadow-lg transition-all text-xs sm:text-sm py-2.5 px-5" href="<?= htmlspecialchars(get_text('gallery', 'cta_btn2_link', 'admission.php')) ?>">
            <span><?= get_text('gallery', 'cta_btn2_text', 'Admissions Information') ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
