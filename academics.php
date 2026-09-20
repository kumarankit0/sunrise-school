<?php
$current_page = 'academics';
$page_title = 'Academics & HBSE Curriculum | Pre-Primary to 10+2';
$page_description = 'Explore the comprehensive HBSE curriculum at Sun Rise Sr. Sec. School, Dobhi from Pre-Primary to Senior Secondary streams (Science, Commerce, Arts).';
$page_keywords = 'academics, HBSE curriculum, Science stream, Commerce stream, Arts stream, Sun Rise School Dobhi, lab practicals, high school';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary text-on-primary px-6 lg:px-12 overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center pointer-events-none" style="background-image: url('<?= get_image('academics', 'hero_banner', school_img('exhibition.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="max-w-6xl w-full mx-auto relative z-10 flex flex-col items-center text-center gap-6">
      <span class="font-eyebrow text-eyebrow text-gold-light uppercase tracking-widest bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full font-bold shadow-md">
        <?= get_text('academics', 'hero_badge', 'Academic Excellence') ?>
      </span>
      <h1 class="text-[1.65rem] sm:text-[1.85rem] md:text-[2rem] font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight leading-[1.2] drop-shadow-md">
        <?= get_text('academics', 'hero_title', 'Rigorous HBSE Curriculum Designed for Success') ?>
      </h1>
      <p class="text-sm sm:text-base md:text-lg text-surface-cream/95 w-full max-w-3xl leading-relaxed drop-shadow">
        <?= get_text('academics', 'hero_subtitle', 'Discover an enriching academic framework from Pre-Primary to Class 12, fostering analytical thinking, practical lab experimentation, moral values, and board examination distinction.') ?>
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 pt-3">
        <a class="btn-gold text-base sm:text-lg px-8 py-3.5 shadow-xl" href="#curriculum-levels">Explore Stages</a>
        <a class="btn-outline-white text-base sm:text-lg px-8 py-3.5 shadow-xl" href="#streams">Senior Secondary Streams</a>
      </div>
    </div>
  </section>

  <!-- Quick Stats Strip -->
  <section class="bg-surface-container-high py-8 sm:py-12 px-4 sm:px-6 lg:px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 text-center">
      <div class="flex flex-col items-center p-2 sm:p-0">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl text-primary font-bold"><?= get_text('academics', 'stat1_num', '100%') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('academics', 'stat1_lbl', 'HBSE Pass Record') ?></span>
      </div>
      <div class="flex flex-col items-center p-2 sm:p-0">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl text-primary font-bold"><?= get_text('academics', 'stat2_num', '1:15') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('academics', 'stat2_lbl', 'Teacher-Student Ratio') ?></span>
      </div>
      <div class="flex flex-col items-center p-2 sm:p-0">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl text-primary font-bold whitespace-nowrap"><?= get_text('academics', 'stat3_num', '3 Streams') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('academics', 'stat3_lbl', 'Science, Commerce &amp; Arts') ?></span>
      </div>
      <div class="flex flex-col items-center p-2 sm:p-0">
        <span class="font-display-hero text-2xl sm:text-3xl lg:text-4xl text-primary font-bold"><?= get_text('academics', 'stat4_num', 'Modern') ?></span>
        <span class="font-eyebrow text-[10px] sm:text-xs md:text-sm text-on-surface-variant uppercase mt-1 sm:mt-2 font-bold leading-tight"><?= get_text('academics', 'stat4_lbl', 'Labs &amp; Smart Classes') ?></span>
      </div>
    </div>
  </section>

  <!-- Curriculum Overview by Level -->
  <section class="py-24 px-6 lg:px-12 max-w-7xl mx-auto w-full" id="curriculum-levels">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
      <div>
        <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('academics', 'curriculum_eyebrow', 'Academic Stages') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('academics', 'curriculum_heading', 'Curriculum Stages by Level') ?></h2>
      </div>
      <p class="font-body-md text-on-surface-variant max-w-md"><?= get_text('academics', 'curriculum_desc', 'Our progressive learning architecture builds conceptual clarity, self-confidence, and critical inquiry from early years to Class 12.') ?></p>
    </div>

    <!-- Interactive Tabs / Accordion Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      <!-- Navigation Tabs -->
      <div class="lg:col-span-4 flex flex-col gap-3" id="level-tabs">
        <button class="level-btn active" data-target="pre-primary" onclick="switchLevel('pre-primary')">
          <span>Pre-Primary (Nursery, LKG, UKG)</span>
          <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </button>
        <button class="level-btn" data-target="primary" onclick="switchLevel('primary')">
          <span>Primary School (Classes 1-5)</span>
          <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </button>
        <button class="level-btn" data-target="middle" onclick="switchLevel('middle')">
          <span>Middle School (Classes 6-8)</span>
          <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </button>
        <button class="level-btn" data-target="secondary" onclick="switchLevel('secondary')">
          <span>Secondary School (Classes 9-10)</span>
          <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </button>
        <button class="level-btn" data-target="senior" onclick="switchLevel('senior')">
          <span>Senior Secondary (Classes 11-12)</span>
          <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </button>
      </div>

      <!-- Tab Content Area -->
      <div class="lg:col-span-8 bg-surface-container-lowest p-5 sm:p-8 lg:p-12 rounded-2xl shadow-sm border border-border-warm">
        <!-- Pre-Primary -->
        <div class="level-content flex flex-col gap-6" id="content-pre-primary">
          <div class="flex items-center gap-3">
            <span class="bg-[#F9F4E8] text-[#C9A24B] px-3 py-1 rounded text-eyebrow uppercase font-bold border border-[#C9A24B]/35">Early Childhood Education</span>
            <span class="text-on-surface-variant text-body-sm">Ages 3 to 5 Years</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">Play-Based Learning &amp; Foundational Wonder</h3>
          <p class="font-body-md text-on-surface-variant">The Pre-Primary wing provides a nurturing environment where children discover the joy of learning through play, storytelling, numbers, rhymes, phonics, and motor skill activities.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Phonics &amp; Language</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Foundational English and Hindi alphabet recognition and speech development.</p>
              </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Creative Expression</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Daily engagement through drawing, clay modeling, games, and music.</p>
              </div>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-border-warm flex justify-between items-center">
            <span class="font-label-sm text-on-surface-variant uppercase font-bold">Focus: Cognitive &amp; Social Readiness</span>
            <a class="text-primary font-label-md hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Primary -->
        <div class="level-content hidden flex flex-col gap-6" id="content-primary">
          <div class="flex items-center gap-3">
            <span class="bg-[#F9F4E8] text-[#C9A24B] px-3 py-1 rounded text-eyebrow uppercase font-bold border border-[#C9A24B]/35">Foundational Stage</span>
            <span class="text-on-surface-variant text-body-sm">Classes 1 to 5</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">Strengthening Core Concepts &amp; Curiosity</h3>
          <p class="font-body-md text-on-surface-variant">Primary education at Sun Rise focuses on strong mathematical foundations, environmental studies (EVS), linguistic fluency, general knowledge, and computer literacy.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Activity-Based Mathematics</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Conceptual arithmetic, mental math, and visual geometry kits.</p>
              </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Science &amp; Environment</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Nature observation, plants, hygiene, and daily science awareness.</p>
              </div>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-border-warm flex justify-between items-center">
            <span class="font-label-sm text-on-surface-variant uppercase font-bold">Focus: Academic Discipline &amp; Values</span>
            <a class="text-primary font-label-md hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Middle School -->
        <div class="level-content hidden flex flex-col gap-6" id="content-middle">
          <div class="flex items-center gap-3">
            <span class="bg-[#F9F4E8] text-[#C9A24B] px-3 py-1 rounded text-eyebrow uppercase font-bold border border-[#C9A24B]/35">Preparatory Stage</span>
            <span class="text-on-surface-variant text-body-sm">Classes 6 to 8</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">Developing Critical Thinking &amp; Lab Skills</h3>
          <p class="font-body-md text-on-surface-variant">Middle school students dive into specialized subjects: Science (Physics, Chemistry, Biology), Mathematics, Social Sciences, Computer Applications, and Languages.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Science Lab Demonstrations</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Practical experiments, exhibition projects, and scientific reasoning.</p>
              </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Computer Science</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Hands-on typing, digital literacy, and basic programming logic.</p>
              </div>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-border-warm flex justify-between items-center">
            <span class="font-label-sm text-on-surface-variant uppercase font-bold">Focus: Analytical &amp; Practical Skills</span>
            <a class="text-primary font-label-md hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Secondary School -->
        <div class="level-content hidden flex flex-col gap-6" id="content-secondary">
          <div class="flex items-center gap-3">
            <span class="bg-[#F9F4E8] text-[#C9A24B] px-3 py-1 rounded text-eyebrow uppercase font-bold border border-[#C9A24B]/35">HBSE Board Stage</span>
            <span class="text-on-surface-variant text-body-sm">Classes 9 to 10</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">HBSE Class 10 Board Examination Rigor</h3>
          <p class="font-body-md text-on-surface-variant">Intensive preparation for HBSE examinations through chapter-wise tests, regular mock examinations, doubt-solving sessions, and practical assessments.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Thorough Exam Prep</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Sample papers, NCERT mastery, and strategic test series.</p>
              </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Career &amp; Stream Guidance</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Expert counseling to select the right stream for Class 11.</p>
              </div>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-border-warm flex justify-between items-center">
            <span class="font-label-sm text-on-surface-variant uppercase font-bold">Focus: 100% Board Distinction</span>
            <a class="text-primary font-label-md hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Senior Secondary -->
        <div class="level-content hidden flex flex-col gap-6" id="content-senior">
          <div class="flex items-center gap-3">
            <span class="bg-[#F9F4E8] text-[#C9A24B] px-3 py-1 rounded text-eyebrow uppercase font-bold border border-[#C9A24B]/35">Senior Secondary (10+2)</span>
            <span class="text-on-surface-variant text-body-sm">Classes 11 to 12</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">Specialized Streams for University &amp; Competitive Exams</h3>
          <p class="font-body-md text-on-surface-variant">Offering specialized academic streams (Science, Commerce, Arts) taught by seasoned post-graduate educators with modern practical laboratory setups.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Multiple Stream Choices</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Medical (PCB), Non-Medical (PCM), Commerce, and Humanities / Arts.</p>
              </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low">
              <span class="material-symbols-outlined text-[#C9A24B] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <div>
                <h4 class="font-label-md text-primary font-bold">Practical Mastery</h4>
                <p class="font-body-sm text-on-surface-variant mt-1">Full syllabus practicals in physics, chemistry, biology, and IP/CS labs.</p>
              </div>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-border-warm flex justify-between items-center">
            <span class="font-label-sm text-on-surface-variant uppercase font-bold">Focus: Higher Education &amp; Careers</span>
            <a class="text-primary font-label-md hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Subject / Stream Cards for Class 11-12 -->
  <section class="py-24 px-6 lg:px-12 max-w-7xl mx-auto w-full bg-surface-container-low" id="streams">
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('academics', 'streams_eyebrow', 'Class 11 &amp; 12 Streams') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('academics', 'streams_heading', 'Senior Secondary Academic Streams') ?></h2>
      <p class="font-body-md text-on-surface-variant mt-3"><?= get_text('academics', 'streams_desc', 'Tailored academic pathways equipping students for HBSE board excellence and leading university admissions.') ?></p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Science Stream -->
      <div class="bg-surface-pure rounded-2xl p-8 border border-border-warm shadow-sm flex flex-col justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
        <div>
          <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-[#C9A24B]">science</span>
            <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase font-bold">Stream 01</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary mb-3"><?= get_text('academics', 'stream1_name', 'Science (Medical &amp; Non-Medical)') ?></h3>
          <p class="font-body-sm text-on-surface-variant mb-6"><?= get_text('academics', 'stream1_desc', 'Equipped with state-of-the-art physics, chemistry, biology, and computer science laboratories for in-depth conceptual and practical learning.') ?></p>
          <div class="space-y-3">
            <div class="text-body-sm text-on-surface font-bold">Core Subjects:</div>
            <ul class="space-y-2 text-body-sm text-on-surface-variant">
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Physics &amp; Chemistry</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Mathematics / Biology</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Computer Science / Physical Education</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> English Core</li>
            </ul>
          </div>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="font-label-sm text-primary uppercase font-bold">Medical &amp; Engineering Focus</span>
          <a class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center hover:bg-primary-container transition-colors" href="admission.php"><span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
      </div>

      <!-- Commerce Stream -->
      <div class="bg-surface-pure rounded-2xl p-8 border border-border-warm shadow-sm flex flex-col justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
        <div>
          <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-[#C9A24B]">trending_up</span>
            <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase font-bold">Stream 02</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary mb-3"><?= get_text('academics', 'stream2_name', 'Commerce') ?></h3>
          <p class="font-body-sm text-on-surface-variant mb-6"><?= get_text('academics', 'stream2_desc', 'Comprehensive economic, accounting, and business studies designed for careers in banking, finance, CA, and entrepreneurship.') ?></p>
          <div class="space-y-3">
            <div class="text-body-sm text-on-surface font-bold">Core Subjects:</div>
            <ul class="space-y-2 text-body-sm text-on-surface-variant">
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Accountancy</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Business Studies</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Economics &amp; Mathematics / IP</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> English Core</li>
            </ul>
          </div>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="font-label-sm text-primary uppercase font-bold">Commerce &amp; Finance Track</span>
          <a class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center hover:bg-primary-container transition-colors" href="admission.php"><span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
      </div>

      <!-- Arts / Humanities Stream -->
      <div class="bg-surface-pure rounded-2xl p-8 border border-border-warm shadow-sm flex flex-col justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
        <div>
          <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-[#C9A24B]">menu_book</span>
            <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase font-bold">Stream 03</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary mb-3"><?= get_text('academics', 'stream3_name', 'Arts &amp; Humanities') ?></h3>
          <p class="font-body-sm text-on-surface-variant mb-6"><?= get_text('academics', 'stream3_desc', 'Deep exploration of history, political science, geography, literature, and social sciences for future administrative and legal leaders.') ?></p>
          <div class="space-y-3">
            <div class="text-body-sm text-on-surface font-bold">Core Subjects:</div>
            <ul class="space-y-2 text-body-sm text-on-surface-variant">
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> History &amp; Political Science</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Geography / Economics</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> Hindi / Physical Education</li>
              <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> English Core</li>
            </ul>
          </div>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="font-label-sm text-primary uppercase font-bold">Civil Services &amp; Law Track</span>
          <a class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center hover:bg-primary-container transition-colors" href="admission.php"><span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Teaching Methodology -->
  <section class="py-24 px-6 lg:px-12 max-w-7xl mx-auto w-full">
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold"><?= get_text('academics', 'pedagogy_eyebrow', 'Pedagogical Approach') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2"><?= get_text('academics', 'pedagogy_heading', 'How We Teach at Sun Rise') ?></h2>
      <p class="font-body-md text-on-surface-variant mt-3"><?= get_text('academics', 'pedagogy_desc', 'Combining traditional teacher mentorship with modern smart-class technology and experimental learning.') ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="bg-surface-pure p-8 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between hover:-translate-y-1 transition-transform">
        <div>
          <div class="w-14 h-14 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-6 text-2xl font-bold">01</div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-3 font-bold"><?= get_text('academics', 'step1_title', 'Concept Clarity') ?></h3>
          <p class="font-body-sm text-on-surface-variant"><?= get_text('academics', 'step1_desc', 'Focus on thorough understanding of NCERT fundamentals before moving to advanced problem solving.') ?></p>
        </div>
        <div class="mt-8 pt-4 border-t border-border-warm text-eyebrow text-[#C9A24B] uppercase tracking-wider font-bold">Core Understanding</div>
      </div>
      <div class="bg-surface-pure p-8 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between hover:-translate-y-1 transition-transform">
        <div>
          <div class="w-14 h-14 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-6 text-2xl font-bold">02</div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-3 font-bold"><?= get_text('academics', 'step2_title', 'Practical Labs') ?></h3>
          <p class="font-body-sm text-on-surface-variant"><?= get_text('academics', 'step2_desc', 'Hands-on experiments in physics, chemistry, biology, and computer science reinforce classroom theory.') ?></p>
        </div>
        <div class="mt-8 pt-4 border-t border-border-warm text-eyebrow text-[#C9A24B] uppercase tracking-wider font-bold">Experiential Learning</div>
      </div>
      <div class="bg-surface-pure p-8 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between hover:-translate-y-1 transition-transform">
        <div>
          <div class="w-14 h-14 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-6 text-2xl font-bold">03</div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-3 font-bold"><?= get_text('academics', 'step3_title', 'Regular Testing') ?></h3>
          <p class="font-body-sm text-on-surface-variant"><?= get_text('academics', 'step3_desc', 'Periodic unit tests, term exams, and mock board tests ensure continuous assessment and revision.') ?></p>
        </div>
        <div class="mt-8 pt-4 border-t border-border-warm text-eyebrow text-[#C9A24B] uppercase tracking-wider font-bold">Exam Readiness</div>
      </div>
      <div class="bg-surface-pure p-8 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between hover:-translate-y-1 transition-transform">
        <div>
          <div class="w-14 h-14 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-6 text-2xl font-bold">04</div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-3 font-bold"><?= get_text('academics', 'step4_title', 'Individual Care') ?></h3>
          <p class="font-body-sm text-on-surface-variant"><?= get_text('academics', 'step4_desc', 'Remedial classes for students needing extra help and personalized attention for every scholar.') ?></p>
        </div>
        <div class="mt-8 pt-4 border-t border-border-warm text-eyebrow text-[#C9A24B] uppercase tracking-wider font-bold">Personal Mentorship</div>
      </div>
    </div>
  </section>

  <!-- Examination System & Evaluation Framework -->
  <section class="py-20 px-6 lg:px-12 max-w-7xl mx-auto w-full bg-surface-container-low rounded-2xl my-8 border border-border-warm" id="examination-system">
    <div class="text-center max-w-3xl mx-auto mb-14">
      <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold">Continuous &amp; Comprehensive Assessment</span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2">Examination &amp; Evaluation System</h2>
      <p class="font-body-md text-on-surface-variant mt-3">At Sun Rise Sr. Sec. School, our evaluation framework ensures continuous learning, diagnostic feedback, and thorough board examination readiness.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Mid-term & Annual -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm flex flex-col justify-between">
        <div class="flex flex-col gap-3">
          <div class="w-12 h-12 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">assignment</span>
          </div>
          <h3 class="font-headline-sm text-base font-bold text-primary">Mid-Term &amp; Annual Exams</h3>
          <p class="font-body-sm text-on-surface-variant">Comprehensive term-end examinations patterned on HBSE board standards, evaluating overall mastery and practical performance.</p>
        </div>
        <div class="pt-4 mt-4 border-t border-border-warm text-xs text-[#C9A24B] font-bold uppercase">Major Milestones</div>
      </div>

      <!-- Monthly Unit Tests -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm flex flex-col justify-between">
        <div class="flex flex-col gap-3">
          <div class="w-12 h-12 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">calendar_month</span>
          </div>
          <h3 class="font-headline-sm text-base font-bold text-primary">Monthly Unit Tests</h3>
          <p class="font-body-sm text-on-surface-variant">Scheduled at the close of every month across all subjects to track topic-wise retention and ensure continuous revision.</p>
        </div>
        <div class="pt-4 mt-4 border-t border-border-warm text-xs text-[#C9A24B] font-bold uppercase">Monthly Assessment</div>
      </div>

      <!-- Regular Class Tests -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm flex flex-col justify-between">
        <div class="flex flex-col gap-3">
          <div class="w-12 h-12 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">quiz</span>
          </div>
          <h3 class="font-headline-sm text-base font-bold text-primary">Regular Class Tests</h3>
          <p class="font-body-sm text-on-surface-variant">Frequent chapter-end evaluations conducted by subject educators to identify learning gaps and reinforce key concepts.</p>
        </div>
        <div class="pt-4 mt-4 border-t border-border-warm text-xs text-[#C9A24B] font-bold uppercase">Topic-by-Topic</div>
      </div>

      <!-- Surprise Tests -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm flex flex-col justify-between">
        <div class="flex flex-col gap-3">
          <div class="w-12 h-12 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">bolt</span>
          </div>
          <h3 class="font-headline-sm text-base font-bold text-primary">Surprise Tests</h3>
          <p class="font-body-sm text-on-surface-variant">Unannounced quick assessments encouraging students to maintain daily revision habits and stay prepared throughout the year.</p>
        </div>
        <div class="pt-4 mt-4 border-t border-border-warm text-xs text-[#C9A24B] font-bold uppercase">Continuous Readiness</div>
      </div>
    </div>

    <!-- Medium of Instruction & Timings Strip -->
    <div class="mt-10 p-6 rounded-xl bg-white border border-[#C9A24B]/30 flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-[#C9A24B]/15 text-[#C9A24B] flex items-center justify-center flex-shrink-0">
          <span class="material-symbols-outlined text-[26px]">translate</span>
        </div>
        <div>
          <span class="text-xs uppercase font-bold text-secondary tracking-wider">Medium of Instruction</span>
          <h4 class="font-headline-sm text-primary font-bold text-base sm:text-lg">English Medium (Nursery to Class XII)</h4>
          <p class="text-xs text-on-surface-variant">With strong Hindi and regional language foundations</p>
        </div>
      </div>
      <div class="h-10 w-px bg-border-warm hidden md:block"></div>
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
          <span class="material-symbols-outlined text-[26px]">schedule</span>
        </div>
        <div>
          <span class="text-xs uppercase font-bold text-secondary tracking-wider">Official School Timings</span>
          <div class="text-xs sm:text-sm font-bold text-primary flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
            <span><strong>Summer:</strong> 7:30 AM – 1:30 PM</span>
            <span class="hidden sm:inline">&bull;</span>
            <span><strong>Winter:</strong> 8:30 AM – 2:30 PM</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Academic Toppers & Board Results Spotlight -->
  <section class="py-20 px-6 lg:px-12 max-w-7xl mx-auto w-full" id="toppers">
    <div class="text-center max-w-3xl mx-auto mb-14">
      <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold">Academic Distinction</span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-2">Board Examination Results &amp; Toppers</h2>
      <p class="font-body-md text-on-surface-variant mt-3">Sun Rise Sr. Sec. School proudly celebrates a consistent 100% HBSE board examination pass rate, producing district and block rank holders.</p>
    </div>

    <div class="bg-primary text-white rounded-2xl p-8 lg:p-12 shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
      <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-[#C9A24B]/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="flex flex-col gap-4 max-w-2xl relative z-10">
        <div class="inline-flex items-center gap-2 bg-[#C9A24B] text-primary px-3.5 py-1 rounded-full text-xs font-bold uppercase self-start">
          <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">military_tech</span>
          HBSE Board Star Achievers
        </div>
        <h3 class="text-2xl sm:text-3xl font-bold font-headline-lg text-white leading-tight">Celebrating Academic Excellence &amp; Merit Ranks</h3>
        <p class="text-surface-cream/90 text-sm sm:text-base leading-relaxed">
          Through systematic syllabus completion, doubt resolution clinics, and regular testing, our Class X and XII students achieve top percentiles in Haryana Board examinations year after year.
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
          <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10">
            <span class="block text-xl font-bold text-[#C9A24B]">100%</span>
            <span class="text-xs text-slate-300">Board Pass Record</span>
          </div>
          <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10">
            <span class="block text-xl font-bold text-[#C9A24B]">Nursery – XII</span>
            <span class="text-xs text-slate-300">Comprehensive Spectrum</span>
          </div>
          <div class="p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10 col-span-2 sm:col-span-1">
            <span class="block text-xl font-bold text-[#C9A24B]">3 Streams</span>
            <span class="text-xs text-slate-300">Science, Commerce, Arts</span>
          </div>
        </div>
      </div>
      <div class="relative z-10 flex flex-col items-center gap-4 flex-shrink-0">
        <div class="w-64 sm:w-72 rounded-xl overflow-hidden shadow-2xl border-2 border-[#C9A24B]/50 cursor-pointer" onclick="openLightbox(this)">
          <img src="assets/images/pop-up%20image.webp" alt="Sun Rise Board Toppers Poster" class="w-full h-auto object-cover" loading="lazy"/>
        </div>
        <span class="text-xs text-[#C9A24B] font-semibold flex items-center gap-1">
          <span class="material-symbols-outlined text-sm">zoom_in</span> Click to view toppers poster
        </span>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
