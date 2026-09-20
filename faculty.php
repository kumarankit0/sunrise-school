<?php
$current_page = 'faculty-staff';
$page_title = get_text('faculty', 'meta_title', 'Faculty & Staff | Academic Mentors');
$page_description = get_text('faculty', 'meta_desc', 'Meet the dedicated educators, mentors, and academic leadership team of Sun Rise Sr. Sec. School, Dobhi committed to holistic child development.');
$page_keywords = get_text('faculty', 'meta_keywords', 'faculty, teachers, school leadership, principal, department heads, staff directory, Sun Rise School Dobhi');

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- 1. Hero banner -->
  <section class="hero-section relative w-full min-h-[60vh] sm:min-h-[70vh] lg:min-h-[85vh] py-14 sm:py-20 lg:py-28 bg-primary text-on-primary px-4 sm:px-6 lg:px-12 overflow-hidden flex flex-col justify-center items-center text-center">
    <div class="absolute inset-0 bg-cover bg-center pointer-events-none" style="background-image: url('<?= get_image('faculty', 'hero_banner', school_img('teachers_and_students.webp')) ?>')"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/35 via-primary/10 to-primary/50"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-surface-tint/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#C9A24B]/10 blur-3xl pointer-events-none"></div>
    <div class="hero-content relative z-10 max-w-6xl w-full mx-auto flex flex-col items-center gap-3 sm:gap-5 lg:gap-6">
      <span class="hero-badge px-3.5 py-1 sm:px-5 sm:py-2 rounded-full bg-black/40 text-gold-light uppercase font-bold tracking-widest border border-[#C9A24B]/50 shadow-md"><?= get_text('faculty', 'hero_badge', 'Dedicated Educators') ?></span>
      <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md"><?= get_text('faculty', 'hero_title', 'Our Distinguished Faculty & Staff') ?></h1>
      <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl font-body drop-shadow"><?= get_text('faculty', 'hero_subtitle', 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.') ?></p>
    </div>
  </section>

  <!-- 2. Leadership Section -->
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
      <div>
        <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold"><?= get_text('faculty', 'leadership_eyebrow', 'Guiding Vision') ?></span>
        <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug"><?= get_text('faculty', 'leadership_title', 'Academic Leadership') ?></h2>
      </div>
      <p class="text-body-md text-on-surface-variant max-w-md"><?= get_text('faculty', 'leadership_desc', 'Guiding our academic ecosystem with years of pedagogical expertise, administrative brilliance, and a steadfast commitment to character building.') ?></p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Founder & Director: Mr. Bhader Singh Swami -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#C9A24B] rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'leader1_photo', 'Mr. Bhader Singh Swami - Founder & Director') ?>" src="<?= get_image('faculty', 'leader1_photo', school_img('speaker.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold"><?= get_text('faculty', 'leader1_tag', 'Founder & Director') ?></div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader1_name', 'Mr. Bhader Singh Swami') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-2"><?= get_text('faculty', 'leader1_sub', 'Founder & Director | M.A., B.Ed.') ?></p>
          <div class="inline-block bg-[#F9F4E8] text-[#B38C37] text-xs font-bold px-2.5 py-1 rounded mb-4 border border-[#C9A24B]/30">
            <?= get_text('faculty', 'leader1_exp', '36 Yrs Teaching • 26 Yrs Management') ?>
          </div>
          <blockquote class="text-body-sm italic text-on-surface-variant mb-4 font-headline-md border-l-2 border-[#C9A24B] pl-3">
            <?= get_text('faculty', 'leader1_quote', '“Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant leading-relaxed"><?= get_text('faculty', 'leader1_desc', 'With 36 years of teaching experience and 26 years of experience in school management, Mr. Bhader Singh Swami has devoted his journey to education. Holding M.A. and B.Ed. qualifications, his vision centres on providing students with quality education grounded in discipline, values, character, and academic excellence.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold"><?= get_text('faculty', 'leader1_foot_left', 'Institutional Founder') ?></span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">verified</span> <?= get_text('faculty', 'leader1_foot_right', 'Estd. 2007') ?>
          </span>
        </div>
      </div>

      <!-- Principal: Mr. Rajbir Singh -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'leader2_photo', 'Mr. Rajbir Singh - Principal') ?>" src="<?= get_image('faculty', 'leader2_photo', school_img('teachers_sitting.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold"><?= get_text('faculty', 'leader2_tag', 'Principal Office') ?></div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader2_name', 'Mr. Rajbir Singh') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-2"><?= get_text('faculty', 'leader2_sub', 'Principal | M.A., B.Ed.') ?></p>
          <div class="inline-block bg-[#F9F4E8] text-[#B38C37] text-xs font-bold px-2.5 py-1 rounded mb-4 border border-[#C9A24B]/30">
            <?= get_text('faculty', 'leader2_exp', '16 Years Professional Experience') ?>
          </div>
          <blockquote class="text-body-sm italic text-on-surface-variant mb-4 font-headline-md border-l-2 border-[#C9A24B] pl-3">
            <?= get_text('faculty', 'leader2_quote', '“Fostering a disciplined and purposeful learning environment where every student receives balanced opportunities for academic and holistic development.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant leading-relaxed"><?= get_text('faculty', 'leader2_desc', 'With 16 years of professional experience in education, Mr. Rajbir Singh serves as the Principal. He brings a committed approach towards academic administration, supporting teachers and driving holistic student growth.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold"><?= get_text('faculty', 'leader2_foot_left', 'Academic Head') ?></span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">school</span> <?= get_text('faculty', 'leader2_foot_right', 'HBSE Lead') ?>
          </span>
        </div>
      </div>

      <!-- Coordinator: Mr. Indra Dev -->
      <div class="bg-surface-pure rounded-xl p-8 shadow-[0_2px_8px_rgba(11,38,71,0.04)] hover:shadow-[0_12px_28px_rgba(11,38,71,0.08)] transition-all duration-300 flex flex-col justify-between border border-border-warm relative group">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#C9A24B] rounded-t-xl"></div>
        <div>
          <div class="relative w-full h-72 mb-6 rounded-lg overflow-hidden bg-surface-container cursor-pointer" onclick="openLightbox(this)">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= get_image_alt('faculty', 'leader3_photo', 'Mr. Indra Dev - Coordinator') ?>" src="<?= get_image('faculty', 'leader3_photo', school_img('all_staffmembers.webp')) ?>" width="400" height="288" loading="lazy" decoding="async"/>
            <div class="absolute bottom-3 left-3 bg-primary/85 backdrop-blur-md text-on-primary text-label-sm px-3 py-1 rounded font-bold"><?= get_text('faculty', 'leader3_tag', 'Administration & Coordination') ?></div>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary"><?= get_text('faculty', 'leader3_name', 'Mr. Indra Dev') ?></h3>
          <p class="text-label-md text-[#B38C37] font-semibold mb-2"><?= get_text('faculty', 'leader3_sub', 'Coordinator | B.A., M.A., LL.B., LL.M.') ?></p>
          <div class="inline-block bg-[#F9F4E8] text-[#B38C37] text-xs font-bold px-2.5 py-1 rounded mb-4 border border-[#C9A24B]/30">
            <?= get_text('faculty', 'leader3_exp', '22 Yrs Exp • Former GM, Reserve Bank of India') ?>
          </div>
          <blockquote class="text-body-sm italic text-on-surface-variant mb-4 font-headline-md border-l-2 border-[#C9A24B] pl-3">
            <?= get_text('faculty', 'leader3_quote', '“Maintaining the highest standards of organizational discipline, legal governance, and responsible institutional leadership.”') ?>
          </blockquote>
          <p class="text-body-sm text-on-surface-variant leading-relaxed"><?= get_text('faculty', 'leader3_desc', 'Mr. Indra Dev brings 22 years of professional experience with qualifications in law and humanities. Prior to Sun Rise, he served as General Manager at the Reserve Bank of India (RBI), contributing high administrative standards.') ?></p>
        </div>
        <div class="mt-8 pt-6 border-t border-border-warm flex items-center justify-between">
          <span class="text-label-sm text-primary font-bold"><?= get_text('faculty', 'leader3_foot_left', 'Administration Lead') ?></span>
          <span class="text-label-sm text-[#B38C37] font-bold flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">groups</span> <?= get_text('faculty', 'leader3_foot_right', '30+ Teaching Staff') ?>
          </span>
        </div>
      </div>
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
  <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="text-eyebrow text-[#B38C37] uppercase tracking-widest block mb-2 font-bold"><?= get_text('faculty', 'dept_section_eyebrow', 'Academic Departments') ?></span>
      <h2 class="text-[1.1rem] sm:text-[1.2rem] font-headline-lg font-bold text-primary tracking-tight leading-snug mb-4"><?= get_text('faculty', 'dept_section_title', 'Subject Faculties') ?></h2>
      <p class="text-body-md text-on-surface-variant"><?= get_text('faculty', 'dept_section_desc', 'Our academic faculties comprise qualified, HBSE-trained educators with specialized postgraduate degrees in their respective disciplines.') ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Science -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
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
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
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

      <!-- Commerce & Arts -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-lg bg-[#F9F4E8] flex items-center justify-center text-[#B38C37] mb-4">
            <span class="material-symbols-outlined text-[26px]"><?= get_text('faculty', 'dept3_icon', 'query_stats') ?></span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-primary mb-2"><?= get_text('faculty', 'dept3_title', 'Commerce & Humanities') ?></h3>
          <p class="text-body-sm text-on-surface-variant mb-4"><?= get_text('faculty', 'dept3_desc', 'Accountancy, Business Studies, Economics, Political Science, History, and Hindi/English Languages.') ?></p>
        </div>
        <div class="pt-4 border-t border-border-warm flex items-center justify-between text-label-sm font-bold text-primary">
          <span><?= get_text('faculty', 'dept3_tag1', 'Senior Secondary') ?></span>
          <span class="text-[#B38C37]"><?= get_text('faculty', 'dept3_tag2', 'Career Focus') ?></span>
        </div>
      </div>

      <!-- Physical Education & Sports -->
      <div class="bg-surface-pure p-6 rounded-xl border border-border-warm shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
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
