<?php
$current_page = 'campus-life';
$page_title = 'Campus Life & Infrastructure | Sun Rise Sr. Sec. School';
$page_description = 'Explore the sprawling campus of Sun Rise Sr. Sec. School, Dobhi featuring modern science & computer labs, sports grounds, yoga spaces, smart classrooms, and safe transport.';
$page_keywords = 'school campus, science labs, smart classrooms, sports ground, yoga, campus life, Sun Rise School Dobhi, safe school';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full">
  <!-- Hero Section -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary text-on-primary px-6 lg:px-12 overflow-hidden flex items-center justify-center text-center">
    <div class="absolute inset-0 bg-cover bg-center pointer-events-none" style="background-image: url('<?= get_image('campus', 'hero_banner', school_img('school.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="relative max-w-6xl w-full mx-auto flex flex-col items-center text-center gap-6 z-10">
      <div class="inline-flex items-center gap-2.5 bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full text-gold-light text-eyebrow uppercase font-bold shadow-md">
        <span class="material-symbols-outlined text-[18px] text-[#C9A24B]">domain</span> <?= get_text('campus', 'hero_badge', 'Modern Campus Infrastructure') ?>
      </div>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white w-full max-w-5xl tracking-tight leading-[1.15] drop-shadow-md">
        <?= get_text('campus', 'hero_title', 'A Vibrant & Safe Campus Built for Excellence') ?>
      </h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl leading-relaxed drop-shadow">
        <?= get_text('campus', 'hero_subtitle', 'Explore our purpose-built campus in Dobhi, Haryana designed to nurture academic focus, athletic vigor, scientific curiosity, and cultural creativity.') ?>
      </p>
      <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 pt-3">
        <a class="btn-gold text-base sm:text-lg px-8 py-3.5 shadow-xl" href="#facilities-grid">Explore Facilities</a>
        <a class="btn-outline-white text-base sm:text-lg px-8 py-3.5 shadow-xl" href="contact-us.php">
          <span class="material-symbols-outlined text-[20px]">calendar_month</span> Book Campus Tour
        </a>
      </div>
    </div>
  </section>

  <!-- Facilities Grid Section -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20" id="facilities-grid">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
      <div>
        <span class="text-eyebrow uppercase text-[#C9A24B] font-bold"><?= get_text('campus', 'facilities_eyebrow', 'Campus Infrastructure') ?></span>
        <h2 class="font-headline-lg text-headline-lg text-primary mt-2"><?= get_text('campus', 'facilities_heading', 'Facilities for Holistic Growth') ?></h2>
      </div>
      <p class="text-body-md text-on-surface-variant max-w-md">
        <?= get_text('campus', 'facilities_desc', 'Every wing of Sun Rise Sr. Sec. School is thoughtfully equipped to ensure total safety, hygiene, modern learning tools, and joyful childhood development.') ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Smart Classrooms -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac1_img', school_img('children_sitting.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">tv</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac1_tag', 'Interactive Learning') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac1_title', 'Spacious Classrooms') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac1_desc', 'Well-ventilated, naturally lit classrooms with ergonomic student seating, audio-visual display aids, and positive wall aesthetics.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">Airy &amp; Child-Friendly</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Science & Composite Lab -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac2_img', school_img('exhibition2.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">science</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac2_tag', 'Hands-On Discovery') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac2_title', 'Advanced Science Lab') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac2_desc', 'Fully equipped practical laboratories for Physics, Chemistry, and Biology adhering strictly to HBSE safety benchmarks and experimental standards.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">HBSE Norms Compliant</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Sports Ground & Athletics -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac3_img', school_img('students_ground.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">sports_soccer</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac3_tag', 'Athletics & Games') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac3_title', 'Extensive Sports Ground') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac3_desc', 'Expansive outdoor sports grounds for Cricket, Kabaddi, Volleyball, Track Athletics, and regular physical education drills under trained coaches.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">Dedicated Coaching</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Yoga & Wellness Center -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac4_img', school_img('yoga.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">self_improvement</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac4_tag', 'Mind & Body') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac4_title', 'Yoga & Meditation Arena') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac4_desc', 'Daily morning pranayama, Surya Namaskar, and guided mindfulness sessions helping students cultivate razor-sharp concentration and calm emotional health.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">Daily Wellness Habit</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Project & Exhibition Hall -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac5_img', school_img('project.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">lightbulb</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac5_tag', 'Creative Expression') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac5_title', 'Exhibition & Project Hall') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac5_desc', 'Dedicated space for student science models, social science exhibitions, art displays, and community awareness presentations.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">Annual Exhibitions</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Assembly & Prayer Courtyard -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group cursor-pointer" onclick="openLightbox(this)">
        <div class="relative h-64 overflow-hidden">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'fac6_img', school_img('children_praying.webp')) ?>')"></div>
          <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
            <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
          </div>
        </div>
        <div class="p-8 flex flex-col flex-1 justify-between gap-6">
          <div class="flex flex-col gap-3">
            <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'fac6_tag', 'Character & Values') ?></span>
            <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('campus', 'fac6_title', 'Morning Assembly Courtyard') ?></h3>
            <p class="text-body-md text-on-surface-variant">
              <?= get_text('campus', 'fac6_desc', 'Where the whole school unites each morning for prayers, national anthem, news recitation, inspirational speeches, and student felicitations.') ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between">
            <span class="text-label-sm text-primary font-bold">Values &amp; Unity</span>
            <span class="material-symbols-outlined text-[#C9A24B] group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>

      <!-- Night View / 24x7 Campus Infrastructure -->
      <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-border-warm flex flex-col group md:col-span-2 lg:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="relative h-64 md:h-auto overflow-hidden cursor-pointer" onclick="openLightbox(this)">
            <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= get_image('campus', 'safety_img', school_img('school_nightview.webp')) ?>')"></div>
            <div class="absolute top-4 left-4 bg-primary/85 backdrop-blur-md text-on-primary p-2.5 rounded-lg">
              <span class="material-symbols-outlined text-[20px]">security</span>
            </div>
          </div>
          <div class="p-8 lg:p-12 flex flex-col justify-between gap-6 bg-surface-container-low">
            <div class="flex flex-col gap-3">
              <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'safety_tag', 'Uncompromising Safety') ?></span>
              <h3 class="font-headline-md text-headline-md text-primary"><?= get_text('campus', 'safety_title', 'Secure, CCTV Monitored Campus') ?></h3>
              <p class="text-body-lg text-on-surface-variant">
                <?= get_text('campus', 'safety_desc', 'Our campus in Dobhi is fully enclosed with perimeter boundary security, 24/7 CCTV surveillance across corridors, gates, and play areas, filtered RO drinking water, and dedicated power backup.') ?>
              </p>
              <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">check_circle</span>
                  <span class="text-body-sm font-bold text-primary">24/7 CCTV</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">check_circle</span>
                  <span class="text-body-sm font-bold text-primary">RO Pure Water</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[#C9A24B]">check_circle</span>
                  <span class="text-body-sm font-bold text-primary">Clean Sanitation</span>
                </div>
              </div>
            </div>
            <div class="pt-6 border-t border-border-warm flex items-center justify-between">
              <span class="text-label-md text-primary font-bold">Zero-Compromise Safety</span>
              <a class="btn-primary" href="contact-us.php">
                <span>Plan a Visit</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Photo Gallery Preview CTA -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-20">
    <div class="bg-primary text-on-primary rounded-2xl p-12 lg:p-16 relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
      <div class="absolute inset-0 opacity-15 bg-cover bg-center" style="background-image: url('<?= get_image('campus', 'cta_bg', school_img('school_home1.webp')) ?>')"></div>
      <div class="relative z-10 flex flex-col gap-4 max-w-2xl">
        <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('campus', 'cta_eyebrow', 'Experience Sun Rise School') ?></span>
        <h2 class="font-headline-lg text-headline-lg text-surface"><?= get_text('campus', 'cta_heading', 'Want to see more campus moments?') ?></h2>
        <p class="text-body-lg text-primary-fixed-dim">
          <?= get_text('campus', 'cta_desc', 'Browse through our full visual chronicle containing photographs from academic exhibitions, sports days, award ceremonies, and everyday school celebrations.') ?>
        </p>
      </div>
      <div class="relative z-10 flex flex-col sm:flex-row gap-4">
        <a class="btn-gold" href="gallery.php">
          <span>Explore Photo Gallery</span>
        </a>
        <a class="btn-outline-white" href="contact-us.php">
          <span>Book Campus Visit</span>
        </a>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
