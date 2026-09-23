<?php
require_once __DIR__ . '/core/config.php';
$current_page = 'faculty-staff';
$page_title = get_text('faculty', 'meta_title', 'Faculty & Staff | Academic Mentors');
$page_description = get_text('faculty', 'meta_desc', 'Meet the dedicated educators, mentors, and academic leadership team of Sun Rise Sr. Sec. School, Dobhi committed to holistic child development.');
$page_keywords = get_text('faculty', 'meta_keywords', 'faculty, teachers, school leadership, principal, department heads, staff directory, Sun Rise School Dobhi');

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- 1. Hero banner -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 bg-primary text-on-primary px-4 sm:px-6 lg:px-12 overflow-hidden flex flex-col justify-center items-center text-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none hero-bg-banner" style="background-image: url('<?= get_image('faculty', 'hero_banner', school_img('teachers_and_students.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-surface-tint/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="hero-content relative z-10 max-w-6xl w-full mx-auto flex flex-col items-center gap-3 sm:gap-5 lg:gap-6">
      <span class="hero-badge px-3.5 py-1 sm:px-5 sm:py-2 rounded-full bg-black/40 text-gold-light uppercase font-bold tracking-widest border border-[#C9A24B]/50 shadow-md"><?= get_text('faculty', 'hero_badge', 'Dedicated Educators') ?></span>
      <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md"><?= get_text('faculty', 'hero_title', 'Our Distinguished Faculty & Staff') ?></h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl font-body drop-shadow"><?= get_text('faculty', 'hero_subtitle', 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.') ?></p>
    </div>
  </section>


  <!-- 3. Faculty Photo Gallery Section -->
  <section class="bg-surface-container-low py-20 px-6 lg:px-12 w-full">
    <div class="max-w-7xl mx-auto">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold"><?= get_text('faculty', 'staff_section_eyebrow', 'Our Teaching Force') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mb-4"><?= get_text('faculty', 'staff_section_title', 'Mentors in Action') ?></h2>
        <p class="text-body-md text-on-surface-variant"><?= get_text('faculty', 'staff_section_desc', 'Capturing the dedication, teamwork, and pedagogical spirit of the Sun Rise Sr. Sec. School teaching community.') ?></p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Photo 1 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img1', 'All Staff Members - Sun Rise School') ?>" src="<?= get_image('faculty', 'staff_img1', school_img('all_staffmembers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge1', 'Full Staff Group') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title1', 'Sun Rise Teaching & Admin Staff') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 2 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img2', 'Teachers and Students - Sun Rise School') ?>" src="<?= get_image('faculty', 'staff_img2', school_img('teachers_and_students.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge2', 'Mentorship') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title2', 'Faculty & High Achievers') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 3 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img3', 'Teachers Meeting - Sun Rise School') ?>" src="<?= get_image('faculty', 'staff_img3', school_img('teachers_sitting.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge3', 'Academic Session') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title3', 'Faculty Planning & Review') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 4 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img4', 'School Staff Members') ?>" src="<?= get_image('faculty', 'staff_img4', school_img('school_staff.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge4', 'Staff Team') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title4', 'Department Educators') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 5 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img5', 'Teachers Panel') ?>" src="<?= get_image('faculty', 'staff_img5', school_img('teachers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge5', 'Pedagogy') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title5', 'Senior School Mentors') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 6 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'staff_img6', 'Students with Teachers') ?>" src="<?= get_image('faculty', 'staff_img6', school_img('students_teachers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1"><?= get_text('faculty', 'staff_badge6', 'Campus Life') ?></span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title6', 'Student & Mentor Bonding') ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Academic Departments -->
  <section class="w-full py-20 sm:py-24 bg-[#eaf0f8] border-t border-b border-[#000e21]/10" style="background-color: rgb(234 240 248 / var(--tw-bg-opacity, 1));">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold"><?= get_text('faculty', 'dept_section_eyebrow', 'Academic Departments') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mb-4"><?= get_text('faculty', 'dept_section_title', 'Subject Faculties') ?></h2>
        <p class="text-body-md text-on-surface-variant"><?= get_text('faculty', 'dept_section_desc', 'Our academic faculties comprise qualified, HBSE-trained educators with specialized postgraduate degrees in their respective disciplines.') ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Science -->
        <div class="bg-surface p-6 rounded-2xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('faculty', 'dept1_icon', 'science') ?></span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-2"><?= get_text('faculty', 'dept1_title', 'Science Faculty') ?></h3>
            <p class="text-body-sm text-on-surface-variant mb-4"><?= get_text('faculty', 'dept1_desc', 'Physics, Chemistry, Biology & General Science with hands-on lab experiments and Olympiad guidance.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
            <span><?= get_text('faculty', 'dept1_tag1', 'PGT & TGT Staff') ?></span>
            <span class="text-[#B38C37]"><?= get_text('faculty', 'dept1_tag2', 'Labs & Theory') ?></span>
          </div>
        </div>

        <!-- Mathematics -->
        <div class="bg-surface p-6 rounded-2xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('faculty', 'dept2_icon', 'calculate') ?></span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-2"><?= get_text('faculty', 'dept2_title', 'Mathematics') ?></h3>
            <p class="text-body-sm text-on-surface-variant mb-4"><?= get_text('faculty', 'dept2_desc', 'Focusing on conceptual clarity, speed calculations, problem-solving techniques, and competitive readiness.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
            <span><?= get_text('faculty', 'dept2_tag1', 'Primary to 12th') ?></span>
            <span class="text-[#B38C37]"><?= get_text('faculty', 'dept2_tag2', 'Math Lab') ?></span>
          </div>
        </div>

        <!-- Commerce & Humanities -->
        <div class="bg-surface p-6 rounded-2xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('faculty', 'dept3_icon', 'trending_up') ?></span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-2"><?= get_text('faculty', 'dept3_title', 'Commerce & Humanities') ?></h3>
            <p class="text-body-sm text-on-surface-variant mb-4"><?= get_text('faculty', 'dept3_desc', 'Accountancy, Business Studies, Economics, Political Science, History, and Hindi/English Languages.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
            <span><?= get_text('faculty', 'dept3_tag1', 'Senior Secondary') ?></span>
            <span class="text-[#B38C37]"><?= get_text('faculty', 'dept3_tag2', 'Career Focus') ?></span>
          </div>
        </div>

        <!-- Sports & Physical Ed -->
        <div class="bg-surface p-6 rounded-2xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
              <span class="material-symbols-outlined text-[26px]"><?= get_text('faculty', 'dept4_icon', 'sports_kabaddi') ?></span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-primary mb-2"><?= get_text('faculty', 'dept4_title', 'Physical Ed. & Yoga') ?></h3>
            <p class="text-body-sm text-on-surface-variant mb-4"><?= get_text('faculty', 'dept4_desc', 'Daily physical fitness, specialized sports coaching (Cricket, Kabaddi, Athletics), and morning yoga sessions.') ?></p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
            <span><?= get_text('faculty', 'dept4_tag1', 'Sports Coaches') ?></span>
            <span class="text-[#B38C37]"><?= get_text('faculty', 'dept4_tag2', 'All Grades') ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Join Our Team CTA -->
  <section class="bg-primary text-on-primary py-16 px-6 lg:px-12">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
      <div class="flex flex-col gap-2">
        <span class="text-eyebrow text-[#C9A24B] uppercase font-bold"><?= get_text('faculty', 'cta_eyebrow', 'Career Opportunities') ?></span>
        <h3 class="text-headline-md font-bold"><?= get_text('faculty', 'cta_heading', 'Want to Join Our Teaching Team?') ?></h3>
        <p class="text-body-md text-on-primary-container max-w-xl"><?= get_text('faculty', 'cta_desc', 'We are always looking for passionate, certified educators who love teaching and inspiring students. Send us your resume.') ?></p>
      </div>
      <a class="btn-gold shrink-0" href="<?= htmlspecialchars(get_text('faculty', 'cta_btn_link', 'contact-us.php')) ?>">
        <span><?= get_text('faculty', 'cta_btn_text', 'Apply as Educator') ?></span>
        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
      </a>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
