<?php
/**
 * Superuser Admin CMS Dashboard
 * Sun Rise Sr. Sec. School, Dobhi
 *
 * Full-featured visual administration interface organized section-by-section
 * from top to bottom matching each webpage. Allows superusers to edit text,
 * rich HTML, and replace images directly without opening codebase.
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/content_helper.php';

// Enforce authentication
require_login();

$user = get_logged_in_user();
$active_tab = $_GET['tab'] ?? 'home';
$success_msg = $_GET['success'] ?? '';
$error_msg = $_GET['error'] ?? '';

/**
 * Helper to generate browser-safe image preview URLs for the admin panel
 */
if (!function_exists('get_admin_img_preview')) {
    function get_admin_img_preview($src) {
        if (empty($src)) {
            return '../assets/images/logo.svg';
        }
        if (strpos($src, 'http://') === 0 || strpos($src, 'https://') === 0 || strpos($src, 'data:') === 0) {
            return $src;
        }
        // Strip any leading ../ or / and decode any existing percent-encoding to prevent %2520 double-encoding
        $clean = preg_replace('#^(\.\./|/)+#', '', $src);
        $decoded = rawurldecode($clean);
        $parts = explode('/', $decoded);
        $encoded_parts = array_map('rawurlencode', $parts);
        return '../' . implode('/', $encoded_parts);
    }
}

// Scan committed school assets for quick picker
$school_assets_dir = __DIR__ . '/../assets/images/sunrise school image/';
$available_school_images = [];
if (is_dir($school_assets_dir)) {
    $scanned_files = scandir($school_assets_dir);
    foreach ($scanned_files as $f) {
        if ($f !== '.' && $f !== '..' && preg_match('/\.(webp|jpg|jpeg|png)$/i', $f)) {
            $available_school_images[] = $f;
        }
    }
    sort($available_school_images);
}

