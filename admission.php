<?php
$current_page = 'admissions';
$page_title = 'Admissions 2026-27 | Application Process & Eligibility';
$page_description = 'Apply for admissions 2026-27 at Sun Rise Sr. Sec. School, Dobhi. Learn about our admission process, age eligibility criteria, fee structure, and online registration.';
$page_keywords = 'admissions 2026-27, school application, admission process, HBSE school admission Dobhi Hisar, eligibility criteria, enroll online';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
<!-- Top Breadcrumb & Page Banner -->
<section class="relative bg-surface-container-low py-12 px-6 lg:px-12 overflow-hidden">
<div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-secondary-fixed/20 blur-3xl pointer-events-none"></div>
<div class="absolute left-10 bottom-0 w-80 h-80 rounded-full bg-primary-fixed/20 blur-3xl pointer-events-none"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col gap-6">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-label-sm text-on-surface-variant">
<a class="hover:text-primary transition-colors flex items-center gap-1" href="#">
<span class="material-symbols-outlined text-[16px]">home</span> Home
        </a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="#">Admissions</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">Online Registration &amp; Fee Checkout</span>
</nav>
<!-- Header Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
<div class="lg:col-span-8 flex flex-col gap-2.5 sm:gap-4">
<div class="hero-badge inline-flex items-center gap-1.5 sm:gap-2 self-start px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full bg-gold-light text-secondary font-bold uppercase tracking-wider">
<span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-secondary animate-ping"></span>
            <?= get_text('admissions', 'session_badge', 'Academic Session 2026–27 Registrations Open') ?>
          </div>
<h1 class="hero-heading font-headline-lg font-bold text-primary tracking-tight">
            <?= get_text('admissions', 'hero_title', 'Admissions Open: Sun Rise Sr. Sec. School, Dobhi') ?>
          </h1>
<p class="hero-subtitle text-on-surface-variant w-full max-w-3xl">
            <?= get_text('admissions', 'hero_desc', 'Cultivating scholarship, strong character, and competitive excellence in Hisar district. Select your grade stream, verify student credentials, choose village transit, and secure provisional seat enrollment instantly via direct digital checkout.') ?>
          </p>
<!-- Key Highlights Badges -->
<div class="flex flex-wrap items-center gap-3 pt-2">
<div class="flex items-center gap-2 bg-surface-pure px-3.5 py-2 rounded-lg shadow-sm text-label-sm text-text-charcoal font-semibold">
<span class="material-symbols-outlined text-[#C9A24B] text-[20px]" style="font-variation-settings: 'FILL' 1;">verified</span>
              <?= get_text('admissions', 'badge_HBSE', 'HBSE Affiliation #530XXX (Dobhi, Hisar)') ?>
            </div>
<div class="flex items-center gap-2 bg-surface-pure px-3.5 py-2 rounded-lg shadow-sm text-label-sm text-text-charcoal font-semibold">
<span class="material-symbols-outlined text-[#C9A24B] text-[20px]" style="font-variation-settings: 'FILL' 1;">bolt</span>
              <?= get_text('admissions', 'badge_digital', '100% Digital Fast-Track Entry') ?>
            </div>
<div class="flex items-center gap-2 bg-surface-pure px-3.5 py-2 rounded-lg shadow-sm text-label-sm text-text-charcoal font-semibold">
<span class="material-symbols-outlined text-[#C9A24B] text-[20px]" style="font-variation-settings: 'FILL' 1;">assignment_turned_in</span>
              <?= get_text('admissions', 'badge_token', 'Instant Seat Allocation Token') ?>
            </div>
<div class="flex items-center gap-2 bg-surface-pure px-3.5 py-2 rounded-lg shadow-sm text-label-sm text-text-charcoal font-semibold">
<span class="material-symbols-outlined text-[#C9A24B] text-[20px]" style="font-variation-settings: 'FILL' 1;">security</span>
              <?= get_text('admissions', 'badge_escrow', 'RBI &amp; PCI-DSS 256-Bit Escrow') ?>
            </div>
</div>
</div>
<!-- School Shield Credential Card -->
<div class="lg:col-span-4 flex justify-start lg:justify-end">
<div class="w-full max-w-xs bg-surface-pure p-6 rounded-xl shadow-md flex flex-col items-center text-center gap-3 relative overflow-hidden">
<div class="w-24 h-24 p-2 rounded-full bg-gold-light/60 flex items-center justify-center">
<img alt="Sun Rise Sr. Sec. School Dobhi Official Crest" class="w-20 h-20 object-contain drop-shadow-sm" src="<?= $site_logo ?>" width="80" height="80" loading="eager" decoding="async">
</div>
<div class="flex flex-col items-center">
<span class="font-eyebrow text-eyebrow text-secondary uppercase tracking-widest"><?= get_text('admissions', 'school_affiliation_tag', 'Affiliated to HBSE, Haryana') ?></span>
<span class="font-headline-sm text-headline-sm text-primary">Sun Rise Sr. Sec. School</span>
<span class="text-body-sm font-body-sm text-on-surface-variant"><?= get_text('admissions', 'school_location_tag', 'Dobhi, Dist. Hisar, Haryana – 125001') ?></span>
</div>
<div class="w-full bg-surface-cream rounded-lg p-2.5 flex items-center justify-between text-label-sm">
<span class="text-on-surface-variant">Admission Status:</span>
<span class="font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded text-[11px] uppercase"><?= get_text('admissions', 'admission_status_pill', 'Active Now') ?></span>
</div>
</div>
</div>
</div>
<!-- Multi-Step Progress Tracker Bar -->
<div class="mt-6 pt-6 bg-surface-pure rounded-xl p-4 sm:p-6 shadow-sm">
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
<!-- Step 1 -->
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary text-on-primary font-bold flex items-center justify-center text-sm shadow-sm">
              1
            </div>
