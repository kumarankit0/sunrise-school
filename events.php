<?php
$current_page = 'events-news';
$page_title = 'Events & News | School Happenings';
$page_description = 'Stay up-to-date with annual functions, science exhibitions, sports meets, national day celebrations, and academic announcements at Sun Rise Sr. Sec. School, Dobhi.';
$page_keywords = 'school events, upcoming events, science exhibition, sports meet, school news, Sun Rise School Dobhi';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Background Banner -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary text-on-primary">
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('events', 'featured_banner', school_img('award_ceremony.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50 z-10"></div>
    <div class="hero-content relative z-20 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-12 flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-6">
      <div class="hero-badge inline-flex items-center gap-1.5 sm:gap-2 bg-[#C9A24B] text-primary px-3.5 py-1 sm:px-5 sm:py-1.5 rounded-full uppercase tracking-widest font-bold shadow-md">
        <span class="material-symbols-outlined text-[13px] sm:text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
        <span><?= get_text('events', 'featured_badge', 'Featured Event') ?></span>
      </div>
      <h1 class="hero-heading font-headline-lg text-white font-bold w-full max-w-4xl drop-shadow-md"><?= get_text('events', 'featured_title', 'Annual Science & Art Exhibition 2026') ?></h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl drop-shadow"><?= get_text('events', 'featured_subtitle', 'Experience the ingenuity of our students as they demonstrate live working science models, robotics experiments, sustainable agriculture concepts, and artistic creations.') ?></p>
      <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 text-xs sm:text-base text-surface-cream font-medium">
        <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[#C9A24B] text-[15px] sm:text-[18px]">calendar_today</span> <?= get_text('events', 'featured_session_tag', 'Annual Session') ?></span>
        <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[#C9A24B] text-[15px] sm:text-[18px]">schedule</span> <?= get_text('events', 'featured_time', '09:30 AM - 03:00 PM') ?></span>
        <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[#C9A24B] text-[15px] sm:text-[18px]">location_on</span> <?= get_text('events', 'featured_location', 'Main Campus Auditorium & Grounds') ?></span>
      </div>
      <a class="btn-gold hero-cta-btn shadow-md hover:shadow-lg transition-all mt-1" href="<?= htmlspecialchars(get_text('events', 'featured_btn_link', 'contact-us.php')) ?>">
        <span><?= get_text('events', 'featured_btn_text', 'Inquire / Visit Campus') ?></span>
        <span class="material-symbols-outlined">arrow_forward</span>
      </a>
    </div>
  </section>

  <!-- Main Content Layout (Grid + Sidebar) -->
  <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-8 sm:py-10 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <!-- Events & News Grid (8 Cols) -->
      <div class="lg:col-span-8 flex flex-col gap-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <span class="text-eyebrow text-primary uppercase font-bold text-[#B38C37]"><?= get_text('events', 'news_eyebrow', 'Happenings & Notices') ?></span>
            <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('events', 'news_heading', 'School News & Key Highlights') ?></h2>
          </div>
          <!-- Filter Chips -->
          <div class="flex items-center gap-2 flex-wrap">
            <button class="event-filter-btn bg-primary text-on-primary px-4 py-2 rounded-lg text-label-sm transition-all shadow-sm font-bold" data-filter="all" onclick="filterEvents('all')">All</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="academic" onclick="filterEvents('academic')">Academic</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="cultural" onclick="filterEvents('cultural')">Celebrations</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="campus" onclick="filterEvents('campus')">Campus</button>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <?php
          $d1 = explode(' ', get_text('events', 'news1_date', '24 OCT'));
          $d2 = explode(' ', get_text('events', 'news2_date', '15 AUG'));
          $d3 = explode(' ', get_text('events', 'news3_date', '05 SEP'));
          $d4 = explode(' ', get_text('events', 'news4_date', '12 MAY'));
          $ag1 = explode(' ', get_text('events', 'agenda1_date', '10 OCT'));
          $ag2 = explode(' ', get_text('events', 'agenda2_date', '14 NOV'));
          $ag3 = explode(' ', get_text('events', 'agenda3_date', '22 DEC'));
          ?>
          <!-- Card 1: Science Exhibition -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="academic">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news1_img', school_img('exhibition7.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d1[0] ?? '24') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d1[1] ?? 'OCT') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news1_tag', 'Science Fair') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news1_title', 'District Level Science Model Showcase') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-1"><?= get_text('events', 'news1_desc', 'Students demonstrated innovative research prototypes and hydraulic mechanics models with outstanding presentation skills.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="<?= htmlspecialchars(get_text('events', 'news1_link_url', 'gallery.php')) ?>">
                <?= get_text('events', 'news1_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 2: Independence Day -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="cultural">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news2_img', school_img('IMG_20210815_093156~2.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d2[0] ?? '15') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d2[1] ?? 'AUG') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news2_tag', 'National Day') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news2_title', 'Independence Day Flag Hoisting & Parade') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-1"><?= get_text('events', 'news2_desc', 'Celebrated with patriotic enthusiasm, tri-color flag unfurling by management, and spirited cultural performances.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="<?= htmlspecialchars(get_text('events', 'news2_link_url', 'gallery.php')) ?>">
                <?= get_text('events', 'news2_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 3: Award Ceremony & Felicitation -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="campus">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news3_img', school_img('award_to_school.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d3[0] ?? '05') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d3[1] ?? 'SEP') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news3_tag', 'Honors') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news3_title', 'Institutional Excellence Award to School') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-1"><?= get_text('events', 'news3_desc', 'Sun Rise Sr. Sec. School recognized for exceptional academic standards and community educational leadership in Hisar region.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="<?= htmlspecialchars(get_text('events', 'news3_link_url', 'about-us.php')) ?>">
                <?= get_text('events', 'news3_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 4: News Coverage -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="academic">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news4_img', school_img('image_news.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d4[0] ?? '12') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d4[1] ?? 'MAY') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news4_tag', 'Press') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news4_title', 'Media Coverage: Board Exam Triumphs') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-1"><?= get_text('events', 'news4_desc', 'Prominent regional newspapers report on the extraordinary 100% HBSE board passing rate and high scoring records of our students.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="<?= htmlspecialchars(get_text('events', 'news4_link_url', 'admission.php')) ?>">
                <?= get_text('events', 'news4_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar (4 Cols) -->
      <div class="lg:col-span-4 flex flex-col gap-6 lg:gap-8 h-full">
        <!-- Academic Calendar Info Box -->
        <div class="bg-primary text-on-primary rounded-xl p-6 sm:p-7 shadow-md relative overflow-hidden flex flex-col justify-between gap-5">
          <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-[#C9A24B]/10 rounded-full blur-2xl pointer-events-none"></div>
          <div class="flex flex-col gap-3">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-lg bg-[#C9A24B] flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[24px]">description</span>
              </div>
              <div>
                <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('events', 'calendar_eyebrow', 'Academic Schedule') ?></span>
                <h3 class="font-headline-sm text-headline-sm font-bold text-on-primary"><?= get_text('events', 'calendar_title', 'School Calendar') ?></h3>
              </div>
            </div>
            <p class="font-body-md text-surface-cream text-body-md leading-relaxed"><?= get_text('events', 'calendar_desc', 'Check term schedules, periodic unit tests, quarterly assessments, board pre-boards, and gazetted school holidays.') ?></p>
          </div>
          <a class="btn-gold w-full text-center mt-2" href="<?= htmlspecialchars(get_text('events', 'calendar_btn_link', 'academics.php')) ?>">
            <span class="material-symbols-outlined text-[18px]">calendar_month</span> <?= get_text('events', 'calendar_btn_text', 'View Academic Syllabus') ?>
          </a>
        </div>

        <!-- Upcoming Events Mini-List -->
        <div class="bg-surface-pure rounded-xl p-6 sm:p-7 shadow-sm border border-border-warm flex flex-col flex-1 justify-between gap-5">
          <div class="flex items-center justify-between border-b border-border-warm pb-3">
            <h3 class="font-headline-sm text-headline-sm text-primary font-bold"><?= get_text('events', 'agenda_heading', 'Upcoming Agenda') ?></h3>
            <span class="material-symbols-outlined text-primary">event_upcoming</span>
          </div>
          <div class="flex flex-col justify-around flex-1 gap-4 py-1">
            <div class="flex items-start gap-4 pb-3 border-b border-border-warm/60 group">
              <div class="bg-surface-container-low text-primary p-2.5 rounded-lg text-center min-w-[52px] shrink-0">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag1[0] ?? '10') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold mt-0.5"><?= htmlspecialchars($ag1[1] ?? 'OCT') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda1_title', 'Parent-Teacher Meeting (PTM)') ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1.5"><span class="material-symbols-outlined text-[15px]">schedule</span> <?= get_text('events', 'agenda1_time', '09:00 AM - 01:00 PM') ?></span>
              </div>
            </div>
            <div class="flex items-start gap-4 pb-3 border-b border-border-warm/60 group">
              <div class="bg-surface-container-low text-primary p-2.5 rounded-lg text-center min-w-[52px] shrink-0">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag2[0] ?? '14') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold mt-0.5"><?= htmlspecialchars($ag2[1] ?? 'NOV') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda2_title', "Children's Day Cultural Fest") ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1.5"><span class="material-symbols-outlined text-[15px]">schedule</span> <?= get_text('events', 'agenda2_time', 'Full School Day') ?></span>
              </div>
            </div>
            <div class="flex items-start gap-4 group">
              <div class="bg-surface-container-low text-primary p-2.5 rounded-lg text-center min-w-[52px] shrink-0">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag3[0] ?? '22') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold mt-0.5"><?= htmlspecialchars($ag3[1] ?? 'DEC') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda3_title', 'National Mathematics Day Quiz') ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1.5"><span class="material-symbols-outlined text-[15px]">schedule</span> <?= get_text('events', 'agenda3_time', '10:00 AM - 12:30 PM') ?></span>
              </div>
            </div>
          </div>
          <a class="text-primary font-label-md hover:text-[#C9A24B] transition-colors text-center pt-3 border-t border-border-warm font-bold flex items-center justify-center gap-1" href="<?= htmlspecialchars(get_text('events', 'agenda_footer_link', 'contact-us.php')) ?>">
            <?= get_text('events', 'agenda_footer_text', 'Contact School Office for Inquiries →') ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- School Functions & Co-Curricular Activities Section -->
  <section class="relative w-full py-10 sm:py-12 lg:py-14 px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" id="functions-activities" style="background-color: #F7EFE8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.10) 0%, transparent 42%), radial-gradient(circle at 85% 80%, rgba(184, 134, 102, 0.09) 0%, transparent 46%);">
    <!-- Subtle Warm Nude Geometric / Academic Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#8d6e53 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(141, 110, 83, 0.06) 1px, transparent 1px), linear-gradient(to bottom, rgba(141, 110, 83, 0.06) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Soft Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#e8d5c4]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-[#C9A24B]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
        <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('events', 'functions_eyebrow', 'Holistic Development') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1.5"><?= get_text('events', 'functions_heading', 'Functions & Student Activities') ?></h2>
        <p class="font-body-md text-on-surface-variant mt-2 text-xs sm:text-sm"><?= get_text('events', 'functions_desc', 'From cultural pageants and annual sports meets to science exhibitions and academic olympiads, our students flourish across a vibrant calendar of events.') ?></p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-3 sm:gap-4.5">
        <!-- 1. Annual Function -->
        <div class="bg-[#F5EEFD] p-3.5 sm:p-4 rounded-xl border border-[#E2CEFC] hover:border-[#7C3AED] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#8B5CF6] to-[#6D28D9] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">celebration</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#3B0764]"><?= get_text('events', 'func1_title', 'Annual Function') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#581C87]/80 leading-snug"><?= get_text('events', 'func1_desc', 'Grand cultural showcase featuring theatrical acts, music, and dance.') ?></p>
        </div>

        <!-- 2. Annual Result Declaration Day -->
        <div class="bg-[#FEF8E7] p-3.5 sm:p-4 rounded-xl border border-[#FDE68A] hover:border-[#D97706] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#F59E0B] to-[#B45309] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">military_tech</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#78350F]"><?= get_text('events', 'func2_title', 'Result Declaration Day') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#92400E]/80 leading-snug"><?= get_text('events', 'func2_desc', 'Annual academic felicitation day honoring class and board rankers.') ?></p>
        </div>

        <!-- 3. Annual Sports Meet -->
        <div class="bg-[#FFF2EA] p-3.5 sm:p-4 rounded-xl border border-[#FDBA74] hover:border-[#EA580C] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EA580C] to-[#C2410C] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_score</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#7C2D12]"><?= get_text('events', 'func3_title', 'Annual Sports Meet') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9A3412]/80 leading-snug"><?= get_text('events', 'func3_desc', 'Inter-house track and field competitions, relay races, and games.') ?></p>
        </div>

        <!-- 4. Cultural Fest -->
        <div class="bg-[#FDF2F8] p-3.5 sm:p-4 rounded-xl border border-[#FBCFE8] hover:border-[#DB2777] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EC4899] to-[#BE185D] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">theater_comedy</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#831843]"><?= get_text('events', 'func4_title', 'Cultural Fest') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9D174D]/80 leading-snug"><?= get_text('events', 'func4_desc', 'Folk traditions, patriotic celebrations, skits, and instrumental music.') ?></p>
        </div>

        <!-- 5. Farewell Ceremony -->
        <div class="bg-[#EEF2FF] p-3.5 sm:p-4 rounded-xl border border-[#C7D2FE] hover:border-[#4F46E5] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#6366F1] to-[#4338CA] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">waving_hand</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#1E1B4B]"><?= get_text('events', 'func5_title', 'Farewell Ceremony') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#312E81]/80 leading-snug"><?= get_text('events', 'func5_desc', 'Blessings, mentorship, and warm send-off for passing-out Class 12 batches.') ?></p>
        </div>

        <!-- 6. Alumni Meet -->
        <div class="bg-[#ECFDF5] p-3.5 sm:p-4 rounded-xl border border-[#A7F3D0] hover:border-[#059669] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2" id="alumni">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#10B981] to-[#047857] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">groups_3</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#064E3B]"><?= get_text('events', 'func6_title', 'Alumni Meet') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#065F46]/80 leading-snug"><?= get_text('events', 'func6_desc', 'Reconnecting former students serving in administration, defence, and academia.') ?></p>
        </div>

        <!-- 7. Quiz Competition -->
        <div class="bg-[#F0F9FF] p-3.5 sm:p-4 rounded-xl border border-[#BAE6FD] hover:border-[#0284C7] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#0EA5E9] to-[#0369A1] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">psychology</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#0C4A6E]"><?= get_text('events', 'func7_title', 'Quiz Competition') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#075985]/80 leading-snug"><?= get_text('events', 'func7_desc', 'Block and district level GK, science, and history quiz contests.') ?></p>
        </div>

        <!-- 8. Science Exhibition -->
        <div class="bg-[#F0FDFA] p-3.5 sm:p-4 rounded-xl border border-[#99F6E4] hover:border-[#0D9488] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#14B8A6] to-[#0F766E] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">science</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#134E4A]"><?= get_text('events', 'func8_title', 'Science Exhibition') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#115E59]/80 leading-snug"><?= get_text('events', 'func8_desc', 'Interactive working models in robotics, physics, ecology, and chemistry.') ?></p>
        </div>

        <!-- 9. Rangoli Competitions -->
        <div class="bg-[#FFF1F2] p-3.5 sm:p-4 rounded-xl border border-[#FECDD3] hover:border-[#E11D48] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#F43F5E] to-[#BE123C] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">palette</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#881337]"><?= get_text('events', 'func9_title', 'Rangoli Competitions') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9F1239]/80 leading-snug"><?= get_text('events', 'func9_desc', 'Festive creativity celebrating Indian heritage, colors, and art forms.') ?></p>
        </div>

        <!-- 10. Debate Competitions -->
        <div class="bg-[#FFFBEB] p-3.5 sm:p-4 rounded-xl border border-[#FDE68A] hover:border-[#CA8A04] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EAB308] to-[#A16207] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">record_voice_over</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#713F12]"><?= get_text('events', 'func10_title', 'Debate Competitions') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#854D0E]/80 leading-snug"><?= get_text('events', 'func10_desc', 'Honing articulate expression, critical thinking, and public speaking.') ?></p>
        </div>

        <!-- 11. Olympiad Participation -->
        <div class="bg-[#EFF6FF] p-3.5 sm:p-4 rounded-xl border border-[#BFDBFE] hover:border-[#2563EB] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#3B82F6] to-[#1D4ED8] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">award_star</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#1E3A8A]"><?= get_text('events', 'func11_title', 'Olympiad Participation') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#1E40AF]/80 leading-snug"><?= get_text('events', 'func11_desc', 'National science, mathematics, and cyber olympiad competitive testing.') ?></p>
        </div>

        <!-- 12. Educational Seminars & Tours -->
        <div class="bg-[#F7FEE7] p-3.5 sm:p-4 rounded-xl border border-[#D9F99D] hover:border-[#65A30D] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#84CC16] to-[#4D7C0F] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">tour</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#365314]"><?= get_text('events', 'func12_title', 'Seminars & Tours') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#3F6212]/80 leading-snug"><?= get_text('events', 'func12_desc', 'Career guidance workshops and educational excursions to historic and scientific sites.') ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Comprehensive Institutional Achievements Section -->
  <section class="w-full py-10 sm:py-12 lg:py-14 px-6 lg:px-12 max-w-7xl mx-auto" id="achievements">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
      <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold">Hall of Fame</span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1.5">School Achievements &amp; Accolades</h2>
      <p class="font-body-md text-on-surface-variant mt-2 text-xs sm:text-sm">Reflecting the perseverance of our students, the guidance of our faculty, and an enduring legacy of excellence in sports and academics.</p>
    </div>

    <!-- 2 Column Layout: Sports Honors on Left, School & Academic Awards on Right -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
      <!-- Left: Sports Achievements -->
      <div class="bg-surface-pure rounded-2xl p-6 sm:p-7 border border-border-warm shadow-sm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-3 mb-5 pb-3.5 border-b border-border-warm">
            <div class="w-11 h-11 rounded-xl bg-amber-500/15 text-amber-600 flex items-center justify-center shrink-0">
              <span class="material-symbols-outlined text-[26px]">trophy</span>
            </div>
            <div>
              <span class="text-xs font-bold text-[#C9A24B] uppercase tracking-wider"><?= get_text('events', 'sports_achieve_tag', 'State & National Honors') ?></span>
              <h3 class="font-headline-sm text-base sm:text-lg font-bold text-primary"><?= get_text('events', 'sports_achieve_title', 'Sports Achievements') ?></h3>
            </div>
          </div>

          <div class="space-y-3">
            <!-- Wrestling 2023 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'sports_item1_badge', '🥇') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'sports_item1_sub', '2023 • National Sub-Junior Wrestling Championship') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'sports_item1_title', '2 Gold Medals') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'sports_item1_desc', 'Outstanding national glory in sub-junior wrestling representing Haryana.') ?></p>
              </div>
            </div>

            <!-- Kickboxing 2018 & 2019 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-800 flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'sports_item2_badge', '🥈') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'sports_item2_sub', '2018 & 2019 • State Level Kickboxing Championship') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'sports_item2_title', '2 Silver Medals & 1 Bronze Medal (2018)') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'sports_item2_desc', 'Continuous podium finishes at the Haryana State Kickboxing Tournaments.') ?></p>
              </div>
            </div>

            <!-- Kickboxing District 2017 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-orange-100 text-orange-800 flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'sports_item3_badge', '🥉') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'sports_item3_sub', '2017 • District Kickboxing Tournament') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'sports_item3_title', '1 Bronze Medal') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'sports_item3_desc', 'Remarkable district level combat sports victory in Hisar.') ?></p>
              </div>
            </div>

            <!-- SPAT Selections 2014, 2015, 2016 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'sports_item4_badge', '🏃') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'sports_item4_sub', '2014, 2015 & 2016 • SPAT Athletic Competition') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'sports_item4_title', '5 Students Selected in Sports Physical Aptitude Test') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'sports_item4_desc', 'Selected for government athletic sponsorship through rigorous athletic testing.') ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3.5 border-t border-border-warm flex items-center justify-between text-xs text-on-surface-variant font-bold">
          <span><?= get_text('events', 'sports_achieve_footer', 'Disciplines: Wrestling • Kickboxing • Athletics') ?></span>
          <a href="<?= htmlspecialchars(get_text('events', 'sports_achieve_link_url', 'campus.php#sports')) ?>" class="text-[#C9A24B] hover:underline flex items-center gap-1"><?= get_text('events', 'sports_achieve_link_text', 'Sports Ground →') ?></a>
        </div>
      </div>

      <!-- Right: Awards Achieved by School -->
      <div class="bg-surface-pure rounded-2xl p-6 sm:p-7 border border-border-warm shadow-sm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-3 mb-5 pb-3.5 border-b border-border-warm">
            <div class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
              <span class="material-symbols-outlined text-[26px] text-[#C9A24B]">workspace_premium</span>
            </div>
            <div>
              <span class="text-xs font-bold text-[#C9A24B] uppercase tracking-wider"><?= get_text('events', 'school_awards_tag', 'Institutional Triumphs') ?></span>
              <h3 class="font-headline-sm text-base sm:text-lg font-bold text-primary"><?= get_text('events', 'school_awards_title', 'Awards Achieved by School') ?></h3>
            </div>
          </div>

          <div class="space-y-3">
            <!-- Block Quiz 2022 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-primary text-[#C9A24B] flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'award_item1_badge', '★') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'award_item1_sub', '2022 • Block Level Quiz Competition') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'award_item1_title', '1st Position / Winner') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'award_item1_desc', 'Outperformed top regional institutions with deep general awareness and speed.') ?></p>
              </div>
            </div>

            <!-- Talent Search 2017 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-primary text-[#C9A24B] flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'award_item2_badge', '★') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'award_item2_sub', '2017 • Talent Search Examination (Block Level)') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'award_item2_title', 'Winner & Rural Topper • 1st, 2nd & 3rd Positions') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'award_item2_desc', 'Swept top 3 ranks among participants from more than 25 schools and over 1,500 students.') ?></p>
              </div>
            </div>

            <!-- Physics Point 2016 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-primary text-[#C9A24B] flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'award_item3_badge', '★') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'award_item3_sub', '2016 • Physics Point Prize Test') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'award_item3_title', 'Best School Award • 10 Students in Top 200') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'award_item3_desc', 'Conferred Best School Award; 10 students ranked within top 200 out of 2,700+ participants.') ?></p>
              </div>
            </div>

            <!-- Science Exhibition 2013 -->
            <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-container-low">
              <div class="w-7 h-7 rounded-full bg-primary text-[#C9A24B] flex items-center justify-center flex-shrink-0 font-bold text-xs mt-0.5">
                <?= get_text('events', 'award_item4_badge', '★') ?>
              </div>
              <div>
                <span class="text-[11px] font-bold text-primary uppercase"><?= get_text('events', 'award_item4_sub', '2013 • Science Exhibition at CCSHAU, Hisar') ?></span>
                <p class="text-xs sm:text-sm font-semibold text-primary mt-0.5"><?= get_text('events', 'award_item4_title', 'State Level Selection (2 Students)') ?></p>
                <p class="text-[11px] sm:text-xs text-on-surface-variant"><?= get_text('events', 'award_item4_desc', 'Recognized for innovative scientific project design and state-level representation.') ?></p>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3.5 border-t border-border-warm flex items-center justify-between text-xs text-on-surface-variant font-bold">
          <span><?= get_text('events', 'school_awards_footer', 'Board Examination: 100% Pass Record') ?></span>
          <a href="<?= htmlspecialchars(get_text('events', 'school_awards_link_url', 'academics.php#toppers')) ?>" class="text-[#C9A24B] hover:underline flex items-center gap-1"><?= get_text('events', 'school_awards_link_text', 'View Board Toppers →') ?></a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
