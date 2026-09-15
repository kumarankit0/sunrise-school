<?php
$current_page = 'gallery';
$page_title = 'Visual Gallery & Campus Chronicle';
$page_description = 'Browse high-resolution photographs capturing academic exhibitions, sports events, award ceremonies, yoga sessions, and campus life at Sun Rise Sr. Sec. School, Dobhi.';
$page_keywords = 'photo gallery, campus photos, school life pictures, events photos, sports day, annual day, Sun Rise School gallery';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- Hero Section with Background Banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 flex items-center justify-center overflow-hidden bg-primary text-on-primary">
    <div class="absolute inset-0 opacity-65 bg-cover bg-center pointer-events-none" style="background-image: url('<?= school_img('exhibition1.webp') ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-primary/75"></div>
    <div class="max-w-6xl w-full mx-auto px-6 lg:px-12 relative z-10 flex flex-col items-center text-center gap-6">
      <span class="text-eyebrow text-gold-light uppercase font-bold tracking-widest bg-black/40 border border-[#C9A24B]/50 px-5 py-2 rounded-full shadow-md">Visual Chronicle</span>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white tracking-tight leading-[1.15] w-full max-w-5xl drop-shadow-md">Life &amp; Moments at Sun Rise School</h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl leading-relaxed drop-shadow">Explore photographs capturing academic curiosity, hands-on science exhibitions, athletic triumphs, yoga mornings, and merit celebrations across our Dobhi campus.</p>
      <div class="inline-flex items-center gap-2.5 bg-black/40 border border-[#C9A24B]/50 px-5 py-2.5 rounded-full text-gold-light font-bold text-sm shadow-md">
        <span class="material-symbols-outlined text-[#C9A24B]" style="font-variation-settings: 'FILL' 1;">photo_library</span>
        <span>Official School Photo Archive</span>
      </div>
    </div>
  </section>

  <!-- Filter Navigation Bar -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pt-12 pb-10 w-full">
    <div class="flex flex-wrap items-center justify-center gap-2.5 border-b border-border-warm pb-6" id="gallery-filters">
      <button class="gallery-filter-btn active" data-filter="all" onclick="filterGallery('all')">All Photos</button>
      <button class="gallery-filter-btn" data-filter="exhibitions" onclick="filterGallery('exhibitions')">Exhibitions &amp; Science</button>
      <button class="gallery-filter-btn" data-filter="events" onclick="filterGallery('events')">Events &amp; Awards</button>
      <button class="gallery-filter-btn" data-filter="sports" onclick="filterGallery('sports')">Sports &amp; Yoga</button>
      <button class="gallery-filter-btn" data-filter="toppers" onclick="filterGallery('toppers')">Toppers &amp; Merit</button>
      <button class="gallery-filter-btn" data-filter="campus" onclick="filterGallery('campus')">Campus &amp; Classes</button>
      <button class="gallery-filter-btn" data-filter="faculty" onclick="filterGallery('faculty')">Faculty &amp; Staff</button>
    </div>
  </section>

  <!-- Gallery Grid -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 pb-24 w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="gallery-grid">

      <!-- Item 1: Exhibitions -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="exhibitions" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('exhibition.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Exhibition</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Science &amp; Innovation</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Annual Science Exhibition</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Students presenting working models of solar technology and environmental systems.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 2: Events & Awards -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="events" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('award_ceremony.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Awards</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Felicitation</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Annual Prize Distribution</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Honoring academic and extracurricular achievers on stage with trophies.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 3: Sports & Fitness -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="sports" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('students_ground.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Sports</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Athletics</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Outdoor Ground Activities</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Students actively participating in outdoor sports, track drills, and team games.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 4: Yoga & Wellness -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="sports" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('yoga.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Wellness</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Morning Assembly</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">International Yoga Day</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Mass yoga demonstration cultivating discipline, physical stamina, and peace of mind.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 5: Toppers & Merit -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="toppers" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('toppers.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Board Toppers</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Merit Ranks</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">HBSC Board Exam Toppers</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Celebrating our star achievers securing top percentiles in Class 10 &amp; 12 exams.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 6: Shining Stars -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="toppers" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('shinning_stars.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Merit Board</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Star Performers</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Shining Stars of Sun Rise</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Outstanding scholarship winners and position holders across all school grades.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 7: Campus Building -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="campus" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('school_home1.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Campus</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Architecture</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Sun Rise School Front Elevation</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Grand campus frontage with landscaped green areas in Dobhi, Haryana.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 8: Classroom Sessions -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="campus" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('children_sitting.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Classroom</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Student Focus</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Primary Classroom Session</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Engaged primary students attentive during daily interactive classroom lectures.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 9: Science Lab Class -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="exhibitions" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('lab_class.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Science Lab</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Practical Learning</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Senior Science Lab Practicals</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Hands-on experimentation under the supervision of experienced physics &amp; chemistry faculty.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 10: Faculty Group -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="faculty" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('all_staffmembers.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Staff Team</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Academic Mentors</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Complete Teaching Faculty</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">The passionate educators steering Sun Rise Sr. Sec. School to educational greatness.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 11: Exhibition Project Display -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="exhibitions" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('exhibition3.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">Projects</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Student Innovation</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Interactive Science Models</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Creative working models designed by students demonstrating physics principles.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

      <!-- Item 12: Independence Day Celebration -->
      <div class="gallery-item group relative overflow-hidden rounded-2xl bg-surface-container shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-72" data-category="events" onclick="openLightbox(this)">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('<?= school_img('IMG_20210815_093156~2.webp') ?>')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-90"></div>
        <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold text-gold-light border border-[#C9A24B]/30 uppercase">National Day</div>
        <div class="absolute bottom-0 inset-x-0 p-6 flex flex-col justify-end">
          <span class="text-eyebrow text-gold-light uppercase mb-1">Patriotism</span>
          <h3 class="text-headline-sm text-lg font-bold text-white mb-1">Independence Day Celebration</h3>
          <p class="text-body-sm text-surface-dim line-clamp-1">Flag hoisting, patriotic songs, and cultural march-past by students.</p>
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-primary/30 backdrop-blur-[2px]">
          <div class="w-12 h-12 rounded-full bg-[#C9A24B] text-primary flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
            <span class="material-symbols-outlined text-2xl font-bold">zoom_in</span>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
