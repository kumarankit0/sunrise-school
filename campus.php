<?php
$current_page = 'campus-life';
$page_title = 'Campus Life & Infrastructure | Sun Rise Sr. Sec. School';
$page_description = 'Explore the sprawling campus of Sun Rise Sr. Sec. School, Dobhi featuring modern science & computer labs, sports grounds, yoga spaces, smart classrooms, and safe transport.';
$page_keywords = 'school campus, science labs, smart classrooms, sports ground, yoga, campus life, Sun Rise School Dobhi, safe school';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 bg-primary text-on-primary px-4 sm:px-6 lg:px-12 overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('campus', 'hero_banner', school_img('school.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/40 via-primary/15 to-primary/60"></div>
    <div class="hero-content relative max-w-6xl w-full mx-auto flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-6 z-10">
      <div class="hero-badge inline-flex items-center gap-1.5 sm:gap-2.5 bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1 sm:px-5 sm:py-2 rounded-full text-gold-light uppercase font-bold shadow-md">
        <span class="material-symbols-outlined text-[14px] sm:text-[18px] text-[#C9A24B]">domain</span> 
        <span><?= get_text('campus', 'hero_badge', 'Modern Campus Infrastructure') ?></span>
      </div>
      <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md">
        <?= get_text('campus', 'hero_title', 'A Vibrant & Safe Campus Built for Excellence') ?>
      </h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl drop-shadow">
        <?= get_text('campus', 'hero_subtitle', 'Explore our purpose-built campus in Dobhi, Haryana designed to nurture academic focus, athletic vigor, scientific curiosity, and cultural creativity.') ?>
      </p>
      <div class="hero-cta-group flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 pt-1 sm:pt-2">
        <a class="btn-gold hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('campus', 'hero_btn1_link', '#facilities-grid')) ?>">
          <?= get_text('campus', 'hero_btn1_text', 'Explore Facilities') ?>
        </a>
        <a class="btn-outline-white hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('campus', 'hero_btn2_link', 'contact-us.php')) ?>">
          <span class="material-symbols-outlined">calendar_month</span> <?= get_text('campus', 'hero_btn2_text', 'Book Campus Tour') ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Campus Quick Stats Strip -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 -mt-8 sm:-mt-12 relative z-20 w-full">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 bg-surface-pure rounded-2xl p-6 sm:p-8 shadow-xl border border-border-warm">
      <div class="flex flex-col items-center text-center p-3">
        <span class="text-2xl sm:text-3xl font-headline-lg font-black text-secondary tracking-tight"><?= get_text('campus', 'stat1_num', '5+ Acres') ?></span>
        <span class="text-xs sm:text-sm font-semibold text-on-surface-variant mt-1"><?= get_text('campus', 'stat1_lbl', 'Sprawling Green Campus') ?></span>
      </div>
      <div class="flex flex-col items-center text-center p-3 border-l border-border-warm/60">
        <span class="text-2xl sm:text-3xl font-headline-lg font-black text-secondary tracking-tight"><?= get_text('campus', 'stat2_num', '30+') ?></span>
        <span class="text-xs sm:text-sm font-semibold text-on-surface-variant mt-1"><?= get_text('campus', 'stat2_lbl', 'Smart Tech Classrooms') ?></span>
      </div>
      <div class="flex flex-col items-center text-center p-3 border-l md:border-border-warm/60">
        <span class="text-2xl sm:text-3xl font-headline-lg font-black text-secondary tracking-tight"><?= get_text('campus', 'stat3_num', '35+') ?></span>
        <span class="text-xs sm:text-sm font-semibold text-on-surface-variant mt-1"><?= get_text('campus', 'stat3_lbl', 'Villages Bus Transit Network') ?></span>
      </div>
      <div class="flex flex-col items-center text-center p-3 border-l border-border-warm/60">
        <span class="text-2xl sm:text-3xl font-headline-lg font-black text-secondary tracking-tight"><?= get_text('campus', 'stat4_num', '100%') ?></span>
        <span class="text-xs sm:text-sm font-semibold text-on-surface-variant mt-1"><?= get_text('campus', 'stat4_lbl', 'CCTV & Campus Perimeter Monitored') ?></span>
      </div>
    </div>
  </section>

  <!-- Facilities Directory Section -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-16 sm:py-20" id="facilities-grid">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 sm:mb-12 gap-6">
      <div>
        <span class="text-eyebrow uppercase text-[#C9A24B] font-bold"><?= get_text('campus', 'facilities_eyebrow', 'Campus Infrastructure') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('campus', 'facilities_heading', 'Facilities for Holistic Growth') ?></h2>
      </div>
      <p class="text-body-md text-on-surface-variant max-w-md">
        <?= get_text('campus', 'facilities_desc', 'Every wing of Sun Rise Sr. Sec. School is thoughtfully equipped to ensure total safety, hygiene, modern learning tools, and joyful childhood development.') ?>
      </p>
    </div>

    <!-- Category Filter Bar -->
    <div class="flex flex-wrap items-center gap-2 mb-10 pb-2">
      <button class="campus-filter-btn active px-4 py-2 rounded-lg text-label-sm font-bold transition-all bg-primary text-on-primary shadow-sm" data-category="all">
        All Facilities
      </button>
      <button class="campus-filter-btn px-4 py-2 rounded-lg text-label-sm font-bold transition-all bg-surface-pure hover:bg-surface-cream text-on-surface-variant border border-border-warm" data-category="academics">
        Academics &amp; Digital
      </button>
      <button class="campus-filter-btn px-4 py-2 rounded-lg text-label-sm font-bold transition-all bg-surface-pure hover:bg-surface-cream text-on-surface-variant border border-border-warm" data-category="sports">
        Sports &amp; Wellness
      </button>
      <button class="campus-filter-btn px-4 py-2 rounded-lg text-label-sm font-bold transition-all bg-surface-pure hover:bg-surface-cream text-on-surface-variant border border-border-warm" data-category="community">
        Community &amp; Character
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- 1. Smart Classrooms -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="academics" id="classrooms" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac1_img', school_img('children_sitting.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">smart_display</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac1_tag', '30+ Classrooms') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac1_title', 'Smart Classrooms') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac1_desc', 'More than 30 spacious, well-ventilated technical and smart classrooms equipped with multimedia audio-visual aids and ergonomic furniture for interactive learning.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac1_feature', 'Interactive AV Learning') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 2. Science Laboratory -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="academics" id="labs" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac2_img', school_img('exhibition2.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">biotech</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac2_tag', 'Hands-On Discovery') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac2_title', 'Composite Science Labs') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac2_desc', 'Fully equipped practical laboratories for Physics, Chemistry, and Biology adhering to HBSE standards, enabling students to perform curriculum practicals and state-level science models.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac2_feature', 'Physics, Chem & Bio') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 3. Computer Lab -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="academics" id="computer-lab" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac_comp_img', school_img('project.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">computer</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac_comp_tag', 'Digital Education') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac_comp_title', 'Modern Computer Lab') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac_comp_desc', 'Dedicated IT workstation lab providing students from Primary to Senior Secondary with essential digital literacy, coding, practical typing, and computer science applications.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac_comp_feature', 'IT & Digital Literacy') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 4. Library & Learning Center -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="academics" id="library" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac_lib_img', school_img('exhibition.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">local_library</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac_lib_tag', 'Resource Center') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac_lib_title', 'School Library & Reading Room') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac_lib_desc', 'A peaceful reading sanctuary housing an extensive repository of curriculum textbooks, reference guides, competitive test series, periodicals, and children literature.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac_lib_feature', 'Enriched Reading Repository') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 5. Playground & Sports Facility -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="sports" id="sports" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac3_img', school_img('students_ground.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">sports_soccer</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac3_tag', 'Sports & Fitness') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac3_title', 'Expansive Sports Ground') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac3_desc', 'Spacious open athletic grounds equipped for cricket, kabaddi, volleyball, track events, wrestling, kickboxing, and daily morning drills under experienced coaches.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac3_feature', 'Athletics & Games') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 6. Transport Facility -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="community" id="transport" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac_trans_img', school_img('school_home1.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">directions_bus</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac_trans_tag', 'Safe Commute') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac_trans_title', 'Transport Transit Facility') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac_trans_desc', 'A dependable, dedicated school bus fleet connecting Dobhi with 35+ surrounding villages and townships, operated by trained drivers and safety staff.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac_trans_feature', 'Doorstep Rural Routes') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 7. Yoga & Meditation Arena -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="sports" id="yoga" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac4_img', school_img('yoga.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">self_improvement</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac4_tag', 'Mind & Body') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac4_title', 'Yoga & Meditation Arena') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac4_desc', 'Daily morning pranayama, Surya Namaskar, and guided mindfulness sessions helping students cultivate razor-sharp concentration and calm emotional health.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac4_feature', 'Daily Mindfulness & Asanas') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 8. Exhibition & Project Hall -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="community" id="exhibition" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac5_img', school_img('project.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">palette</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac5_tag', 'Creative Expression') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac5_title', 'Exhibition & Project Hall') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac5_desc', 'Dedicated space for student science models, social science exhibitions, art displays, and community awareness presentations.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac5_feature', 'Science Fairs & Art Displays') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 9. Morning Assembly Courtyard -->
      <div class="campus-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" data-category="community" id="assembly" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac6_img', school_img('children_praying.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">diversity_3</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac6_tag', 'Character & Values') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac6_title', 'Morning Assembly Courtyard') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac6_desc', 'Where the whole school unites each morning for prayers, national anthem, news recitation, inspirational speeches, and student felicitations.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold"><?= get_text('campus', 'fac6_feature', 'Daily Moral Assembly') ?></span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- 10. CCTV Security & Campus Safety (Wide Featured Card) -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group md:col-span-2 lg:col-span-3" id="safety">
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="relative h-64 md:h-auto overflow-hidden cursor-pointer" onclick="openLightbox(this)">
            <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'safety_img', school_img('school_nightview.webp')) ?>')"></div>
            <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
              <span class="material-symbols-outlined text-[20px]">videocam</span>
            </div>
          </div>
          <div class="p-8 lg:p-12 flex flex-col justify-between gap-6 bg-surface-container-low">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'safety_tag', 'Comprehensive Security') ?></span>
              <h3 class="font-headline-md text-headline-md text-primary"><?= get_text('campus', 'safety_title', 'CCTV Security & Campus Safety') ?></h3>
              <p class="text-body-lg text-on-surface-variant leading-relaxed">
                <?= get_text('campus', 'safety_desc', 'Sun Rise Sr. Sec. School provides a strictly secure campus with comprehensive 24/7 CCTV surveillance covering classrooms, corridors, main gate, and playfields, complemented by secure boundary fencing, pure RO filtered water, and emergency medical kits.') ?>
              </p>
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">videocam</span>
                  <span class="text-body-sm font-bold text-primary"><?= get_text('campus', 'safety_feat1', '24/7 CCTV Cameras') ?></span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">shield</span>
                  <span class="text-body-sm font-bold text-primary"><?= get_text('campus', 'safety_feat2', 'Boundary Enclosure') ?></span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">water_drop</span>
                  <span class="text-body-sm font-bold text-primary"><?= get_text('campus', 'safety_feat3', 'RO Pure Water') ?></span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">medical_services</span>
                  <span class="text-body-sm font-bold text-primary"><?= get_text('campus', 'safety_feat4', 'PHC Proximity') ?></span>
                </div>
              </div>
            </div>
            <div class="pt-6 border-t border-border-warm flex items-center justify-between">
              <span class="text-label-md text-primary font-bold"><?= get_text('campus', 'safety_badge_text', 'Peace of Mind for Parents') ?></span>
              <a class="btn-primary" href="<?= htmlspecialchars(get_text('campus', 'safety_btn_link', 'contact-us.php')) ?>">
                <span><?= get_text('campus', 'safety_btn_text', 'Plan a Campus Visit') ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Photo Gallery Preview CTA -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-20">
    <div class="bg-primary text-on-primary rounded-2xl p-12 lg:p-16 relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
      <div class="absolute inset-0 opacity-15 bg-cover bg-center" style="background-image: url('<?= get_image('campus', 'cta_bg', school_img('school_home1.webp')) ?>')"></div>
      <div class="relative z-10 flex flex-col gap-4 max-w-2xl">
        <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'cta_eyebrow', 'Experience Sun Rise School') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-white tracking-tight leading-snug"><?= get_text('campus', 'cta_heading', 'Want to see more campus moments?') ?></h2>
        <p class="text-body-lg text-primary-fixed-dim">
          <?= get_text('campus', 'cta_desc', 'Browse through our full visual chronicle containing photographs from academic exhibitions, sports days, award ceremonies, and everyday school celebrations.') ?>
        </p>
      </div>
      <div class="relative z-10 flex flex-col sm:flex-row gap-4">
        <a class="btn-gold" href="<?= htmlspecialchars(get_text('campus', 'cta_btn1_link', 'gallery.php')) ?>">
          <span><?= get_text('campus', 'cta_btn1_text', 'Explore Photo Gallery') ?></span>
        </a>
        <a class="btn-outline-white" href="<?= htmlspecialchars(get_text('campus', 'cta_btn2_link', 'contact-us.php')) ?>">
          <span><?= get_text('campus', 'cta_btn2_text', 'Book Campus Visit') ?></span>
        </a>
      </div>
    </div>
  </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const filterBtns = document.querySelectorAll('.campus-filter-btn');
  const cards = document.querySelectorAll('.campus-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      filterBtns.forEach(b => {
        b.classList.remove('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
        b.classList.add('bg-surface-pure', 'text-on-surface-variant', 'border', 'border-border-warm');
      });
      this.classList.add('active', 'bg-primary', 'text-on-primary', 'shadow-sm');
      this.classList.remove('bg-surface-pure', 'text-on-surface-variant', 'border', 'border-border-warm');

      const filter = this.getAttribute('data-category');
      cards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});
</script>

<?php
require_once __DIR__ . '/core/footer.php';
?>