<div class="flex flex-col min-w-0">
<span class="font-eyebrow text-eyebrow text-secondary uppercase">Step 01</span>
<span class="font-label-md text-label-md text-primary font-bold truncate"><?= get_text('admissions', 'step1_title', 'Class & Stream Choice') ?></span>
</div>
</div>
<!-- Step 2 -->
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-[#C9A24B] text-primary font-bold flex items-center justify-center text-sm shadow-sm">
              2
            </div>
<div class="flex flex-col min-w-0">
<span class="font-eyebrow text-eyebrow text-secondary uppercase">Step 02</span>
<span class="font-label-md text-label-md text-primary font-bold truncate"><?= get_text('admissions', 'step2_title', 'Student Profile Info') ?></span>
</div>
</div>
<!-- Step 3 -->
<div class="flex items-center gap-3 opacity-75">
<div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface font-bold flex items-center justify-center text-sm">
              3
            </div>
<div class="flex flex-col min-w-0">
<span class="font-eyebrow text-eyebrow text-on-surface-variant uppercase">Step 03</span>
<span class="font-label-md text-label-md text-on-surface-variant font-semibold truncate"><?= get_text('admissions', 'step3_title', 'Transit & Documents') ?></span>
</div>
</div>
<!-- Step 4 -->
<div class="flex items-center gap-3 opacity-75">
<div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface font-bold flex items-center justify-center text-sm">
              4
            </div>
<div class="flex flex-col min-w-0">
<span class="font-eyebrow text-eyebrow text-on-surface-variant uppercase">Step 04</span>
<span class="font-label-md text-label-md text-on-surface-variant font-semibold truncate"><?= get_text('admissions', 'step4_title', 'Fee Review & Checkout') ?></span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Interactive Class / Stream Matrix Selector -->
<section class="py-12 px-6 lg:px-12 max-w-7xl mx-auto w-full">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
<div>
<div class="font-eyebrow text-eyebrow text-secondary uppercase tracking-widest"><?= get_text('admissions', 'grade_selector_eyebrow', 'Select Admission Grade') ?></div>
<h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('admissions', 'grade_selector_heading', 'Available Classes & Available Vacancies') ?></h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1"><?= get_text('admissions', 'grade_selector_desc', 'Choose the prospective level to populate academic fees, syllabi criteria, and batch schedules.') ?></p>
</div>
<!-- Segment Filters -->
<div class="flex flex-wrap gap-2 p-1.5 bg-surface-container-low rounded-xl" id="grade-filter-container">
<button class="grade-filter-btn px-4 py-2 rounded-lg text-label-sm font-semibold bg-primary text-on-primary shadow-sm transition-all" data-category="all">All Grades</button>
<button class="grade-filter-btn px-4 py-2 rounded-lg text-label-sm font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="senior">Senior Secondary (XI - XII)</button>
<button class="grade-filter-btn px-4 py-2 rounded-lg text-label-sm font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="secondary">Secondary (IX - X)</button>
<button class="grade-filter-btn px-4 py-2 rounded-lg text-label-sm font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="middle">Middle &amp; Primary (I - VIII)</button>
<button class="grade-filter-btn px-4 py-2 rounded-lg text-label-sm font-semibold text-on-surface-variant hover:text-primary transition-all" data-category="preprimary">Pre-Primary (Play / KG)</button>
</div>
</div>
    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="class-cards-grid">
      <!-- Card 1: Class 11 Non-Med (Default Selected) -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer ring-2 ring-[#C9A24B]" data-grade-id="xi-nonmed" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c1_name', 'Class 11 - Science (Non-Medical)')) ?>" data-group="senior" data-reg-fee="<?= (int)get_text('admissions', 'c1_reg_fee', '300') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c1_seats', '12 Seats Left')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c1_monthly_fee', '1000') ?>">
        <div class="absolute -top-3 right-4 bg-[#C9A24B] text-primary text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-sm">
          Selected Choice
        </div>
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">HBSE Stream</span>
            <span class="text-xs font-bold text-error bg-error-container/30 px-2 py-0.5 rounded flex items-center gap-1">
              <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span> <?= get_text('admissions', 'c1_seats', '12 Seats Left') ?>
            </span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c1_name', 'Class XI – Science (Non-Med)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c1_desc', 'Physics, Chemistry, Math + Comp. Science / Physical Edu with NDA & JEE Foundation Track.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c1_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c1_monthly_fee', '1000')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c1_reg_fee', '300')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-bold text-primary">
            <input checked="" class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="xi-nonmed">
            <span>Active Selection</span>
          </label>
          <span class="material-symbols-outlined text-[#C9A24B] text-[20px]">check_circle</span>
        </div>
      </div>

      <!-- Card 2: Class 11 Medical -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="xi-med" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c2_name', 'Class 11 - Science (Medical)')) ?>" data-group="senior" data-reg-fee="<?= (int)get_text('admissions', 'c2_reg_fee', '300') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c2_seats', '8 Seats Left')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c2_monthly_fee', '1000') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">HBSE Stream</span>
            <span class="text-xs font-bold text-amber-800 bg-secondary-fixed/50 px-2 py-0.5 rounded flex items-center gap-1">
              <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span> <?= get_text('admissions', 'c2_seats', '8 Seats Left') ?>
            </span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c2_name', 'Class XI – Science (Medical)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c2_desc', 'Physics, Chemistry, Biology + Biotech/IP with dedicated NEET coaching orientation lab.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c2_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c2_monthly_fee', '1000')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c2_reg_fee', '300')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="xi-med">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 3: Class 11 Commerce & Arts -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="xi-comm" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c3_name', 'Class 11 - Commerce & Humanities')) ?>" data-group="senior" data-reg-fee="<?= (int)get_text('admissions', 'c3_reg_fee', '300') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c3_seats', '22 Seats Available')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c3_monthly_fee', '950') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">HBSE Stream</span>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded flex items-center gap-1">
              <?= get_text('admissions', 'c3_seats', '22 Seats Available') ?>
            </span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c3_name', 'Class XI – Commerce & Arts') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c3_desc', 'Accountancy, Business Studies, Economics, Pol. Science, Geography & Applied Mathematics.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c3_age', '15 - 17 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c3_monthly_fee', '950')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c3_reg_fee', '300')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="xi-comm">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 4: Class 9 & 10 Secondary Foundation -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="ix-x" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c4_name', 'Class 9 & 10 (Secondary High)')) ?>" data-group="secondary" data-reg-fee="<?= (int)get_text('admissions', 'c4_reg_fee', '250') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c4_seats', '16 Seats Open')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c4_monthly_fee', '900') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">HBSE Core</span>
            <span class="text-xs font-bold text-amber-800 bg-secondary-fixed/50 px-2 py-0.5 rounded flex items-center gap-1">
              <?= get_text('admissions', 'c4_seats', '16 Seats Open') ?>
            </span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c4_name', 'Class IX & X (Secondary)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c4_desc', 'Holistic HBSE syllabus with Robotics lab, Vedic Math, Sports academy & NTSE training module.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c4_age', '13 - 15 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c4_monthly_fee', '900')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c4_reg_fee', '250')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="ix-x">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 5: Class 6 to 8 (Middle) -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="vi-viii" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c5_name', 'Class 6 to 8 (Middle Wing)')) ?>" data-group="middle" data-reg-fee="<?= (int)get_text('admissions', 'c5_reg_fee', '200') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c5_seats', '19 Seats Available')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c5_monthly_fee', '800') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">Middle Wing</span>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded"><?= get_text('admissions', 'c5_seats', '19 Seats Available') ?></span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c5_name', 'Class VI – VIII (Middle Wing)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c5_desc', 'Foundational STEM concepts, computer coding, Hindi & English debate, and agricultural science basics.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c5_age', '10 - 13 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c5_monthly_fee', '800')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c5_reg_fee', '200')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="vi-viii">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 6: Class 1 to 5 (Primary) -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="i-v" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c6_name', 'Class 1 to 5 (Primary School)')) ?>" data-group="middle" data-reg-fee="<?= (int)get_text('admissions', 'c6_reg_fee', '200') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c6_seats', '25 Seats Available')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c6_monthly_fee', '700') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">Primary</span>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded"><?= get_text('admissions', 'c6_seats', '25 Seats Available') ?></span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c6_name', 'Class I – V (Primary School)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c6_desc', 'Activity-based learning, phonetics, environmental studies, performing arts, and physical fitness.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c6_age', '5 - 10 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c6_monthly_fee', '700')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c6_reg_fee', '200')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="i-v">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 7: Nursery / LKG / UKG -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="pre-kg" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c7_name', 'Kindergarten (Nursery/LKG/UKG)')) ?>" data-group="preprimary" data-reg-fee="<?= (int)get_text('admissions', 'c7_reg_fee', '200') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c7_seats', '30 Seats Available')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c7_monthly_fee', '600') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">Early Years</span>
            <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded"><?= get_text('admissions', 'c7_seats', '30 Seats Available') ?></span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c7_name', 'Pre-Primary (Nursery, KG)') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c7_desc', 'Montessori-inspired play gym, sensorimotor training, creative storytelling & air-conditioned playzones.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c7_age', '3 - 5 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c7_monthly_fee', '600')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c7_reg_fee', '200')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="pre-kg">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>

      <!-- Card 8: Class 12 Lateral Transfer -->
      <div class="grade-card group relative bg-surface-pure rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer" data-grade-id="xii-transfer" data-grade-name="<?= htmlspecialchars(get_text('admissions', 'c8_name', 'Class 12 - Board Transfer Entry')) ?>" data-group="senior" data-reg-fee="<?= (int)get_text('admissions', 'c8_reg_fee', '350') ?>" data-seats="<?= htmlspecialchars(get_text('admissions', 'c8_seats', '5 Seats Only')) ?>" data-tuition-fee="<?= (int)get_text('admissions', 'c8_monthly_fee', '1000') ?>">
        <div class="flex flex-col gap-3">
          <div class="flex justify-between items-start">
            <span class="px-2.5 py-1 bg-surface-cream text-primary rounded font-label-sm font-bold text-xs uppercase">HBSE Board Transfer</span>
            <span class="text-xs font-bold text-error bg-error-container/30 px-2 py-0.5 rounded"><?= get_text('admissions', 'c8_seats', '5 Seats Only') ?></span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors"><?= get_text('admissions', 'c8_name', 'Class XII – Transfer Entry') ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?= get_text('admissions', 'c8_desc', 'Direct admission subject to HBSE Regional Office clearance, TC from previous affiliated institution.') ?></p>
          </div>
          <div class="pt-3 flex flex-col gap-1.5 text-body-sm text-text-charcoal bg-surface-container-low/60 p-3 rounded-lg">
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Age Criteria:</span>
              <span class="font-bold"><?= get_text('admissions', 'c8_age', '16 - 18 Years') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Monthly Fee:</span>
              <span class="font-bold text-primary">₹<?= number_format((int)get_text('admissions', 'c8_monthly_fee', '1000')) ?> / Month</span>
            </div>
            <div class="flex justify-between">
              <span class="text-on-surface-variant">Reg. Form Fee:</span>
              <span class="font-bold text-secondary">₹<?= number_format((int)get_text('admissions', 'c8_reg_fee', '350')) ?></span>
            </div>
          </div>
        </div>
        <div class="mt-5 pt-3 flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer text-label-sm font-semibold text-on-surface-variant group-hover:text-primary">
            <input class="w-4 h-4 text-primary accent-[#C9A24B]" name="selected_grade" type="radio" value="xii-transfer">
            <span>Choose Grade</span>
          </label>
          <span class="material-symbols-outlined text-outline-variant group-hover:text-primary text-[20px]">radio_button_unchecked</span>
        </div>
      </div>
    </div>
