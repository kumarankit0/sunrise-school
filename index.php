<?php
$current_page = 'home';
$page_title = 'Welcome to Sun Rise Sr. Sec. School, Dobhi';
$page_description = 'Sun Rise Sr. Sec. School, Dobhi offers premier HBSC education from Pre-Primary to Senior Secondary streams with state-of-the-art infrastructure, experienced faculty, and holistic learning.';
$page_keywords = 'Sun Rise Sr. Sec. School Dobhi, best HBSC school Hisar, admissions 2026-27, senior secondary school, science commerce arts streams, top school Haryana';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Background Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary">
    <div class="absolute inset-0 z-0 opacity-65 bg-cover bg-center transition-all duration-1000" style="background-image: url('<?= school_img('school_home1.webp') ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-primary/75 z-10"></div>
    <div class="relative z-20 max-w-6xl mx-auto px-6 lg:px-12 w-full flex flex-col items-center text-center gap-7">
      <div class="inline-flex items-center gap-2.5 bg-black/40 backdrop-blur-md border border-[#C9A24B]/50 px-5 py-2 rounded-full text-gold-light text-eyebrow font-bold shadow-lg">
        <span class="material-symbols-outlined text-[18px] text-[#C9A24B]">military_tech</span>
        AFFILIATED TO HBSC &bull; PRE-PRIMARY TO SENIOR SECONDARY (10+2)
      </div>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white w-full max-w-5xl tracking-tight leading-[1.12] drop-shadow-md">
        Empowering Minds, Inspiring Character &amp; <span class="text-[#C9A24B] italic">Academic Excellence</span>
      </h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl font-body leading-relaxed drop-shadow">
        Welcome to Sun Rise Sr. Sec. School, Dobhi. We foster an enriching educational environment combining rigorous HBSC scholarship, moral values, modern technology, and sportsmanship.
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

  <!-- Welcome / Spotlight & Stats Section -->
  <section class="w-full py-14 lg:py-24 bg-surface relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
      <div class="lg:col-span-6 flex flex-col gap-5 sm:gap-6">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold">THE SUN RISE LEGACY</div>
        <h2 class="text-2xl sm:text-3xl lg:text-headline-lg font-headline-lg text-primary leading-tight">
          A Tradition of Holistic Education &amp; Outstanding Results
        </h2>
        <p class="text-sm sm:text-base lg:text-body-lg text-on-surface-variant font-body leading-relaxed">
          At Sun Rise Sr. Sec. School, Dobhi, we are dedicated to nurturing each student's intellectual, physical, and moral growth. Through cutting-edge science labs, dedicated sports facilities, and exemplary faculty mentorship, our students consistently achieve top honours in HBSC board exams and competitive Olympiads.
        </p>
        <div class="grid grid-cols-2 gap-3 sm:gap-6 pt-2 sm:pt-4">
          <div class="p-3.5 sm:p-5 lg:p-6 bg-surface-container-low rounded-xl border border-border-warm">
            <div class="text-xl sm:text-2xl lg:text-[32px] font-headline-lg font-bold text-primary">100%</div>
            <div class="text-body-sm text-[11px] sm:text-xs lg:text-sm text-on-surface-variant mt-1 leading-snug">HBSC Board Pass Result</div>
          </div>
          <div class="p-3.5 sm:p-5 lg:p-6 bg-surface-container-low rounded-xl border border-border-warm">
            <div class="text-xl sm:text-2xl lg:text-[32px] font-headline-lg font-bold text-primary">1:15</div>
            <div class="text-body-sm text-[11px] sm:text-xs lg:text-sm text-on-surface-variant mt-1 leading-snug">Teacher-to-Student Ratio</div>
          </div>
        </div>
      </div>
      <div class="lg:col-span-6 grid grid-cols-2 gap-3 sm:gap-6">
        <div class="flex flex-col gap-3 sm:gap-6">
          <div class="p-4 sm:p-6 lg:p-8 bg-primary text-on-primary rounded-xl flex flex-col justify-between min-h-[140px] sm:h-56 lg:h-64 shadow-sm">
            <span class="material-symbols-outlined text-[28px] sm:text-[36px] lg:text-[40px] text-[#C9A24B]">school</span>
            <div>
              <div class="text-xl sm:text-2xl lg:text-4xl font-headline-lg font-bold text-[#C9A24B]">20+</div>
              <div class="text-[10px] sm:text-xs lg:text-label-md uppercase tracking-wider text-surface-cream mt-0.5 sm:mt-1 leading-snug">Years of Service</div>
            </div>
          </div>
          <div class="p-4 sm:p-6 lg:p-8 bg-surface-container-low rounded-xl border border-border-warm flex flex-col justify-between min-h-[140px] sm:h-56 lg:h-64 shadow-sm">
            <span class="material-symbols-outlined text-[28px] sm:text-[36px] lg:text-[40px] text-primary">group</span>
            <div>
              <div class="text-xl sm:text-2xl lg:text-4xl font-headline-lg font-bold text-primary">1,500+</div>
              <div class="text-[10px] sm:text-xs lg:text-label-md uppercase tracking-wider text-on-surface-variant mt-0.5 sm:mt-1 leading-snug">Enrolled Scholars</div>
            </div>
          </div>
        </div>
        <div class="flex flex-col gap-3 sm:gap-6 pt-3 sm:pt-6 lg:pt-12">
          <div class="p-4 sm:p-6 lg:p-8 bg-surface-container-low rounded-xl border border-border-warm flex flex-col justify-between min-h-[140px] sm:h-56 lg:h-64 shadow-sm">
            <span class="material-symbols-outlined text-[28px] sm:text-[36px] lg:text-[40px] text-primary">landscape</span>
            <div>
              <div class="text-xl sm:text-2xl lg:text-4xl font-headline-lg font-bold text-primary leading-none">Campus</div>
              <div class="text-[10px] sm:text-xs lg:text-label-md uppercase tracking-wider text-on-surface-variant mt-0.5 sm:mt-1 leading-snug">Lush Green Campus</div>
            </div>
          </div>
          <div class="p-4 sm:p-6 lg:p-8 bg-[#C9A24B] text-primary rounded-xl flex flex-col justify-between min-h-[140px] sm:h-56 lg:h-64 shadow-sm">
            <span class="material-symbols-outlined text-[28px] sm:text-[36px] lg:text-[40px] text-primary">verified_user</span>
            <div>
              <div class="text-xl sm:text-2xl lg:text-4xl font-headline-lg font-bold text-primary">50+</div>
              <div class="text-[10px] sm:text-xs lg:text-label-md uppercase tracking-wider font-bold mt-0.5 sm:mt-1 leading-snug">Dedicated Staff</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3-Card Feature Row: Academics, Sports, Co-curricular -->
  <section class="w-full py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-16">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest">WHY CHOOSE SUN RISE</div>
          <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary mt-2">Pillars of Holistic Development</h2>
        </div>
        <p class="text-body-md text-on-surface-variant max-w-md">Our balanced framework ensures intellectual achievement is complemented by discipline, sportsmanship, and creative expression.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1: Academics -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= school_img('project.webp') ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]">HBSC CURRICULUM</span>
              <h3 class="text-headline-sm font-headline-sm text-primary">Science &amp; Practical Labs</h3>
              <p class="text-body-md text-on-surface-variant">State-of-the-art Physics, Chemistry, Biology, and Computer Science laboratories enabling experiential, hands-on scientific learning.</p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="academics.php">
              Read More <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- Card 2: Sports -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= school_img('students_ground.webp') ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]">ATHLETICS &amp; FITNESS</span>
              <h3 class="text-headline-sm font-headline-sm text-primary">Sports Ground &amp; Yoga</h3>
              <p class="text-body-md text-on-surface-variant">Spacious athletic playfields, track events, cricket, volleyball, football, and daily morning yoga for physical and mental vigour.</p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="campus.php">
              Read More <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- Card 3: Co-curricular -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col group hover:-translate-y-1 transition-all duration-300 shadow-sm">
          <div class="h-64 w-full bg-cover bg-center overflow-hidden" style="background-image: url('<?= school_img('exhibition.webp') ?>')"></div>
          <div class="p-8 flex flex-col flex-1 justify-between gap-6">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B]">INNOVATION &amp; ART</span>
              <h3 class="text-headline-sm font-headline-sm text-primary">Science &amp; Art Exhibitions</h3>
              <p class="text-body-md text-on-surface-variant">Annual science exhibitions, model-making fairs, cultural assemblies, debate contests, and creative arts celebrations.</p>
            </div>
            <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="gallery.php">
              Read More <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
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
        <div class="relative rounded-xl overflow-hidden shadow-xl aspect-[4/5] bg-cover bg-center" style="background-image: url('<?= school_img('speaker.webp') ?>')"></div>
      </div>
      <div class="lg:col-span-7 flex flex-col gap-6 lg:pl-10">
        <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest">LEADERSHIP MESSAGE</div>
        <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary">
          Guiding Young Minds Towards Bright Futures
        </h2>
        <blockquote class="text-title-editorial font-headline-md italic text-on-surface border-l-4 border-[#C9A24B] pl-6 py-2 my-4">
          “Education at Sun Rise is not only about securing top marks, but about cultivating strong character, moral courage, and curiosity to achieve lasting success in life.”
        </blockquote>
        <p class="text-body-md text-on-surface-variant font-body">
          At Sun Rise Sr. Sec. School, Dobhi, we provide an inspiring sanctuary of learning where every child is valued and encouraged to realize their maximum potential. Our devoted faculty strives tirelessly to ensure each student shines bright like the rising sun.
        </p>
        <div class="pt-4 flex items-center gap-4">
          <div>
            <div class="text-headline-sm font-headline-sm text-primary">School Leadership &amp; Principal</div>
            <div class="text-body-sm text-on-surface-variant">Sun Rise Sr. Sec. School, Dobhi</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Upcoming Events & News Section -->
  <section class="w-full py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-12">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest">NOTICES &amp; HAPPENINGS</div>
          <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary mt-2">School Events &amp; News</h2>
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
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold">ACADEMIC</span>
              <span class="text-body-sm text-on-surface-variant font-bold">ANNUAL</span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary">Annual Science &amp; Innovation Exhibition</h3>
            <p class="text-body-md text-on-surface-variant">Students display innovative working models, robotics experiments, and environmental science projects.</p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary">School Campus</span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="events.php">Explore Details →</a>
          </div>
        </div>
        <!-- Event Card 2 -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col justify-between p-8 gap-6 shadow-sm">
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold">CEREMONY</span>
              <span class="text-body-sm text-on-surface-variant font-bold">AWARDS</span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary">Prize Distribution &amp; Felicitation Day</h3>
            <p class="text-body-md text-on-surface-variant">Honouring board exam toppers, scholarship achievers, and sports champions with merit awards.</p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary">Main Auditorium</span>
            <a class="text-label-md text-[#C9A24B] font-bold hover:underline" href="events.php">Learn More →</a>
          </div>
        </div>
        <!-- Event Card 3 -->
        <div class="bg-surface rounded-xl overflow-hidden border border-border-warm flex flex-col justify-between p-8 gap-6 shadow-sm">
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span class="bg-[#C9A24B]/10 text-[#C9A24B] px-3 py-1 rounded text-eyebrow font-bold">CELEBRATION</span>
              <span class="text-body-sm text-on-surface-variant font-bold">NATIONAL</span>
            </div>
            <h3 class="text-headline-sm font-headline-sm text-primary">National Festivals &amp; Cultural Assemblies</h3>
            <p class="text-body-md text-on-surface-variant">Flag hoisting ceremony, patriotic songs, cultural dances, and speeches commemorating national heritage.</p>
          </div>
          <div class="pt-4 border-t border-border-warm flex justify-between items-center">
            <span class="text-body-sm font-bold text-primary">Assembly Ground</span>
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
          <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest">CAMPUS GLIMPSES</div>
          <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary mt-2">Life at Sun Rise Sr. Sec. School</h2>
        </div>
        <a class="inline-flex items-center gap-2 text-label-md text-primary font-bold hover:text-[#C9A24B] transition-colors" href="gallery.php">
          View Full Gallery <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Photo 1: Night View -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('school_nightview.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Main Campus Building</h3>
              <p class="text-xs text-white/80">Illuminated view of Sun Rise School architecture.</p>
            </div>
          </div>
        </div>
        <!-- Photo 2: Smart Classroom -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('children_sitting.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Interactive Classrooms</h3>
              <p class="text-xs text-white/80">Engaged students in an active learning environment.</p>
            </div>
          </div>
        </div>
        <!-- Photo 3: Faculty -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('all_staffmembers.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Dedicated Teaching Faculty</h3>
              <p class="text-xs text-white/80">Experienced mentors guiding students every step.</p>
            </div>
          </div>
        </div>
        <!-- Photo 4: Student Life -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('students_grouppic.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Student Community</h3>
              <p class="text-xs text-white/80">A vibrant and cheerful environment for every learner.</p>
            </div>
          </div>
        </div>
        <!-- Photo 5: Yoga & Physical Education -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('yoga.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Yoga &amp; Holistic Health</h3>
              <p class="text-xs text-white/80">Physical wellness, meditation, and self-discipline.</p>
            </div>
          </div>
        </div>
        <!-- Photo 6: Project & Innovation -->
        <div class="h-80 rounded-xl overflow-hidden bg-cover bg-center group relative shadow-sm cursor-pointer" onclick="openLightbox(this)" style="background-image: url('<?= school_img('project.webp') ?>')">
          <div class="absolute inset-0 bg-primary/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <h3 class="text-white text-label-md font-bold">Science Projects</h3>
              <p class="text-xs text-white/80">Inspiring young scientists with practical exhibitions.</p>
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
          <span class="material-symbols-outlined text-[#C9A24B]">verified</span> HBSC AFFILIATED
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
    <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('<?= school_img('school_home2.webp') ?>')"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-12 text-center flex flex-col items-center gap-8">
      <div class="text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold">ADMISSIONS 2026-27</div>
      <h2 class="text-display-hero-mobile md:text-display-hero font-headline-lg text-white">
        Give Your Child the <span class="text-[#C9A24B] italic">Sun Rise Advantage</span>
      </h2>
      <p class="text-body-lg text-surface-cream max-w-2xl font-body">
        Admissions are now open for Pre-Primary to Class 12. Schedule a campus visit or apply online today to provide your child with quality education and bright future.
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
        <a class="btn-gold" href="admission.php">
          <span>Apply For Admission</span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
        <a class="btn-outline-white" href="contact-us.php">
          <span>Contact Campus Office</span>
          <span class="material-symbols-outlined text-[18px]">call</span>
        </a>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
