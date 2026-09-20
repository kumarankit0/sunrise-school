<?php
$current_page = 'about-us';
$page_title = 'About Us | Institutional Legacy & Vision';
$page_description = 'Learn about Sun Rise Sr. Sec. School, Dobhi. Our mission is to provide exemplary HBSE education, moral character cultivation, and holistic student development.';
$page_keywords = 'about Sun Rise school Dobhi, school history, HBSE affiliation, school vision mission, Dobhi Hisar school, holistic learning';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface text-on-surface">
  <!-- Hero Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary text-on-primary flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?= get_image('about', 'hero_banner', school_img('school_home2.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="relative z-10 max-w-6xl w-full mx-auto px-6 text-center flex flex-col items-center gap-5">
      <span class="text-eyebrow text-gold-light uppercase tracking-widest font-eyebrow font-bold bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full shadow-md">
        <?= get_text('about', 'hero_badge', 'Institutional Legacy &amp; Future Vision') ?>
      </span>
      <h1 class="text-[1.65rem] sm:text-[1.85rem] md:text-[2rem] font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight leading-[1.2] drop-shadow-md">
        <?= get_text('about', 'hero_title', 'About Sun Rise Sr. Sec. School') ?>
      </h1>
      <p class="text-sm sm:text-base md:text-lg text-surface-cream/95 w-full max-w-3xl mx-auto font-body leading-relaxed drop-shadow">
        <?= get_text('about', 'hero_subtitle', 'Cultivating academic rigor, moral integrity, and lifelong curiosity within a vibrant and disciplined campus environment in Dobhi, Haryana.') ?>
      </p>
    </div>
  </section>

  <!-- Milestones & Achievements Stat Strip -->
  <section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 -mt-10 sm:-mt-16 w-full">
    <div class="bg-surface-pure rounded-2xl shadow-[0_12px_28px_rgba(11,38,71,0.08)] p-4 sm:p-8 lg:p-12 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8">
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

  <!-- Vision & Mission Side-by-Side Cards -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold"><?= get_text('about', 'philosophy_tag', 'Our Core Philosophy') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('about', 'philosophy_heading', 'Guiding Principles of Education') ?></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Vision Card -->
      <div class="bg-surface-pure rounded-xl p-8 sm:p-10 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all flex flex-col justify-between border border-border-warm h-full">
        <div class="flex flex-col gap-4 flex-grow">
          <div class="w-14 h-14 rounded-lg bg-gold-light flex items-center justify-center text-secondary">
            <span class="material-symbols-outlined text-[28px]">visibility</span>
          </div>
          <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider">Our Vision</span>
          <h3 class="text-[1.5rem] font-bold text-primary sm:min-h-[3.5rem] flex items-center"><?= get_text('about', 'vision_title', 'A Centre of Excellence for Intellect &amp; Integrity') ?></h3>
          
          <!-- Primary Visible Paragraph -->
          <p class="font-body-md text-on-surface-variant leading-relaxed">
            <?= get_text('about', 'vision_text_p1', 'To establish Sun Rise Sr. Sec. School as a Centre of Excellence that nurtures young minds into individuals of intellect, integrity, discernment, and compassion—equipped not merely to succeed in life, but to give meaning to that success through service to society and the nation.') ?>
          </p>

          <!-- Expandable Read More Section -->
          <div id="visionMoreWrapper" class="hidden flex-col gap-4 pt-2 border-t border-border-warm/60 mt-1 transition-all duration-300">
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              <?= get_text('about', 'vision_text_p2', 'We envision an educational ethos where the wisdom of traditional values converges with the possibilities of progressive thought, technology, and contemporary learning. Every student should emerge from our institution with a composed presence, articulate expression, sound judgement, and a deep sense of responsibility towards the world beyond oneself.') ?>
            </p>
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              <?= get_text('about', 'vision_text_p3', 'Our endeavour is to cultivate individuals who possess the courage to think independently, the humility to understand others, and the conviction to place collective welfare above personal interest. We aspire to prepare a generation that carries its heritage with respect, embraces the future with confidence, and contributes to the nation with dignity, integrity, and pride.') ?>
            </p>
            <div class="p-4 rounded-lg bg-surface-container-low border-l-4 border-secondary text-primary font-serif italic text-sm leading-relaxed shadow-sm">
              <?= get_text('about', 'vision_text_p4', '“We believe that education finds its highest purpose when knowledge becomes wisdom, achievement becomes responsibility, and the individual becomes a force for the greater good.”') ?>
            </div>
          </div>

          <!-- Read More / Read Less Toggle Button -->
          <div class="pt-1">
            <button type="button" 
                    id="visionToggleBtn" 
                    onclick="toggleVisionExpand()" 
                    class="inline-flex items-center gap-1.5 text-xs font-bold text-secondary hover:text-primary transition-all uppercase tracking-wider py-2 px-3.5 rounded-lg bg-gold-light/40 hover:bg-gold-light/70 cursor-pointer border border-[#C9A24B]/30 focus:outline-none shadow-xs">
              <span id="visionToggleText">Read More</span>
              <span id="visionToggleIcon" class="material-symbols-outlined text-[18px] transition-transform duration-300">expand_more</span>
            </button>
          </div>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center gap-2 text-primary font-label-md">
          <a href="academics.php" class="inline-flex items-center gap-2 hover:text-[#C9A24B] transition-colors font-bold">
            <span>Explore Academic Framework</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Mission Card -->
      <div class="bg-surface-pure rounded-xl p-8 sm:p-10 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all flex flex-col justify-between border border-border-warm h-full">
        <div class="flex flex-col gap-4 flex-grow">
          <div class="w-14 h-14 rounded-lg bg-gold-light flex items-center justify-center text-secondary">
            <span class="material-symbols-outlined text-[28px]">explore</span>
          </div>
          <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider">Our Mission</span>
          <h3 class="text-[1.5rem] font-bold text-primary sm:min-h-[3.5rem] flex items-center"><?= get_text('about', 'mission_title', 'Holistic Education for Mind, Body &amp; Soul') ?></h3>
          <p class="font-body-md text-on-surface-variant leading-relaxed">
            <?= get_text('about', 'mission_text', 'We are dedicated to delivering a comprehensive HBSE curriculum enriched by hands-on science laboratories, digital learning, sportsmanship, moral values, and cultural activities that nurture well-rounded global citizens.') ?>
          </p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center gap-2 text-primary font-label-md">
          <a href="campus.php" class="inline-flex items-center gap-2 hover:text-[#C9A24B] transition-colors font-bold">
            <span>Discover Campus Facilities</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
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

  <!-- Complete Official History Section -->
  <section class="bg-surface-container-low py-20 lg:py-24 w-full border-y border-border-warm/60">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold tracking-widest">Our History</span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug">From Humble Beginnings to a Legacy of Learning</h2>
        <p class="font-body-lg text-on-surface-variant mt-4 leading-relaxed">
          The journey of Sun Rise Sr. Sec. School, Dobhi began in 2007, rooted in a profound belief that education can illuminate lives, transform possibilities, and lay the foundation for a better society.
        </p>
      </div>

      <!-- Founder's Genesis Highlight Card -->
      <div class="bg-white rounded-2xl p-8 sm:p-10 lg:p-12 shadow-[0_4px_20px_rgba(11,38,71,0.06)] border border-[#C9A24B]/30 mb-16 relative overflow-hidden">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-[#C9A24B]/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-4 flex flex-col items-center text-center p-6 bg-surface-container-low rounded-xl border border-border-warm">
            <div class="w-24 h-24 rounded-full bg-primary/10 border-2 border-secondary flex items-center justify-center text-secondary mb-4 shadow-sm">
              <span class="material-symbols-outlined text-4xl text-primary">school</span>
            </div>
            <span class="text-xs uppercase tracking-widest text-secondary font-bold">Institutional Founder</span>
            <h3 class="text-[1.5rem] font-bold text-primary mt-1">Mr. Bhader Singh Swami</h3>
            <p class="text-xs text-on-surface-variant mt-1 font-semibold">Founder &amp; Director</p>
            <div class="mt-4 pt-3 border-t border-border-warm w-full text-xs text-secondary font-bold flex items-center justify-center gap-1">
              <span class="material-symbols-outlined text-sm">event</span> Est. 2007 &bull; Dobhi, Hisar
            </div>
          </div>
          <div class="lg:col-span-8 flex flex-col gap-4 text-on-surface-variant leading-relaxed">
            <h3 class="text-[1.5rem] font-bold text-primary">A Vision Born from Conviction &amp; Dedication</h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              The institution was founded by <strong>Mr. Bhader Singh Swami</strong>, whose own journey was shaped by the struggles and limitations of growing up in a lower-middle-class family. Having experienced the challenges surrounding access to quality education, he developed a deep conviction that every child, irrespective of background, deserves the opportunity to learn, grow, and aspire.
            </p>
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              His years of teaching in different schools further strengthened this conviction and eventually gave form to the vision that became Sun Rise Sr. Sec. School. The beginning was modest: with approximately 90 students, education up to Class X, and limited resources, the school initially operated from small premises at different locations.
            </p>
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              The early years were marked by challenges and perseverance, but with unwavering dedication from the management, teachers, and the trust of local families, the foundation was steadily strengthened.
            </p>
          </div>
        </div>
      </div>

      <!-- Chronological Milestone Roadmap -->
      <div class="text-center mb-12">
        <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider">Key Milestones</span>
        <h3 class="text-[1.5rem] font-bold text-primary mt-1">Milestones in Our Institutional Journey</h3>
      </div>

      <div class="relative border-l-2 border-[#C9A24B]/40 ml-4 sm:ml-8 md:ml-28 pl-6 sm:pl-10 md:pl-14 flex flex-col gap-12 sm:gap-16">
        
        <!-- 2007 Milestone -->
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[31px] sm:-left-[47px] md:-left-[63px] top-1 w-8 h-8 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-xs shadow-md">
            01
          </div>
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full">2007</span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider">Foundation &amp; Humble Beginnings</span>
          </div>
          <h3 class="text-[1.5rem] font-bold text-primary mt-1">Modest Inception with 90 Students</h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed">
            Started with approximately 90 students up to Class X operating from modest premises at different locations. Overcoming initial hurdles through sheer dedication of teachers and the profound trust reposed by local families in Dobhi and surrounding villages.
          </p>
        </div>

        <!-- 2011 Milestone -->
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[31px] sm:-left-[47px] md:-left-[63px] top-1 w-8 h-8 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-xs shadow-md">
            02
          </div>
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-secondary text-primary text-xs font-bold rounded-full">2011</span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider">HBSE Affiliation &amp; Senior Secondary Expansion</span>
          </div>
          <h3 class="text-[1.5rem] font-bold text-primary mt-1">Upgradation to Class XII (10+2) &amp; Infrastructure Leap</h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed">
            Recognizing the urgent need for higher learning opportunities in the region, the school took a major leap forward by securing affiliation with the <strong>Board of School Education Haryana (HBSE)</strong> and expanding from Class X to Class XII (10+2). This milestone marked the transformation into a senior secondary school, opening Science and Arts streams, state-of-the-art laboratories, a resourceful library, and reliable rural bus transport routes.
          </p>
        </div>

        <!-- 2013 Milestone -->
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[31px] sm:-left-[47px] md:-left-[63px] top-1 w-8 h-8 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-xs shadow-md">
            03
          </div>
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full">2013</span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider">State-Level Science Accolades</span>
          </div>
          <h3 class="text-[1.5rem] font-bold text-primary mt-1">State Selection at CCSHAU Hisar Science Exhibition</h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed">
            As the school grew, its students began to leave their mark on wider platforms. Sun Rise achieved notable recognition when two students were selected at the Haryana state level at a prestigious Science Exhibition organized at CCSHAU Hisar, reflecting the institution's commitment to nurturing scientific inquiry and innovation.
          </p>
        </div>

        <!-- 2017 Milestone -->
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[31px] sm:-left-[47px] md:-left-[63px] top-1 w-8 h-8 rounded-full bg-primary text-secondary border-4 border-surface-container-low flex items-center justify-center font-bold text-xs shadow-md">
            04
          </div>
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-secondary text-primary text-xs font-bold rounded-full">2017</span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider">Block &amp; District Level Academic Sweep</span>
          </div>
          <h3 class="text-[1.5rem] font-bold text-primary mt-1">1st, 2nd &amp; 3rd Positions in Talent Search &amp; Physics Point Honours</h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed">
            Sun Rise students demonstrated academic brilliance at the block level Talent Search Exam, sweeping the <strong>1st, 2nd, and 3rd positions</strong> among more than 25 participating schools and over 1,500 students. In the same year, at the district level Physics Point Prize Test, 10 students from the school ranked among the top 200 out of more than 2,700 participants—highlighting competitive spirit and academic depth.
          </p>
        </div>

        <!-- Present Day Milestone -->
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[31px] sm:-left-[47px] md:-left-[63px] top-1 w-8 h-8 rounded-full bg-secondary text-primary border-4 border-surface-container-low flex items-center justify-center font-bold text-xs shadow-md">
            05
          </div>
          <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full">Today</span>
            <span class="text-eyebrow text-secondary font-bold uppercase tracking-wider">A Thriving Campus &amp; Community</span>
          </div>
          <h3 class="text-[1.5rem] font-bold text-primary mt-1">700+ Students, 28 Teachers &amp; 30+ Classrooms</h3>
          <p class="font-body-md text-on-surface-variant max-w-3xl leading-relaxed">
            Today, Sun Rise Sr. Sec. School stands tall as a thriving educational hub, serving approximately 700 students guided by a dedicated team of 28 experienced teachers across 30+ well-ventilated classrooms. Beyond academic excellence, the school emphasizes sports, creative arts, cultural programs, and educational excursions to ensure holistic growth.
          </p>
        </div>

      </div>

      <!-- The "Sun Rise" Philosophy & Enduring Mission Banner -->
      <div class="mt-20 grid grid-cols-1 md:grid-cols-12 gap-8">
        <div class="md:col-span-5 bg-white rounded-2xl p-8 shadow-[0_4px_16px_rgba(11,38,71,0.06)] border border-border-warm flex flex-col justify-between">
          <div class="flex flex-col gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#C9A24B]/15 text-[#C9A24B] flex items-center justify-center">
              <span class="material-symbols-outlined text-3xl">wb_sunny</span>
            </div>
            <span class="text-eyebrow text-secondary uppercase font-bold tracking-wider">The Symbolism</span>
            <h3 class="text-[1.5rem] font-bold text-primary">The Meaning Behind "Sun Rise"</h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed">
              The name <strong>"Sun Rise"</strong> was chosen with purpose. Just as the rising sun brings warmth, dispels darkness, and heralds a new beginning filled with hope and possibilities, the school aspires to be a guiding light for every learner who walks through its doors.
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-border-warm text-xs text-on-surface-variant italic">
            Light after darkness &bull; Hope &bull; New Beginnings
          </div>
        </div>

        <div class="md:col-span-7 bg-primary text-on-primary rounded-2xl p-8 sm:p-10 shadow-xl flex flex-col justify-between relative overflow-hidden">
          <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-[#C9A24B]/15 rounded-full blur-3xl pointer-events-none"></div>
          <div class="flex flex-col gap-4 relative z-10">
            <span class="text-eyebrow text-secondary uppercase font-bold tracking-widest">Our Enduring Pledge</span>
            <h3 class="text-[1.5rem] font-bold text-white">A Legacy of Perseverance &amp; Community Trust</h3>
            <p class="font-body-md text-white/90 leading-relaxed">
              From a modest vision with 90 students to a senior secondary institution touching hundreds of lives, the story of Sun Rise Sr. Sec. School is a testament to perseverance, purpose, and community trust.
            </p>
            <div class="mt-4 p-5 rounded-xl bg-white/10 border-l-4 border-secondary backdrop-blur-sm">
              <p class="text-xs uppercase tracking-wider text-secondary font-bold mb-1">The Journey Continues With Our Mission:</p>
              <p class="text-base sm:text-lg font-serif italic text-white font-medium">
                “To provide better education, nurture better human beings, and contribute towards a better humanity.”
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Leadership Message (Founder & Principal) -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
    <div class="bg-primary text-on-primary rounded-2xl p-8 lg:p-14 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center shadow-xl">
      <div class="lg:col-span-5 flex flex-col items-center">
        <div class="w-64 h-80 rounded-xl overflow-hidden shadow-2xl bg-cover bg-center border-2 border-secondary" style="background-image: url('<?= get_image('about', 'leader_photo', school_img('speaker.webp')) ?>')"></div>
      </div>
      <div class="lg:col-span-7 flex flex-col gap-5">
        <span class="text-eyebrow text-secondary uppercase tracking-widest font-eyebrow font-bold">Director's Welcome</span>
        <h3 class="text-[1.5rem] font-bold text-white">Inspiring Minds, Cultivating Character</h3>
        <blockquote class="text-lg sm:text-xl text-on-primary/95 italic font-serif leading-relaxed border-l-4 border-secondary pl-4 py-1">
          “Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society.”
        </blockquote>
        <p class="text-body-sm text-surface-cream/90 leading-relaxed">
          At Sun Rise Sr. Sec. School, we do not simply prepare children for tomorrow; we nurture the individuals who will shape tomorrow.
        </p>
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6 mt-2 pt-4 border-t border-white/20">
          <div>
            <span class="block font-bold text-white text-base">Mr. Bhader Singh Swami</span>
            <span class="text-xs text-secondary font-semibold uppercase tracking-wider">Founder &amp; Director (M.A., B.Ed.)</span>
          </div>
          <div class="hidden sm:block w-px h-8 bg-white/20"></div>
          <div>
            <span class="block font-bold text-white text-base">Mr. Rajbir Singh</span>
            <span class="text-xs text-secondary font-semibold uppercase tracking-wider">Principal (M.A., B.Ed.)</span>
          </div>
          <div class="hidden sm:block w-px h-8 bg-white/20"></div>
          <div>
            <span class="block font-bold text-white text-base">Mr. Indra Dev</span>
            <span class="text-xs text-secondary font-semibold uppercase tracking-wider">Coordinator (LL.M., Ex-GM RBI)</span>
          </div>
        </div>
        <div class="mt-2">
          <a href="faculty.php" class="inline-flex items-center gap-2 text-secondary hover:text-white transition-colors text-sm font-bold">
            <span>Meet Leadership &amp; Faculty Team</span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Campus Photo Collage -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24 w-full">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold"><?= get_text('about', 'tour_tagline', 'Visual Tour') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('about', 'tour_title', 'Moments &amp; Campus Life') ?></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-[600px]">
      <div class="flex flex-col gap-6 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img1', school_img('school.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded"><?= get_text('about', 'tour_lbl1', 'Main Campus Building') ?></span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img2', school_img('children_praying.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded"><?= get_text('about', 'tour_lbl2', 'Morning Prayer &amp; Assembly') ?></span>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:h-full">
        <div class="h-full rounded-xl bg-cover bg-center shadow-md min-h-[400px] md:min-h-full cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img3', school_img('school3.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-6 flex items-end">
            <span class="text-white text-base font-bold bg-primary/80 px-3 py-1.5 rounded"><?= get_text('about', 'tour_lbl3', 'Campus Panorama View') ?></span>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-6 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img4', school_img('exhibition3.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded"><?= get_text('about', 'tour_lbl4', 'Student Science Exhibitions') ?></span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= get_image('about', 'tour_img5', school_img('students_teachers.webp')) ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded"><?= get_text('about', 'tour_lbl5', 'Interactive Faculty Mentorship') ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