</section>
<!-- Comprehensive Two-Column Admission Application & Live Checkout System -->
<section class="py-12 px-6 lg:px-12 max-w-7xl mx-auto w-full">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
<!-- LEFT COLUMN: Detailed Interactive Form -->
<div class="lg:col-span-7 flex flex-col gap-8">
<!-- Subsection 1: Student Information -->
<div class="bg-surface-pure rounded-xl p-8 shadow-sm">
<div class="flex items-center gap-3 pb-6">
<div class="w-10 h-10 rounded-lg bg-surface-cream text-primary flex items-center justify-center font-bold">
<span class="material-symbols-outlined">person</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-primary">Student Identity Credentials</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Provide legal identity matching Aadhaar and municipal records</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
<!-- Full Name -->
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-sm text-label-sm text-primary font-bold">Student's Full Name (As per birth record) *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" id="input_student_name" placeholder="e.g. Aryan Sheoran" type="text" value="Aarav Sharma">
</div>
<!-- Date of Birth -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Date of Birth *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" type="date" value="2009-08-14">
</div>
<!-- Gender -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Gender *</label>
<select class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner">
<option selected="" value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select>
</div>
<!-- Blood Group -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Blood Group</label>
<select class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner">
<option value="O+">O Positive (O+)</option>
<option selected="" value="A+">A Positive (A+)</option>
<option value="B+">B Positive (B+)</option>
<option value="AB+">AB Positive (AB+)</option>
<option value="O-">O Negative (O-)</option>
</select>
</div>
<!-- Aadhaar Number -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Student Aadhaar Number *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="XXXX - XXXX - 4821" type="text" value="7823 4412 8901">
</div>
<!-- Prior School Details -->
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-sm text-label-sm text-primary font-bold">Previous School Name &amp; Board *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. Model Public School, Balsamand / HBSE" type="text" value="Government Model Sr. Sec. School, Dobhi (HBSE)">
</div>
<!-- Last Grade Percentage -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Last Class Passed / Status</label>
<select class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner">
<option value="10">Passed Class 10 (Awaiting Board Result)</option>
<option selected="" value="10-passed">Passed Class 10 (Result Declared)</option>
<option value="9">Passed Class 9</option>
<option value="other">Other Equivalent Grade</option>
</select>
</div>
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Aggregate Percentage / Grade *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. 91.4% or A1 Grade" type="text" value="92.6%">
</div>
</div>
</div>
<!-- Subsection 2: Parent & Guardian Details -->
<div class="bg-surface-pure rounded-xl p-8 shadow-sm">
<div class="flex items-center gap-3 pb-6">
<div class="w-10 h-10 rounded-lg bg-surface-cream text-primary flex items-center justify-center font-bold">
<span class="material-symbols-outlined">family_restroom</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-primary">Parent &amp; Guardian Information</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Primary correspondence and emergency contact points</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
<!-- Father's Name -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Father / Guardian's Full Name *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. Rajender Sharma" type="text" value="Rajender Sharma">
</div>
<!-- Father's Occupation -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Father's Occupation</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. Agriculture / Govt. Employee / Business" type="text" value="Agriculture &amp; Grain Trader">
</div>
<!-- Mother's Name -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Mother's Full Name *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. Sunita Devi" type="text" value="Sunita Devi">
</div>
<!-- Mother's Occupation -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Mother's Occupation</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="e.g. Homemaker / Teacher" type="text" value="Homemaker &amp; Social Educator">
</div>
<!-- WhatsApp Mobile Contact -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Primary Contact / WhatsApp Number *</label>
<div class="flex">
<span class="h-12 px-3 bg-surface-container text-text-charcoal flex items-center justify-center font-bold text-sm rounded-l-lg">+91</span>
<input class="w-full h-12 px-4 rounded-r-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="98120 XXXXX" type="tel" value="98124 55432">
</div>
</div>
<!-- Email Address -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Email Address for Fee Receipts *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="parent@example.com" type="email" value="rajender.sharma.dobhi@gmail.com">
</div>
</div>
</div>
<!-- Subsection 3: Local Address & Bus Transit Selection -->
<div class="bg-surface-pure rounded-xl p-8 shadow-sm">
<div class="flex items-center gap-3 pb-6">
<div class="w-10 h-10 rounded-lg bg-surface-cream text-primary flex items-center justify-center font-bold">
<span class="material-symbols-outlined">directions_bus</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('admissions', 'bus_facility_title', 'Residence & Daily School Bus Facility') ?></h3>
<p class="font-body-sm text-body-sm text-on-surface-variant"><?= get_text('admissions', 'bus_facility_desc', 'Fleet covering 35+ villages in Hisar and neighboring rural belts') ?></p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
<!-- Village / Local Address -->
<div class="flex flex-col gap-1.5 md:col-span-2">
<label class="font-label-sm text-label-sm text-primary font-bold">Permanent Village / Street Address *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" placeholder="House No., Street, Landmark" type="text" value="Ward No. 4, Near Shiv Mandir, Main Dobhi Chowk">
</div>
<!-- District & State -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">District / Tehsil *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-high/50 text-text-charcoal font-body-md text-body-md" readonly="" type="text" value="Hisar, Haryana">
</div>
<!-- Pin Code -->
<div class="flex flex-col gap-1.5">
<label class="font-label-sm text-label-sm text-primary font-bold">Postal Pin Code *</label>
<input class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure focus:outline-none focus:ring-2 focus:ring-primary shadow-inner" type="text" value="125001">
</div>
<!-- Bus Route Option Selector -->
<div class="flex flex-col gap-1.5 md:col-span-2 mt-2">
<label class="font-label-sm text-label-sm text-primary font-bold">School Transit Facility (Optional GPS-Monitored Bus) *</label>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-1" id="transit-selector">
<label class="transit-option-card flex items-center justify-between p-4 rounded-lg bg-surface-cream ring-2 ring-[#C9A24B] cursor-pointer">
<div class="flex items-center gap-3">
<input checked="" class="w-4 h-4 text-primary accent-[#C9A24B]" name="bus_option" type="radio" value="dobhi-bus">
<div>
<span class="font-label-md text-label-md text-primary font-bold block"><?= get_text('admissions', 'bus_route_label', 'Route 4: Dobhi Village & Balsamand') ?></span>
<span class="text-body-sm text-on-surface-variant"><?= get_text('admissions', 'bus_route_desc', 'Pick-up at Main Stand / Doorway (₹300/month)') ?></span>
</div>
</div>
<span class="material-symbols-outlined text-[#C9A24B]">airport_shuttle</span>
</label>
<label class="transit-option-card flex items-center justify-between p-4 rounded-lg bg-surface-container-low cursor-pointer hover:bg-surface-container">
<div class="flex items-center gap-3">
<input class="w-4 h-4 text-primary accent-[#C9A24B]" name="bus_option" type="radio" value="self-arranged">
<div>
<span class="font-label-md text-label-md text-primary font-bold block">Own Conveyance / Day Boarding</span>
<span class="text-body-sm text-on-surface-variant">Parent drops and picks pupil directly (₹0)</span>
</div>
</div>
<span class="material-symbols-outlined text-outline-variant">directions_walk</span>
</label>
</div>
</div>
<!-- Additional Villages Dropdown (if Bus chosen) -->
<div class="flex flex-col gap-1.5 md:col-span-2" id="village-bus-dropdown">
<label class="font-label-sm text-label-sm text-primary font-bold">Designated Village Bus Stop Point</label>
<select class="w-full h-12 px-4 rounded-lg bg-surface-container-low text-text-charcoal font-body-md text-body-md focus:bg-surface-pure">
<option selected="" value="dobhi-center">Dobhi Main Chowk / Post Office (Bus 04)</option>
<option value="balsamand">Balsamand Bus Stand (Bus 04)</option>
<option value="rawanwas">Rawalwas Khurd / Kalan (Bus 07)</option>
<option value="aryanagar">Arya Nagar Mod (Bus 02)</option>
<option value="choudhriwas">Chaudhariwas By-pass (Bus 05)</option>
<option value="hisar-cantt">Balsamand Road / Hisar Outskirts (Bus 08)</option>
</select>
</div>
</div>
</div>
<!-- Subsection 4: Document Uploads Checklist -->
<div class="bg-surface-pure rounded-xl p-8 shadow-sm">
<div class="flex items-center gap-3 pb-6">
<div class="w-10 h-10 rounded-lg bg-surface-cream text-primary flex items-center justify-center font-bold">
<span class="material-symbols-outlined">upload_file</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-primary">Required Verification Documents</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Upload clear scanned copies or smartphone pictures (PDF/JPG up to 5MB)</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<!-- Doc 1 -->
<div class="p-4 bg-surface-container-low rounded-lg flex flex-col justify-between gap-3">
<div class="flex items-start justify-between">
<div>
<span class="font-label-md text-label-md text-primary font-bold block"><?= get_text('admissions', 'upload_doc1_title', '1. Student Birth Certificate / 10th TC') ?></span>
<span class="text-body-sm text-on-surface-variant"><?= get_text('admissions', 'upload_doc1_sub', 'Official date of birth validation') ?></span>
</div>
<span class="material-symbols-outlined text-emerald-600">check_circle</span>
</div>
<div class="flex items-center justify-between text-label-sm">
<span class="text-xs text-on-surface-variant">Uploaded: aarav_10th_tc.pdf</span>
<button class="text-secondary font-bold hover:underline">Replace</button>
</div>
</div>
<!-- Doc 2 -->
<div class="p-4 bg-surface-container-low rounded-lg flex flex-col justify-between gap-3">
<div class="flex items-start justify-between">
<div>
<span class="font-label-md text-label-md text-primary font-bold block"><?= get_text('admissions', 'upload_doc2_title', '2. Class 10 / Prior Marksheet') ?></span>
<span class="text-body-sm text-on-surface-variant"><?= get_text('admissions', 'upload_doc2_sub', 'Provisional web copy accepted') ?></span>
</div>
<span class="material-symbols-outlined text-emerald-600">check_circle</span>
</div>
<div class="flex items-center justify-between text-label-sm">
<span class="text-xs text-on-surface-variant">Uploaded: board_score_2024.jpg</span>
<button class="text-secondary font-bold hover:underline">Replace</button>
</div>
</div>
<!-- Doc 3 -->
<div class="p-4 bg-surface-container-low rounded-lg flex flex-col justify-between gap-3">
<div class="flex items-start justify-between">
<div>
<span class="font-label-md text-label-md text-primary font-bold block"><?= get_text('admissions', 'upload_doc3_title', '3. Student & Parent Aadhaar Card') ?></span>
<span class="text-body-sm text-on-surface-variant"><?= get_text('admissions', 'upload_doc3_sub', 'Residence proof & biometric ID') ?></span>
</div>
<span class="material-symbols-outlined text-[#C9A24B]">pending</span>
</div>
<div class="flex items-center justify-between text-label-sm">
<span class="text-xs text-secondary font-semibold">Optional at Checkout</span>
<button class="bg-primary text-on-primary px-3 py-1 rounded text-xs font-bold hover:bg-[#C9A24B] hover:text-primary transition-colors">Attach</button>
</div>
</div>
<!-- Doc 4 -->
<div class="p-4 bg-surface-container-low rounded-lg flex flex-col justify-between gap-3">
<div class="flex items-start justify-between">
<div>
<span class="font-label-md text-label-md text-primary font-bold block"><?= get_text('admissions', 'upload_doc4_title', '4. Passport Sized Photos (4)') ?></span>
<span class="text-body-sm text-on-surface-variant"><?= get_text('admissions', 'upload_doc4_sub', 'Formal school uniform or plain bg') ?></span>
</div>
<span class="material-symbols-outlined text-[#C9A24B]">cloud_upload</span>
</div>
<div class="flex items-center justify-between text-label-sm">
<span class="text-xs text-on-surface-variant">Can submit at school desk</span>
<button class="bg-surface-cream text-primary px-3 py-1 rounded text-xs font-bold hover:bg-surface-container transition-colors">Attach</button>
</div>
</div>
</div>
</div>
</div>
<!-- RIGHT COLUMN: Sticky Dynamic Checkout & Payment Box -->
<div class="lg:col-span-5 w-full sticky top-28">
<div class="bg-surface-pure rounded-2xl shadow-xl overflow-hidden">
<!-- Box Top Banner -->
<div class="bg-primary text-on-primary p-6 relative">
<div class="flex items-center justify-between">
<div>
<span class="font-eyebrow text-eyebrow text-secondary-fixed uppercase tracking-wider"><?= get_text('admissions', 'checkout_subheading', 'Session 2026–27 Enrollment') ?></span>
<h3 class="font-headline-sm text-headline-sm text-on-primary mt-1"><?= get_text('admissions', 'checkout_heading', 'Live Admission Checkout') ?></h3>
</div>
<div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-secondary-fixed text-[26px]">receipt_long</span>
</div>
</div>
<!-- Active Selected Grade Badge -->
<div class="mt-4 p-3 bg-white/10 rounded-lg backdrop-blur flex items-center justify-between">
<div class="flex items-center gap-2.5">
<span class="material-symbols-outlined text-[#C9A24B]">school</span>
<div>
<span class="text-xs text-gold-light block font-semibold">Selected Class &amp; Stream:</span>
<span class="text-sm font-bold text-white" id="summary-grade-name">Class 11 - Science (Non-Medical)</span>
</div>
</div>
<a class="text-xs text-[#C9A24B] hover:text-white font-bold underline" href="#class-cards-grid">Change</a>
</div>
</div>
<!-- Line Items Breakdown -->
<div class="p-6 flex flex-col gap-4">
<div class="text-label-sm font-bold uppercase tracking-wider text-on-surface-variant pb-2 border-b-0">
              Fee Assessment Details
            </div>
