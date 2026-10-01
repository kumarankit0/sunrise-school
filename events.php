<?php
$current_page = 'events-news';
$page_title = 'Events & News | School Happenings';
$page_description = 'Stay up-to-date with annual functions, science exhibitions, sports meets, national day celebrations, and academic announcements at Sun Rise Sr. Sec. School, Dobhi.';
$page_keywords = 'school events, upcoming events, science exhibition, sports meet, school news, Sun Rise School Dobhi';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Background Banner — full image, no crop, no gap -->
  <section class="hero-section relative w-full bg-[#00122e]">
    <img
      src="<?= get_image('events', 'featured_banner', school_img('award_ceremony.webp')) ?>"
      alt="Sun Rise School Events & News — Hero Banner"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />
    <div class="absolute inset-0 bg-gradient-to-b from-primary/50 via-primary/20 to-primary/65 pointer-events-none" style="z-index:5;"></div>
    <div class="hero-overlay-wrap">
      <div class="hero-content relative max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-12 flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-6">
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
          <!-- Filter Chips: Cultural Fest & School Activity -->
          <div class="flex items-center gap-2 flex-wrap">
            <button class="event-filter-btn bg-primary text-on-primary px-4 py-2 rounded-lg text-label-sm transition-all shadow-sm font-bold" data-filter="all" onclick="filterEvents('all')">All</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="cultural" onclick="filterEvents('cultural')">Cultural Fest</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="activity" onclick="filterEvents('activity')">School Activity</button>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="events-news-grid">
          <?php
          $ag1 = explode(' ', get_text('events', 'agenda1_date', '10 OCT'));
          $ag2 = explode(' ', get_text('events', 'agenda2_date', '14 NOV'));
          $ag3 = explode(' ', get_text('events', 'agenda3_date', '22 DEC'));

          $event_cards = get_event_news_cards(false);
          foreach ($event_cards as $card):
              $d_parts = explode(' ', trim($card['date']));
              $d_day   = $d_parts[0] ?? '01';
              $d_month = $d_parts[1] ?? 'JAN';
              $cat_raw  = strtolower(trim($card['category'] ?? 'cultural'));
              $cat_attr = in_array($cat_raw, ['activity', 'campus']) ? 'activity' : 'cultural';
          ?>
            <!-- Card #<?= (int)$card['slot'] ?>: <?= htmlspecialchars($card['title']) ?> -->
            <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="<?= htmlspecialchars($cat_attr) ?>">
              <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= htmlspecialchars($card['img']) ?>')"></div>
                <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                  <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d_day) ?></span>
                  <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d_month) ?></span>
                </div>
                <?php if (!empty($card['tag'])): ?>
                  <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= htmlspecialchars($card['tag']) ?></span>
                <?php endif; ?>
              </div>
              <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                <div>
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= htmlspecialchars($card['title']) ?></h3>
                  <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-2"><?= htmlspecialchars($card['desc']) ?></p>
                </div>
                <?php if (!empty($card['link_url'])): ?>
                  <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="<?= htmlspecialchars($card['link_url']) ?>">
                    <?= htmlspecialchars($card['link_text'] ?: 'Read More') ?> <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Sidebar (4 Cols) -->
      <div class="lg:col-span-4 flex flex-col gap-6 lg:gap-8 h-fit lg:sticky lg:top-24">
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
          <?php
          $cal_img = get_image('events', 'calendar_file_img', school_img('pop-up image.webp'));
          $cal_btn_text = get_text('events', 'calendar_btn_text', 'Download School Calendar');
          ?>
          <button type="button" class="btn-gold w-full text-center mt-2 flex items-center justify-center gap-2 cursor-pointer shadow-md hover:shadow-lg transition-all" onclick="downloadCalendarFile('<?= htmlspecialchars($cal_img) ?>', 'Sun_Rise_School_Academic_Calendar')">
            <span class="material-symbols-outlined text-[18px]">download</span>
            <span><?= htmlspecialchars($cal_btn_text) ?></span>
          </button>
        </div>

        <!-- Upcoming Events Mini-List -->
        <div class="bg-surface-pure rounded-xl p-6 sm:p-7 shadow-sm border border-border-warm flex flex-col gap-5">
          <div class="flex items-center justify-between border-b border-border-warm pb-3">
            <h3 class="font-headline-sm text-headline-sm text-primary font-bold"><?= get_text('events', 'agenda_heading', 'Upcoming Agenda') ?></h3>
            <span class="material-symbols-outlined text-primary">event_upcoming</span>
          </div>
          <div class="flex flex-col gap-4 py-1">
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

  <!-- Sports & Physical Education Section -->
  <section class="relative w-full py-10 sm:py-12 lg:py-14 px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10 scroll-mt-24" id="sports-activities" style="background-color: #F7EFE8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.10) 0%, transparent 42%), radial-gradient(circle at 85% 80%, rgba(184, 134, 102, 0.09) 0%, transparent 46%);">
    <span id="sports" class="absolute -top-28 left-0 pointer-events-none w-0 h-0 opacity-0"></span>
    <span id="sports-physical-education" class="absolute -top-28 left-0 pointer-events-none w-0 h-0 opacity-0"></span>
    <span id="activities" class="absolute -top-28 left-0 pointer-events-none w-0 h-0 opacity-0"></span>
    <span id="functions-activities" class="absolute -top-28 left-0 pointer-events-none w-0 h-0 opacity-0"></span>
    <!-- Subtle Warm Nude Geometric / Academic Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#8d6e53 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(141, 110, 83, 0.06) 1px, transparent 1px), linear-gradient(to bottom, rgba(141, 110, 83, 0.06) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Soft Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#e8d5c4]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-[#C9A24B]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
        <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('events', 'functions_eyebrow', 'Athletics & Physical Fitness') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1.5"><?= get_text('events', 'functions_heading', 'Sports & Physical Education') ?></h2>
        <p class="font-body-md text-on-surface-variant mt-2 text-xs sm:text-sm"><?= get_text('events', 'functions_desc', 'Fostering physical endurance, sportsmanship, team spirit, and mental resilience through dedicated athletic coaching, combat disciplines, traditional sports, and daily yoga.') ?></p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-3 sm:gap-4.5">
        <!-- 1. Track & Field Athletics -->
        <div class="bg-[#F5EEFD] p-3.5 sm:p-4 rounded-xl border border-[#E2CEFC] hover:border-[#7C3AED] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#8B5CF6] to-[#6D28D9] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sprint</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#3B0764]"><?= get_text('events', 'func1_title', 'Track & Field Athletics') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#581C87]/80 leading-snug"><?= get_text('events', 'func1_desc', '100m/200m sprints, 4x100m relay races, long jump, shot put, and endurance running on athletic tracks.') ?></p>
        </div>

        <!-- 2. Wrestling & Grappling -->
        <div class="bg-[#FEF8E7] p-3.5 sm:p-4 rounded-xl border border-[#FDE68A] hover:border-[#D97706] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#F59E0B] to-[#B45309] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_kabaddi</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#78350F]"><?= get_text('events', 'func2_title', 'Wrestling & Grappling') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#92400E]/80 leading-snug"><?= get_text('events', 'func2_desc', 'National sub-junior medal-winning wrestling coaching with mat practice and strength drills.') ?></p>
        </div>

        <!-- 3. Kickboxing & Martial Arts -->
        <div class="bg-[#FFF2EA] p-3.5 sm:p-4 rounded-xl border border-[#FDBA74] hover:border-[#EA580C] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EA580C] to-[#C2410C] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_martial_arts</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#7C2D12]"><?= get_text('events', 'func3_title', 'Kickboxing & Martial Arts') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9A3412]/80 leading-snug"><?= get_text('events', 'func3_desc', 'State tournament podium-winning combat sports training focusing on self-defense, agility, and reflexes.') ?></p>
        </div>

        <!-- 4. Yoga & Mindful Pranayama -->
        <div class="bg-[#FDF2F8] p-3.5 sm:p-4 rounded-xl border border-[#FBCFE8] hover:border-[#DB2777] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EC4899] to-[#BE185D] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">self_improvement</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#831843]"><?= get_text('events', 'func4_title', 'Yoga & Mindful Pranayama') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9D174D]/80 leading-snug"><?= get_text('events', 'func4_desc', 'Daily morning yogic asanas, surya namaskar, pranayama, and meditation cultivating mindfulness.') ?></p>
        </div>

        <!-- 5. Kabaddi & Kho-Kho -->
        <div class="bg-[#EEF2FF] p-3.5 sm:p-4 rounded-xl border border-[#C7D2FE] hover:border-[#4F46E5] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#6366F1] to-[#4338CA] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_handball</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#1E1B4B]"><?= get_text('events', 'func5_title', 'Kabaddi & Kho-Kho') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#312E81]/80 leading-snug"><?= get_text('events', 'func5_desc', 'Traditional Indian agility sports fostering team tactics, strategic raiding, fast reflexes, and stamina.') ?></p>
        </div>

        <!-- 6. Volleyball & Court Games -->
        <div class="bg-[#ECFDF5] p-3.5 sm:p-4 rounded-xl border border-[#A7F3D0] hover:border-[#059669] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#10B981] to-[#047857] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_volleyball</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#064E3B]"><?= get_text('events', 'func6_title', 'Volleyball & Court Games') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#065F46]/80 leading-snug"><?= get_text('events', 'func6_desc', 'Inter-house volleyball matches, smash techniques, service drills, and court coordination.') ?></p>
        </div>

        <!-- 7. Cricket & Net Practice -->
        <div class="bg-[#F0F9FF] p-3.5 sm:p-4 rounded-xl border border-[#BAE6FD] hover:border-[#0284C7] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#0EA5E9] to-[#0369A1] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_cricket</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#0C4A6E]"><?= get_text('events', 'func7_title', 'Cricket & Net Practice') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#075985]/80 leading-snug"><?= get_text('events', 'func7_desc', 'Structured cricket training including batting, pace and spin bowling nets, wicket-keeping, and match play.') ?></p>
        </div>

        <!-- 8. Football & Soccer Drills -->
        <div class="bg-[#F0FDFA] p-3.5 sm:p-4 rounded-xl border border-[#99F6E4] hover:border-[#0D9488] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#14B8A6] to-[#0F766E] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">sports_soccer</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#134E4A]"><?= get_text('events', 'func8_title', 'Football & Soccer Drills') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#115E59]/80 leading-snug"><?= get_text('events', 'func8_desc', 'Dribbling drills, passing precision, positional play, and high-stamina team games on campus grounds.') ?></p>
        </div>

        <!-- 9. Mass PT & Morning Drills -->
        <div class="bg-[#FFF1F2] p-3.5 sm:p-4 rounded-xl border border-[#FECDD3] hover:border-[#E11D48] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#F43F5E] to-[#BE123C] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">exercise</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#881337]"><?= get_text('events', 'func9_title', 'Mass PT & Morning Drills') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#9F1239]/80 leading-snug"><?= get_text('events', 'func9_desc', 'Disciplined morning physical drills, synchronized squad exercise, posture correction, and rhythmic training.') ?></p>
        </div>

        <!-- 10. Annual Sports Day & Meet -->
        <div class="bg-[#FFFBEB] p-3.5 sm:p-4 rounded-xl border border-[#FDE68A] hover:border-[#CA8A04] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#EAB308] to-[#A16207] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">emoji_events</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#713F12]"><?= get_text('events', 'func10_title', 'Annual Sports Day & Meet') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#854D0E]/80 leading-snug"><?= get_text('events', 'func10_desc', 'Grand annual inter-house sports festival featuring march past, track competitions, and championship trophies.') ?></p>
        </div>

        <!-- 11. SPAT & Physical Aptitude -->
        <div class="bg-[#EFF6FF] p-3.5 sm:p-4 rounded-xl border border-[#BFDBFE] hover:border-[#2563EB] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#3B82F6] to-[#1D4ED8] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">fitness_center</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#1E3A8A]"><?= get_text('events', 'func11_title', 'SPAT & Physical Aptitude') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#1E40AF]/80 leading-snug"><?= get_text('events', 'func11_desc', 'Dedicated guidance for the Haryana Sports Physical Aptitude Test (SPAT) and government talent scholarships.') ?></p>
        </div>

        <!-- 12. Health, Wellness & First Aid -->
        <div class="bg-[#F7FEE7] p-3.5 sm:p-4 rounded-xl border border-[#D9F99D] hover:border-[#65A30D] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all flex flex-col items-center text-center gap-2">
          <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#84CC16] to-[#4D7C0F] text-white shadow-sm flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">health_and_safety</span>
          </div>
          <h4 class="font-headline-sm text-xs sm:text-sm font-bold text-[#365314]"><?= get_text('events', 'func12_title', 'Health, Wellness & First Aid') ?></h4>
          <p class="text-[11px] sm:text-xs text-[#3F6212]/80 leading-snug"><?= get_text('events', 'func12_desc', 'Sports safety guidelines, nutritional hydration guidance, sportsmanship values, and immediate first aid care.') ?></p>
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

