<?php
$current_page = 'home';
$page_title = 'Welcome to Sun Rise Sr. Sec. School, Dobhi';
$page_description = 'Sun Rise Sr. Sec. School, Dobhi offers premier HBSE education from Pre-Primary to Senior Secondary streams with state-of-the-art infrastructure, experienced faculty, and holistic learning.';
$page_keywords = 'Sun Rise Sr. Sec. School Dobhi, best HBSE school Hisar, admissions 2026-27, senior secondary school, science commerce arts streams, top school Haryana';

require_once __DIR__ . '/core/header.php';

// Hero dynamic slide images for 4-direction box transition
$hero_slides = [
    get_image('home', 'hero_banner', school_img('school_home1.webp')),
    school_img('school_home2.webp'),
    school_img('students_ground.webp'),
    school_img('project.webp'),
    school_img('school_nightview.webp'),
    school_img('exhibition.webp')
];
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Dynamic 4-Direction Box Mosaic Slider -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary">
    <!-- Dynamic Hero 4-Direction Box Slider Container -->
    <div id="hero-box-slider" class="hero-box-slider" data-slides='<?= htmlspecialchars(json_encode($hero_slides), ENT_QUOTES, 'UTF-8') ?>' aria-hidden="true">
      <div class="hero-slide-base" style="background-image: url('<?= $hero_slides[0] ?>')"></div>
      <div class="hero-grid-container"></div>
      <!-- Slide Indicator Dots -->
      <div id="heroSliderIndicators" class="hero-slider-indicators"></div>
    </div>
    <!-- Soft Light Brand Gradient Overlay for vibrant bright campus photos & crisp text -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/45 via-primary/20 to-primary/55 z-10 pointer-events-none"></div>
    <div class="relative z-20 max-w-6xl mx-auto px-6 lg:px-12 w-full flex flex-col items-center text-center gap-7">
      <div class="inline-flex items-center gap-2.5 bg-black/40 backdrop-blur-md border border-[#C9A24B]/50 px-5 py-2 rounded-full text-gold-light text-eyebrow font-bold shadow-lg">
        <span class="material-symbols-outlined text-[18px] text-[#C9A24B]">military_tech</span>
        <?= get_text('home', 'hero_badge', 'AFFILIATED TO HBSE &bull; PRE-PRIMARY TO SENIOR SECONDARY (10+2)') ?>
      </div>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white w-full max-w-5xl tracking-tight leading-[1.12] drop-shadow-md">
        <?= get_text('home', 'hero_title', 'Empowering Minds, Inspiring Character & <span class="text-[#C9A24B] italic">Academic Excellence</span>') ?>
      </h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl font-body leading-relaxed drop-shadow">
        <?= get_text('home', 'hero_subtitle', 'Welcome to Sun Rise Sr. Sec. School, Dobhi. We foster an enriching educational environment combining rigorous HBSE scholarship, moral values, modern technology, and sportsmanship.') ?>
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 pt-3">
        <a class="btn-gold text-base sm:text-lg px-8 py-4 shadow-xl" href="admission.php">
          <span>Admissions 2026–27</span>
          <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
        </a>
        <a class="btn-outline-white text-base sm:text-lg px-8 py-4 shadow-xl" href="campus.php">
          <span>Explore Campus</span>
          <span class="material-symbols-outlined text-[20px]">domain</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Continuous Moving School Ticker Strip (Right to Left Marquee) -->
  <div class="school-ticker-strip w-full bg-[#001129] border-y border-[#C9A24B]/40 overflow-hidden flex items-stretch relative z-20 shadow-md">
    <!-- Left Fixed Badge / Label -->
    <div class="ticker-badge flex-shrink-0 bg-gradient-to-r from-[#C9A24B] to-[#B38C37] text-primary px-4 sm:px-6 py-2.5 sm:py-3.5 flex items-center gap-2 font-bold text-xs sm:text-sm uppercase tracking-wider z-10 shadow-lg select-none">
      <span class="material-symbols-outlined text-[18px] sm:text-[20px] animate-pulse">campaign</span>
      <span class="whitespace-nowrap font-headline">Latest Updates</span>
    </div>
    
    <!-- Moving Track Container -->
    <div class="ticker-marquee-track-wrapper flex-1 overflow-hidden relative py-2.5 sm:py-3.5 flex items-center">
      <div class="ticker-marquee-track flex items-center whitespace-nowrap">
        <!-- Sequence 1 -->
        <div class="ticker-marquee-group flex items-center gap-8 sm:gap-12 text-xs sm:text-sm font-medium text-white/95 pl-4 sm:pl-6">
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Admissions 2026-27:</strong> Pre-Primary to Senior Secondary (10+2) Open &bull; Science, Commerce &amp; Arts Streams.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">HBSE Board Excellence:</strong> 100% Board Exam Pass Results with District &amp; State Merit Positions.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Hi-Tech Laboratories:</strong> Modern Physics, Chemistry, Biology &amp; Computer Science Practical Labs.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Safe GPS Transport:</strong> Dedicated school bus fleet covering Dobhi, Arya Nagar &amp; all surrounding areas.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Holistic Sports &amp; Yoga:</strong> Expansive Sports Grounds, Annual Athletic Meets &amp; Physical Fitness.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Experienced Faculty:</strong> 1:15 Teacher-to-Student Ratio with Individualized Academic Guidance.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Smart Classrooms:</strong> Interactive Audio-Visual Learning &amp; Well-Stocked Digital Library.
          </span>
        </div>

        <!-- Sequence 2 (Duplicate for Seamless Infinite Marquee Loop) -->
        <div class="ticker-marquee-group flex items-center gap-8 sm:gap-12 text-xs sm:text-sm font-medium text-white/95 pl-8 sm:pl-12" aria-hidden="true">
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Admissions 2026-27:</strong> Pre-Primary to Senior Secondary (10+2) Open &bull; Science, Commerce &amp; Arts Streams.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">HBSE Board Excellence:</strong> 100% Board Exam Pass Results with District &amp; State Merit Positions.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Hi-Tech Laboratories:</strong> Modern Physics, Chemistry, Biology &amp; Computer Science Practical Labs.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Safe GPS Transport:</strong> Dedicated school bus fleet covering Dobhi, Arya Nagar &amp; all surrounding areas.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Holistic Sports &amp; Yoga:</strong> Expansive Sports Grounds, Annual Athletic Meets &amp; Physical Fitness.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Experienced Faculty:</strong> 1:15 Teacher-to-Student Ratio with Individualized Academic Guidance.
          </span>
          <span class="inline-flex items-center gap-2.5">
            <span class="text-[#C9A24B] font-bold text-base">★</span>
            <strong class="text-[#C9A24B] font-bold">Smart Classrooms:</strong> Interactive Audio-Visual Learning &amp; Well-Stocked Digital Library.
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Welcome / Spotlight & Stats Section -->
  <section class="w-full py-14 lg:py-24 bg-surface relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
      <div class="lg:col-span-6 flex flex-col gap-5 sm:gap-6">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'legacy_tagline', 'THE SUN RISE LEGACY') ?></div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-primary tracking-tight leading-tight">
          <?= get_text('home', 'legacy_heading', 'A Tradition of Holistic Education &amp; Outstanding Results') ?>
        </h2>
        <p class="text-sm sm:text-base lg:text-body-lg text-on-surface-variant font-body leading-relaxed">
          <?= get_text('home', 'legacy_description', "At Sun Rise Sr. Sec. School, Dobhi, we are dedicated to nurturing each student's intellectual, physical, and moral growth. Through cutting-edge science labs, dedicated sports facilities, and exemplary faculty mentorship, our students consistently achieve top honours in HBSE board exams and competitive Olympiads.") ?>
        </p>
        <div class="grid grid-cols-2 gap-3 sm:gap-6 pt-2 sm:pt-4">
          <div class="p-3.5 sm:p-5 lg:p-6 bg-surface-container-low rounded-xl border border-border-warm">
            <div class="text-xl sm:text-2xl lg:text-[32px] font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_pass_rate', '100%') ?></div>
            <div class="text-body-sm text-[11px] sm:text-xs lg:text-sm text-on-surface-variant mt-1 leading-snug">HBSE Board Pass Result</div>
          </div>
          <div class="p-3.5 sm:p-5 lg:p-6 bg-surface-container-low rounded-xl border border-border-warm">
            <div class="text-xl sm:text-2xl lg:text-[32px] font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_student_ratio', '1:15') ?></div>
            <div class="text-body-sm text-[11px] sm:text-xs lg:text-sm text-on-surface-variant mt-1 leading-snug">Teacher-to-Student Ratio</div>
          </div>
        </div>
      </div>
      <!-- Live Event Tracker (Replaces 4 Number Cards as Requested) -->
      <div class="lg:col-span-6 w-full">
        <?php 
          $tracker_events = get_live_tracker_events(); 
          $tracker_gold   = get_text('home', 'live_tracker_gold', 'UPCOMING');
          $tracker_white  = get_text('home', 'live_tracker_white', 'EVENTS');
          $tracker_badge  = get_text('home', 'live_tracker_badge', 'LIVE TRACKER');
        ?>
        <div class="live-tracker-card" aria-label="Upcoming School Events & Live Tracker">
          <!-- Header (Matching Reference Design: UPCOMING in Gold, EVENTS in White) -->
          <div class="live-tracker-header">
            <div class="live-tracker-badge">
              <span class="live-tracker-pulse-dot" aria-hidden="true"></span>
              <span><?= htmlspecialchars($tracker_badge) ?></span>
            </div>
            <h3 class="live-tracker-title">
              <span class="title-gold"><?= htmlspecialchars($tracker_gold) ?></span>
              <span class="title-white"><?= htmlspecialchars($tracker_white) ?></span>
            </h3>
          </div>

          <!-- Vertical Auto-Scroll Ticker Window (Moves continuously from Bottom to Top) -->
          <div class="live-tracker-window" tabindex="0" role="region" aria-label="Auto-scrolling Event List. Hover or focus to pause.">
            <div class="live-tracker-track">
              <!-- Track Set 1 -->
              <div class="live-tracker-group">
                <?php foreach ($tracker_events as $evt): ?>
                  <a href="<?= htmlspecialchars($evt['link']) ?>" class="live-tracker-item">
                    <span class="live-tracker-bullet" aria-hidden="true">&#9642;</span>
                    <div class="live-tracker-item-content">
                      <div>
                        <span class="live-tracker-item-title"><?= htmlspecialchars($evt['title']) ?></span>
                        <?php if (!empty($evt['badge'])): ?>
                          <span class="badge-new-pulse"><?= htmlspecialchars($evt['badge']) ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
              </div>

              <!-- Track Set 2 (Duplicate for Seamless Infinite Upward Loop) -->
              <div class="live-tracker-group" aria-hidden="true">
                <?php foreach ($tracker_events as $evt): ?>
                  <a href="<?= htmlspecialchars($evt['link']) ?>" class="live-tracker-item" tabindex="-1">
                    <span class="live-tracker-bullet">&#9642;</span>
                    <div class="live-tracker-item-content">
                      <div>
                        <span class="live-tracker-item-title"><?= htmlspecialchars($evt['title']) ?></span>
                        <?php if (!empty($evt['badge'])): ?>
                          <span class="badge-new-pulse"><?= htmlspecialchars($evt['badge']) ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- Tracker Footer -->
          <div class="live-tracker-footer">
            <span class="text-xs text-slate-400 flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[15px] text-[#C9A24B]">touch_app</span>
              <span>Hover or tap to pause</span>
            </span>
            <a href="events.php" class="live-tracker-footer-link">
              <span>View All Events</span>
              <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3-Card Feature Row: Academics, Sports, Co-curricular -->
  <section class="w-full py-16 sm:py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex flex-col gap-12 sm:gap-16">
      <!-- Section Header (Centered, 100% Width, Mobile Responsive) -->
      <div class="w-full max-w-4xl mx-auto flex flex-col items-center text-center gap-3">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'pillars_eyebrow', 'WHY CHOOSE SUN RISE') ?></div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-primary tracking-tight leading-tight">
          <?= get_text('home', 'pillars_heading', 'Pillars of Holistic Development') ?>
        </h2>
        <div class="w-14 h-1 bg-[#C9A24B] rounded-full my-1"></div>
        <p class="text-sm sm:text-base md:text-lg text-on-surface-variant max-w-2xl font-body leading-relaxed">
          <?= get_text('home', 'pillars_desc', 'Our balanced framework ensures intellectual achievement is complemented by discipline, sportsmanship, and creative expression.') ?>
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1: Academics -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card1_image', school_img('project.webp')) ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card1_tag', 'HBSE CURRICULUM') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card1_title', 'Science &amp; Practical Labs') ?></h3>
              <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'card1_desc', 'State-of-the-art Physics, Chemistry, Biology, and Computer Science laboratories enabling experiential, hands-on scientific learning.') ?></p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="academics.php">
              <?= get_text('home', 'card1_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- Card 2: Sports -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card2_image', school_img('students_ground.webp')) ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card2_tag', 'ATHLETICS &amp; FITNESS') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card2_title', 'Sports Ground &amp; Yoga') ?></h3>
              <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'card2_desc', 'Spacious athletic playfields, track events, cricket, volleyball, football, and daily morning yoga for physical and mental vigour.') ?></p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="campus.php">
              <?= get_text('home', 'card2_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- Card 3: Co-curricular -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card3_image', school_img('exhibition.webp')) ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card3_tag', 'INNOVATION &amp; ART') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card3_title', 'Science &amp; Art Exhibitions') ?></h3>
              <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'card3_desc', 'Annual science exhibitions, model-making fairs, cultural assemblies, debate contests, and creative arts celebrations.') ?></p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="gallery.php">
              <?= get_text('home', 'card3_link_text', 'Read More') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Message from the Principal / Management -->
  <section class="w-full py-24 bg-surface relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-5 relative">
        <div class="absolute -top-4 -left-4 w-full h-full bg-[#C9A24B]/10 rounded-2xl"></div>
        <div class="relative rounded-xl overflow-hidden shadow-xl aspect-[4/5] bg-cover bg-center" style="background-image: url('<?= get_image('home', 'leader_photo', school_img('speaker.webp')) ?>')"></div>
      </div>
      <div class="lg:col-span-7 flex flex-col gap-6 lg:pl-10">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'leader_tagline', 'LEADERSHIP MESSAGE') ?></div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-primary tracking-tight leading-tight">
          <?= get_text('home', 'leader_heading', 'Guiding Young Minds Towards Bright Futures') ?>
        </h2>
        <blockquote class="text-title-editorial font-headline-md italic text-on-surface border-l-4 border-[#C9A24B] pl-6 py-2 my-4">
          <?= get_text('home', 'leader_quote', '“Education at Sun Rise is not only about securing top marks, but about cultivating strong character, moral courage, and curiosity to achieve lasting success in life.”') ?>
        </blockquote>
        <p class="text-body-md text-on-surface-variant font-body">
          <?= get_text('home', 'leader_paragraph', 'At Sun Rise Sr. Sec. School, Dobhi, we provide an inspiring sanctuary of learning where every child is valued and encouraged to realize their maximum potential. Our devoted faculty strives tirelessly to ensure each student shines bright like the rising sun.') ?>
        </p>
        <div class="pt-4 flex items-center gap-4">
          <div>
            <div class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'leader_name', 'School Leadership &amp; Principal') ?></div>
            <div class="text-body-sm text-on-surface-variant"><?= get_text('home', 'leader_title', 'Sun Rise Sr. Sec. School, Dobhi') ?></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </section>

  <!-- Upcoming Events & News Section -->
  <section class="w-full py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-12">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'events_eyebrow', 'NOTICES &amp; HAPPENINGS') ?></div>
          <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-primary tracking-tight leading-tight mt-2"><?= get_text('home', 'events_heading', 'School Events &amp; News') ?></h2>
        </div>
        <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="events.php">
          View All Events <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Event Card 1 -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col justify-between p-8 gap-6 shadow-sm">
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event1_tag', 'ACADEMIC') ?></span>
              <span class="text-body-sm text-on-surface-variant font-bold"><?= get_text('home', 'event1_badge', 'ANNUAL') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'event1_title', 'Annual Science &amp; Innovation Exhibition') ?></h3>
            <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'event1_desc', 'Students display innovative working models, robotics experiments, and environmental science projects.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary"><?= get_text('home', 'event1_loc', 'School Campus') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="events.php">Explore Details →</a>
          </div>
        </div>
        <!-- Event Card 2 -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col justify-between p-8 gap-6 shadow-sm">
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event2_tag', 'CEREMONY') ?></span>
              <span class="text-body-sm text-on-surface-variant font-bold"><?= get_text('home', 'event2_badge', 'AWARDS') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'event2_title', 'Prize Distribution &amp; Felicitation Day') ?></h3>
            <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'event2_desc', 'Honouring board exam toppers, scholarship achievers, and sports champions with merit awards.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary"><?= get_text('home', 'event2_loc', 'Main Auditorium') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="events.php">Learn More →</a>
          </div>
        </div>
        <!-- Event Card 3 -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col justify-between p-8 gap-6 shadow-sm">
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event3_tag', 'CELEBRATION') ?></span>
              <span class="text-body-sm text-on-surface-variant font-bold"><?= get_text('home', 'event3_badge', 'NATIONAL') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'event3_title', 'National Festivals &amp; Cultural Assemblies') ?></h3>
            <p class="text-body-md text-on-surface-variant"><?= get_text('home', 'event3_desc', 'Flag hoisting ceremony, patriotic songs, cultural dances, and speeches commemorating national heritage.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary"><?= get_text('home', 'event3_loc', 'Assembly Ground') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="events.php">View Gallery →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Photo Gallery Preview Grid -->
  <section class="w-full py-24 bg-surface relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-12">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'gallery_eyebrow', 'CAMPUS GLIMPSES') ?></div>
          <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-primary tracking-tight leading-tight mt-2"><?= get_text('home', 'gallery_heading', 'Life at Sun Rise Sr. Sec. School') ?></h2>
        </div>
        <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="gallery.php">
          View Full Gallery <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Photo 1: Night View -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse1_img', school_img('school_nightview.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse1_title', 'Main Campus Building') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse1_caption', 'Illuminated view of Sun Rise School architecture.') ?></p>
            </div>
          </div>
        </div>
        <!-- Photo 2: Smart Classroom -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse2_img', school_img('children_sitting.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse2_title', 'Interactive Classrooms') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse2_caption', 'Engaged students in an active learning environment.') ?></p>
            </div>
          </div>
        </div>
        <!-- Photo 3: Faculty -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse3_img', school_img('all_staffmembers.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse3_title', 'Dedicated Teaching Faculty') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse3_caption', 'Experienced mentors guiding students every step.') ?></p>
            </div>
          </div>
        </div>
        <!-- Photo 4: Student Life -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse4_img', school_img('students_grouppic.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse4_title', 'Student Community') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse4_caption', 'A vibrant and cheerful environment for every learner.') ?></p>
            </div>
          </div>
        </div>
        <!-- Photo 5: Yoga & Physical Education -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse5_img', school_img('yoga.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse5_title', 'Yoga &amp; Holistic Health') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse5_caption', 'Physical wellness, meditation, and self-discipline.') ?></p>
            </div>
          </div>
        </div>
        <!-- Photo 6: Project & Innovation -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('home', 'glimpse6_img', school_img('project.webp')) ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold"><?= get_text('home', 'glimpse6_title', 'Science Projects') ?></h3>
              <p class="text-xs text-white/80"><?= get_text('home', 'glimpse6_caption', 'Inspiring young scientists with practical exhibitions.') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Affiliations Logo Strip -->
  <section class="w-full py-16 bg-surface-container-low border-y border-border-warm">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col items-center gap-8">
      <div class="text-eyebrow text-on-surface-variant uppercase tracking-widest text-center font-bold">Affiliated &amp; Recognized By</div>
      <div class="flex flex-wrap items-center justify-center gap-12 lg:gap-20 opacity-85">
        <span class="font-headline-lg font-bold text-primary tracking-wider text-xl flex items-center gap-2">
          <span class="material-symbols-outlined text-[#C9A24B]">verified</span> HBSE AFFILIATED
        </span>
        <span class="font-headline-lg font-bold text-primary tracking-wider text-xl flex items-center gap-2">
          <span class="material-symbols-outlined text-[#C9A24B]">school</span> CO-EDUCATIONAL (10+2)
        </span>
        <span class="font-headline-lg font-bold text-primary tracking-wider text-xl flex items-center gap-2">
          <span class="material-symbols-outlined text-[#C9A24B]">science</span> SCIENCE, COMMERCE &amp; ARTS
        </span>
        <span class="font-headline-lg font-bold text-primary tracking-wider text-xl flex items-center gap-2">
          <span class="material-symbols-outlined text-[#C9A24B]">sports_kabaddi</span> SPORTS &amp; YOGA
        </span>
      </div>
    </div>
  </section>

  <!-- Final CTA Banner -->
  <section class="w-full py-24 bg-primary text-on-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('<?= get_image('home', 'cta_banner', school_img('school_home2.webp')) ?>')"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-12 text-center flex flex-col items-center gap-8">
      <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'cta_badge', 'ADMISSIONS 2026-27') ?></div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline-lg font-bold text-white tracking-tight leading-tight">
        <?= get_text('home', 'cta_heading', 'Give Your Child the <span class="text-[#C9A24B] italic">Sun Rise Advantage</span>') ?>
      </h2>
      <p class="text-body-lg text-surface-cream max-w-2xl font-body">
        <?= get_text('home', 'cta_description', 'Admissions are now open for Pre-Primary to Class 12. Schedule a campus visit or apply online today to provide your child with quality education and bright future.') ?>
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
        <a class="btn-gold" href="admission.php">
          <span><?= get_text('home', 'cta_btn1_text', 'Apply For Admission') ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
        <a class="btn-outline-white" href="contact-us.php">
          <span><?= get_text('home', 'cta_btn2_text', 'Contact Campus Office') ?></span>
          <span class="material-symbols-outlined text-[18px]">call</span>
        </a>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
