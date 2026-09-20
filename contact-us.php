<?php
$current_page = 'contact';
$page_title = 'Contact Us | Campus Office & Admissions';
$page_description = 'Get in touch with Sun Rise Sr. Sec. School, Dobhi (Hisar, Haryana). Find campus directions, office hours, direct helpline numbers, and online contact form.';
$page_keywords = 'contact Sun Rise School, Dobhi Hisar school contact, school phone number, campus location, admission inquiry';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary px-6 lg:px-12 text-on-primary overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center pointer-events-none" style="background-image: url('<?= get_image('contact', 'hero_banner', school_img('school3.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="max-w-6xl w-full mx-auto relative z-10 flex flex-col items-center text-center gap-6">
      <span class="font-eyebrow text-eyebrow uppercase text-gold-light tracking-[0.2em] font-bold bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full shadow-md"><?= get_text('contact', 'hero_badge', 'Get in Touch') ?></span>
      <h1 class="text-[1.65rem] sm:text-[1.85rem] md:text-[2rem] font-headline-lg font-bold tracking-tight text-white w-full max-w-4xl leading-[1.2] drop-shadow-md"><?= get_text('contact', 'hero_title', 'Connect with Sun Rise School') ?></h1>
      <p class="text-sm sm:text-base md:text-lg text-surface-cream/95 w-full max-w-3xl leading-relaxed drop-shadow"><?= get_text('contact', 'hero_subtitle', 'We welcome parents, prospective students, and guardians to visit our campus or get in touch for admissions, bus routes, and general inquiries.') ?></p>
    </div>
  </section>

  <!-- Main Content Layout -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      <!-- Left Column: Contact Form (Elevated Card) -->
      <div class="lg:col-span-7 bg-surface-pure p-8 lg:p-12 rounded-2xl shadow-sm relative border border-border-warm">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-[#C9A24B] rounded-t-2xl"></div>
        <div class="mb-8">
          <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-2 block font-bold"><?= get_text('contact', 'form_eyebrow', 'Inquiry Desk') ?></span>
          <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('contact', 'form_heading', 'Send Us a Message') ?></h2>
          <p class="font-body-md text-on-surface-variant mt-2"><?= get_text('contact', 'form_desc', 'Fill out the quick form below and our administrative team will respond to your queries promptly.') ?></p>
        </div>
        <form class="space-y-6" onsubmit="event.preventDefault(); alert('Thank you for reaching out to Sun Rise Sr. Sec. School. Your message has been received.'); this.reset();">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold" for="fullName">Your Full Name <span class="text-error">*</span></label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-body-md focus:outline-none focus:border-primary transition-colors" id="fullName" placeholder="e.g. Ramesh Kumar" required="" type="text"/>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold" for="email">Email Address</label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-body-md focus:outline-none focus:border-primary transition-colors" id="email" placeholder="e.g. ramesh@example.com" type="email"/>
            </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold" for="phone">Phone Number <span class="text-error">*</span></label>
              <input class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-body-md focus:outline-none focus:border-primary transition-colors" id="phone" placeholder="+91 70158 90094" required="" type="tel"/>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-md text-primary font-bold" for="department">Inquiry Type</label>
              <select class="h-12 px-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-body-md focus:outline-none focus:border-primary transition-colors" id="department">
                <option>Admissions (Nursery to 12th)</option>
                <option>School Bus &amp; Transport</option>
                <option>Fee Structure &amp; Concessions</option>
                <option>Faculty / Career Application</option>
                <option>General Administration</option>
              </select>
            </div>
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-primary font-bold" for="message">Message / Details <span class="text-error">*</span></label>
            <textarea class="p-4 bg-surface-container-low rounded-lg border border-border-warm text-on-surface text-body-md focus:outline-none focus:border-primary transition-colors resize-none" id="message" placeholder="Please mention student's current class, address, and any specific questions you have..." required="" rows="5"></textarea>
          </div>
          <button class="btn-gold w-full text-center h-14" type="submit">
            <span>Submit Message</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </button>
        </form>
      </div>

      <!-- Right Column: Contact Details, Map & Locations -->
      <div class="lg:col-span-5 flex flex-col gap-8">
        <!-- Contact Info Card -->
        <div class="bg-surface-container-low p-8 rounded-2xl relative shadow-sm border border-border-warm">
          <h3 class="font-headline-sm text-primary font-bold mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-[#C9A24B]">location_city</span>
            Campus Information
          </h3>
          <div class="space-y-6">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold">School Address</h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5"><?= htmlspecialchars($site_address) ?></p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="material-symbols-outlined text-primary text-[20px]">call</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold">Office Helpline</h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5 flex flex-col gap-1">
                  <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone) ?>" class="text-primary font-bold hover:underline"><?= $site_phone ?></a>
                  <?php if (!empty($site_phone_alt)): ?>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $site_phone_alt) ?>" class="text-primary font-bold hover:underline"><?= $site_phone_alt ?></a>
                  <?php endif; ?>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="material-symbols-outlined text-primary text-[20px]">mail</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold">Official Email</h4>
                <p class="font-body-sm text-on-surface-variant mt-0.5">
                  <a href="mailto:<?= $site_email ?>" class="text-primary font-bold hover:underline"><?= $site_email ?></a>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="material-symbols-outlined text-primary text-[20px]">schedule</span>
              </div>
              <div>
                <h4 class="font-label-md text-primary font-bold">School &amp; Office Timings</h4>
                <div class="font-body-sm text-on-surface-variant mt-0.5 flex flex-col gap-1">
                  <div><strong>Summer Season:</strong> 7:30 AM – 1:30 PM</div>
                  <div><strong>Winter Season:</strong> 8:30 AM – 2:30 PM</div>
                  <div class="text-xs text-on-surface-variant/80">Visiting Days: Monday to Saturday (Sunday Closed)</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Campus Image Card -->
        <div class="w-full h-64 rounded-2xl overflow-hidden shadow-sm relative border border-border-warm cursor-pointer" onclick="openLightbox(this)">
          <div class="w-full h-full bg-cover bg-center" style="background-image: url('<?= get_image('contact', 'campus_photo', school_img('school2.webp')) ?>')"></div>
          <div class="absolute bottom-3 left-3 bg-surface/90 backdrop-blur-md px-3.5 py-1.5 rounded-lg text-body-sm font-bold text-primary shadow-sm flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[#C9A24B] text-[16px]">domain</span>
            <span><?= get_text('contact', 'campus_caption', 'Sun Rise Campus View, Dobhi') ?></span>
          </div>
        </div>

        <!-- Academic Wings -->
        <div class="bg-surface-container-low p-8 rounded-2xl shadow-sm border border-border-warm">
          <h3 class="font-headline-sm text-primary font-bold mb-4">Academic Wings</h3>
          <div class="space-y-4">
            <div class="p-4 bg-surface-pure rounded-xl border border-border-warm">
              <h4 class="font-label-md text-primary font-bold"><?= get_text('contact', 'wing1_title', 'Primary & Middle Wing') ?></h4>
              <p class="font-body-sm text-on-surface-variant mt-1"><?= get_text('contact', 'wing1_desc', 'Nursery to Class 8 – Holistic foundation and activity-based learning') ?></p>
            </div>
            <div class="p-4 bg-surface-pure rounded-xl border border-border-warm">
              <h4 class="font-label-md text-primary font-bold"><?= get_text('contact', 'wing2_title', 'Secondary & Senior Secondary Wing') ?></h4>
              <p class="font-body-sm text-on-surface-variant mt-1"><?= get_text('contact', 'wing2_desc', 'Class 9 to 12 – HBSE Board, Science (Medical/Non-Med), Commerce & Arts') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Instant WhatsApp Banner -->
  <section class="bg-primary text-on-primary py-16 px-6 lg:px-12 my-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
      <div class="flex items-center gap-6">
        <div class="w-16 h-16 rounded-full bg-emerald-600 flex items-center justify-center flex-shrink-0 shadow-lg">
          <span class="material-symbols-outlined text-white text-[32px]">chat</span>
        </div>
        <div>
          <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] tracking-[0.15em] font-bold">Quick WhatsApp Helpline</span>
          <h3 class="font-headline-md text-headline-md-mobile lg:text-headline-md font-bold mt-1">Chat Instantly with Admission Desk</h3>
          <p class="font-body-md text-on-primary-container mt-1">Have quick questions regarding admissions, transport routes, or fees? Reach us directly on WhatsApp.</p>
        </div>
      </div>
      <a class="bg-emerald-600 hover:bg-emerald-700 text-white font-label-md px-8 h-14 rounded-xl transition-colors flex items-center gap-3 shadow-md flex-shrink-0 font-bold" href="https://wa.me/917015890094" target="_blank" rel="noopener">
        <span class="material-symbols-outlined text-[24px]">chat</span>
        <span>Open WhatsApp Chat</span>
      </a>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
