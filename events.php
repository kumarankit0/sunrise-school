<?php
$current_page = 'events-news';
$page_title = 'Events & News | School Happenings';
$page_description = 'Stay up-to-date with annual functions, science exhibitions, sports meets, national day celebrations, and academic announcements at Sun Rise Sr. Sec. School, Dobhi.';
$page_keywords = 'school events, upcoming events, science exhibition, sports meet, school news, Sun Rise School Dobhi';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section with Background Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary text-on-primary">
    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-65" style="background-image: url('<?= get_image('events', 'featured_banner', school_img('award_ceremony.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-primary/75 z-10"></div>
    <div class="relative z-20 max-w-6xl w-full mx-auto px-6 lg:px-12 flex flex-col items-center text-center gap-6">
      <div class="inline-flex items-center gap-2 bg-[#C9A24B] text-primary px-5 py-1.5 rounded-full text-eyebrow font-eyebrow uppercase tracking-widest font-bold shadow-md">
        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
        <?= get_text('events', 'featured_badge', 'Featured Event') ?>
      </div>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white font-bold w-full max-w-5xl leading-[1.18] drop-shadow-md"><?= get_text('events', 'featured_title', 'Annual Science & Art Exhibition 2026') ?></h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl leading-relaxed drop-shadow"><?= get_text('events', 'featured_subtitle', 'Experience the ingenuity of our students as they demonstrate live working science models, robotics experiments, sustainable agriculture concepts, and artistic creations.') ?></p>
      <div class="flex flex-wrap items-center justify-center gap-6 text-sm sm:text-base text-surface-cream font-medium">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#C9A24B]">calendar_today</span> Annual Session</span>
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#C9A24B]">schedule</span> <?= get_text('events', 'featured_time', '09:30 AM - 03:00 PM') ?></span>
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#C9A24B]">location_on</span> <?= get_text('events', 'featured_location', 'Main Campus Auditorium & Grounds') ?></span>
      </div>
      <a class="btn-gold text-base sm:text-lg px-8 py-3.5 shadow-xl mt-2" href="contact-us.php">
        <span>Inquire / Visit Campus</span>
        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
      </a>
    </div>
  </section>

  <!-- Main Content Layout (Grid + Sidebar) -->
  <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <!-- Events & News Grid (8 Cols) -->
      <div class="lg:col-span-8 flex flex-col gap-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <span class="text-eyebrow text-primary uppercase font-bold text-[#B38C37]">Happenings &amp; Notices</span>
            <h2 class="font-headline-md text-headline-md text-primary font-bold">School News &amp; Key Highlights</h2>
          </div>
          <!-- Filter Chips -->
          <div class="flex items-center gap-2 flex-wrap">
            <button class="event-filter-btn bg-primary text-on-primary px-4 py-2 rounded-lg text-label-sm transition-all shadow-sm font-bold" data-filter="all" onclick="filterEvents('all')">All</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="academic" onclick="filterEvents('academic')">Academic</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="cultural" onclick="filterEvents('cultural')">Celebrations</button>
            <button class="event-filter-btn bg-surface-container-high hover:bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-label-sm transition-all font-bold" data-filter="campus" onclick="filterEvents('campus')">Campus</button>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <?php
          $d1 = explode(' ', get_text('events', 'news1_date', '24 OCT'));
          $d2 = explode(' ', get_text('events', 'news2_date', '15 AUG'));
          $d3 = explode(' ', get_text('events', 'news3_date', '05 SEP'));
          $d4 = explode(' ', get_text('events', 'news4_date', '12 MAY'));
          $ag1 = explode(' ', get_text('events', 'agenda1_date', '10 OCT'));
          $ag2 = explode(' ', get_text('events', 'agenda2_date', '14 NOV'));
          $ag3 = explode(' ', get_text('events', 'agenda3_date', '22 DEC'));
          ?>
          <!-- Card 1: Science Exhibition -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="academic">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news1_img', school_img('exhibition7.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d1[0] ?? '24') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d1[1] ?? 'OCT') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news1_tag', 'Science Fair') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news1_title', 'District Level Science Model Showcase') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-3"><?= get_text('events', 'news1_desc', 'Students demonstrated innovative research prototypes and hydraulic mechanics models with outstanding presentation skills.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="gallery.php">
                View Gallery Photos <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 2: Independence Day -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="cultural">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news2_img', school_img('IMG_20210815_093156~2.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d2[0] ?? '15') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d2[1] ?? 'AUG') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news2_tag', 'National Day') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news2_title', 'Independence Day Flag Hoisting & Parade') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-3"><?= get_text('events', 'news2_desc', 'Celebrated with patriotic enthusiasm, tri-color flag unfurling by management, and spirited cultural performances.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="gallery.php">
                View Celebrations <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 3: Award Ceremony & Felicitation -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="campus">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news3_img', school_img('award_to_school.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d3[0] ?? '05') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d3[1] ?? 'SEP') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news3_tag', 'Honors') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news3_title', 'Institutional Excellence Award to School') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-3"><?= get_text('events', 'news3_desc', 'Sun Rise Sr. Sec. School recognized for exceptional academic standards and community educational leadership in Hisar region.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="about-us.php">
                Read About Us <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Card 4: News Coverage -->
          <div class="event-card bg-surface-pure rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group border border-border-warm" data-category="academic">
            <div class="relative h-56 overflow-hidden cursor-pointer" onclick="openLightbox(this)">
              <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('events', 'news4_img', school_img('image_news.webp')) ?>')"></div>
              <div class="absolute top-4 left-4 bg-primary text-on-primary p-3 rounded-lg text-center shadow-md">
                <span class="block font-headline-lg text-lg font-bold leading-none"><?= htmlspecialchars($d4[0] ?? '12') ?></span>
                <span class="block text-eyebrow uppercase text-[#C9A24B]"><?= htmlspecialchars($d4[1] ?? 'MAY') ?></span>
              </div>
              <span class="absolute bottom-3 right-3 bg-surface/90 backdrop-blur-md text-primary text-eyebrow px-3 py-1 rounded-md uppercase font-bold"><?= get_text('events', 'news4_tag', 'Press') ?></span>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between gap-4">
              <div>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold group-hover:text-[#C9A24B] transition-colors"><?= get_text('events', 'news4_title', 'Media Coverage: Board Exam Triumphs') ?></h3>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 line-clamp-3"><?= get_text('events', 'news4_desc', 'Prominent regional newspapers report on the extraordinary 100% HBSE board passing rate and high scoring records of our students.') ?></p>
              </div>
              <a class="inline-flex items-center gap-2 text-primary font-label-md group-hover:text-[#C9A24B] transition-colors mt-auto font-bold" href="admission.php">
                View Academic Results <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar (4 Cols) -->
      <div class="lg:col-span-4 flex flex-col gap-8">
        <!-- Academic Calendar Info Box -->
        <div class="bg-primary text-on-primary rounded-xl p-8 shadow-md relative overflow-hidden flex flex-col gap-6">
          <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-[#C9A24B]/10 rounded-full blur-2xl"></div>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-lg bg-[#C9A24B] flex items-center justify-center text-primary">
              <span class="material-symbols-outlined text-[24px]">description</span>
            </div>
            <div>
              <span class="text-eyebrow text-[#C9A24B] uppercase font-bold">Academic Schedule</span>
              <h3 class="font-headline-sm text-headline-sm font-bold text-on-primary"><?= get_text('events', 'calendar_title', 'School Calendar') ?></h3>
            </div>
          </div>
          <p class="font-body-md text-surface-cream text-body-md"><?= get_text('events', 'calendar_desc', 'Check term schedules, periodic unit tests, quarterly assessments, board pre-boards, and gazetted school holidays.') ?></p>
          <a class="btn-gold w-full text-center" href="academics.php">
            <span class="material-symbols-outlined text-[18px]">calendar_month</span> View Academic Syllabus
          </a>
        </div>

        <!-- Upcoming Events Mini-List -->
        <div class="bg-surface-pure rounded-xl p-6 shadow-sm border border-border-warm flex flex-col gap-6">
          <div class="flex items-center justify-between border-b border-border-warm pb-4">
            <h3 class="font-headline-sm text-headline-sm text-primary font-bold">Upcoming Agenda</h3>
            <span class="material-symbols-outlined text-primary">event_upcoming</span>
          </div>
          <div class="flex flex-col gap-5">
            <div class="flex items-start gap-4 pb-4 border-b border-border-warm/60 group">
              <div class="bg-surface-container-low text-primary p-2 rounded-lg text-center min-w-[50px]">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag1[0] ?? '10') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold"><?= htmlspecialchars($ag1[1] ?? 'OCT') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda1_title', 'Parent-Teacher Meeting (PTM)') ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> <?= get_text('events', 'agenda1_time', '09:00 AM - 01:00 PM') ?></span>
              </div>
            </div>
            <div class="flex items-start gap-4 pb-4 border-b border-border-warm/60 group">
              <div class="bg-surface-container-low text-primary p-2 rounded-lg text-center min-w-[50px]">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag2[0] ?? '14') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold"><?= htmlspecialchars($ag2[1] ?? 'NOV') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda2_title', "Children's Day Cultural Fest") ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> <?= get_text('events', 'agenda2_time', 'Full School Day') ?></span>
              </div>
            </div>
            <div class="flex items-start gap-4 pb-4 border-b border-border-warm/60 group">
              <div class="bg-surface-container-low text-primary p-2 rounded-lg text-center min-w-[50px]">
                <span class="block font-headline-md text-md font-bold leading-none"><?= htmlspecialchars($ag3[0] ?? '22') ?></span>
                <span class="block text-eyebrow text-[#C9A24B] uppercase font-bold"><?= htmlspecialchars($ag3[1] ?? 'DEC') ?></span>
              </div>
              <div class="flex flex-col gap-1">
                <h4 class="font-label-md text-primary group-hover:text-[#C9A24B] transition-colors leading-snug font-bold"><?= get_text('events', 'agenda3_title', 'National Mathematics Day Quiz') ?></h4>
                <span class="text-body-sm text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> <?= get_text('events', 'agenda3_time', '10:00 AM - 12:30 PM') ?></span>
              </div>
            </div>
          </div>
          <a class="text-primary font-label-md hover:text-[#C9A24B] transition-colors text-center py-2 border-t border-border-warm mt-2 font-bold" href="contact-us.php">Contact School Office for Inquiries →</a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