// Define all editable sections grouped by page, ordered strictly from top to bottom
$pages_config = [
    'home' => [
        'title' => 'Home Page',
        'icon'  => 'home',
        'desc'  => 'Complete Home Page Control: 6 Hero Slider Photos, Ticker Strip, Legacy Stats, 3 Pillars, Director & Principal Messages, Events, 12 Gallery Photos, Affiliations & CTA',
        'sections' => [
            // Section 1: Hero Banner, 4-Direction Mosaic Box Slider & Headlines
            [
                'title' => 'Section 1: Hero Mosaic Slider & Headlines (6 Slide Photos)',
                'icon'  => 'flag',
                'desc'  => 'Upload and manage all 6 dynamic hero slide photos, top affiliation badge, main headline, intro text, and action buttons.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow / Affiliation Badge',
                        'type' => 'text',
                        'default' => 'AFFILIATED TO HBSE • PRE-PRIMARY TO SENIOR SECONDARY (10+2)',
                        'help' => 'Top badge displayed prominently above the headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Main Hero Headline',
                        'type' => 'html',
                        'default' => 'Empowering Minds, Inspiring Character & <span class="text-[#C9A24B] italic">Academic Excellence</span>',
                        'help' => 'Primary headline on homepage (HTML formatting allowed).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle / Intro Description',
                        'type' => 'text',
                        'default' => 'Welcome to Sun Rise Sr. Sec. School, Dobhi. We foster an enriching educational environment combining rigorous HBSE scholarship, moral values, modern technology, and sportsmanship.',
                        'help' => 'Subtitle text below the main hero headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_text',
                        'label' => 'Button 1 Text (Gold Button)',
                        'type' => 'text',
                        'default' => 'Admissions 2026–27',
                        'help' => 'Text for primary action button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_link',
                        'label' => 'Button 1 Target URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Destination page link for Button 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_text',
                        'label' => 'Button 2 Text (Outline Button)',
                        'type' => 'text',
                        'default' => 'Explore Campus',
                        'help' => 'Text for secondary action button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_link',
                        'label' => 'Button 2 Target URL',
                        'type' => 'text',
                        'default' => 'campus.php',
                        'help' => 'Destination page link for Button 2.'
                    ],
                    // Slide 1
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_1',
                        'label' => 'Hero Slide 1 Photo (Main Campus Entrance)',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Sun Rise School Main Campus Entrance',
                        'help' => 'Slide 1 in the 4-direction mosaic box slider (recommended: 1920x1080).'
                    ],
                    // Slide 2
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_2',
                        'label' => 'Hero Slide 2 Photo (Campus Building Day View)',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'School Building and Assembly Grounds',
                        'help' => 'Slide 2 in the 4-direction mosaic box slider.'
                    ],
                    // Slide 3
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_3',
                        'label' => 'Hero Slide 3 Photo (Sports Ground & Athletics)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Students on Athletics Playfield',
                        'help' => 'Slide 3 in the 4-direction mosaic box slider.'
                    ],
                    // Slide 4
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_4',
                        'label' => 'Hero Slide 4 Photo (Science & Innovation Projects)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Science Exhibition Working Models',
                        'help' => 'Slide 4 in the 4-direction mosaic box slider.'
                    ],
                    // Slide 5
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_5',
                        'label' => 'Hero Slide 5 Photo (Campus Illuminated Night View)',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Campus Night Architecture',
                        'help' => 'Slide 5 in the 4-direction mosaic box slider.'
                    ],
                    // Slide 6
                    [
                        'kind' => 'image',
                        'key' => 'hero_slide_6',
                        'label' => 'Hero Slide 6 Photo (Academic Fair & Celebrations)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Academic Fair & Celebrations',
                        'help' => 'Slide 6 in the 4-direction mosaic box slider.'
                    ],
                ]
            ],
            // Section 1B: Continuous Ticker Strip
            [
                'title' => 'Section 1B: Continuous Moving School Ticker Strip',
                'icon'  => 'view_carousel',
                'desc'  => 'Manage the marquee announcement strip just below the hero section.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'ticker_label',
                        'label' => 'Ticker Left Badge Title',
                        'type' => 'text',
                        'default' => 'Latest Updates',
                        'help' => 'Gold badge title on the left.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_1',
                        'label' => 'Ticker Update 1 (School Timings)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">School Timings:</strong> Summer Season: 7:30 AM to 1:30 PM &bull; Winter Season: 8:30 AM to 2:30 PM.',
                        'help' => 'First scrolling notice item.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_2',
                        'label' => 'Ticker Update 2 (Admissions Open)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">Admissions 2026-27:</strong> Nursery to Class XII (10+2) &bull; Science, Commerce &amp; Arts Streams &bull; English Medium.',
                        'help' => 'Second scrolling notice item.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_3',
                        'label' => 'Ticker Update 3 (Board Exam Results)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">HBSE Board Results:</strong> Exemplary distinctions & 100% pass record in Class 10th & 12th board exams.',
                        'help' => 'Third scrolling notice item.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_4',
                        'label' => 'Ticker Update 4 (School Transport / Bus)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">School Bus & Vans:</strong> GPS-tracked transit serving Dobhi, Agroha, Balsamand, Chaudhariwas & nearby villages.',
                        'help' => 'Fourth scrolling notice item.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_5',
                        'label' => 'Ticker Update 5 (Sports Glories)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">State Sports Glories:</strong> 2 Gold Medals in National Wrestling &bull; 2 Silver in Kickboxing.',
                        'help' => 'Fifth scrolling notice item.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'ticker_item_6',
                        'label' => 'Ticker Update 6 (Campus Infrastructure)',
                        'type' => 'html',
                        'default' => '<strong class="text-[#C9A24B] font-bold">Infrastructure:</strong> Smart Classrooms &bull; Science & Computer Labs &bull; Sports Playfields.',
                        'help' => 'Sixth scrolling notice item.'
                    ]
                ]
            ],
            // Section 2: Legacy Highlights & 4 Key Stat Badges
            [
                'title' => 'Section 2: The Sun Rise Legacy & Key Indicators (4 Stats)',
                'icon'  => 'history_edu',
                'desc'  => 'Institutional overview, mission statement, and 4 numeric performance badges.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'legacy_tagline',
                        'label' => 'Spotlight Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'THE SUN RISE LEGACY • ESTD. 2007',
                        'help' => 'Small uppercase label above the spotlight headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'legacy_heading',
                        'label' => 'Spotlight Section Heading',
                        'type' => 'text',
                        'default' => 'A Tradition of Holistic Education & Outstanding Results',
                        'help' => 'Main heading for the legacy section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'legacy_description',
                        'label' => 'Spotlight Overview Paragraph',
                        'type' => 'text',
                        'default' => "At Sun Rise Sr. Sec. School, Dobhi, we are dedicated to nurturing each student's intellectual, physical, and moral growth. Through cutting-edge science labs, modern computer lab, library, spacious sports grounds, and exemplary faculty mentorship, our students consistently achieve top honours in HBSE board exams and national championships.",
                        'help' => 'Detailed introductory overview paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_pass_rate',
                        'label' => 'Stat 1: Number / Value',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Highlight stat value.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_pass_label',
                        'label' => 'Stat 1: Title Label',
                        'type' => 'text',
                        'default' => 'HBSE Board Results',
                        'help' => 'Label for stat 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_enrolled',
                        'label' => 'Stat 2: Number / Value',
                        'type' => 'text',
                        'default' => '700+',
                        'help' => 'Highlight stat value.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_enrolled_label',
                        'label' => 'Stat 2: Title Label',
                        'type' => 'text',
                        'default' => 'Enrolled Students',
                        'help' => 'Label for stat 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_teachers',
                        'label' => 'Stat 3: Number / Value',
                        'type' => 'text',
                        'default' => '30+',
                        'help' => 'Highlight stat value.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_teachers_label',
                        'label' => 'Stat 3: Title Label',
                        'type' => 'text',
                        'default' => 'Teaching Faculty',
                        'help' => 'Label for stat 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_classrooms',
                        'label' => 'Stat 4: Number / Value',
                        'type' => 'text',
                        'default' => '30+',
                        'help' => 'Highlight stat value.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_classrooms_label',
                        'label' => 'Stat 4: Title Label',
                        'type' => 'text',
                        'default' => 'Smart Classrooms',
                        'help' => 'Label for stat 4.'
                    ],
                ]
            ],
            // Section 2B: Live Event Tracker
            [
                'title' => 'Section 2B: Live Event Tracker & Upcoming Notices',
                'icon'  => 'campaign',
                'desc'  => 'Manage the live scrolling events window. Up to 6 event notices with title, optional red [NEW] badge, and click URL.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'live_tracker_gold',
                        'label' => 'Tracker Headline Word 1 (Gold)',
                        'type' => 'text',
                        'default' => 'UPCOMING',
                        'help' => 'First word of tracker title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'live_tracker_white',
                        'label' => 'Tracker Headline Word 2 (White)',
                        'type' => 'text',
                        'default' => 'EVENTS',
                        'help' => 'Second word of tracker title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'live_tracker_badge',
                        'label' => 'Tracker Status Badge',
                        'type' => 'text',
                        'default' => 'LIVE TRACKER',
                        'help' => 'Small uppercase pill badge with green pulse dot.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_1_title',
                        'label' => 'Event 1: Title / Notice',
                        'type' => 'text',
                        'default' => 'NORTH ZONE RELIANCE FOOTBALL CHAMPIONSHIP',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_1_badge',
                        'label' => 'Event 1: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => '',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_1_link',
                        'label' => 'Event 1: Target Link URL',
                        'type' => 'text',
                        'default' => 'events.php',
                        'help' => 'Destination page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_2_title',
                        'label' => 'Event 2: Title / Notice',
                        'type' => 'text',
                        'default' => 'Admission Open for New Session 2026-27',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_2_badge',
                        'label' => 'Event 2: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => 'NEW',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_2_link',
                        'label' => 'Event 2: Target Link URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Destination page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_3_title',
                        'label' => 'Event 3: Title / Notice',
                        'type' => 'text',
                        'default' => 'Annual Sports Meet & Athletic Championship Trials',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_3_badge',
                        'label' => 'Event 3: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => 'NEW',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_3_link',
                        'label' => 'Event 3: Target Link URL',
                        'type' => 'text',
                        'default' => 'campus.php#sports',
                        'help' => 'Destination page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_4_title',
                        'label' => 'Event 4: Title / Notice',
                        'type' => 'text',
                        'default' => 'State Level Science Exhibition & Robotic Project Display',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_4_badge',
                        'label' => 'Event 4: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => '',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_4_link',
                        'label' => 'Event 4: Target Link URL',
                        'type' => 'text',
                        'default' => 'academics.php',
                        'help' => 'Destination page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_5_title',
                        'label' => 'Event 5: Title / Notice',
                        'type' => 'text',
                        'default' => 'Scholarship Test for Meritorious Students (Classes 6th-12th)',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_5_badge',
                        'label' => 'Event 5: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => 'NEW',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_5_link',
                        'label' => 'Event 5: Target Link URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Destination page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_6_title',
                        'label' => 'Event 6: Title / Notice',
                        'type' => 'text',
                        'default' => 'CBSE/HBSE Board Exam Preparation Workshop & Mock Tests',
                        'help' => 'Notice title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_6_badge',
                        'label' => 'Event 6: Badge (e.g. NEW or blank)',
                        'type' => 'text',
                        'default' => '',
                        'help' => 'Pulsing badge if filled.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event_6_link',
                        'label' => 'Event 6: Target Link URL',
                        'type' => 'text',
                        'default' => 'academics.php#academic-calendar',
                        'help' => 'Destination page link.'
                    ]
                ]
            ],
            // Section 3: Three Pillars of Holistic Development
            [
                'title' => 'Section 3: Three Pillars of Holistic Development (3 Feature Cards)',
                'icon'  => 'view_column',
                'desc'  => 'Manage section headlines, category tags, images, titles, descriptions, and button links for all 3 feature cards.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'pillars_eyebrow',
                        'label' => 'Pillars Eyebrow',
                        'type' => 'text',
                        'default' => 'WHY CHOOSE SUN RISE',
                        'help' => 'Small uppercase tag above the headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pillars_heading',
                        'label' => 'Pillars Heading',
                        'type' => 'text',
                        'default' => 'Pillars of Holistic Development',
                        'help' => 'Section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pillars_desc',
                        'label' => 'Pillars Overview Subtitle',
                        'type' => 'text',
                        'default' => 'Our balanced framework ensures intellectual achievement is complemented by discipline, sportsmanship, and creative expression.',
                        'help' => 'Short introductory text.'
                    ],
                    // Pillar 1
                    [
                        'kind' => 'image',
                        'key' => 'card1_image',
                        'label' => 'Pillar 1 Card Image (Academics & Labs)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Science Labs and Academic Learning',
                        'help' => 'Photo for card 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_tag',
                        'label' => 'Pillar 1 Category Tag',
                        'type' => 'text',
                        'default' => 'HBSE CURRICULUM',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_title',
                        'label' => 'Pillar 1 Headline',
                        'type' => 'text',
                        'default' => 'Science & Practical Labs',
                        'help' => 'Title for card 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_desc',
                        'label' => 'Pillar 1 Description',
                        'type' => 'text',
                        'default' => 'State-of-the-art Physics, Chemistry, Biology, and Computer Science laboratories enabling experiential, hands-on scientific learning.',
                        'help' => 'Description for card 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_link_text',
                        'label' => 'Pillar 1 Button Text',
                        'type' => 'text',
                        'default' => 'Read More',
                        'help' => 'Button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_link_url',
                        'label' => 'Pillar 1 Button Link URL',
                        'type' => 'text',
                        'default' => 'academics.php',
                        'help' => 'Destination page link for card 1.'
                    ],
                    // Pillar 2
                    [
                        'kind' => 'image',
                        'key' => 'card2_image',
                        'label' => 'Pillar 2 Card Image (Sports Ground & Yoga)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Sports Ground & Athletics',
                        'help' => 'Photo for card 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_tag',
                        'label' => 'Pillar 2 Category Tag',
                        'type' => 'text',
                        'default' => 'ATHLETICS & FITNESS',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_title',
                        'label' => 'Pillar 2 Headline',
                        'type' => 'text',
                        'default' => 'Sports Ground & Yoga',
                        'help' => 'Title for card 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_desc',
                        'label' => 'Pillar 2 Description',
                        'type' => 'text',
                        'default' => 'Spacious athletic playfields, track events, cricket, volleyball, football, and daily morning yoga for physical and mental vigour.',
                        'help' => 'Description for card 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_link_text',
                        'label' => 'Pillar 2 Button Text',
                        'type' => 'text',
                        'default' => 'Read More',
                        'help' => 'Button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_link_url',
                        'label' => 'Pillar 2 Button Link URL',
                        'type' => 'text',
                        'default' => 'campus.php',
                        'help' => 'Destination page link for card 2.'
                    ],
                    // Pillar 3
                    [
                        'kind' => 'image',
                        'key' => 'card3_image',
                        'label' => 'Pillar 3 Card Image (Innovation & Art Exhibitions)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Innovation and Art Exhibitions',
                        'help' => 'Photo for card 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_tag',
                        'label' => 'Pillar 3 Category Tag',
                        'type' => 'text',
                        'default' => 'INNOVATION & ART',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_title',
                        'label' => 'Pillar 3 Headline',
                        'type' => 'text',
                        'default' => 'Science & Art Exhibitions',
                        'help' => 'Title for card 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_desc',
                        'label' => 'Pillar 3 Description',
                        'type' => 'text',
                        'default' => 'Annual science exhibitions, model-making fairs, cultural assemblies, debate contests, and creative arts celebrations.',
                        'help' => 'Description for card 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_link_text',
                        'label' => 'Pillar 3 Button Text',
                        'type' => 'text',
                        'default' => 'Read More',
                        'help' => 'Button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_link_url',
                        'label' => 'Pillar 3 Button Link URL',
                        'type' => 'text',
                        'default' => 'gallery.php',
                        'help' => 'Destination page link for card 3.'
                    ]
                ]
            ],
            // Section 4: Founder & Director's Message
            [
                'title' => 'Section 4: Founder & Director\'s Message',
                'icon'  => 'record_voice_over',
                'desc'  => 'Director portrait photo, quote, address paragraphs, and signatory designation.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'director_photo',
                        'label' => 'Director Portrait Photo',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'Mr. Bhader Singh Swami, Founder & Director',
                        'help' => 'Photo displayed on the left of director message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_tagline',
                        'label' => 'Director Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'DIRECTOR\'S MESSAGE',
                        'help' => 'Eyebrow label above the heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_heading',
                        'label' => 'Director Section Heading',
                        'type' => 'text',
                        'default' => 'Empowering Dreams & Shaping Tomorrow\'s Leaders',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_quote',
                        'label' => 'Featured Director Quote',
                        'type' => 'text',
                        'default' => '“Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society.”',
                        'help' => 'Prominent blockquote with gold border.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_p1',
                        'label' => 'Director Address Paragraph 1',
                        'type' => 'text',
                        'default' => 'It gives me immense pleasure to welcome you to Sun Rise Sr. Sec. School, Dobhi—a place where we believe that every child is not just a student, but a unique individual with dreams, abilities, and limitless potential. For us, education is much more than books, classrooms, and examinations. It is about shaping minds, nurturing hearts, building character, and preparing young individuals for life.',
                        'help' => 'First message paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_p2',
                        'label' => 'Director Address Paragraph 2',
                        'type' => 'text',
                        'default' => 'We strive for the holistic development of every student through quality academics, sports, creativity, cultural activities, discipline, and strong moral values. Along with knowledge, we seek to nurture kindness, confidence, responsibility, resilience, and respect for others. At Sun Rise Sr. Sec. School, we do not simply prepare children for tomorrow; we nurture the individuals who will shape tomorrow.',
                        'help' => 'Second message paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_name',
                        'label' => 'Director Name',
                        'type' => 'text',
                        'default' => 'Mr. Bhader Singh Swami',
                        'help' => 'Signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'director_title',
                        'label' => 'Director Designation',
                        'type' => 'text',
                        'default' => 'Founder & Director, Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Official title.'
                    ]
                ]
            ],
            // Section 5: Principal's Message
            [
                'title' => 'Section 5: Principal\'s Message',
                'icon'  => 'school',
                'desc'  => 'Principal portrait photo, quote, address paragraphs, and signatory designation.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'principal_photo',
                        'label' => 'Principal Photo',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Mr. Rajbir Singh, Principal',
                        'help' => 'Photo displayed on the right of the principal message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_tagline',
                        'label' => 'Principal Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'PRINCIPAL\'S MESSAGE',
                        'help' => 'Eyebrow label above the heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_heading',
                        'label' => 'Principal Section Heading',
                        'type' => 'text',
                        'default' => 'Guiding Young Minds Towards Academic Excellence & Character',
                        'help' => 'Section heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_quote',
                        'label' => 'Featured Principal Quote',
                        'type' => 'text',
                        'default' => '“True education is the illumination of intellect grounded in discipline, curiosity, and compassionate leadership.”',
                        'help' => 'Prominent blockquote with gold border.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_p1',
                        'label' => 'Principal Address Paragraph 1',
                        'type' => 'text',
                        'default' => 'Welcome to Sun Rise Sr. Sec. School, Dobhi. As Principal, it is my privilege to lead an institution where rigorous scholarship seamlessly blends with moral integrity, creative exploration, and personal mentorship. Our dedicated faculty works with unwavering commitment to unlock the boundless potential within each student.',
                        'help' => 'First message paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_p2',
                        'label' => 'Principal Address Paragraph 2',
                        'type' => 'text',
                        'default' => 'Through state-of-the-art science and computer laboratories, expansive sports infrastructure, and dedicated HBSE curriculum delivery, we empower our learners to achieve exemplary distinctions in board examinations and life beyond. Together with our supportive parents, we nurture young minds to lead with knowledge, courage, and humble hearts.',
                        'help' => 'Second message paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_name',
                        'label' => 'Principal Name',
                        'type' => 'text',
                        'default' => 'Mr. Rajbir Singh',
                        'help' => 'Signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'principal_title',
                        'label' => 'Principal Designation',
                        'type' => 'text',
                        'default' => 'Principal, Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Official title.'
                    ]
                ]
            ],
            // Section 6: School Events & News (3 Cards)
            [
                'title' => 'Section 6: School Events & News (3 Cards)',
                'icon'  => 'event_note',
                'desc'  => 'Three event cards displayed on homepage with tags, badges, titles, descriptions, and venue locations.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'events_eyebrow',
                        'label' => 'Events Eyebrow',
                        'type' => 'text',
                        'default' => 'NOTICES & HAPPENINGS',
                        'help' => 'Eyebrow label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'events_heading',
                        'label' => 'Events Heading',
                        'type' => 'text',
                        'default' => 'School Events & News',
                        'help' => 'Main heading.'
                    ],
                    // Notice 1
                    [
                        'kind' => 'text',
                        'key' => 'event1_tag',
                        'label' => 'Event 1: Category Tag',
                        'type' => 'text',
                        'default' => 'ACADEMIC',
                        'help' => 'Category label (e.g. ACADEMIC).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_badge',
                        'label' => 'Event 1: Badge',
                        'type' => 'text',
                        'default' => 'ANNUAL',
                        'help' => 'Status badge (e.g. ANNUAL / UPCOMING).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_title',
                        'label' => 'Event 1: Title',
                        'type' => 'text',
                        'default' => 'Annual Science & Innovation Exhibition',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_desc',
                        'label' => 'Event 1: Description',
                        'type' => 'text',
                        'default' => 'Students display innovative working models, robotics experiments, and environmental science projects.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_loc',
                        'label' => 'Event 1: Venue / Location',
                        'type' => 'text',
                        'default' => 'School Campus',
                        'help' => 'Location info.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_link',
                        'label' => 'Event 1: Link URL',
                        'type' => 'text',
                        'default' => 'events.php',
                        'help' => 'Destination page.'
                    ],
                    // Notice 2
                    [
                        'kind' => 'text',
                        'key' => 'event2_tag',
                        'label' => 'Event 2: Category Tag',
                        'type' => 'text',
                        'default' => 'CEREMONY',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_badge',
                        'label' => 'Event 2: Badge',
                        'type' => 'text',
                        'default' => 'AWARDS',
                        'help' => 'Status badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_title',
                        'label' => 'Event 2: Title',
                        'type' => 'text',
                        'default' => 'Prize Distribution & Felicitation Day',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_desc',
                        'label' => 'Event 2: Description',
                        'type' => 'text',
                        'default' => 'Honouring board exam toppers, scholarship achievers, and sports champions with merit awards.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_loc',
                        'label' => 'Event 2: Venue / Location',
                        'type' => 'text',
                        'default' => 'Main Auditorium',
                        'help' => 'Location info.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_link',
                        'label' => 'Event 2: Link URL',
                        'type' => 'text',
                        'default' => 'events.php',
                        'help' => 'Destination page.'
                    ],
                    // Notice 3
                    [
                        'kind' => 'text',
                        'key' => 'event3_tag',
                        'label' => 'Event 3: Category Tag',
                        'type' => 'text',
                        'default' => 'CULTURE',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_badge',
                        'label' => 'Event 3: Badge',
                        'type' => 'text',
                        'default' => 'SPECIAL',
                        'help' => 'Status badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_title',
                        'label' => 'Event 3: Title',
                        'type' => 'text',
                        'default' => 'National Festivals & Cultural Assemblies',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_desc',
                        'label' => 'Event 3: Description',
                        'type' => 'text',
                        'default' => 'Flag hoisting ceremony, patriotic songs, cultural dances, and speeches commemorating national heritage.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_loc',
                        'label' => 'Event 3: Venue / Location',
                        'type' => 'text',
                        'default' => 'Open Grounds',
                        'help' => 'Location info.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_link',
                        'label' => 'Event 3: Link URL',
                        'type' => 'text',
                        'default' => 'events.php',
                        'help' => 'Destination page.'
                    ]
                ]
            ],
            // Section 7: Campus Glimpses Showcase (Dual-Row 12 Photos)
            [
                'title' => 'Section 7: Campus Glimpses Dual-Row Showcase (12 Photos)',
                'icon'  => 'photo_library',
                'desc'  => 'Upload and manage all 12 photos across Row 1 (moving left) and Row 2 (moving right) for the infinite sliding gallery strip.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'gallery_eyebrow',
                        'label' => 'Glimpses Eyebrow',
                        'type' => 'text',
                        'default' => 'CAMPUS GLIMPSES',
                        'help' => 'Uppercase eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_heading',
                        'label' => 'Glimpses Heading',
                        'type' => 'text',
                        'default' => 'Life at Sun Rise Sr. Sec. School',
                        'help' => 'Section heading.'
                    ],
                    // Row 1 (Slots 1, 2, 3, 7, 8, 9)
                    [
                        'kind' => 'image',
                        'key' => 'glimpse1_img',
                        'label' => 'Row 1 - Photo 1 (Main Campus Building)',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Main Campus Building Night View',
                        'help' => 'Photo slot 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse1_title',
                        'label' => 'Row 1 - Photo 1 Caption Title',
                        'type' => 'text',
                        'default' => 'Main Campus Building',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse2_img',
                        'label' => 'Row 1 - Photo 2 (Interactive Classrooms)',
                        'default' => 'assets/images/sunrise school image/children_sitting.webp',
                        'alt' => 'Smart Classrooms',
                        'help' => 'Photo slot 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse2_title',
                        'label' => 'Row 1 - Photo 2 Caption Title',
                        'type' => 'text',
                        'default' => 'Interactive Classrooms',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse3_img',
                        'label' => 'Row 1 - Photo 3 (Dedicated Teaching Faculty)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Teaching Faculty',
                        'help' => 'Photo slot 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse3_title',
                        'label' => 'Row 1 - Photo 3 Caption Title',
                        'type' => 'text',
                        'default' => 'Dedicated Teaching Faculty',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse7_img',
                        'label' => 'Row 1 - Photo 4 (Science & Innovation Fair)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Science & Innovation Fair',
                        'help' => 'Photo slot 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse7_title',
                        'label' => 'Row 1 - Photo 4 Caption Title',
                        'type' => 'text',
                        'default' => 'Science & Innovation Fair',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse8_img',
                        'label' => 'Row 1 - Photo 5 (Annual Awards Felicitation)',
                        'default' => 'assets/images/sunrise school image/award_ceremony.webp',
                        'alt' => 'Annual Awards Felicitation',
                        'help' => 'Photo slot 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse8_title',
                        'label' => 'Row 1 - Photo 5 Caption Title',
                        'type' => 'text',
                        'default' => 'Annual Awards Felicitation',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse9_img',
                        'label' => 'Row 1 - Photo 6 (Morning Assembly & Prayer)',
                        'default' => 'assets/images/sunrise school image/children_praying.webp',
                        'alt' => 'Morning Assembly & Prayer',
                        'help' => 'Photo slot 6.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse9_title',
                        'label' => 'Row 1 - Photo 6 Caption Title',
                        'type' => 'text',
                        'default' => 'Morning Assembly & Prayer',
                        'help' => 'Caption title.'
                    ],
                    // Row 2 (Slots 4, 5, 6, 10, 11, 12)
                    [
                        'kind' => 'image',
                        'key' => 'glimpse4_img',
                        'label' => 'Row 2 - Photo 7 (Student Community)',
                        'default' => 'assets/images/sunrise school image/students_grouppic.webp',
                        'alt' => 'Student Community',
                        'help' => 'Photo slot 7.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse4_title',
                        'label' => 'Row 2 - Photo 7 Caption Title',
                        'type' => 'text',
                        'default' => 'Student Community',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse5_img',
                        'label' => 'Row 2 - Photo 8 (Yoga & Holistic Health)',
                        'default' => 'assets/images/sunrise school image/yoga.webp',
                        'alt' => 'Yoga and Physical Health',
                        'help' => 'Photo slot 8.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse5_title',
                        'label' => 'Row 2 - Photo 8 Caption Title',
                        'type' => 'text',
                        'default' => 'Yoga & Holistic Health',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse6_img',
                        'label' => 'Row 2 - Photo 9 (Science Projects)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Science Projects Showcase',
                        'help' => 'Photo slot 9.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse6_title',
                        'label' => 'Row 2 - Photo 9 Caption Title',
                        'type' => 'text',
                        'default' => 'Science Projects',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse10_img',
                        'label' => 'Row 2 - Photo 10 (Athletics & Sports Ground)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Athletics & Sports Ground',
                        'help' => 'Photo slot 10.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse10_title',
                        'label' => 'Row 2 - Photo 10 Caption Title',
                        'type' => 'text',
                        'default' => 'Athletics & Sports Ground',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse11_img',
                        'label' => 'Row 2 - Photo 11 (Experiential Learning)',
                        'default' => 'assets/images/sunrise school image/exhibition2.webp',
                        'alt' => 'Experiential Learning',
                        'help' => 'Photo slot 11.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse11_title',
                        'label' => 'Row 2 - Photo 11 Caption Title',
                        'type' => 'text',
                        'default' => 'Experiential Learning',
                        'help' => 'Caption title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'glimpse12_img',
                        'label' => 'Row 2 - Photo 12 (Student-Faculty Mentorship)',
                        'default' => 'assets/images/sunrise school image/teachers_and_students.webp',
                        'alt' => 'Student-Faculty Mentorship',
                        'help' => 'Photo slot 12.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse12_title',
                        'label' => 'Row 2 - Photo 12 Caption Title',
                        'type' => 'text',
                        'default' => 'Student-Faculty Mentorship',
                        'help' => 'Caption title.'
                    ]
                ]
            ],
            // Section 8: Affiliations & Recognized By Strip
            [
                'title' => 'Section 8: Affiliations & Accreditations Strip',
                'icon'  => 'verified',
                'desc'  => 'Headline and 4 accreditation badges displayed in the horizontal strip.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'affiliations_title',
                        'label' => 'Affiliations Strip Title',
                        'type' => 'text',
                        'default' => 'Affiliated & Recognized By',
                        'help' => 'Eyebrow label above badges.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'affil1_text',
                        'label' => 'Accreditation Badge 1',
                        'type' => 'text',
                        'default' => 'HBSE AFFILIATED',
                        'help' => 'Badge 1 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'affil2_text',
                        'label' => 'Accreditation Badge 2',
                        'type' => 'text',
                        'default' => 'CO-EDUCATIONAL (10+2)',
                        'help' => 'Badge 2 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'affil3_text',
                        'label' => 'Accreditation Badge 3',
                        'type' => 'text',
                        'default' => 'SCIENCE, COMMERCE & ARTS',
                        'help' => 'Badge 3 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'affil4_text',
                        'label' => 'Accreditation Badge 4',
                        'type' => 'text',
                        'default' => 'SPORTS & YOGA',
                        'help' => 'Badge 4 text.'
                    ]
                ]
            ],
            // Section 9: Final Admissions CTA Banner
            [
                'title' => 'Section 9: Final Admissions Call to Action (CTA)',
                'icon'  => 'call_to_action',
                'desc'  => 'Bottom banner prompting parents to apply online or visit campus.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'cta_banner',
                        'label' => 'CTA Background Banner Image',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'Sun Rise School Campus View',
                        'help' => 'Large background image behind the admissions banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_badge',
                        'label' => 'CTA Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'ADMISSIONS 2026-27',
                        'help' => 'Uppercase badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'CTA Main Headline',
                        'type' => 'html',
                        'default' => 'Give Your Child the <span class="text-[#C9A24B] italic">Sun Rise Advantage</span>',
                        'help' => 'Prominent headline (HTML allowed).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_description',
                        'label' => 'CTA Overview Subtitle',
                        'type' => 'text',
                        'default' => 'Admissions are now open for Pre-Primary to Class 12. Schedule a campus visit or apply online today to provide your child with quality education and bright future.',
                        'help' => 'Description paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_text',
                        'label' => 'Button 1 Text (Apply Link)',
                        'type' => 'text',
                        'default' => 'Apply For Admission',
                        'help' => 'Label for the gold button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_link',
                        'label' => 'Button 1 Target URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Destination page link for Button 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_text',
                        'label' => 'Button 2 Text (Contact Link)',
                        'type' => 'text',
                        'default' => 'Contact Campus Office',
                        'help' => 'Label for the secondary button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_link',
                        'label' => 'Button 2 Target URL',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination page link for Button 2.'
                    ]
                ]
            ]
        ]
    ],
    'about' => [
        'title' => 'About Us Page',
        'icon'  => 'info',
        'desc'  => 'Complete About Us Page Control: Hero Banner, Stats Strip, Vision & Mission (with expandable text & quote), Founder Story, 5 Milestones Timeline, Symbolism & Pledge, Leadership Team, 5 Visual Tour Photos, and Mandatory Public Disclosure',
        'sections' => [
            // Section 1: Hero Banner & Badges
            [
                'title' => 'Section 1: Hero Banner & Main Headlines',
                'icon'  => 'flag',
                'desc'  => 'Top banner photo, eyebrow badge, main title, and introductory subtitle description.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Hero Banner Background Image',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'Sun Rise School Building and Assembly Area',
                        'help' => 'Top background banner photo for About Us page (recommended: 1920x1080).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Institutional Legacy & Future Vision',
                        'help' => 'Gold-bordered pill badge displayed above the main title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'About Us Main Title',
                        'type' => 'text',
                        'default' => 'About Sun Rise Sr. Sec. School',
                        'help' => 'Primary title heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle Description',
                        'type' => 'text',
                        'default' => 'Cultivating academic rigor, moral integrity, and lifelong curiosity within a vibrant and disciplined campus environment in Dobhi, Haryana.',
                        'help' => 'Introductory paragraph below the main title.'
                    ]
                ]
            ],

            // Section 2: Milestones & Statistics Strip
            [
                'title' => 'Section 2: Key Milestones & Statistics Strip',
                'icon'  => 'pin_drop',
                'desc'  => '4 key achievement numbers and labels shown in the floating strip card.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Number (Year Founded)',
                        'type' => 'text',
                        'default' => '2007',
                        'help' => 'First stat counter (e.g. 2007).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Year Established',
                        'help' => 'First stat label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Number (Students)',
                        'type' => 'text',
                        'default' => '700+',
                        'help' => 'Second stat counter (e.g. 700+).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Enrolled Students',
                        'help' => 'Second stat label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Number (Faculty)',
                        'type' => 'text',
                        'default' => '28+',
                        'help' => 'Third stat counter (e.g. 28+).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Experienced Teachers',
                        'help' => 'Third stat label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Number (Results)',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Fourth stat counter (e.g. 100%).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'HBSE Board Results',
                        'help' => 'Fourth stat label.'
                    ]
                ]
            ],

            // Section 3: Educational Philosophy, Vision & Mission
            [
                'title' => 'Section 3: Educational Philosophy, Vision & Mission Cards',
                'icon'  => 'visibility',
                'desc'  => 'Section header, Vision card with all 4 expandable paragraphs & quotes, and Mission card.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'philosophy_tag',
                        'label' => 'Philosophy Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'Our Core Philosophy',
                        'help' => 'Top eyebrow tag for this section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'philosophy_heading',
                        'label' => 'Philosophy Section Heading',
                        'type' => 'text',
                        'default' => 'Guiding Principles of Education',
                        'help' => 'Main heading for philosophy section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_title',
                        'label' => 'Vision Card Title',
                        'type' => 'text',
                        'default' => 'A Centre of Excellence for Intellect & Integrity',
                        'help' => 'Title heading for Vision Card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_text_p1',
                        'label' => 'Vision Paragraph 1 (Primary Visible Statement)',
                        'type' => 'html',
                        'default' => 'To establish Sun Rise Sr. Sec. School as a Centre of Excellence that nurtures young minds into individuals of intellect, integrity, discernment, and compassion—equipped not merely to succeed in life, but to give meaning to that success through service to society and the nation.',
                        'help' => 'Initial visible paragraph on Vision card before expanding.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_text_p2',
                        'label' => 'Vision Paragraph 2 (Read More - Ethos)',
                        'type' => 'html',
                        'default' => 'We envision an educational ethos where the wisdom of traditional values converges with the possibilities of progressive thought, technology, and contemporary learning. Every student should emerge from our institution with a composed presence, articulate expression, sound judgement, and a deep sense of responsibility towards the world beyond oneself.',
                        'help' => 'Second paragraph shown after clicking Read More.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_text_p3',
                        'label' => 'Vision Paragraph 3 (Read More - Independent Thought)',
                        'type' => 'html',
                        'default' => 'Our endeavour is to cultivate individuals who possess the courage to think independently, the humility to understand others, and the conviction to place collective welfare above personal interest. We aspire to prepare a generation that carries its heritage with respect, embraces the future with confidence, and contributes to the nation with dignity, integrity, and pride.',
                        'help' => 'Third paragraph shown after clicking Read More.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_text_p4',
                        'label' => 'Vision Highlight Quote Box',
                        'type' => 'html',
                        'default' => '“We believe that education finds its highest purpose when knowledge becomes wisdom, achievement becomes responsibility, and the individual becomes a force for the greater good.”',
                        'help' => 'Italicized quote block shown inside the expandable Vision card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'mission_title',
                        'label' => 'Mission Card Title',
                        'type' => 'text',
                        'default' => 'Holistic Education for Mind, Body & Soul',
                        'help' => 'Title heading for Mission Card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'mission_text',
                        'label' => 'Mission Statement Description',
                        'type' => 'html',
                        'default' => 'We are dedicated to delivering a comprehensive HBSE curriculum enriched by hands-on science laboratories, digital learning, sportsmanship, moral values, and cultural activities that nurture well-rounded global citizens.',
                        'help' => 'Complete text inside the Mission Card.'
                    ]
                ]
            ],

            // Section 4: History Header & Founder's Genesis Highlight Card
            [
                'title' => 'Section 4: Institutional History & Founder\'s Genesis Card',
                'icon'  => 'history_edu',
                'desc'  => 'Official history intro, Mr. Bhader Singh Swami\'s portrait, badges, and founding story paragraphs.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'history_badge',
                        'label' => 'History Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Our History',
                        'help' => 'Eyebrow tag above the history section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'history_title',
                        'label' => 'History Section Heading',
                        'type' => 'text',
                        'default' => 'From Humble Beginnings to a Legacy of Learning',
                        'help' => 'Main headline of history section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'history_intro',
                        'label' => 'History Intro Paragraph',
                        'type' => 'text',
                        'default' => 'The journey of Sun Rise Sr. Sec. School, Dobhi began in 2007, rooted in a profound belief that education can illuminate lives, transform possibilities, and lay the foundation for a better society.',
                        'help' => 'Introductory narrative text for the history section.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'founder_photo',
                        'label' => 'Founder Portrait Photo (Optional)',
                        'default' => '',
                        'alt' => 'Mr. Bhader Singh Swami - Founder & Director',
                        'help' => 'Upload portrait photo of founder Mr. Bhader Singh Swami (if blank, displays classic school crest).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_badge',
                        'label' => 'Founder Badge Label',
                        'type' => 'text',
                        'default' => 'Institutional Founder',
                        'help' => 'Gold pill label above founder name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_name',
                        'label' => 'Founder Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Bhader Singh Swami',
                        'help' => 'Name of the founder.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_role',
                        'label' => 'Founder Designation / Role',
                        'type' => 'text',
                        'default' => 'Founder & Director',
                        'help' => 'Official role and designation.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_est',
                        'label' => 'Founder Card Footer Badge',
                        'type' => 'text',
                        'default' => 'Est. 2007 • Dobhi, Hisar',
                        'help' => 'Footer badge with year and location.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_heading',
                        'label' => 'Founder Story Heading',
                        'type' => 'text',
                        'default' => 'A Vision Born from Conviction & Dedication',
                        'help' => 'Headline for founder story narrative.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_p1',
                        'label' => 'Founder Story Paragraph 1 (Inception & Struggle)',
                        'type' => 'html',
                        'default' => 'The institution was founded by <strong>Mr. Bhader Singh Swami</strong>, whose own journey was shaped by the struggles and limitations of growing up in a lower-middle-class family. Having experienced the challenges surrounding access to quality education, he developed a deep conviction that every child, irrespective of background, deserves the opportunity to learn, grow, and aspire.',
                        'help' => 'First story paragraph detailing background.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_p2',
                        'label' => 'Founder Story Paragraph 2 (Teaching & 90 Students)',
                        'type' => 'html',
                        'default' => 'His years of teaching in different schools further strengthened this conviction and eventually gave form to the vision that became Sun Rise Sr. Sec. School. The beginning was modest: with approximately 90 students, education up to Class X, and limited resources, the school initially operated from small premises at different locations.',
                        'help' => 'Second story paragraph detailing the beginning with 90 students.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_p3',
                        'label' => 'Founder Story Paragraph 3 (Perseverance & Community)',
                        'type' => 'html',
                        'default' => 'The early years were marked by challenges and perseverance, but with unwavering dedication from the management, teachers, and the trust of local families, the foundation was steadily strengthened.',
                        'help' => 'Third story paragraph detailing perseverance.'
                    ]
                ]
            ],

            // Section 5: Chronological 5-Stage Milestone Roadmap
            [
                'title' => 'Section 5: Chronological 5-Stage Milestone Timeline',
                'icon'  => 'timeline',
                'desc'  => 'All 5 milestones in chronological order: 2007 Inception, 2011 HBSE Affiliation, 2013 Science Accolades, 2017 Academic Sweep, and Today\'s Thriving Hub.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'milestones_badge',
                        'label' => 'Timeline Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Key Milestones',
                        'help' => 'Small eyebrow tag above timeline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'milestones_title',
                        'label' => 'Timeline Main Title',
                        'type' => 'text',
                        'default' => 'Milestones in Our Institutional Journey',
                        'help' => 'Headline for chronological timeline.'
                    ],
                    // Milestone 1 (2007)
                    [
                        'kind' => 'text',
                        'key' => 'm1_num',
                        'label' => 'Milestone 1 Step Badge',
                        'type' => 'text',
                        'default' => '01',
                        'help' => 'Step index circle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_year',
                        'label' => 'Milestone 1 Year Badge',
                        'type' => 'text',
                        'default' => '2007',
                        'help' => 'Pill year badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_category',
                        'label' => 'Milestone 1 Category / Eyebrow',
                        'type' => 'text',
                        'default' => 'Foundation & Humble Beginnings',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_title',
                        'label' => 'Milestone 1 Title',
                        'type' => 'text',
                        'default' => 'Modest Inception with 90 Students',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_desc',
                        'label' => 'Milestone 1 Description',
                        'type' => 'html',
                        'default' => 'Started with approximately 90 students up to Class X operating from modest premises at different locations. Overcoming initial hurdles through sheer dedication of teachers and the profound trust reposed by local families in Dobhi and surrounding villages.',
                        'help' => 'Narrative description for Milestone 1.'
                    ],

                    // Milestone 2 (2011)
                    [
                        'kind' => 'text',
                        'key' => 'm2_num',
                        'label' => 'Milestone 2 Step Badge',
                        'type' => 'text',
                        'default' => '02',
                        'help' => 'Step index circle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_year',
                        'label' => 'Milestone 2 Year Badge',
                        'type' => 'text',
                        'default' => '2011',
                        'help' => 'Pill year badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_category',
                        'label' => 'Milestone 2 Category / Eyebrow',
                        'type' => 'text',
                        'default' => 'HBSE Affiliation & Senior Secondary Expansion',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_title',
                        'label' => 'Milestone 2 Title',
                        'type' => 'text',
                        'default' => 'Upgradation to Class XII (10+2) & Infrastructure Leap',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_desc',
                        'label' => 'Milestone 2 Description',
                        'type' => 'html',
                        'default' => 'Recognizing the urgent need for higher learning opportunities in the region, the school took a major leap forward by securing affiliation with the <strong>Board of School Education Haryana (HBSE)</strong> and expanding from Class X to Class XII (10+2). This milestone marked the transformation into a senior secondary school, opening Science and Arts streams, state-of-the-art laboratories, a resourceful library, and reliable rural bus transport routes.',
                        'help' => 'Narrative description for Milestone 2.'
                    ],

                    // Milestone 3 (2013)
                    [
                        'kind' => 'text',
                        'key' => 'm3_num',
                        'label' => 'Milestone 3 Step Badge',
                        'type' => 'text',
                        'default' => '03',
                        'help' => 'Step index circle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_year',
                        'label' => 'Milestone 3 Year Badge',
                        'type' => 'text',
                        'default' => '2013',
                        'help' => 'Pill year badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_category',
                        'label' => 'Milestone 3 Category / Eyebrow',
                        'type' => 'text',
                        'default' => 'State-Level Science Accolades',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_title',
                        'label' => 'Milestone 3 Title',
                        'type' => 'text',
                        'default' => 'State Selection at CCSHAU Hisar Science Exhibition',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_desc',
                        'label' => 'Milestone 3 Description',
                        'type' => 'html',
                        'default' => 'As the school grew, its students began to leave their mark on wider platforms. Sun Rise achieved notable recognition when two students were selected at the Haryana state level at a prestigious Science Exhibition organized at CCSHAU Hisar, reflecting the institution\'s commitment to nurturing scientific inquiry and innovation.',
                        'help' => 'Narrative description for Milestone 3.'
                    ],

                    // Milestone 4 (2017)
                    [
                        'kind' => 'text',
                        'key' => 'm4_num',
                        'label' => 'Milestone 4 Step Badge',
                        'type' => 'text',
                        'default' => '04',
                        'help' => 'Step index circle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_year',
                        'label' => 'Milestone 4 Year Badge',
                        'type' => 'text',
                        'default' => '2017',
                        'help' => 'Pill year badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_category',
                        'label' => 'Milestone 4 Category / Eyebrow',
                        'type' => 'text',
                        'default' => 'Block & District Level Academic Sweep',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_title',
                        'label' => 'Milestone 4 Title',
                        'type' => 'text',
                        'default' => '1st, 2nd & 3rd Positions in Talent Search & Physics Point Honours',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_desc',
                        'label' => 'Milestone 4 Description',
                        'type' => 'html',
                        'default' => 'Sun Rise students demonstrated academic brilliance at the block level Talent Search Exam, sweeping the <strong>1st, 2nd, and 3rd positions</strong> among more than 25 participating schools and over 1,500 students. In the same year, at the district level Physics Point Prize Test, 10 students from the school ranked among the top 200 out of more than 2,700 participants—highlighting competitive spirit and academic depth.',
                        'help' => 'Narrative description for Milestone 4.'
                    ],

                    // Milestone 5 (Today)
                    [
                        'kind' => 'text',
                        'key' => 'm5_num',
                        'label' => 'Milestone 5 Step Badge',
                        'type' => 'text',
                        'default' => '05',
                        'help' => 'Step index circle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm5_year',
                        'label' => 'Milestone 5 Year Badge',
                        'type' => 'text',
                        'default' => 'Today',
                        'help' => 'Pill year badge (e.g. Today).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm5_category',
                        'label' => 'Milestone 5 Category / Eyebrow',
                        'type' => 'text',
                        'default' => 'A Thriving Campus & Community',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm5_title',
                        'label' => 'Milestone 5 Title',
                        'type' => 'text',
                        'default' => '700+ Students, 28 Teachers & 30+ Classrooms',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm5_desc',
                        'label' => 'Milestone 5 Description',
                        'type' => 'html',
                        'default' => 'Today, Sun Rise Sr. Sec. School stands tall as a thriving educational hub, serving approximately 700 students guided by a dedicated team of 28 experienced teachers across 30+ well-ventilated classrooms. Beyond academic excellence, the school emphasizes sports, creative arts, cultural programs, and educational excursions to ensure holistic growth.',
                        'help' => 'Narrative description for Milestone 5.'
                    ]
                ]
            ],

            // Section 6: "Sun Rise" Philosophy & Enduring Pledge Banner
            [
                'title' => 'Section 6: "Sun Rise" Symbolism & Institutional Pledge',
                'icon'  => 'wb_sunny',
                'desc'  => 'The symbolism behind the school name and the royal navy enduring pledge banner card.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'symbolism_badge',
                        'label' => 'Symbolism Card Eyebrow',
                        'type' => 'text',
                        'default' => 'The Symbolism',
                        'help' => 'Eyebrow tag above symbolism title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'symbolism_title',
                        'label' => 'Symbolism Card Title',
                        'type' => 'text',
                        'default' => 'The Meaning Behind "Sun Rise"',
                        'help' => 'Headline for symbolism card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'symbolism_text',
                        'label' => 'Symbolism Explanation Text',
                        'type' => 'html',
                        'default' => 'The name <strong>"Sun Rise"</strong> was chosen with purpose. Just as the rising sun brings warmth, dispels darkness, and heralds a new beginning filled with hope and possibilities, the school aspires to be a guiding light for every learner who walks through its doors.',
                        'help' => 'Description of what the name Sun Rise stands for.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'symbolism_footer',
                        'label' => 'Symbolism Card Footer Tag',
                        'type' => 'text',
                        'default' => 'Light after darkness • Hope • New Beginnings',
                        'help' => 'Footer note at the bottom of the card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pledge_badge',
                        'label' => 'Pledge Banner Eyebrow',
                        'type' => 'text',
                        'default' => 'Our Enduring Pledge',
                        'help' => 'Eyebrow tag on the navy pledge card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pledge_title',
                        'label' => 'Pledge Banner Title',
                        'type' => 'text',
                        'default' => 'A Legacy of Perseverance & Community Trust',
                        'help' => 'Headline on the pledge card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pledge_desc',
                        'label' => 'Pledge Banner Description',
                        'type' => 'text',
                        'default' => 'From a modest vision with 90 students to a senior secondary institution touching hundreds of lives, the story of Sun Rise Sr. Sec. School is a testament to perseverance, purpose, and community trust.',
                        'help' => 'Main paragraph on pledge card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pledge_quote_title',
                        'label' => 'Pledge Quote Block Label',
                        'type' => 'text',
                        'default' => 'The Journey Continues With Our Mission:',
                        'help' => 'Title tag above the quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pledge_quote',
                        'label' => 'Pledge Featured Mission Quote',
                        'type' => 'text',
                        'default' => '“To provide better education, nurture better human beings, and contribute towards a better humanity.”',
                        'help' => 'Highlighted mission quote on the banner.'
                    ]
                ]
            ],

            // Section 7: Leadership Message & Administration Team
            [
                'title' => 'Section 7: Leadership Address & Administration Team (#leadership)',
                'icon'  => 'record_voice_over',
                'desc'  => 'Director\'s welcome message, leader portrait photo slot, featured quote, and leadership team credentials.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'leader_photo',
                        'label' => 'Director / Leadership Portrait Photo',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'School Leadership & Management',
                        'help' => 'Featured portrait photo in the leadership message block.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_tagline',
                        'label' => 'Leadership Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Director\'s Welcome',
                        'help' => 'Eyebrow pill tag (e.g. Director\'s Welcome).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_heading',
                        'label' => 'Leadership Main Headline',
                        'type' => 'text',
                        'default' => 'Inspiring Minds, Cultivating Character',
                        'help' => 'Main headline on leadership card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_quote',
                        'label' => 'Featured Leadership Quote',
                        'type' => 'text',
                        'default' => '“Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society.”',
                        'help' => 'Blockquote in italic font.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_desc',
                        'label' => 'Leadership Message Subtext',
                        'type' => 'text',
                        'default' => 'At Sun Rise Sr. Sec. School, we do not simply prepare children for tomorrow; we nurture the individuals who will shape tomorrow.',
                        'help' => 'Subtext paragraph below the quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_name',
                        'label' => 'Leader 1 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Bhader Singh Swami',
                        'help' => 'First signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_role',
                        'label' => 'Leader 1 Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Founder & Director (M.A., B.Ed.)',
                        'help' => 'First signatory designation.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_name',
                        'label' => 'Leader 2 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Rajbir Singh',
                        'help' => 'Second signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_role',
                        'label' => 'Leader 2 Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Principal (M.A., B.Ed.)',
                        'help' => 'Second signatory designation.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_name',
                        'label' => 'Leader 3 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Indra Dev',
                        'help' => 'Third signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_role',
                        'label' => 'Leader 3 Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Coordinator (LL.M., Ex-GM RBI)',
                        'help' => 'Third signatory designation.'
                    ]
                ]
            ],

            // Section 8: Campus Visual Tour Collage
            [
                'title' => 'Section 8: Campus Visual Tour Collage (5 Photo Slots)',
                'icon'  => 'grid_view',
                'desc'  => 'Manage all 5 photo cards, upload custom photos, or pick from existing assets with live previews and badge labels.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'tour_tagline',
                        'label' => 'Visual Tour Eyebrow',
                        'type' => 'text',
                        'default' => 'Visual Tour',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_title',
                        'label' => 'Visual Tour Heading',
                        'type' => 'text',
                        'default' => 'Moments & Campus Life',
                        'help' => 'Section headline.'
                    ],
                    // Tour Photo 1
                    [
                        'kind' => 'image',
                        'key' => 'tour_img1',
                        'label' => 'Tour Photo 1 (Top Left: Main Building)',
                        'default' => 'assets/images/sunrise school image/school.webp',
                        'alt' => 'Main Campus Building',
                        'help' => 'Top left photo in the 3-column collage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl1',
                        'label' => 'Tour Photo 1 Label',
                        'type' => 'text',
                        'default' => 'Main Campus Building',
                        'help' => 'Badge label displayed over photo 1.'
                    ],
                    // Tour Photo 2
                    [
                        'kind' => 'image',
                        'key' => 'tour_img2',
                        'label' => 'Tour Photo 2 (Bottom Left: Prayer & Assembly)',
                        'default' => 'assets/images/sunrise school image/children_praying.webp',
                        'alt' => 'Morning Prayer & Assembly',
                        'help' => 'Bottom left photo in the 3-column collage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl2',
                        'label' => 'Tour Photo 2 Label',
                        'type' => 'text',
                        'default' => 'Morning Prayer & Assembly',
                        'help' => 'Badge label displayed over photo 2.'
                    ],
                    // Tour Photo 3
                    [
                        'kind' => 'image',
                        'key' => 'tour_img3',
                        'label' => 'Tour Photo 3 (Center Featured: Panorama Campus View)',
                        'default' => 'assets/images/sunrise school image/school3.webp',
                        'alt' => 'Campus Panorama View',
                        'help' => 'Tall center highlight photo in the collage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl3',
                        'label' => 'Tour Photo 3 Label',
                        'type' => 'text',
                        'default' => 'Campus Panorama View',
                        'help' => 'Badge label displayed over photo 3.'
                    ],
                    // Tour Photo 4
                    [
                        'kind' => 'image',
                        'key' => 'tour_img4',
                        'label' => 'Tour Photo 4 (Top Right: Science Exhibitions)',
                        'default' => 'assets/images/sunrise school image/exhibition3.webp',
                        'alt' => 'Student Science Exhibitions',
                        'help' => 'Top right photo in the collage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl4',
                        'label' => 'Tour Photo 4 Label',
                        'type' => 'text',
                        'default' => 'Student Science Exhibitions',
                        'help' => 'Badge label displayed over photo 4.'
                    ],
                    // Tour Photo 5
                    [
                        'kind' => 'image',
                        'key' => 'tour_img5',
                        'label' => 'Tour Photo 5 (Bottom Right: Mentorship)',
                        'default' => 'assets/images/sunrise school image/students_teachers.webp',
                        'alt' => 'Interactive Faculty Mentorship',
                        'help' => 'Bottom right photo in the collage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl5',
                        'label' => 'Tour Photo 5 Label',
                        'type' => 'text',
                        'default' => 'Interactive Faculty Mentorship',
                        'help' => 'Badge label displayed over photo 5.'
                    ]
                ]
            ],

            // Section 9: Mandatory Public Disclosure & Compliance
            [
                'title' => 'Section 9: Mandatory Public Disclosure & Regulatory Compliance (#mandatory-disclosure)',
                'icon'  => 'verified_user',
                'desc'  => 'HBSE compliance parameters, managing society details, school codes, and 5 statutory certificate statuses.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'disclosure_badge',
                        'label' => 'Disclosure Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Official Governance & Compliance',
                        'help' => 'Eyebrow tag above the section title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disclosure_title',
                        'label' => 'Disclosure Section Heading',
                        'type' => 'text',
                        'default' => 'Mandatory Public Disclosure (HBSE Norms)',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disclosure_desc',
                        'label' => 'Disclosure Introductory Paragraph',
                        'type' => 'text',
                        'default' => 'In compliance with Board of School Education Haryana (HBSE) guidelines, our institutional accreditations, statutory certificates, and governance parameters are maintained transparently.',
                        'help' => 'Introductory description text.'
                    ],
                    // Institutional Information
                    [
                        'kind' => 'text',
                        'key' => 'disc_school_name',
                        'label' => 'Official School Name',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Full registered name of the institution.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_board',
                        'label' => 'Board Affiliation Details',
                        'type' => 'text',
                        'default' => 'HBSE (Affiliated since 2011)',
                        'help' => 'Affiliating body and year.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_code',
                        'label' => 'Affiliation Code / Registration Number',
                        'type' => 'text',
                        'default' => 'HBSE Code: SR-2011-DH',
                        'help' => 'Official board affiliation number / school code.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_society',
                        'label' => 'Managing Society / Trust Name',
                        'type' => 'text',
                        'default' => 'Sun Rise Educational Society, Dobhi',
                        'help' => 'Name of the registered society managing the school.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_principal',
                        'label' => 'Principal Full Name & Degrees',
                        'type' => 'text',
                        'default' => 'Mr. Rajbir Singh (M.A., B.Ed.)',
                        'help' => 'School head name and qualifications.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_address',
                        'label' => 'Campus Postal Address',
                        'type' => 'text',
                        'default' => 'Main Road Dobhi, Near PHC, Hisar - 125001',
                        'help' => 'Physical location and postal code.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'disc_timings',
                        'label' => 'Operational Timings Summary',
                        'type' => 'text',
                        'default' => 'Summer: 7:30 AM - 1:30 PM | Winter: 8:30 AM - 2:30 PM',
                        'help' => 'Daily operational schedule.'
                    ],
                    // Certificate 1: Affiliation
                    [
                        'kind' => 'text',
                        'key' => 'cert1_name',
                        'label' => 'Certificate 1 Name (Affiliation)',
                        'type' => 'text',
                        'default' => 'HBSE Affiliation Certificate',
                        'help' => 'Title of certificate 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert1_valid',
                        'label' => 'Certificate 1 Validity / Issuing Authority',
                        'type' => 'text',
                        'default' => 'Senior Secondary Level 10+2',
                        'help' => 'Subtitle / validity note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert1_status',
                        'label' => 'Certificate 1 Badge Status',
                        'type' => 'text',
                        'default' => 'VERIFIED',
                        'help' => 'Status pill text (e.g. VERIFIED, ACTIVE, VALID).'
                    ],
                    // Certificate 2: Fire Safety
                    [
                        'kind' => 'text',
                        'key' => 'cert2_name',
                        'label' => 'Certificate 2 Name (Fire Safety)',
                        'type' => 'text',
                        'default' => 'Fire Safety & Emergency Certificate',
                        'help' => 'Title of certificate 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert2_valid',
                        'label' => 'Certificate 2 Validity / Issuing Authority',
                        'type' => 'text',
                        'default' => 'Certified by Fire Department Haryana',
                        'help' => 'Subtitle / validity note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert2_status',
                        'label' => 'Certificate 2 Badge Status',
                        'type' => 'text',
                        'default' => 'RENEWED',
                        'help' => 'Status pill text (e.g. RENEWED, ACTIVE).'
                    ],
                    // Certificate 3: Building Safety
                    [
                        'kind' => 'text',
                        'key' => 'cert3_name',
                        'label' => 'Certificate 3 Name (Building Safety)',
                        'type' => 'text',
                        'default' => 'Building Safety & Structural Audit',
                        'help' => 'Title of certificate 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert3_valid',
                        'label' => 'Certificate 3 Validity / Issuing Authority',
                        'type' => 'text',
                        'default' => 'Certified by PWD (B&R) / Chartered Engineer',
                        'help' => 'Subtitle / validity note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert3_status',
                        'label' => 'Certificate 3 Badge Status',
                        'type' => 'text',
                        'default' => 'COMPLIANT',
                        'help' => 'Status pill text (e.g. COMPLIANT, CERTIFIED).'
                    ],
                    // Certificate 4: Water & Sanitation
                    [
                        'kind' => 'text',
                        'key' => 'cert4_name',
                        'label' => 'Certificate 4 Name (Drinking Water & Sanitation)',
                        'type' => 'text',
                        'default' => 'Safe Drinking Water & Sanitation',
                        'help' => 'Title of certificate 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert4_valid',
                        'label' => 'Certificate 4 Validity / Issuing Authority',
                        'type' => 'text',
                        'default' => 'Certified by Public Health Engineering Dept.',
                        'help' => 'Subtitle / validity note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert4_status',
                        'label' => 'Certificate 4 Badge Status',
                        'type' => 'text',
                        'default' => 'ACTIVE',
                        'help' => 'Status pill text (e.g. ACTIVE, VERIFIED).'
                    ],
                    // Certificate 5: DEO Recognition
                    [
                        'kind' => 'text',
                        'key' => 'cert5_name',
                        'label' => 'Certificate 5 Name (DEO Recognition)',
                        'type' => 'text',
                        'default' => 'DEO / Government Recognition Certificate',
                        'help' => 'Title of certificate 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert5_valid',
                        'label' => 'Certificate 5 Validity / Issuing Authority',
                        'type' => 'text',
                        'default' => 'District Education Officer, Hisar',
                        'help' => 'Subtitle / validity note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cert5_status',
                        'label' => 'Certificate 5 Badge Status',
                        'type' => 'text',
                        'default' => 'PERMANENT',
                        'help' => 'Status pill text (e.g. PERMANENT, APPROVED).'
                    ],
                    // Footer verification note
                    [
                        'kind' => 'text',
                        'key' => 'disc_footer_note',
                        'label' => 'Physical Inspection Office Note',
                        'type' => 'text',
                        'default' => 'For physical verification of original statutory records and certificates, please visit the administrative office during school hours.',
                        'help' => 'Instructions for parents / authorities inspecting records.'
                    ]
                ]
            ]
        ]
    ],
    'academics' => [
        'title' => 'Academics Page',
        'icon'  => 'school',
        'desc'  => 'HBSE Curriculum, Stages (Pre-Primary to 12th), 3 Streams, and Teaching Methodology',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Header',
                'icon'  => 'flag',
                'desc'  => 'Hero image, eyebrow badge, main title, and introductory text.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Academics Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Science and Academic Framework',
                        'help' => 'Top background image for academics.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Academic Excellence',
                        'help' => 'Pill badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Main Hero Title',
                        'type' => 'text',
                        'default' => 'Rigorous HBSE Curriculum Designed for Success',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle',
                        'type' => 'text',
                        'default' => 'Discover an enriching academic framework from Pre-Primary to Class 12, fostering analytical thinking, practical lab experimentation, moral values, and board examination distinction.',
                        'help' => 'Subtitle text.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Quick Academic Stats Strip',
                'icon'  => 'analytics',
                'desc'  => '4 stat counters: Pass record, ratio, streams, and lab infrastructure.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Value',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Pass record.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'HBSE Pass Record',
                        'help' => 'Label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Value',
                        'type' => 'text',
                        'default' => '1:15',
                        'help' => 'Ratio.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Teacher-Student Ratio',
                        'help' => 'Label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Value',
                        'type' => 'text',
                        'default' => '3 Streams',
                        'help' => 'Streams.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Science, Commerce & Arts',
                        'help' => 'Label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Value',
                        'type' => 'text',
                        'default' => 'Modern',
                        'help' => 'Infra.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'Labs & Smart Classes',
                        'help' => 'Label.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Curriculum Stages Overview',
                'icon'  => 'auto_stories',
                'desc'  => 'Header for academic levels from Pre-Primary through Class 12.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_eyebrow',
                        'label' => 'Curriculum Eyebrow',
                        'type' => 'text',
                        'default' => 'Academic Stages',
                        'help' => 'Tagline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_heading',
                        'label' => 'Curriculum Heading',
                        'type' => 'text',
                        'default' => 'Curriculum Stages by Level',
                        'help' => 'Section heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_desc',
                        'label' => 'Curriculum Subtitle',
                        'type' => 'text',
                        'default' => 'Our progressive learning architecture builds conceptual clarity, self-confidence, and critical inquiry from early years to Class 12.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Senior Secondary Academic Streams',
                'icon'  => 'category',
                'desc'  => 'Stream descriptions for Science, Commerce, and Arts (Class 11 & 12).',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'streams_eyebrow',
                        'label' => 'Streams Eyebrow',
                        'type' => 'text',
                        'default' => 'Class 11 & 12 Streams',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'streams_heading',
                        'label' => 'Streams Heading',
                        'type' => 'text',
                        'default' => 'Senior Secondary Academic Streams',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_name',
                        'label' => 'Stream 1 Title (Science)',
                        'type' => 'text',
                        'default' => 'Science (Medical & Non-Medical)',
                        'help' => 'Science stream title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_desc',
                        'label' => 'Stream 1 Description',
                        'type' => 'text',
                        'default' => 'Equipped with state-of-the-art physics, chemistry, biology, and computer science laboratories for in-depth conceptual and practical learning.',
                        'help' => 'Science description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_name',
                        'label' => 'Stream 2 Title (Commerce)',
                        'type' => 'text',
                        'default' => 'Commerce',
                        'help' => 'Commerce stream title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_desc',
                        'label' => 'Stream 2 Description',
                        'type' => 'text',
                        'default' => 'Comprehensive economic, accounting, and business studies designed for careers in banking, finance, CA, and entrepreneurship.',
                        'help' => 'Commerce description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_name',
                        'label' => 'Stream 3 Title (Arts / Humanities)',
                        'type' => 'text',
                        'default' => 'Arts & Humanities',
                        'help' => 'Arts stream title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_desc',
                        'label' => 'Stream 3 Description',
                        'type' => 'text',
                        'default' => 'Deep exploration of history, political science, geography, literature, and social sciences for future administrative and legal leaders.',
                        'help' => 'Arts description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Pedagogical Approach / Teaching Methodology',
                'icon'  => 'psychology',
                'desc'  => '4 methodology pillars: Concept clarity, practical labs, testing, individual care.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'pedagogy_eyebrow',
                        'label' => 'Pedagogy Eyebrow',
                        'type' => 'text',
                        'default' => 'Pedagogical Approach',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pedagogy_heading',
                        'label' => 'Pedagogy Heading',
                        'type' => 'text',
                        'default' => 'How We Teach at Sun Rise',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step1_title',
                        'label' => 'Pillar 1 Title',
                        'type' => 'text',
                        'default' => 'Concept Clarity',
                        'help' => 'Pillar 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step1_desc',
                        'label' => 'Pillar 1 Description',
                        'type' => 'text',
                        'default' => 'Focus on thorough understanding of NCERT fundamentals before moving to advanced problem solving.',
                        'help' => 'Pillar 1 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step2_title',
                        'label' => 'Pillar 2 Title',
                        'type' => 'text',
                        'default' => 'Practical Labs',
                        'help' => 'Pillar 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step2_desc',
                        'label' => 'Pillar 2 Description',
                        'type' => 'text',
                        'default' => 'Hands-on experiments in physics, chemistry, biology, and computer science reinforce classroom theory.',
                        'help' => 'Pillar 2 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step3_title',
                        'label' => 'Pillar 3 Title',
                        'type' => 'text',
                        'default' => 'Regular Testing',
                        'help' => 'Pillar 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step3_desc',
                        'label' => 'Pillar 3 Description',
                        'type' => 'text',
                        'default' => 'Periodic unit tests, term exams, and mock board tests ensure continuous assessment and revision.',
                        'help' => 'Pillar 3 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_title',
                        'label' => 'Pillar 4 Title',
                        'type' => 'text',
                        'default' => 'Individual Care',
                        'help' => 'Pillar 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_desc',
                        'label' => 'Pillar 4 Description',
                        'type' => 'text',
                        'default' => 'Remedial classes for students needing extra help and personalized attention for every scholar.',
                        'help' => 'Pillar 4 text.'
                    ]
                ]
            ]
        ]
    ],
    'admissions' => [
        'title' => 'Admissions Page',
        'icon'  => 'assignment_turned_in',
        'desc'  => 'Session Status, Guarantee Badges, Class Vacancies Intro & Admission Helpdesk',
        'sections' => [
            [
                'title' => 'Section 1: Top Hero Banner & Status',
                'icon'  => 'flag',
                'desc'  => 'Academic session open status pill, main headline, and introduction.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'session_badge',
                        'label' => 'Session Status Pill Badge',
                        'type' => 'text',
                        'default' => 'Academic Session 2026–27 Registrations Open',
                        'help' => 'Pill banner with pulsing indicator.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Admissions Page Title',
                        'type' => 'text',
                        'default' => 'Admissions Open: Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_desc',
                        'label' => 'Admissions Overview Subtitle',
                        'type' => 'text',
                        'default' => 'Cultivating scholarship, strong character, and competitive excellence in Hisar district. Select your grade stream, verify student credentials, choose village transit, and secure provisional seat enrollment instantly via direct digital checkout.',
                        'help' => 'Overview text.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Key Highlights Badges',
                'icon'  => 'verified',
                'desc'  => '4 institutional guarantee badges displayed under the header.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'badge_HBSE',
                        'label' => 'Badge 1 (HBSE Affiliation)',
                        'type' => 'text',
                        'default' => 'HBSE Affiliation #530XXX (Dobhi, Hisar)',
                        'help' => 'Badge 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_digital',
                        'label' => 'Badge 2 (Digital Entry)',
                        'type' => 'text',
                        'default' => '100% Digital Fast-Track Entry',
                        'help' => 'Badge 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_token',
                        'label' => 'Badge 3 (Seat Allocation)',
                        'type' => 'text',
                        'default' => 'Instant Seat Allocation Token',
                        'help' => 'Badge 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_escrow',
                        'label' => 'Badge 4 (Payment Security)',
                        'type' => 'text',
                        'default' => 'RBI & PCI-DSS 256-Bit Escrow',
                        'help' => 'Badge 4.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Class & Stream Matrix Intro',
                'icon'  => 'table_view',
                'desc'  => 'Heading and instructions above the class selection cards.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_eyebrow',
                        'label' => 'Selector Eyebrow',
                        'type' => 'text',
                        'default' => 'Select Admission Grade',
                        'help' => 'Eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_heading',
                        'label' => 'Selector Heading',
                        'type' => 'text',
                        'default' => 'Available Classes & Available Vacancies',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_desc',
                        'label' => 'Selector Instruction Text',
                        'type' => 'text',
                        'default' => 'Choose the prospective level to populate academic fees, syllabi criteria, and batch schedules.',
                        'help' => 'Subtitle.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Admission Helpdesk & Contact',
                'icon'  => 'support_agent',
                'desc'  => 'Office hours and helpline phone for admission queries.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'help_heading',
                        'label' => 'Helpdesk Heading',
                        'type' => 'text',
                        'default' => 'Need Assistance with Online Admissions?',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_desc',
                        'label' => 'Helpdesk Description',
                        'type' => 'text',
                        'default' => 'Our administrative office is open Monday to Saturday (Summer: 7:30 AM to 1:30 PM | Winter: 8:30 AM to 2:30 PM) to assist parents with document verification, fee concessions, and transport routes.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_phone',
                        'label' => 'Helpdesk Phone Number',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Phone.'
                    ]
                ]
            ]
        ]
    ],
    'campus' => [
        'title' => 'Campus & Facilities',
        'icon'  => 'domain',
        'desc'  => 'Hero Banner, 6 Infrastructure Facilities, 24/7 CCTV Safety & Experience CTA',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Intro',
                'icon'  => 'flag',
                'desc'  => 'Top banner image, eyebrow badge, title, and intro text.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Campus Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/school.webp',
                        'alt' => 'Sun Rise School Campus Building',
                        'help' => 'Top background image on campus.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Modern Campus Infrastructure',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Campus Hero Title',
                        'type' => 'text',
                        'default' => 'A Vibrant & Safe Campus Built for Excellence',
                        'help' => 'Main title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Campus Hero Subtitle',
                        'type' => 'text',
                        'default' => 'Explore our purpose-built campus in Dobhi, Haryana designed to nurture academic focus, athletic vigor, scientific curiosity, and cultural creativity.',
                        'help' => 'Subtitle.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Campus Infrastructure Header',
                'icon'  => 'info',
                'desc'  => 'Introductory heading and text above the 6 facilities grid.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'facilities_eyebrow',
                        'label' => 'Facilities Eyebrow',
                        'type' => 'text',
                        'default' => 'Campus Infrastructure',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'facilities_heading',
                        'label' => 'Facilities Section Heading',
                        'type' => 'text',
                        'default' => 'Facilities for Holistic Growth',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'facilities_desc',
                        'label' => 'Facilities Overview Subtitle',
                        'type' => 'text',
                        'default' => 'Every wing of Sun Rise Sr. Sec. School is thoughtfully equipped to ensure total safety, hygiene, modern learning tools, and joyful childhood development.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Core Campus Facilities (6 Cards with Photos)',
                'icon'  => 'apartment',
                'desc'  => 'Classrooms, Science Lab, Sports Ground, Yoga Arena, Exhibition Hall, Assembly Courtyard.',
                'fields' => [
                    // Facility 1
                    [
                        'kind' => 'image',
                        'key' => 'fac1_img',
                        'label' => 'Facility 1 Photo (Spacious Classrooms)',
                        'default' => 'assets/images/sunrise school image/children_sitting.webp',
                        'alt' => 'Spacious Interactive Classrooms',
                        'help' => 'Photo for classrooms.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_tag',
                        'label' => 'Facility 1 Category Tag',
                        'type' => 'text',
                        'default' => 'Interactive Learning',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_title',
                        'label' => 'Facility 1 Title',
                        'type' => 'text',
                        'default' => 'Spacious Classrooms',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_desc',
                        'label' => 'Facility 1 Description',
                        'type' => 'text',
                        'default' => 'Well-ventilated, naturally lit classrooms with ergonomic student seating, audio-visual display aids, and positive wall aesthetics.',
                        'help' => 'Description.'
                    ],
                    // Facility 2
                    [
                        'kind' => 'image',
                        'key' => 'fac2_img',
                        'label' => 'Facility 2 Photo (Advanced Science Lab)',
                        'default' => 'assets/images/sunrise school image/exhibition2.webp',
                        'alt' => 'Advanced Science Laboratory',
                        'help' => 'Photo for science lab.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_tag',
                        'label' => 'Facility 2 Category Tag',
                        'type' => 'text',
                        'default' => 'Hands-On Discovery',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_title',
                        'label' => 'Facility 2 Title',
                        'type' => 'text',
                        'default' => 'Advanced Science Lab',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_desc',
                        'label' => 'Facility 2 Description',
                        'type' => 'text',
                        'default' => 'Fully equipped practical laboratories for Physics, Chemistry, and Biology adhering strictly to HBSE safety benchmarks and experimental standards.',
                        'help' => 'Description.'
                    ],
                    // Facility 3
                    [
                        'kind' => 'image',
                        'key' => 'fac3_img',
                        'label' => 'Facility 3 Photo (Sports Ground)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Sports Ground & Athletics',
                        'help' => 'Photo for sports ground.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_tag',
                        'label' => 'Facility 3 Category Tag',
                        'type' => 'text',
                        'default' => 'Athletics & Games',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_title',
                        'label' => 'Facility 3 Title',
                        'type' => 'text',
                        'default' => 'Extensive Sports Ground',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_desc',
                        'label' => 'Facility 3 Description',
                        'type' => 'text',
                        'default' => 'Expansive outdoor sports grounds for Cricket, Kabaddi, Volleyball, Track Athletics, and regular physical education drills under trained coaches.',
                        'help' => 'Description.'
                    ],
                    // Facility 4
                    [
                        'kind' => 'image',
                        'key' => 'fac4_img',
                        'label' => 'Facility 4 Photo (Yoga & Meditation)',
                        'default' => 'assets/images/sunrise school image/yoga.webp',
                        'alt' => 'Yoga & Meditation Arena',
                        'help' => 'Photo for yoga arena.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_tag',
                        'label' => 'Facility 4 Category Tag',
                        'type' => 'text',
                        'default' => 'Mind & Body',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_title',
                        'label' => 'Facility 4 Title',
                        'type' => 'text',
                        'default' => 'Yoga & Meditation Arena',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_desc',
                        'label' => 'Facility 4 Description',
                        'type' => 'text',
                        'default' => 'Daily morning pranayama, Surya Namaskar, and guided mindfulness sessions helping students cultivate razor-sharp concentration and calm emotional health.',
                        'help' => 'Description.'
                    ],
                    // Facility 5
                    [
                        'kind' => 'image',
                        'key' => 'fac5_img',
                        'label' => 'Facility 5 Photo (Exhibition & Project Hall)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Exhibition & Project Hall',
                        'help' => 'Photo for exhibition hall.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_tag',
                        'label' => 'Facility 5 Category Tag',
                        'type' => 'text',
                        'default' => 'Creative Expression',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_title',
                        'label' => 'Facility 5 Title',
                        'type' => 'text',
                        'default' => 'Exhibition & Project Hall',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_desc',
                        'label' => 'Facility 5 Description',
                        'type' => 'text',
                        'default' => 'Dedicated space for student science models, social science exhibitions, art displays, and community awareness presentations.',
                        'help' => 'Description.'
                    ],
                    // Facility 6
                    [
                        'kind' => 'image',
                        'key' => 'fac6_img',
                        'label' => 'Facility 6 Photo (Morning Assembly Courtyard)',
                        'default' => 'assets/images/sunrise school image/children_praying.webp',
                        'alt' => 'Morning Assembly Courtyard',
                        'help' => 'Photo for assembly courtyard.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_tag',
                        'label' => 'Facility 6 Category Tag',
                        'type' => 'text',
                        'default' => 'Character & Values',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_title',
                        'label' => 'Facility 6 Title',
                        'type' => 'text',
                        'default' => 'Morning Assembly Courtyard',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_desc',
                        'label' => 'Facility 6 Description',
                        'type' => 'text',
                        'default' => 'Where the whole school unites each morning for prayers, national anthem, news recitation, inspirational speeches, and student felicitations.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: 24/7 Campus Safety & CCTV Surveillance',
                'icon'  => 'security',
                'desc'  => 'Safety features banner, CCTV details, RO drinking water, and boundary security.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'safety_img',
                        'label' => 'Campus Safety Night Photo',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Secure CCTV Monitored Campus',
                        'help' => 'Photo on left of safety card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_tag',
                        'label' => 'Safety Tagline',
                        'type' => 'text',
                        'default' => 'Uncompromising Safety',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_title',
                        'label' => 'Safety Headline',
                        'type' => 'text',
                        'default' => 'Secure, CCTV Monitored Campus',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_desc',
                        'label' => 'Safety Description',
                        'type' => 'text',
                        'default' => 'Our campus in Dobhi is fully enclosed with perimeter boundary security, 24/7 CCTV surveillance across corridors, gates, and play areas, filtered RO drinking water, and dedicated power backup.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Campus Experience CTA',
                'icon'  => 'explore',
                'desc'  => 'Bottom banner encouraging visitors to view the photo gallery or book a tour.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'cta_bg',
                        'label' => 'CTA Background Image',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Campus Life Experience',
                        'help' => 'Background photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_eyebrow',
                        'label' => 'CTA Eyebrow',
                        'type' => 'text',
                        'default' => 'Experience Sun Rise School',
                        'help' => 'Eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'CTA Heading',
                        'type' => 'text',
                        'default' => 'Want to see more campus moments?',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'CTA Description',
                        'type' => 'text',
                        'default' => 'Browse through our full visual chronicle containing photographs from academic exhibitions, sports days, award ceremonies, and everyday school celebrations.',
                        'help' => 'Description.'
                    ]
                ]
            ]
        ]
    ],
    'events' => [
        'title' => 'Events & News',
        'icon'  => 'celebration',
        'desc'  => 'Featured Highlight Event, School News Grid, Academic Calendar & Upcoming Agenda',
        'sections' => [
            [
                'title' => 'Section 1: Featured Highlight Event Banner',
                'icon'  => 'star',
                'desc'  => 'Top featured event showcase with background banner, timing, and campus venue.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'featured_banner',
                        'label' => 'Featured Event Background Banner Image',
                        'default' => 'assets/images/sunrise school image/award_ceremony.webp',
                        'alt' => 'Annual Prize Distribution and Award Ceremony',
                        'help' => 'Main hero banner on events.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_badge',
                        'label' => 'Featured Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Featured Event',
                        'help' => 'Pill tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_title',
                        'label' => 'Featured Event Title',
                        'type' => 'text',
                        'default' => 'Annual Science & Art Exhibition 2026',
                        'help' => 'Headline for the top event.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_subtitle',
                        'label' => 'Featured Event Description',
                        'type' => 'text',
                        'default' => 'Experience the ingenuity of our students as they demonstrate live working science models, robotics experiments, sustainable agriculture concepts, and artistic creations.',
                        'help' => 'Summary text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_time',
                        'label' => 'Event Schedule / Timing',
                        'type' => 'text',
                        'default' => '09:30 AM - 03:00 PM',
                        'help' => 'Timing.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_location',
                        'label' => 'Event Venue / Location',
                        'type' => 'text',
                        'default' => 'Main Campus Auditorium & Grounds',
                        'help' => 'Location on campus.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: School News & Happenings Grid (4 Cards)',
                'icon'  => 'newspaper',
                'desc'  => 'News stories: Science model showcase, Independence Day, Excellence award, Press coverage.',
                'fields' => [
                    // News 1
                    [
                        'kind' => 'image',
                        'key' => 'news1_img',
                        'label' => 'News 1 Photo (Science Fair)',
                        'default' => 'assets/images/sunrise school image/exhibition7.webp',
                        'alt' => 'District Level Science Model Showcase',
                        'help' => 'Photo for news card 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news1_date',
                        'label' => 'News 1 Date',
                        'type' => 'text',
                        'default' => '24 OCT',
                        'help' => 'Day & month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news1_tag',
                        'label' => 'News 1 Category',
                        'type' => 'text',
                        'default' => 'Science Fair',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news1_title',
                        'label' => 'News 1 Title',
                        'type' => 'text',
                        'default' => 'District Level Science Model Showcase',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news1_desc',
                        'label' => 'News 1 Summary',
                        'type' => 'text',
                        'default' => 'Students demonstrated innovative research prototypes and hydraulic mechanics models with outstanding presentation skills.',
                        'help' => 'Description.'
                    ],
                    // News 2
                    [
                        'kind' => 'image',
                        'key' => 'news2_img',
                        'label' => 'News 2 Photo (National Day)',
                        'default' => 'assets/images/sunrise school image/IMG_20210815_093156~2.webp',
                        'alt' => 'Independence Day Flag Hoisting',
                        'help' => 'Photo for news card 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news2_date',
                        'label' => 'News 2 Date',
                        'type' => 'text',
                        'default' => '15 AUG',
                        'help' => 'Day & month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news2_tag',
                        'label' => 'News 2 Category',
                        'type' => 'text',
                        'default' => 'National Day',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news2_title',
                        'label' => 'News 2 Title',
                        'type' => 'text',
                        'default' => 'Independence Day Flag Hoisting & Parade',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news2_desc',
                        'label' => 'News 2 Summary',
                        'type' => 'text',
                        'default' => 'Celebrated with patriotic enthusiasm, tri-color flag unfurling by management, and spirited cultural performances.',
                        'help' => 'Description.'
                    ],
                    // News 3
                    [
                        'kind' => 'image',
                        'key' => 'news3_img',
                        'label' => 'News 3 Photo (Institutional Award)',
                        'default' => 'assets/images/sunrise school image/award_to_school.webp',
                        'alt' => 'Institutional Excellence Award',
                        'help' => 'Photo for news card 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news3_date',
                        'label' => 'News 3 Date',
                        'type' => 'text',
                        'default' => '05 SEP',
                        'help' => 'Day & month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news3_tag',
                        'label' => 'News 3 Category',
                        'type' => 'text',
                        'default' => 'Honors',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news3_title',
                        'label' => 'News 3 Title',
                        'type' => 'text',
                        'default' => 'Institutional Excellence Award to School',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news3_desc',
                        'label' => 'News 3 Summary',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School recognized for exceptional academic standards and community educational leadership in Hisar region.',
                        'help' => 'Description.'
                    ],
                    // News 4
                    [
                        'kind' => 'image',
                        'key' => 'news4_img',
                        'label' => 'News 4 Photo (Media Coverage)',
                        'default' => 'assets/images/sunrise school image/image_news.webp',
                        'alt' => 'Media Coverage of Board Results',
                        'help' => 'Photo for news card 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news4_date',
                        'label' => 'News 4 Date',
                        'type' => 'text',
                        'default' => '12 MAY',
                        'help' => 'Day & month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news4_tag',
                        'label' => 'News 4 Category',
                        'type' => 'text',
                        'default' => 'Press',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news4_title',
                        'label' => 'News 4 Title',
                        'type' => 'text',
                        'default' => 'Media Coverage: Board Exam Triumphs',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news4_desc',
                        'label' => 'News 4 Summary',
                        'type' => 'text',
                        'default' => 'Prominent regional newspapers report on the extraordinary 100% HBSE board passing rate and high scoring records of our students.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Academic Calendar Box & Agenda Notices',
                'icon'  => 'calendar_month',
                'desc'  => 'Sidebar academic calendar highlight and upcoming agenda notices.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'calendar_title',
                        'label' => 'Calendar Box Title',
                        'type' => 'text',
                        'default' => 'School Calendar',
                        'help' => 'Sidebar title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'calendar_desc',
                        'label' => 'Calendar Box Description',
                        'type' => 'text',
                        'default' => 'Check term schedules, periodic unit tests, quarterly assessments, board pre-boards, and gazetted school holidays.',
                        'help' => 'Calendar summary.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda1_title',
                        'label' => 'Agenda 1 Title',
                        'type' => 'text',
                        'default' => 'Parent-Teacher Meeting (PTM)',
                        'help' => 'Agenda item 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda1_time',
                        'label' => 'Agenda 1 Time',
                        'type' => 'text',
                        'default' => '09:00 AM - 01:00 PM',
                        'help' => 'Timing.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda2_title',
                        'label' => 'Agenda 2 Title',
                        'type' => 'text',
                        'default' => "Children's Day Cultural Fest",
                        'help' => 'Agenda item 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda3_title',
                        'label' => 'Agenda 3 Title',
                        'type' => 'text',
                        'default' => 'National Mathematics Day Quiz',
                        'help' => 'Agenda item 3.'
                    ]
                ]
            ]
        ]
    ],
    'faculty' => [
        'title' => 'Faculty & Staff',
        'icon'  => 'groups',
        'desc'  => 'Complete Faculty Page Control: SEO Meta, Hero Banner, 3 Leadership Mentors (Quotes, Bios, Badges), 6 Staff Gallery Photos & Badges, 4 Academic Faculties, and Recruitment CTA',
        'sections' => [
            // Section 0: SEO & Meta Settings
            [
                'title' => 'Section 0: SEO & Meta Settings',
                'icon'  => 'search',
                'desc'  => 'Control how the Faculty page appears on Google search and browser tabs.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'meta_title',
                        'label' => 'Page Browser Title (<title>)',
                        'type' => 'text',
                        'default' => 'Faculty & Staff | Academic Mentors',
                        'help' => 'Shown in the browser tab and Google search results.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'meta_desc',
                        'label' => 'Meta Description (Search Snippet)',
                        'type' => 'text',
                        'default' => 'Meet the dedicated educators, mentors, and academic leadership team of Sun Rise Sr. Sec. School, Dobhi committed to holistic child development.',
                        'help' => 'Summary snippet displayed by search engines.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'meta_keywords',
                        'label' => 'Meta Keywords',
                        'type' => 'text',
                        'default' => 'faculty, teachers, school leadership, principal, department heads, staff directory, Sun Rise School Dobhi',
                        'help' => 'Comma-separated SEO keywords.'
                    ]
                ]
            ],
            // Section 1: Hero Banner & Page Intro
            [
                'title' => 'Section 1: Hero Banner & Page Intro',
                'icon'  => 'flag',
                'desc'  => 'Top banner background image, gold eyebrow badge, main title, and introductory paragraph.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Faculty Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/teachers_and_students.webp',
                        'alt' => 'Sun Rise School Teachers and Mentors',
                        'help' => 'Top background hero image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Dedicated Educators',
                        'help' => 'Gold rounded badge displayed above the main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Faculty Main Headline',
                        'type' => 'text',
                        'default' => 'Our Distinguished Faculty & Staff',
                        'help' => 'Primary title on the faculty page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Faculty Page Subtitle / Intro',
                        'type' => 'text',
                        'default' => 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.',
                        'help' => 'Introductory text beneath the main headline.'
                    ]
                ]
            ],
            // Section 2: Academic Leadership (3 Profiles)
            [
                'title' => 'Section 2: Academic Leadership (3 Complete Leadership Profiles)',
                'icon'  => 'badge',
                'desc'  => 'Section header and full profiles for Founder & Director, Principal, and Coordinator (Photo, Badge, Name, Qualifications, Experience, Quote, Detailed Biography, and Footer Badges).',
                'fields' => [
                    // Leadership Section Header
                    [
                        'kind' => 'text',
                        'key' => 'leadership_eyebrow',
                        'label' => 'Leadership Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Guiding Vision',
                        'help' => 'Small uppercase gold text above the section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leadership_title',
                        'label' => 'Leadership Section Title',
                        'type' => 'text',
                        'default' => 'Academic Leadership',
                        'help' => 'Main section title for leadership.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leadership_desc',
                        'label' => 'Leadership Section Description',
                        'type' => 'text',
                        'default' => 'Guiding our academic ecosystem with years of pedagogical expertise, administrative brilliance, and a steadfast commitment to character building.',
                        'help' => 'Paragraph displayed next to the leadership heading.'
                    ],

                    // Leader 1: Founder & Director
                    [
                        'kind' => 'image',
                        'key' => 'leader1_photo',
                        'label' => 'Leader 1 Photo (Founder & Director - Mr. Bhader Singh Swami)',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'Mr. Bhader Singh Swami - Founder & Director',
                        'help' => 'Director photo (recommended ratio 4:3).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_tag',
                        'label' => 'Leader 1 Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Founder & Director',
                        'help' => 'Badge floating on the bottom-left corner of the photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_name',
                        'label' => 'Leader 1 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Bhader Singh Swami',
                        'help' => 'Name of Founder & Director.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_sub',
                        'label' => 'Leader 1 Designation & Qualifications',
                        'type' => 'text',
                        'default' => 'Founder & Director | M.A., B.Ed.',
                        'help' => 'Designation and academic degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_exp',
                        'label' => 'Leader 1 Experience Highlight Badge',
                        'type' => 'text',
                        'default' => '36 Yrs Teaching • 26 Yrs Management',
                        'help' => 'Gold highlight box with professional tenure.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_quote',
                        'label' => 'Leader 1 Educational Vision / Quote',
                        'type' => 'text',
                        'default' => '“Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society.”',
                        'help' => 'Inspirational quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_desc',
                        'label' => 'Leader 1 Detailed Biography',
                        'type' => 'html',
                        'default' => 'With 36 years of teaching experience and 26 years of experience in school management, Mr. Bhader Singh Swami has devoted his journey to education. Holding M.A. and B.Ed. qualifications, his vision centres on providing students with quality education grounded in discipline, values, character, and academic excellence.',
                        'help' => 'Comprehensive biography and message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_foot_left',
                        'label' => 'Leader 1 Footer Left Label',
                        'type' => 'text',
                        'default' => 'Institutional Founder',
                        'help' => 'Left bottom label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_foot_right',
                        'label' => 'Leader 1 Footer Right Label',
                        'type' => 'text',
                        'default' => 'Estd. 2007',
                        'help' => 'Right bottom label.'
                    ],

                    // Leader 2: Principal
                    [
                        'kind' => 'image',
                        'key' => 'leader2_photo',
                        'label' => 'Leader 2 Photo (Principal - Mr. Rajbir Singh)',
                        'default' => 'assets/images/sunrise school image/teachers_sitting.webp',
                        'alt' => 'Mr. Rajbir Singh - Principal',
                        'help' => 'Principal photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_tag',
                        'label' => 'Leader 2 Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Principal Office',
                        'help' => 'Badge on photo corner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_name',
                        'label' => 'Leader 2 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Rajbir Singh',
                        'help' => 'Name of Principal.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_sub',
                        'label' => 'Leader 2 Designation & Qualifications',
                        'type' => 'text',
                        'default' => 'Principal | M.A., B.Ed.',
                        'help' => 'Designation and degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_exp',
                        'label' => 'Leader 2 Experience Highlight Badge',
                        'type' => 'text',
                        'default' => '16 Years Professional Experience',
                        'help' => 'Gold highlight box.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_quote',
                        'label' => 'Leader 2 Academic Vision / Quote',
                        'type' => 'text',
                        'default' => '“Fostering a disciplined and purposeful learning environment where every student receives balanced opportunities for academic and holistic development.”',
                        'help' => 'Quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_desc',
                        'label' => 'Leader 2 Detailed Biography',
                        'type' => 'html',
                        'default' => 'With 16 years of professional experience in education, Mr. Rajbir Singh serves as the Principal. He brings a committed approach towards academic administration, supporting teachers and driving holistic student growth.',
                        'help' => 'Comprehensive biography.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_foot_left',
                        'label' => 'Leader 2 Footer Left Label',
                        'type' => 'text',
                        'default' => 'Academic Head',
                        'help' => 'Left bottom label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_foot_right',
                        'label' => 'Leader 2 Footer Right Label',
                        'type' => 'text',
                        'default' => 'HBSE Lead',
                        'help' => 'Right bottom label.'
                    ],

                    // Leader 3: Coordinator
                    [
                        'kind' => 'image',
                        'key' => 'leader3_photo',
                        'label' => 'Leader 3 Photo (Coordinator - Mr. Indra Dev)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Mr. Indra Dev - Coordinator',
                        'help' => 'Coordinator photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_tag',
                        'label' => 'Leader 3 Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Administration & Coordination',
                        'help' => 'Badge on photo corner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_name',
                        'label' => 'Leader 3 Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Indra Dev',
                        'help' => 'Name of Coordinator.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_sub',
                        'label' => 'Leader 3 Designation & Qualifications',
                        'type' => 'text',
                        'default' => 'Coordinator | B.A., M.A., LL.B., LL.M.',
                        'help' => 'Designation and degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_exp',
                        'label' => 'Leader 3 Experience Highlight Badge',
                        'type' => 'text',
                        'default' => '22 Yrs Exp • Former GM, Reserve Bank of India',
                        'help' => 'Gold highlight box.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_quote',
                        'label' => 'Leader 3 Administrative Vision / Quote',
                        'type' => 'text',
                        'default' => '“Maintaining the highest standards of organizational discipline, legal governance, and responsible institutional leadership.”',
                        'help' => 'Quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_desc',
                        'label' => 'Leader 3 Detailed Biography',
                        'type' => 'html',
                        'default' => 'Mr. Indra Dev brings 22 years of professional experience with qualifications in law and humanities. Prior to Sun Rise, he served as General Manager at the Reserve Bank of India (RBI), contributing high administrative standards.',
                        'help' => 'Comprehensive biography.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_foot_left',
                        'label' => 'Leader 3 Footer Left Label',
                        'type' => 'text',
                        'default' => 'Administration Lead',
                        'help' => 'Left bottom label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_foot_right',
                        'label' => 'Leader 3 Footer Right Label',
                        'type' => 'text',
                        'default' => '30+ Teaching Staff',
                        'help' => 'Right bottom label.'
                    ]
                ]
            ],
            // Section 3: Mentors in Action Gallery (6 Photographs)
            [
                'title' => 'Section 3: Mentors in Action Gallery (6 Photographs)',
                'icon'  => 'collections',
                'desc'  => 'Header text and 6 photographic showcases with category tags and titles.',
                'fields' => [
                    // Section Header
                    [
                        'kind' => 'text',
                        'key' => 'staff_section_eyebrow',
                        'label' => 'Gallery Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Our Teaching Force',
                        'help' => 'Small uppercase gold text above title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_section_title',
                        'label' => 'Gallery Section Title',
                        'type' => 'text',
                        'default' => 'Mentors in Action',
                        'help' => 'Main gallery heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_section_desc',
                        'label' => 'Gallery Section Subtitle',
                        'type' => 'text',
                        'default' => 'Capturing the dedication, teamwork, and pedagogical spirit of the Sun Rise Sr. Sec. School teaching community.',
                        'help' => 'Descriptive text under the gallery heading.'
                    ],

                    // Photo 1
                    [
                        'kind' => 'image',
                        'key' => 'staff_img1',
                        'label' => 'Staff Photo 1 (Full Staff Group)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'All Staff Members - Sun Rise School',
                        'help' => 'Staff photo 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge1',
                        'label' => 'Staff Photo 1 Category Badge',
                        'type' => 'text',
                        'default' => 'Full Staff Group',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title1',
                        'label' => 'Staff Photo 1 Caption Title',
                        'type' => 'text',
                        'default' => 'Sun Rise Teaching & Admin Staff',
                        'help' => 'Title overlay.'
                    ],

                    // Photo 2
                    [
                        'kind' => 'image',
                        'key' => 'staff_img2',
                        'label' => 'Staff Photo 2 (Mentorship)',
                        'default' => 'assets/images/sunrise school image/teachers_and_students.webp',
                        'alt' => 'Teachers and Students - Sun Rise School',
                        'help' => 'Staff photo 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge2',
                        'label' => 'Staff Photo 2 Category Badge',
                        'type' => 'text',
                        'default' => 'Mentorship',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title2',
                        'label' => 'Staff Photo 2 Caption Title',
                        'type' => 'text',
                        'default' => 'Faculty & High Achievers',
                        'help' => 'Title overlay.'
                    ],

                    // Photo 3
                    [
                        'kind' => 'image',
                        'key' => 'staff_img3',
                        'label' => 'Staff Photo 3 (Academic Planning)',
                        'default' => 'assets/images/sunrise school image/teachers_sitting.webp',
                        'alt' => 'Teachers Meeting - Sun Rise School',
                        'help' => 'Staff photo 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge3',
                        'label' => 'Staff Photo 3 Category Badge',
                        'type' => 'text',
                        'default' => 'Academic Session',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title3',
                        'label' => 'Staff Photo 3 Caption Title',
                        'type' => 'text',
                        'default' => 'Faculty Planning & Review',
                        'help' => 'Title overlay.'
                    ],

                    // Photo 4
                    [
                        'kind' => 'image',
                        'key' => 'staff_img4',
                        'label' => 'Staff Photo 4 (Department Team)',
                        'default' => 'assets/images/sunrise school image/school_staff.webp',
                        'alt' => 'School Staff Members',
                        'help' => 'Staff photo 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge4',
                        'label' => 'Staff Photo 4 Category Badge',
                        'type' => 'text',
                        'default' => 'Staff Team',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title4',
                        'label' => 'Staff Photo 4 Caption Title',
                        'type' => 'text',
                        'default' => 'Department Educators',
                        'help' => 'Title overlay.'
                    ],

                    // Photo 5
                    [
                        'kind' => 'image',
                        'key' => 'staff_img5',
                        'label' => 'Staff Photo 5 (Senior Mentors)',
                        'default' => 'assets/images/sunrise school image/teachers.webp',
                        'alt' => 'Senior School Mentors',
                        'help' => 'Staff photo 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge5',
                        'label' => 'Staff Photo 5 Category Badge',
                        'type' => 'text',
                        'default' => 'Pedagogy',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title5',
                        'label' => 'Staff Photo 5 Caption Title',
                        'type' => 'text',
                        'default' => 'Senior School Mentors',
                        'help' => 'Title overlay.'
                    ],

                    // Photo 6
                    [
                        'kind' => 'image',
                        'key' => 'staff_img6',
                        'label' => 'Staff Photo 6 (Campus Life Bonding)',
                        'default' => 'assets/images/sunrise school image/students_teachers.webp',
                        'alt' => 'Student & Mentor Bonding',
                        'help' => 'Staff photo 6.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge6',
                        'label' => 'Staff Photo 6 Category Badge',
                        'type' => 'text',
                        'default' => 'Campus Life',
                        'help' => 'Gold category pill on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title6',
                        'label' => 'Staff Photo 6 Caption Title',
                        'type' => 'text',
                        'default' => 'Student & Mentor Bonding',
                        'help' => 'Title overlay.'
                    ]
                ]
            ],
            // Section 4: Academic Departments & Subject Faculties (4 Disciplines)
            [
                'title' => 'Section 4: Academic Departments & Subject Faculties (4 Disciplines)',
                'icon'  => 'menu_book',
                'desc'  => 'Manage all 4 core subject faculties: Science, Mathematics, Commerce & Humanities, and Physical Education with icons, descriptions, and staff tags.',
                'fields' => [
                    // Section Header
                    [
                        'kind' => 'text',
                        'key' => 'dept_section_eyebrow',
                        'label' => 'Departments Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Academic Departments',
                        'help' => 'Small uppercase gold text above title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept_section_title',
                        'label' => 'Departments Section Title',
                        'type' => 'text',
                        'default' => 'Subject Faculties',
                        'help' => 'Main section title for academic departments.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept_section_desc',
                        'label' => 'Departments Section Subtitle',
                        'type' => 'text',
                        'default' => 'Our academic faculties comprise qualified, HBSE-trained educators with specialized postgraduate degrees in their respective disciplines.',
                        'help' => 'Descriptive summary below the heading.'
                    ],

                    // Department 1: Science
                    [
                        'kind' => 'text',
                        'key' => 'dept1_icon',
                        'label' => 'Dept 1 Icon (Material Symbols Name e.g. science, biotech)',
                        'type' => 'text',
                        'default' => 'science',
                        'help' => 'Icon identifier from Google Material Symbols.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept1_title',
                        'label' => 'Dept 1 Title (Science Faculty)',
                        'type' => 'text',
                        'default' => 'Science Faculty',
                        'help' => 'Faculty card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept1_desc',
                        'label' => 'Dept 1 Description',
                        'type' => 'text',
                        'default' => 'Physics, Chemistry, Biology & General Science with hands-on lab experiments and Olympiad guidance.',
                        'help' => 'Card description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept1_tag1',
                        'label' => 'Dept 1 Tag 1 (Staff Level)',
                        'type' => 'text',
                        'default' => 'PGT & TGT Staff',
                        'help' => 'Left tag at bottom of card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept1_tag2',
                        'label' => 'Dept 1 Tag 2 (Pedagogy Focus)',
                        'type' => 'text',
                        'default' => 'Labs & Theory',
                        'help' => 'Right gold tag at bottom of card.'
                    ],

                    // Department 2: Mathematics
                    [
                        'kind' => 'text',
                        'key' => 'dept2_icon',
                        'label' => 'Dept 2 Icon (e.g. calculate, functions)',
                        'type' => 'text',
                        'default' => 'calculate',
                        'help' => 'Icon identifier.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept2_title',
                        'label' => 'Dept 2 Title (Mathematics)',
                        'type' => 'text',
                        'default' => 'Mathematics',
                        'help' => 'Faculty card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept2_desc',
                        'label' => 'Dept 2 Description',
                        'type' => 'text',
                        'default' => 'Focusing on conceptual clarity, speed calculations, problem-solving techniques, and competitive readiness.',
                        'help' => 'Card description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept2_tag1',
                        'label' => 'Dept 2 Tag 1 (Grade Level)',
                        'type' => 'text',
                        'default' => 'Primary to 12th',
                        'help' => 'Left tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept2_tag2',
                        'label' => 'Dept 2 Tag 2 (Facility Focus)',
                        'type' => 'text',
                        'default' => 'Math Lab',
                        'help' => 'Right gold tag.'
                    ],

                    // Department 3: Commerce & Humanities
                    [
                        'kind' => 'text',
                        'key' => 'dept3_icon',
                        'label' => 'Dept 3 Icon (e.g. query_stats, account_balance)',
                        'type' => 'text',
                        'default' => 'query_stats',
                        'help' => 'Icon identifier.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept3_title',
                        'label' => 'Dept 3 Title (Commerce & Humanities)',
                        'type' => 'text',
                        'default' => 'Commerce & Humanities',
                        'help' => 'Faculty card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept3_desc',
                        'label' => 'Dept 3 Description',
                        'type' => 'text',
                        'default' => 'Accountancy, Business Studies, Economics, Political Science, History, and Hindi/English Languages.',
                        'help' => 'Card description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept3_tag1',
                        'label' => 'Dept 3 Tag 1 (Wing)',
                        'type' => 'text',
                        'default' => 'Senior Secondary',
                        'help' => 'Left tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept3_tag2',
                        'label' => 'Dept 3 Tag 2 (Orientation)',
                        'type' => 'text',
                        'default' => 'Career Focus',
                        'help' => 'Right gold tag.'
                    ],

                    // Department 4: Physical Education & Yoga
                    [
                        'kind' => 'text',
                        'key' => 'dept4_icon',
                        'label' => 'Dept 4 Icon (e.g. sports_kabaddi, fitness_center)',
                        'type' => 'text',
                        'default' => 'sports_kabaddi',
                        'help' => 'Icon identifier.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept4_title',
                        'label' => 'Dept 4 Title (Physical Ed. & Yoga)',
                        'type' => 'text',
                        'default' => 'Physical Ed. & Yoga',
                        'help' => 'Faculty card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept4_desc',
                        'label' => 'Dept 4 Description',
                        'type' => 'text',
                        'default' => 'Daily physical fitness, specialized sports coaching (Cricket, Kabaddi, Athletics), and morning yoga sessions.',
                        'help' => 'Card description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept4_tag1',
                        'label' => 'Dept 4 Tag 1 (Staff)',
                        'type' => 'text',
                        'default' => 'Sports Coaches',
                        'help' => 'Left tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'dept4_tag2',
                        'label' => 'Dept 4 Tag 2 (Participation)',
                        'type' => 'text',
                        'default' => 'All Grades',
                        'help' => 'Right gold tag.'
                    ]
                ]
            ],
            // Section 5: Join Our Teaching Team CTA
            [
                'title' => 'Section 5: Join Our Teaching Team CTA Banner',
                'icon'  => 'work',
                'desc'  => 'Recruitment message, subtitle, button text, and link destination.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'cta_eyebrow',
                        'label' => 'Career Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Career Opportunities',
                        'help' => 'Small uppercase gold text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'Career Heading',
                        'type' => 'text',
                        'default' => 'Want to Join Our Teaching Team?',
                        'help' => 'Primary recruitment headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'Career Description',
                        'type' => 'text',
                        'default' => 'We are always looking for passionate, certified educators who love teaching and inspiring students. Send us your resume.',
                        'help' => 'Recruitment invitation message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn_text',
                        'label' => 'Action Button Text',
                        'type' => 'text',
                        'default' => 'Apply as Educator',
                        'help' => 'Text on the call to action button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn_link',
                        'label' => 'Action Button Link Destination',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination URL (e.g. contact-us.php or contact-us.php#career).'
                    ]
                ]
            ]
        ]
    ],
    'gallery' => [
        'title' => 'Photo Gallery',
        'icon'  => 'photo_library',
        'desc'  => 'Hero Banner and 8 Curated Visual Archive Photographs with Categories and Titles',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Header',
                'icon'  => 'flag',
                'desc'  => 'Main header background banner, eyebrow, title, and description.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Gallery Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Visual Chronicle Banner',
                        'help' => 'Top background image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Visual Chronicle',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Gallery Banner Title',
                        'type' => 'text',
                        'default' => 'Life & Moments at Sun Rise School',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Gallery Banner Description',
                        'type' => 'text',
                        'default' => 'Explore photographs capturing academic curiosity, hands-on science exhibitions, athletic triumphs, yoga mornings, and merit celebrations across our Dobhi campus.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Visual Archive Photographs (8 Items)',
                'icon'  => 'grid_on',
                'desc'  => 'Curated exhibition, awards, sports, yoga, toppers, campus, and smart class pictures.',
                'fields' => [
                    // Photo 1
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img1',
                        'label' => 'Photo 1 (Science Exhibition)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Annual Science Exhibition',
                        'help' => 'Photo 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title1',
                        'label' => 'Photo 1 Title',
                        'type' => 'text',
                        'default' => 'Annual Science Exhibition',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc1',
                        'label' => 'Photo 1 Description',
                        'type' => 'text',
                        'default' => 'Students presenting working models of solar technology and environmental systems.',
                        'help' => 'Description.'
                    ],
                    // Photo 2
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img2',
                        'label' => 'Photo 2 (Annual Prize Distribution)',
                        'default' => 'assets/images/sunrise school image/award_ceremony.webp',
                        'alt' => 'Annual Prize Distribution',
                        'help' => 'Photo 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title2',
                        'label' => 'Photo 2 Title',
                        'type' => 'text',
                        'default' => 'Annual Prize Distribution',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc2',
                        'label' => 'Photo 2 Description',
                        'type' => 'text',
                        'default' => 'Honoring academic and extracurricular achievers on stage with trophies.',
                        'help' => 'Description.'
                    ],
                    // Photo 3
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img3',
                        'label' => 'Photo 3 (Sports Activities)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Outdoor Ground Activities',
                        'help' => 'Photo 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title3',
                        'label' => 'Photo 3 Title',
                        'type' => 'text',
                        'default' => 'Outdoor Ground Activities',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc3',
                        'label' => 'Photo 3 Description',
                        'type' => 'text',
                        'default' => 'Students actively participating in outdoor sports, track drills, and team games.',
                        'help' => 'Description.'
                    ],
                    // Photo 4
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img4',
                        'label' => 'Photo 4 (Yoga Day)',
                        'default' => 'assets/images/sunrise school image/yoga.webp',
                        'alt' => 'International Yoga Day',
                        'help' => 'Photo 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title4',
                        'label' => 'Photo 4 Title',
                        'type' => 'text',
                        'default' => 'International Yoga Day',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc4',
                        'label' => 'Photo 4 Description',
                        'type' => 'text',
                        'default' => 'Mass yoga demonstration cultivating discipline, physical stamina, and peace of mind.',
                        'help' => 'Description.'
                    ],
                    // Photo 5
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img5',
                        'label' => 'Photo 5 (Board Exam Toppers)',
                        'default' => 'assets/images/sunrise school image/toppers.webp',
                        'alt' => 'HBSE Board Exam Toppers',
                        'help' => 'Photo 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title5',
                        'label' => 'Photo 5 Title',
                        'type' => 'text',
                        'default' => 'HBSE Board Exam Toppers',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc5',
                        'label' => 'Photo 5 Description',
                        'type' => 'text',
                        'default' => 'Celebrating our star achievers securing top percentiles in Class 10 & 12 exams.',
                        'help' => 'Description.'
                    ],
                    // Photo 6
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img6',
                        'label' => 'Photo 6 (Shining Stars)',
                        'default' => 'assets/images/sunrise school image/shinning_stars.webp',
                        'alt' => 'Shining Stars of Sun Rise',
                        'help' => 'Photo 6.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title6',
                        'label' => 'Photo 6 Title',
                        'type' => 'text',
                        'default' => 'Shining Stars of Sun Rise',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc6',
                        'label' => 'Photo 6 Description',
                        'type' => 'text',
                        'default' => 'Outstanding scholarship winners and position holders across all school grades.',
                        'help' => 'Description.'
                    ],
                    // Photo 7
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img7',
                        'label' => 'Photo 7 (Campus Building)',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Main Campus Facade',
                        'help' => 'Photo 7.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title7',
                        'label' => 'Photo 7 Title',
                        'type' => 'text',
                        'default' => 'Main Campus Facade',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc7',
                        'label' => 'Photo 7 Description',
                        'type' => 'text',
                        'default' => 'Modern school building architecture located in Dobhi, Hisar.',
                        'help' => 'Description.'
                    ],
                    // Photo 8
                    [
                        'kind' => 'image',
                        'key' => 'gallery_img8',
                        'label' => 'Photo 8 (Smart Classrooms)',
                        'default' => 'assets/images/sunrise school image/children_sitting.webp',
                        'alt' => 'Interactive Smart Classes',
                        'help' => 'Photo 8.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title8',
                        'label' => 'Photo 8 Title',
                        'type' => 'text',
                        'default' => 'Interactive Smart Classes',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_desc8',
                        'label' => 'Photo 8 Description',
                        'type' => 'text',
                        'default' => 'Students engaged in dynamic discussion and visual conceptual learning.',
                        'help' => 'Description.'
                    ]
                ]
            ]
        ]
    ],
    'contact' => [
        'title' => 'Contact Us',
        'icon'  => 'contact_support',
        'desc'  => 'Hero Banner, Inquiry Desk Intro, Office Hours, Campus Photo Card & Academic Wings',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Header',
                'icon'  => 'flag',
                'desc'  => 'Top banner image, eyebrow, page title, and subtitle.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Contact Page Banner Image',
                        'default' => 'assets/images/sunrise school image/school3.webp',
                        'alt' => 'Connect with Sun Rise School',
                        'help' => 'Top background image on contact-us.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Get in Touch',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Contact Page Title',
                        'type' => 'text',
                        'default' => 'Connect with Sun Rise School',
                        'help' => 'Headline at top of contact-us.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Contact Subtitle',
                        'type' => 'text',
                        'default' => 'We welcome parents, prospective students, and guardians to visit our campus or get in touch for admissions, bus routes, and general inquiries.',
                        'help' => 'Intro text for contact page.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Inquiry Desk Intro',
                'icon'  => 'mail',
                'desc'  => 'Heading and subtitle above the contact form.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'form_eyebrow',
                        'label' => 'Form Eyebrow',
                        'type' => 'text',
                        'default' => 'Inquiry Desk',
                        'help' => 'Tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_heading',
                        'label' => 'Form Heading',
                        'type' => 'text',
                        'default' => 'Send Us a Message',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_desc',
                        'label' => 'Form Description',
                        'type' => 'text',
                        'default' => 'Fill out the quick form below and our administrative team will respond to your queries promptly.',
                        'help' => 'Description.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Office Hours & Campus Photo Card',
                'icon'  => 'schedule',
                'desc'  => 'Visiting hours and campus card on the right sidebar.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'office_hours',
                        'label' => 'Office Hours Summary',
                        'type' => 'text',
                        'default' => 'Monday to Saturday: 8:00 AM – 2:30 PM',
                        'help' => 'Visiting hours.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'office_days',
                        'label' => 'Weekly Schedule Detail',
                        'type' => 'text',
                        'default' => 'Monday – Saturday: 8:00 AM – 2:30 PM (Sunday Closed)',
                        'help' => 'Detailed schedule.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'campus_photo',
                        'label' => 'Sidebar Campus View Photo',
                        'default' => 'assets/images/sunrise school image/school2.webp',
                        'alt' => 'Sun Rise Campus View, Dobhi',
                        'help' => 'Right sidebar photo card.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Academic Wings Summary',
                'icon'  => 'school',
                'desc'  => 'Summary cards for Primary/Middle wing and Secondary/Senior Secondary wing.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'wing1_title',
                        'label' => 'Wing 1 Title',
                        'type' => 'text',
                        'default' => 'Primary & Middle Wing',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wing1_desc',
                        'label' => 'Wing 1 Description',
                        'type' => 'text',
                        'default' => 'Nursery to Class 8 – Holistic foundation and activity-based learning',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wing2_title',
                        'label' => 'Wing 2 Title',
                        'type' => 'text',
                        'default' => 'Secondary & Senior Secondary Wing',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wing2_desc',
                        'label' => 'Wing 2 Description',
                        'type' => 'text',
                        'default' => 'Class 9 to 12 – HBSE Board, Science (Medical/Non-Med), Commerce & Arts',
                        'help' => 'Description.'
                    ]
                ]
            ]
        ]
    ],
    'general' => [
        'title' => 'General Settings',
        'icon'  => 'settings',
        'desc'  => 'School Branding, Logo, Global Phone, Email, Address, and Taglines',
        'sections' => [
            [
                'title' => 'Section 1: Identity & Official Crest',
                'icon'  => 'shield',
                'desc'  => 'Official School Name, Logo, and Affiliation Motto.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'site_logo',
                        'label' => 'Official School Logo / Crest',
                        'default' => 'assets/images/logo.svg',
                        'alt' => 'Sun Rise Sr. Sec. School Crest',
                        'help' => 'Displayed across headers, navigation, and badges.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_name',
                        'label' => 'Official School Name',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Displayed across headers, footers, and page titles.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_tagline',
                        'label' => 'School Tagline / Affiliation Motto',
                        'type' => 'text',
                        'default' => 'Nurturing Knowledge, Character & Academic Excellence | Affiliated to HBSE',
                        'help' => 'Header tagline and SEO description default.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Communication Channels & Helplines',
                'icon'  => 'contact_phone',
                'desc'  => 'Phone number, official email, admissions inbox.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'site_phone',
                        'label' => 'Primary Contact Phone',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Click-to-call phone number in header and footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_phone_alt',
                        'label' => 'Secondary Contact Phone',
                        'type' => 'text',
                        'default' => '+91 79883 5710',
                        'help' => 'Secondary phone number in header and footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_email',
                        'label' => 'Official Inquiries Email',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsecschool.com',
                        'help' => 'Main school inbox.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_info_email',
                        'label' => 'Admissions Desk Email',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsecschool.com',
                        'help' => 'Admissions inquiries inbox.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Physical Campus Location',
                'icon'  => 'pin_drop',
                'desc'  => 'Physical postal address shown in footer and contact sections.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'site_address',
                        'label' => 'Physical Campus Address',
                        'type' => 'text',
                        'default' => 'Main Road Dobhi, Near Primary Health Center, Dobhi, Hisar (Haryana) - 125001',
                        'help' => 'Full postal address.'
                    ]
                ]
            ]
        ]
    ]
];