<div class="flex justify-between items-center text-body-sm">
<span class="text-on-surface-variant">Prospectus &amp; Registration Kit</span>
<span class="font-bold text-text-charcoal" id="fee-prospectus">₹200</span>
</div>
<div class="flex justify-between items-center text-body-sm">
<span class="text-on-surface-variant">Entrance &amp; Merit Profiling Fee</span>
<span class="font-bold text-text-charcoal" id="fee-processing">₹100</span>
</div>
<div class="flex justify-between items-center text-body-sm">
<div>
<span class="text-on-surface-variant block">1st Month Tuition Fee</span>
<span class="text-[11px] text-outline">Affordable monthly structure</span>
</div>
<span class="font-bold text-text-charcoal" id="fee-tuition">₹1,000</span>
</div>
<div class="flex justify-between items-center text-body-sm" id="row-transit-fee">
<span class="text-on-surface-variant">Bus Facility (Dobhi / Balsamand)</span>
<span class="font-bold text-text-charcoal" id="fee-transit">₹<?= number_format((int)get_text('admissions', 'bus_route_fare', '300')) ?></span>
</div>
<div class="flex justify-between items-center text-body-sm">
<span class="text-on-surface-variant">HBSE Affiliation &amp; Activity Fund</span>
<span class="font-bold text-text-charcoal">₹100</span>
</div>
<!-- Early Bird Coupon Applied -->
<div class="p-3 bg-gold-light rounded-lg flex items-center justify-between text-body-sm">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[20px]">local_offer</span>
<div>
<span class="font-bold text-secondary text-xs uppercase block"><?= get_text('admissions', 'discount_title', 'Special Welcome Discount') ?></span>
<span class="text-[11px] text-on-surface-variant"><?= get_text('admissions', 'discount_desc', '₹200 concession applied on 1st month') ?></span>
</div>
</div>
<span class="font-bold text-secondary" id="discount-amount-display">-₹<?= number_format((int)get_text('admissions', 'discount_val', '200')) ?></span>
</div>
<!-- Payment Switch Option: Pay Full vs Just Token -->
<div class="mt-2 p-3.5 bg-surface-container-low rounded-xl flex flex-col gap-2">
<span class="font-label-sm text-label-sm text-primary font-bold">Choose Payment Structure for Today:</span>
<div class="grid grid-cols-2 gap-2">
<label class="pay-tier-btn flex flex-col p-2.5 rounded-lg bg-surface-pure ring-2 ring-primary cursor-pointer">
<input checked="" class="hidden" name="payment_tier" type="radio" value="full">
<span class="text-xs font-bold text-primary">Full Seat + 1st Month</span>
<span class="text-sm font-bold text-primary mt-0.5" id="tier-full-amount">₹1,500</span>
<span class="text-[10px] text-emerald-700">Guarantees Section Allotment</span>
</label>
<label class="pay-tier-btn flex flex-col p-2.5 rounded-lg bg-surface-container-high/40 cursor-pointer">
<input class="hidden" name="payment_tier" type="radio" value="token">
<span class="text-xs font-bold text-on-surface">Lock Seat Token</span>
<span class="text-sm font-bold text-secondary mt-0.5" id="tier-token-amount">₹<?= number_format((int)get_text('admissions', 'token_val', '500')) ?></span>
<span class="text-[10px] text-on-surface-variant">Balance payable on session start</span>
</label>
</div>
</div>
<!-- Net Total Bar -->
<div class="mt-3 p-4 bg-primary text-on-primary rounded-xl flex items-center justify-between shadow-md">
<div>
<span class="text-xs text-gold-light uppercase tracking-wider font-semibold block">Total Amount Payable Now</span>
<span class="font-headline-sm text-headline-sm font-bold text-white" id="final-payable-amount">₹1,500</span>
</div>
<span class="text-xs text-gold-light bg-primary-container px-2.5 py-1 rounded">Tax Inclusive</span>
</div>
<!-- Payment Method Gateway Selector -->
<div class="flex flex-col gap-2.5 mt-2">
<span class="font-label-sm text-label-sm text-primary font-bold">Select Preferred Gateway Mode:</span>
<div class="grid grid-cols-3 gap-2 text-center text-xs">
<!-- UPI -->
<button class="pay-gateway-tab py-2 px-1 rounded-lg bg-surface-cream ring-1 ring-secondary font-bold text-primary flex flex-col items-center gap-1" data-gw="upi" type="button">
<span class="material-symbols-outlined text-[20px] text-[#C9A24B]">qr_code_scanner</span>
<span class="">UPI / QR</span>
</button>
<!-- Cards -->
<button class="pay-gateway-tab py-2 px-1 rounded-lg bg-surface-container-low font-semibold text-on-surface flex flex-col items-center gap-1 hover:bg-surface-container" data-gw="card" type="button">
<span class="material-symbols-outlined text-[20px] text-primary">credit_card</span>
<span class="">Debit / Credit</span>
</button>
<!-- NetBanking -->
<button class="pay-gateway-tab py-2 px-1 rounded-lg bg-surface-container-low font-semibold text-on-surface flex flex-col items-center gap-1 hover:bg-surface-container" data-gw="netbanking" type="button">
<span class="material-symbols-outlined text-[20px] text-primary">account_balance</span>
<span class="">Net Banking</span>
</button>
</div>
<!-- UPI Display details (Default Active) -->
<div class="p-3 bg-surface-container-low rounded-lg flex items-center gap-3 mt-1" id="upi-box">
<div class="w-14 h-14 bg-white rounded p-1 shadow-sm flex items-center justify-center">
<!-- Realistic Mock UPI QR Vector -->
<svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100">
<path d="M10 10h30v30h-30zM18 18v14h14v-14zM60 10h30v30h-30zM68 18v14h14v-14zM10 60h30v30h-30zM18 68v14h14v-14zM50 20h8v15h-8zM50 50h15v8h-15zM75 50h15v8h-15zM50 75h10v15h-10zM70 70h20v20h-20z"></path>
</svg>
</div>
<div class="flex flex-col text-xs text-on-surface-variant">
<span class="font-bold text-text-charcoal"><?= get_text('admissions', 'upi_instruction', 'Scan via GPay, PhonePe, Paytm or BHIM') ?></span>
<span class="">VPA: <?= get_text('admissions', 'upi_vpa', 'sunrise.dobhi@icici') ?></span>
<span class="text-emerald-700 font-semibold mt-0.5">Instant Automated Receipt on SMS</span>
</div>
</div>
</div>
<!-- Primary Action Button -->
<button class="w-full h-14 bg-[#C9A24B] hover:bg-gold-hover text-primary font-bold rounded-xl shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2 text-label-md" id="btn-submit-checkout" type="button">
<span class="material-symbols-outlined text-[22px]">lock</span>
<span class=""><?= get_text('admissions', 'checkout_cta_btn', 'Proceed to Secure Checkout & Reserve Seat →') ?></span>
</button>
<!-- Verification & Escrow Notes -->
<div class="flex flex-col gap-2 pt-2 text-center text-xs text-on-surface-variant">
<div class="flex items-center justify-center gap-4 text-[11px]">
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-[16px] text-emerald-600">verified_user</span> 256-Bit SSL
                </span>
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-[16px] text-emerald-600">account_balance_wallet</span> RBI &amp; NPCI Compliant
                </span>
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-[16px] text-emerald-600">published_with_changes</span> 100% Refundable *
                </span>
