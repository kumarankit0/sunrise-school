<?php
require_once __DIR__ . '/core/config.php';
$current_page = 'faculty-staff';
$page_title = get_text('faculty', 'meta_title', 'Faculty & Staff | Academic Mentors');
$page_description = get_text('faculty', 'meta_desc', 'Meet the dedicated educators, mentors, and academic leadership team of Sun Rise Sr. Sec. School, Dobhi committed to holistic child development.');
$page_keywords = get_text('faculty', 'meta_keywords', 'faculty, teachers, school leadership, principal, department heads, staff directory, Sun Rise School Dobhi');

require_once __DIR__ . '/core/header.php';
?>

<div class="flex flex-col w-full bg-surface">
  <!-- 1. Hero banner — full image, no crop, no gap -->
  <section class="hero-section relative w-full bg-[#00122e]">
    <img
      src="<?= get_image('faculty', 'hero_banner', school_img('teachers_and_students.webp')) ?>"
      alt="Sun Rise School Faculty & Staff — Hero Banner"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />
    <div class="absolute inset-0 bg-gradient-to-b from-primary/50 via-primary/20 to-primary/65 pointer-events-none" style="z-index:5;"></div>
    <div class="hero-overlay-wrap">
      <div class="hero-content relative max-w-6xl w-full mx-auto px-4 sm:px-6 text-center flex flex-col items-center gap-3 sm:gap-5 lg:gap-6">
        <span class="hero-badge px-3.5 py-1 sm:px-5 sm:py-2 rounded-full bg-black/40 text-gold-light uppercase font-bold tracking-widest border border-[#C9A24B]/50 shadow-md"><?= get_text('faculty', 'hero_badge', 'Dedicated Educators') ?></span>
        <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md"><?= get_text('faculty', 'hero_title', 'Our Distinguished Faculty & Staff') ?></h1>
        <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl font-body drop-shadow"><?= get_text('faculty', 'hero_subtitle', 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.') ?></p>
      </div>
    </div>
  </section>


  <!-- 3. Faculty Showcase Section (Horizontal Image Left + Heading & Description with Read More Right) -->
  <section class="bg-surface-container-low py-8 sm:py-12 px-4 sm:px-6 lg:px-12 w-full border-t border-b border-border-warm/60">
    <div class="max-w-7xl mx-auto">
      <div class="bg-surface-pure rounded-2xl p-5 sm:p-6 lg:p-8 shadow-md border border-border-warm relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
          
          <!-- Left Column: Horizontal Showcase Image -->
          <div class="lg:col-span-6">
            <div class="relative w-full h-64 sm:h-72 md:h-80 lg:h-96 rounded-xl overflow-hidden shadow-md border border-border-warm group">
              <img src="<?= get_image('faculty', 'staff_showcase_img', school_img('all_staffmembers.webp')) ?>" 
                   alt="<?= get_image_alt('faculty', 'staff_showcase_img', 'Teaching Faculty & Mentors - Sun Rise Sr. Sec. School') ?>" 
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                   loading="lazy" decoding="async">
              <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-transparent to-transparent pointer-events-none"></div>
              <span class="absolute bottom-3 left-3 bg-[#C9A24B] text-primary text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded shadow-sm">
                <?= get_text('faculty', 'staff_badge', 'Dedicated Faculty') ?>
              </span>
            </div>
          </div>

          <!-- Right Column: Heading & Description with Read More -->
          <div class="lg:col-span-6 flex flex-col justify-between gap-3 text-on-surface leading-relaxed text-xs sm:text-sm">
            <div>
              <span class="text-eyebrow text-[#B38C37] uppercase font-bold tracking-widest text-[11px] block mb-1">
                <?= get_text('faculty', 'staff_section_eyebrow', 'Our Teaching Force') ?>
              </span>
              <h2 class="text-lg sm:text-xl lg:text-2xl font-headline-lg font-bold text-primary tracking-tight leading-snug mb-3">
                <?= get_text('faculty', 'staff_section_title', 'Mentors in Action') ?>
              </h2>
              
              <?php
              $raw_faculty_texts = [
                  get_text('faculty', 'staff_story_p1', 'At Sun Rise Sr. Sec. School, our faculty represents a dedicated team of passionate educators, subject specialists, and compassionate mentors committed to nurturing every student\'s intellectual, creative, and moral growth.'),
                  get_text('faculty', 'staff_story_p2', 'Our teachers combine traditional pedagogical rigor with modern interactive teaching techniques, ensuring students develop conceptual clarity, critical thinking, and confidence in every academic discipline.'),
                  get_text('faculty', 'staff_story_p3', 'Through personalized guidance, regular remedial sessions, and co-curricular mentorship, our educators foster a vibrant learning environment where curiosity thrives and values endure.'),
                  get_text('faculty', 'staff_story_p4', '')
              ];

              $faculty_paragraphs = [];
              foreach ($raw_faculty_texts as $raw_text) {
                  if (empty(trim($raw_text))) continue;
                  if (stripos($raw_text, '<p') !== false) {
                      preg_match_all('/<p\b[^>]*>(.*?)<\/p>/is', $raw_text, $matches);
                      if (!empty($matches[1])) {
                          foreach ($matches[1] as $p_inner) {
                              $plain = trim(html_entity_decode(strip_tags($p_inner), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                              if (!empty($plain)) {
                                  $faculty_paragraphs[] = trim($p_inner);
                              }
                          }
                          continue;
                      }
                  }
                  $parts = preg_split('/(\r\n\r\n|\n\n|\r\r)+/', trim($raw_text));
                  foreach ($parts as $part) {
                      $plain = trim(html_entity_decode(strip_tags($part), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                      if (!empty($plain)) {
                          $faculty_paragraphs[] = trim($part);
                      }
                  }
              }

              $primary_faculty_paragraphs = array_slice($faculty_paragraphs, 0, 2);
              $remaining_faculty_paragraphs = array_slice($faculty_paragraphs, 2);
              ?>

              <!-- Primary Visible Paragraphs (First 2) -->
              <div class="space-y-3 font-body-md text-on-surface-variant leading-relaxed text-xs sm:text-sm">
                <?php foreach ($primary_faculty_paragraphs as $p): ?>
                  <p><?= $p ?></p>
                <?php endforeach; ?>
              </div>

              <?php if (!empty($remaining_faculty_paragraphs)): ?>
                <!-- Expandable Read More Section for Remaining Paragraphs -->
                <div id="facultyMoreWrapper" class="hidden flex-col gap-3 pt-3 border-t border-border-warm/70 mt-3 space-y-3 font-body-md text-on-surface-variant leading-relaxed text-xs sm:text-sm transition-all duration-300">
                  <?php foreach ($remaining_faculty_paragraphs as $p): ?>
                    <p><?= $p ?></p>
                  <?php endforeach; ?>
                </div>

                <!-- Read More / Read Less Toggle Button -->
                <div class="pt-3">
                  <button type="button" 
                          id="facultyToggleBtn" 
                          onclick="toggleFacultyExpand()" 
                          class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:text-primary transition-all uppercase tracking-wider py-1.5 px-3.5 rounded-lg bg-secondary hover:bg-[#F3C352] cursor-pointer border border-secondary focus:outline-none shadow-sm">
                    <span id="facultyToggleText">Read More</span>
                    <span id="facultyToggleIcon" class="material-symbols-outlined text-[16px] transition-transform duration-300">expand_more</span>
                  </button>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function toggleFacultyExpand() {
      const wrapper = document.getElementById('facultyMoreWrapper');
      const btnText = document.getElementById('facultyToggleText');
      const btnIcon = document.getElementById('facultyToggleIcon');
      if (!wrapper || !btnText || !btnIcon) return;

      const isHidden = wrapper.classList.contains('hidden');
      if (isHidden) {
        wrapper.classList.remove('hidden');
        wrapper.classList.add('flex');
        btnText.textContent = 'Read Less';
        btnIcon.style.transform = 'rotate(180deg)';
      } else {
        wrapper.classList.add('hidden');
        wrapper.classList.remove('flex');
        btnText.textContent = 'Read More';
        btnIcon.style.transform = 'rotate(0deg)';
      }
    }
  </script>

  <!-- 4. Academic Departments -->
  <section class="w-full py-8 sm:py-12 bg-primary text-white border-t border-b border-[#C9A24B]/30 relative overflow-hidden">
    <!-- Ambient Background Glows -->
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#C9A24B]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
      <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-8">
        <span class="text-eyebrow text-[#C9A24B] uppercase tracking-widest block mb-1 font-bold text-xs"><?= get_text('faculty', 'dept_section_eyebrow', 'Academic Departments') ?></span>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-headline-lg font-bold text-white tracking-tight leading-snug mb-1.5"><?= get_text('faculty', 'dept_section_title', 'Subject Faculties') ?></h2>
        <p class="text-body-md text-surface-cream/80 text-xs sm:text-sm"><?= get_text('faculty', 'dept_section_desc', 'Our academic faculties comprise qualified, HBSE-trained educators with specialized postgraduate degrees in their respective disciplines.') ?></p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- 1. Science (Light Sky/Blue Theme) -->
        <div class="bg-[#EFF6FF] p-4 sm:p-5 rounded-xl border border-[#BFDBFE] hover:border-[#3B82F6] shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-on-surface group">
          <div>
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#DBEAFE] text-[#1D4ED8] flex items-center justify-center mb-3 shadow-xs group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-xl"><?= get_text('faculty', 'dept1_icon', 'science') ?></span>
            </div>
            <h3 class="font-bold text-[#1E3A8A] text-sm sm:text-base mb-1.5"><?= get_text('faculty', 'dept1_title', 'Science Faculty') ?></h3>
            <p class="text-xs text-[#1E40AF]/85 mb-3 leading-relaxed"><?= get_text('faculty', 'dept1_desc', 'Physics, Chemistry, Biology & General Science with hands-on lab experiments and Olympiad guidance.') ?></p>
          </div>
          <div class="pt-2.5 border-t border-[#BFDBFE] flex items-center justify-between text-xs font-bold text-[#1E3A8A]">
            <span><?= get_text('faculty', 'dept1_tag1', 'PGT & TGT Staff') ?></span>
            <span class="text-[#2563EB] text-[11px] bg-[#DBEAFE] px-2 py-0.5 rounded"><?= get_text('faculty', 'dept1_tag2', 'Labs & Theory') ?></span>
          </div>
        </div>

        <!-- 2. Mathematics (Light Amber/Gold Theme) -->
        <div class="bg-[#FFFBEB] p-4 sm:p-5 rounded-xl border border-[#FDE68A] hover:border-[#F59E0B] shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-on-surface group">
          <div>
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#FEF3C7] text-[#D97706] flex items-center justify-center mb-3 shadow-xs group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-xl"><?= get_text('faculty', 'dept2_icon', 'calculate') ?></span>
            </div>
            <h3 class="font-bold text-[#78350F] text-sm sm:text-base mb-1.5"><?= get_text('faculty', 'dept2_title', 'Mathematics') ?></h3>
            <p class="text-xs text-[#92400E]/85 mb-3 leading-relaxed"><?= get_text('faculty', 'dept2_desc', 'Focusing on conceptual clarity, speed calculations, problem-solving techniques, and competitive readiness.') ?></p>
          </div>
          <div class="pt-2.5 border-t border-[#FDE68A] flex items-center justify-between text-xs font-bold text-[#78350F]">
            <span><?= get_text('faculty', 'dept2_tag1', 'Primary to 12th') ?></span>
            <span class="text-[#B45309] text-[11px] bg-[#FEF3C7] px-2 py-0.5 rounded"><?= get_text('faculty', 'dept2_tag2', 'Math Lab') ?></span>
          </div>
        </div>

        <!-- 3. Commerce & Humanities (Light Lavender/Purple Theme) -->
        <div class="bg-[#FAF5FF] p-4 sm:p-5 rounded-xl border border-[#E9D5FF] hover:border-[#A855F7] shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-on-surface group">
          <div>
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#F3E8FF] text-[#9333EA] flex items-center justify-center mb-3 shadow-xs group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-xl"><?= get_text('faculty', 'dept3_icon', 'trending_up') ?></span>
            </div>
            <h3 class="font-bold text-[#581C87] text-sm sm:text-base mb-1.5"><?= get_text('faculty', 'dept3_title', 'Commerce & Humanities') ?></h3>
            <p class="text-xs text-[#6B21A8]/85 mb-3 leading-relaxed"><?= get_text('faculty', 'dept3_desc', 'Accountancy, Business Studies, Economics, Political Science, History, and Hindi/English Languages.') ?></p>
          </div>
          <div class="pt-2.5 border-t border-[#E9D5FF] flex items-center justify-between text-xs font-bold text-[#581C87]">
            <span><?= get_text('faculty', 'dept3_tag1', 'Senior Secondary') ?></span>
            <span class="text-[#7E22CE] text-[11px] bg-[#F3E8FF] px-2 py-0.5 rounded"><?= get_text('faculty', 'dept3_tag2', 'Career Focus') ?></span>
          </div>
        </div>

        <!-- 4. Sports & Physical Ed (Light Peach/Warm Orange Theme) -->
        <div class="bg-[#FFF7ED] p-4 sm:p-5 rounded-xl border border-[#FED7AA] hover:border-[#F97316] shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-on-surface group">
          <div>
            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#FFEDD5] text-[#EA580C] flex items-center justify-center mb-3 shadow-xs group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-xl"><?= get_text('faculty', 'dept4_icon', 'sports_kabaddi') ?></span>
            </div>
            <h3 class="font-bold text-[#7C2D12] text-sm sm:text-base mb-1.5"><?= get_text('faculty', 'dept4_title', 'Physical Ed. & Yoga') ?></h3>
            <p class="text-xs text-[#9A3412]/85 mb-3 leading-relaxed"><?= get_text('faculty', 'dept4_desc', 'Daily physical fitness, specialized sports coaching (Cricket, Kabaddi, Athletics), and morning yoga sessions.') ?></p>
          </div>
          <div class="pt-2.5 border-t border-[#FED7AA] flex items-center justify-between text-xs font-bold text-[#7C2D12]">
            <span><?= get_text('faculty', 'dept4_tag1', 'Sports Coaches') ?></span>
            <span class="text-[#C2410C] text-[11px] bg-[#FFEDD5] px-2 py-0.5 rounded"><?= get_text('faculty', 'dept4_tag2', 'All Grades') ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Join Our Team CTA -->
  <section class="bg-primary text-on-primary py-10 sm:py-12 px-6 lg:px-12">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
      <div class="flex flex-col gap-1.5">
        <span class="text-eyebrow text-[#C9A24B] uppercase font-bold text-xs"><?= get_text('faculty', 'cta_eyebrow', 'Career Opportunities') ?></span>
        <h3 class="text-xl sm:text-2xl font-bold text-white"><?= get_text('faculty', 'cta_heading', 'Want to Join Our Teaching Team?') ?></h3>
        <p class="text-body-md text-surface-cream/80 max-w-xl text-xs sm:text-sm"><?= get_text('faculty', 'cta_desc', 'We are always looking for passionate, certified educators who love teaching and inspiring students. Submit your application online with your public resume link (Google Drive / LinkedIn).') ?></p>
      </div>
      <a class="btn-gold shrink-0" href="<?= htmlspecialchars(get_text('faculty', 'cta_btn_link', 'contact-us.php#careers')) ?>">
        <span><?= get_text('faculty', 'cta_btn_text', 'Apply Online with Resume Link') ?></span>
        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
      </a>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
