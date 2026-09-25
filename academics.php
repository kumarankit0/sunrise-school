<?php
$current_page = 'academics';
$page_title = 'Academics & HBSE Curriculum | Pre-Primary to 10+2';
$page_description = 'Explore the comprehensive HBSE curriculum at Sun Rise Sr. Sec. School, Dobhi from Pre-Primary to Senior Secondary streams (Science, Commerce, Arts).';
$page_keywords = 'academics, HBSE curriculum, Science stream, Commerce stream, Arts stream, Sun Rise School Dobhi, lab practicals, high school';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Banner -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 bg-primary text-on-primary px-4 sm:px-6 lg:px-12 overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('academics', 'hero_banner', school_img('exhibition.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="hero-content max-w-6xl w-full mx-auto relative z-10 flex flex-col items-center text-center gap-3 sm:gap-5 lg:gap-6">
      <span class="hero-badge text-gold-light uppercase tracking-widest bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1 sm:px-5 sm:py-2 rounded-full font-bold shadow-md">
        <?= get_text('academics', 'hero_badge', 'Academic Excellence') ?>
      </span>
      <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md">
        <?= get_text('academics', 'hero_title', 'Rigorous HBSE Curriculum Designed for Success') ?>
      </h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl drop-shadow">
        <?= get_text('academics', 'hero_subtitle', 'Discover an enriching academic framework from Pre-Primary to Class 12, fostering analytical thinking, practical lab experimentation, moral values, and board examination distinction.') ?>
      </p>
      <div class="hero-cta-group flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 pt-1 sm:pt-2">
        <a class="btn-gold hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('academics', 'hero_btn1_link', '#curriculum-levels')) ?>">
          <?= get_text('academics', 'hero_btn1_text', 'Explore Stages') ?>
        </a>
        <a class="btn-outline-white hero-cta-btn shadow-md hover:shadow-lg transition-all" href="<?= htmlspecialchars(get_text('academics', 'hero_btn2_link', '#streams')) ?>">
          <?= get_text('academics', 'hero_btn2_text', 'Senior Secondary Streams') ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Quick Stats Strip (Dark Blue Bar with White Text & Compact Height) -->
  <section class="bg-primary text-white py-4 sm:py-6 px-4 sm:px-6 lg:px-12 border-y border-[#C9A24B]/30 shadow-inner relative overflow-hidden">
    <!-- Subtle Background Accent -->
    <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#C9A24B_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 text-center relative z-10">
      <div class="flex flex-col items-center py-1 sm:py-0 border-r border-white/10 last:border-r-0 md:border-r md:[&:nth-child(4)]:border-r-0">
        <span class="text-xl sm:text-2xl lg:text-3xl text-white font-extrabold tracking-tight"><?= get_text('academics', 'stat1_num', '100%') ?></span>
        <span class="text-[9px] sm:text-[11px] text-[#C9A24B] uppercase mt-0.5 sm:mt-1 font-bold tracking-wider leading-tight"><?= get_text('academics', 'stat1_lbl', 'HBSE Pass Record') ?></span>
      </div>
      <div class="flex flex-col items-center py-1 sm:py-0 border-r-0 md:border-r border-white/10 md:[&:nth-child(4)]:border-r-0">
        <span class="text-xl sm:text-2xl lg:text-3xl text-white font-extrabold tracking-tight"><?= get_text('academics', 'stat2_num', '1:15') ?></span>
        <span class="text-[9px] sm:text-[11px] text-[#C9A24B] uppercase mt-0.5 sm:mt-1 font-bold tracking-wider leading-tight"><?= get_text('academics', 'stat2_lbl', 'Teacher-Student Ratio') ?></span>
      </div>
      <div class="flex flex-col items-center py-1 sm:py-0 border-r border-white/10 last:border-r-0 md:border-r md:[&:nth-child(4)]:border-r-0">
        <span class="text-xl sm:text-2xl lg:text-3xl text-white font-extrabold tracking-tight whitespace-nowrap"><?= get_text('academics', 'stat3_num', '3 Streams') ?></span>
        <span class="text-[9px] sm:text-[11px] text-[#C9A24B] uppercase mt-0.5 sm:mt-1 font-bold tracking-wider leading-tight"><?= get_text('academics', 'stat3_lbl', 'Science, Commerce &amp; Arts') ?></span>
      </div>
      <div class="flex flex-col items-center py-1 sm:py-0">
        <span class="text-xl sm:text-2xl lg:text-3xl text-white font-extrabold tracking-tight"><?= get_text('academics', 'stat4_num', 'Modern') ?></span>
        <span class="text-[9px] sm:text-[11px] text-[#C9A24B] uppercase mt-0.5 sm:mt-1 font-bold tracking-wider leading-tight"><?= get_text('academics', 'stat4_lbl', 'Labs &amp; Smart Classes') ?></span>
      </div>
    </div>
  </section>

  <!-- Curriculum Overview by Level -->
  <section class="relative w-full py-10 sm:py-14 px-4 sm:px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" id="curriculum-levels" style="background-color: #eaf0f8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.08) 0%, transparent 40%), radial-gradient(circle at 85% 75%, rgba(11, 38, 71, 0.06) 0%, transparent 45%);">
    <!-- Subtle Architectural / Academic Geometric Patterns -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#001129 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(0, 17, 41, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 17, 41, 0.05) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Ambient Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#C9A24B]/15 blur-3xl pointer-events-none"></div>
    <div class="absolute left-5 bottom-0 w-80 h-80 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 sm:mb-10 gap-4">
        <div>
          <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold text-xs"><?= get_text('academics', 'curriculum_eyebrow', 'Academic Stages') ?></span>
          <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('academics', 'curriculum_heading', 'Curriculum Stages by Level') ?></h2>
        </div>
        <p class="text-xs sm:text-sm text-on-surface-variant max-w-md"><?= get_text('academics', 'curriculum_desc', 'Our progressive learning architecture builds conceptual clarity, self-confidence, and critical inquiry from early years to Class 12.') ?></p>
      </div>

      <!-- Interactive Tabs / Content Layout -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6 items-start">
        <!-- Navigation Tabs -->
        <div class="lg:col-span-4 flex flex-col gap-2.5" id="level-tabs">
          <button class="level-btn active p-3 text-xs sm:text-sm" data-target="pre-primary" onclick="switchLevel('pre-primary')">
            <span><?= get_text('academics', 'stage1_tab', 'Pre-Primary (Nursery, LKG, UKG)') ?></span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </button>
          <button class="level-btn p-3 text-xs sm:text-sm" data-target="primary" onclick="switchLevel('primary')">
            <span><?= get_text('academics', 'stage2_tab', 'Primary School (Classes 1-5)') ?></span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </button>
          <button class="level-btn p-3 text-xs sm:text-sm" data-target="middle" onclick="switchLevel('middle')">
            <span><?= get_text('academics', 'stage3_tab', 'Middle School (Classes 6-8)') ?></span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </button>
          <button class="level-btn p-3 text-xs sm:text-sm" data-target="secondary" onclick="switchLevel('secondary')">
            <span><?= get_text('academics', 'stage4_tab', 'Secondary School (Classes 9-10)') ?></span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </button>
          <button class="level-btn p-3 text-xs sm:text-sm" data-target="senior" onclick="switchLevel('senior')">
            <span><?= get_text('academics', 'stage5_tab', 'Senior Secondary (Classes 11-12)') ?></span>
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
          </button>
        </div>

        <!-- Tab Content Area (Height & padding matching left column) -->
        <div class="lg:col-span-8 bg-surface-pure p-4 sm:p-5 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
          <!-- Pre-Primary -->
          <div class="level-content flex flex-col gap-2.5" id="content-pre-primary">
            <div class="flex items-center gap-2">
              <span class="bg-[#F9F4E8] text-[#C9A24B] px-2 py-0.5 rounded text-[10px] uppercase font-bold border border-[#C9A24B]/35"><?= get_text('academics', 'stage1_badge', 'Early Childhood Education') ?></span>
              <span class="text-on-surface-variant text-[11px]"><?= get_text('academics', 'stage1_age', 'Ages 3 to 5 Years') ?></span>
            </div>
            <h3 class="text-base sm:text-[17px] font-bold text-primary leading-snug"><?= get_text('academics', 'stage1_title', 'Play-Based Learning &amp; Foundational Wonder') ?></h3>
            <p class="text-[11.5px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'stage1_desc', 'The Pre-Primary wing provides a nurturing environment where children discover the joy of learning through play, storytelling, numbers, rhymes, phonics, and motor skill activities.') ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-0.5">
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage1_f1_title', 'Phonics &amp; Language') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage1_f1_desc', 'Foundational English and Hindi alphabet recognition and speech development.') ?></p>
                </div>
              </div>
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage1_f2_title', 'Creative Expression') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage1_f2_desc', 'Daily engagement through drawing, clay modeling, games, and music.') ?></p>
                </div>
              </div>
            </div>
            <div class="mt-1 pt-2.5 border-t border-border-warm flex justify-between items-center text-xs">
              <span class="text-[10px] sm:text-[11px] text-on-surface-variant uppercase font-bold"><?= get_text('academics', 'stage1_focus', 'Focus: Cognitive &amp; Social Readiness') ?></span>
              <a class="text-primary hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold text-xs" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[15px]">arrow_forward</span></a>
            </div>
          </div>

          <!-- Primary -->
          <div class="level-content hidden flex flex-col gap-2.5" id="content-primary">
            <div class="flex items-center gap-2">
              <span class="bg-[#F9F4E8] text-[#C9A24B] px-2 py-0.5 rounded text-[10px] uppercase font-bold border border-[#C9A24B]/35"><?= get_text('academics', 'stage2_badge', 'Foundational Stage') ?></span>
              <span class="text-on-surface-variant text-[11px]"><?= get_text('academics', 'stage2_age', 'Classes 1 to 5') ?></span>
            </div>
            <h3 class="text-base sm:text-[17px] font-bold text-primary leading-snug"><?= get_text('academics', 'stage2_title', 'Strengthening Core Concepts &amp; Curiosity') ?></h3>
            <p class="text-[11.5px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'stage2_desc', 'Primary education at Sun Rise focuses on strong mathematical foundations, environmental studies (EVS), linguistic fluency, general knowledge, and computer literacy.') ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-0.5">
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage2_f1_title', 'Activity-Based Mathematics') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage2_f1_desc', 'Conceptual arithmetic, mental math, and visual geometry kits.') ?></p>
                </div>
              </div>
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage2_f2_title', 'Science &amp; Environment') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage2_f2_desc', 'Nature observation, plants, hygiene, and daily science awareness.') ?></p>
                </div>
              </div>
            </div>
            <div class="mt-1 pt-2.5 border-t border-border-warm flex justify-between items-center text-xs">
              <span class="text-[10px] sm:text-[11px] text-on-surface-variant uppercase font-bold"><?= get_text('academics', 'stage2_focus', 'Focus: Academic Discipline &amp; Values') ?></span>
              <a class="text-primary hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold text-xs" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[15px]">arrow_forward</span></a>
            </div>
          </div>

          <!-- Middle School -->
          <div class="level-content hidden flex flex-col gap-2.5" id="content-middle">
            <div class="flex items-center gap-2">
              <span class="bg-[#F9F4E8] text-[#C9A24B] px-2 py-0.5 rounded text-[10px] uppercase font-bold border border-[#C9A24B]/35"><?= get_text('academics', 'stage3_badge', 'Preparatory Stage') ?></span>
              <span class="text-on-surface-variant text-[11px]"><?= get_text('academics', 'stage3_age', 'Classes 6 to 8') ?></span>
            </div>
            <h3 class="text-base sm:text-[17px] font-bold text-primary leading-snug"><?= get_text('academics', 'stage3_title', 'Developing Critical Thinking &amp; Lab Skills') ?></h3>
            <p class="text-[11.5px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'stage3_desc', 'Middle school students dive into specialized subjects: Science (Physics, Chemistry, Biology), Mathematics, Social Sciences, Computer Applications, and Languages.') ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-0.5">
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage3_f1_title', 'Science Lab Demonstrations') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage3_f1_desc', 'Practical experiments, exhibition projects, and scientific reasoning.') ?></p>
                </div>
              </div>
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage3_f2_title', 'Computer Science') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage3_f2_desc', 'Hands-on typing, digital literacy, and basic programming logic.') ?></p>
                </div>
              </div>
            </div>
            <div class="mt-1 pt-2.5 border-t border-border-warm flex justify-between items-center text-xs">
              <span class="text-[10px] sm:text-[11px] text-on-surface-variant uppercase font-bold"><?= get_text('academics', 'stage3_focus', 'Focus: Analytical &amp; Practical Skills') ?></span>
              <a class="text-primary hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold text-xs" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[15px]">arrow_forward</span></a>
            </div>
          </div>

          <!-- Secondary School -->
          <div class="level-content hidden flex flex-col gap-2.5" id="content-secondary">
            <div class="flex items-center gap-2">
              <span class="bg-[#F9F4E8] text-[#C9A24B] px-2 py-0.5 rounded text-[10px] uppercase font-bold border border-[#C9A24B]/35"><?= get_text('academics', 'stage4_badge', 'HBSE Board Stage') ?></span>
              <span class="text-on-surface-variant text-[11px]"><?= get_text('academics', 'stage4_age', 'Classes 9 to 10') ?></span>
            </div>
            <h3 class="text-base sm:text-[17px] font-bold text-primary leading-snug"><?= get_text('academics', 'stage4_title', 'HBSE Class 10 Board Examination Rigor') ?></h3>
            <p class="text-[11.5px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'stage4_desc', 'Intensive preparation for HBSE examinations through chapter-wise tests, regular mock examinations, doubt-solving sessions, and practical assessments.') ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-0.5">
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage4_f1_title', 'Thorough Exam Prep') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage4_f1_desc', 'Sample papers, NCERT mastery, and strategic test series.') ?></p>
                </div>
              </div>
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage4_f2_title', 'Career &amp; Stream Guidance') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage4_f2_desc', 'Expert counseling to select the right stream for Class 11.') ?></p>
                </div>
              </div>
            </div>
            <div class="mt-1 pt-2.5 border-t border-border-warm flex justify-between items-center text-xs">
              <span class="text-[10px] sm:text-[11px] text-on-surface-variant uppercase font-bold"><?= get_text('academics', 'stage4_focus', 'Focus: 100% Board Distinction') ?></span>
              <a class="text-primary hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold text-xs" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[15px]">arrow_forward</span></a>
            </div>
          </div>

          <!-- Senior Secondary -->
          <div class="level-content hidden flex flex-col gap-2.5" id="content-senior">
            <div class="flex items-center gap-2">
              <span class="bg-[#F9F4E8] text-[#C9A24B] px-2 py-0.5 rounded text-[10px] uppercase font-bold border border-[#C9A24B]/35"><?= get_text('academics', 'stage5_badge', 'Senior Secondary (10+2)') ?></span>
              <span class="text-on-surface-variant text-[11px]"><?= get_text('academics', 'stage5_age', 'Classes 11 to 12') ?></span>
            </div>
            <h3 class="text-base sm:text-[17px] font-bold text-primary leading-snug"><?= get_text('academics', 'stage5_title', 'Specialized Streams for University &amp; Competitive Exams') ?></h3>
            <p class="text-[11.5px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'stage5_desc', 'Offering specialized academic streams (Science, Commerce, Arts) taught by seasoned post-graduate educators with modern practical laboratory setups.') ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-0.5">
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage5_f1_title', 'Multiple Stream Choices') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage5_f1_desc', 'Medical (PCB), Non-Medical (PCM), Commerce, and Humanities / Arts.') ?></p>
                </div>
              </div>
              <div class="flex items-start gap-2 p-2.5 rounded-lg bg-surface-container-low border border-border-warm/60">
                <span class="material-symbols-outlined text-[#C9A24B] text-[17px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <div>
                  <h4 class="text-[11.5px] text-primary font-bold"><?= get_text('academics', 'stage5_f2_title', 'Practical Mastery') ?></h4>
                  <p class="text-[10.5px] text-on-surface-variant mt-0.5"><?= get_text('academics', 'stage5_f2_desc', 'Full syllabus practicals in physics, chemistry, biology, and IP/CS labs.') ?></p>
                </div>
              </div>
            </div>
            <div class="mt-1 pt-2.5 border-t border-border-warm flex justify-between items-center text-xs">
              <span class="text-[10px] sm:text-[11px] text-on-surface-variant uppercase font-bold"><?= get_text('academics', 'stage5_focus', 'Focus: Higher Education &amp; Careers') ?></span>
              <a class="text-primary hover:text-[#C9A24B] flex items-center gap-1 transition-colors font-bold text-xs" href="admission.php">Enroll Now <span class="material-symbols-outlined text-[15px]">arrow_forward</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Subject / Stream Cards for Class 11-12 (Dark Blue Theme & Compact Height) -->
  <section class="py-10 sm:py-14 px-4 sm:px-6 lg:px-12 w-full bg-primary text-white relative overflow-hidden border-y border-[#C9A24B]/30" id="streams">
    <!-- Subtle Background Pattern / Ambient Glow -->
    <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#C9A24B_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-white/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
        <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold text-xs"><?= get_text('academics', 'streams_eyebrow', 'Class 11 &amp; 12 Streams') ?></span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight leading-snug mt-1"><?= get_text('academics', 'streams_heading', 'Senior Secondary Academic Streams') ?></h2>
        <p class="text-xs sm:text-sm text-surface-cream/80 mt-1.5"><?= get_text('academics', 'streams_desc', 'Tailored academic pathways equipping students for HBSE board excellence and leading university admissions.') ?></p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6">
        <!-- Science Stream -->
        <div class="bg-surface-pure rounded-2xl p-5 sm:p-6 border border-border-warm shadow-md hover:shadow-xl transition-all flex flex-col justify-between relative overflow-hidden text-slate-800">
          <div class="absolute top-0 right-0 w-24 h-24 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
          <div>
            <div class="flex items-center gap-2 mb-3">
              <span class="material-symbols-outlined text-[#C9A24B] text-xl">science</span>
              <span class="text-[10px] text-[#C9A24B] uppercase font-bold tracking-wider">Stream 01</span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-primary mb-2"><?= get_text('academics', 'stream1_name', 'Science (Medical &amp; Non-Medical)') ?></h3>
            <p class="text-xs text-on-surface-variant mb-4 leading-relaxed"><?= get_text('academics', 'stream1_desc', 'Equipped with state-of-the-art physics, chemistry, biology, and computer science laboratories for in-depth conceptual and practical learning.') ?></p>
            <div class="space-y-2">
              <div class="text-xs text-on-surface font-bold">Core Subjects:</div>
              <ul class="space-y-1.5 text-xs text-on-surface-variant">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream1_sub1', 'Physics &amp; Chemistry') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream1_sub2', 'Mathematics / Biology') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream1_sub3', 'Computer Science / Physical Education') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream1_sub4', 'English Core') ?></li>
              </ul>
            </div>
          </div>
          <div class="mt-5 pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-[11px] text-primary uppercase font-bold"><?= get_text('academics', 'stream1_tag', 'Medical &amp; Engineering Focus') ?></span>
            <a class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors text-xs" href="admission.php"><span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Commerce Stream -->
        <div class="bg-surface-pure rounded-2xl p-5 sm:p-6 border border-border-warm shadow-md hover:shadow-xl transition-all flex flex-col justify-between relative overflow-hidden text-slate-800">
          <div class="absolute top-0 right-0 w-24 h-24 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
          <div>
            <div class="flex items-center gap-2 mb-3">
              <span class="material-symbols-outlined text-[#C9A24B] text-xl">trending_up</span>
              <span class="text-[10px] text-[#C9A24B] uppercase font-bold tracking-wider">Stream 02</span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-primary mb-2"><?= get_text('academics', 'stream2_name', 'Commerce') ?></h3>
            <p class="text-xs text-on-surface-variant mb-4 leading-relaxed"><?= get_text('academics', 'stream2_desc', 'Comprehensive economic, accounting, and business studies designed for careers in banking, finance, CA, and entrepreneurship.') ?></p>
            <div class="space-y-2">
              <div class="text-xs text-on-surface font-bold">Core Subjects:</div>
              <ul class="space-y-1.5 text-xs text-on-surface-variant">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream2_sub1', 'Accountancy') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream2_sub2', 'Business Studies') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream2_sub3', 'Economics &amp; Mathematics / IP') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream2_sub4', 'English Core') ?></li>
              </ul>
            </div>
          </div>
          <div class="mt-5 pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-[11px] text-primary uppercase font-bold"><?= get_text('academics', 'stream2_tag', 'Commerce &amp; Finance Track') ?></span>
            <a class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors text-xs" href="admission.php"><span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>

        <!-- Arts / Humanities Stream -->
        <div class="bg-surface-pure rounded-2xl p-5 sm:p-6 border border-border-warm shadow-md hover:shadow-xl transition-all flex flex-col justify-between relative overflow-hidden text-slate-800">
          <div class="absolute top-0 right-0 w-24 h-24 bg-[#C9A24B]/10 rounded-bl-full pointer-events-none"></div>
          <div>
            <div class="flex items-center gap-2 mb-3">
              <span class="material-symbols-outlined text-[#C9A24B] text-xl">menu_book</span>
              <span class="text-[10px] text-[#C9A24B] uppercase font-bold tracking-wider">Stream 03</span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-primary mb-2"><?= get_text('academics', 'stream3_name', 'Arts &amp; Humanities') ?></h3>
            <p class="text-xs text-on-surface-variant mb-4 leading-relaxed"><?= get_text('academics', 'stream3_desc', 'Deep exploration of history, political science, geography, literature, and social sciences for future administrative and legal leaders.') ?></p>
            <div class="space-y-2">
              <div class="text-xs text-on-surface font-bold">Core Subjects:</div>
              <ul class="space-y-1.5 text-xs text-on-surface-variant">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream3_sub1', 'History &amp; Political Science') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream3_sub2', 'Geography / Economics') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream3_sub3', 'Hindi / Physical Education') ?></li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span> <?= get_text('academics', 'stream3_sub4', 'English Core') ?></li>
              </ul>
            </div>
          </div>
          <div class="mt-5 pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-[11px] text-primary uppercase font-bold"><?= get_text('academics', 'stream3_tag', 'Civil Services &amp; Law Track') ?></span>
            <a class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center hover:bg-secondary hover:text-primary transition-colors text-xs" href="admission.php"><span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Teaching Methodology (Compact Height & Padding) -->
  <section class="relative w-full py-10 sm:py-14 px-4 sm:px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" style="background-color: #eaf0f8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.08) 0%, transparent 40%), radial-gradient(circle at 85% 75%, rgba(11, 38, 71, 0.06) 0%, transparent 45%);">
    <!-- Subtle Architectural / Academic Geometric Patterns -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#001129 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(0, 17, 41, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 17, 41, 0.05) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Ambient Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#C9A24B]/15 blur-3xl pointer-events-none"></div>
    <div class="absolute left-5 bottom-0 w-80 h-80 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
        <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold text-xs"><?= get_text('academics', 'pedagogy_eyebrow', 'Pedagogical Approach') ?></span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('academics', 'pedagogy_heading', 'How We Teach at Sun Rise') ?></h2>
        <p class="text-xs sm:text-sm text-on-surface-variant mt-1.5"><?= get_text('academics', 'pedagogy_desc', 'Combining traditional teacher mentorship with modern smart-class technology and experimental learning.') ?></p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="bg-surface-pure p-5 sm:p-6 rounded-2xl shadow-xs hover:shadow-md border border-border-warm flex flex-col justify-between hover:-translate-y-0.5 transition-all">
          <div>
            <div class="w-11 h-11 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-4 text-lg font-bold">01</div>
            <h3 class="text-sm sm:text-base font-bold text-primary mb-1.5"><?= get_text('academics', 'step1_title', 'Concept Clarity') ?></h3>
            <p class="text-xs text-on-surface-variant leading-relaxed"><?= get_text('academics', 'step1_desc', 'Focus on thorough understanding of NCERT fundamentals before moving to advanced problem solving.') ?></p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-[10px] text-[#C9A24B] uppercase tracking-wider font-bold"><?= get_text('academics', 'step1_tag', 'Core Understanding') ?></div>
        </div>
        <div class="bg-surface-pure p-5 sm:p-6 rounded-2xl shadow-xs hover:shadow-md border border-border-warm flex flex-col justify-between hover:-translate-y-0.5 transition-all">
          <div>
            <div class="w-11 h-11 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-4 text-lg font-bold">02</div>
            <h3 class="text-sm sm:text-base font-bold text-primary mb-1.5"><?= get_text('academics', 'step2_title', 'Practical Labs') ?></h3>
            <p class="text-xs text-on-surface-variant leading-relaxed"><?= get_text('academics', 'step2_desc', 'Hands-on experiments in physics, chemistry, biology, and computer science reinforce classroom theory.') ?></p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-[10px] text-[#C9A24B] uppercase tracking-wider font-bold"><?= get_text('academics', 'step2_tag', 'Experiential Learning') ?></div>
        </div>
        <div class="bg-surface-pure p-5 sm:p-6 rounded-2xl shadow-xs hover:shadow-md border border-border-warm flex flex-col justify-between hover:-translate-y-0.5 transition-all">
          <div>
            <div class="w-11 h-11 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-4 text-lg font-bold">03</div>
            <h3 class="text-sm sm:text-base font-bold text-primary mb-1.5"><?= get_text('academics', 'step3_title', 'Regular Testing') ?></h3>
            <p class="text-xs text-on-surface-variant leading-relaxed"><?= get_text('academics', 'step3_desc', 'Periodic unit tests, term exams, and mock board tests ensure continuous assessment and revision.') ?></p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-[10px] text-[#C9A24B] uppercase tracking-wider font-bold"><?= get_text('academics', 'step3_tag', 'Exam Readiness') ?></div>
        </div>
        <div class="bg-surface-pure p-5 sm:p-6 rounded-2xl shadow-xs hover:shadow-md border border-border-warm flex flex-col justify-between hover:-translate-y-0.5 transition-all">
          <div>
            <div class="w-11 h-11 rounded-xl bg-primary text-[#C9A24B] flex items-center justify-center mb-4 text-lg font-bold">04</div>
            <h3 class="text-sm sm:text-base font-bold text-primary mb-1.5"><?= get_text('academics', 'step4_title', 'Individual Care') ?></h3>
            <p class="text-xs text-on-surface-variant leading-relaxed"><?= get_text('academics', 'step4_desc', 'Remedial classes for students needing extra help and personalized attention for every scholar.') ?></p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-[10px] text-[#C9A24B] uppercase tracking-wider font-bold"><?= get_text('academics', 'step4_tag', 'Personal Mentorship') ?></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Examination System & Evaluation Framework (Dark Blue Theme, Full-Width & Compact Padding) -->
  <section class="py-10 sm:py-12 px-4 sm:px-6 lg:px-12 w-full bg-primary text-white relative overflow-hidden border-y border-[#C9A24B]/30" id="examination-system">
    <!-- Subtle Background Pattern / Ambient Glow -->
    <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#C9A24B_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-white/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
        <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold text-xs"><?= get_text('academics', 'exam_eyebrow', 'Continuous &amp; Comprehensive Assessment') ?></span>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight leading-snug mt-1"><?= get_text('academics', 'exam_heading', 'Examination &amp; Evaluation System') ?></h2>
        <p class="text-xs sm:text-sm text-surface-cream/80 mt-1.5"><?= get_text('academics', 'exam_desc', 'At Sun Rise Sr. Sec. School, our evaluation framework ensures continuous learning, diagnostic feedback, and thorough board examination readiness.') ?></p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Mid-term & Annual -->
        <div class="bg-surface-pure text-slate-800 p-4 sm:p-5 rounded-xl border border-border-warm hover:border-[#C9A24B] shadow-md hover:shadow-xl transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-2">
            <div class="w-10 h-10 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center shrink-0 shadow-xs">
              <span class="material-symbols-outlined text-[20px]">assignment</span>
            </div>
            <h3 class="text-xs sm:text-sm font-bold text-primary"><?= get_text('academics', 'exam1_title', 'Mid-Term &amp; Annual Exams') ?></h3>
            <p class="text-[11px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'exam1_desc', 'Comprehensive term-end examinations patterned on HBSE board standards, evaluating overall mastery and practical performance.') ?></p>
          </div>
          <div class="pt-2.5 mt-3 border-t border-border-warm text-[10px] text-[#C9A24B] font-bold uppercase"><?= get_text('academics', 'exam1_tag', 'Major Milestones') ?></div>
        </div>

        <!-- Monthly Unit Tests -->
        <div class="bg-surface-pure text-slate-800 p-4 sm:p-5 rounded-xl border border-border-warm hover:border-[#C9A24B] shadow-md hover:shadow-xl transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-2">
            <div class="w-10 h-10 rounded-lg bg-[#C9A24B] text-primary flex items-center justify-center shrink-0 shadow-xs">
              <span class="material-symbols-outlined text-[20px]">calendar_month</span>
            </div>
            <h3 class="text-xs sm:text-sm font-bold text-primary"><?= get_text('academics', 'exam2_title', 'Monthly Unit Tests') ?></h3>
            <p class="text-[11px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'exam2_desc', 'Scheduled at the close of every month across all subjects to track topic-wise retention and ensure continuous revision.') ?></p>
          </div>
          <div class="pt-2.5 mt-3 border-t border-border-warm text-[10px] text-primary font-bold uppercase"><?= get_text('academics', 'exam2_tag', 'Monthly Assessment') ?></div>
        </div>

        <!-- Regular Class Tests -->
        <div class="bg-surface-pure text-slate-800 p-4 sm:p-5 rounded-xl border border-border-warm hover:border-[#C9A24B] shadow-md hover:shadow-xl transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-2">
            <div class="w-10 h-10 rounded-lg bg-primary text-[#C9A24B] flex items-center justify-center shrink-0 shadow-xs">
              <span class="material-symbols-outlined text-[20px]">quiz</span>
            </div>
            <h3 class="text-xs sm:text-sm font-bold text-primary"><?= get_text('academics', 'exam3_title', 'Regular Class Tests') ?></h3>
            <p class="text-[11px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'exam3_desc', 'Frequent chapter-end evaluations conducted by subject educators to identify learning gaps and reinforce key concepts.') ?></p>
          </div>
          <div class="pt-2.5 mt-3 border-t border-border-warm text-[10px] text-[#C9A24B] font-bold uppercase"><?= get_text('academics', 'exam3_tag', 'Topic-by-Topic') ?></div>
        </div>

        <!-- Surprise Tests -->
        <div class="bg-surface-pure text-slate-800 p-4 sm:p-5 rounded-xl border border-border-warm hover:border-[#C9A24B] shadow-md hover:shadow-xl transition-all flex flex-col justify-between">
          <div class="flex flex-col gap-2">
            <div class="w-10 h-10 rounded-lg bg-[#C9A24B] text-primary flex items-center justify-center shrink-0 shadow-xs">
              <span class="material-symbols-outlined text-[20px]">bolt</span>
            </div>
            <h3 class="text-xs sm:text-sm font-bold text-primary"><?= get_text('academics', 'exam4_title', 'Surprise Tests') ?></h3>
            <p class="text-[11px] text-on-surface-variant leading-relaxed"><?= get_text('academics', 'exam4_desc', 'Unannounced quick assessments encouraging students to maintain daily revision habits and stay prepared throughout the year.') ?></p>
          </div>
          <div class="pt-2.5 mt-3 border-t border-border-warm text-[10px] text-primary font-bold uppercase"><?= get_text('academics', 'exam4_tag', 'Continuous Readiness') ?></div>
        </div>
      </div>

      <!-- Medium of Instruction & Timings Strip -->
      <div class="mt-6 p-4 sm:p-5 rounded-xl bg-white/10 backdrop-blur-md border border-white/15 shadow-md flex flex-col md:flex-row items-center justify-between gap-4 sm:gap-6">
        <div class="flex items-center gap-3 sm:gap-4">
          <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center flex-shrink-0 shadow-xs font-bold">
            <span class="material-symbols-outlined text-[22px]">translate</span>
          </div>
          <div>
            <span class="text-[10px] uppercase font-bold text-[#C9A24B] tracking-wider">Medium of Instruction</span>
            <h4 class="text-white font-bold text-xs sm:text-sm"><?= get_text('academics', 'medium_title', 'English Medium (Nursery to Class XII)') ?></h4>
            <p class="text-[11px] text-slate-300"><?= get_text('academics', 'medium_desc', 'With strong Hindi and regional language foundations') ?></p>
          </div>
        </div>
        <div class="h-8 w-px bg-white/20 hidden md:block"></div>
        <div class="flex items-center gap-3 sm:gap-4">
          <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white text-primary flex items-center justify-center flex-shrink-0 shadow-xs font-bold">
            <span class="material-symbols-outlined text-[22px]">schedule</span>
          </div>
          <div>
            <span class="text-[10px] uppercase font-bold text-[#C9A24B] tracking-wider">Official School Timings</span>
            <div class="text-xs sm:text-xs font-bold text-white flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
              <span><strong>Summer:</strong> <?= get_text('academics', 'timing_summer', '7:30 AM – 1:30 PM') ?></span>
              <span class="hidden sm:inline text-[#C9A24B]">&bull;</span>
              <span><strong>Winter:</strong> <?= get_text('academics', 'timing_winter', '8:30 AM – 2:30 PM') ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Academic Toppers & Board Results Spotlight (Compact Padding & Clean Aligned Width) -->
  <section class="py-8 sm:py-10 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full" id="toppers">
    <div class="text-center max-w-3xl mx-auto mb-5 sm:mb-7">
      <span class="font-eyebrow text-eyebrow text-[#C9A24B] uppercase tracking-widest font-bold text-xs"><?= get_text('academics', 'toppers_eyebrow', 'Academic Distinction') ?></span>
      <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('academics', 'toppers_heading', 'Board Examination Results &amp; Toppers') ?></h2>
      <p class="text-xs sm:text-sm text-on-surface-variant mt-1"><?= get_text('academics', 'toppers_desc', 'Sun Rise Sr. Sec. School proudly celebrates a consistent 100% HBSE board examination pass rate, producing district and block rank holders.') ?></p>
    </div>

    <div class="bg-primary text-white rounded-2xl p-5 sm:p-7 lg:p-8 shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-6 lg:gap-8 border border-[#C9A24B]/30 w-full">
      <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-[#C9A24B]/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="flex flex-col gap-3 sm:gap-3.5 max-w-2xl relative z-10">
        <div class="inline-flex items-center gap-2 bg-[#C9A24B] text-primary px-3 py-1 rounded-full text-[11px] font-bold uppercase self-start shadow-xs">
          <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">military_tech</span>
          <?= get_text('academics', 'toppers_card_badge', 'HBSE Board Star Achievers') ?>
        </div>
        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white leading-tight"><?= get_text('academics', 'toppers_card_title', 'Celebrating Academic Excellence &amp; Merit Ranks') ?></h3>
        <p class="text-surface-cream/90 text-xs sm:text-sm leading-relaxed">
          <?= get_text('academics', 'toppers_card_desc', 'Through systematic syllabus completion, doubt resolution clinics, and regular testing, our Class X and XII students achieve top percentiles in Haryana Board examinations year after year.') ?>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-1">
          <div class="p-2.5 sm:p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10">
            <span class="block text-lg sm:text-xl font-bold text-[#C9A24B]"><?= get_text('academics', 'toppers_stat1_num', '100%') ?></span>
            <span class="text-[11px] text-slate-300"><?= get_text('academics', 'toppers_stat1_lbl', 'Board Pass Record') ?></span>
          </div>
          <div class="p-2.5 sm:p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10">
            <span class="block text-lg sm:text-xl font-bold text-[#C9A24B]"><?= get_text('academics', 'toppers_stat2_num', 'Nursery – XII') ?></span>
            <span class="text-[11px] text-slate-300"><?= get_text('academics', 'toppers_stat2_lbl', 'Comprehensive Spectrum') ?></span>
          </div>
          <div class="p-2.5 sm:p-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/10 col-span-2 sm:col-span-1">
            <span class="block text-lg sm:text-xl font-bold text-[#C9A24B]"><?= get_text('academics', 'toppers_stat3_num', '3 Streams') ?></span>
            <span class="text-[11px] text-slate-300"><?= get_text('academics', 'toppers_stat3_lbl', 'Science, Commerce, Arts') ?></span>
          </div>
        </div>
      </div>
      <div class="relative z-10 flex flex-col items-center flex-shrink-0">
        <div class="w-56 sm:w-64 lg:w-72 rounded-xl overflow-hidden shadow-2xl border-2 border-[#C9A24B]/50 cursor-pointer" onclick="openLightbox(this)">
          <img src="<?= get_image('academics', 'toppers_poster', school_img('pop-up image.webp')) ?>" alt="<?= htmlspecialchars(get_image_alt('academics', 'toppers_poster', 'Sun Rise Board Toppers Poster')) ?>" class="w-full h-auto object-cover" loading="lazy"/>
        </div>
        <span class="text-xs text-surface-cream/80 mt-2 flex items-center gap-1 font-medium cursor-pointer" onclick="openLightbox(this.previousElementSibling)"><span class="material-symbols-outlined text-[14px] text-[#C9A24B]">zoom_in</span> <?= get_text('academics', 'toppers_poster_hint', 'Click to view toppers poster') ?></span>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
