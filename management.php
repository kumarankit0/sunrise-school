<?php
$current_page = 'leadership';
$page_title = 'School Management & Leadership | Sun Rise Sr. Sec. School';
$page_description = 'Meet the visionary leadership team at Sun Rise Sr. Sec. School, Dobhi (Hisar). Guiding young minds towards academic distinction, moral values, and excellence.';
$page_keywords = 'school management, leadership team, school director, principal, school coordinator, Sun Rise School Dobhi';

require_once __DIR__ . '/core/header.php';

$mgmt_hero_img = get_image('management', 'hero_banner', get_image('management', 'hero_bg_image', school_img('school_home2.webp')));
$mgmt_hero_alt = get_image_alt('management', 'hero_banner', get_image_alt('management', 'hero_bg_image', 'Sun Rise Sr. Sec. School Campus — Management'));
?>

<div class="flex flex-col w-full bg-surface text-on-surface">

  <!-- Section 1: Hero Banner — full image, no crop, no side gap (Same as About Us) -->
  <section class="hero-section relative w-full bg-[#00122e]">
    <!-- Real <img> tag: width:100% height:auto drives container height from image's natural ratio -->
    <img
      src="<?= $mgmt_hero_img ?>"
      alt="<?= htmlspecialchars($mgmt_hero_alt) ?>"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />
    <!-- Gradient overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/50 via-primary/20 to-primary/65 pointer-events-none" style="z-index:5;"></div>
    <!-- Text content overlay — centered over the image -->
    <div class="hero-overlay-wrap">
      <div class="hero-content relative max-w-6xl w-full mx-auto px-4 sm:px-6 text-center flex flex-col items-center gap-3.5 sm:gap-5">
        <span class="hero-badge text-gold-light uppercase tracking-widest font-bold bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1.5 rounded-full shadow-md text-xs sm:text-sm">
          <?= get_text('management', 'hero_badge', 'Administrative &amp; Academic Leadership') ?>
        </span>
        <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md text-2xl sm:text-4xl lg:text-5xl">
          <?= get_text('management', 'hero_title', 'School Management &amp; Leadership') ?>
        </h1>
        <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl mx-auto font-body drop-shadow text-xs sm:text-sm lg:text-base leading-relaxed">
          <?= get_text('management', 'hero_subtitle', 'Guided by seasoned educationalists, administrators, and mentors dedicated to fostering an inspiring environment of academic rigor, character building, and comprehensive student empowerment.') ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Section 2: Milestones & Achievements Stat Strip (Same as About Us) -->
  <section class="relative z-20 max-w-4xl lg:max-w-5xl mx-auto px-4 sm:px-6 -mt-6 sm:-mt-8 w-full">
    <div class="bg-gradient-to-r from-[#00122e] via-[#0b2647] to-[#00122e] text-white rounded-xl sm:rounded-2xl shadow-[0_10px_30px_-5px_rgba(0,17,41,0.5)] py-3.5 sm:py-4 px-3 sm:px-6 grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-4 border border-[#C9A24B]/35 backdrop-blur-sm">
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('management', 'stat1_num', '36+') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('management', 'stat1_lbl', 'Years of Heritage') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('management', 'stat2_num', '100%') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('management', 'stat2_lbl', 'HBSE Pass Rate') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('management', 'stat3_num', '28+') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('management', 'stat3_lbl', 'Faculty &amp; Mentors') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('management', 'stat4_num', '700+') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('management', 'stat4_lbl', 'Enrolled Scholars') ?></span>
      </div>
    </div>
  </section>

  <!-- Section: Leadership Team (Dark Navy Container Matching Screenshot) -->
  <section id="leadership" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-10 sm:py-14 w-full">
    <div class="bg-primary text-on-primary rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl border border-white/10 flex flex-col gap-6 sm:gap-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-2">
        <span class="text-secondary uppercase tracking-widest font-eyebrow font-bold text-xs sm:text-[13px]">
          <?= get_text('management', 'leader_tagline', 'OUR LEADERSHIP TEAM') ?>
        </span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight leading-snug">
          <?= get_text('management', 'leader_heading', 'Inspiring Minds, Cultivating Character & Excellence') ?>
        </h2>
        <p class="text-surface-cream/80 max-w-2xl leading-relaxed text-xs sm:text-sm">
          <?= get_text('management', 'leader_desc', 'Guided by seasoned visionaries dedicated to academic distinction, moral integrity, and holistic student growth.') ?>
        </p>
      </div>

      <!-- 3 Columns: Principal, Founder & Director, Coordinator -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6 items-stretch">
        
        <!-- Column 1: Principal -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 sm:p-6 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group shadow-lg">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-48 sm:h-52 rounded-xl overflow-hidden mb-4 bg-cover bg-center border border-white/10 shadow-md" style="background-image: url('<?= get_image('management', 'leader1_photo', get_image('about', 'leader1_photo', school_img('clean_director.png'))) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
              <span class="absolute bottom-3 left-3 bg-[#C9A24B] text-[#001129] text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded shadow-sm">
                <?= get_text('management', 'leader1_badge', 'Principal') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('management', 'leader1_tag', 'Academic Administration') ?>
            </span>
            <h3 class="text-lg sm:text-xl font-bold text-white mt-1">
              <?= get_text('management', 'leader1_name', 'Mr. Rajbir Singh') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-2">
              <?= get_text('management', 'leader1_role', 'Principal | M.A., B.Ed.') ?>
            </p>
            <div class="inline-block bg-[#001129]/60 text-slate-200 text-[11px] font-semibold px-2.5 py-0.5 rounded-md mb-2.5 border border-white/15">
              <?= get_text('management', 'leader1_exp', '16 Years in Education') ?>
            </div>
            <p class="text-surface-cream/80 leading-relaxed text-xs sm:text-[13px] text-justify">
              <?= get_text('management', 'leader1_desc', 'Serving as the academic head, Mr. Rajbir Singh fosters a disciplined and purposeful learning environment, supporting teachers and ensuring students receive balanced opportunities for holistic development.') ?>
            </p>
          </div>
        </div>

        <!-- Column 2: Founder & Director -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 sm:p-6 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group shadow-lg">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-48 sm:h-52 rounded-xl overflow-hidden mb-4 bg-cover bg-center border border-white/10 shadow-md" style="background-image: url('<?= get_image('management', 'leader2_photo', get_image('about', 'leader2_photo', school_img('director.png'))) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
              <span class="absolute bottom-3 left-3 bg-[#C9A24B] text-[#001129] text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded shadow-sm">
                <?= get_text('management', 'leader2_badge', 'Founder & Director') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('management', 'leader2_tag', 'Visionary Leadership') ?>
            </span>
            <h3 class="text-lg sm:text-xl font-bold text-white mt-1">
              <?= get_text('management', 'leader2_name', 'Mr. Bhader Singh Swami') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-2">
              <?= get_text('management', 'leader2_role', 'Founder & Director | M.A., B.Ed.') ?>
            </p>
            <div class="inline-block bg-[#001129]/60 text-slate-200 text-[11px] font-semibold px-2.5 py-0.5 rounded-md mb-2.5 border border-white/15">
              <?= get_text('management', 'leader2_exp', '36+ Years in Education') ?>
            </div>
            <p class="text-surface-cream/80 leading-relaxed text-xs sm:text-[13px] text-justify">
              <?= get_text('management', 'leader2_desc', 'With 36 years of teaching experience and 26 years of school management, Mr. Bhader Singh Swami has devoted his journey to education grounded in discipline, values, character, and academic excellence.') ?>
            </p>
          </div>
        </div>

        <!-- Column 3: Coordinator -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 sm:p-6 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group shadow-lg">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-48 sm:h-52 rounded-xl overflow-hidden mb-4 bg-cover bg-center border border-white/10 shadow-md" style="background-image: url('<?= get_image('management', 'leader3_photo', get_image('about', 'leader3_photo', school_img('all_staffmembers.webp'))) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
              <span class="absolute bottom-3 left-3 bg-[#C9A24B] text-[#001129] text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded shadow-sm">
                <?= get_text('management', 'leader3_badge', 'Coordinator') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('management', 'leader3_tag', 'Administration & Coordination') ?>
            </span>
            <h3 class="text-lg sm:text-xl font-bold text-white mt-1">
              <?= get_text('management', 'leader3_name', 'Mr. Indra Dev') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-2">
              <?= get_text('management', 'leader3_role', 'Coordinator | B.A., M.A., LL.B., LL.M.') ?>
            </p>
            <div class="inline-block bg-[#001129]/60 text-slate-200 text-[11px] font-semibold px-2.5 py-0.5 rounded-md mb-2.5 border border-white/15">
              <?= get_text('management', 'leader3_exp', '22 Years Exp • Former GM, RBI') ?>
            </div>
            <p class="text-surface-cream/80 leading-relaxed text-xs sm:text-[13px] text-justify">
              <?= get_text('management', 'leader3_desc', 'Mr. Indra Dev brings 22 years of professional experience and deep administrative acumen from the Reserve Bank of India (RBI), strengthening the school’s organizational discipline and excellence.') ?>
            </p>
          </div>
        </div>

      </div>

      <!-- Action Button / Link to Faculty -->
      <div class="text-center pt-3 border-t border-white/10">
        <a href="<?= htmlspecialchars(get_text('management', 'leader_btn_url', 'faculty.php')) ?>" class="inline-flex items-center gap-2 text-secondary hover:text-white transition-colors text-xs sm:text-sm font-bold bg-white/5 hover:bg-white/10 px-5 py-2.5 rounded-xl border border-white/15 shadow-sm">
          <span><?= get_text('management', 'leader_btn_text', 'Meet Full Leadership &amp; Faculty Team') ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>

    </div>
  </section>

</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
