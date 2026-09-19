<?php
$current_page = 'faculty-staff';
$page_title = 'Faculty & Staff | Academic Mentors';
$page_description = 'Meet the dedicated educators, mentors, and academic leadership team of Sun Rise Sr. Sec. School, Dobhi committed to holistic child development.';
$page_keywords = 'faculty, teachers, school leadership, principal, department heads, staff directory, Sun Rise School Dobhi';

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- 1. Hero banner -->
  <section class="relative w-full min-h-[80vh] lg:min-h-[85vh] py-20 lg:py-28 bg-primary text-on-primary px-6 lg:px-12 overflow-hidden flex flex-col justify-center items-center text-center">
    <div class="absolute inset-0 bg-cover bg-center pointer-events-none" style="background-image: url('<?= get_image('faculty', 'hero_banner', school_img('teachers_and_students.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-surface-tint/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="relative z-10 max-w-6xl w-full mx-auto flex flex-col items-center gap-6">
      <span class="px-5 py-2 rounded-full bg-black/40 text-gold-light text-eyebrow uppercase font-bold tracking-widest border border-[#C9A24B]/50 shadow-md"><?= get_text('faculty', 'hero_badge', 'Dedicated Educators') ?></span>
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline-lg text-white w-full max-w-5xl tracking-tight leading-[1.15] drop-shadow-md"><?= get_text('faculty', 'hero_title', 'Our Distinguished Faculty & Staff') ?></h1>
      <p class="text-lg sm:text-xl md:text-2xl text-surface-cream/95 w-full max-w-4xl font-body leading-relaxed drop-shadow"><?= get_text('faculty', 'hero_subtitle', 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.') ?></p>
    </div>
  </section>

  <!-- 2. Leadership Section -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
      <div>
        <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold">Guiding Vision</span>
        <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary">Academic Leadership</h2>
      </div>
      <p class="text-body-md text-on-surface-variant max-w-md">Guiding our academic ecosystem with years of pedagogical expertise, administrative brilliance, and a steadfast commitment to character building.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Director / Managing Committee -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#C9A24B] rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="School Management & Leadership" src="<?= get_image('faculty', 'leader1_photo', school_img('speaker.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold">Managing Director</div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader1_name', 'Managing Committee') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-4"><?= get_text('faculty', 'leader1_sub', 'Sun Rise Educational Trust, Dobhi') ?></p>
          <blockquote class="text-body-md italic text-on-surface-variant mb-6 font-headline-md border-l-2 border-[#C9A24B] pl-4">
            <?= get_text('faculty', 'leader1_quote', '“True education is the bedrock of character, empowering students to rise above ordinary standards and achieve extraordinary goals.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant"><?= get_text('faculty', 'leader1_desc', 'Providing strategic guidance, modern educational infrastructure, and a community-first commitment to quality education in rural and semi-urban Haryana.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold">Executive Board</span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">verified</span> Sun Rise School
          </span>
        </div>
      </div>

      <!-- Principal -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Principal, Sun Rise School" src="<?= get_image('faculty', 'leader2_photo', school_img('teachers_sitting.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold">Principal Office</div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader2_name', 'Office of the Principal') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-4"><?= get_text('faculty', 'leader2_sub', 'M.A., M.Ed. – Senior Academician') ?></p>
          <blockquote class="text-body-md italic text-on-surface-variant mb-6 font-headline-md border-l-2 border-[#C9A24B] pl-4">
            <?= get_text('faculty', 'leader2_quote', '“We cultivate an environment where discipline meets curiosity, ensuring every child discovers their inner spark and thrives academically.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant"><?= get_text('faculty', 'leader2_desc', 'Championing NEP 2020-aligned experiential learning, state-level competitive exam coaching, and holistic sports and cultural development.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold">Academic Head</span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">school</span> HBSE Lead
          </span>
        </div>
      </div>

      <!-- Faculty Council -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#C9A24B] rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Academic Coordinators & Faculty" src="<?= get_image('faculty', 'leader3_photo', school_img('all_staffmembers.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold">Academic Council</div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader3_name', 'Senior Coordinators') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-4"><?= get_text('faculty', 'leader3_sub', 'Post Graduate Teachers (PGT / TGT)') ?></p>
          <blockquote class="text-body-md italic text-on-surface-variant mb-6 font-headline-md border-l-2 border-[#C9A24B] pl-4">
            <?= get_text('faculty', 'leader3_quote', '“Teamwork, continuous faculty workshops, and individualized student attention form the backbone of our outstanding board results.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant"><?= get_text('faculty', 'leader3_desc', 'Coordinating Science, Commerce, and Arts streams with rigorous periodic assessments and personalized student counseling.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold">Department Heads</span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">groups</span> 45+ Teachers
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. Faculty Photo Gallery Section -->
  <section class="bg-surface-container-low py-20 px-6 lg:px-12 w-full">
    <div class="max-w-7xl mx-auto">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold">Our Teaching Force</span>
        <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary mb-4">Mentors in Action</h2>
        <p class="text-body-md text-on-surface-variant">Capturing the dedication, teamwork, and pedagogical spirit of the Sun Rise Sr. Sec. School teaching community.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Photo 1 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="All Staff Members - Sun Rise School" src="<?= get_image('faculty', 'staff_img1', school_img('all_staffmembers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Full Staff Group</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title1', 'Sun Rise Teaching & Admin Staff') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 2 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Teachers and Students - Sun Rise School" src="<?= get_image('faculty', 'staff_img2', school_img('teachers_and_students.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Mentorship</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title2', 'Faculty & High Achievers') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 3 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Teachers Meeting - Sun Rise School" src="<?= get_image('faculty', 'staff_img3', school_img('teachers_sitting.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Academic Session</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title3', 'Faculty Planning & Review') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 4 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="School Staff Members" src="<?= get_image('faculty', 'staff_img4', school_img('school_staff.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Staff Team</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title4', 'Department Educators') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 5 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Teachers Panel" src="<?= get_image('faculty', 'staff_img5', school_img('teachers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Pedagogy</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title5', 'Senior School Mentors') ?></h4>
            </div>
          </div>
        </div>

        <!-- Photo 6 -->
        <div class="bg-surface-pure rounded-xl overflow-hidden border border-border-warm shadow-sm hover:shadow-lg transition-all group cursor-pointer" onclick="openLightbox(this)">
          <div class="relative h-64 overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Students with Teachers" src="<?= get_image('faculty', 'staff_img6', school_img('students_teachers.webp')) ?>" width="400" height="256" loading="lazy" decoding="async"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute bottom-4 left-4 right-4 text-white">
              <span class="text-[11px] font-bold uppercase bg-[#C9A24B] text-primary px-2.5 py-0.5 rounded inline-block mb-1">Campus Life</span>
              <h4 class="font-headline-sm text-sm text-white"><?= get_text('faculty', 'staff_title6', 'Student & Mentor Bonding') ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Academic Departments -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold">Academic Departments</span>
      <h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary mb-4">Subject Faculties</h2>
      <p class="text-body-md text-on-surface-variant">Our academic faculties comprise qualified, HBSE-trained educators with specialized postgraduate degrees in their respective disciplines.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Science -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
            <span class="material-symbols-outlined text-[26px]">science</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Science Faculty</h3>
          <p class="text-body-sm text-on-surface-variant mb-4">Physics, Chemistry, Biology &amp; General Science with hands-on lab experiments and Olympiad guidance.</p>
        </div>
        <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
          <span>PGT &amp; TGT Staff</span>
          <span class="text-[#B38C37]">Labs &amp; Theory</span>
        </div>
      </div>

      <!-- Mathematics -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
            <span class="material-symbols-outlined text-[26px]">calculate</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Mathematics</h3>
          <p class="text-body-sm text-on-surface-variant mb-4">Focusing on conceptual clarity, speed calculations, problem-solving techniques, and competitive readiness.</p>
        </div>
        <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
          <span>Primary to 12th</span>
          <span class="text-[#B38C37]">Math Lab</span>
        </div>
      </div>

      <!-- Commerce & Arts -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
            <span class="material-symbols-outlined text-[26px]">query_stats</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Commerce &amp; Humanities</h3>
          <p class="text-body-sm text-on-surface-variant mb-4">Accountancy, Business Studies, Economics, Political Science, History, and Hindi/English Languages.</p>
        </div>
        <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
          <span>Senior Secondary</span>
          <span class="text-[#B38C37]">Career Focus</span>
        </div>
      </div>

      <!-- Physical Education & Sports -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
            <span class="material-symbols-outlined text-[26px]">sports_kabaddi</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Physical Ed. &amp; Yoga</h3>
          <p class="text-body-sm text-on-surface-variant mb-4">Daily physical fitness, specialized sports coaching (Cricket, Kabaddi, Athletics), and morning yoga sessions.</p>
        </div>
        <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
          <span>Sports Coaches</span>
          <span class="text-[#B38C37]">All Grades</span>
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
      <a class="btn-gold shrink-0" href="contact-us.php">
        <span>Apply as Educator</span>
        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
      </a>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
