<?php
$current_page = 'alumni';
$page_title = 'Alumni Network | Past Students & Distinguished Achievers';
$page_description = 'Connect with Sun Rise Sr. Sec. School Alumni Network. Explore the inspiring career journeys of past students excelling in Defence, Medicine, Engineering, Civil Services, and Academia.';
$page_keywords = 'Sun Rise school alumni, Dobhi school ex-students, alumni network Hisar, student achievements, alumni directory, HBSE toppers';

require_once __DIR__ . '/core/header.php';

$alumni_cards = get_alumni_cards(false);
?>

<div class="flex flex-col w-full bg-surface text-on-surface">
  <!-- Section 1: Hero Banner — matches about-us.php layout -->
  <section class="hero-section relative w-full bg-[#00122e]">
    <img
      src="<?= get_image('alumni', 'hero_banner', school_img('school_home2.webp')) ?>"
      alt="Sun Rise Sr. Sec. School — Alumni Network Hero Banner"
      class="hero-full-img"
      loading="eager"
      decoding="async"
    />
    <!-- Gradient overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/50 via-primary/20 to-primary/65 pointer-events-none" style="z-index:5;"></div>
    <!-- Text content overlay — centered over the image -->
    <div class="hero-overlay-wrap">
      <div class="hero-content relative max-w-6xl w-full mx-auto px-4 sm:px-6 text-center flex flex-col items-center gap-3.5 sm:gap-5">
        <span class="hero-badge text-gold-light uppercase tracking-widest font-bold bg-black/40 border border-[#C9A24B]/50 px-3.5 py-1.5 rounded-full shadow-md text-xs sm:text-sm">
          <?= get_text('alumni', 'hero_badge', 'Our Global Legacy &amp; Pride') ?>
        </span>
        <h1 class="hero-heading font-headline-lg font-bold text-white w-full max-w-4xl tracking-tight drop-shadow-md text-2xl sm:text-4xl lg:text-5xl">
          <?= get_text('alumni', 'hero_title', 'Sun Rise Alumni Network') ?>
        </h1>
        <p class="hero-subtitle text-surface-cream/95 w-full max-w-3xl mx-auto font-body drop-shadow text-xs sm:text-sm lg:text-base leading-relaxed">
          <?= get_text('alumni', 'hero_subtitle', 'Celebrating the journeys, accomplishments, and inspiring contributions of our past students excelling across defence, medicine, technology, academia, and public service worldwide.') ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Section 2: Milestones & Alumni Stat Strip — matches about-us.php -->
  <section class="relative z-20 max-w-4xl lg:max-w-5xl mx-auto px-4 sm:px-6 -mt-6 sm:-mt-8 w-full">
    <div class="bg-gradient-to-r from-[#00122e] via-[#0b2647] to-[#00122e] text-white rounded-xl sm:rounded-2xl shadow-[0_10px_30px_-5px_rgba(0,17,41,0.5)] py-3.5 sm:py-4 px-3 sm:px-6 grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-4 border border-[#C9A24B]/35 backdrop-blur-sm">
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('alumni', 'stat1_num', '2007') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('alumni', 'stat1_lbl', 'Year Established') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('alumni', 'stat2_num', '1500+') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('alumni', 'stat2_lbl', 'Graduated Alumni') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('alumni', 'stat3_num', '100%') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('alumni', 'stat3_lbl', 'Board Pass Record') ?></span>
      </div>
      <div class="flex flex-col items-center text-center py-1 sm:py-1.5 px-2 md:border-l md:border-white/15">
        <span class="font-display-hero text-lg sm:text-xl lg:text-2xl font-bold text-[#F3C352] tracking-tight"><?= get_text('alumni', 'stat4_num', '50+') ?></span>
        <span class="font-eyebrow text-[9px] sm:text-[11px] text-slate-200/90 uppercase mt-0.5 sm:mt-1 font-semibold tracking-wider leading-tight"><?= get_text('alumni', 'stat4_lbl', 'Global Careers &amp; Fields') ?></span>
      </div>
    </div>
  </section>

  <!-- Section 3: Alumni Directory & Dynamic Cards Grid (Compact & Perfect Height) -->
  <section class="py-10 sm:py-14 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
      <span class="font-eyebrow text-eyebrow uppercase text-[#C9A24B] mb-1 block font-bold tracking-wider text-xs">
        <?= get_text('alumni', 'cards_eyebrow', 'Distinguished Ex-Students') ?>
      </span>
      <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-primary tracking-tight">
        <?= get_text('alumni', 'cards_heading', 'Inspiring Journeys &amp; Success Stories') ?>
      </h2>
      <div class="w-16 h-1 bg-gradient-to-r from-primary via-[#C9A24B] to-primary mx-auto mt-2 rounded-full"></div>
      <p class="text-xs sm:text-sm text-on-surface-variant mt-2.5 max-w-2xl mx-auto leading-relaxed">
        <?= get_text('alumni', 'cards_desc', 'Our alumni continue to make notable strides across industries and institutions. Discover their career milestones and fond memories from their formative years at Sun Rise.') ?>
      </p>
    </div>

    <!-- Cards Grid -->
    <?php if (!empty($alumni_cards)): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
        <?php foreach ($alumni_cards as $card): 
          $has_link = !empty($card['link']) && trim($card['link']) !== '';
        ?>
          <div class="bg-white rounded-2xl border border-border-warm hover:border-[#C9A24B] shadow-sm hover:shadow-xl transition-all duration-300 p-5 flex flex-col justify-between group relative overflow-hidden">
            <!-- Subtle Ambient Corner Glow -->
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-[#C9A24B]/10 rounded-full blur-2xl group-hover:bg-[#C9A24B]/20 transition-all pointer-events-none"></div>

            <div>
              <!-- Top Profile Info Header -->
              <div class="flex items-center gap-3.5">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden border-2 border-[#C9A24B]/60 shadow-sm shrink-0 bg-gray-100 cursor-pointer" onclick="openLightbox(this)">
                  <img 
                    src="<?= htmlspecialchars($card['photo']) ?>" 
                    alt="<?= htmlspecialchars($card['name']) ?>" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    loading="lazy"
                    onerror="this.onerror=null; this.src='assets/images/logo.svg';"
                  />
                </div>
                <div class="min-w-0 flex-1">
                  <h3 class="text-base sm:text-lg font-bold text-primary truncate leading-snug">
                    <?= htmlspecialchars($card['name']) ?>
                  </h3>
                  <?php if (!empty($card['batch'])): ?>
                    <span class="inline-block mt-0.5 text-[10px] sm:text-[11px] font-bold text-[#8a681c] bg-[#C9A24B]/15 px-2.5 py-0.5 rounded-full border border-[#C9A24B]/30">
                      <?= htmlspecialchars($card['batch']) ?>
                    </span>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Current Role & Organization -->
              <div class="mt-3.5 space-y-1">
                <?php if (!empty($card['role'])): ?>
                  <div class="text-xs sm:text-sm font-bold text-slate-800 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-[#C9A24B]">work</span>
                    <span class="truncate"><?= htmlspecialchars($card['role']) ?></span>
                  </div>
                <?php endif; ?>

                <?php if (!empty($card['org'])): ?>
                  <div class="text-[11px] sm:text-xs text-slate-500 font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[15px] text-slate-400">account_balance</span>
                    <span class="truncate"><?= htmlspecialchars($card['org']) ?></span>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Compact Quote / Memory Box -->
              <?php if (!empty($card['quote'])): ?>
                <div class="mt-3 p-3 rounded-xl bg-surface-cream/50 border-l-2 border-[#C9A24B] text-[11px] sm:text-xs text-slate-600 italic leading-relaxed">
                  &ldquo;<?= htmlspecialchars($card['quote']) ?>&rdquo;
                </div>
              <?php endif; ?>
            </div>

            <!-- Bottom Action / Connect Link -->
            <div class="pt-3 mt-3 border-t border-border-warm/80 flex items-center justify-between text-[11px]">
              <span class="text-slate-400 font-medium flex items-center gap-1">
                <span class="material-symbols-outlined text-[13px] text-[#C9A24B]">verified</span>
                <span>Verified Alumnus</span>
              </span>

              <?php if ($has_link): ?>
                <a 
                  href="<?= htmlspecialchars($card['link']) ?>" 
                  target="_blank" 
                  rel="noopener noreferrer" 
                  class="font-bold text-[#C9A24B] hover:text-primary transition flex items-center gap-1 group/btn"
                >
                  <span>Connect</span>
                  <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
              <?php else: ?>
                <span class="text-slate-400 font-semibold text-[10px] uppercase">Sun Rise Dobhi</span>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300 p-8">
        <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">groups</span>
        <h4 class="font-bold text-gray-700">Alumni Directory Updating</h4>
        <p class="text-xs text-gray-500 mt-1">Our alumni profiles are currently being refreshed by the administrative office.</p>
      </div>
    <?php endif; ?>
  </section>

  <!-- Section 4: Reconnect & Join Alumni Directory CTA Banner -->
  <section class="py-8 sm:py-10 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto w-full">
    <div class="bg-gradient-to-br from-primary via-[#082247] to-primary text-white rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-[#C9A24B]/30 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
      <!-- Ambient Glow Orb -->
      <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-[#C9A24B]/15 rounded-full blur-3xl pointer-events-none"></div>

      <div class="space-y-2 max-w-2xl relative z-10 text-center md:text-left">
        <div class="inline-flex items-center gap-1.5 bg-[#C9A24B] text-primary px-3 py-1 rounded-full text-[11px] font-bold uppercase shadow-xs">
          <span class="material-symbols-outlined text-[15px]">diversity_3</span>
          <span>Stay Connected</span>
        </div>
        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight">
          <?= get_text('alumni', 'cta_title', 'Are You a Sun Rise Alumnus?') ?>
        </h3>
        <p class="text-surface-cream/90 text-xs sm:text-sm leading-relaxed">
          <?= get_text('alumni', 'cta_desc', 'Join our official alumni network to mentor graduating batches, attend annual reunions, and share your inspiring career milestones with your alma mater.') ?>
        </p>
      </div>

      <div class="flex flex-wrap items-center gap-3 relative z-10 flex-shrink-0">
        <a 
          href="<?= htmlspecialchars(get_text('alumni', 'cta_btn1_url', 'contact-us.php')) ?>" 
          class="btn-gold inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-primary shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all"
        >
          <span class="material-symbols-outlined text-[18px]">badge</span>
          <span><?= get_text('alumni', 'cta_btn1_text', 'Submit Alumni Profile') ?></span>
        </a>

        <?php if (!empty($social_whatsapp)): ?>
          <a 
            href="<?= htmlspecialchars($social_whatsapp) ?>" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-sm transition-all"
          >
            <span class="material-symbols-outlined text-[18px]">chat</span>
            <span>WhatsApp Connect</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<?php
require_once __DIR__ . '/core/footer.php';
?>