</div>
<p class="text-[11px] text-outline leading-tight">
                <?= get_text('admissions', 'checkout_refund_note', '* Note: If entrance assessment is not cleared, 100% tuition and seat advance is refunded within 7 working days to source bank.') ?>
              </p>
</div>
</div>
</div>
<!-- Admissions Help Desk Micro-Widget -->
<div class="mt-4 p-4 bg-surface-cream rounded-xl flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary text-[24px]">support_agent</span>
<div class="text-xs">
<span class="font-bold text-primary block"><?= get_text('admissions', 'checkout_help_text', 'Facing issues with online payment?') ?></span>
<span class="text-on-surface-variant"><?= get_text('admissions', 'checkout_help_phone', 'Direct Help Desk: +91 70158 90094 / +91 79883 5710') ?></span>
</div>
</div>
<a class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-bold flex items-center gap-1" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', get_text('admissions', 'help_whatsapp', '917015890094')) ?>" target="_blank">
<span class="material-symbols-outlined text-[14px]">chat</span> WhatsApp
          </a>
</div>
</div>
</div>
</section>
<!-- Class-wise Fee Structure & Eligibility Matrix Table -->
<section class="py-16 px-6 lg:px-12 bg-surface-container-low">
  <div class="max-w-7xl mx-auto flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <span class="font-eyebrow text-eyebrow text-secondary uppercase tracking-wider"><?= get_text('admissions', 'fee_matrix_eyebrow', 'Transparent Fee Schedule') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('admissions', 'fee_matrix_heading', 'Class-wise Academic Year Matrix (2026–27)') ?></h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1"><?= get_text('admissions', 'fee_matrix_desc', 'No hidden charges. Highly affordable monthly tuition (₹600 – ₹1,000 / month) with concessions for merit scholars and siblings.') ?></p>
      </div>
      <a href="<?= htmlspecialchars(get_text('admissions', 'prospectus_pdf_url', '#')) ?>" class="inline-flex items-center gap-2 bg-surface-pure hover:bg-surface-cream text-primary px-5 py-3 rounded-lg shadow-sm font-label-md font-bold transition-colors self-start md:self-auto">
        <span class="material-symbols-outlined text-[#C9A24B]">download</span> <?= get_text('admissions', 'prospectus_pdf_text', 'Download Official Fee Prospectus PDF') ?>
      </a>
    </div>

    <!-- Schedule Table -->
    <div class="overflow-x-auto bg-surface-pure rounded-xl shadow-md">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-primary text-on-primary text-label-sm font-bold uppercase tracking-wider">
            <th class="py-4 px-6">Class Wing</th>
            <th class="py-4 px-6">Age Cut-off (As of 31 Mar)</th>
            <th class="py-4 px-6">Registration Fee</th>
            <th class="py-4 px-6">Monthly Tuition</th>
            <th class="py-4 px-6">Lab / Tech / Sports</th>
            <th class="py-4 px-6 text-right">Annual Estimated Fee</th>
          </tr>
        </thead>
        <tbody class="divide-y-0 text-body-md text-text-charcoal font-medium">
          <tr class="hover:bg-surface-container-low transition-colors">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-secondary"></span> Pre-Primary (Nursery, KG)
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c1_age', '3 to 5 Years') ?></td>
            <td class="py-4 px-6">₹<?= get_text('admissions', 'c1_reg_fee', '200') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c1_monthly_fee', '600') ?> / mo</td>
            <td class="py-4 px-6">₹400 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-primary">₹<?= get_text('admissions', 'table_r1_annual', '7,800') ?></td>
          </tr>
          <tr class="bg-surface-container-low/40 hover:bg-surface-container-low transition-colors">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-secondary"></span> Primary (Class 1 to 5)
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c2_age', '5 to 10 Years') ?></td>
            <td class="py-4 px-6">₹<?= get_text('admissions', 'c2_reg_fee', '200') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c2_monthly_fee', '700') ?> / mo</td>
            <td class="py-4 px-6">₹500 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-primary">₹<?= get_text('admissions', 'table_r2_annual', '9,100') ?></td>
          </tr>
          <tr class="hover:bg-surface-container-low transition-colors">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-secondary"></span> Middle School (Class 6 to 8)
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c4_age', '10 to 13 Years') ?></td>
            <td class="py-4 px-6">₹<?= get_text('admissions', 'c4_reg_fee', '200') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c4_monthly_fee', '800') ?> / mo</td>
            <td class="py-4 px-6">₹600 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-primary">₹<?= get_text('admissions', 'table_r3_annual', '10,400') ?></td>
          </tr>
          <tr class="bg-surface-container-low/40 hover:bg-surface-container-low transition-colors">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-[#C9A24B]"></span> Secondary (Class 9 &amp; 10)
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c5_age', '13 to 15 Years') ?></td>
            <td class="py-4 px-6">₹<?= get_text('admissions', 'c5_reg_fee', '250') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c5_monthly_fee', '900') ?> / mo</td>
            <td class="py-4 px-6">₹800 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-primary">₹<?= get_text('admissions', 'table_r4_annual', '11,850') ?></td>
          </tr>
          <tr class="hover:bg-surface-container-low transition-colors bg-surface-cream/50">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-[#C9A24B]"></span> Senior Sec: Science (Medical / Non-Med)
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c7_age', '15 to 17 Years') ?></td>
            <td class="py-4 px-6 font-bold text-secondary">₹<?= get_text('admissions', 'c7_reg_fee', '300') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c7_monthly_fee', '1,000') ?> / mo</td>
            <td class="py-4 px-6">₹1,000 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-secondary">₹<?= get_text('admissions', 'table_r5_annual', '13,300') ?></td>
          </tr>
          <tr class="bg-surface-container-low/40 hover:bg-surface-container-low transition-colors">
            <td class="py-4 px-6 font-bold text-primary flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-[#C9A24B]"></span> Senior Sec: Commerce &amp; Humanities
            </td>
            <td class="py-4 px-6 text-on-surface-variant"><?= get_text('admissions', 'c8_age', '15 to 17 Years') ?></td>
            <td class="py-4 px-6">₹<?= get_text('admissions', 'c8_reg_fee', '300') ?></td>
            <td class="py-4 px-6 font-bold text-primary">₹<?= get_text('admissions', 'c8_monthly_fee', '950') ?> / mo</td>
            <td class="py-4 px-6">₹800 / yr</td>
            <td class="py-4 px-6 text-right font-bold text-primary">₹<?= get_text('admissions', 'table_r6_annual', '12,500') ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Notes and Concessions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="p-4 bg-surface-pure rounded-lg shadow-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[#C9A24B] text-[24px]">military_tech</span>
        <div class="text-xs">
          <span class="font-bold text-primary block"><?= get_text('admissions', 'scheme1_title', 'Merit Scholarship (HBSE 90%+)') ?></span>
          <span class="text-on-surface-variant"><?= get_text('admissions', 'scheme1_desc', 'Up to 25% waiver on monthly tuition fees for students scoring above 90% in prior board exams.') ?></span>
        </div>
      </div>
      <div class="p-4 bg-surface-pure rounded-lg shadow-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[#C9A24B] text-[24px]">diversity_1</span>
        <div class="text-xs">
          <span class="font-bold text-primary block"><?= get_text('admissions', 'scheme2_title', 'Sibling Concession Scheme') ?></span>
          <span class="text-on-surface-variant"><?= get_text('admissions', 'scheme2_desc', '15% discount on monthly tuition fees for the second biological child studying concurrently in school.') ?></span>
        </div>
      </div>
      <div class="p-4 bg-surface-pure rounded-lg shadow-sm flex items-start gap-3">
        <span class="material-symbols-outlined text-[#C9A24B] text-[24px]">workspace_premium</span>
        <div class="text-xs">
          <span class="font-bold text-primary block"><?= get_text('admissions', 'scheme3_title', 'Defence & Police Personnel') ?></span>
          <span class="text-on-surface-variant"><?= get_text('admissions', 'scheme3_desc', 'Special educational welfare concession of ₹300 / month for children of armed service personnel.') ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Admission Guidelines, Required Documents & FAQs -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto w-full">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    <!-- Left: Checklist & Protocol -->
    <div class="lg:col-span-5 flex flex-col gap-6">
      <div>
        <span class="font-eyebrow text-eyebrow text-secondary uppercase tracking-wider"><?= get_text('admissions', 'docs_eyebrow', 'Verification Standards') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('admissions', 'docs_heading', 'Required Documents & Eligibility') ?></h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1"><?= get_text('admissions', 'docs_desc', 'Carry original copies during document physical verification at Dobhi campus.') ?></p>
      </div>
      <div class="bg-surface-pure rounded-xl p-6 shadow-sm flex flex-col gap-4">
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">task_alt</span>
          <div class="text-body-sm">
            <span class="font-bold text-primary block"><?= get_text('admissions', 'doc1_title', 'Original Transfer Certificate (TC)') ?></span>
            <span class="text-on-surface-variant"><?= get_text('admissions', 'doc1_desc', 'Countersigned by District Education Officer (if transferring from other state board).') ?></span>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">task_alt</span>
          <div class="text-body-sm">
            <span class="font-bold text-primary block"><?= get_text('admissions', 'doc2_title', 'Municipal Birth Certificate') ?></span>
            <span class="text-on-surface-variant"><?= get_text('admissions', 'doc2_desc', 'Mandatory for Nursery to Class 1 admissions for proof of age cut-off.') ?></span>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">task_alt</span>
          <div class="text-body-sm">
            <span class="font-bold text-primary block"><?= get_text('admissions', 'doc3_title', 'Aadhaar Card (Student & Both Parents)') ?></span>
            <span class="text-on-surface-variant"><?= get_text('admissions', 'doc3_desc', 'Clear photocopy for Haryana Parivar Pehchan Patra (PPP) linkage.') ?></span>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">task_alt</span>
          <div class="text-body-sm">
            <span class="font-bold text-primary block"><?= get_text('admissions', 'doc4_title', 'Recent Passport-Size Photographs') ?></span>
            <span class="text-on-surface-variant"><?= get_text('admissions', 'doc4_desc', '4 copies of student and 2 joint photos with mother and father.') ?></span>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <span class="material-symbols-outlined text-secondary text-[22px] mt-0.5">task_alt</span>
          <div class="text-body-sm">
            <span class="font-bold text-primary block"><?= get_text('admissions', 'doc5_title', 'Caste / Category Certificate (If Applicable)') ?></span>
            <span class="text-on-surface-variant"><?= get_text('admissions', 'doc5_desc', 'SC/ST/OBC/EWS certificate issued by competent Tehsildar or SDM authority.') ?></span>
          </div>
        </div>
      </div>

      <!-- Campus Tour Micro-Prompt -->
      <div class="p-6 bg-surface-cream rounded-xl shadow-sm flex items-center justify-between">
        <div>
          <h4 class="font-headline-sm text-headline-sm text-primary"><?= get_text('admissions', 'tour_box_title', 'Prefer an In-Person Campus Tour?') ?></h4>
          <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5"><?= get_text('admissions', 'tour_box_desc', 'Visit Dobhi campus Monday to Saturday between 9:00 AM – 2:30 PM.') ?></p>
        </div>
        <a href="<?= htmlspecialchars(get_text('admissions', 'tour_box_link', 'contact.php')) ?>" class="bg-primary hover:bg-[#C9A24B] hover:text-primary text-on-primary px-4 py-2.5 rounded-lg text-label-sm font-bold transition-all shrink-0 inline-block text-center">
          <?= get_text('admissions', 'tour_box_btn', 'Book Visit') ?>
        </a>
      </div>
    </div>

    <!-- Right: Interactive FAQ Accordion -->
    <div class="lg:col-span-7 flex flex-col gap-4">
      <div>
        <span class="font-eyebrow text-eyebrow text-secondary uppercase tracking-wider"><?= get_text('admissions', 'faq_eyebrow', "Parents' FAQ Desk") ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mt-1"><?= get_text('admissions', 'faq_heading', 'Frequently Asked Admission Questions') ?></h2>
      </div>

      <!-- FAQ Item 1 -->
      <div class="faq-accordion-item bg-surface-pure rounded-xl p-5 shadow-sm transition-all">
        <button class="faq-trigger w-full flex items-center justify-between text-left font-headline-sm text-headline-sm text-primary">
          <span><?= get_text('admissions', 'faq1_q', 'What happens immediately after paying the admission checkout fee?') ?></span>
          <span class="material-symbols-outlined text-secondary transition-transform faq-arrow">expand_more</span>
        </button>
        <div class="faq-content mt-3 text-body-md text-on-surface-variant">
          <?= get_text('admissions', 'faq1_a', 'You will receive an automated SMS and WhatsApp confirmation containing the provisional Student Enrolment ID, downloadable fee receipt PDF, and scheduled date for the baseline interaction/diagnostic test at Sun Rise Sr. Sec. School, Dobhi.') ?>
        </div>
      </div>

      <!-- FAQ Item 2 -->
      <div class="faq-accordion-item bg-surface-pure rounded-xl p-5 shadow-sm transition-all">
        <button class="faq-trigger w-full flex items-center justify-between text-left font-headline-sm text-headline-sm text-primary">
          <span><?= get_text('admissions', 'faq2_q', 'Can we pay the monthly tuition fee easily online or at school?') ?></span>
          <span class="material-symbols-outlined text-secondary transition-transform faq-arrow">expand_more</span>
        </button>
        <div class="faq-content mt-3 text-body-md text-on-surface-variant">
          <?= get_text('admissions', 'faq2_a', 'Yes. Monthly tuition fees (around ₹600 to ₹1,000 / month) can be paid through UPI QR, net banking, debit/credit cards, or directly at the school cash counter by the 10th of every month.') ?>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="faq-accordion-item bg-surface-pure rounded-xl p-5 shadow-sm transition-all">
        <button class="faq-trigger w-full flex items-center justify-between text-left font-headline-sm text-headline-sm text-primary">
          <span><?= get_text('admissions', 'faq3_q', 'How are Science/Commerce streams allocated in Class 11?') ?></span>
          <span class="material-symbols-outlined text-secondary transition-transform faq-arrow">expand_more</span>
        </button>
        <div class="faq-content mt-3 text-body-md text-on-surface-variant">
          <?= get_text('admissions', 'faq3_a', 'Science (Medical & Non-Medical) stream requires an aggregate minimum of 60% in Class 10 Board examinations with strong interest in Science & Mathematics. Commerce and Humanities are allotted based on student preference and aptitude evaluation.') ?>
        </div>
      </div>

      <!-- FAQ Item 4 -->
      <div class="faq-accordion-item bg-surface-pure rounded-xl p-5 shadow-sm transition-all">
        <button class="faq-trigger w-full flex items-center justify-between text-left font-headline-sm text-headline-sm text-primary">
          <span><?= get_text('admissions', 'faq4_q', 'Which villages are covered under the Dobhi bus transit network?') ?></span>
          <span class="material-symbols-outlined text-secondary transition-transform faq-arrow">expand_more</span>
        </button>
        <div class="faq-content mt-3 text-body-md text-on-surface-variant">
          <?= get_text('admissions', 'faq4_a', 'Our GPS-enabled bus network covers: Dobhi, Balsamand, Arya Nagar, Rawalwas Kalan, Rawalwas Khurd, Bandaheri, Chaudhariwas, Muklan, Mirzapur, and major rural arterial stops within a 22 km radius. Female attendants accompany all pre-primary and junior bus routes.') ?>
        </div>
      </div>

      <!-- FAQ Item 5 -->
      <div class="faq-accordion-item bg-surface-pure rounded-xl p-5 shadow-sm transition-all">
        <button class="faq-trigger w-full flex items-center justify-between text-left font-headline-sm text-headline-sm text-primary">
          <span><?= get_text('admissions', 'faq5_q', 'Is the registration fee refundable if we decide to withdraw?') ?></span>
          <span class="material-symbols-outlined text-secondary transition-transform faq-arrow">expand_more</span>
        </button>
        <div class="faq-content mt-3 text-body-md text-on-surface-variant">
          <?= get_text('admissions', 'faq5_a', 'If the student does not qualify in the assessment test or if a transfer posting is documented prior to April 1st, all deposited advance tuition fees and security deposits are 100% refundable without deductions. The application prospectus fee (₹200) covers processing administrative overheads.') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Direct Admissions Helpline & Support Banner -->
<section class="py-12 px-6 lg:px-12 bg-primary text-on-primary">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="flex items-center gap-5">
      <div class="w-16 h-16 rounded-2xl bg-primary-container flex items-center justify-center shrink-0">
        <span class="material-symbols-outlined text-[#C9A24B] text-[32px]">headset_mic</span>
      </div>
      <div>
        <span class="text-xs font-bold text-secondary-fixed uppercase tracking-wider"><?= get_text('admissions', 'help_eyebrow', 'Admissions Directorate – Dobhi Campus') ?></span>
        <h3 class="font-headline-sm text-headline-sm text-white"><?= get_text('admissions', 'help_heading', 'Need Assistance with Online Admissions?') ?></h3>
        <p class="font-body-sm text-body-sm text-on-primary-container mt-1"><?= get_text('admissions', 'help_desc', 'Our administrative office is open Monday to Saturday (Summer: 7:30 AM to 1:30 PM | Winter: 8:30 AM to 2:30 PM) to assist parents with document verification, fee concessions, and transport routes.') ?></p>
      </div>
    </div>
    <div class="flex flex-wrap items-center gap-4">
      <a class="px-6 h-12 rounded-lg bg-surface-pure hover:bg-surface-cream text-primary font-label-md font-bold flex items-center gap-2 shadow-md transition-colors" href="tel:<?= urlencode(get_text('admissions', 'help_phone', '+91 70158 90094')) ?>">
        <span class="material-symbols-outlined text-[18px]">call</span>
        <span><?= get_text('admissions', 'help_phone', '+91 70158 90094') ?></span>
      </a>
      <a class="px-6 h-12 rounded-lg bg-[#C9A24B] hover:bg-gold-hover text-primary font-label-md font-bold flex items-center gap-2 shadow-md transition-colors" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', get_text('admissions', 'help_whatsapp', '917015890094')) ?>" target="_blank">
        <span class="material-symbols-outlined text-[18px]">chat</span>
        <span>WhatsApp Chat</span>
      </a>
    </div>
  </div>
</section>

<!-- Interactive Client Logic (Selection, Calculation, Gateways & Checkout Confirmation) -->
<script>
    (function() {
      // Data State
      const defaultTransitCost = <?= (int)preg_replace('/[^0-9]/', '', get_text('admissions', 'bus_route_fare', '300')) ?>;
      const defaultTokenVal = <?= (int)preg_replace('/[^0-9]/', '', get_text('admissions', 'token_val', '500')) ?>;

      const state = {
        gradeId: 'xi-nonmed',
        gradeName: <?= json_encode(get_text('admissions', 'c7_name', 'Class 11 - Science (Non-Medical)')) ?>,
        regFee: <?= (int)preg_replace('/[^0-9]/', '', get_text('admissions', 'c7_reg_fee', '300')) ?>,
        tuitionFee: <?= (int)preg_replace('/[^0-9]/', '', get_text('admissions', 'c7_monthly_fee', '1000')) ?>,
        transitFee: defaultTransitCost,
        discount: <?= (int)preg_replace('/[^0-9]/', '', get_text('admissions', 'discount_val', '200')) ?>,
        fixedAffiliation: 100,
        payTier: 'full', // 'full' or 'token'
        gateway: 'upi'
      };

      // Elements
      const summaryGradeName = document.getElementById('summary-grade-name');
      const feeProspectus = document.getElementById('fee-prospectus');
      const feeProcessing = document.getElementById('fee-processing');
      const feeTuition = document.getElementById('fee-tuition');
      const feeTransit = document.getElementById('fee-transit');
      const rowTransit = document.getElementById('row-transit-fee');
      const finalPayable = document.getElementById('final-payable-amount');
      const tierFullAmount = document.getElementById('tier-full-amount');
      const tierTokenAmount = document.getElementById('tier-token-amount');
      const btnCheckout = document.getElementById('btn-submit-checkout');

      function calculateTotal() {
        const fullTotal = state.regFee + state.tuitionFee + state.transitFee + state.fixedAffiliation - state.discount;
        const tokenTotal = defaultTokenVal || (state.regFee + 200);
        tierFullAmount.textContent = '₹' + fullTotal.toLocaleString('en-IN');
        tierTokenAmount.textContent = '₹' + tokenTotal.toLocaleString('en-IN');

        if (state.payTier === 'full') {
          finalPayable.textContent = '₹' + fullTotal.toLocaleString('en-IN');
        } else {
          finalPayable.textContent = '₹' + tokenTotal.toLocaleString('en-IN');
        }
      }

      function updateCardSelection(selectedCard) {
        document.querySelectorAll('.grade-card').forEach(card => {
          card.classList.remove('ring-2', 'ring-[#C9A24B]', 'shadow-md');
          card.classList.add('shadow-sm');
          const radio = card.querySelector('input[type="radio"]');
          if (radio) radio.checked = false;
          const badge = card.querySelector('.selected-indicator');
          if (badge) badge.remove();
          const radioIcon = card.querySelector('.material-symbols-outlined:last-child');
          if (radioIcon) {
            radioIcon.textContent = 'radio_button_unchecked';
            radioIcon.classList.remove('text-[#C9A24B]');
            radioIcon.classList.add('text-outline-variant');
          }
        });

        selectedCard.classList.add('ring-2', 'ring-[#C9A24B]', 'shadow-md');
        selectedCard.classList.remove('shadow-sm');
        const activeRadio = selectedCard.querySelector('input[type="radio"]');
        if (activeRadio) activeRadio.checked = true;

        const activeIcon = selectedCard.querySelector('.material-symbols-outlined:last-child');
        if (activeIcon) {
          activeIcon.textContent = 'check_circle';
          activeIcon.classList.add('text-[#C9A24B]');
          activeIcon.classList.remove('text-outline-variant');
        }

        // Update state
        state.gradeId = selectedCard.getAttribute('data-grade-id');
        state.gradeName = selectedCard.getAttribute('data-grade-name');
        state.regFee = parseInt(selectedCard.getAttribute('data-reg-fee') || '200', 10);
        state.tuitionFee = parseInt(selectedCard.getAttribute('data-tuition-fee') || '1000', 10);

        // Update Summary texts
        summaryGradeName.textContent = state.gradeName;
        feeTuition.textContent = '₹' + state.tuitionFee.toLocaleString('en-IN');
        feeProspectus.textContent = '₹' + (state.regFee >= 300 ? '200' : '150');
        feeProcessing.textContent = '₹' + (state.regFee >= 300 ? (state.regFee - 200) : '50');

        calculateTotal();
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
            b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
            b.classList.add('text-on-surface-variant');
          });
          this.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');
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
            c.classList.remove('bg-surface-cream', 'ring-2', 'ring-[#C9A24B]');
            c.classList.add('bg-surface-container-low');
          });
          parentCard.classList.add('bg-surface-cream', 'ring-2', 'ring-[#C9A24B]');
          parentCard.classList.remove('bg-surface-container-low');

          if (this.value === 'dobhi-bus') {
            state.transitFee = defaultTransitCost;
            rowTransit.style.display = 'flex';
            if (villageDropdown) villageDropdown.style.display = 'flex';
          } else {
            state.transitFee = 0;
            rowTransit.style.display = 'none';
            if (villageDropdown) villageDropdown.style.display = 'none';
          }
          calculateTotal();
        });
      });

      // Pay Tier Selection (Full vs Token)
      const payTierCards = document.querySelectorAll('.pay-tier-btn');
      payTierCards.forEach(card => {
        card.addEventListener('click', function() {
          payTierCards.forEach(c => {
            c.classList.remove('bg-surface-pure', 'ring-2', 'ring-primary');
            c.classList.add('bg-surface-container-high/40');
          });
          this.classList.add('bg-surface-pure', 'ring-2', 'ring-primary');
          this.classList.remove('bg-surface-container-high/40');

          const radio = this.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
            state.payTier = radio.value;
            calculateTotal();
          }
        });
      });

      // Gateway Modes
      const gwTabs = document.querySelectorAll('.pay-gateway-tab');
      const upiBox = document.getElementById('upi-box');
      gwTabs.forEach(tab => {
        tab.addEventListener('click', function() {
          gwTabs.forEach(t => {
            t.classList.remove('bg-surface-cream', 'ring-1', 'ring-secondary', 'font-bold');
            t.classList.add('bg-surface-container-low');
          });
          this.classList.add('bg-surface-cream', 'ring-1', 'ring-secondary', 'font-bold');
          this.classList.remove('bg-surface-container-low');
          state.gateway = this.getAttribute('data-gw');

          if (upiBox) {
            if (state.gateway === 'upi') {
              upiBox.style.display = 'flex';
            } else {
              upiBox.style.display = 'none';
            }
          }
        });
      });

      // FAQ Accordion
      document.querySelectorAll('.faq-trigger').forEach(trigger => {
        trigger.addEventListener('click', function() {
          const item = this.closest('.faq-accordion-item');
          const content = item.querySelector('.faq-content');
          const arrow = this.querySelector('.faq-arrow');
          const isHidden = content.style.display === 'none' || !content.style.display;

          if (isHidden) {
            content.style.display = 'block';
            arrow.style.transform = 'rotate(180deg)';
          } else {
            content.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
          }
        });
      });

      // Checkout Button Action
      if (btnCheckout) {
        btnCheckout.addEventListener('click', function() {
          const studentName = document.getElementById('input_student_name').value || 'Student';
          const originalText = btnCheckout.innerHTML;
          btnCheckout.disabled = true;
          btnCheckout.innerHTML = '<span class="material-symbols-outlined animate-spin text-[22px]">progress_activity</span> <span>Securing Dobhi HBSE Seat...</span>';

          setTimeout(() => {
            btnCheckout.innerHTML = '<span class="material-symbols-outlined text-emerald-800 text-[24px]">verified</span> <span class="text-primary font-bold">Provisional Seat Booked Successfully!</span>';
            btnCheckout.classList.remove('bg-[#C9A24B]', 'text-primary');
            btnCheckout.classList.add('bg-emerald-400');

            alert('Enrolment Confirmation for Sun Rise Sr. Sec. School, Dobhi:\n\n' +
                  'Applicant: ' + studentName + '\n' +
                  'Grade: ' + state.gradeName + '\n' +
                  'Amount Paid: ' + finalPayable.textContent + '\n\n' +
                  'Provisional Seat Token #SRS-2026-' + Math.floor(100000 + Math.random() * 900000) + ' has been locked. Receipt sent to registered WhatsApp & Email.');
          }, 1200);
        });
      }

      // Initial run
      calculateTotal();
    })();
  </script>

</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
