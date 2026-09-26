<?php
$current_page = 'home';
$page_title = 'Welcome to Sun Rise Sr. Sec. School, Dobhi';
$page_description = 'Sun Rise Sr. Sec. School, Dobhi offers premier HBSE education from Pre-Primary to Senior Secondary streams with state-of-the-art infrastructure, experienced faculty, and holistic learning.';
$page_keywords = 'Sun Rise Sr. Sec. School Dobhi, best HBSE school Hisar, admissions 2026-27, senior secondary school, science commerce arts streams, top school Haryana';

require_once __DIR__ . '/core/header.php';

// Hero dynamic slide images for 4-direction box transition
$hero_slides = [
    get_image('home', 'hero_slide_1', get_image('home', 'hero_banner', school_img('school_home1.webp'))),
    get_image('home', 'hero_slide_2', school_img('school_home2.webp')),
    get_image('home', 'hero_slide_3', school_img('students_ground.webp')),
    get_image('home', 'hero_slide_4', school_img('project.webp')),
    get_image('home', 'hero_slide_5', school_img('school_nightview.webp')),
    get_image('home', 'hero_slide_6', school_img('exhibition.webp'))
];
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Dynamic 4-Direction Box Mosaic Slider -->
  <section class="hero-section relative w-full bg-[#00122e]" id="hero-section-main">
    <!-- Real <img> tag: width:100% height:auto drives container height naturally from image's true ratio -->
    <img
      id="hero-slider-img"
      src="<?= $hero_slides[0] ?>"
      alt="Sun Rise Sr. Sec. School Banner"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />

    <!-- Dynamic Hero 4-Direction Box Slider Container -->
    <div id="hero-box-slider" class="hero-box-slider" data-slides='<?= htmlspecialchars(json_encode($hero_slides), ENT_QUOTES, 'UTF-8') ?>' aria-hidden="true">
      <div class="hero-slide-base" style="background-image: url('<?= $hero_slides[0] ?>')"></div>
      <div class="hero-grid-container"></div>
      <!-- Slide Indicator Dots -->
      <div id="heroSliderIndicators" class="hero-slider-indicators"></div>
    </div>
    <!-- Soft gradient overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/45 pointer-events-none" style="z-index:10;"></div>
    <!-- Text content overlay — centered over the slider -->
    <div class="hero-overlay-wrap">
      <div class="hero-content relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-7">
        <div class="hero-badge inline-flex items-center gap-1.5 sm:gap-2.5 bg-black/40 backdrop-blur-md border border-[#C9A24B]/50 px-3.5 py-1 sm:px-5 sm:py-2 rounded-full text-gold-light font-bold shadow-lg">
          <span class="material-symbols-outlined text-[14px] sm:text-[18px] text-[#C9A24B]">military_tech</span>
          <span><?= get_text('home', 'hero_badge', 'AFFILIATED TO HBSE &bull; PRE-PRIMARY TO SENIOR SECONDARY (10+2)') ?></span>
        </div>
        <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md">
          <?= get_text('home', 'hero_title', 'Empowering Minds, Inspiring Character &amp; <span class="text-[#C9A24B] italic">Academic Excellence</span>') ?>
        </h1>
        <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl font-body drop-shadow">
          <?= get_text('home', 'hero_subtitle', 'Welcome to Sun Rise Sr. Sec. School, Dobhi. We foster an enriching educational environment combining rigorous HBSE scholarship, moral values, modern technology, and sportsmanship.') ?>
        </p>
        <div class="hero-cta-group flex items-center justify-center gap-2.5 sm:gap-4 pt-1 sm:pt-2 w-full">
          <a class="btn-gold hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('home', 'hero_btn1_link', 'admission.php')) ?>">
            <span><?= get_text('home', 'hero_btn1_text', 'Admissions 2026–27') ?></span>
            <span class="material-symbols-outlined">arrow_forward</span>
          </a>
          <a class="btn-outline-white hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('home', 'hero_btn2_link', 'campus.php')) ?>">
            <span><?= get_text('home', 'hero_btn2_text', 'Explore Campus') ?></span>
            <span class="material-symbols-outlined">domain</span>
          </a>
        </div>
      </div>
    </div>
  </section>


  <!-- Continuous Moving School Ticker Strip (Right to Left Marquee) -->
  <?php
    $ticker_items = [
      get_text('home', 'ticker_item_1', '<strong class="text-[#C9A24B] font-bold">School Timings:</strong> Summer Season: 7:30 AM to 1:30 PM &bull; Winter Season: 8:30 AM to 2:30 PM.'),
      get_text('home', 'ticker_item_2', '<strong class="text-[#C9A24B] font-bold">Admissions 2026-27:</strong> Nursery to Class XII (10+2) &bull; Science, Commerce &amp; Arts Streams &bull; English Medium.'),
      get_text('home', 'ticker_item_3', '<strong class="text-[#C9A24B] font-bold">HBSE Board Results:</strong> Exemplary distinctions &amp; 100% pass record in Class 10th &amp; 12th board exams.'),
      get_text('home', 'ticker_item_4', '<strong class="text-[#C9A24B] font-bold">School Bus &amp; Vans:</strong> GPS-tracked transit serving Dobhi, Agroha, Balsamand, Chaudhariwas &amp; nearby villages.'),
      get_text('home', 'ticker_item_5', '<strong class="text-[#C9A24B] font-bold">State Sports Glories:</strong> 2 Gold Medals in National Wrestling &bull; 2 Silver in Kickboxing.'),
      get_text('home', 'ticker_item_6', '<strong class="text-[#C9A24B] font-bold">Infrastructure:</strong> Smart Classrooms &bull; Science Lab &bull; Computer Lab &bull; Library &bull; Playground &bull; Transport &bull; CCTV Security.')
    ];
  ?>
  <div class="school-ticker-strip w-full bg-[#001129] border-y border-[#C9A24B]/40 overflow-hidden flex items-stretch relative z-20 shadow-md">
    <!-- Left Fixed Badge / Label -->
    <div class="ticker-badge flex-shrink-0 bg-gradient-to-r from-[#C9A24B] to-[#B38C37] text-primary px-4 sm:px-6 py-2.5 sm:py-3.5 flex items-center gap-2 font-bold text-xs sm:text-sm uppercase tracking-wider z-10 shadow-lg select-none">
      <span class="material-symbols-outlined text-[18px] sm:text-[20px] animate-pulse">campaign</span>
      <span class="whitespace-nowrap font-headline"><?= get_text('home', 'ticker_label', 'Latest Updates') ?></span>
    </div>
    
    <!-- Moving Track Container -->
    <div class="ticker-marquee-track-wrapper flex-1 overflow-hidden relative py-2.5 sm:py-3.5 flex items-center">
      <div class="ticker-marquee-track flex items-center whitespace-nowrap">
        <!-- Sequence 1 -->
        <div class="ticker-marquee-group flex items-center gap-8 sm:gap-12 text-xs sm:text-sm font-medium text-white/95 pl-4 sm:pl-6">
          <?php foreach ($ticker_items as $t_item): ?>
            <?php if (!empty(trim(strip_tags($t_item)))): ?>
              <span class="inline-flex items-center gap-2.5">
                <span class="text-[#C9A24B] font-bold text-base">★</span>
                <span><?= $t_item ?></span>
              </span>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>

        <!-- Sequence 2 (Duplicate for Seamless Infinite Marquee Loop) -->
        <div class="ticker-marquee-group flex items-center gap-8 sm:gap-12 text-xs sm:text-sm font-medium text-white/95 pl-8 sm:pl-12" aria-hidden="true">
          <?php foreach ($ticker_items as $t_item): ?>
            <?php if (!empty(trim(strip_tags($t_item)))): ?>
              <span class="inline-flex items-center gap-2.5">
                <span class="text-[#C9A24B] font-bold text-base">★</span>
                <span><?= $t_item ?></span>
              </span>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Welcome / Spotlight & Stats Section -->
  <section class="w-full py-8 lg:py-12 bg-surface relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-stretch">
      <div class="lg:col-span-6 flex flex-col gap-5 sm:gap-6">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'legacy_tagline', 'THE SUN RISE LEGACY • ESTD. 2007') ?></div>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug">
          <?= get_text('home', 'legacy_heading', 'A Tradition of Holistic Education &amp; Outstanding Results') ?>
        </h2>
        <p class="text-sm sm:text-base lg:text-body-lg text-on-surface-variant font-body leading-relaxed">
          <?= get_text('home', 'legacy_description', "At Sun Rise Sr. Sec. School, Dobhi, we are dedicated to nurturing each student's intellectual, physical, and moral growth. Through cutting-edge science labs, modern computer lab, library, spacious sports grounds, and exemplary faculty mentorship, our students consistently achieve top honours in HBSE board exams and national championships.") ?>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 pt-2 sm:pt-4">
          <div class="p-3.5 sm:p-4 bg-surface-container-low rounded-xl border border-border-warm text-center">
            <div class="text-xl sm:text-2xl font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_pass_rate', '100%') ?></div>
            <div class="text-body-sm text-[10px] sm:text-xs text-on-surface-variant mt-1 leading-snug"><?= get_text('home', 'stat_pass_label', 'HBSE Board Results') ?></div>
          </div>
          <div class="p-3.5 sm:p-4 bg-surface-container-low rounded-xl border border-border-warm text-center">
            <div class="text-xl sm:text-2xl font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_enrolled', '700+') ?></div>
            <div class="text-body-sm text-[10px] sm:text-xs text-on-surface-variant mt-1 leading-snug"><?= get_text('home', 'stat_enrolled_label', 'Enrolled Students') ?></div>
          </div>
          <div class="p-3.5 sm:p-4 bg-surface-container-low rounded-xl border border-border-warm text-center">
            <div class="text-xl sm:text-2xl font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_teachers', '30+') ?></div>
            <div class="text-body-sm text-[10px] sm:text-xs text-on-surface-variant mt-1 leading-snug"><?= get_text('home', 'stat_teachers_label', 'Teaching Faculty') ?></div>
          </div>
          <div class="p-3.5 sm:p-4 bg-surface-container-low rounded-xl border border-border-warm text-center">
            <div class="text-xl sm:text-2xl font-headline-lg font-bold text-primary"><?= get_text('home', 'stat_classrooms', '30+') ?></div>
            <div class="text-body-sm text-[10px] sm:text-xs text-on-surface-variant mt-1 leading-snug"><?= get_text('home', 'stat_classrooms_label', 'Smart Classrooms') ?></div>
          </div>
        </div>
      </div>
      <!-- Live Event Tracker (Replaces 4 Number Cards as Requested) -->
      <div class="lg:col-span-6 w-full flex flex-col h-full">
        <?php 
          $tracker_events = get_live_tracker_events(); 
          $tracker_gold   = get_text('home', 'live_tracker_gold', 'UPCOMING');
          $tracker_white  = get_text('home', 'live_tracker_white', 'EVENTS');
          $tracker_badge  = get_text('home', 'live_tracker_badge', 'LIVE TRACKER');
        ?>
        <div class="live-tracker-card" aria-label="Upcoming School Events & Live Tracker">
          <!-- Header (Matching Reference Design: UPCOMING in Gold, EVENTS in White) -->
          <div class="live-tracker-header flex items-center justify-between">
            <h3 class="live-tracker-title">
              <span class="title-gold"><?= htmlspecialchars($tracker_gold) ?></span>
              <span class="title-white"><?= htmlspecialchars($tracker_white) ?></span>
            </h3>
            <?php if (!empty($tracker_badge)): ?>
              <span class="live-tracker-badge">
                <span class="live-tracker-pulse-dot" aria-hidden="true"></span>
                <span><?= htmlspecialchars($tracker_badge) ?></span>
              </span>
            <?php endif; ?>
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
  <section class="w-full py-8 sm:py-12 bg-[#000e21] relative text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex flex-col gap-8 sm:gap-10">
      <!-- Section Header (Centered, 100% Width, Mobile Responsive) -->
      <div class="w-full max-w-4xl mx-auto flex flex-col items-center text-center gap-3">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'pillars_eyebrow', 'WHY CHOOSE SUN RISE') ?></div>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-white tracking-tight leading-snug">
          <?= get_text('home', 'pillars_heading', 'Pillars of Holistic Development') ?>
        </h2>
        <div class="w-14 h-1 bg-[#C9A24B] rounded-full my-1"></div>
        <p class="text-sm sm:text-base md:text-lg text-slate-300 max-w-2xl font-body leading-relaxed">
          <?= get_text('home', 'pillars_desc', 'Our balanced framework ensures intellectual achievement is complemented by discipline, sportsmanship, and creative expression.') ?>
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Academics -->
        <div class="bg-white rounded-xl overflow-hidden border border-white/10 hover:border-[#C9A24B]/50 flex flex-col group hover:-translate-y-1.5 transition-all duration-300 shadow-xl">
          <div class="h-48 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card1_image', school_img('project.webp')) ?>')"></div>
          <div class="p-5 flex flex-col flex-1 justify-between gap-4">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card1_tag', 'HBSE CURRICULUM') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card1_title', 'Science &amp; Practical Labs') ?></h3>
              <p class="text-body-md text-on-surface-variant pillar-desc line-clamp-2"><?= get_text('home', 'card1_desc', 'State-of-the-art Physics, Chemistry, Biology, and Computer Science laboratories enabling experiential, hands-on scientific learning.') ?></p>
            </div>
            <div class="flex items-center gap-4 flex-wrap">
              <button class="pillar-readmore inline-flex items-center gap-1 text-sm text-primary font-bold hover:text-[#C9A24B] transition-colors">Read More <span class="material-symbols-outlined text-[15px]">expand_more</span></button>
              <a class="inline-flex items-center gap-1 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="<?= htmlspecialchars(get_text('home', 'card1_link_url', 'academics.php')) ?>">
                <?= get_text('home', 'card1_link_text', 'Visit Page') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
        <!-- Card 2: Sports -->
        <div class="bg-white rounded-xl overflow-hidden border border-white/10 hover:border-[#C9A24B]/50 flex flex-col group hover:-translate-y-1.5 transition-all duration-300 shadow-xl">
          <div class="h-48 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card2_image', school_img('students_ground.webp')) ?>')"></div>
          <div class="p-5 flex flex-col flex-1 justify-between gap-4">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card2_tag', 'ATHLETICS &amp; FITNESS') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card2_title', 'Sports Ground &amp; Yoga') ?></h3>
              <p class="text-body-md text-on-surface-variant pillar-desc line-clamp-2"><?= get_text('home', 'card2_desc', 'Spacious athletic playfields, track events, cricket, volleyball, football, and daily morning yoga for physical and mental vigour.') ?></p>
            </div>
            <div class="flex items-center gap-4 flex-wrap">
              <button class="pillar-readmore inline-flex items-center gap-1 text-sm text-primary font-bold hover:text-[#C9A24B] transition-colors">Read More <span class="material-symbols-outlined text-[15px]">expand_more</span></button>
              <a class="inline-flex items-center gap-1 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="<?= htmlspecialchars(get_text('home', 'card2_link_url', 'campus.php')) ?>">
                <?= get_text('home', 'card2_link_text', 'Visit Page') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
        <!-- Card 3: Co-curricular -->
        <div class="bg-white rounded-xl overflow-hidden border border-white/10 hover:border-[#C9A24B]/50 flex flex-col group hover:-translate-y-1.5 transition-all duration-300 shadow-xl">
          <div class="h-48 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= get_image('home', 'card3_image', school_img('exhibition.webp')) ?>')"></div>
          <div class="p-5 flex flex-col flex-1 justify-between gap-4">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]"><?= get_text('home', 'card3_tag', 'INNOVATION &amp; ART') ?></span>
              <h3 class="text-headline-sm font-headline-sm text-primary"><?= get_text('home', 'card3_title', 'Science &amp; Art Exhibitions') ?></h3>
              <p class="text-body-md text-on-surface-variant pillar-desc line-clamp-2"><?= get_text('home', 'card3_desc', 'Annual science exhibitions, model-making fairs, cultural assemblies, debate contests, and creative arts celebrations.') ?></p>
            </div>
            <div class="flex items-center gap-4 flex-wrap">
              <button class="pillar-readmore inline-flex items-center gap-1 text-sm text-primary font-bold hover:text-[#C9A24B] transition-colors">Read More <span class="material-symbols-outlined text-[15px]">expand_more</span></button>
              <a class="inline-flex items-center gap-1 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="<?= htmlspecialchars(get_text('home', 'card3_link_url', 'gallery.php')) ?>">
                <?= get_text('home', 'card3_link_text', 'Visit Page') ?> <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
  document.querySelectorAll('.pillar-readmore').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var card = btn.closest('[class*="p-5"]');
      var desc = card.querySelector('.pillar-desc');
      var icon = btn.querySelector('.material-symbols-outlined');
      var isClamped = desc.classList.toggle('line-clamp-2');
      btn.firstChild.textContent = isClamped ? 'Read More ' : 'Read Less ';
      icon.textContent = isClamped ? 'expand_more' : 'expand_less';
    });
  });
  </script>


  <!-- Founder & Director's Message (Image Left, Content Right) -->
  <section class="w-full py-8 lg:py-12 bg-surface relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
      <!-- Left: Photo — smaller col -->
      <div class="lg:col-span-4 relative flex flex-col">
        <div class="absolute -top-3 -left-3 w-full h-full bg-[#C9A24B]/10 rounded-2xl"></div>
        <div class="relative rounded-xl overflow-hidden shadow-xl flex-1 min-h-[320px] bg-cover bg-center" style="background-image: url('<?= get_image('home', 'director_photo', school_img('director.png')) ?>')"></div>
      </div>
      <!-- Right: Content — same height as image via items-stretch -->
      <div class="lg:col-span-8 flex flex-col gap-4 lg:pl-8 justify-between">
        <div class="flex flex-col gap-3">
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'director_tagline', "DIRECTOR'S MESSAGE") ?></div>
          <h2 class="text-[1.05rem] sm:text-[1.15rem] font-headline-lg font-bold text-primary tracking-tight leading-snug">
            <?= get_text('home', 'director_heading', "Empowering Dreams &amp; Shaping Tomorrow's Leaders") ?>
          </h2>
          <blockquote class="text-sm italic text-on-surface border-l-4 border-[#C9A24B] pl-4 py-1">
            <?= get_text('home', 'director_quote', '"Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society."') ?>
          </blockquote>
          <div class="text-body-md text-on-surface-variant font-body leading-relaxed">
            <div id="director-content" class="line-clamp-4">
              <p><?= get_text('home', 'director_p1', 'It gives me immense pleasure to welcome you to Sun Rise Sr. Sec. School, Dobhi—a place where we believe that every child is not just a student, but a unique individual with dreams, abilities, and limitless potential. For us, education is much more than books, classrooms, and examinations. It is about shaping minds, nurturing hearts, building character, and preparing young individuals for life.') ?></p>
              <p class="mt-2"><?= get_text('home', 'director_p2', 'We strive for the holistic development of every student through quality academics, sports, creativity, cultural activities, discipline, and strong moral values. Along with knowledge, we seek to nurture kindness, confidence, responsibility, resilience, and respect for others. At Sun Rise Sr. Sec. School, we do not simply prepare children for tomorrow; we nurture the individuals who will shape tomorrow.') ?></p>
            </div>
            <button id="director-readmore" class="mt-2 inline-flex items-center gap-1 text-sm text-primary font-bold hover:text-[#C9A24B] transition-colors">
              Read More <span class="material-symbols-outlined text-[15px]">expand_more</span>
            </button>
          </div>
        </div>
        <div class="pt-3 border-t border-[#E5E2DA]">
          <div class="text-headline-sm font-headline-sm text-primary font-bold"><?= get_text('home', 'director_name', 'Mr. Bhader Singh Swami') ?></div>
          <div class="text-body-sm text-on-surface-variant font-medium mt-0.5"><?= get_text('home', 'director_title', 'Founder &amp; Director, Sun Rise Sr. Sec. School, Dobhi') ?></div>
        </div>
      </div>
    </div>
  </section>
  <script>
  (function() {
    var btn = document.getElementById('director-readmore');
    var content = document.getElementById('director-content');
    if (btn && content) {
      btn.addEventListener('click', function() {
        var clamped = content.classList.toggle('line-clamp-4');
        var icon = btn.querySelector('.material-symbols-outlined');
        btn.firstChild.textContent = clamped ? 'Read More ' : 'Read Less ';
        icon.textContent = clamped ? 'expand_more' : 'expand_less';
      });
    }
  })();
  </script>








  <!-- Upcoming Events & News Section -->
  <section class="w-full py-8 sm:py-12 bg-[#000e21]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'events_eyebrow', 'LATEST EVENTS AND NEWS') ?></div>
          <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-white tracking-tight leading-snug mt-1"><?= get_text('home', 'events_heading', 'School Events &amp; News') ?></h2>
        </div>
        <a class="inline-flex items-center gap-2 text-label-md text-[#C9A24B] font-bold hover:text-white transition-colors" href="events.php">
          View All Events <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Event Card 1 -->
        <div class="bg-[#f0f6ff] rounded-xl overflow-hidden border border-blue-100 flex flex-col justify-between p-6 gap-5 shadow-sm hover:shadow-md transition-all hover:-translate-y-1 duration-300">
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/15 text-[#8B6914] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event1_tag', 'ACADEMIC') ?></span>
              <span class="text-body-sm text-slate-500 font-bold"><?= get_text('home', 'event1_badge', 'ANNUAL') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-[#001129]"><?= get_text('home', 'event1_title', 'Annual Science &amp; Innovation Exhibition') ?></h3>
            <p class="text-body-md text-slate-600"><?= get_text('home', 'event1_desc', 'Students display innovative working models, robotics experiments, and environmental science projects.') ?></p>
          </div>
          <div class="pt-3 border-t border-blue-200 flex justify-between items-center">
            <span class="text-body-sm font-bold text-[#001129]"><?= get_text('home', 'event1_loc', 'School Campus') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="<?= htmlspecialchars(get_text('home', 'event1_link', 'events.php')) ?>">Explore Details →</a>
          </div>
        </div>
        <!-- Event Card 2 -->
        <div class="bg-[#f0f6ff] rounded-xl overflow-hidden border border-blue-100 flex flex-col justify-between p-6 gap-5 shadow-sm hover:shadow-md transition-all hover:-translate-y-1 duration-300">
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/15 text-[#8B6914] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event2_tag', 'CEREMONY') ?></span>
              <span class="text-body-sm text-slate-500 font-bold"><?= get_text('home', 'event2_badge', 'AWARDS') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-[#001129]"><?= get_text('home', 'event2_title', 'Prize Distribution &amp; Felicitation Day') ?></h3>
            <p class="text-body-md text-slate-600"><?= get_text('home', 'event2_desc', 'Honouring board exam toppers, scholarship achievers, and sports champions with merit awards.') ?></p>
          </div>
          <div class="pt-3 border-t border-blue-200 flex justify-between items-center">
            <span class="text-body-sm font-bold text-[#001129]"><?= get_text('home', 'event2_loc', 'Main Auditorium') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="<?= htmlspecialchars(get_text('home', 'event2_link', 'events.php')) ?>">Learn More →</a>
          </div>
        </div>
        <!-- Event Card 3 -->
        <div class="bg-[#f0f6ff] rounded-xl overflow-hidden border border-blue-100 flex flex-col justify-between p-6 gap-5 shadow-sm hover:shadow-md transition-all hover:-translate-y-1 duration-300">
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/15 text-[#8B6914] px-3 py-1 rounded text-eyebrow font-bold"><?= get_text('home', 'event3_tag', 'CELEBRATION') ?></span>
              <span class="text-body-sm text-slate-500 font-bold"><?= get_text('home', 'event3_badge', 'NATIONAL') ?></span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-[#001129]"><?= get_text('home', 'event3_title', 'National Festivals &amp; Cultural Assemblies') ?></h3>
            <p class="text-body-md text-slate-600"><?= get_text('home', 'event3_desc', 'Flag hoisting ceremony, patriotic songs, cultural dances, and speeches commemorating national heritage.') ?></p>
          </div>
          <div class="pt-3 border-t border-blue-200 flex justify-between items-center">
            <span class="text-body-sm font-bold text-[#001129]"><?= get_text('home', 'event3_loc', 'Assembly Ground') ?></span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="<?= htmlspecialchars(get_text('home', 'event3_link', 'events.php')) ?>">View Gallery →</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Photo Gallery Preview (Dual-Row Infinite Sliding Showcase) -->
  <?php
    $gallery_row1 = [
      ['img' => get_image('home', 'glimpse1_img', school_img('school_nightview.webp')), 'title' => get_text('home', 'glimpse1_title', 'Main Campus Building'), 'desc' => get_text('home', 'glimpse1_caption', 'Illuminated view of Sun Rise School architecture.')],
      ['img' => get_image('home', 'glimpse2_img', school_img('children_sitting.webp')), 'title' => get_text('home', 'glimpse2_title', 'Interactive Classrooms'), 'desc' => get_text('home', 'glimpse2_caption', 'Engaged students in an active learning environment.')],
      ['img' => get_image('home', 'glimpse3_img', school_img('all_staffmembers.webp')), 'title' => get_text('home', 'glimpse3_title', 'Dedicated Teaching Faculty'), 'desc' => get_text('home', 'glimpse3_caption', 'Experienced mentors guiding students every step.')],
      ['img' => get_image('home', 'glimpse7_img', school_img('exhibition.webp')), 'title' => get_text('home', 'glimpse7_title', 'Science & Innovation Fair'), 'desc' => get_text('home', 'glimpse7_caption', 'Working scientific models and robotics experiments.')],
      ['img' => get_image('home', 'glimpse8_img', school_img('award_ceremony.webp')), 'title' => get_text('home', 'glimpse8_title', 'Annual Awards Felicitation'), 'desc' => get_text('home', 'glimpse8_caption', 'Merit distinctions and trophy presentations.')],
      ['img' => get_image('home', 'glimpse9_img', school_img('children_praying.webp')), 'title' => get_text('home', 'glimpse9_title', 'Morning Assembly & Prayer'), 'desc' => get_text('home', 'glimpse9_caption', 'Starting the day with moral values and discipline.')],
    ];

    $gallery_row2 = [
      ['img' => get_image('home', 'glimpse4_img', school_img('students_grouppic.webp')), 'title' => get_text('home', 'glimpse4_title', 'Student Community'), 'desc' => get_text('home', 'glimpse4_caption', 'A vibrant and cheerful environment for every learner.')],
      ['img' => get_image('home', 'glimpse5_img', school_img('yoga.webp')), 'title' => get_text('home', 'glimpse5_title', 'Yoga & Holistic Health'), 'desc' => get_text('home', 'glimpse5_caption', 'Physical wellness, meditation, and self-discipline.')],
      ['img' => get_image('home', 'glimpse6_img', school_img('project.webp')), 'title' => get_text('home', 'glimpse6_title', 'Science Projects'), 'desc' => get_text('home', 'glimpse6_caption', 'Inspiring young scientists with practical exhibitions.')],
      ['img' => get_image('home', 'glimpse10_img', school_img('students_ground.webp')), 'title' => get_text('home', 'glimpse10_title', 'Athletics & Sports Ground'), 'desc' => get_text('home', 'glimpse10_caption', 'Playgrounds for track, volleyball, football, and fitness.')],
      ['img' => get_image('home', 'glimpse11_img', school_img('exhibition2.webp')), 'title' => get_text('home', 'glimpse11_title', 'Experiential Learning'), 'desc' => get_text('home', 'glimpse11_caption', 'Hands-on practical exploration in sciences.')],
      ['img' => get_image('home', 'glimpse12_img', school_img('teachers_and_students.webp')), 'title' => get_text('home', 'glimpse12_title', 'Student-Faculty Mentorship'), 'desc' => get_text('home', 'glimpse12_caption', 'Personalized guidance and caring educator support.')],
    ];
  ?>
  <section class="w-full py-8 sm:py-12 bg-[#eaf0f8] relative overflow-hidden" style="background-color: rgb(234 240 248 / var(--tw-bg-opacity, 1));">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-4 mb-5 sm:mb-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'gallery_eyebrow', 'CAMPUS GLIMPSES') ?></div>
          <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('home', 'gallery_heading', 'Life at Sun Rise Sr. Sec. School') ?></h2>
        </div>
        <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="gallery.php">
          View Full Gallery <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>
    </div>

    <!-- Dual-Row Continuous Infinite Photo Showcase -->
    <div class="w-full relative overflow-hidden">
      <!-- Left & Right Soft Vignette Fades -->
      <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-12 sm:w-28 bg-gradient-to-r from-[#eaf0f8] to-transparent z-10"></div>
      <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-12 sm:w-28 bg-gradient-to-l from-[#eaf0f8] to-transparent z-10"></div>

      <div class="gallery-marquee-container" tabindex="0" role="region" aria-label="Campus Life Photo Showcase. Hover or focus to pause.">
        <!-- Row 1: Leftward Infinite Marquee Track -->
        <div class="gallery-marquee-track gallery-marquee-left">
          <!-- Set 1 -->
          <?php foreach ($gallery_row1 as $item): ?>
            <div class="gallery-card-item group" onclick="openLightbox(this)" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3.5">
                <div>
                  <h3 class="text-white text-xs sm:text-sm font-bold drop-shadow leading-snug"><?= htmlspecialchars($item['title']) ?></h3>
                  <p class="text-[11px] text-white/80 hidden"><?= htmlspecialchars($item['desc']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Duplicate Set 1 for Infinite Continuous Loop -->
          <?php foreach ($gallery_row1 as $item): ?>
            <div class="gallery-card-item group" onclick="openLightbox(this)" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')" aria-hidden="true">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3.5">
                <div>
                  <h3 class="text-white text-xs sm:text-sm font-bold drop-shadow leading-snug"><?= htmlspecialchars($item['title']) ?></h3>
                  <p class="text-[11px] text-white/80 hidden"><?= htmlspecialchars($item['desc']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Row 2: Rightward Infinite Marquee Track -->
        <div class="gallery-marquee-track gallery-marquee-right">
          <!-- Set 2 -->
          <?php foreach ($gallery_row2 as $item): ?>
            <div class="gallery-card-item group" onclick="openLightbox(this)" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3.5">
                <div>
                  <h3 class="text-white text-xs sm:text-sm font-bold drop-shadow leading-snug"><?= htmlspecialchars($item['title']) ?></h3>
                  <p class="text-[11px] text-white/80 hidden"><?= htmlspecialchars($item['desc']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Duplicate Set 2 for Infinite Continuous Loop -->
          <?php foreach ($gallery_row2 as $item): ?>
            <div class="gallery-card-item group" onclick="openLightbox(this)" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')" aria-hidden="true">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= htmlspecialchars($item['img']) ?>')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3.5">
                <div>
                  <h3 class="text-white text-xs sm:text-sm font-bold drop-shadow leading-snug"><?= htmlspecialchars($item['title']) ?></h3>
                  <p class="text-[11px] text-white/80 hidden"><?= htmlspecialchars($item['desc']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Affiliations Logo Strip -->
  <section class="w-full py-8 sm:py-12 lg:py-16 bg-surface-container-low border-y border-border-warm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex flex-col items-center gap-4 sm:gap-6 lg:gap-8">
      <div class="text-eyebrow text-on-surface-variant uppercase tracking-widest text-center font-bold text-xs sm:text-sm"><?= get_text('home', 'affiliations_title', 'Affiliated &amp; Recognized By') ?></div>
      <div class="affiliation-badge-list flex flex-wrap items-center justify-center gap-x-6 sm:gap-x-10 lg:gap-x-16 gap-y-3 sm:gap-y-4 lg:gap-y-6 opacity-90">
        <span class="affiliation-badge font-headline-lg font-bold text-primary tracking-normal sm:tracking-wider text-xs sm:text-base lg:text-xl inline-flex items-center gap-2 whitespace-nowrap shrink-0">
          <span class="material-symbols-outlined text-[#C9A24B] text-[18px] sm:text-[22px] lg:text-[24px]">verified</span> <?= get_text('home', 'affil1_text', 'HBSE AFFILIATED') ?>
        </span>
        <span class="affiliation-badge font-headline-lg font-bold text-primary tracking-normal sm:tracking-wider text-xs sm:text-base lg:text-xl inline-flex items-center gap-2 whitespace-nowrap shrink-0">
          <span class="material-symbols-outlined text-[#C9A24B] text-[18px] sm:text-[22px] lg:text-[24px]">school</span> <?= get_text('home', 'affil2_text', 'CO-EDUCATIONAL (10+2)') ?>
        </span>
        <span class="affiliation-badge font-headline-lg font-bold text-primary tracking-normal sm:tracking-wider text-xs sm:text-base lg:text-xl inline-flex items-center gap-2 whitespace-nowrap shrink-0">
          <span class="material-symbols-outlined text-[#C9A24B] text-[18px] sm:text-[22px] lg:text-[24px]">science</span> <?= get_text('home', 'affil3_text', 'SCIENCE, COMMERCE &amp; ARTS') ?>
        </span>
        <span class="affiliation-badge font-headline-lg font-bold text-primary tracking-normal sm:tracking-wider text-xs sm:text-base lg:text-xl inline-flex items-center gap-2 whitespace-nowrap shrink-0">
          <span class="material-symbols-outlined text-[#C9A24B] text-[18px] sm:text-[22px] lg:text-[24px]">sports_kabaddi</span> <?= get_text('home', 'affil4_text', 'SPORTS &amp; YOGA') ?>
        </span>
      </div>
    </div>
  </section>

  <!-- Final CTA Banner -->
  <section class="w-full py-24 bg-primary text-on-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('<?= get_image('home', 'cta_banner', school_img('school_home2.webp')) ?>')"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-12 text-center flex flex-col items-center gap-8">
      <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('home', 'cta_badge', 'ADMISSIONS 2026-27') ?></div>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-white tracking-tight leading-snug">
        <?= get_text('home', 'cta_heading', 'Give Your Child the <span class="text-[#C9A24B] italic">Sun Rise Advantage</span>') ?>
      </h2>
      <p class="text-body-lg text-surface-cream max-w-2xl font-body">
        <?= get_text('home', 'cta_description', 'Admissions are now open for Pre-Primary to Class 12. Schedule a campus visit or apply online today to provide your child with quality education and bright future.') ?>
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
        <a class="btn-gold" href="<?= htmlspecialchars(get_text('home', 'cta_btn1_link', 'admission.php')) ?>">
          <span><?= get_text('home', 'cta_btn1_text', 'Apply For Admission') ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
        <a class="btn-outline-white" href="<?= htmlspecialchars(get_text('home', 'cta_btn2_link', 'contact-us.php')) ?>">
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