<script>
function downloadCalendarFile(fileUrl, fileName) {
  if (!fileUrl) {
    alert("Calendar image is currently being updated by the school office.");
    return;
  }

  // Attempt blob download to ensure it downloads as a file without navigating away
  fetch(fileUrl)
    .then(res => {
      if (!res.ok) throw new Error('Network error');
      return res.blob();
    })
    .then(blob => {
      const blobUrl = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = blobUrl;
      
      const extMatch = fileUrl.match(/\.([a-zA-Z0-9]+)(\?.*)?$/);
      const ext = extMatch ? extMatch[1] : 'webp';
      a.download = `${fileName || 'Sun_Rise_School_Calendar'}.${ext}`;
      
      document.body.appendChild(a);
      a.click();
      setTimeout(() => {
        window.URL.revokeObjectURL(blobUrl);
        a.remove();
      }, 1000);
    })
    .catch(() => {
      // Direct anchor download fallback
      const a = document.createElement('a');
      a.href = fileUrl;
      a.setAttribute('download', fileName || 'Sun_Rise_School_Calendar');
      a.target = '_blank';
      document.body.appendChild(a);
      a.click();
      setTimeout(() => a.remove(), 1000);
    });
}
</script>

<?php
require_once __DIR__ . '/core/footer.php';
?>
