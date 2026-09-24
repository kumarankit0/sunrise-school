<?php
$current_page = 'about-us';
$page_title = 'About Us | Institutional Legacy & Vision';
$page_description = 'Learn about Sun Rise Sr. Sec. School, Dobhi. Our mission is to provide exemplary HBSE education, moral character cultivation, and holistic student development.';
$page_keywords = 'about Sun Rise school Dobhi, school history, HBSE affiliation, school vision mission, Dobhi Hisar school, holistic learning';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface text-on-surface">
  <!-- Section 1: Hero Banner -->
  <section class="hero-section relative w-full min-h-[50vh] sm:min-h-[60vh] lg:min-h-[68vh] py-16 sm:py-24 lg:py-28 bg-primary text-on-primary flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('about', 'hero_banner', school_img('school_home2.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/45 via-primary/20 to-primary/60"></div>
    <div class="hero-content relative z-10 max-w-6xl w-full mx-auto px-4 sm:px-6 text-center flex flex-col items-center gap-3.5 sm:gap-5">
      <span class="hero-badge text-gold-light uppercase tracking-widest font-bold bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1.5 rounded-full shadow-md text-xs sm:text-sm">
        <?= get_text('about', 'hero_badge', 'Institutional Legacy &amp; Future Vision') ?>
      </span>
      <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md text-2xl sm:text-4xl lg:text-5xl">
        <?= get_text('about', 'hero_title', 'About Sun Rise Sr. Sec. School') ?>
      </h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl mx-auto font-body drop-shadow text-xs sm:text-sm lg:text-base leading-relaxed">
        <?= get_text('about', 'hero_subtitle', 'Cultivating academic rigor, moral integrity, and lifelong curiosity within a vibrant and disciplined campus environment in Dobhi, Haryana.') ?>
      </p>
    </div>
  </section>

  <!-- Section 2: Milestones & Achievements Stat Strip -->
  <section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 -mt-6 sm:-mt-8 w-full">
    <div class="bg-surface-pure rounded-2xl shadow-[0_12px_28px_rgba(11,38,71,0.08)] p-4 sm:p-6 lg:p-8 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 border border-border-warm/60">
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary"><?= get_text('about', 'stat1_num', '2007') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('about', 'stat1_lbl', 'Year Established') ?></span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary"><?= get_text('about', 'stat2_num', '700+') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('about', 'stat2_lbl', 'Enrolled Students') ?></span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary"><?= get_text('about', 'stat3_num', '28+') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('about', 'stat3_lbl', 'Experienced Teachers') ?></span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary"><?= get_text('about', 'stat4_num', '100%') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('about', 'stat4_lbl', 'HBSE Board Results') ?></span>
      </div>
    </div>
  </section>

  <!-- Section 3: Vision & Mission Side-by-Side Cards -->
  <section class="relative w-full mt-6 sm:mt-8 py-8 sm:py-12 px-4 sm:px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" style="background-color: #F8F9FA; background-image: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.08) 0%, transparent 45%), radial-gradient(circle at 90% 80%, rgba(234, 88, 12, 0.08) 0%, transparent 48%), radial-gradient(circle at 50% 50%, rgba(201, 162, 75, 0.06) 0%, transparent 55%);">
    <!-- Subtle Geometric / Academic Dot & Grid Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#64748B 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(100, 116, 139, 0.08) 1px, transparent 1px), linear-gradient(to bottom, rgba(100, 116, 139, 0.08) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Soft Decorative Glow Orbs -->
    <div class="absolute -left-20 -top-20 w-96 h-96 rounded-full bg-[#3B82F6]/12 blur-3xl pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-[#EA580C]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
        <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider"><?= get_text('about', 'philosophy_tag', 'Our Core Philosophy') ?></span>
        <h2 class="text-xl sm:text-2xl font-headline-lg font-bold text-primary tracking-tight"><?= get_text('about', 'philosophy_heading', 'Guiding Principles of Education') ?></h2>
        <div class="w-14 h-1 bg-gradient-to-r from-[#2563EB] via-[#C9A24B] to-[#EA580C] mx-auto mt-2 rounded-full"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6">
        <!-- Vision Card (Sapphire / Royal Azure Theme) -->
        <div class="bg-[#EFF6FF] rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between border border-[#BFDBFE] hover:border-[#2563EB] h-full relative overflow-hidden group">
          <div class="flex flex-col gap-3 flex-grow relative z-10">
            <div class="flex items-center justify-between">
              <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#3B82F6] to-[#1D4ED8] text-white shadow-md flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[22px]">visibility</span>
              </div>
              <span class="text-[10px] sm:text-xs font-bold text-[#1E40AF] bg-[#DBEAFE] px-3 py-1 rounded-full uppercase tracking-wider border border-[#93C5FD]">
                Our Vision
              </span>
            </div>

            <h3 class="text-lg sm:text-xl font-bold text-[#1E3A8A] tracking-tight leading-snug mt-1">
              <?= get_text('about', 'vision_title', 'A Centre of Excellence for Intellect &amp; Integrity') ?>
            </h3>
            
            <!-- Primary Visible Paragraph -->
            <p class="font-body-md text-[#1E3A8A]/90 text-xs sm:text-sm leading-relaxed">
              <?= get_text('about', 'vision_text_p1', 'To establish Sun Rise Sr. Sec. School as a Centre of Excellence that nurtures young minds into individuals of intellect, integrity, discernment, and compassion—equipped not merely to succeed in life, but to give meaning to that success through service to society and the nation.') ?>
            </p>

            <!-- Expandable Read More Section -->
            <div id="visionMoreWrapper" class="hidden flex-col gap-3 pt-3 border-t border-[#BFDBFE] mt-1 transition-all duration-300">
              <p class="font-body-md text-[#1E3A8A]/85 text-xs sm:text-sm leading-relaxed">
                <?= get_text('about', 'vision_text_p2', 'We envision an educational ethos where the wisdom of traditional values converges with the possibilities of progressive thought, technology, and contemporary learning. Every student should emerge from our institution with a composed presence, articulate expression, sound judgement, and a deep sense of responsibility towards the world beyond oneself.') ?>
              </p>
              <p class="font-body-md text-[#1E3A8A]/85 text-xs sm:text-sm leading-relaxed">
                <?= get_text('about', 'vision_text_p3', 'Our endeavour is to cultivate individuals who possess the courage to think independently, the humility to understand others, and the conviction to place collective welfare above personal interest. We aspire to prepare a generation that carries its heritage with respect, embraces the future with confidence, and contributes to the nation with dignity, integrity, and pride.') ?>
              </p>
              <div class="p-3 rounded-xl bg-[#DBEAFE]/80 border-l-4 border-[#2563EB] text-[#1E3A8A] font-serif italic text-xs leading-relaxed shadow-xs">
                <?= get_text('about', 'vision_text_p4', '“We believe that education finds its highest purpose when knowledge becomes wisdom, achievement becomes responsibility, and the individual becomes a force for the greater good.”') ?>
              </div>
            </div>

            <!-- Read More / Read Less Toggle Button -->
            <div class="pt-1">
              <button type="button" 
                      id="visionToggleBtn" 
                      onclick="toggleVisionExpand()" 
                      class="inline-flex items-center gap-1 text-xs font-bold text-[#1E40AF] hover:text-[#1E3A8A] transition-all uppercase tracking-wider py-1.5 px-3 rounded-lg bg-[#DBEAFE] hover:bg-[#BFDBFE] cursor-pointer border border-[#93C5FD] focus:outline-none shadow-xs">
                <span id="visionToggleText">Read More</span>
                <span id="visionToggleIcon" class="material-symbols-outlined text-[16px] transition-transform duration-300">expand_more</span>
              </button>
            </div>
          </div>

          <div class="mt-4 pt-3 border-t border-[#DBEAFE] flex items-center justify-between relative z-10">
            <a href="academics.php" class="inline-flex items-center gap-1.5 text-[#1D4ED8] hover:text-[#1E3A8A] font-bold text-xs sm:text-sm transition-colors group/link">
              <span>Explore Academic Framework</span>
              <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
            </a>
          </div>
        </div>

        <!-- Mission Card (Warm Sunset / Amber Theme) -->
        <div class="bg-[#FFF7ED] rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between border border-[#FED7AA] hover:border-[#EA580C] h-full relative overflow-hidden group">
          <div class="flex flex-col gap-3 flex-grow relative z-10">
            <div class="flex items-center justify-between">
              <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#F97316] to-[#C2410C] text-white shadow-md flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[22px]">explore</span>
              </div>
              <span class="text-[10px] sm:text-xs font-bold text-[#9A3412] bg-[#FFEDD5] px-3 py-1 rounded-full uppercase tracking-wider border border-[#FDBA74]">
                Our Mission
              </span>
            </div>

            <h3 class="text-lg sm:text-xl font-bold text-[#7C2D12] tracking-tight leading-snug mt-1">
              <?= get_text('about', 'mission_title', 'Holistic Education for Mind, Body &amp; Soul') ?>
            </h3>

            <p class="font-body-md text-[#7C2D12]/90 text-xs sm:text-sm leading-relaxed">
              <?= get_text('about', 'mission_text', 'We are dedicated to delivering a comprehensive HBSE curriculum enriched by hands-on science laboratories, digital learning, sportsmanship, moral values, and cultural activities that nurture well-rounded global citizens.') ?>
            </p>

            <!-- Mission Core Commitments Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2 pt-3 border-t border-[#FED7AA]/80">
              <div class="flex items-center gap-1.5 text-xs font-bold text-[#9A3412] bg-[#FFEDD5] px-2.5 py-1.5 rounded-lg border border-[#FED7AA]">
                <span class="material-symbols-outlined text-[16px] text-[#EA580C]">verified</span>
                <span>HBSE Curriculum Rigor</span>
              </div>
              <div class="flex items-center gap-1.5 text-xs font-bold text-[#9A3412] bg-[#FFEDD5] px-2.5 py-1.5 rounded-lg border border-[#FED7AA]">
                <span class="material-symbols-outlined text-[16px] text-[#EA580C]">science</span>
                <span>Hands-on Science Labs</span>
              </div>
              <div class="flex items-center gap-1.5 text-xs font-bold text-[#9A3412] bg-[#FFEDD5] px-2.5 py-1.5 rounded-lg border border-[#FED7AA]">
                <span class="material-symbols-outlined text-[16px] text-[#EA580C]">sports_kabaddi</span>
                <span>Sports &amp; Physical Fitness</span>
              </div>
              <div class="flex items-center gap-1.5 text-xs font-bold text-[#9A3412] bg-[#FFEDD5] px-2.5 py-1.5 rounded-lg border border-[#FED7AA]">
                <span class="material-symbols-outlined text-[16px] text-[#EA580C]">psychology</span>
                <span>Ethics &amp; Moral Growth</span>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-t border-[#FFEDD5] flex items-center justify-between relative z-10">
            <a href="campus.php" class="inline-flex items-center gap-1.5 text-[#C2410C] hover:text-[#7C2D12] font-bold text-xs sm:text-sm transition-colors group/link">
              <span>Discover Campus Facilities</span>
              <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function toggleVisionExpand() {
      const wrapper = document.getElementById('visionMoreWrapper');
      const btnText = document.getElementById('visionToggleText');
      const btnIcon = document.getElementById('visionToggleIcon');
      if (!wrapper || !btnText || !btnIcon) return;

      const isHidden = wrapper.classList.contains('hidden');
      if (isHidden) {
        wrapper.classList.remove('hidden');
        wrapper.classList.add('flex');
        btnText.textContent = 'Read Less';
        btnIcon.style.transform = 'rotate(180deg)';
      } else {
        wrapper.classList.add('hidden');
        wrapper.classList.remove('flex');
        btnText.textContent = 'Read More';
        btnIcon.style.transform = 'rotate(0deg)';
      }
    }
  </script>

  <!-- Section 4 & 5: Complete Official History Section & Chronological Milestones -->
  <section class="bg-surface-container-low py-8 sm:py-12 w-full border-y border-border-warm/60">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-8">
        <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-1 block font-bold tracking-widest"><?= get_text('about', 'history_badge', 'Our History') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('about', 'history_title', 'From Humble Beginnings to a Legacy of Learning') ?></h2>
        <p class="font-body-md text-on-surface-variant mt-2 leading-relaxed text-xs sm:text-sm">
          <?= get_text('about', 'history_intro', 'The journey of Sun Rise Sr. Sec. School, Dobhi began in 2007, rooted in a profound belief that education can illuminate lives, transform possibilities, and lay the foundation for a better society.') ?>
        </p>
      </div>

      <!-- Founder's Genesis Highlight Card -->
      <div class="bg-primary text-white rounded-2xl p-5 sm:p-6 lg:p-7 shadow-xl border border-[#C9A24B]/35 mb-8 relative overflow-hidden">
        <div class="absolute -right-12 -top-12 w-64 h-64 bg-[#C9A24B]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-secondary/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch relative z-10">
          <!-- Left: Dedicated Director Profile Card (Perfect Fit) -->
          <div class="lg:col-span-4 bg-white/[0.04] rounded-xl border border-white/15 p-4 flex flex-col justify-between shadow-lg h-full">
            <div>
              <!-- Dedicated Image Container -->
              <div class="relative w-full h-48 sm:h-52 rounded-lg overflow-hidden mb-3.5 border border-white/15 shadow-md bg-black/20">
                <img src="<?= get_image('about', 'founder_card_img', get_image('about', 'founder_photo', 'assets/images/clean_director.png')) ?>" alt="<?= get_image_alt('about', 'founder_card_img', 'Mr. Bhader Singh Swami') ?>" class="w-full h-full object-cover object-top">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
                <span class="absolute bottom-2 left-2 bg-secondary text-primary text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                  <?= get_text('about', 'founder_badge', 'Founder & Director') ?>
                </span>
              </div>

              <!-- Details below Image -->
              <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
                <?= get_text('about', 'founder_subbadge', 'Institutional Founder') ?>
              </span>
              <h3 class="text-base sm:text-lg font-bold text-white mt-0.5 leading-snug">
                <?= get_text('about', 'founder_name', 'Mr. Bhader Singh Swami') ?>
              </h3>
              <p class="text-xs text-white/80 mt-0.5"><?= get_text('about', 'founder_org', 'Sun Rise Sr. Sec. School, Dobhi') ?></p>
            </div>

            <div class="mt-3.5 pt-2.5 border-t border-white/15 text-xs text-secondary font-semibold flex items-center justify-between">
              <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">event</span>
                <span><?= get_text('about', 'founder_est', 'Est. 2007 • Dobhi, Hisar') ?></span>
              </div>
            </div>
          </div>

          <!-- Right: Founder Vision & Story on Dark Background -->
          <div class="lg:col-span-8 flex flex-col justify-between gap-3 text-white/90 leading-relaxed text-xs sm:text-sm h-full py-1">
            <div>
              <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider text-[11px] block mb-1"><?= get_text('about', 'founder_eyebrow', "FOUNDER'S JOURNEY") ?></span>
              <h3 class="text-lg sm:text-xl font-bold text-white mb-2.5 leading-snug"><?= get_text('about', 'founder_heading', 'A Vision Born from Conviction & Dedication') ?></h3>
              <div class="space-y-3 font-body-md text-surface-cream/85 leading-relaxed">
                <p>
                  <?= get_text('about', 'founder_p1', 'The institution was founded by <strong class="text-white">Mr. Bhader Singh Swami</strong>, whose own journey was shaped by the struggles and limitations of growing up in a lower-middle-class family. Having experienced the challenges surrounding access to quality education, he developed a deep conviction that every child, irrespective of background, deserves the opportunity to learn, grow, and aspire.') ?>
                </p>
                <p>
                  <?= get_text('about', 'founder_p2', 'His years of teaching in different schools further strengthened this conviction and eventually gave form to the vision that became Sun Rise Sr. Sec. School. The beginning was modest: with approximately 90 students, education up to Class X, and limited resources, the school initially operated from small premises at different locations.') ?>
                </p>
                <p>
                  <?= get_text('about', 'founder_p3', 'The early years were marked by challenges and perseverance, but with unwavering dedication from the management, teachers, and the trust of local families, the foundation was steadily strengthened.') ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Chronological Milestone Roadmap -->
      <div class="text-center mb-6">
        <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider"><?= get_text('about', 'milestones_badge', 'Key Milestones') ?></span>
        <h3 class="text-lg sm:text-xl font-bold text-primary mt-0.5"><?= get_text('about', 'milestones_title', 'Milestones in Our Institutional Journey') ?></h3>
      </div>

      <div class="relative border-l-2 border-[#C9A24B]/40 ml-4 sm:ml-8 md:ml-28 pl-6 sm:pl-8 md:pl-10 flex flex-col gap-6 sm:gap-8">
        
        <!-- Milestone 1 -->
        <div class="relative flex flex-col gap-1.5">
          <div class="absolute -left-[31px] sm:-left-[39px] md:-left-[47px] top-0.5 w-7 h-7 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-[11px] shadow-md">
            <?= get_text('about', 'm1_num', '01') ?>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="px-2.5 py-0.5 bg-primary text-white text-[11px] font-bold rounded-full"><?= get_text('about', 'm1_year', '2007') ?></span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider text-xs"><?= get_text('about', 'm1_category', 'Foundation & Humble Beginnings') ?></span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-primary mt-0.5"><?= get_text('about', 'm1_title', 'Modest Inception with 90 Students') ?></h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed text-xs sm:text-sm">
            <?= get_text('about', 'm1_desc', 'Started with approximately 90 students up to Class X operating from modest premises at different locations. Overcoming initial hurdles through sheer dedication of teachers and the profound trust reposed by local families in Dobhi and surrounding villages.') ?>
          </p>
        </div>

        <!-- Milestone 2 -->
        <div class="relative flex flex-col gap-1.5">
          <div class="absolute -left-[31px] sm:-left-[39px] md:-left-[47px] top-0.5 w-7 h-7 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-[11px] shadow-md">
            <?= get_text('about', 'm2_num', '02') ?>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="px-2.5 py-0.5 bg-secondary text-primary text-[11px] font-bold rounded-full"><?= get_text('about', 'm2_year', '2011') ?></span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider text-xs"><?= get_text('about', 'm2_category', 'HBSE Affiliation & Senior Secondary Expansion') ?></span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-primary mt-0.5"><?= get_text('about', 'm2_title', 'Upgradation to Class XII (10+2) & Infrastructure Leap') ?></h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed text-xs sm:text-sm">
            <?= get_text('about', 'm2_desc', 'Recognizing the urgent need for higher learning opportunities in the region, the school took a major leap forward by securing affiliation with the <strong>Board of School Education Haryana (HBSE)</strong> and expanding from Class X to Class XII (10+2). This milestone marked the transformation into a senior secondary school, opening Science and Arts streams, state-of-the-art laboratories, a resourceful library, and reliable rural bus transport routes.') ?>
          </p>
        </div>

        <!-- Milestone 3 -->
        <div class="relative flex flex-col gap-1.5">
          <div class="absolute -left-[31px] sm:-left-[39px] md:-left-[47px] top-0.5 w-7 h-7 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-[11px] shadow-md">
            <?= get_text('about', 'm3_num', '03') ?>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="px-2.5 py-0.5 bg-primary text-white text-[11px] font-bold rounded-full"><?= get_text('about', 'm3_year', '2013') ?></span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider text-xs"><?= get_text('about', 'm3_category', 'State-Level Science Accolades') ?></span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-primary mt-0.5"><?= get_text('about', 'm3_title', 'State Selection at CCSHAU Hisar Science Exhibition') ?></h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed text-xs sm:text-sm">
            <?= get_text('about', 'm3_desc', 'As the school grew, its students began to leave their mark on wider platforms. Sun Rise achieved notable recognition when two students were selected at the Haryana state level at a prestigious Science Exhibition organized at CCSHAU Hisar, reflecting the institution\'s commitment to nurturing scientific inquiry and innovation.') ?>
          </p>
        </div>

        <!-- Milestone 4 -->
        <div class="relative flex flex-col gap-1.5">
          <div class="absolute -left-[31px] sm:-left-[39px] md:-left-[47px] top-0.5 w-7 h-7 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-[11px] shadow-md">
            <?= get_text('about', 'm4_num', '04') ?>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="px-2.5 py-0.5 bg-secondary text-primary text-[11px] font-bold rounded-full"><?= get_text('about', 'm4_year', '2017') ?></span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider text-xs"><?= get_text('about', 'm4_category', 'Block & District Level Academic Sweep') ?></span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-primary mt-0.5"><?= get_text('about', 'm4_title', '1st, 2nd & 3rd Positions in Talent Search & Physics Point Honours') ?></h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed text-xs sm:text-sm">
            <?= get_text('about', 'm4_desc', 'Sun Rise students demonstrated academic brilliance at the block level Talent Search Exam, sweeping the <strong>1st, 2nd, and 3rd positions</strong> among more than 25 participating schools and over 1,500 students. In the same year, at the district level Physics Point Prize Test, 10 students from the school ranked among the top 200 out of more than 2,700 participants—highlighting competitive spirit and academic depth.') ?>
          </p>
        </div>

        <!-- Milestone 5 -->
        <div class="relative flex flex-col gap-1.5">
          <div class="absolute -left-[31px] sm:-left-[39px] md:-left-[47px] top-0.5 w-7 h-7 rounded-full bg-secondary text-primary border-4 border-surface-container-low flex items-center justify-center font-bold text-[11px] shadow-md">
            <?= get_text('about', 'm5_num', '05') ?>
          </div>
          <div class="flex items-center gap-2.5">
            <span class="px-2.5 py-0.5 bg-primary text-white text-[11px] font-bold rounded-full"><?= get_text('about', 'm5_year', 'Today') ?></span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider text-xs"><?= get_text('about', 'm5_category', 'A Thriving Campus & Community') ?></span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-primary mt-0.5"><?= get_text('about', 'm5_title', '700+ Students, 28 Teachers & 30+ Classrooms') ?></h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed text-xs sm:text-sm">
            <?= get_text('about', 'm5_desc', 'Today, Sun Rise Sr. Sec. School stands tall as a thriving educational hub, serving approximately 700 students guided by a dedicated team of 28 experienced teachers across 30+ well-ventilated classrooms. Beyond academic excellence, the school emphasizes sports, creative arts, cultural programs, and educational excursions to ensure holistic growth.') ?>
          </p>
        </div>

      </div>

      <!-- Section 6: The "Sun Rise" Philosophy & Enduring Pledge Banner -->
      <div class="mt-10 grid grid-cols-1 md:grid-cols-12 gap-6">
        <div class="md:col-span-5 bg-white rounded-2xl p-6 shadow-[0_4px_16px_rgba(11,38,71,0.06)] border border-border-warm flex flex-col justify-between">
          <div class="flex flex-col gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#C9A24B]/15 text-[#C9A24B] flex items-center justify-center">
              <span class="material-symbols-outlined text-2xl">wb_sunny</span>
            </div>
            <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider text-xs"><?= get_text('about', 'symbolism_badge', 'The Symbolism') ?></span>
            <h3 class="text-base sm:text-lg font-bold text-primary"><?= get_text('about', 'symbolism_title', 'The Meaning Behind "Sun Rise"') ?></h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed text-xs sm:text-sm">
              <?= get_text('about', 'symbolism_text', 'The name <strong>"Sun Rise"</strong> was chosen with purpose. Just as the rising sun brings warmth, dispels darkness, and heralds a new beginning filled with hope and possibilities, the school aspires to be a guiding light for every learner who walks through its doors.') ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-xs text-on-surface-variant italic">
            <?= get_text('about', 'symbolism_footer', 'Light after darkness &bull; Hope &bull; New Beginnings') ?>
          </div>
        </div>

        <div class="md:col-span-7 bg-primary text-on-primary rounded-2xl p-6 sm:p-7 shadow-xl flex flex-col justify-between relative overflow-hidden">
          <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-[#C9A24B]/15 rounded-full blur-3xl pointer-events-none"></div>
          <div class="flex flex-col gap-3 relative z-10">
            <span class="text-eyebrow text-secondary uppercase font-bold tracking-widest text-xs"><?= get_text('about', 'pledge_badge', 'Our Enduring Pledge') ?></span>
            <h3 class="text-base sm:text-lg font-bold text-white"><?= get_text('about', 'pledge_title', 'A Legacy of Perseverance & Community Trust') ?></h3>
            <p class="font-body-md text-white/90 leading-relaxed text-xs sm:text-sm">
              <?= get_text('about', 'pledge_desc', 'From a modest vision with 90 students to a senior secondary institution touching hundreds of lives, the story of Sun Rise Sr. Sec. School is a testament to perseverance, purpose, and community trust.') ?>
            </p>
            <div class="mt-2 p-3.5 rounded-xl bg-white/10 border-l-4 border-secondary backdrop-blur-sm">
              <p class="text-[11px] uppercase tracking-wider text-secondary font-bold mb-0.5"><?= get_text('about', 'pledge_quote_title', 'The Journey Continues With Our Mission:') ?></p>
              <p class="text-sm sm:text-base font-serif italic text-white font-medium">
                <?= get_text('about', 'pledge_quote', '“To provide better education, nurture better human beings, and contribute towards a better humanity.”') ?>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Section 7: Leadership Team (3 Columns: Director, Principal & Coordinator) -->
  <section id="leadership" class="scroll-mt-28 max-w-7xl mx-auto px-6 lg:px-12 py-8 sm:py-12 w-full">
    <div class="bg-primary text-on-primary rounded-2xl p-6 lg:p-8 shadow-xl flex flex-col gap-6">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-1.5">
        <span class="text-eyebrow text-secondary uppercase tracking-widest font-eyebrow font-bold text-xs">
          <?= get_text('about', 'leader_tagline', "OUR LEADERSHIP TEAM") ?>
        </span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight leading-snug">
          <?= get_text('about', 'leader_heading', 'Inspiring Minds, Cultivating Character & Excellence') ?>
        </h2>
        <p class="text-body-sm text-surface-cream/80 max-w-2xl leading-relaxed text-xs sm:text-sm">
          <?= get_text('about', 'leader_desc', 'Guided by seasoned visionaries dedicated to academic distinction, moral integrity, and holistic student growth.') ?>
        </p>
      </div>

      <!-- 3 Columns: Director, Principal, Coordinator -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6 items-stretch">
        
        <!-- Column 1: Founder & Director -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-44 sm:h-48 rounded-xl overflow-hidden mb-3.5 bg-cover bg-center border border-white/10 shadow-lg" style="background-image: url('<?= get_image('about', 'leader1_photo', get_image('about', 'leader_photo', school_img('director.png'))) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
              <span class="absolute bottom-2.5 left-2.5 bg-secondary text-primary text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                <?= get_text('about', 'leader1_badge', 'Founder & Director') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('about', 'leader1_tag', 'Visionary Leadership') ?>
            </span>
            <h3 class="text-lg font-bold text-white mt-0.5">
              <?= get_text('about', 'leader1_name', 'Mr. Bhader Singh Swami') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-1.5">
              <?= get_text('about', 'leader1_role', 'Founder & Director | M.A., B.Ed.') ?>
            </p>
            <div class="inline-block bg-white/10 text-white/90 text-[11px] font-semibold px-2 py-0.5 rounded mb-2 border border-white/10">
              <?= get_text('about', 'leader1_exp', '36+ Years in Education') ?>
            </div>
            <p class="text-body-sm text-surface-cream/80 leading-relaxed text-xs sm:text-sm text-justify">
              <?= get_text('about', 'leader1_desc', 'With 36 years of teaching experience and 26 years of school management, Mr. Bhader Singh Swami has devoted his journey to education grounded in discipline, values, character, and academic excellence.') ?>
            </p>
          </div>
        </div>

        <!-- Column 2: Principal -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-44 sm:h-48 rounded-xl overflow-hidden mb-3.5 bg-cover bg-center border border-white/10 shadow-lg" style="background-image: url('<?= get_image('about', 'leader2_photo', get_image('home', 'principal_photo', school_img('all_staffmembers.webp'))) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
              <span class="absolute bottom-2.5 left-2.5 bg-secondary text-primary text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                <?= get_text('about', 'leader2_badge', 'Principal') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('about', 'leader2_tag', 'Academic Administration') ?>
            </span>
            <h3 class="text-lg font-bold text-white mt-0.5">
              <?= get_text('about', 'leader2_name', 'Mr. Rajbir Singh') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-1.5">
              <?= get_text('about', 'leader2_role', 'Principal | M.A., B.Ed.') ?>
            </p>
            <div class="inline-block bg-white/10 text-white/90 text-[11px] font-semibold px-2 py-0.5 rounded mb-2 border border-white/10">
              <?= get_text('about', 'leader2_exp', '16 Years Experience') ?>
            </div>
            <p class="text-body-sm text-surface-cream/80 leading-relaxed text-xs sm:text-sm text-justify">
              <?= get_text('about', 'leader2_desc', 'Serving as the academic head, Mr. Rajbir Singh fosters a disciplined and purposeful learning environment, supporting teachers and ensuring students receive balanced opportunities for holistic development.') ?>
            </p>
          </div>
        </div>

        <!-- Column 3: Coordinator -->
        <div class="bg-white/[0.04] rounded-2xl border border-white/10 p-5 flex flex-col justify-between hover:border-secondary/50 hover:bg-white/[0.07] transition-all duration-300 group">
          <div>
            <!-- Upper Image -->
            <div class="relative w-full h-44 sm:h-48 rounded-xl overflow-hidden mb-3.5 bg-cover bg-center border border-white/10 shadow-lg" style="background-image: url('<?= get_image('about', 'leader3_photo', school_img('all_staffmembers.webp')) ?>')">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
              <span class="absolute bottom-2.5 left-2.5 bg-secondary text-primary text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                <?= get_text('about', 'leader3_badge', 'Coordinator') ?>
              </span>
            </div>
            
            <!-- Lower Text -->
            <span class="text-[11px] text-secondary font-bold uppercase tracking-wider block">
              <?= get_text('about', 'leader3_tag', 'Administration & Coordination') ?>
            </span>
            <h3 class="text-lg font-bold text-white mt-0.5">
              <?= get_text('about', 'leader3_name', 'Mr. Indra Dev') ?>
            </h3>
            <p class="text-xs text-secondary/90 font-semibold mt-0.5 mb-1.5">
              <?= get_text('about', 'leader3_role', 'Coordinator | B.A., M.A., LL.B., LL.M.') ?>
            </p>
            <div class="inline-block bg-white/10 text-white/90 text-[11px] font-semibold px-2 py-0.5 rounded mb-2 border border-white/10">
              <?= get_text('about', 'leader3_exp', '22 Years Exp • Former GM, RBI') ?>
            </div>
            <p class="text-body-sm text-surface-cream/80 leading-relaxed text-xs sm:text-sm text-justify">
              <?= get_text('about', 'leader3_desc', 'Mr. Indra Dev brings 22 years of professional experience and deep administrative acumen from the Reserve Bank of India (RBI), strengthening the school’s organizational discipline and excellence.') ?>
            </p>
          </div>
        </div>

      </div>

      <!-- Action Button / Link to Faculty -->
      <div class="text-center pt-2 border-t border-white/10">
        <a href="faculty.php" class="inline-flex items-center gap-2 text-secondary hover:text-white transition-colors text-xs sm:text-sm font-bold bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10">
          <span>Meet Full Leadership &amp; Faculty Team</span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>

    </div>
  </section>

  <!-- Section 8: Campus Photo Collage (Visual Tour) -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-8 sm:py-10 w-full">
    <div class="text-center max-w-3xl mx-auto mb-6">
      <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-1 block font-bold text-xs"><?= get_text('about', 'tour_tagline', 'Visual Tour') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('about', 'tour_title', 'Moments &amp; Campus Life') ?></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5 h-auto md:h-[400px]">
      <div class="flex flex-col gap-4 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[180px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img1', school_img('school.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-3 flex items-end">
            <span class="text-white text-xs sm:text-sm font-bold bg-primary/80 px-2 py-0.5 rounded"><?= get_text('about', 'tour_lbl1', 'Main Campus Building') ?></span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[180px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img2', school_img('children_praying.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-3 flex items-end">
            <span class="text-white text-xs sm:text-sm font-bold bg-primary/80 px-2 py-0.5 rounded"><?= get_text('about', 'tour_lbl2', 'Morning Prayer &amp; Assembly') ?></span>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:h-full">
        <div class="h-full rounded-xl bg-cover bg-center shadow-md min-h-[250px] md:min-h-full cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img3', school_img('school3.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded"><?= get_text('about', 'tour_lbl3', 'Campus Panorama View') ?></span>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-4 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[180px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img4', school_img('exhibition3.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-3 flex items-end">
            <span class="text-white text-xs sm:text-sm font-bold bg-primary/80 px-2 py-0.5 rounded"><?= get_text('about', 'tour_lbl4', 'Student Science Exhibitions') ?></span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[180px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img5', school_img('students_teachers.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-3 flex items-end">
            <span class="text-white text-xs sm:text-sm font-bold bg-primary/80 px-2 py-0.5 rounded"><?= get_text('about', 'tour_lbl5', 'Interactive Faculty Mentorship') ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 9: Mandatory Public Disclosure & Regulatory Compliance -->
  <section id="mandatory-disclosure" class="scroll-mt-28 bg-primary text-white py-6 sm:py-8 w-full border-t border-[#C9A24B]/30 relative overflow-hidden">
    <!-- Subtle Background Glows -->
    <div class="absolute -right-16 -top-16 w-72 h-72 bg-[#C9A24B]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -left-16 -bottom-16 w-72 h-72 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center max-w-xl mx-auto mb-4">
        <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-0.5 block font-bold tracking-widest text-[10px]"><?= get_text('about', 'disclosure_badge', 'Official Governance & Compliance') ?></span>
        <h2 class="text-base sm:text-lg font-headline-lg font-bold text-white tracking-tight leading-snug"><?= get_text('about', 'disclosure_title', 'Mandatory Public Disclosure (HBSE Norms)') ?></h2>
        <p class="font-body-md text-surface-cream/80 mt-0.5 leading-relaxed text-[11px] sm:text-xs">
          <?= get_text('about', 'disclosure_desc', 'In compliance with Board of School Education Haryana (HBSE) guidelines, our institutional accreditations, statutory certificates, and governance parameters are maintained transparently.') ?>
        </p>
      </div>

      <!-- Content Grid: General Info & Certificate Status -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 items-stretch">
        <!-- General Institutional Information Card -->
        <div class="bg-white rounded-xl p-3 sm:p-4 shadow-lg border border-border-warm flex flex-col justify-between text-on-surface">
          <div>
            <div class="flex items-center gap-2 mb-2 pb-2 border-b border-border-warm">
              <div class="w-6 h-6 rounded-md bg-primary/10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-sm">account_balance</span>
              </div>
              <div>
                <h3 class="font-bold text-primary text-xs sm:text-sm">General Information</h3>
                <p class="text-[9px] text-on-surface-variant leading-none mt-0.5">Statutory Institutional Profile</p>
              </div>
            </div>

            <div class="space-y-1 text-[11px]">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">Institution Name:</span>
                <span class="font-bold text-primary sm:text-right"><?= get_text('about', 'disc_school_name', 'Sun Rise Sr. Sec. School, Dobhi') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">Board Affiliation:</span>
                <span class="font-bold text-primary sm:text-right"><?= get_text('about', 'disc_board', 'HBSE (Affiliated since 2011)') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">Affiliation Code:</span>
                <span class="font-mono font-bold text-secondary sm:text-right"><?= get_text('about', 'disc_code', 'HBSE Code: SR-2011-DH') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">Managing Society:</span>
                <span class="font-bold text-primary sm:text-right"><?= get_text('about', 'disc_society', 'Sun Rise Educational Society, Dobhi') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">School Head:</span>
                <span class="font-bold text-primary sm:text-right"><?= get_text('about', 'disc_principal', 'Mr. Rajbir Singh (M.A., B.Ed.)') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">Campus Location:</span>
                <span class="font-semibold text-primary sm:text-right text-[10px]"><?= get_text('about', 'disc_address', 'Main Road Dobhi, Near PHC, Hisar - 125001') ?></span>
              </div>
              <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-0.5 border-b border-border-warm/40 gap-0.5">
                <span class="text-on-surface-variant font-medium">School Timings:</span>
                <span class="font-semibold text-primary sm:text-right text-[10px]"><?= get_text('about', 'disc_timings', 'Summer: 7:30 AM - 1:30 PM | Winter: 8:30 AM - 2:30 PM') ?></span>
              </div>
            </div>
          </div>

          <div class="mt-2 pt-1.5 border-t border-border-warm text-[10px] text-on-surface-variant flex items-center gap-1">
            <span class="material-symbols-outlined text-secondary text-xs">verified</span>
            <span>Accredited by Dept. of School Education, Haryana</span>
          </div>
        </div>

        <!-- Statutory Certificates & Compliance Status -->
        <div class="bg-white rounded-xl p-3 sm:p-4 shadow-lg border border-border-warm flex flex-col justify-between text-on-surface">
          <div>
            <div class="flex items-center gap-2 mb-2 pb-2 border-b border-border-warm">
              <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-sm">verified_user</span>
              </div>
              <div>
                <h3 class="font-bold text-primary text-xs sm:text-sm">Documents &amp; Certificates</h3>
                <p class="text-[9px] text-on-surface-variant leading-none mt-0.5">Statutory Compliance Status</p>
              </div>
            </div>

            <div class="space-y-1">
              <!-- Cert 1 -->
              <div class="flex items-center justify-between p-1.5 rounded-md bg-surface-container-low border border-border-warm">
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-secondary text-xs">description</span>
                  <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-primary leading-tight"><?= get_text('about', 'cert1_name', 'HBSE Affiliation Certificate') ?></span>
                    <span class="text-[9px] text-on-surface-variant leading-tight"><?= get_text('about', 'cert1_valid', 'Senior Secondary Level 10+2') ?></span>
                  </div>
                </div>
                <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[8px] tracking-wider uppercase">
                  <?= get_text('about', 'cert1_status', 'VERIFIED') ?>
                </span>
              </div>

              <!-- Cert 2 -->
              <div class="flex items-center justify-between p-1.5 rounded-md bg-surface-container-low border border-border-warm">
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-secondary text-xs">local_fire_department</span>
                  <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-primary leading-tight"><?= get_text('about', 'cert2_name', 'Fire Safety & Emergency Certificate') ?></span>
                    <span class="text-[9px] text-on-surface-variant leading-tight"><?= get_text('about', 'cert2_valid', 'Certified by Fire Department Haryana') ?></span>
                  </div>
                </div>
                <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[8px] tracking-wider uppercase">
                  <?= get_text('about', 'cert2_status', 'RENEWED') ?>
                </span>
              </div>

              <!-- Cert 3 -->
              <div class="flex items-center justify-between p-1.5 rounded-md bg-surface-container-low border border-border-warm">
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-secondary text-xs">domain_verification</span>
                  <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-primary leading-tight"><?= get_text('about', 'cert3_name', 'Building Safety & Structural Audit') ?></span>
                    <span class="text-[9px] text-on-surface-variant leading-tight"><?= get_text('about', 'cert3_valid', 'Certified by PWD (B&R)') ?></span>
                  </div>
                </div>
                <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[8px] tracking-wider uppercase">
                  <?= get_text('about', 'cert3_status', 'COMPLIANT') ?>
                </span>
              </div>

              <!-- Cert 4 -->
              <div class="flex items-center justify-between p-1.5 rounded-md bg-surface-container-low border border-border-warm">
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-secondary text-xs">water_drop</span>
                  <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-primary leading-tight"><?= get_text('about', 'cert4_name', 'Safe Drinking Water & Sanitation') ?></span>
                    <span class="text-[9px] text-on-surface-variant leading-tight"><?= get_text('about', 'cert4_valid', 'Certified by Public Health Dept.') ?></span>
                  </div>
                </div>
                <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[8px] tracking-wider uppercase">
                  <?= get_text('about', 'cert4_status', 'ACTIVE') ?>
                </span>
              </div>

              <!-- Cert 5 -->
              <div class="flex items-center justify-between p-1.5 rounded-md bg-surface-container-low border border-border-warm">
                <div class="flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-secondary text-xs">badge</span>
                  <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-primary leading-tight"><?= get_text('about', 'cert5_name', 'DEO Government Recognition') ?></span>
                    <span class="text-[9px] text-on-surface-variant leading-tight"><?= get_text('about', 'cert5_valid', 'District Education Officer, Hisar') ?></span>
                  </div>
                </div>
                <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[8px] tracking-wider uppercase">
                  <?= get_text('about', 'cert5_status', 'PERMANENT') ?>
                </span>
              </div>
            </div>
          </div>

          <div class="mt-2 pt-1.5 border-t border-border-warm text-[9px] text-on-surface-variant leading-tight">
            <?= get_text('about', 'disc_footer_note', 'For physical verification of original statutory records and certificates, please visit the administrative office during school hours.') ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
