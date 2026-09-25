<?php
$current_page = 'admissions';
$page_title = 'Admissions 2026-27 | Online Registration & Application Form';
$page_description = 'Apply for admissions 2026-27 at Sun Rise Sr. Sec. School, Dobhi. Learn about our admission process, age eligibility criteria, stream selection, and online registration.';
$page_keywords = 'admissions 2026-27, school application, admission process, HBSE school admission Dobhi Hisar, eligibility criteria, enroll online';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-[#f8fafc] text-on-surface">

  <!-- Top Breadcrumb & Hero Header -->
  <section class="relative py-8 sm:py-12 px-4 sm:px-6 lg:px-12 overflow-hidden border-b border-[#000e21]/10" style="background-color: #f1f5f9; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.08) 0%, transparent 40%), radial-gradient(circle at 85% 75%, rgba(11, 38, 71, 0.06) 0%, transparent 45%);">
    <!-- Subtle Architectural / Geometric Dot Overlay -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.35]" style="background-image: radial-gradient(#001129 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    
    <!-- Ambient Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 bottom-0 w-80 h-80 rounded-full bg-primary/8 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 flex flex-col gap-5">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-on-surface-variant">
        <a class="hover:text-primary transition-colors flex items-center gap-1" href="index.php">
          <span class="material-symbols-outlined text-[15px]">home</span> Home
        </a>
        <span class="text-outline-variant">/</span>
        <a class="hover:text-primary transition-colors" href="admission.php">Admissions</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Online Registration</span>
      </nav>

      <!-- Header Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
        <div class="lg:col-span-8 flex flex-col gap-2.5 sm:gap-3.5">
          <div class="hero-badge inline-flex items-center gap-1.5 self-start px-3 py-1 rounded-full bg-[#C9A24B]/15 text-[#8A6A1C] border border-[#C9A24B]/30 font-bold uppercase tracking-wider text-[11px] shadow-xs">
            <span class="w-2 h-2 rounded-full bg-[#C9A24B] animate-ping"></span>
            <?= get_text('admissions', 'session_badge', 'Academic Session 2026–27 Registrations Open') ?>
          </div>
          <h1 class="hero-heading font-headline-lg font-bold text-primary text-2xl sm:text-3xl lg:text-4xl tracking-tight leading-tight">
            <?= get_text('admissions', 'hero_title', 'Admissions Open: Sun Rise Sr. Sec. School, Dobhi') ?>
          </h1>
          <p class="hero-subtitle text-on-surface-variant w-full max-w-3xl text-xs sm:text-sm leading-relaxed">
            <?= get_text('admissions', 'hero_desc', 'Cultivating scholarship, strong character, and competitive excellence in Hisar district. Select your grade stream, fill student credentials, choose village bus transit, and submit your admission application online.') ?>
          </p>

          <!-- Key Highlights Badges -->
          <div class="flex flex-wrap items-center gap-2.5 pt-1">
            <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg border border-border-warm shadow-xs text-xs text-primary font-semibold">
              <span class="material-symbols-outlined text-[#C9A24B] text-base">verified</span>
              <span><?= get_text('admissions', 'badge_HBSE', 'HBSE Affiliation #530XXX (Dobhi, Hisar)') ?></span>
            </div>
            <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg border border-border-warm shadow-xs text-xs text-primary font-semibold">
              <span class="material-symbols-outlined text-[#C9A24B] text-base">bolt</span>
              <span><?= get_text('admissions', 'badge_digital', '100% Digital Fast-Track Registration') ?></span>
            </div>
            <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg border border-border-warm shadow-xs text-xs text-primary font-semibold">
              <span class="material-symbols-outlined text-[#C9A24B] text-base">assignment_turned_in</span>
              <span><?= get_text('admissions', 'badge_token', 'Instant Application Acknowledgement') ?></span>
            </div>
            <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg border border-border-warm shadow-xs text-xs text-primary font-semibold">
              <span class="material-symbols-outlined text-[#C9A24B] text-base">security</span>
              <span><?= get_text('admissions', 'badge_escrow', 'RBI & PCI-DSS 256-Bit Escrow') ?></span>
            </div>
          </div>
        </div>

        <!-- School Crest Credential Card -->
        <div class="lg:col-span-4 flex justify-start lg:justify-end">
          <div class="w-full max-w-xs bg-white rounded-xl p-5 shadow-md border border-border-warm flex flex-col items-center text-center gap-2.5">
            <div class="w-20 h-20 p-1.5 rounded-full bg-surface-cream flex items-center justify-center shadow-xs">
              <img alt="Sun Rise Sr. Sec. School Dobhi Official Crest" class="w-16 h-16 object-contain drop-shadow-sm" src="<?= $site_logo ?>" width="64" height="64" loading="eager" decoding="async">
            </div>
            <div class="flex flex-col items-center">
              <span class="font-eyebrow text-[10px] text-secondary font-bold uppercase tracking-widest"><?= get_text('admissions', 'school_affiliation_tag', 'Affiliated to HBSE, Haryana') ?></span>
              <span class="font-bold text-primary text-base">Sun Rise Sr. Sec. School</span>
              <span class="text-xs text-on-surface-variant"><?= get_text('admissions', 'school_location_tag', 'Dobhi, Dist. Hisar, Haryana – 125001') ?></span>
            </div>
            <div class="w-full bg-surface-container-low rounded-lg p-2 flex items-center justify-between text-xs">
              <span class="text-on-surface-variant font-medium">Admission Status:</span>
              <span class="font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded text-[10px] uppercase"><?= get_text('admissions', 'admission_status_pill', 'Active Now') ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Multi-Step Progress Tracker Bar -->
      <div class="mt-4 bg-white rounded-xl p-3.5 sm:p-5 shadow-xs border border-border-warm">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
          <!-- Step 1 -->
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs shadow-xs shrink-0">
              1
            </div>
            <div class="flex flex-col min-w-0">
              <span class="text-[10px] text-secondary font-bold uppercase">Step 01</span>
              <span class="text-xs font-bold text-primary truncate"><?= get_text('admissions', 'step1_title', 'Class & Stream Choice') ?></span>
            </div>
          </div>
          <!-- Step 2 -->
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#C9A24B] text-primary font-bold flex items-center justify-center text-xs shadow-xs shrink-0">
              2
            </div>
            <div class="flex flex-col min-w-0">
              <span class="text-[10px] text-secondary font-bold uppercase">Step 02</span>
              <span class="text-xs font-bold text-primary truncate"><?= get_text('admissions', 'step2_title', 'Student Profile Info') ?></span>
            </div>
          </div>
          <!-- Step 3 -->
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-surface-container-high text-on-surface font-bold flex items-center justify-center text-xs shrink-0">
              3
            </div>
            <div class="flex flex-col min-w-0">
              <span class="text-[10px] text-on-surface-variant uppercase">Step 03</span>
              <span class="text-xs font-semibold text-on-surface truncate"><?= get_text('admissions', 'step3_title', 'Transit & Documents') ?></span>
            </div>
          </div>
          <!-- Step 4 -->
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-surface-container-high text-on-surface font-bold flex items-center justify-center text-xs shrink-0">
              4
            </div>
            <div class="flex flex-col min-w-0">
              <span class="text-[10px] text-on-surface-variant uppercase">Step 04</span>
              <span class="text-xs font-semibold text-on-surface truncate"><?= get_text('admissions', 'step4_title', 'Review & Submission') ?></span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Interactive Class / Stream Matrix Selector (Light Pastel Cards on White/Grey Background) -->
  <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 sm:mb-8">
      <div>
        <span class="text-eyebrow text-[#C9A24B] uppercase font-bold tracking-widest text-xs"><?= get_text('admissions', 'grade_selector_eyebrow', 'Select Admission Grade') ?></span>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-primary tracking-tight leading-snug mt-0.5"><?= get_text('admissions', 'grade_selector_heading', 'Available Classes & Grade Options') ?></h2>
        <p class="text-on-surface-variant text-xs sm:text-sm mt-0.5"><?= get_text('admissions', 'grade_selector_desc', 'Choose the prospective grade level to start your online registration application.') ?></p>
      </div>

      <!-- Segment Filters -->
      <div class="flex flex-wrap gap-1.5 p-1 bg-surface-container-low rounded-xl border border-border-warm" id="grade-filter-container">
        <button class="grade-filter-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-primary text-white shadow-xs transition-all" data-category="all">All Grades</button>
        <button class="grade-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="senior">Senior Sec (XI - XII)</button>
        <button class="grade-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="secondary">Secondary (IX - X)</button>
        <button class="grade-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="middle">Middle & Primary (I - VIII)</button>
        <button class="grade-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="preprimary">Pre-Primary (KG)</button>
      </div>
    </div>

    <!-- 8 Distinct Light Pastel Colored Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5" id="class-cards-grid">
      
      <!-- Card 1: Class 11 Non-Med (Light Azure / Sky Blue Theme) -->
      <div class="grade-card group relative bg-[#EFF6FF] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#BFDBFE] hover:border-[#3B82F6] ring-2 ring-[#2563EB]" data-grade-id="xi-nonmed" data-grade-name="Class 11 - Science (Non-Medical)" data-group="senior" data-seats="<?= htmlspecialchars(get_text('admissions', 'c1_seats', '12 Seats Open')) ?>">
        <div class="absolute -top-2.5 right-3 bg-[#2563EB] text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
          Active Selection
        </div>
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#DBEAFE] text-[#1E40AF] rounded font-bold text-[10px] uppercase border border-[#93C5FD]">HBSE Stream</span>
            <span class="text-[11px] font-bold text-[#15803D] bg-[#DCFCE7] px-2 py-0.5 rounded flex items-center gap-1 border border-[#86EFAC]">
              <span class="w-1.5 h-1.5 rounded-full bg-[#16A34A] animate-pulse"></span> <?= get_text('admissions', 'c1_seats', '12 Seats Open') ?>
            </span>
          </div>
          <div>
            <h3 class="font-bold text-[#1E3A8A] text-base group-hover:text-[#2563EB] transition-colors"><?= get_text('admissions', 'c1_name', 'Class XI – Science (Non-Med)') ?></h3>
            <p class="text-xs text-[#1E40AF]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c1_desc', 'Physics, Chemistry, Math + Comp. Science / Physical Edu with NDA & JEE Foundation Track.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#1E3A8A] bg-white/80 p-2.5 rounded-lg border border-[#BFDBFE]">
            <div class="flex justify-between">
              <span class="text-[#1E40AF]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#1E3A8A]"><?= get_text('admissions', 'c1_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#1E40AF]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#2563EB]">HBSE Senior Secondary</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#BFDBFE] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-bold text-[#1E3A8A]">
            <input checked="" class="w-3.5 h-3.5 text-primary accent-[#2563EB]" name="selected_grade" type="radio" value="xi-nonmed">
            <span>Selected</span>
          </label>
          <span class="material-symbols-outlined text-[#2563EB] text-[18px]">check_circle</span>
        </div>
      </div>

      <!-- Card 2: Class 11 Medical (Light Mint / Emerald Theme) -->
      <div class="grade-card group relative bg-[#F0FDF4] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#BBF7D0] hover:border-[#22C55E]" data-grade-id="xi-med" data-grade-name="Class 11 - Science (Medical)" data-group="senior" data-seats="<?= htmlspecialchars(get_text('admissions', 'c2_seats', '8 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#DCFCE7] text-[#166534] rounded font-bold text-[10px] uppercase border border-[#86EFAC]">HBSE Stream</span>
            <span class="text-[11px] font-bold text-[#B45309] bg-[#FEF3C7] px-2 py-0.5 rounded flex items-center gap-1 border border-[#FDE68A]">
              <span class="w-1.5 h-1.5 rounded-full bg-[#D97706]"></span> <?= get_text('admissions', 'c2_seats', '8 Seats Open') ?>
            </span>
          </div>
          <div>
            <h3 class="font-bold text-[#14532D] text-base group-hover:text-[#16A34A] transition-colors"><?= get_text('admissions', 'c2_name', 'Class XI – Science (Medical)') ?></h3>
            <p class="text-xs text-[#166534]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c2_desc', 'Physics, Chemistry, Biology + Biotech/IP with dedicated NEET coaching orientation lab.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#14532D] bg-white/80 p-2.5 rounded-lg border border-[#BBF7D0]">
            <div class="flex justify-between">
              <span class="text-[#166534]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#14532D]"><?= get_text('admissions', 'c2_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#166534]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#16A34A]">HBSE Senior Secondary</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#BBF7D0] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#166534] group-hover:text-[#14532D]">
            <input class="w-3.5 h-3.5 text-primary accent-[#16A34A]" name="selected_grade" type="radio" value="xi-med">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#16A34A] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 3: Class 11 Commerce & Arts (Light Lavender / Purple Theme) -->
      <div class="grade-card group relative bg-[#FAF5FF] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#E9D5FF] hover:border-[#A855F7]" data-grade-id="xi-comm" data-grade-name="Class 11 - Commerce & Humanities" data-group="senior" data-seats="<?= htmlspecialchars(get_text('admissions', 'c3_seats', '22 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#F3E8FF] text-[#6B21A8] rounded font-bold text-[10px] uppercase border border-[#D8B4FE]">HBSE Stream</span>
            <span class="text-[11px] font-bold text-[#15803D] bg-[#DCFCE7] px-2 py-0.5 rounded flex items-center gap-1 border border-[#86EFAC]">
              <?= get_text('admissions', 'c3_seats', '22 Seats Open') ?>
            </span>
          </div>
          <div>
            <h3 class="font-bold text-[#581C87] text-base group-hover:text-[#9333EA] transition-colors"><?= get_text('admissions', 'c3_name', 'Class XI – Commerce & Arts') ?></h3>
            <p class="text-xs text-[#6B21A8]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c3_desc', 'Accountancy, Business Studies, Economics, Pol. Science, Geography & Applied Mathematics.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#581C87] bg-white/80 p-2.5 rounded-lg border border-[#E9D5FF]">
            <div class="flex justify-between">
              <span class="text-[#6B21A8]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#581C87]"><?= get_text('admissions', 'c3_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#6B21A8]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#9333EA]">HBSE Senior Secondary</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#E9D5FF] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#6B21A8] group-hover:text-[#581C87]">
            <input class="w-3.5 h-3.5 text-primary accent-[#9333EA]" name="selected_grade" type="radio" value="xi-comm">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#9333EA] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 4: Class 9 & 10 Secondary (Light Amber / Gold Theme) -->
      <div class="grade-card group relative bg-[#FFFBEB] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#FDE68A] hover:border-[#F59E0B]" data-grade-id="ix-x" data-grade-name="Class 9 & 10 (Secondary High)" data-group="secondary" data-seats="<?= htmlspecialchars(get_text('admissions', 'c4_seats', '16 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#FEF3C7] text-[#92400E] rounded font-bold text-[10px] uppercase border border-[#FCD34D]">HBSE Core</span>
            <span class="text-[11px] font-bold text-[#B45309] bg-[#FEF3C7] px-2 py-0.5 rounded flex items-center gap-1 border border-[#FDE68A]">
              <?= get_text('admissions', 'c4_seats', '16 Seats Open') ?>
            </span>
          </div>
          <div>
            <h3 class="font-bold text-[#78350F] text-base group-hover:text-[#D97706] transition-colors"><?= get_text('admissions', 'c4_name', 'Class IX & X (Secondary)') ?></h3>
            <p class="text-xs text-[#92400E]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c4_desc', 'Holistic HBSE syllabus with Science Labs, Vedic Math, Sports academy & Board mentoring.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#78350F] bg-white/80 p-2.5 rounded-lg border border-[#FDE68A]">
            <div class="flex justify-between">
              <span class="text-[#92400E]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#78350F]"><?= get_text('admissions', 'c4_age', '13 - 15 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#92400E]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#D97706]">HBSE High School</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#FDE68A] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#92400E] group-hover:text-[#78350F]">
            <input class="w-3.5 h-3.5 text-primary accent-[#D97706]" name="selected_grade" type="radio" value="ix-x">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#D97706] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 5: Class 6 to 8 (Light Teal / Cyan Theme) -->
      <div class="grade-card group relative bg-[#F0FDFA] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#99F6E4] hover:border-[#14B8A6]" data-grade-id="vi-viii" data-grade-name="Class 6 to 8 (Middle Wing)" data-group="middle" data-seats="<?= htmlspecialchars(get_text('admissions', 'c5_seats', '19 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#CCFBF1] text-[#115E59] rounded font-bold text-[10px] uppercase border border-[#5EEAD4]">Middle Wing</span>
            <span class="text-[11px] font-bold text-[#0F766E] bg-[#CCFBF1] px-2 py-0.5 rounded border border-[#5EEAD4]"><?= get_text('admissions', 'c5_seats', '19 Seats Open') ?></span>
          </div>
          <div>
            <h3 class="font-bold text-[#134E4A] text-base group-hover:text-[#0D9488] transition-colors"><?= get_text('admissions', 'c5_name', 'Class VI – VIII (Middle Wing)') ?></h3>
            <p class="text-xs text-[#115E59]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c5_desc', 'Foundational STEM concepts, computer literacy, Hindi & English debate, and sports.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#134E4A] bg-white/80 p-2.5 rounded-lg border border-[#99F6E4]">
            <div class="flex justify-between">
              <span class="text-[#115E59]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#134E4A]"><?= get_text('admissions', 'c5_age', '10 - 13 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#115E59]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#0D9488]">HBSE Middle School</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#99F6E4] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#115E59] group-hover:text-[#134E4A]">
            <input class="w-3.5 h-3.5 text-primary accent-[#0D9488]" name="selected_grade" type="radio" value="vi-viii">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#0D9488] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 6: Class 1 to 5 (Light Peach / Warm Orange Theme) -->
      <div class="grade-card group relative bg-[#FFF7ED] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#FED7AA] hover:border-[#F97316]" data-grade-id="i-v" data-grade-name="Class 1 to 5 (Primary School)" data-group="middle" data-seats="<?= htmlspecialchars(get_text('admissions', 'c6_seats', '25 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#FFEDD5] text-[#9A3412] rounded font-bold text-[10px] uppercase border border-[#FDBA74]">Primary</span>
            <span class="text-[11px] font-bold text-[#C2410C] bg-[#FFEDD5] px-2 py-0.5 rounded border border-[#FDBA74]"><?= get_text('admissions', 'c6_seats', '25 Seats Open') ?></span>
          </div>
          <div>
            <h3 class="font-bold text-[#7C2D12] text-base group-hover:text-[#EA580C] transition-colors"><?= get_text('admissions', 'c6_name', 'Class I – V (Primary School)') ?></h3>
            <p class="text-xs text-[#9A3412]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c6_desc', 'Activity-based learning, phonetics, environmental studies, performing arts, and yoga.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#7C2D12] bg-white/80 p-2.5 rounded-lg border border-[#FED7AA]">
            <div class="flex justify-between">
              <span class="text-[#9A3412]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#7C2D12]"><?= get_text('admissions', 'c6_age', '5 - 10 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#9A3412]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#EA580C]">HBSE Primary Wing</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#FED7AA] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#9A3412] group-hover:text-[#7C2D12]">
            <input class="w-3.5 h-3.5 text-primary accent-[#EA580C]" name="selected_grade" type="radio" value="i-v">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#EA580C] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 7: Pre-Primary (Light Rose / Soft Pink Theme) -->
      <div class="grade-card group relative bg-[#FFF1F2] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#FECDD3] hover:border-[#F43F5E]" data-grade-id="pre-kg" data-grade-name="Kindergarten (Nursery/LKG/UKG)" data-group="preprimary" data-seats="<?= htmlspecialchars(get_text('admissions', 'c7_seats', '30 Seats Open')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#FFE4E6] text-[#9F1239] rounded font-bold text-[10px] uppercase border border-[#FDA4AF]">Early Years</span>
            <span class="text-[11px] font-bold text-[#BE123C] bg-[#FFE4E6] px-2 py-0.5 rounded border border-[#FDA4AF]"><?= get_text('admissions', 'c7_seats', '30 Seats Open') ?></span>
          </div>
          <div>
            <h3 class="font-bold text-[#881337] text-base group-hover:text-[#E11D48] transition-colors"><?= get_text('admissions', 'c7_name', 'Pre-Primary (Nursery, KG)') ?></h3>
            <p class="text-xs text-[#9F1239]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c7_desc', 'Montessori-inspired play, sensory activities, creative storytelling & safe playzones.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#881337] bg-white/80 p-2.5 rounded-lg border border-[#FECDD3]">
            <div class="flex justify-between">
              <span class="text-[#9F1239]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#881337]"><?= get_text('admissions', 'c7_age', '3 - 5 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#9F1239]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#E11D48]">Early Childhood Care</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#FECDD3] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#9F1239] group-hover:text-[#881337]">
            <input class="w-3.5 h-3.5 text-primary accent-[#E11D48]" name="selected_grade" type="radio" value="pre-kg">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#E11D48] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 8: Class 12 Lateral Transfer (Light Indigo / Slate Theme) -->
      <div class="grade-card group relative bg-[#EEF2FF] text-on-surface rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer border border-[#C7D2FE] hover:border-[#6366F1]" data-grade-id="xii-transfer" data-grade-name="Class 12 - Board Transfer Entry" data-group="senior" data-seats="<?= htmlspecialchars(get_text('admissions', 'c8_seats', '5 Seats Only')) ?>">
        <div class="flex flex-col gap-2.5">
          <div class="flex justify-between items-start">
            <span class="px-2 py-0.5 bg-[#E0E7FF] text-[#3730A3] rounded font-bold text-[10px] uppercase border border-[#A5B4FC]">HBSE Transfer</span>
            <span class="text-[11px] font-bold text-[#B45309] bg-[#FEF3C7] px-2 py-0.5 rounded border border-[#FDE68A]"><?= get_text('admissions', 'c8_seats', '5 Seats Only') ?></span>
          </div>
          <div>
            <h3 class="font-bold text-[#312E81] text-base group-hover:text-[#4F46E5] transition-colors"><?= get_text('admissions', 'c8_name', 'Class XII – Transfer Entry') ?></h3>
            <p class="text-xs text-[#3730A3]/85 mt-1 leading-relaxed"><?= get_text('admissions', 'c8_desc', 'Direct admission subject to HBSE clearance & valid TC from previous recognized institution.') ?></p>
          </div>
          <div class="pt-2.5 flex flex-col gap-1 text-xs text-[#312E81] bg-white/80 p-2.5 rounded-lg border border-[#C7D2FE]">
            <div class="flex justify-between">
              <span class="text-[#3730A3]/75 font-medium">Age Criteria:</span>
              <span class="font-bold text-[#312E81]"><?= get_text('admissions', 'c8_age', '16 - 18 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-[#3730A3]/75 font-medium">Curriculum:</span>
              <span class="font-bold text-[#4F46E5]">HBSE Board Clearance</span>
            </div>
          </div>
        </div>
        <div class="mt-4 pt-2.5 border-t border-[#C7D2FE] flex items-center justify-between">
          <label class="flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-[#3730A3] group-hover:text-[#312E81]">
            <input class="w-3.5 h-3.5 text-primary accent-[#4F46E5]" name="selected_grade" type="radio" value="xii-transfer">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-[#4F46E5] text-[18px]">radio_button_unchecked</span>
        </div>
      </div>

    </div>
  </section>

  <!-- Comprehensive Two-Column Admission Application & Registration System -->
  <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
      
      <!-- LEFT COLUMN: All Form Subsections -->
      <div class="lg:col-span-7 flex flex-col gap-6 text-on-surface">
        
        <!-- Subsection 1: Student Information -->
        <div class="bg-white rounded-xl p-5 sm:p-6 shadow-xs border border-border-warm">
          <div class="flex items-center gap-3 pb-4 border-b border-border-warm">
            <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">
              <span class="material-symbols-outlined text-xl">person</span>
            </div>
            <div>
              <h3 class="font-bold text-primary text-base">Student Identity Credentials</h3>
              <p class="text-xs text-on-surface-variant">Provide legal identity matching Aadhaar and official school records</p>
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Full Name -->
            <div class="flex flex-col gap-1 md:col-span-2">
              <label class="text-xs text-primary font-bold">Student's Full Name (As per birth record) *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" id="input_student_name" placeholder="e.g. Aryan Sheoran" type="text" value="Aarav Sharma">
            </div>
            <!-- Date of Birth -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Date of Birth *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" type="date" value="2009-08-14">
            </div>
            <!-- Gender -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Gender *</label>
              <select class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm">
                <option selected="" value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <!-- Blood Group -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Blood Group</label>
              <select class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm">
                <option value="O+">O Positive (O+)</option>
                <option selected="" value="A+">A Positive (A+)</option>
                <option value="B+">B Positive (B+)</option>
                <option value="AB+">AB Positive (AB+)</option>
                <option value="O-">O Negative (O-)</option>
              </select>
            </div>
            <!-- Aadhaar Number -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Student Aadhaar Number *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="XXXX - XXXX - 4821" type="text" value="7823 4412 8901">
            </div>
            <!-- Prior School Details -->
            <div class="flex flex-col gap-1 md:col-span-2">
              <label class="text-xs text-primary font-bold">Previous School Name & Board *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. Model Public School / HBSE" type="text" value="Government Model Sr. Sec. School, Dobhi (HBSE)">
            </div>
            <!-- Last Grade Passed -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Last Class Passed / Status</label>
              <select class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm">
                <option value="10">Passed Class 10 (Awaiting Result)</option>
                <option selected="" value="10-passed">Passed Class 10 (Result Declared)</option>
                <option value="9">Passed Class 9</option>
                <option value="other">Other Equivalent Grade</option>
              </select>
            </div>
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Aggregate Percentage / Grade *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. 91.4% or A1 Grade" type="text" value="92.6%">
            </div>
          </div>
        </div>

        <!-- Subsection 2: Parent & Guardian Details -->
        <div class="bg-white rounded-xl p-5 sm:p-6 shadow-xs border border-border-warm">
          <div class="flex items-center gap-3 pb-4 border-b border-border-warm">
            <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">
              <span class="material-symbols-outlined text-xl">family_restroom</span>
            </div>
            <div>
              <h3 class="font-bold text-primary text-base">Parent & Guardian Information</h3>
              <p class="text-xs text-on-surface-variant">Primary correspondence and emergency contact points</p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Father's Name -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Father / Guardian's Full Name *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. Rajender Sharma" type="text" value="Rajender Sharma">
            </div>
            <!-- Father's Occupation -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Father's Occupation</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. Agriculture / Govt. Employee" type="text" value="Agriculture & Business">
            </div>
            <!-- Mother's Name -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Mother's Full Name *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. Sunita Devi" type="text" value="Sunita Devi">
            </div>
            <!-- Mother's Occupation -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Mother's Occupation</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="e.g. Homemaker / Teacher" type="text" value="Homemaker">
            </div>
            <!-- WhatsApp Mobile Contact -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Primary Contact / WhatsApp Number *</label>
              <div class="flex">
                <span class="h-11 px-3 bg-surface-container text-text-charcoal flex items-center justify-center font-bold text-xs rounded-l-lg border border-r-0 border-border-warm">+91</span>
                <input class="w-full h-11 px-3.5 rounded-r-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="98120 XXXXX" type="tel" value="98124 55432">
              </div>
            </div>
            <!-- Email Address -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Parent Email Address (Optional)</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="parent@example.com" type="email" value="rajender.sharma.dobhi@gmail.com">
            </div>
          </div>
        </div>

        <!-- Subsection 3: Local Address & Bus Transit Selection -->
        <div class="bg-white rounded-xl p-5 sm:p-6 shadow-xs border border-border-warm">
          <div class="flex items-center gap-3 pb-4 border-b border-border-warm">
            <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold shrink-0">
              <span class="material-symbols-outlined text-xl">directions_bus</span>
            </div>
            <div>
              <h3 class="font-bold text-primary text-base"><?= get_text('admissions', 'bus_facility_title', 'Residence & Daily School Bus Facility') ?></h3>
              <p class="text-xs text-on-surface-variant"><?= get_text('admissions', 'bus_facility_desc', 'Fleet covering 35+ villages in Hisar and neighboring rural belts') ?></p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Village / Local Address -->
            <div class="flex flex-col gap-1 md:col-span-2">
              <label class="text-xs text-primary font-bold">Permanent Village / Street Address *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" placeholder="House No., Street, Landmark" type="text" value="Ward No. 4, Near Shiv Mandir, Main Dobhi Chowk">
            </div>
            <!-- District & State -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">District / Tehsil *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm border border-border-warm" readonly="" type="text" value="Hisar, Haryana">
            </div>
            <!-- Pin Code -->
            <div class="flex flex-col gap-1">
              <label class="text-xs text-primary font-bold">Postal Pin Code *</label>
              <input class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm" type="text" value="125001">
            </div>
            <!-- Bus Route Option Selector -->
            <div class="flex flex-col gap-1 md:col-span-2 mt-1">
              <label class="text-xs text-primary font-bold">School Transit Facility *</label>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-1" id="transit-selector">
                <label class="transit-option-card flex items-center justify-between p-3.5 rounded-lg bg-surface-cream ring-2 ring-secondary cursor-pointer border border-border-warm">
                  <div class="flex items-center gap-2.5">
                    <input checked="" class="w-4 h-4 text-primary accent-[#C9A24B]" name="bus_option" type="radio" value="dobhi-bus">
                    <div>
                      <span class="text-xs text-primary font-bold block"><?= get_text('admissions', 'bus_route_label', 'School Bus Transit Facility') ?></span>
                      <span class="text-[11px] text-on-surface-variant"><?= get_text('admissions', 'bus_route_desc', 'Pick-up & Drop at designated village bus stop') ?></span>
                    </div>
                  </div>
                  <span class="material-symbols-outlined text-secondary text-xl shrink-0">airport_shuttle</span>
                </label>
                <label class="transit-option-card flex items-center justify-between p-3.5 rounded-lg bg-surface-container-low cursor-pointer hover:bg-surface-container border border-border-warm">
                  <div class="flex items-center gap-2.5">
                    <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="bus_option" type="radio" value="self-arranged">
                    <div>
                      <span class="text-xs text-primary font-bold block">Self Conveyance / Day Boarding</span>
                      <span class="text-[11px] text-on-surface-variant">Parent drops and picks pupil directly</span>
                    </div>
                  </div>
                  <span class="material-symbols-outlined text-outline-variant text-xl shrink-0">directions_walk</span>
                </label>
              </div>
            </div>
            <!-- Additional Villages Dropdown with all 14 Villages -->
            <div class="flex flex-col gap-1 md:col-span-2" id="village-bus-dropdown">
              <label class="text-xs text-primary font-bold">Select Your Village / Daily Bus Route Stop (14 Villages Connected) *</label>
              <select class="w-full h-11 px-3.5 rounded-lg bg-surface-container-low text-text-charcoal text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-secondary border border-border-warm font-medium">
                <option value="dobhi" selected>1. Dobhi (Main Campus / Bus Stop)</option>
                <option value="kharia">2. Kharia</option>
                <option value="telanwali">3. Telanwali</option>
                <option value="kabrel">4. Kabrel</option>
                <option value="lalpur">5. Lalpur</option>
                <option value="bandaheri">6. Bandaheri</option>
                <option value="balsmand">7. Balsmand</option>
                <option value="bhiwani-rohilla">8. Bhiwani Rohilla</option>
                <option value="siswala">9. Siswala</option>
                <option value="sundawas">10. Sundawas</option>
                <option value="rawalwas-khurd">11. Rawalwas Khurd</option>
                <option value="kirtan">12. Kirtan</option>
                <option value="salemgarh">13. Salemgarh</option>
                <option value="aryanagar">14. Aryanagar</option>
              </select>
            </div>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: Sticky Application Summary, Verification Checklist & Help Desk -->
      <div class="lg:col-span-5 flex flex-col gap-5 w-full">
        
        <!-- Summary Box -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-border-warm">
          
          <!-- Box Header -->
          <div class="bg-primary text-white p-5 sm:p-6 relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-secondary/15 rounded-full blur-2xl pointer-events-none"></div>
            <div class="flex items-center justify-between relative z-10">
              <div>
                <span class="text-[10px] text-secondary font-bold uppercase tracking-wider"><?= get_text('admissions', 'checkout_subheading', 'Session 2026–27 Enrollment') ?></span>
                <h3 class="text-lg font-bold text-white mt-0.5"><?= get_text('admissions', 'checkout_heading', 'Online Admission Summary') ?></h3>
              </div>
              <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-2xl">how_to_reg</span>
              </div>
            </div>

            <!-- Active Selected Grade Badge -->
            <div class="mt-3.5 p-3 bg-white/10 rounded-lg backdrop-blur-sm flex items-center justify-between border border-white/15">
              <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary text-lg">school</span>
                <div>
                  <span class="text-[10px] text-surface-cream/80 block font-medium">Selected Class:</span>
                  <span class="text-xs font-bold text-white" id="summary-grade-name">Class 11 - Science (Non-Medical)</span>
                </div>
              </div>
              <a class="text-[11px] text-secondary hover:text-white font-bold underline" href="#class-cards-grid">Change</a>
            </div>
          </div>

          <!-- Application Details Breakdown -->
          <div class="p-5 sm:p-6 flex flex-col gap-3.5">
            <div class="text-[11px] font-bold uppercase tracking-wider text-secondary pb-1 border-b border-border-warm">
              Application Overview
            </div>

            <div class="flex justify-between items-center text-xs pb-1 border-b border-border-warm/60">
              <span class="text-on-surface-variant font-medium">Academic Board:</span>
              <span class="font-bold text-primary">HBSE, Haryana (10+2)</span>
            </div>

            <div class="flex justify-between items-center text-xs pb-1 border-b border-border-warm/60">
              <span class="text-on-surface-variant font-medium">Session Intake:</span>
              <span class="font-bold text-primary">2026 – 2027</span>
            </div>

            <div class="flex justify-between items-center text-xs pb-1 border-b border-border-warm/60">
              <span class="text-on-surface-variant font-medium">School Location:</span>
              <span class="font-semibold text-primary text-right">Main Road Dobhi, Hisar</span>
            </div>

            <div class="flex justify-between items-center text-xs pb-1 border-b border-border-warm/60">
              <span class="text-on-surface-variant font-medium">Transit Selected:</span>
              <span class="font-semibold text-primary" id="summary-transit-choice">School Bus Facility</span>
            </div>

            <div class="p-3 bg-surface-container-low rounded-lg border border-border-warm text-xs flex items-start gap-2 mt-1">
              <span class="material-symbols-outlined text-secondary text-base shrink-0 mt-0.5">info</span>
              <span class="text-on-surface-variant leading-relaxed text-[11px]">
                Submitting this form registers your applicant profile with Sun Rise Sr. Sec. School. The administration office will contact you for document verification.
              </span>
            </div>

            <!-- Primary Action Button -->
            <button class="w-full h-12 bg-secondary hover:bg-gold-hover text-primary font-bold rounded-xl shadow-xs transition-all transform active:scale-95 flex items-center justify-center gap-2 text-xs sm:text-sm mt-2 cursor-pointer" id="btn-submit-registration" type="button">
              <span class="material-symbols-outlined text-[20px]">send</span>
              <span><?= get_text('admissions', 'checkout_cta_btn', 'Submit Admission Registration →') ?></span>
            </button>

            <!-- Status Notice -->
            <div class="flex flex-col gap-1.5 pt-1 text-center text-xs text-on-surface-variant">
              <div class="flex items-center justify-center gap-3 text-[11px]">
                <span class="flex items-center gap-1 text-emerald-700 font-semibold">
                  <span class="material-symbols-outlined text-sm">verified</span> Official Registration
                </span>
                <span class="flex items-center gap-1 text-emerald-700 font-semibold">
                  <span class="material-symbols-outlined text-sm">lock</span> 100% Secure
                </span>
              </div>
              <p class="text-[10px] text-on-surface-variant leading-tight mt-1">
                Office Hours: Mon–Sat (Summer: 7:30 AM–1:30 PM | Winter: 8:30 AM–2:30 PM)
              </p>
            </div>

          </div>
        </div>

        <!-- Required Verification Documents Card -->
        <div class="bg-white rounded-xl p-5 sm:p-6 shadow-xs border border-border-warm flex flex-col justify-between">
          <div>
            <div class="flex items-center gap-3 pb-3 border-b border-border-warm">
              <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold shrink-0">
                <span class="material-symbols-outlined text-lg">upload_file</span>
              </div>
              <div>
                <h3 class="font-bold text-primary text-sm sm:text-base">Required Verification Documents</h3>
                <p class="text-[11px] text-on-surface-variant">Keep copies ready for campus verification</p>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mt-3.5">
              <!-- Doc 1 -->
              <div class="p-2.5 bg-surface-container-low rounded-lg border border-border-warm flex items-start justify-between gap-1.5">
                <div>
                  <span class="text-xs font-bold text-primary block"><?= get_text('admissions', 'upload_doc1_title', '1. Birth Certificate / TC') ?></span>
                  <span class="text-[10px] text-on-surface-variant"><?= get_text('admissions', 'upload_doc1_sub', 'Official date of birth validation') ?></span>
                </div>
                <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
              </div>
              <!-- Doc 2 -->
              <div class="p-2.5 bg-surface-container-low rounded-lg border border-border-warm flex items-start justify-between gap-1.5">
                <div>
                  <span class="text-xs font-bold text-primary block"><?= get_text('admissions', 'upload_doc2_title', '2. Prior Marksheet') ?></span>
                  <span class="text-[10px] text-on-surface-variant"><?= get_text('admissions', 'upload_doc2_sub', 'Marksheet from previous school') ?></span>
                </div>
                <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
              </div>
              <!-- Doc 3 -->
              <div class="p-2.5 bg-surface-container-low rounded-lg border border-border-warm flex items-start justify-between gap-1.5">
                <div>
                  <span class="text-xs font-bold text-primary block"><?= get_text('admissions', 'upload_doc3_title', '3. Aadhaar & PPP') ?></span>
                  <span class="text-[10px] text-on-surface-variant"><?= get_text('admissions', 'upload_doc3_sub', 'Student & Parent Aadhaar ID') ?></span>
                </div>
                <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
              </div>
              <!-- Doc 4 -->
              <div class="p-2.5 bg-surface-container-low rounded-lg border border-border-warm flex items-start justify-between gap-1.5">
                <div>
                  <span class="text-xs font-bold text-primary block"><?= get_text('admissions', 'upload_doc4_title', '4. Photos (4 Copies)') ?></span>
                  <span class="text-[10px] text-on-surface-variant"><?= get_text('admissions', 'upload_doc4_sub', 'Recent passport size') ?></span>
                </div>
                <span class="material-symbols-outlined text-emerald-600 text-base shrink-0">check_circle</span>
              </div>
            </div>
          </div>

          <div class="mt-3.5 p-2.5 rounded-lg bg-surface-container-low border border-border-warm flex items-center gap-2 text-[11px] text-on-surface-variant">
            <span class="material-symbols-outlined text-secondary text-base shrink-0">info</span>
            <span>All original documents must be presented during campus visit.</span>
          </div>
        </div>

        <!-- Help Desk Widget -->
        <div class="p-4 bg-white rounded-xl shadow-xs border border-border-warm flex items-center justify-between">
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold shrink-0">
              <span class="material-symbols-outlined text-lg">support_agent</span>
            </div>
            <div class="text-xs">
              <span class="font-bold text-primary block">Admission Help Desk</span>
              <span class="text-on-surface-variant font-medium">+91 70158 90094 / +91 79883 5710</span>
            </div>
          </div>
          <a class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold flex items-center gap-1 shadow-xs transition-colors shrink-0" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', get_text('admissions', 'help_whatsapp', '917015890094')) ?>" target="_blank">
            <span class="material-symbols-outlined text-[14px]">chat</span> WhatsApp
          </a>
        </div>

        <!-- Academic Director's Admission Quote Card -->
        <div class="p-5 bg-gradient-to-br from-primary via-[#041d3d] to-primary text-white rounded-2xl shadow-sm border border-border-warm relative overflow-hidden">
          <!-- Background Accents -->
          <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-[#C9A24B]/15 rounded-full blur-xl pointer-events-none"></div>
          <div class="relative z-10 flex flex-col gap-3">
            <div class="flex items-center justify-between">
              <span class="text-[10px] text-[#C9A24B] uppercase tracking-widest font-bold">Director's Message</span>
              <span class="material-symbols-outlined text-[#C9A24B] text-2xl opacity-75">format_quote</span>
            </div>
            <p class="text-xs text-white/90 italic leading-relaxed font-light">
              "Education is not merely about syllabus completion; it is the igniting of curiosity, discipline, and noble character. Every child who enters Sun Rise School Dobhi is nurtured to lead tomorrow with courage and values."
            </p>
            <div class="pt-2 border-t border-white/10 flex items-center justify-between">
              <div class="flex flex-col">
                <span class="text-xs font-bold text-white">Director & Academic Board</span>
                <span class="text-[10px] text-white/70">Sun Rise Sr. Sec. School, Dobhi</span>
              </div>
              <span class="text-[10px] text-[#C9A24B] font-bold bg-white/10 px-2.5 py-1 rounded-md">Session 2026–27</span>
            </div>
          </div>
        </div>

        <!-- Admission Next Steps Checklist Card -->
        <div class="p-4 bg-[#FFFBEB] rounded-xl border border-[#FDE68A] text-xs flex items-start gap-2.5">
          <span class="material-symbols-outlined text-[#B45309] text-xl shrink-0 mt-0.5">verified_user</span>
          <div>
            <span class="font-bold text-[#92400E] block">Quick Admission Advisory</span>
            <span class="text-[#78350F] text-[11px] leading-relaxed block mt-0.5">
              Online registration takes under 2 minutes. Once submitted, our admission counselor will coordinate your campus visit for document verification and stream allocation.
            </span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Admission Guidelines & FAQs (Light Theme) -->
  <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full border-t border-border-warm">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
      
      <!-- Left: Required Documents Checklist -->
      <div class="lg:col-span-5 flex flex-col gap-4">
        <div>
          <span class="text-eyebrow text-[#C9A24B] uppercase font-bold tracking-wider text-xs"><?= get_text('admissions', 'docs_eyebrow', 'Verification Standards') ?></span>
          <h2 class="text-lg sm:text-xl font-bold text-primary tracking-tight leading-snug mt-0.5"><?= get_text('admissions', 'docs_heading', 'Required Documents & Eligibility') ?></h2>
          <p class="text-on-surface-variant text-xs sm:text-sm mt-0.5"><?= get_text('admissions', 'docs_desc', 'Carry original copies during document physical verification at Dobhi campus.') ?></p>
        </div>

        <div class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-border-warm flex flex-col gap-3">
          <div class="flex items-start gap-2.5">
            <span class="material-symbols-outlined text-secondary text-xl mt-0.5">task_alt</span>
            <div class="text-xs">
              <span class="font-bold text-primary block"><?= get_text('admissions', 'doc1_title', 'Original Transfer Certificate (TC)') ?></span>
              <span class="text-on-surface-variant"><?= get_text('admissions', 'doc1_desc', 'Countersigned by District Education Officer (if transferring from other state board).') ?></span>
            </div>
          </div>
          <div class="flex items-start gap-2.5">
            <span class="material-symbols-outlined text-secondary text-xl mt-0.5">task_alt</span>
            <div class="text-xs">
              <span class="font-bold text-primary block"><?= get_text('admissions', 'doc2_title', 'Municipal Birth Certificate') ?></span>
              <span class="text-on-surface-variant"><?= get_text('admissions', 'doc2_desc', 'Mandatory for Nursery to Class 1 admissions for proof of age cut-off.') ?></span>
            </div>
          </div>
          <div class="flex items-start gap-2.5">
            <span class="material-symbols-outlined text-secondary text-xl mt-0.5">task_alt</span>
            <div class="text-xs">
              <span class="font-bold text-primary block"><?= get_text('admissions', 'doc3_title', 'Aadhaar Card (Student & Parents)') ?></span>
              <span class="text-on-surface-variant"><?= get_text('admissions', 'doc3_desc', 'Clear photocopy for Haryana Parivar Pehchan Patra (PPP) linkage.') ?></span>
            </div>
          </div>
          <div class="flex items-start gap-2.5">
            <span class="material-symbols-outlined text-secondary text-xl mt-0.5">task_alt</span>
            <div class="text-xs">
              <span class="font-bold text-primary block"><?= get_text('admissions', 'doc4_title', 'Recent Passport-Size Photographs') ?></span>
              <span class="text-on-surface-variant"><?= get_text('admissions', 'doc4_desc', '4 copies of student and joint photo with parents.') ?></span>
            </div>
          </div>
          <div class="flex items-start gap-2.5">
            <span class="material-symbols-outlined text-secondary text-xl mt-0.5">task_alt</span>
            <div class="text-xs">
              <span class="font-bold text-primary block"><?= get_text('admissions', 'doc5_title', 'Caste / Category Certificate (If Applicable)') ?></span>
              <span class="text-on-surface-variant"><?= get_text('admissions', 'doc5_desc', 'SC/ST/OBC/EWS certificate issued by competent authority.') ?></span>
            </div>
          </div>
        </div>

        <!-- Campus Tour Micro-Prompt -->
        <div class="p-4 bg-white rounded-xl shadow-xs border border-border-warm flex items-center justify-between">
          <div>
            <h4 class="font-bold text-primary text-xs sm:text-sm"><?= get_text('admissions', 'tour_box_title', 'Prefer an In-Person Campus Visit?') ?></h4>
            <p class="text-[11px] text-on-surface-variant mt-0.5"><?= get_text('admissions', 'tour_box_desc', 'Visit Dobhi campus Monday to Saturday between 9:00 AM – 2:30 PM.') ?></p>
          </div>
          <a href="<?= htmlspecialchars(get_text('admissions', 'tour_box_link', 'contact-us.php')) ?>" class="bg-primary hover:bg-secondary hover:text-primary text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all shrink-0 inline-block text-center ml-2 shadow-xs">
            <?= get_text('admissions', 'tour_box_btn', 'Contact Us') ?>
          </a>
        </div>
      </div>

      <!-- Right: FAQ Accordion -->
      <div class="lg:col-span-7 flex flex-col gap-3">
        <div>
          <span class="text-eyebrow text-[#C9A24B] uppercase font-bold tracking-wider text-xs"><?= get_text('admissions', 'faq_eyebrow', "Parents' FAQ Desk") ?></span>
          <h2 class="text-lg sm:text-xl font-bold text-primary tracking-tight leading-snug mt-0.5"><?= get_text('admissions', 'faq_heading', 'Frequently Asked Questions') ?></h2>
        </div>

        <!-- FAQ Item 1 -->
        <div class="faq-accordion-item bg-white rounded-xl p-4 shadow-xs border border-border-warm transition-all">
          <button class="faq-trigger w-full flex items-center justify-between text-left font-bold text-xs sm:text-sm text-primary cursor-pointer">
            <span><?= get_text('admissions', 'faq1_q', 'What is the admission procedure after submitting this online registration?') ?></span>
            <span class="material-symbols-outlined text-secondary transition-transform duration-200 faq-arrow text-lg">expand_more</span>
          </button>
          <div class="faq-content hidden mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-border-warm/60">
            <?= get_text('admissions', 'faq1_a', 'After submitting the online application, our admissions office will review the student details and invite parents and the applicant for a short baseline interaction and original document verification at our Dobhi campus.') ?>
          </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="faq-accordion-item bg-white rounded-xl p-4 shadow-xs border border-border-warm transition-all">
          <button class="faq-trigger w-full flex items-center justify-between text-left font-bold text-xs sm:text-sm text-primary cursor-pointer">
            <span><?= get_text('admissions', 'faq2_q', 'What are the age cut-off criteria for Primary and Kindergarten admissions?') ?></span>
            <span class="material-symbols-outlined text-secondary transition-transform duration-200 faq-arrow text-lg">expand_more</span>
          </button>
          <div class="faq-content hidden mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-border-warm/60">
            <?= get_text('admissions', 'faq2_a', 'As per Haryana School Education norms, the minimum age for Nursery is 3+ years and for Class 1 is 5+ years as of 31st March of the academic admission year.') ?>
          </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="faq-accordion-item bg-white rounded-xl p-4 shadow-xs border border-border-warm transition-all">
          <button class="faq-trigger w-full flex items-center justify-between text-left font-bold text-xs sm:text-sm text-primary cursor-pointer">
            <span><?= get_text('admissions', 'faq3_q', 'How are Science, Commerce & Arts streams allocated in Class 11?') ?></span>
            <span class="material-symbols-outlined text-secondary transition-transform duration-200 faq-arrow text-lg">expand_more</span>
          </button>
          <div class="faq-content hidden mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-border-warm/60">
            <?= get_text('admissions', 'faq3_a', 'Science (Medical & Non-Medical) stream is allocated based on Class 10 Board marks and student aptitude in Science & Mathematics. Commerce and Arts streams are offered based on student preference and counseling.') ?>
          </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="faq-accordion-item bg-white rounded-xl p-4 shadow-xs border border-border-warm transition-all">
          <button class="faq-trigger w-full flex items-center justify-between text-left font-bold text-xs sm:text-sm text-primary cursor-pointer">
            <span><?= get_text('admissions', 'faq4_q', 'Which villages and routes are covered under the Dobhi school bus network?') ?></span>
            <span class="material-symbols-outlined text-secondary transition-transform duration-200 faq-arrow text-lg">expand_more</span>
          </button>
          <div class="faq-content hidden mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-border-warm/60">
            <?= get_text('admissions', 'faq4_a', 'Our GPS-enabled bus network covers Dobhi, Balsamand, Arya Nagar, Rawalwas Kalan, Rawalwas Khurd, Bandaheri, Chaudhariwas, Muklan, Mirzapur, and surrounding rural routes within a 22 km radius.') ?>
          </div>
        </div>

        <!-- FAQ Item 5 -->
        <div class="faq-accordion-item bg-white rounded-xl p-4 shadow-xs border border-border-warm transition-all">
          <button class="faq-trigger w-full flex items-center justify-between text-left font-bold text-xs sm:text-sm text-primary cursor-pointer">
            <span><?= get_text('admissions', 'faq5_q', 'Can parents visit the school campus before finalizing admission?') ?></span>
            <span class="material-symbols-outlined text-secondary transition-transform duration-200 faq-arrow text-lg">expand_more</span>
          </button>
          <div class="faq-content hidden mt-2 text-xs text-on-surface-variant leading-relaxed pt-2 border-t border-border-warm/60">
            <?= get_text('admissions', 'faq5_a', 'Yes, parents and students are warmly welcome to visit the school campus, explore the science laboratories, smart classrooms, and library, and meet the faculty during school working hours.') ?>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Direct Admissions Helpline & Support Banner -->
  <section class="py-8 sm:py-10 px-4 sm:px-6 lg:px-12 bg-primary text-white border-t border-[#C9A24B]/30">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-5">
      <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0 text-secondary">
          <span class="material-symbols-outlined text-[28px]">headset_mic</span>
        </div>
        <div>
          <span class="text-[10px] font-bold text-secondary uppercase tracking-wider"><?= get_text('admissions', 'help_eyebrow', 'Admissions Directorate – Dobhi Campus') ?></span>
          <h3 class="text-base sm:text-lg font-bold text-white"><?= get_text('admissions', 'help_heading', 'Need Assistance with Admissions?') ?></h3>
          <p class="text-surface-cream/80 text-xs mt-0.5"><?= get_text('admissions', 'help_desc', 'Our administrative office is open Monday to Saturday (Summer: 7:30 AM to 1:30 PM | Winter: 8:30 AM to 2:30 PM) to assist parents.') ?></p>
        </div>
      </div>
      <div class="flex flex-wrap items-center gap-3 shrink-0">
        <a class="px-4 py-2 rounded-lg bg-white hover:bg-surface-cream text-primary text-xs font-bold flex items-center gap-1.5 shadow-md transition-colors" href="tel:<?= urlencode(get_text('admissions', 'help_phone', '+91 70158 90094')) ?>">
          <span class="material-symbols-outlined text-[16px]">call</span>
          <span><?= get_text('admissions', 'help_phone', '+91 70158 90094') ?></span>
        </a>
        <a class="px-4 py-2 rounded-lg bg-secondary hover:bg-gold-hover text-primary text-xs font-bold flex items-center gap-1.5 shadow-md transition-colors" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', get_text('admissions', 'help_whatsapp', '917015890094')) ?>" target="_blank">
          <span class="material-symbols-outlined text-[16px]">chat</span>
          <span>WhatsApp Us</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Interactive Client Logic (Grade Selection & Form Submission) -->
  <script>
    (function() {
      const state = {
        gradeId: 'xi-nonmed',
        gradeName: 'Class 11 - Science (Non-Medical)',
        busOption: 'dobhi-bus'
      };

      const summaryGradeName = document.getElementById('summary-grade-name');
      const summaryTransitChoice = document.getElementById('summary-transit-choice');
      const btnSubmit = document.getElementById('btn-submit-registration');

      function updateCardSelection(selectedCard) {
        document.querySelectorAll('.grade-card').forEach(card => {
          card.classList.remove('ring-2', 'ring-[#2563EB]', 'ring-[#16A34A]', 'ring-[#9333EA]', 'ring-[#D97706]', 'ring-[#0D9488]', 'ring-[#EA580C]', 'ring-[#E11D48]', 'ring-[#4F46E5]', 'shadow-md');
          card.classList.add('shadow-xs');
          const radio = card.querySelector('input[type="radio"]');
          if (radio) radio.checked = false;
          const radioIcon = card.querySelector('.material-symbols-outlined:last-child');
          if (radioIcon) {
            radioIcon.textContent = 'radio_button_unchecked';
            radioIcon.classList.add('text-outline-variant');
          }
        });

        selectedCard.classList.add('ring-2', 'ring-[#2563EB]', 'shadow-md');
        selectedCard.classList.remove('shadow-xs');
        const activeRadio = selectedCard.querySelector('input[type="radio"]');
        if (activeRadio) activeRadio.checked = true;

        const activeIcon = selectedCard.querySelector('.material-symbols-outlined:last-child');
        if (activeIcon) {
          activeIcon.textContent = 'check_circle';
          activeIcon.classList.remove('text-outline-variant');
        }

        // Update state & summary
        state.gradeId = selectedCard.getAttribute('data-grade-id');
        state.gradeName = selectedCard.getAttribute('data-grade-name');
        if (summaryGradeName) {
          summaryGradeName.textContent = state.gradeName;
        }
      }

      // Card clicks
      document.querySelectorAll('.grade-card').forEach(card => {
        card.addEventListener('click', function() {
          updateCardSelection(this);
        });
      });

      // Filter tabs for classes
      document.querySelectorAll('.grade-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          document.querySelectorAll('.grade-filter-btn').forEach(b => {
            b.classList.remove('bg-primary', 'text-white', 'shadow-xs', 'font-bold');
            b.classList.add('text-on-surface-variant', 'font-semibold');
          });
          this.classList.add('bg-primary', 'text-white', 'shadow-xs', 'font-bold');
          this.classList.remove('text-on-surface-variant');

          const filter = this.getAttribute('data-category');
          document.querySelectorAll('.grade-card').forEach(card => {
            if (filter === 'all' || card.getAttribute('data-group') === filter) {
              card.style.display = 'flex';
            } else {
              card.style.display = 'none';
            }
          });
        });
      });

      // Transit Radio change
      const transitRadios = document.querySelectorAll('input[name="bus_option"]');
      const villageDropdown = document.getElementById('village-bus-dropdown');
      transitRadios.forEach(radio => {
        radio.addEventListener('change', function() {
          const parentCard = this.closest('label');
          document.querySelectorAll('.transit-option-card').forEach(c => {
            c.classList.remove('bg-surface-cream', 'ring-2', 'ring-secondary');
            c.classList.add('bg-surface-container-low');
          });
          parentCard.classList.add('bg-surface-cream', 'ring-2', 'ring-secondary');
          parentCard.classList.remove('bg-surface-container-low');

          if (this.value === 'dobhi-bus') {
            if (summaryTransitChoice) summaryTransitChoice.textContent = 'School Bus Transit Facility';
            if (villageDropdown) villageDropdown.style.display = 'flex';
          } else {
            if (summaryTransitChoice) summaryTransitChoice.textContent = 'Self Arranged Conveyance';
            if (villageDropdown) villageDropdown.style.display = 'none';
          }
        });
      });

      // FAQ Accordion
      document.querySelectorAll('.faq-trigger').forEach(trigger => {
        trigger.addEventListener('click', function() {
          const item = this.closest('.faq-accordion-item');
          const content = item.querySelector('.faq-content');
          const arrow = this.querySelector('.faq-arrow');
          const isHidden = content.classList.contains('hidden');

          if (isHidden) {
            content.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
          } else {
            content.classList.add('hidden');
            arrow.style.transform = 'rotate(0deg)';
          }
        });
      });

      // Submit Button Action
      if (btnSubmit) {
        btnSubmit.addEventListener('click', function() {
          const studentName = document.getElementById('input_student_name').value || 'Student';
          btnSubmit.disabled = true;
          btnSubmit.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> <span>Submitting Application...</span>';

          setTimeout(() => {
            btnSubmit.innerHTML = '<span class="material-symbols-outlined text-emerald-800 text-[20px]">verified</span> <span class="text-primary font-bold">Application Submitted!</span>';
            btnSubmit.classList.remove('bg-secondary', 'text-primary');
            btnSubmit.classList.add('bg-emerald-400');

            const token = 'SRS-2026-' + Math.floor(100000 + Math.random() * 900000);
            alert('Admission Registration Submitted Successfully!\n\n' +
                  'Applicant: ' + studentName + '\n' +
                  'Grade Level: ' + state.gradeName + '\n' +
                  'Registration Ref No: ' + token + '\n\n' +
                  'Thank you for applying to Sun Rise Sr. Sec. School, Dobhi. Our admissions desk will contact you shortly for document verification.');
          }, 1000);
        });
      }
    })();
  </script>

</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
