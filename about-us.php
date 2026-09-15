<?php
$current_page = 'about-us';
$page_title = 'About Us | Institutional Legacy & Vision';
$page_description = 'Learn about Sun Rise Sr. Sec. School, Dobhi. Our mission is to provide exemplary HBSC education, moral character cultivation, and holistic student development.';
$page_keywords = 'about Sun Rise school Dobhi, school history, HBSC affiliation, school vision mission, Dobhi Hisar school, holistic learning';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface text-on-surface">
  <!-- Hero Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary text-on-primary flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-65" style="background-image: url('<?= school_img('school_home2.webp') ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-primary/75"></div>
    <div class="relative z-10 max-w-6xl w-full mx-auto px-6 text-center flex flex-col items-center gap-5">
      <span class="text-eyebrow text-gold-light uppercase tracking-widest font-eyebrow font-bold bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full shadow-md">Institutional Legacy &amp; Future Vision</span>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white w-full max-w-5xl tracking-tight leading-[1.15] drop-shadow-md">About Sun Rise Sr. Sec. School</h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl mx-auto font-body leading-relaxed drop-shadow">
        Cultivating academic rigor, moral integrity, and lifelong curiosity within a vibrant and disciplined campus environment in Dobhi, Haryana.
      </p>
    </div>
  </section>

  <!-- Milestones & Achievements Stat Strip -->
  <section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 -mt-10 sm:-mt-16 w-full">
    <div class="bg-surface-pure rounded-2xl shadow-[0_12px_28px_rgba(11,38,71,0.08)] p-4 sm:p-8 lg:p-12 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8">
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary">20+</span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight">Years of Excellence</span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary">100%</span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight">Board Results</span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary">1,500+</span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight">Alumni &amp; Students</span>
      </div>
      <div class="flex flex-col items-center text-center">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl font-bold text-secondary">1:15</span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight">Teacher-Student Ratio</span>
      </div>
    </div>
  </section>

  <!-- Vision & Mission Side-by-Side Cards -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold">Our Core Philosophy</span>
      <h2 class="font-headline-lg text-headline-lg text-primary">Guiding Principles of Education</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <div class="bg-surface-pure rounded-xl p-10 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all flex flex-col justify-between border border-border-warm">
        <div class="flex flex-col gap-6">
          <div class="w-14 h-14 rounded-lg bg-gold-light flex items-center justify-center text-secondary">
            <span class="material-symbols-outlined text-[28px]">visibility</span>
          </div>
          <span class="text-eyebrow text-secondary uppercase font-bold">Our Vision</span>
          <h3 class="font-headline-md text-headline-md text-primary">To Enlighten Every Mind Like the Rising Sun</h3>
          <p class="font-body-lg text-on-surface-variant">
            Sun Rise Sr. Sec. School envisions building a forward-looking student community rooted in timeless values, academic distinction, ethical integrity, and technological readiness to lead with compassion and confidence.
          </p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center gap-2 text-primary font-label-md">
          <a href="academics.php" class="inline-flex items-center gap-2 hover:text-[#C9A24B] transition-colors font-bold">
            <span>Explore Academic Framework</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <div class="bg-surface-pure rounded-xl p-10 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all flex flex-col justify-between border border-border-warm">
        <div class="flex flex-col gap-6">
          <div class="w-14 h-14 rounded-lg bg-gold-light flex items-center justify-center text-secondary">
            <span class="material-symbols-outlined text-[28px]">explore</span>
          </div>
          <span class="text-eyebrow text-secondary uppercase font-bold">Our Mission</span>
          <h3 class="font-headline-md text-headline-md text-primary">Holistic Education for Mind, Body &amp; Soul</h3>
          <p class="font-body-lg text-on-surface-variant">
            We are dedicated to delivering a comprehensive HBSC curriculum enriched by hands-on science laboratories, digital learning, sportsmanship, moral values, and cultural activities that nurture well-rounded global citizens.
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

  <!-- History & Core Pillars -->
  <section class="bg-surface-container-low py-24 w-full">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold">Our Growth Journey</span>
        <h2 class="font-headline-lg text-headline-lg text-primary">Milestones in Our History</h2>
      </div>
      <div class="relative border-l-2 border-border-warm ml-4 md:ml-32 pl-8 md:pl-12 flex flex-col gap-16">
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[41px] md:-left-[57px] top-1 w-6 h-6 rounded-full bg-primary border-4 border-surface-container-low flex items-center justify-center"></div>
          <span class="text-eyebrow text-secondary font-eyebrow font-bold">Foundation</span>
          <h3 class="font-headline-md text-headline-md text-primary">Establishment of Sun Rise School</h3>
          <p class="font-body-md text-on-surface-variant max-w-2xl">
            Founded with the noble aspiration to bring quality, modern, value-based English and Hindi medium education to the youth of Dobhi and surrounding regions.
          </p>
        </div>
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[41px] md:-left-[57px] top-1 w-6 h-6 rounded-full bg-primary border-4 border-surface-container-low flex items-center justify-center"></div>
          <span class="text-eyebrow text-secondary font-eyebrow font-bold">Upgradation</span>
          <h3 class="font-headline-md text-headline-md text-primary">HBSC Affiliation &amp; Senior Secondary Streams</h3>
          <p class="font-body-md text-on-surface-variant max-w-2xl">
            Upgraded to Senior Secondary (10+2) under HBSC with specialized streams in Science (Medical/Non-Medical), Commerce, and Arts alongside modern physics, chemistry, and biology labs.
          </p>
        </div>
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[41px] md:-left-[57px] top-1 w-6 h-6 rounded-full bg-primary border-4 border-surface-container-low flex items-center justify-center"></div>
          <span class="text-eyebrow text-secondary font-eyebrow font-bold">Infrastructure</span>
          <h3 class="font-headline-md text-headline-md text-primary">Modern Science Labs, Computer Lab &amp; Sports Ground</h3>
          <p class="font-body-md text-on-surface-variant max-w-2xl">
            Inauguration of modern digital smart classrooms, a high-tech computer laboratory, a wide athletic sports ground, and annual science exhibitions.
          </p>
        </div>
        <div class="relative flex flex-col gap-2">
          <div class="absolute -left-[41px] md:-left-[57px] top-1 w-6 h-6 rounded-full bg-primary border-4 border-surface-container-low flex items-center justify-center"></div>
          <span class="text-eyebrow text-secondary font-eyebrow font-bold">Today</span>
          <h3 class="font-headline-md text-headline-md text-primary">Empowering Future Generations</h3>
          <p class="font-body-md text-on-surface-variant max-w-2xl">
            Consistently achieving 100% board results, district academic merit awards, and sports championships, paving pathways to premier universities and professional colleges.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Chairman / Principal Address -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="bg-primary text-on-primary rounded-2xl p-8 lg:p-16 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-5 flex flex-col items-center">
        <div class="w-64 h-80 rounded-xl overflow-hidden shadow-2xl bg-cover bg-center border-2 border-secondary" style="background-image: url('<?= school_img('speaker.webp') ?>')"></div>
      </div>
      <div class="lg:col-span-7 flex flex-col gap-6">
        <span class="text-eyebrow text-secondary-container uppercase tracking-widest font-eyebrow font-bold">Leadership Message</span>
        <blockquote class="font-headline-lg text-headline-lg text-on-primary italic font-serif">
          “Our mission is to illuminate young minds with knowledge, strengthen their character with discipline, and empower them to become successful citizens of tomorrow.”
        </blockquote>
        <div class="flex flex-col gap-1 mt-4">
          <span class="font-label-md text-on-primary font-bold">Principal &amp; Management Committee</span>
          <span class="text-body-sm text-primary-fixed-dim">Sun Rise Sr. Sec. School, Dobhi (Hisar, Haryana)</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Campus Photo Collage -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24 w-full">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="text-eyebrow text-secondary uppercase font-eyebrow mb-2 block font-bold">Visual Tour</span>
      <h2 class="font-headline-lg text-headline-lg text-primary">Moments &amp; Campus Life</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-[600px]">
      <div class="flex flex-col gap-6 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('school.webp') ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded">Main Campus Building</span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('children_praying.webp') ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded">Morning Prayer &amp; Assembly</span>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:h-full">
        <div class="h-full rounded-xl bg-cover bg-center shadow-md min-h-[400px] md:min-h-full cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('school3.webp') ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-6 flex items-end">
            <span class="text-white text-base font-bold bg-primary/80 px-3 py-1.5 rounded">Campus Panorama View</span>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-6 md:h-full">
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('exhibition3.webp') ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded">Student Science Exhibitions</span>
          </div>
        </div>
        <div class="flex-1 rounded-xl bg-cover bg-center shadow-md min-h-[250px] cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('students_teachers.webp') ?>')">
          <div class="w-full h-full bg-primary/20 hover:bg-primary/40 transition-colors rounded-xl p-4 flex items-end">
            <span class="text-white text-sm font-bold bg-primary/80 px-2.5 py-1 rounded">Interactive Faculty Mentorship</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
