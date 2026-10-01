<?php
$current_page = 'contact';
$page_title = 'Contact Us | Campus Office & Admissions';
$page_description = 'Get in touch with Sun Rise Sr. Sec. School, Dobhi (Hisar, Haryana). Find campus directions, office hours, direct helpline numbers, and online contact form.';
$page_keywords = 'contact Sun Rise School, Dobhi Hisar school contact, school phone number, campus location, admission inquiry';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section — full image, no crop, no gap -->
  <section class="hero-section relative w-full bg-[#00122e]">
    <img
      src="<?= get_image('contact', 'hero_banner', school_img('school3.webp')) ?>"
      alt="Sun Rise School — Contact Us Hero Banner"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />
    <div class="absolute inset-0 bg-gradient-to-b from-primary/55 via-primary/35 to-primary/70 pointer-events-none" style="z-index:5;"></div>
    <div class="hero-overlay-wrap">
      <div class="hero-content max-w-4xl w-full mx-auto relative px-4 sm:px-6 text-center flex flex-col items-center gap-3 sm:gap-4">
        <span class="hero-badge text-gold-light uppercase tracking-widest font-bold bg-black/45 border border-[#C9A24B]/60 px-3.5 py-1 sm:px-5 sm:py-1.5 rounded-full shadow-lg text-[11px] sm:text-xs">
          <?= get_text('contact', 'hero_badge', 'Get in Touch') ?>
        </span>
        <h1 class="hero-heading font-headline-lg font-bold tracking-tight text-white w-full drop-shadow-lg text-2xl sm:text-3xl lg:text-4xl leading-tight">
          <?= get_text('contact', 'hero_title', 'Connect with Sun Rise School') ?>
        </h1>
        <p class="hero-subtitle text-surface-cream/95 w-full max-w-2xl drop-shadow text-xs sm:text-sm lg:text-base leading-relaxed line-clamp-2">
          <?= get_text('contact', 'hero_subtitle', 'We welcome parents, prospective students, and guardians to visit our campus or get in touch for admissions, bus routes, and general inquiries.') ?>
        </p>

        <!-- Quick Contact Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-2.5 mt-1">
          <?php if ($pill1 = get_text('contact', 'hero_pill1_text', 'Dobhi, Hisar (Haryana)')): ?>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-medium text-white shadow-sm">
              <span class="material-symbols-outlined text-[#C9A24B] text-[16px]">location_on</span>
              <span><?= htmlspecialchars($pill1) ?></span>
            </div>
          <?php endif; ?>
          <?php if ($pill2 = get_text('contact', 'hero_pill2_text', '+91 70158 90094')): ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $pill2) ?>" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-medium text-white hover:bg-white/20 transition-colors shadow-sm">
              <span class="material-symbols-outlined text-[#C9A24B] text-[16px]">call</span>
              <span><?= htmlspecialchars($pill2) ?></span>
            </a>
          <?php endif; ?>
          <?php if ($pill3 = get_text('contact', 'hero_pill3_text', 'Mon–Sat: 8:00 AM – 2:30 PM')): ?>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-medium text-white shadow-sm">
              <span class="material-symbols-outlined text-[#C9A24B] text-[16px]">schedule</span>
              <span><?= htmlspecialchars($pill3) ?></span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Hero CTA Button -->
        <?php if ($hero_btn = get_text('contact', 'hero_btn_text', 'Send an Online Message')): ?>
          <div class="mt-1">
            <a href="<?= htmlspecialchars(get_text('contact', 'hero_btn_link', '#inquiry-form')) ?>" class="btn-gold inline-flex items-center gap-1.5 px-5 py-2 sm:px-6 sm:py-2.5 text-xs sm:text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all">
              <span><?= htmlspecialchars($hero_btn) ?></span>
              <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Main Content Layout (Form & Campus Office Info) -->
  <section id="inquiry-form" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-12 w-full scroll-mt-24 relative">
    <span id="careers" class="absolute -top-28 left-0 pointer-events-none w-0 h-0 opacity-0"></span>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
      <!-- Left Column: Contact Form (Elevated Card) -->
      <div class="lg:col-span-7 bg-surface-pure p-5 sm:p-7 lg:p-8 rounded-xl shadow-sm relative border border-border-warm h-full flex flex-col justify-between">
        <div class="absolute top-0 left-0 w-full h-1 bg-[#C9A24B] rounded-t-xl"></div>
        <div>
          <div class="mb-5 sm:mb-6">
            <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider text-xs">
              <?= get_text('contact', 'form_eyebrow', 'Inquiry Desk') ?>
            </span>
            <h2 class="text-lg sm:text-xl lg:text-2xl font-headline-lg font-bold text-primary tracking-tight leading-snug">
              <?= get_text('contact', 'form_heading', 'Send Us a Message') ?>
            </h2>
            <p class="font-body-md text-on-surface-variant mt-1 text-xs sm:text-sm leading-relaxed">
              <?= get_text('contact', 'form_desc', 'Fill out the quick form below and our administrative team will respond to your queries promptly.') ?>
            </p>
          </div>

          <?php
            $success_msg = get_text('contact', 'form_success_msg', 'Thank you for reaching out to Sun Rise Sr. Sec. School. Your message has been received by our office desk and we will contact you shortly.');
            $career_success_msg = get_text('contact', 'form_career_success_msg', 'Thank you for your application! Your resume link and details have been received by our recruitment cell. We will contact shortlisted candidates.');
          ?>
          <form id="contactInquiryForm" class="space-y-4" onsubmit="handleContactSubmit(event)">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-primary font-bold text-xs" for="fullName">Your Full Name <span class="text-error text-red-600">*</span></label>
                <input class="h-10 px-3.5 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-xs sm:text-sm focus:outline-none focus:border-primary transition-colors" id="fullName" placeholder="e.g. Ramesh Kumar" required="" type="text"/>
              </div>
              <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-primary font-bold text-xs" for="email">Email Address</label>
                <input class="h-10 px-3.5 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-xs sm:text-sm focus:outline-none focus:border-primary transition-colors" id="email" placeholder="e.g. ramesh@example.com" type="email"/>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-primary font-bold text-xs" for="phone">Phone Number <span class="text-error text-red-600">*</span></label>
                <input class="h-10 px-3.5 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-xs sm:text-sm focus:outline-none focus:border-primary transition-colors" id="phone" placeholder="+91 70158 90094" required="" type="tel"/>
              </div>
              <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-primary font-bold text-xs" for="department">Inquiry Type</label>
                <select class="h-10 px-3.5 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-xs sm:text-sm focus:outline-none focus:border-primary transition-colors cursor-pointer" id="department" onchange="toggleCareerFields()">
                  <option value="admissions">Admissions (Nursery to 12th)</option>
                  <option value="transport">School Bus &amp; Transport Routes</option>
                  <option value="fee">Fee Structure &amp; Concessions</option>
                  <option value="careers">Faculty / Career Opportunities</option>
                  <option value="general">General Administration &amp; Appointments</option>
                </select>
              </div>
            </div>

            <!-- Career & Resume Link Section (Visible when Career Opportunities is selected) -->
            <div id="careerFieldsGroup" class="hidden space-y-3.5 p-3.5 sm:p-4 rounded-xl bg-[#F0FDF4] border border-[#BBF7D0] transition-all">
              <div class="flex items-center gap-2 text-xs font-bold text-[#166534]">
                <span class="material-symbols-outlined text-[18px] text-[#15803D]">badge</span>
                <span>Educator / Staff Application Details</span>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-[#166534] font-bold text-xs" for="appliedPosition">Post / Subject Applying For <span class="text-red-600">*</span></label>
                  <input class="h-10 px-3.5 bg-white rounded-lg border border-[#86EFAC] text-on-surface text-xs sm:text-sm focus:outline-none focus:border-[#15803D] transition-colors" id="appliedPosition" placeholder="e.g. PGT Physics, TGT English, PRT, Sports Coach" type="text"/>
                </div>
                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-[#166534] font-bold text-xs" for="experienceYears">Total Teaching Experience</label>
                  <input class="h-10 px-3.5 bg-white rounded-lg border border-[#86EFAC] text-on-surface text-xs sm:text-sm focus:outline-none focus:border-[#15803D] transition-colors" id="experienceYears" placeholder="e.g. Fresher / 3+ Years" type="text"/>
                </div>
              </div>

              <!-- Public Resume Link Input -->
              <div class="flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                  <label class="font-label-md text-[#166534] font-bold text-xs flex items-center gap-1.5" for="resumeLink">
                    <span class="material-symbols-outlined text-[16px] text-[#15803D]">link</span>
                    <span>Public Resume / CV Link (Google Drive / OneDrive / LinkedIn / Dropbox) <span class="text-red-600">*</span></span>
                  </label>
                </div>
                <div class="relative flex items-center">
                  <span class="absolute left-3 text-slate-400 material-symbols-outlined text-[18px] pointer-events-none">link</span>
                  <input class="w-full h-10 pl-9 pr-3.5 bg-white rounded-lg border border-[#86EFAC] text-on-surface text-xs sm:text-sm focus:outline-none focus:border-[#15803D] focus:ring-1 focus:ring-[#15803D] transition-colors" id="resumeLink" placeholder="https://drive.google.com/file/d/.../view?usp=sharing or LinkedIn URL" type="url"/>
                </div>
                <p class="text-[11px] text-[#166534]/85 leading-snug flex items-start gap-1 mt-0.5">
                  <span class="material-symbols-outlined text-[14px] text-[#15803D] shrink-0 mt-0.5">info</span>
                  <span><strong>Important:</strong> Upload your CV/Resume on Google Drive, Dropbox, or LinkedIn and make sure access permission is set to <em>"Anyone with the link can view"</em>.</span>
                </p>
              </div>
            </div>

            <div class="flex flex-col gap-1.5">
              <label class="font-label-md text-primary font-bold text-xs" for="message" id="messageLabel">Message / Details <span class="text-error text-red-600">*</span></label>
              <textarea class="p-3 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-xs sm:text-sm focus:outline-none focus:border-primary transition-colors resize-none leading-relaxed" id="message" placeholder="Please mention student's current class, residential village/city, and any specific questions you have..." required="" rows="3"></textarea>
            </div>

            <button id="formSubmitBtn" class="btn-gold w-full text-center h-11 sm:h-12 font-bold text-xs sm:text-sm flex items-center justify-center gap-2 rounded-xl shadow-md hover:shadow-lg transition-all cursor-pointer" type="submit">
              <span id="formSubmitBtnText"><?= htmlspecialchars(get_text('contact', 'form_btn_text', 'Submit Message')) ?></span>
              <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
          </form>
        </div>
      </div>

      <!-- Right Column: Contact Details & Campus Office Info -->
      <div class="lg:col-span-5 h-full flex flex-col">
        <!-- Contact Info Card (Full Height & Equalized) -->
        <div class="bg-surface-container-low p-5 sm:p-7 lg:p-8 rounded-xl relative shadow-sm border border-border-warm h-full flex flex-col justify-between">
          <div>
            <h3 class="font-headline-sm text-primary font-bold mb-5 flex items-center gap-2 text-base sm:text-lg">
              <span class="material-symbols-outlined text-[#C9A24B]">location_city</span>
              <span><?= get_text('contact', 'info_card_title', 'Campus Information') ?></span>
            </h3>
            <div class="space-y-4 sm:space-y-5">
              <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                  <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                </div>
                <div>
                  <h4 class="font-label-md text-primary font-bold text-xs sm:text-sm"><?= get_text('contact', 'info_address_title', 'School Address') ?></h4>
                  <p class="font-body-sm text-on-surface-variant mt-0.5 text-xs leading-relaxed"><?= htmlspecialchars($site_address) ?></p>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                  <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                </div>
                <div>
                  <h4 class="font-label-md text-primary font-bold text-xs sm:text-sm"><?= get_text('contact', 'info_phone_title', 'Office Helpline') ?></h4>
                  <p class="font-body-sm text-on-surface-variant mt-0.5 flex flex-col gap-0.5 text-xs">
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_phone) ?></a>
                    <?php if (!empty($site_phone_alt)): ?>
                      <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone_alt) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_phone_alt) ?></a>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                  <span class="material-symbols-outlined text-primary text-[18px]">mail</span>
                </div>
                <div>
                  <h4 class="font-label-md text-primary font-bold text-xs sm:text-sm"><?= get_text('contact', 'info_email_title', 'Official Email') ?></h4>
                  <p class="font-body-sm text-on-surface-variant mt-0.5 text-xs">
                    <a href="mailto:<?= htmlspecialchars($site_email) ?>" class="text-primary font-bold hover:underline"><?= htmlspecialchars($site_email) ?></a>
                  </p>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                  <span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
                </div>
                <div>
                  <h4 class="font-label-md text-primary font-bold text-xs sm:text-sm"><?= get_text('contact', 'timing_title', 'School & Office Timings') ?></h4>
                  <div class="font-body-sm text-on-surface-variant mt-0.5 flex flex-col gap-0.5 text-xs">
                    <div><strong><?= htmlspecialchars(get_text('contact', 'timing_summer', 'Summer Season: 7:30 AM – 1:30 PM')) ?></strong></div>
                    <div><strong><?= htmlspecialchars(get_text('contact', 'timing_winter', 'Winter Season: 8:30 AM – 2:30 PM')) ?></strong></div>
                    <div class="text-[11px] text-on-surface-variant/80 italic"><?= htmlspecialchars(get_text('contact', 'timing_days', 'Mon–Sat (Sunday Closed)')) ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-5 pt-4 border-t border-border-warm flex items-center justify-between gap-3 text-xs text-on-surface-variant">
            <span class="flex items-center gap-1.5 font-medium text-primary">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <span><?= htmlspecialchars(get_text('contact', 'info_status_badge', 'Admissions Desk Open')) ?></span>
            </span>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="text-[#C9A24B] font-bold hover:underline flex items-center gap-1">
              <span>Direct Call</span>
              <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Departmental Desks Section (4 Direct Contacts) -->
  <section class="relative w-full py-10 sm:py-12 lg:py-14 px-4 sm:px-6 lg:px-12 overflow-hidden border-t border-b border-[#000e21]/10" style="background-color: #F7EFE8; background-image: radial-gradient(circle at 15% 20%, rgba(201, 162, 75, 0.10) 0%, transparent 42%), radial-gradient(circle at 85% 80%, rgba(184, 134, 102, 0.09) 0%, transparent 46%);">
    <!-- Subtle Warm Nude Geometric / Academic Pattern Overlays -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.38]" style="background-image: radial-gradient(#8d6e53 0.85px, transparent 0.85px), radial-gradient(#C9A24B 0.85px, transparent 0.85px); background-size: 24px 24px; background-position: 0 0, 12px 12px;"></div>
    <div class="absolute inset-0 pointer-events-none opacity-[0.20]" style="background-image: linear-gradient(to right, rgba(141, 110, 83, 0.06) 1px, transparent 1px), linear-gradient(to bottom, rgba(141, 110, 83, 0.06) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Decorative Soft Glow Orbs -->
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#e8d5c4]/60 blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-[#C9A24B]/12 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
      <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-8">
        <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider text-xs">
          <?= htmlspecialchars(get_text('contact', 'desks_eyebrow', 'Direct Helplines')) ?>
        </span>
        <h2 class="text-lg sm:text-2xl font-headline-lg font-bold text-primary tracking-tight">
          <?= htmlspecialchars(get_text('contact', 'desks_heading', 'Key Departmental Contacts')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Desk 1: Admissions -->
        <div class="bg-[#EFF6FF] p-4 sm:p-5 rounded-xl border border-[#BFDBFE] hover:border-[#2563EB] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-3">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#3B82F6] to-[#1D4ED8] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">school</span>
              </div>
              <span class="text-[10px] font-bold text-[#1E40AF] bg-[#DBEAFE] px-2 py-0.5 rounded-full uppercase tracking-wider border border-[#BFDBFE]">
                <?= htmlspecialchars(get_text('contact', 'desk1_role', 'Admission Counselor Cell')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#1E3A8A] text-sm sm:text-base mb-1.5">
              <?= htmlspecialchars(get_text('contact', 'desk1_name', 'Admissions & Student Enrollment')) ?>
            </h3>
            <p class="text-xs text-[#1E40AF]/80 flex items-center gap-1.5 mb-3">
              <span class="material-symbols-outlined text-[14px] text-[#2563EB]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk1_timing', '8:00 AM – 2:30 PM (Mon–Sat)')) ?></span>
            </p>
          </div>
          <div class="pt-3 border-t border-[#DBEAFE]">
            <?php $d1_contact = get_text('contact', 'desk1_contact', '+91 70158 90094'); ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d1_contact) ?>" class="inline-flex items-center gap-1.5 text-[#1D4ED8] hover:text-[#1E3A8A] font-bold text-xs sm:text-sm transition-colors">
              <span class="material-symbols-outlined text-[16px]">call</span>
              <span><?= htmlspecialchars($d1_contact) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 2: Transport -->
        <div class="bg-[#FFF7ED] p-4 sm:p-5 rounded-xl border border-[#FED7AA] hover:border-[#EA580C] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-3">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F97316] to-[#C2410C] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">directions_bus</span>
              </div>
              <span class="text-[10px] font-bold text-[#9A3412] bg-[#FFEDD5] px-2 py-0.5 rounded-full uppercase tracking-wider border border-[#FED7AA]">
                <?= htmlspecialchars(get_text('contact', 'desk2_role', 'Fleet & Route Operations')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#7C2D12] text-sm sm:text-base mb-1.5">
              <?= htmlspecialchars(get_text('contact', 'desk2_name', 'School Bus & Transport Incharge')) ?>
            </h3>
            <p class="text-xs text-[#9A3412]/80 flex items-center gap-1.5 mb-3">
              <span class="material-symbols-outlined text-[14px] text-[#EA580C]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk2_timing', '7:00 AM – 3:30 PM (School Days)')) ?></span>
            </p>
          </div>
          <div class="pt-3 border-t border-[#FFEDD5]">
            <?php $d2_contact = get_text('contact', 'desk2_contact', '+91 99920 89284'); ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d2_contact) ?>" class="inline-flex items-center gap-1.5 text-[#C2410C] hover:text-[#7C2D12] font-bold text-xs sm:text-sm transition-colors">
              <span class="material-symbols-outlined text-[16px]">call</span>
              <span><?= htmlspecialchars($d2_contact) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 3: Accounts -->
        <div class="bg-[#ECFDF5] p-4 sm:p-5 rounded-xl border border-[#A7F3D0] hover:border-[#059669] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-3">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#10B981] to-[#047857] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">payments</span>
              </div>
              <span class="text-[10px] font-bold text-[#065F46] bg-[#D1FAE5] px-2 py-0.5 rounded-full uppercase tracking-wider border border-[#A7F3D0]">
                <?= htmlspecialchars(get_text('contact', 'desk3_role', 'Finance & Scholarship Desk')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#064E3B] text-sm sm:text-base mb-1.5">
              <?= htmlspecialchars(get_text('contact', 'desk3_name', 'Accounts & Fee Counter')) ?>
            </h3>
            <p class="text-xs text-[#065F46]/80 flex items-center gap-1.5 mb-3">
              <span class="material-symbols-outlined text-[14px] text-[#059669]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk3_timing', '9:00 AM – 2:00 PM (Working Days)')) ?></span>
            </p>
          </div>
          <div class="pt-3 border-t border-[#D1FAE5] flex flex-col gap-1">
            <?php 
              $d3_raw = get_text('contact', 'desk3_contact', '+91 70158 90094 / accounts@sunrisesrsecschool.com');
              $d3_raw = str_replace('accounts@sunriseschool.com', 'accounts@sunrisesrsecschool.com', $d3_raw);
              $parts = array_map('trim', explode('/', $d3_raw));
              $d3_phone = $parts[0] ?? '+91 70158 90094';
              $d3_email = $parts[1] ?? 'accounts@sunrisesrsecschool.com';
            ?>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $d3_phone) ?>" class="inline-flex items-center gap-1.5 text-[#047857] hover:text-[#064E3B] font-bold text-xs transition-colors">
              <span class="material-symbols-outlined text-[15px]">call</span>
              <span><?= htmlspecialchars($d3_phone) ?></span>
            </a>
            <a href="mailto:<?= htmlspecialchars($d3_email) ?>" class="inline-flex items-center gap-1.5 text-[#047857] hover:text-[#064E3B] font-bold text-xs transition-colors break-all">
              <span class="material-symbols-outlined text-[15px]">mail</span>
              <span><?= htmlspecialchars($d3_email) ?></span>
            </a>
          </div>
        </div>

        <!-- Desk 4: Principal's Office -->
        <div class="bg-[#F5EEFD] p-4 sm:p-5 rounded-xl border border-[#E2CEFC] hover:border-[#7C3AED] shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-3">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#8B5CF6] to-[#6D28D9] text-white shadow-sm flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">shield_person</span>
              </div>
              <span class="text-[10px] font-bold text-[#581C87] bg-[#EDE9FE] px-2 py-0.5 rounded-full uppercase tracking-wider border border-[#E2CEFC]">
                <?= htmlspecialchars(get_text('contact', 'desk4_role', 'Executive Administration')) ?>
              </span>
            </div>
            <h3 class="font-bold text-[#3B0764] text-sm sm:text-base mb-1.5">
              <?= htmlspecialchars(get_text('contact', 'desk4_name', 'Principal Office & Appointments')) ?>
            </h3>
            <p class="text-xs text-[#581C87]/80 flex items-center gap-1.5 mb-3">
              <span class="material-symbols-outlined text-[14px] text-[#7C3AED]">schedule</span>
              <span><?= htmlspecialchars(get_text('contact', 'desk4_timing', '11:00 AM – 1:30 PM (Appointment)')) ?></span>
            </p>
          </div>
          <div class="pt-3 border-t border-[#EDE9FE] flex flex-col gap-1">
            <?php 
              $d4_contact = get_text('contact', 'desk4_contact', $site_email);
              $d4_contact = str_replace('info@sunriseschool.com', $site_email, $d4_contact);
            ?>
            <a href="mailto:<?= htmlspecialchars($d4_contact) ?>" class="inline-flex items-center gap-1.5 text-[#6D28D9] hover:text-[#3B0764] font-bold text-xs transition-colors break-all">
              <span class="material-symbols-outlined text-[15px]">mail</span>
              <span><?= htmlspecialchars($d4_contact) ?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Interactive Google Map & Campus Location Section -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-12 w-full scroll-mt-28" id="map">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6 mb-5 sm:mb-6">
      <div>
        <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider text-xs">
          <?= htmlspecialchars(get_text('contact', 'map_eyebrow', 'Find Us on Map')) ?>
        </span>
        <h2 class="text-lg sm:text-2xl font-headline-lg font-bold text-primary tracking-tight">
          <?= htmlspecialchars(get_text('contact', 'map_heading', 'Campus Location & Driving Directions')) ?>
        </h2>
        <p class="font-body-md text-on-surface-variant mt-1 max-w-2xl text-xs sm:text-sm leading-relaxed">
          <?= htmlspecialchars(get_text('contact', 'map_desc', 'Conveniently situated on Balsamand Road in Dobhi, Hisar with direct highway connectivity and dedicated school bus bays.')) ?>
        </p>
      </div>
      <?php if ($map_btn_text = get_text('contact', 'map_btn_text', 'Open in Google Maps')): ?>
        <a href="<?= htmlspecialchars(get_text('contact', 'map_btn_link', 'https://maps.google.com/?q=Sun+Rise+Sr.+Sec.+School+Dobhi+Hisar+Haryana')) ?>" target="_blank" rel="noopener" class="btn-gold inline-flex items-center gap-1.5 px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all flex-shrink-0">
          <span class="material-symbols-outlined text-[18px]">explore</span>
          <span><?= htmlspecialchars($map_btn_text) ?></span>
        </a>
      <?php endif; ?>
    </div>

    <!-- Landmark Note Banner -->
    <?php if ($landmark = get_text('contact', 'map_landmark', 'Landmark: Near Balsamand Road, Village Dobhi, Tehsil & Distt. Hisar, Haryana - 125001')): ?>
      <div class="mb-4 p-3 rounded-lg bg-surface-container-low border border-border-warm flex items-center gap-2.5 text-xs text-on-surface">
        <span class="material-symbols-outlined text-[#C9A24B] text-[18px] flex-shrink-0">pin_drop</span>
        <span class="font-medium"><?= htmlspecialchars($landmark) ?></span>
      </div>
    <?php endif; ?>

    <!-- Map Container -->
    <div class="w-full h-64 sm:h-72 lg:h-80 rounded-xl overflow-hidden border border-border-warm shadow-sm relative bg-surface-container">
      <iframe
        title="Sun Rise Sr. Sec. School Dobhi Location Map"
        src="<?= htmlspecialchars(get_text('contact', 'map_embed_url', 'https://maps.google.com/maps?q=Sun+Rise+Sr.+Sec.+School,+Dobhi,+Hisar,+Haryana&t=&z=14&ie=UTF8&iwloc=&output=embed')) ?>"
        class="w-full h-full border-0"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

  <!-- Instant WhatsApp Banner -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full my-4 sm:my-6">
    <div class="bg-primary text-on-primary py-6 sm:py-8 px-6 sm:px-10 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-5 sm:gap-6 shadow-xl border border-white/10">
      <div class="flex items-center gap-4 sm:gap-5">
        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-emerald-600 flex items-center justify-center flex-shrink-0 shadow-md">
          <span class="material-symbols-outlined text-white text-[26px] sm:text-[30px]">chat</span>
        </div>
        <div>
          <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] tracking-[0.15em] font-bold text-[11px] sm:text-xs">
            <?= htmlspecialchars(get_text('contact', 'wa_eyebrow', 'Quick WhatsApp Helpline')) ?>
          </span>
          <h3 class="font-headline-md font-bold mt-0.5 text-base sm:text-xl text-white">
            <?= htmlspecialchars(get_text('contact', 'wa_heading', 'Chat Instantly with Admission Desk')) ?>
          </h3>
          <p class="font-body-md text-on-primary-container mt-0.5 text-xs sm:text-sm leading-relaxed max-w-2xl line-clamp-1">
            <?= htmlspecialchars(get_text('contact', 'wa_desc', 'Have quick questions regarding admissions, transport routes, or fees? Reach us directly on WhatsApp.')) ?>
          </p>
        </div>
      </div>
      <a class="bg-emerald-600 hover:bg-emerald-700 text-white font-label-md px-5 py-2.5 sm:h-11 rounded-xl transition-colors flex items-center gap-2 shadow-md flex-shrink-0 font-bold text-xs sm:text-sm" href="<?= htmlspecialchars(get_text('contact', 'wa_btn_link', 'https://wa.me/918307560664')) ?>" target="_blank" rel="noopener">
        <span class="material-symbols-outlined text-[18px]">chat</span>
        <span><?= htmlspecialchars(get_text('contact', 'wa_btn_text', 'Open WhatsApp Chat')) ?></span>
      </a>
    </div>
  </section>

  <!-- FAQ Accordion Section -->
  <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-12 w-full">
    <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-8">
      <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider text-xs">
        <?= htmlspecialchars(get_text('contact', 'faq_eyebrow', 'Frequently Asked Questions')) ?>
      </span>
      <h2 class="text-lg sm:text-2xl font-headline-lg font-bold text-primary tracking-tight">
        <?= htmlspecialchars(get_text('contact', 'faq_heading', 'Common Contact & Visiting Inquiries')) ?>
      </h2>
    </div>

    <div class="space-y-3">
      <!-- FAQ 1 -->
      <div class="border border-border-warm rounded-xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-5 py-3.5 sm:py-4 text-left flex items-center justify-between gap-4 font-bold text-primary text-xs sm:text-sm focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq1_q', 'What are the ideal hours for visiting the campus for admission inquiries?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0 text-[20px]">expand_more</span>
        </button>
        <div class="faq-answer hidden px-5 pb-4 pt-1 text-on-surface-variant text-xs leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq1_a', 'Our campus admissions desk is active Monday through Saturday from 8:00 AM to 2:30 PM. We recommend visiting before 1:00 PM for guided campus walk-throughs and counselor consultations.'))) ?>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="border border-border-warm rounded-xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-5 py-3.5 sm:py-4 text-left flex items-center justify-between gap-4 font-bold text-primary text-xs sm:text-sm focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq2_q', 'Is prior appointment required to meet the Principal?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0 text-[20px]">expand_more</span>
        </button>
        <div class="faq-answer hidden px-5 pb-4 pt-1 text-on-surface-variant text-xs leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq2_a', 'Yes, to ensure dedicated time without interruptions, we request parents to schedule appointments with the Principal office by calling +91 70158 90094 or emailing info@sunrisesrsecschool.com.'))) ?>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="border border-border-warm rounded-xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-5 py-3.5 sm:py-4 text-left flex items-center justify-between gap-4 font-bold text-primary text-xs sm:text-sm focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq3_q', 'How can I check if school bus transportation covers our village or neighborhood?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0 text-[20px]">expand_more</span>
        </button>
        <div class="faq-answer hidden px-5 pb-4 pt-1 text-on-surface-variant text-xs leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq3_a', 'You can call our dedicated Transport Coordinator helpline at +91 99920 89284 or indicate your residential area in the contact form. We operate 15+ GPS-tracked bus routes covering 30+ villages around Dobhi.'))) ?>
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="border border-border-warm rounded-xl bg-surface-pure overflow-hidden shadow-sm transition-all duration-200">
        <button type="button" class="w-full px-5 py-3.5 sm:py-4 text-left flex items-center justify-between gap-4 font-bold text-primary text-xs sm:text-sm focus:outline-none hover:bg-surface-container-low transition-colors" onclick="toggleContactFaq(this)">
          <span><?= htmlspecialchars(get_text('contact', 'faq4_q', 'How soon can I expect a response to my online inquiry?')) ?></span>
          <span class="material-symbols-outlined text-[#C9A24B] transition-transform duration-200 flex-shrink-0 text-[20px]">expand_more</span>
        </button>
        <div class="faq-answer hidden px-5 pb-4 pt-1 text-on-surface-variant text-xs leading-relaxed border-t border-border-warm/60">
          <?= nl2br(htmlspecialchars(get_text('contact', 'faq4_a', 'Our administrative team typically reviews and replies to online inquiry desk messages within 24 business hours. For urgent inquiries, please call our primary helpline directly.'))) ?>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function toggleCareerFields() {
  const deptSelect = document.getElementById('department');
  const careerGroup = document.getElementById('careerFieldsGroup');
  const resumeLinkInput = document.getElementById('resumeLink');
  const appliedPositionInput = document.getElementById('appliedPosition');
  const messageInput = document.getElementById('message');
  const messageLabel = document.getElementById('messageLabel');
  const submitBtnText = document.getElementById('formSubmitBtnText');

  if (!deptSelect || !careerGroup) return;

  const isCareer = (deptSelect.value === 'careers');

  if (isCareer) {
    careerGroup.classList.remove('hidden');
    if (resumeLinkInput) resumeLinkInput.required = true;
    if (appliedPositionInput) appliedPositionInput.required = true;
    if (messageInput) {
      messageInput.placeholder = "Briefly describe your educational qualifications (B.Ed, M.Sc, etc.), past teaching experience, subjects, and current residence...";
    }
    if (messageLabel) {
      messageLabel.innerHTML = 'Cover Note / Qualifications <span class="text-error text-red-600">*</span>';
    }
    if (submitBtnText) {
      submitBtnText.textContent = "Submit Application & Resume Link";
    }
  } else {
    careerGroup.classList.add('hidden');
    if (resumeLinkInput) {
      resumeLinkInput.required = false;
      resumeLinkInput.value = '';
    }
    if (appliedPositionInput) {
      appliedPositionInput.required = false;
      appliedPositionInput.value = '';
    }
    if (messageInput) {
      messageInput.placeholder = "Please mention student's current class, residential village/city, and any specific questions you have...";
    }
    if (messageLabel) {
      messageLabel.innerHTML = 'Message / Details <span class="text-error text-red-600">*</span>';
    }
    if (submitBtnText) {
      submitBtnText.textContent = "Submit Message";
    }
  }
}

function checkCareersHash() {
  if (window.location.hash === '#careers' || window.location.hash.includes('career')) {
    const deptSelect = document.getElementById('department');
    if (deptSelect) {
      deptSelect.value = 'careers';
      toggleCareerFields();
      const formSection = document.getElementById('inquiry-form');
      if (formSection) {
        setTimeout(() => {
          formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 150);
      }
    }
  }
}

window.addEventListener('DOMContentLoaded', checkCareersHash);
window.addEventListener('hashchange', checkCareersHash);

function handleContactSubmit(event) {
  event.preventDefault();
  const form = event.target;
  const deptSelect = document.getElementById('department');
  const isCareer = deptSelect && deptSelect.value === 'careers';

  if (isCareer) {
    const resumeLink = document.getElementById('resumeLink')?.value.trim();
    if (!resumeLink || (!resumeLink.startsWith('http://') && !resumeLink.startsWith('https://'))) {
      alert("Please enter a valid public link (starting with https:// or http://) for your Resume / CV.");
      document.getElementById('resumeLink')?.focus();
      return;
    }
    alert("Thank you for applying to Sun Rise Sr. Sec. School!\n\nYour application and public resume link have been received by our recruitment desk. Our academic panel will review your profile and contact you soon.");
  } else {
    alert("Thank you for reaching out to Sun Rise Sr. Sec. School.\n\nYour message has been received by our campus office and we will contact you shortly.");
  }

  form.reset();
  toggleCareerFields();
}

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