// Ensure valid tab selected
if (!array_key_exists($active_tab, $pages_config)) {
    $active_tab = 'home';
}
$current_page_data = $pages_config[$active_tab];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Superuser CMS Dashboard | <?= htmlspecialchars($current_page_data['title']) ?></title>
    
    <!-- Google Fonts & Material Symbols Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#001129',
                        gold: '#C9A24B',
                        'gold-hover': '#B38C37',
                        'gold-light': '#F9F4E8',
                        'surface-cream': '#F3EFEA'
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        serif: ['"Poppins"', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Quill Rich Text Editor CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <style>
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #E5E7EB;
            background-color: #F9FAFB;
        }
        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #E5E7EB;
            font-family: inherit;
            font-size: 0.95rem;
            min-height: 140px;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col selection:bg-[#C9A24B] selection:text-[#001129]">

    <!-- Top Navigation Header -->
    <header class="bg-[#001129] text-white border-b border-[#071f45] sticky top-0 z-40 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-[#C9A24B] ring-2 ring-[#C9A24B]/30">
                    <span class="material-symbols-outlined text-2xl">admin_panel_settings</span>
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-bold tracking-tight text-white flex items-center gap-2">
                        Sun Rise School CMS
                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-[#C9A24B] text-[#001129]">Superuser</span>
                    </h1>
                    <p class="text-xs text-gray-400 hidden sm:block">Dobhi Campus Content &amp; Image Management</p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="../index.php" target="_blank" class="text-xs sm:text-sm text-gray-300 hover:text-white px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 flex items-center gap-1.5 transition">
                    <span class="material-symbols-outlined text-base text-[#C9A24B]">open_in_new</span>
                    <span class="hidden md:inline">View Live Website</span>
                </a>
                
                <div class="h-6 w-px bg-white/10 hidden sm:block"></div>

                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-300 hidden lg:inline-block">
                        Signed in as <strong class="text-[#C9A24B]"><?= htmlspecialchars($user['username']) ?></strong>
                    </span>
                    <a href="logout.php" class="text-xs sm:text-sm bg-red-600/90 hover:bg-red-600 text-white font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 transition shadow">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1">

        <!-- Flash Status Alerts -->
        <?php if (!empty($success_msg)): ?>
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm" id="flash-banner">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-emerald-600 text-2xl flex-shrink-0">check_circle</span>
                    <span class="font-medium"><?= htmlspecialchars($success_msg) ?></span>
                </div>
                <button onclick="document.getElementById('flash-banner').remove()" class="text-emerald-500 hover:text-emerald-800">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm flex items-center justify-between shadow-sm" id="flash-banner-err">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-red-600 text-2xl flex-shrink-0">error</span>
                    <span class="font-medium"><?= htmlspecialchars($error_msg) ?></span>
                </div>
                <button onclick="document.getElementById('flash-banner-err').remove()" class="text-red-500 hover:text-red-800">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Sidebar Navigation -->
            <aside class="lg:col-span-3">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-3 sticky top-24">
                    <div class="px-3 py-2 text-xs font-bold uppercase tracking-wider text-gray-400">
                        Editable Pages (Top to Bottom)
                    </div>
                    <nav class="space-y-1 mt-1">
                        <?php foreach ($pages_config as $tab_key => $tab_data): 
                            $is_current = ($tab_key === $active_tab);
                        ?>
                            <a 
                                href="?tab=<?= urlencode($tab_key) ?>" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all <?= $is_current ? 'bg-[#001129] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>"
                            >
                                <span class="material-symbols-outlined text-xl <?= $is_current ? 'text-[#C9A24B]' : 'text-gray-400' ?>">
                                    <?= htmlspecialchars($tab_data['icon']) ?>
                                </span>
                                <span class="flex-1"><?= htmlspecialchars($tab_data['title']) ?></span>
                                <?php if ($is_current): ?>
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#C9A24B]"></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>

                    <div class="mt-6 pt-4 border-t border-gray-100 px-3 text-xs text-gray-500 flex flex-col gap-1.5">
                        <span class="font-semibold text-gray-700">Section-Wise Guide:</span>
                        <span>&bull; Sections are ordered exactly as they appear on the live site from top to bottom.</span>
                        <span>&bull; Edit text or upload images directly inside each section.</span>
                        <span>&bull; Changes update on the website immediately!</span>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area: Section by Section Top to Bottom -->
            <main class="lg:col-span-9 space-y-8">

                <!-- Page Header Banner -->
                <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#8c6b1e] bg-[#C9A24B]/10 px-2.5 py-1 rounded-md mb-1.5">
                            <span class="material-symbols-outlined text-sm">dashboard_customize</span>
                            Active Page: <?= htmlspecialchars($current_page_data['title']) ?>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($current_page_data['title']) ?></h2>
                        <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($current_page_data['desc']) ?></p>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <?php 
                        $tab_to_url = [
                            'home'       => 'index.php',
                            'about'      => 'about-us.php',
                            'academics'  => 'academics.php',
                            'admissions' => 'admission.php',
                            'campus'     => 'campus.php',
                            'events'     => 'events.php',
                            'faculty'    => 'faculty.php',
                            'gallery'    => 'gallery.php',
                            'contact'    => 'contact-us.php',
                            'general'    => 'index.php'
                        ];
                        $target_url = '../' . ($tab_to_url[$active_tab] ?? 'index.php');
                        ?>
                        <a href="<?= htmlspecialchars($target_url) ?>" target="_blank" class="text-xs px-3 py-1.5 bg-[#C9A24B]/15 hover:bg-[#C9A24B]/25 text-[#8c6b1e] hover:text-[#705414] font-semibold rounded-lg flex items-center gap-1.5 transition border border-[#C9A24B]/30 shadow-sm">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            <span>View Live <?= htmlspecialchars($current_page_data['title']) ?></span>
                        </a>
                        <span class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg font-mono">
                            page_key: <strong><?= htmlspecialchars($active_tab) ?></strong>
                        </span>
                    </div>
                </div>

                <!-- Loop Through Each Visual Section From Top to Bottom -->
                <?php 
                $quill_editors = [];
                $field_counter = 0;
                foreach ($current_page_data['sections'] as $sec_idx => $sec): 
                ?>
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden" id="sec_<?= $sec_idx ?>">
                        
                        <!-- Section Header -->
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#001129] text-[#C9A24B] flex items-center justify-center font-bold text-sm shadow-sm">
                                    <span class="material-symbols-outlined text-lg"><?= htmlspecialchars($sec['icon']) ?></span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                                        <?= htmlspecialchars($sec['title']) ?>
                                    </h3>
                                    <?php if (!empty($sec['desc'])): ?>
                                        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($sec['desc']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                <?= count($sec['fields']) ?> item(s)
                            </span>
                        </div>

                        <!-- Section Fields (Both Images & Text Blocks Together!) -->
                        <div class="p-6 space-y-6 divide-y divide-gray-100">
                            <?php foreach ($sec['fields'] as $f_idx => $field): 
                                $field_counter++;
                                $kind = $field['kind'] ?? 'text';
                            ?>
                                <div class="<?= $f_idx > 0 ? 'pt-6' : '' ?>">
                                    <?php if ($kind === 'image'): 
                                        $current_img_src = get_image($active_tab, $field['key'], $field['default']);
                                        $current_img_alt = get_image_alt($active_tab, $field['key'], $field['alt']);
                                        $preview_url = get_admin_img_preview($current_img_src);
                                        $img_preview_id = "img_preview_" . $field_counter;
                                    ?>
                                        <!-- Image Uploader Field (With Push-Safe Cloud Persistence & Asset Picker) -->
                                        <form method="POST" action="upload_image.php" enctype="multipart/form-data" class="space-y-4 ajax-image-form" data-preview-id="<?= $img_preview_id ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="page_key" value="<?= htmlspecialchars($active_tab) ?>">
                                            <input type="hidden" name="image_key" value="<?= htmlspecialchars($field['key']) ?>">
                                            <input type="hidden" name="ajax" value="1">

                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                <div>
                                                    <label class="font-bold text-gray-800 text-sm flex items-center gap-2">
                                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">photo</span>
                                                        <?= htmlspecialchars($field['label']) ?>
                                                        <span class="font-mono font-normal text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded">
                                                            <?= htmlspecialchars($field['key']) ?>
                                                        </span>
                                                    </label>
                                                    <?php if (!empty($field['help'])): ?>
                                                        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($field['help']) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="text-[11px] font-semibold uppercase tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                                    Image Slot
                                                </span>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                                                
                                                <!-- Current Thumbnail & Live Preview Area -->
                                                <div class="md:col-span-4">
                                                    <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm aspect-video flex items-center justify-center">
                                                        <img 
                                                            id="<?= $img_preview_id ?>" 
                                                            src="<?= htmlspecialchars($preview_url) ?>" 
                                                            alt="<?= htmlspecialchars($current_img_alt) ?>"
                                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                                            onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                                                        />
                                                        <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/75 text-white text-[10px] font-medium backdrop-blur-sm flex items-center gap-1">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                            Current Image
                                                        </div>
                                                    </div>
                                                    <p class="text-[11px] text-gray-400 font-mono truncate mt-1.5" title="<?= htmlspecialchars(rawurldecode($current_img_src)) ?>">
                                                        Path: <?= htmlspecialchars(rawurldecode($current_img_src)) ?>
                                                    </p>
                                                </div>

                                                <!-- Replacement Controls -->
                                                <div class="md:col-span-8 space-y-3">
                                                    <!-- Option A: Direct File Upload with DB Backup -->
                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1 flex items-center justify-between">
                                                            <span>Upload New Photo (Auto-saved to Cloud DB for Git-Push Safety &bull; Max 2MB)</span>
                                                            <span class="text-[10px] text-emerald-700 bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded font-bold">Push Safe</span>
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            name="image_file" 
                                                            accept="image/jpeg,image/png,image/webp"
                                                            onchange="previewImage(this, '<?= $img_preview_id ?>')"
                                                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-gray-50/50"
                                                        />
                                                    </div>

                                                    <!-- Option B: Select Existing School Photo or Custom URL -->
                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Or Choose Existing School Photo / Enter Custom Image URL:
                                                        </label>
                                                        <div class="flex flex-col sm:flex-row gap-2">
                                                            <select 
                                                                onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('<?= $img_preview_id ?>'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                                                class="sm:w-1/2 px-3 py-2 bg-gray-50 border border-gray-300 rounded-xl text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                            >
                                                                <option value="">-- Choose Existing School Photo --</option>
                                                                <?php foreach ($available_school_images as $img_file): ?>
                                                                    <option value="<?= htmlspecialchars($img_file) ?>" <?= (strpos($current_img_src, $img_file) !== false) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($img_file) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input 
                                                                type="text" 
                                                                name="custom_path" 
                                                                placeholder="assets/images/... or https://..."
                                                                value="<?= (strpos($current_img_src, 'uploads/') === false) ? htmlspecialchars(rawurldecode($current_img_src)) : '' ?>"
                                                                onchange="if(this.value){ const prv = document.getElementById('<?= $img_preview_id ?>'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                                                class="flex-1 px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Image Alt Description (for accessibility &amp; SEO)
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="alt_text" 
                                                            value="<?= htmlspecialchars($current_img_alt) ?>"
                                                            placeholder="Briefly describe this photo"
                                                            class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                                                        />
                                                    </div>

                                                    <div class="flex items-center justify-end pt-1">
                                                        <button 
                                                            type="submit" 
                                                            class="submit-btn px-4 py-2 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-lg shadow-sm hover:shadow transition flex items-center gap-1.5"
                                                        >
                                                            <span class="btn-icon material-symbols-outlined text-base">cloud_upload</span>
                                                            <span class="btn-text">Save / Replace Image</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    <?php else: 
                                        $curr_val = get_text($active_tab, $field['key'], $field['default']);
                                        $is_html  = (($field['type'] ?? 'text') === 'html');
                                        $form_id  = "form_text_" . $field_counter;
                                        $quill_id = "quill_" . $field_counter;
                                        $txt_id   = "textarea_" . $field_counter;
                                        if ($is_html) {
                                            $quill_editors[] = [
                                                'quill_id' => $quill_id,
                                                'form_id'  => $form_id,
                                                'txt_id'   => $txt_id
                                            ];
                                        }
                                    ?>
                                        <!-- Text / HTML Content Field -->
                                        <form id="<?= $form_id ?>" method="POST" action="save_content.php" class="space-y-3 ajax-text-form">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="page_key" value="<?= htmlspecialchars($active_tab) ?>">
                                            <input type="hidden" name="section_key" value="<?= htmlspecialchars($field['key']) ?>">
                                            <input type="hidden" name="content_type" value="<?= htmlspecialchars($field['type'] ?? 'text') ?>">
                                            <input type="hidden" name="ajax" value="1">

                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                <div>
                                                    <label class="font-bold text-gray-800 text-sm flex items-center gap-2">
                                                        <span class="material-symbols-outlined text-gray-400 text-base">edit_note</span>
                                                        <?= htmlspecialchars($field['label']) ?>
                                                        <span class="font-mono font-normal text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded">
                                                            <?= htmlspecialchars($field['key']) ?>
                                                        </span>
                                                    </label>
                                                    <?php if (!empty($field['help'])): ?>
                                                        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($field['help']) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="text-[11px] font-semibold uppercase tracking-wider text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                                                    <?= $is_html ? 'Rich Text (HTML)' : 'Plain Text' ?>
                                                </span>
                                            </div>

                                            <?php if ($is_html): ?>
                                                <!-- Quill Rich Text Editor -->
                                                <div class="mt-2">
                                                    <div id="<?= $quill_id ?>" class="bg-white"><?= $curr_val ?></div>
                                                    <textarea name="content_value" id="<?= $txt_id ?>" class="hidden"></textarea>
                                                </div>
                                            <?php else: ?>
                                                <!-- Standard Multi-line Text Area -->
                                                <textarea 
                                                    name="content_value" 
                                                    rows="<?= (strlen($curr_val) > 120) ? '3' : '2' ?>" 
                                                    class="w-full p-3 bg-gray-50/50 border border-gray-300 rounded-xl text-gray-800 text-sm focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] focus:bg-white outline-none transition resize-y"
                                                ><?= htmlspecialchars($curr_val) ?></textarea>
                                            <?php endif; ?>

                                            <div class="flex items-center justify-between pt-1">
                                                <span class="text-xs text-gray-400"></span>
                                                <button 
                                                    type="submit" 
                                                    class="submit-btn px-4 py-2 bg-[#001129] hover:bg-[#071f45] text-white text-xs font-bold rounded-lg shadow-sm hover:shadow transition flex items-center gap-1.5"
                                                >
                                                    <span class="btn-icon material-symbols-outlined text-base text-[#C9A24B]">save</span>
                                                    <span class="btn-text">Save Field</span>
                                                </button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </main>
        </div>
    </div>

    <!-- Floating Toast Notification Container -->
    <div id="adminToastContainer" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 max-w-md w-full pointer-events-none px-4" aria-live="polite"></div>

    <!-- Interactive Scripts: Live Image Preview, Quill, Seamless AJAX & Scroll Restoration -->
    <script>
        // Floating Toast Notification Helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('adminToastContainer');
            if (!container) return;
            
            const toast = document.createElement('div');
            const isSuccess = (type === 'success');
            toast.className = `pointer-events-auto flex items-center gap-3 p-4 rounded-xl shadow-2xl text-xs sm:text-sm font-medium transition-all duration-300 transform translate-y-4 opacity-0 ${
                isSuccess ? 'bg-[#001129] border border-[#C9A24B]/70 text-white shadow-[#C9A24B]/10' : 'bg-red-950 border border-red-500 text-white'
            }`;
            
            const icon = isSuccess ? 'check_circle' : 'error';
            const iconColor = isSuccess ? 'text-[#C9A24B]' : 'text-red-400';
            
            toast.innerHTML = `
                <span class="material-symbols-outlined ${iconColor} text-xl flex-shrink-0">${icon}</span>
                <div class="flex-1 leading-snug">${message}</div>
                <button type="button" class="text-white/60 hover:text-white transition ml-2" onclick="this.parentElement.remove()">
                    <span class="material-symbols-outlined text-base">close</span>
                </button>
            `;
            
            container.appendChild(toast);
            
            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
            });
            
            // Auto remove after 3.5s
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 350);
            }, 3500);
        }

        // Live image preview reader
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (file.size > 2 * 1024 * 1024) {
                    showToast("Selected file is larger than 2MB. Please choose a smaller image.", "error");
                    input.value = "";
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(previewId);
                    if (img) {
                        img.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Global map of Quill editor instances
        window.quillMap = {};

        // Initialize all active Quill Rich Text Editors
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Instant Scroll Restoration (Prevents jumping to top under all conditions)
            const savedScrollY = sessionStorage.getItem('admin_scroll_y');
            if (savedScrollY !== null) {
                window.scrollTo({ top: parseInt(savedScrollY, 10), behavior: 'instant' });
                setTimeout(() => sessionStorage.removeItem('admin_scroll_y'), 1200);
            }

            // 2. Initialize Quill Editors
            <?php foreach ($quill_editors as $qe): ?>
                (function() {
                    const quill = new Quill('#<?= $qe['quill_id'] ?>', {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{ 'header': [1, 2, 3, false] }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'color': [] }, { 'background': [] }],
                                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                ['link', 'clean']
                            ]
                        }
                    });

                    window.quillMap['<?= $qe['form_id'] ?>'] = {
                        quill: quill,
                        txt_id: '<?= $qe['txt_id'] ?>'
                    };

                    const form = document.getElementById('<?= $qe['form_id'] ?>');
                    const textarea = document.getElementById('<?= $qe['txt_id'] ?>');

                    if (form && textarea) {
                        form.addEventListener('submit', () => {
                            textarea.value = quill.root.innerHTML;
                        });
                    }
                })();
            <?php endforeach; ?>

            // 3. AJAX Submission for Text & HTML Forms (Zero Page Reload, No Scroll Jump!)
            document.querySelectorAll('.ajax-text-form').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    // Sync Quill instance if present
                    const qEntry = window.quillMap[form.id];
                    if (qEntry && qEntry.quill) {
                        const txtEl = document.getElementById(qEntry.txt_id);
                        if (txtEl) txtEl.value = qEntry.quill.root.innerHTML;
                    }

                    const btn = form.querySelector('.submit-btn');
                    const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
                    const btnText = btn ? btn.querySelector('.btn-text') : null;
                    const origText = btnText ? btnText.textContent : 'Save Field';
                    const origIcon = btnIcon ? btnIcon.textContent : 'save';

                    // Save current scroll position
                    sessionStorage.setItem('admin_scroll_y', window.scrollY);

                    if (btn) btn.disabled = true;
                    if (btnText) btnText.textContent = 'Saving...';
                    if (btnIcon) {
                        btnIcon.textContent = 'progress_activity';
                        btnIcon.classList.add('animate-spin');
                    }

                    try {
                        const formData = new FormData(form);
                        const response = await fetch('save_content.php', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            showToast(result.message || 'Field saved successfully!', 'success');
                            if (btn) {
                                btn.classList.remove('bg-[#001129]', 'hover:bg-[#071f45]');
                                btn.classList.add('!bg-emerald-700');
                            }
                            if (btnIcon) {
                                btnIcon.classList.remove('animate-spin');
                                btnIcon.textContent = 'check';
                            }
                            if (btnText) btnText.textContent = 'Saved!';

                            setTimeout(() => {
                                if (btn) {
                                    btn.disabled = false;
                                    btn.classList.remove('!bg-emerald-700');
                                    btn.classList.add('bg-[#001129]', 'hover:bg-[#071f45]');
                                }
                                if (btnIcon) btnIcon.textContent = origIcon;
                                if (btnText) btnText.textContent = origText;
                            }, 2200);
                        } else {
                            showToast(result.message || 'Error saving field.', 'error');
                            if (btn) btn.disabled = false;
                            if (btnIcon) {
                                btnIcon.classList.remove('animate-spin');
                                btnIcon.textContent = origIcon;
                            }
                            if (btnText) btnText.textContent = origText;
                        }
                    } catch (err) {
                        showToast('Network error while saving. Please try again.', 'error');
                        if (btn) btn.disabled = false;
                        if (btnIcon) {
                            btnIcon.classList.remove('animate-spin');
                            btnIcon.textContent = origIcon;
                        }
                        if (btnText) btnText.textContent = origText;
                    }
                });
            });

            // 4. AJAX Submission for Image Forms (Zero Page Reload, Updates Preview Instantly)
            document.querySelectorAll('.ajax-image-form').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const btn = form.querySelector('.submit-btn');
                    const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
                    const btnText = btn ? btn.querySelector('.btn-text') : null;
                    const origText = btnText ? btnText.textContent : 'Save / Replace Image';
                    const origIcon = btnIcon ? btnIcon.textContent : 'cloud_upload';
                    const previewId = form.getAttribute('data-preview-id');

                    // Save current scroll position
                    sessionStorage.setItem('admin_scroll_y', window.scrollY);

                    if (btn) btn.disabled = true;
                    if (btnText) btnText.textContent = 'Saving...';
                    if (btnIcon) {
                        btnIcon.textContent = 'progress_activity';
                        btnIcon.classList.add('animate-spin');
                    }

                    try {
                        const formData = new FormData(form);
                        const response = await fetch('upload_image.php', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            showToast(result.message || 'Image updated successfully!', 'success');

                            // Instant live preview update
                            if (result.preview_url && previewId) {
                                const previewImg = document.getElementById(previewId);
                                if (previewImg) {
                                    previewImg.src = result.preview_url;
                                }
                            }

                            // Clear file input
                            const fileInput = form.querySelector('input[type="file"]');
                            if (fileInput) fileInput.value = '';

                            if (btn) {
                                btn.classList.remove('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                                btn.classList.add('!bg-emerald-700', '!text-white');
                            }
                            if (btnIcon) {
                                btnIcon.classList.remove('animate-spin');
                                btnIcon.textContent = 'check';
                            }
                            if (btnText) btnText.textContent = 'Saved!';

                            setTimeout(() => {
                                if (btn) {
                                    btn.disabled = false;
                                    btn.classList.remove('!bg-emerald-700', '!text-white');
                                    btn.classList.add('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                                }
                                if (btnIcon) btnIcon.textContent = origIcon;
                                if (btnText) btnText.textContent = origText;
                            }, 2200);
                        } else {
                            showToast(result.message || 'Error updating image.', 'error');
                            if (btn) btn.disabled = false;
                            if (btnIcon) {
                                btnIcon.classList.remove('animate-spin');
                                btnIcon.textContent = origIcon;
                            }
                            if (btnText) btnText.textContent = origText;
                        }
                    } catch (err) {
                        showToast('Network error while updating image. Please try again.', 'error');
                        if (btn) btn.disabled = false;
                        if (btnIcon) {
                            btnIcon.classList.remove('animate-spin');
                            btnIcon.textContent = origIcon;
                        }
                        if (btnText) btnText.textContent = origText;
                    }
                });
            });
        });
    </script>
</body>
</html>
