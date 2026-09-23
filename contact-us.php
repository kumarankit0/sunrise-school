<?php
$current_page = 'contact';
$page_title = 'Contact Us | Campus Office & Admissions';
$page_description = 'Get in touch with Sun Rise Sr. Sec. School, Dobhi (Hisar, Haryana). Find campus directions, office hours, direct helpline numbers, and online contact form.';
$page_keywords = 'contact Sun Rise School, Dobhi Hisar school contact, school phone number, campus location, admission inquiry';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 bg-primary px-4 sm:px-6 lg:px-12 text-on-primary overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('contact', 'hero_banner', school_img('school3.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/40 via-primary/20 to-primary/60"></div>
    <div class="hero-content max-w-5xl w-full mx-auto relative z-10 flex flex-col items-center text-center gap-4 sm:gap-6">
      <span class="hero-badge text-gold-light uppercase tracking-widest font-bold bg-black/45 border border-[#C9A24B]/60 px-4 py-1.5 sm:px-6 sm:py-2 rounded-full shadow-lg text-xs sm:text-sm">
        <?= get_text('contact', 'hero_badge', 'Get in Touch') ?>
      </span>
      <h1 class="hero-heading font-headline-lg font-bold tracking-tight text-white w-full max-w-4xl drop-shadow-lg text-2xl sm:text-4xl lg:text-5xl leading-tight">
        <?= get_text('contact', 'hero_title', 'Connect with Sun Rise School') ?>
      </h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl drop-shadow text-sm sm:text-base lg:text-lg leading-relaxed">
        <?= get_text('contact', 'hero_subtitle', 'We welcome parents, prospective students, and guardians to visit our campus or get in touch for admissions, bus routes, and general inquiries.') ?>
      </p>

      <!-- Quick Contact Pills -->
      <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3.5 mt-2">
        <?php if ($pill1 = get_text('contact', 'hero_pill1_text', 'Dobhi, Hisar (Haryana)')): ?>
          <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs sm:text-sm font-medium text-white shadow-sm">
            <span class="material-symbols-outlined text-[#C9A24B] text-[18px]">location_on</span>
            <span><?= htmlspecialchars($pill1) ?></span>
          </div>
        <?php endif; ?>
        <?php if ($pill2 = get_text('contact', 'hero_pill2_text', '+91 70158 90094')): ?>
          <a href="tel:<?= preg_replace('/[^0-9+]/', '', $pill2) ?>" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs sm:text-sm font-medium text-white hover:bg-white/20 transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[#C9A24B] text-[18px]">call</span>
            <span><?= htmlspecialchars($pill2) ?></span>
          </a>
        <?php endif; ?>
        <?php if ($pill3 = get_text('contact', 'hero_pill3_text', 'Mon–Sat: 8:00 AM – 2:30 PM')): ?>
          <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs sm:text-sm font-medium text-white shadow-sm">
            <span class="material-symbols-outlined text-[#C9A24B] text-[18px]">schedule</span>
            <span><?= htmlspecialchars($pill3) ?></span>
          </div>
        <?php endif; ?>
      </div>

      <!-- Hero CTA Button -->
      <?php if ($hero_btn = get_text('contact', 'hero_btn_text', 'Send an Online Message')): ?>
        <div class="mt-2">
          <a href="<?= htmlspecialchars(get_text('contact', 'hero_btn_link', '#inquiry-form')) ?>" class="btn-gold inline-flex items-center gap-2 px-6 py-3 text-sm sm:text-base font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
            <span><?= htmlspecialchars($hero_btn) ?></span>
            <span class="material-symbols-outlined text-[20px]">arrow_downward</span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Main Content Layout (Form & Campus Office Info) -->
  <section id="inquiry-form" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14 sm:py-20 w-full scroll-mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
      <!-- Left Column: Contact Form (Elevated Card) -->
      <div class="lg:col-span-7 bg-surface-pure p-6 sm:p-10 lg:p-12 rounded-2xl shadow-sm relative border border-border-warm">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-[#C9A24B] rounded-t-2xl"></div>
        <div class="mb-8">
          <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-2 block font-bold tracking-wider">
            <?= get_text('contact', 'form_eyebrow', 'Inquiry Desk') ?>
          </span>
          <h2 class="text-xl sm:text-2xl lg:text-3xl font-headline-lg font-bold text-primary tracking-tight leading-snug">
            <?= get_text('contact', 'form_heading', 'Send Us a Message') ?>
          </h2>
          <p class="font-body-md text-on-surface-variant mt-2 text-sm sm:text-base leading-relaxed">
            <?= get_text('contact', 'form_desc', 'Fill out the quick form below and our administrative team will respond to your queries promptly.') ?>
          </p>
        </div>

        <?php
          $success_msg = get_text('contact', 'form_success_msg', 'Thank you for reaching out to Sun Rise Sr. Sec. School. Your message has been received by our office desk and we will contact you shortly.');
        ?>
        <form class="space-y-5 sm:space-y-6" onsubmit="event.preventDefault(); alert(<?= json_encode($success_msg) ?>); this.reset();">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold text-sm" for="fullName">Your Full Name <span class="text-error">*</span></label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-sm focus:outline-none focus:border-primary transition-colors" id="fullName" placeholder="e.g. Ramesh Kumar" required="" type="text"/>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold text-sm" for="email">Email Address</label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-sm focus:outline-none focus:border-primary transition-colors" id="email" placeholder="e.g. ramesh@example.com" type="email"/>
            </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold text-sm" for="phone">Phone Number <span class="text-error">*</span></label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-sm focus:outline-none focus:border-primary transition-colors" id="phone" placeholder="+91 70158 90094" required="" type="tel"/>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold text-sm" for="department">Inquiry Type</label>
              <select class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-sm focus:outline-none focus:border-primary transition-colors cursor-pointer" id="department">
                <option>Admissions (Nursery to 12th)</option>
                <option>School Bus &amp; Transport Routes</option>
                <option>Fee Structure &amp; Concessions</option>
                <option>Faculty / Career Opportunities</option>
                <option>General Administration &amp; Appointments</option>
              </select>
            </div>
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-primary font-bold text-sm" for="message">Message / Details <span class="text-error">*</span></label>
            <textarea class="p-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-sm focus:outline-none focus:border-primary transition-colors resize-none leading-relaxed" id="message" placeholder="Please mention student's current class, residential village/city, and any specific questions you have..." required="" rows="5"></textarea>
          </div>
          <button class="btn-gold w-full text-center h-13 sm:h-14 font-bold text-base flex items-center justify-center gap-2 rounded-xl shadow-md hover:shadow-lg transition-all" type="submit">
            <span><?= htmlspecialchars(get_text('contact', 'form_btn_text', 'Submit Message')) ?></span>
            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
          </button>
        </form>
      </div>

      <!-- Right Column: Contact Details, Map & Locations -->
      <div class="lg:col-span-5 flex flex-col gap-8">
        <!-- Contact Info Card -->
        <div class="bg-surface-container-low p-6 sm:p-8 rounded-2xl relative shadow-sm border border-border-warm">
          <h3 class="font-headline-sm text-primary font-bold mb-6 flex items-center gap-2.5 text-lg sm:text-xl">
            <span class="material-symbols-outlined text-[#C9A24B]">location_city</span>
            <span><?= get_text('contact', 'info_card_title', 'Campus Information') ?></span>
          </h3>
          <div class="space-y-5 sm:space-y-6">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold text-sm"><?= get_text('contact', 'info_address_title', 'School Address') ?></h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5 text-xs sm:text-sm leading-relaxed"><?= htmlspecialchars($site_address) ?></p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <span class="material-symbols-outlined text-primary text-[20px]">call</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold text-sm"><?= get_text('contact', 'info_phone_title', 'Office Helpline') ?></h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5 flex flex-col gap-1 text-xs sm:text-sm">
                  <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_phone) ?></a>
                  <?php if (!empty($site_phone_alt)): ?>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone_alt) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_phone_alt) ?></a>
                  <?php endif; ?>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <span class="material-symbols-outlined text-primary text-[20px]">mail</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold text-sm"><?= get_text('contact', 'info_email_title', 'Official Email') ?></h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5 text-xs sm:text-sm">
                  <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_email) ?></a>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <span class="material-symbols-outlined text-primary text-[20px]">schedule</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold text-sm"><?= get_text('contact', 'timing_title', 'School & Office Timings') ?></h4>
                <div class="font-body-sm text-on-surface-variant mt-1 flex flex-col gap-1 text-xs sm:text-sm">
                  <div><strong><?= htmlspecialchars(get_text('contact', 'timing_summer', 'Summer Season: 7:30 AM – 1:30 PM')) ?></strong></div>
                  <div><strong><?= htmlspecialchars(get_text('contact', 'timing_winter', 'Winter Season: 8:30 AM – 2:30 PM')) ?></strong></div>
                  <div class="text-xs text-on-surface-variant/80 mt-0.5 italic"><?= htmlspecialchars(get_text('contact', 'timing_days', 'Visiting Days: Monday to Saturday (Sunday Closed)')) ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Campus Image Card -->
        <div class="w-full h-60 sm:h-64 rounded-2xl overflow-hidden shadow-sm relative border border-border-warm cursor-pointer group" onclick="openLightbox(this)">
          <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= get_image('contact', 'campus_photo', school_img('school2.webp')) ?>')"></div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
          <div class="absolute bottom-3 left-3 bg-surface/95 backdrop-blur-md px-3.5 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-primary shadow-sm flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[#C9A24B] text-[16px]">domain</span>
            <span><?= htmlspecialchars(get_text('contact', 'campus_caption', 'Sun Rise Campus View, Dobhi')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Departmental Desks Section (4 Direct Contacts) -->
  <section class="relative w-full py-16 sm:py-24 px-4 sm:px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" style="background-color: #F7EFE8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.10) 0%, transparent 42%), radial-gradient(circle at 85% 80%, rgba(184, 134, 102, 0.09) 0%, transparent 46%);">
    <!-- Subtle Warm Nude Geometric / Academic Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#8d6e53 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(141, 110, 83, 0.06) 1px, transparent 1px), linear-gradient(to bottom, rgba(141, 110, 83, 0.06) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Soft Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#e8d5c4]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-[#C9A24B]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-2 block font-bold tracking-wider">
          <?= htmlspecialchars(get_text('contact', 'desks_eyebrow', 'Direct Helplines')) ?>
        </span>
        <h2 class="text-xl sm:text-3xl font-headline-lg font-bold text-primary tracking-tight">
          <?= htmlspecialchars(get_text('contact', 'desks_heading', 'Key Departmental Contacts')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Desk 1: Admissions -->
        <div class="bg-[#EFF6FF] p-6 rounded-2xl border border-[#BFDBFE] hover:border-[#2563EB] shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#3B82F6] to-[#1D4ED8] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">school</span>
              </div>
              <span class="text-[10px] sm:text-[11px] font-bold text-[#1E40AF] bg-[#DBEAFE] px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#BFDBFE]">
                <?= htmlspecialchars(get_text('contact', 'desk1_role', 'Admission Counselor Cell')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#1E3A8A] text-base sm:text-lg mb-2">
              <?= htmlspecialchars(get_text('contact', 'desk1_name', 'Admissions & Student Enrollment')) ?>
            </h3>
            <p class="text-xs text-[#1E40AF]/80 flex items-center gap-1.5 mb-4">
              <span class="material-symbols-outlined text-[16px] text-[#2563EB]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk1_timing', '8:00 AM – 2:30 PM (Mon–Sat)')) ?></span>
            </p>
          </div>
          <div class="pt-4 border-t border-[#DBEAFE]">
            <?php $d1_contact = get_text('contact', 'desk1_contact', '+91 70158 90094'); ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d1_contact) ?>" class="inline-flex items-center gap-2 text-[#1D4ED8] hover:text-[#1E3A8A] font-bold text-sm transition-colors">
              <span class="material-symbols-outlined text-[18px]">call</span>
              <span><?= htmlspecialchars($d1_contact) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 2: Transport -->
        <div class="bg-[#FFF7ED] p-6 rounded-2xl border border-[#FED7AA] hover:border-[#EA580C] shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#F97316] to-[#C2410C] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">directions_bus</span>
              </div>
              <span class="text-[10px] sm:text-[11px] font-bold text-[#9A3412] bg-[#FFEDD5] px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#FED7AA]">
                <?= htmlspecialchars(get_text('contact', 'desk2_role', 'Fleet & Route Operations')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#7C2D12] text-base sm:text-lg mb-2">
              <?= htmlspecialchars(get_text('contact', 'desk2_name', 'School Bus & Transport Incharge')) ?>
            </h3>
            <p class="text-xs text-[#9A3412]/80 flex items-center gap-1.5 mb-4">
              <span class="material-symbols-outlined text-[16px] text-[#EA580C]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk2_timing', '7:00 AM – 3:30 PM (School Days)')) ?></span>
            </p>
          </div>
          <div class="pt-4 border-t border-[#FFEDD5]">
            <?php $d2_contact = get_text('contact', 'desk2_contact', '+91 99920 89284'); ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d2_contact) ?>" class="inline-flex items-center gap-2 text-[#C2410C] hover:text-[#7C2D12] font-bold text-sm transition-colors">
              <span class="material-symbols-outlined text-[18px]">call</span>
              <span><?= htmlspecialchars($d2_contact) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 3: Accounts -->
        <div class="bg-[#ECFDF5] p-6 rounded-2xl border border-[#A7F3D0] hover:border-[#059669] shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#10B981] to-[#047857] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">payments</span>
              </div>
              <span class="text-[10px] sm:text-[11px] font-bold text-[#065F46] bg-[#D1FAE5] px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#A7F3D0]">
                <?= htmlspecialchars(get_text('contact', 'desk3_role', 'Finance & Scholarship Desk')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#064E3B] text-base sm:text-lg mb-2">
              <?= htmlspecialchars(get_text('contact', 'desk3_name', 'Accounts & Fee Counter')) ?>
            </h3>
            <p class="text-xs text-[#065F46]/80 flex items-center gap-1.5 mb-4">
              <span class="material-symbols-outlined text-[16px] text-[#059669]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk3_timing', '9:00 AM – 2:00 PM (Working Days)')) ?></span>
            </p>
          </div>
          <div class="pt-4 border-t border-[#D1FAE5] flex flex-col gap-1.5">
            <?php 
              $d3_raw = get_text('contact', 'desk3_contact', '+91 70158 90094 / accounts@sunrisesrsecschool.com');
              $d3_raw = str_replace('accounts@sunriseschool.com', 'accounts@sunrisesrsecschool.com', $d3_raw);
              $parts = array_map('trim', explode('/', $d3_raw));
              $d3_phone = $parts[0] ?? '+91 70158 90094';
              $d3_email = $parts[1] ?? 'accounts@sunrisesrsecschool.com';
            ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d3_phone) ?>" class="inline-flex items-center gap-2 text-[#047857] hover:text-[#064E3B] font-bold text-xs sm:text-sm transition-colors">
              <span class="material-symbols-outlined text-[16px]">call</span>
              <span><?= htmlspecialchars($d3_phone) ?></span>
            </a>
            <a href="mailto:<?= htmlspecialchars($d3_email) ?>" class="inline-flex items-center gap-2 text-[#047857] hover:text-[#064E3B] font-bold text-xs sm:text-sm transition-colors break-all">
              <span class="material-symbols-outlined text-[16px]">mail</span>
              <span><?= htmlspecialchars($d3_email) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 4: Principal's Office -->
        <div class="bg-[#F5EEFD] p-6 rounded-2xl border border-[#E2CEFC] hover:border-[#7C3AED] shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#8B5CF6] to-[#6D28D9] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">shield_person</span>
              </div>
              <span class="text-[10px] sm:text-[11px] font-bold text-[#581C87] bg-[#EDE9FE] px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#E2CEFC]">
                <?= htmlspecialchars(get_text('contact', 'desk4_role', 'Executive Administration')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#3B0764] text-base sm:text-lg mb-2">
              <?= htmlspecialchars(get_text('contact', 'desk4_name', 'Principal Office & Appointments')) ?>
            </h3>
            <p class="text-xs text-[#581C87]/80 flex items-center gap-1.5 mb-4">
              <span class="material-symbols-outlined text-[16px] text-[#7C3AED]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk4_timing', '11:00 AM – 1:30 PM (By Prior Appointment)')) ?></span>
            </p>
          </div>
          <div class="pt-4 border-t border-[#EDE9FE] flex flex-col gap-1.5">
            <?php 
              $d4_contact = get_text('contact', 'desk4_contact', $site_email);
              $d4_contact = str_replace('info@sunriseschool.com', $site_email, $d4_contact);
            ?>
            <a href="mailto:<?= htmlspecialchars($d4_contact) ?>" class="inline-flex items-center gap-2 text-[#6D28D9] hover:text-[#3B0764] font-bold text-xs sm:text-sm transition-colors break-all">
              <span class="material-symbols-outlined text-[16px]">mail</span>
              <span><?= htmlspecialchars($d4_contact) ?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Interactive Google Map & Campus Location Section -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14 sm:py-20 w-full">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
      <div>
        <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-2 block font-bold tracking-wider">
          <?= htmlspecialchars(get_text('contact', 'map_eyebrow', 'Find Us on Map')) ?>
        </span>
        <h2 class="text-xl sm:text-3xl font-headline-lg font-bold text-primary tracking-tight">
          <?= htmlspecialchars(get_text('contact', 'map_heading', 'Campus Location & Driving Directions')) ?>
        </h2>
        <p class="font-body-md text-on-surface-variant mt-2 max-w-2xl text-sm sm:text-base leading-relaxed">
          <?= htmlspecialchars(get_text('contact', 'map_desc', 'Conveniently situated on Balsamand Road in Dobhi, Hisar with direct highway connectivity and dedicated school bus bays.')) ?>
        </p>
      </div>
      <?php if ($map_btn_text = get_text('contact', 'map_btn_text', 'Open in Google Maps')): ?>
        <a href="<?= htmlspecialchars(get_text('contact', 'map_btn_link', 'https://maps.google.com/?q=Sun+Rise+Sr+Sec+School+Dobhi+Hisar')) ?>" target="_blank" rel="noopener" class="btn-gold inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm sm:text-base shadow-sm hover:shadow-md transition-all flex-shrink-0">
          <span class="material-symbols-outlined text-[20px]">explore</span>
          <span><?= htmlspecialchars($map_btn_text) ?></span>
        </a>
      <?php endif; ?>
    </div>

    <!-- Landmark Note Banner -->
    <?php if ($landmark = get_text('contact', 'map_landmark', 'Landmark: Near Balsamand Road, Village Dobhi, Tehsil & Distt. Hisar, Haryana - 125001')): ?>
      <div class="mb-6 p-4 rounded-xl bg-surface-container-low border border-border-warm flex items-center gap-3 text-xs sm:text-sm text-on-surface">
        <span class="material-symbols-outlined text-[#C9A24B] text-[20px] flex-shrink-0">pin_drop</span>
        <span class="font-medium"><?= htmlspecialchars($landmark) ?></span>
      </div>
    <?php endif; ?>

    <!-- Map Container -->
    <div class="w-full h-80 sm:h-96 lg:h-[450px] rounded-2xl overflow-hidden border border-border-warm shadow-sm relative bg-surface-container">
      <iframe
        title="Sun Rise Sr. Sec. School Dobhi Location Map"
        src="<?= htmlspecialchars(get_text('contact', 'map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3493.5786358172945!2d75.5898517!3d29.0718507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391235bc6cfa35d3%3A0xe54ec09228d7b379!2sSun%20Rise%20Sr.%20Sec.%20School!5e0!3m2!1sen!2sin!4v1710000000000!5m2!1sen!2sin')) ?>"
        class="w-full h-full border-0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

  <!-- Instant WhatsApp Banner -->
  <section class="bg-primary text-on-primary py-12 sm:py-16 px-4 sm:px-6 lg:px-12 my-6 sm:my-10">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 sm:gap-8">
      <div class="flex items-center gap-5 sm:gap-6">
        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-600 flex items-center justify-center flex-shrink-0 shadow-lg">
          <span class="material-symbols-outlined text-white text-[30px] sm:text-[36px]">chat</span>
        </div>
        <div>
          <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] tracking-[0.15em] font-bold text-xs sm:text-sm">
            <?= htmlspecialchars(get_text('contact', 'wa_eyebrow', 'Quick WhatsApp Helpline')) ?>
          </span>
          <h3 class="font-headline-md font-bold mt-1 text-lg sm:text-2xl text-white">
            <?= htmlspecialchars(get_text('contact', 'wa_heading', 'Chat Instantly with Admission Desk')) ?>
          </h3>
          <p class="font-body-md text-on-primary-container mt-1 text-xs sm:text-sm leading-relaxed max-w-2xl">
            <?= htmlspecialchars(get_text('contact', 'wa_desc', 'Have quick questions regarding admissions, transport routes, or fees? Reach us directly on WhatsApp.')) ?>
          </p>
        </div>
      </div>
      <a class="bg-emerald-600 hover:bg-emerald-700 text-white font-label-md px-7 py-3.5 sm:h-14 rounded-xl transition-colors flex items-center gap-3 shadow-md flex-shrink-0 font-bold text-sm sm:text-base" href="<?= htmlspecialchars(get_text('contact', 'wa_btn_link', 'https://wa.me/917015890094')) ?>" target="_blank" rel="noopener">
        <span class="material-symbols-outlined text-[22px]">chat</span>
        <span><?= htmlspecialchars(get_text('contact', 'wa_btn_text', 'Open WhatsApp Chat')) ?></span>
      </a>
    </div>
  </section>

  <!-- FAQ Accordion Section -->
  <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16 w-full">
    <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
      <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-2 block font-bold tracking-wider">
        <?= htmlspecialchars(get_text('contact', 'faq_eyebrow', 'Frequently Asked Questions')) ?>
      </span>
      <h2 class="text-xl sm:text-3xl font-headline-lg font-bold text-primary tracking-tight">
        <?= htmlspecialchars(get_text('contact', 'faq_heading', 'Common Contact & Visiting Inquiries')) ?>
      </h2>
    </div>

    <div class="space-y-4">
      <!-- FAQ 1 -->
      <div class="border border-border-warm rounded-2xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-primary text-sm sm:text-base focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq1_q', 'What are the ideal hours for visiting the campus for admission inquiries?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0">expand_more</span>
        </button>
        <div class="faq-answer hidden px-6 pb-5 pt-1 text-on-surface-variant text-xs sm:text-sm leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq1_a', 'Our campus admissions desk is active Monday through Saturday from 8:00 AM to 2:30 PM. We recommend visiting before 1:00 PM for guided campus walk-throughs and counselor consultations.'))) ?>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="border border-border-warm rounded-2xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-primary text-sm sm:text-base focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq2_q', 'Is prior appointment required to meet the Principal?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0">expand_more</span>
        </button>
        <div class="faq-answer hidden px-6 pb-5 pt-1 text-on-surface-variant text-xs sm:text-sm leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq2_a', 'Yes, to ensure dedicated time without interruptions, we request parents to schedule appointments with the Principal office by calling +91 70158 90094 or emailing info@sunrisesrsecschool.com.'))) ?>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="border border-border-warm rounded-2xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-primary text-sm sm:text-base focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq3_q', 'How can I check if school bus transportation covers our village or neighborhood?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0">expand_more</span>
        </button>
        <div class="faq-answer hidden px-6 pb-5 pt-1 text-on-surface-variant text-xs sm:text-sm leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq3_a', 'You can call our dedicated Transport Coordinator helpline at +91 99920 89284 or indicate your residential area in the contact form. We operate 15+ GPS-tracked bus routes covering 30+ villages around Dobhi.'))) ?>
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="border border-border-warm rounded-2xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-primary text-sm sm:text-base focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq4_q', 'How soon can I expect a response to my online inquiry?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0">expand_more</span>
        </button>
        <div class="faq-answer hidden px-6 pb-5 pt-1 text-on-surface-variant text-xs sm:text-sm leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq4_a', 'Our administrative team typically reviews and replies to online inquiry desk messages within 24 business hours. For urgent inquiries, please call our primary helpline directly.'))) ?>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function toggleContactFaq(button) {
  const answer = button.nextElementSibling;
  const icon = button.querySelector('.material-symbols-outlined');
  const isHidden = answer.classList.contains('hidden');
  
  // Close all answers in container
  document.querySelectorAll('.faq-answer').forEach(el => el.classList.add('hidden'));
  document.querySelectorAll('section button .material-symbols-outlined').forEach(el => {
    if (el.textContent === 'expand_more') el.style.transform = 'rotate(0deg)';
  });

  if (isHidden) {
    answer.classList.remove('hidden');
    if (icon) icon.style.transform = 'rotate(180deg)';
  } else {
    answer.classList.add('hidden');
    if (icon) icon.style.transform = 'rotate(0deg)';
  }
}
</script>

<?php
require_once __DIR__ . '/core/footer.php';
?>
