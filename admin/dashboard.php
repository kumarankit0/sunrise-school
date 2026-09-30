<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/content_helper.php';

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
        'desc'  => 'Complete Home Page Control: 6 Hero Slider Photos, Ticker Strip, Legacy Stats, Live Events Tracker, 3 Pillars, Director Message, Events & News (3 Cards), 12 Glimpses Photos, Affiliations & CTA',
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
                        'default' => 'assets/images/sunrise school image/director.png',
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
                        'default' => '"Education is not merely the acquisition of knowledge; it is the cultivation of character, values, confidence, and the ability to contribute meaningfully to society."',
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
            // Section 5: School Events & News (3 Cards)
            [
                'title' => 'Section 5: School Events & News (3 Cards)',
                'icon'  => 'event_note',
                'desc'  => 'Three event cards displayed on homepage with tags, badges, titles, descriptions, and venue locations.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'events_eyebrow',
                        'label' => 'Events Eyebrow',
                        'type' => 'text',
                        'default' => 'LATEST EVENTS AND NEWS',
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
                        'default' => 'CELEBRATION',
                        'help' => 'Category label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_badge',
                        'label' => 'Event 3: Badge',
                        'type' => 'text',
                        'default' => 'NATIONAL',
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
                        'default' => 'Assembly Ground',
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
            // Section 6: Campus Glimpses Showcase (Dual-Row 12 Photos)
            [
                'title' => 'Section 6: Campus Glimpses Dual-Row Showcase (12 Photos)',
                'icon'  => 'photo_library',
                'desc'  => 'Upload and manage all 12 photos with titles and captions across Row 1 (moving left) and Row 2 (moving right) for the infinite sliding gallery strip.',
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
                        'label' => 'Row 1 - Photo 1 Title',
                        'type' => 'text',
                        'default' => 'Main Campus Building',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse1_caption',
                        'label' => 'Row 1 - Photo 1 Caption',
                        'type' => 'text',
                        'default' => 'Illuminated view of Sun Rise School architecture.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 1 - Photo 2 Title',
                        'type' => 'text',
                        'default' => 'Interactive Classrooms',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse2_caption',
                        'label' => 'Row 1 - Photo 2 Caption',
                        'type' => 'text',
                        'default' => 'Engaged students in an active learning environment.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 1 - Photo 3 Title',
                        'type' => 'text',
                        'default' => 'Dedicated Teaching Faculty',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse3_caption',
                        'label' => 'Row 1 - Photo 3 Caption',
                        'type' => 'text',
                        'default' => 'Experienced mentors guiding students every step.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 1 - Photo 4 Title',
                        'type' => 'text',
                        'default' => 'Science & Innovation Fair',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse7_caption',
                        'label' => 'Row 1 - Photo 4 Caption',
                        'type' => 'text',
                        'default' => 'Working scientific models and robotics experiments.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 1 - Photo 5 Title',
                        'type' => 'text',
                        'default' => 'Annual Awards Felicitation',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse8_caption',
                        'label' => 'Row 1 - Photo 5 Caption',
                        'type' => 'text',
                        'default' => 'Merit distinctions and trophy presentations.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 1 - Photo 6 Title',
                        'type' => 'text',
                        'default' => 'Morning Assembly & Prayer',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse9_caption',
                        'label' => 'Row 1 - Photo 6 Caption',
                        'type' => 'text',
                        'default' => 'Starting the day with moral values and discipline.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 7 Title',
                        'type' => 'text',
                        'default' => 'Student Community',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse4_caption',
                        'label' => 'Row 2 - Photo 7 Caption',
                        'type' => 'text',
                        'default' => 'A vibrant and cheerful environment for every learner.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 8 Title',
                        'type' => 'text',
                        'default' => 'Yoga & Holistic Health',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse5_caption',
                        'label' => 'Row 2 - Photo 8 Caption',
                        'type' => 'text',
                        'default' => 'Physical wellness, meditation, and self-discipline.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 9 Title',
                        'type' => 'text',
                        'default' => 'Science Projects',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse6_caption',
                        'label' => 'Row 2 - Photo 9 Caption',
                        'type' => 'text',
                        'default' => 'Inspiring young scientists with practical exhibitions.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 10 Title',
                        'type' => 'text',
                        'default' => 'Athletics & Sports Ground',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse10_caption',
                        'label' => 'Row 2 - Photo 10 Caption',
                        'type' => 'text',
                        'default' => 'Playgrounds for track, volleyball, football, and fitness.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 11 Title',
                        'type' => 'text',
                        'default' => 'Experiential Learning',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse11_caption',
                        'label' => 'Row 2 - Photo 11 Caption',
                        'type' => 'text',
                        'default' => 'Hands-on practical exploration in sciences.',
                        'help' => 'Photo description/caption.'
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
                        'label' => 'Row 2 - Photo 12 Title',
                        'type' => 'text',
                        'default' => 'Student-Faculty Mentorship',
                        'help' => 'Hover title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse12_caption',
                        'label' => 'Row 2 - Photo 12 Caption',
                        'type' => 'text',
                        'default' => 'Personalized guidance and caring educator support.',
                        'help' => 'Photo description/caption.'
                    ]
                ]
            ],
            // Section 7: Affiliations & Recognized By Strip
            [
                'title' => 'Section 7: Affiliations & Accreditations Strip',
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
            // Section 8: Final Admissions CTA Banner
            [
                'title' => 'Section 8: Final Admissions Call to Action (CTA)',
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
                        'key' => 'founder_card_img',
                        'label' => 'Founder Portrait Photo',
                        'default' => 'assets/images/clean_director.png',
                        'alt' => 'Mr. Bhader Singh Swami - Founder & Director',
                        'help' => 'Upload portrait photo of founder Mr. Bhader Singh Swami.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_badge',
                        'label' => 'Founder Role Badge (Overlay)',
                        'type' => 'text',
                        'default' => 'Founder & Director',
                        'help' => 'Gold badge overlaid on the bottom of the photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_subbadge',
                        'label' => 'Founder Sub-Badge',
                        'type' => 'text',
                        'default' => 'Institutional Founder',
                        'help' => 'Small uppercase tag below photo.'
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
                        'key' => 'founder_org',
                        'label' => 'Founder Organization Subtitle',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Organization label below name.'
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
                        'key' => 'founder_eyebrow',
                        'label' => 'Founder Story Eyebrow',
                        'type' => 'text',
                        'default' => "FOUNDER'S JOURNEY",
                        'help' => 'Small uppercase tag above founder story heading.'
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
                        'default' => 'The institution was founded by <strong class="text-white">Mr. Bhader Singh Swami</strong>, whose own journey was shaped by the struggles and limitations of growing up in a lower-middle-class family. Having experienced the challenges surrounding access to quality education, he developed a deep conviction that every child, irrespective of background, deserves the opportunity to learn, grow, and aspire.',
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
                        'label' => 'Founder Story Paragraph 3 (Perseverance & Community / Read More)',
                        'type' => 'html',
                        'default' => 'The early years were marked by challenges and perseverance, but with unwavering dedication from the management, teachers, and the trust of local families, the foundation was steadily strengthened.',
                        'help' => 'Third story paragraph (appears under Read More button).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'founder_p4',
                        'label' => 'Founder Story Paragraph 4 (Additional Narrative / Read More)',
                        'type' => 'html',
                        'default' => '',
                        'help' => 'Optional fourth story paragraph (appears under Read More button).'
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
    'management' => [
        'title' => 'Management Page',
        'icon'  => 'workspace_premium',
        'desc'  => 'School Management Directorate: Hero Header with Blurred Campus Background & 3-Column Leadership Team (Principal, Founder & Director, Coordinator)',
        'sections' => [
            // Section 1: Hero Banner & Badges (Matching About Us style)
            [
                'title' => 'Section 1: Hero Banner & Main Headlines',
                'icon'  => 'flag',
                'desc'  => 'Top banner photo (same full-width style as About Us), eyebrow badge, main title, and introductory subtitle description.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Hero Banner Background Image',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'Sun Rise Sr. Sec. School Campus — Management',
                        'help' => 'High-resolution campus banner image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Status / Eyebrow Pill Badge',
                        'type' => 'text',
                        'default' => 'Administrative & Academic Leadership',
                        'help' => 'Pill badge at top of hero section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Hero Headline',
                        'type' => 'text',
                        'default' => 'School Management & Leadership',
                        'help' => 'Main headline on Management page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle Description',
                        'type' => 'textarea',
                        'default' => 'Guided by seasoned educationalists, administrators, and mentors dedicated to fostering an inspiring environment of academic rigor, character building, and comprehensive student empowerment.',
                        'help' => 'Introductory text under hero headline.'
                    ]
                ]
            ],

            // Section 2: Milestones & Stats Strip
            [
                'title' => 'Section 2: Stats Strip (4 Counters)',
                'icon'  => 'analytics',
                'desc'  => 'Floating counter bar below hero banner with 4 milestone numbers and labels.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Number',
                        'type' => 'text',
                        'default' => '36+',
                        'help' => 'e.g. 36+'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Years of Heritage',
                        'help' => 'Label under stat 1'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Number',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'e.g. 100%'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'HBSE Pass Rate',
                        'help' => 'Label under stat 2'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Number',
                        'type' => 'text',
                        'default' => '28+',
                        'help' => 'e.g. 28+'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Faculty & Mentors',
                        'help' => 'Label under stat 3'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Number',
                        'type' => 'text',
                        'default' => '700+',
                        'help' => 'e.g. 700+'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'Enrolled Scholars',
                        'help' => 'Label under stat 4'
                    ]
                ]
            ],

            // Section 3: Leadership Team (3 Columns: Principal, Director, Coordinator)
            [
                'title' => 'Section 3: Leadership Team (Principal, Founder & Director, Coordinator)',
                'icon'  => 'groups',
                'desc'  => '3-column leadership grid featuring Principal, Founder & Director, and Coordinator with top photos, designations, experience badges, and detailed profiles.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'leader_tagline',
                        'label' => 'Leadership Section Eyebrow',
                        'type' => 'text',
                        'default' => 'OUR LEADERSHIP TEAM',
                        'help' => 'Eyebrow pill tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_heading',
                        'label' => 'Leadership Main Headline',
                        'type' => 'text',
                        'default' => 'Inspiring Minds, Cultivating Character & Excellence',
                        'help' => 'Main headline on leadership card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_desc',
                        'label' => 'Leadership Section Subtext',
                        'type' => 'textarea',
                        'default' => 'Guided by seasoned visionaries dedicated to academic distinction, moral integrity, and holistic student growth.',
                        'help' => 'Introductory subtext paragraph below heading.'
                    ],
                    // Column 1: Principal
                    [
                        'kind' => 'image',
                        'key' => 'leader1_photo',
                        'label' => 'Principal Photo (Column 1)',
                        'default' => 'assets/images/sunrise school image/clean_director.png',
                        'alt' => 'Mr. Rajbir Singh - Principal',
                        'help' => 'Portrait photo of Principal.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_badge',
                        'label' => 'Principal Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Principal',
                        'help' => 'Badge overlaid on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_tag',
                        'label' => 'Principal Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Academic Administration',
                        'help' => 'Gold tag above principal name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_name',
                        'label' => 'Principal Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Rajbir Singh',
                        'help' => 'Principal name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_role',
                        'label' => 'Principal Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Principal | M.A., B.Ed.',
                        'help' => 'Principal title and degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_exp',
                        'label' => 'Principal Experience Badge',
                        'type' => 'text',
                        'default' => '16 Years in Education',
                        'help' => 'Experience badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_desc',
                        'label' => 'Principal Biography / Profile',
                        'type' => 'textarea',
                        'default' => 'Serving as the academic head, Mr. Rajbir Singh fosters a disciplined and purposeful learning environment, supporting teachers and ensuring students receive balanced opportunities for holistic development.',
                        'help' => 'Principal profile description.'
                    ],
                    // Column 2: Founder & Director
                    [
                        'kind' => 'image',
                        'key' => 'leader2_photo',
                        'label' => 'Director Photo (Column 2)',
                        'default' => 'assets/images/sunrise school image/director.png',
                        'alt' => 'Mr. Bhader Singh Swami - Founder & Director',
                        'help' => 'Portrait photo of Founder & Director.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_badge',
                        'label' => 'Director Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Founder & Director',
                        'help' => 'Badge overlaid on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_tag',
                        'label' => 'Director Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Visionary Leadership',
                        'help' => 'Gold tag above director name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_name',
                        'label' => 'Director Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Bhader Singh Swami',
                        'help' => 'Director name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_role',
                        'label' => 'Director Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Founder & Director | M.A., B.Ed.',
                        'help' => 'Director title and degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_exp',
                        'label' => 'Director Experience Badge',
                        'type' => 'text',
                        'default' => '36+ Years in Education',
                        'help' => 'Experience badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_desc',
                        'label' => 'Director Biography / Profile',
                        'type' => 'textarea',
                        'default' => 'With 36 years of teaching experience and 26 years of school management, Mr. Bhader Singh Swami has devoted his journey to education grounded in discipline, values, character, and academic excellence.',
                        'help' => 'Director profile description.'
                    ],
                    // Column 3: Coordinator
                    [
                        'kind' => 'image',
                        'key' => 'leader3_photo',
                        'label' => 'Coordinator Photo (Column 3)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Mr. Indra Dev - Coordinator',
                        'help' => 'Portrait photo of Coordinator.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_badge',
                        'label' => 'Coordinator Photo Overlay Badge',
                        'type' => 'text',
                        'default' => 'Coordinator',
                        'help' => 'Badge overlaid on photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_tag',
                        'label' => 'Coordinator Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Administration & Coordination',
                        'help' => 'Gold tag above coordinator name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_name',
                        'label' => 'Coordinator Full Name',
                        'type' => 'text',
                        'default' => 'Mr. Indra Dev',
                        'help' => 'Coordinator name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_role',
                        'label' => 'Coordinator Role & Qualifications',
                        'type' => 'text',
                        'default' => 'Coordinator | B.A., M.A., LL.B., LL.M.',
                        'help' => 'Coordinator title and degrees.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_exp',
                        'label' => 'Coordinator Experience Badge',
                        'type' => 'text',
                        'default' => '22 Years Exp • Former GM, RBI',
                        'help' => 'Experience badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_desc',
                        'label' => 'Coordinator Biography / Profile',
                        'type' => 'textarea',
                        'default' => 'Mr. Indra Dev brings 22 years of professional experience and deep administrative acumen from the Reserve Bank of India (RBI), strengthening the school’s organizational discipline and excellence.',
                        'help' => 'Coordinator profile description.'
                    ],
                    // Bottom Button
                    [
                        'kind' => 'text',
                        'key' => 'leader_btn_text',
                        'label' => 'Bottom Action Button Text',
                        'type' => 'text',
                        'default' => 'Meet Full Leadership & Faculty Team',
                        'help' => 'Button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_btn_url',
                        'label' => 'Bottom Action Button Destination URL',
                        'type' => 'text',
                        'default' => 'faculty.php',
                        'help' => 'Button target link.'
                    ]
                ]
            ]
        ]
    ],
    'academics' => [
        'title' => 'Academics Page',
        'icon'  => 'school',
        'desc'  => 'HBSE Curriculum, 5 Academic Stages, 3 Senior Streams, Teaching Methodology, Examination System & Board Toppers',
        'sections' => [
            // Section 1: Hero Banner & Header
            [
                'title' => 'Section 1: Hero Banner & Header',
                'icon'  => 'flag',
                'desc'  => 'Hero image, eyebrow badge, main title, subtitle, and call-to-action buttons.',
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
                        'help' => 'Pill badge at the top of the hero.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Main Hero Title',
                        'type' => 'text',
                        'default' => 'Rigorous HBSE Curriculum Designed for Success',
                        'help' => 'Main headline on the hero banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle',
                        'type' => 'text',
                        'default' => 'Discover an enriching academic framework from Pre-Primary to Class 12, fostering analytical thinking, practical lab experimentation, moral values, and board examination distinction.',
                        'help' => 'Introductory paragraph below the headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_text',
                        'label' => 'Primary CTA Button Text',
                        'type' => 'text',
                        'default' => 'Explore Stages',
                        'help' => 'First button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_link',
                        'label' => 'Primary CTA Button Link',
                        'type' => 'text',
                        'default' => '#curriculum-levels',
                        'help' => 'Anchor or page link for button 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_text',
                        'label' => 'Secondary CTA Button Text',
                        'type' => 'text',
                        'default' => 'Senior Secondary Streams',
                        'help' => 'Second button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_link',
                        'label' => 'Secondary CTA Button Link',
                        'type' => 'text',
                        'default' => '#streams',
                        'help' => 'Anchor or page link for button 2.'
                    ]
                ]
            ],

            // Section 2: Quick Academic Stats Strip
            [
                'title' => 'Section 2: Quick Academic Stats Strip (4 Counters)',
                'icon'  => 'analytics',
                'desc'  => '4 stat counters: Pass record, teacher-student ratio, streams, and lab infrastructure.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Value',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Pass record percentage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'HBSE Pass Record',
                        'help' => 'Description below stat 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Value',
                        'type' => 'text',
                        'default' => '1:15',
                        'help' => 'Teacher to student ratio.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Teacher-Student Ratio',
                        'help' => 'Description below stat 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Value',
                        'type' => 'text',
                        'default' => '3 Streams',
                        'help' => 'Streams counter.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Science, Commerce & Arts',
                        'help' => 'Description below stat 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Value',
                        'type' => 'text',
                        'default' => 'Modern',
                        'help' => 'Infrastructure highlight.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'Labs & Smart Classes',
                        'help' => 'Description below stat 4.'
                    ]
                ]
            ],

            // Section 3: Curriculum Stages Overview & Levels (5 Interactive Tabs)
            [
                'title' => 'Section 3: Curriculum Stages Overview & 5 Levels (Pre-Primary to 12th)',
                'icon'  => 'auto_stories',
                'desc'  => 'Manage headers and all 5 interactive tab stages: Pre-Primary, Primary, Middle, Secondary, and Senior Secondary.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_eyebrow',
                        'label' => 'Section Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'Academic Stages',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_heading',
                        'label' => 'Section Main Heading',
                        'type' => 'text',
                        'default' => 'Curriculum Stages by Level',
                        'help' => 'Section title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'curriculum_desc',
                        'label' => 'Section Subtitle Description',
                        'type' => 'text',
                        'default' => 'Our progressive learning architecture builds conceptual clarity, self-confidence, and critical inquiry from early years to Class 12.',
                        'help' => 'Overview description.'
                    ],

                    // Stage 1: Pre-Primary
                    [
                        'kind' => 'text',
                        'key' => 'stage1_tab',
                        'label' => 'Stage 1 Tab Button Label',
                        'type' => 'text',
                        'default' => 'Pre-Primary (Nursery, LKG, UKG)',
                        'help' => 'Label for the stage 1 tab button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_badge',
                        'label' => 'Stage 1 Pill Badge',
                        'type' => 'text',
                        'default' => 'Early Childhood Education',
                        'help' => 'Category badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_age',
                        'label' => 'Stage 1 Age Group',
                        'type' => 'text',
                        'default' => 'Ages 3 to 5 Years',
                        'help' => 'Age range.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_title',
                        'label' => 'Stage 1 Headline',
                        'type' => 'text',
                        'default' => 'Play-Based Learning & Foundational Wonder',
                        'help' => 'Stage 1 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_desc',
                        'label' => 'Stage 1 Description',
                        'type' => 'text',
                        'default' => 'The Pre-Primary wing provides a nurturing environment where children discover the joy of learning through play, storytelling, numbers, rhymes, phonics, and motor skill activities.',
                        'help' => 'Stage 1 body text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_f1_title',
                        'label' => 'Stage 1 Feature 1 Title',
                        'type' => 'text',
                        'default' => 'Phonics & Language',
                        'help' => 'First feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_f1_desc',
                        'label' => 'Stage 1 Feature 1 Description',
                        'type' => 'text',
                        'default' => 'Foundational English and Hindi alphabet recognition and speech development.',
                        'help' => 'First feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_f2_title',
                        'label' => 'Stage 1 Feature 2 Title',
                        'type' => 'text',
                        'default' => 'Creative Expression',
                        'help' => 'Second feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_f2_desc',
                        'label' => 'Stage 1 Feature 2 Description',
                        'type' => 'text',
                        'default' => 'Daily engagement through drawing, clay modeling, games, and music.',
                        'help' => 'Second feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage1_focus',
                        'label' => 'Stage 1 Focus Tag',
                        'type' => 'text',
                        'default' => 'Focus: Cognitive & Social Readiness',
                        'help' => 'Bottom focus bar text.'
                    ],

                    // Stage 2: Primary School
                    [
                        'kind' => 'text',
                        'key' => 'stage2_tab',
                        'label' => 'Stage 2 Tab Button Label',
                        'type' => 'text',
                        'default' => 'Primary School (Classes 1-5)',
                        'help' => 'Label for the stage 2 tab button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_badge',
                        'label' => 'Stage 2 Pill Badge',
                        'type' => 'text',
                        'default' => 'Foundational Stage',
                        'help' => 'Category badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_age',
                        'label' => 'Stage 2 Class Range',
                        'type' => 'text',
                        'default' => 'Classes 1 to 5',
                        'help' => 'Class range.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_title',
                        'label' => 'Stage 2 Headline',
                        'type' => 'text',
                        'default' => 'Strengthening Core Concepts & Curiosity',
                        'help' => 'Stage 2 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_desc',
                        'label' => 'Stage 2 Description',
                        'type' => 'text',
                        'default' => 'Primary education at Sun Rise focuses on strong mathematical foundations, environmental studies (EVS), linguistic fluency, general knowledge, and computer literacy.',
                        'help' => 'Stage 2 body text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_f1_title',
                        'label' => 'Stage 2 Feature 1 Title',
                        'type' => 'text',
                        'default' => 'Activity-Based Mathematics',
                        'help' => 'First feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_f1_desc',
                        'label' => 'Stage 2 Feature 1 Description',
                        'type' => 'text',
                        'default' => 'Conceptual arithmetic, mental math, and visual geometry kits.',
                        'help' => 'First feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_f2_title',
                        'label' => 'Stage 2 Feature 2 Title',
                        'type' => 'text',
                        'default' => 'Science & Environment',
                        'help' => 'Second feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_f2_desc',
                        'label' => 'Stage 2 Feature 2 Description',
                        'type' => 'text',
                        'default' => 'Nature observation, plants, hygiene, and daily science awareness.',
                        'help' => 'Second feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage2_focus',
                        'label' => 'Stage 2 Focus Tag',
                        'type' => 'text',
                        'default' => 'Focus: Academic Discipline & Values',
                        'help' => 'Bottom focus bar text.'
                    ],

                    // Stage 3: Middle School
                    [
                        'kind' => 'text',
                        'key' => 'stage3_tab',
                        'label' => 'Stage 3 Tab Button Label',
                        'type' => 'text',
                        'default' => 'Middle School (Classes 6-8)',
                        'help' => 'Label for the stage 3 tab button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_badge',
                        'label' => 'Stage 3 Pill Badge',
                        'type' => 'text',
                        'default' => 'Preparatory Stage',
                        'help' => 'Category badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_age',
                        'label' => 'Stage 3 Class Range',
                        'type' => 'text',
                        'default' => 'Classes 6 to 8',
                        'help' => 'Class range.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_title',
                        'label' => 'Stage 3 Headline',
                        'type' => 'text',
                        'default' => 'Developing Critical Thinking & Lab Skills',
                        'help' => 'Stage 3 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_desc',
                        'label' => 'Stage 3 Description',
                        'type' => 'text',
                        'default' => 'Middle school students dive into specialized subjects: Science (Physics, Chemistry, Biology), Mathematics, Social Sciences, Computer Applications, and Languages.',
                        'help' => 'Stage 3 body text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_f1_title',
                        'label' => 'Stage 3 Feature 1 Title',
                        'type' => 'text',
                        'default' => 'Science Lab Demonstrations',
                        'help' => 'First feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_f1_desc',
                        'label' => 'Stage 3 Feature 1 Description',
                        'type' => 'text',
                        'default' => 'Practical experiments, exhibition projects, and scientific reasoning.',
                        'help' => 'First feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_f2_title',
                        'label' => 'Stage 3 Feature 2 Title',
                        'type' => 'text',
                        'default' => 'Computer Science',
                        'help' => 'Second feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_f2_desc',
                        'label' => 'Stage 3 Feature 2 Description',
                        'type' => 'text',
                        'default' => 'Hands-on typing, digital literacy, and basic programming logic.',
                        'help' => 'Second feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage3_focus',
                        'label' => 'Stage 3 Focus Tag',
                        'type' => 'text',
                        'default' => 'Focus: Analytical & Practical Skills',
                        'help' => 'Bottom focus bar text.'
                    ],

                    // Stage 4: Secondary School
                    [
                        'kind' => 'text',
                        'key' => 'stage4_tab',
                        'label' => 'Stage 4 Tab Button Label',
                        'type' => 'text',
                        'default' => 'Secondary School (Classes 9-10)',
                        'help' => 'Label for the stage 4 tab button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_badge',
                        'label' => 'Stage 4 Pill Badge',
                        'type' => 'text',
                        'default' => 'HBSE Board Stage',
                        'help' => 'Category badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_age',
                        'label' => 'Stage 4 Class Range',
                        'type' => 'text',
                        'default' => 'Classes 9 to 10',
                        'help' => 'Class range.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_title',
                        'label' => 'Stage 4 Headline',
                        'type' => 'text',
                        'default' => 'HBSE Class 10 Board Examination Rigor',
                        'help' => 'Stage 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_desc',
                        'label' => 'Stage 4 Description',
                        'type' => 'text',
                        'default' => 'Intensive preparation for HBSE examinations through chapter-wise tests, regular mock examinations, doubt-solving sessions, and practical assessments.',
                        'help' => 'Stage 4 body text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_f1_title',
                        'label' => 'Stage 4 Feature 1 Title',
                        'type' => 'text',
                        'default' => 'Thorough Exam Prep',
                        'help' => 'First feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_f1_desc',
                        'label' => 'Stage 4 Feature 1 Description',
                        'type' => 'text',
                        'default' => 'Sample papers, NCERT mastery, and strategic test series.',
                        'help' => 'First feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_f2_title',
                        'label' => 'Stage 4 Feature 2 Title',
                        'type' => 'text',
                        'default' => 'Career & Stream Guidance',
                        'help' => 'Second feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_f2_desc',
                        'label' => 'Stage 4 Feature 2 Description',
                        'type' => 'text',
                        'default' => 'Expert counseling to select the right stream for Class 11.',
                        'help' => 'Second feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage4_focus',
                        'label' => 'Stage 4 Focus Tag',
                        'type' => 'text',
                        'default' => 'Focus: 100% Board Distinction',
                        'help' => 'Bottom focus bar text.'
                    ],

                    // Stage 5: Senior Secondary
                    [
                        'kind' => 'text',
                        'key' => 'stage5_tab',
                        'label' => 'Stage 5 Tab Button Label',
                        'type' => 'text',
                        'default' => 'Senior Secondary (Classes 11-12)',
                        'help' => 'Label for the stage 5 tab button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_badge',
                        'label' => 'Stage 5 Pill Badge',
                        'type' => 'text',
                        'default' => 'Senior Secondary (10+2)',
                        'help' => 'Category badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_age',
                        'label' => 'Stage 5 Class Range',
                        'type' => 'text',
                        'default' => 'Classes 11 to 12',
                        'help' => 'Class range.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_title',
                        'label' => 'Stage 5 Headline',
                        'type' => 'text',
                        'default' => 'Specialized Streams for University & Competitive Exams',
                        'help' => 'Stage 5 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_desc',
                        'label' => 'Stage 5 Description',
                        'type' => 'text',
                        'default' => 'Offering specialized academic streams (Science, Commerce, Arts) taught by seasoned post-graduate educators with modern practical laboratory setups.',
                        'help' => 'Stage 5 body text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_f1_title',
                        'label' => 'Stage 5 Feature 1 Title',
                        'type' => 'text',
                        'default' => 'Multiple Stream Choices',
                        'help' => 'First feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_f1_desc',
                        'label' => 'Stage 5 Feature 1 Description',
                        'type' => 'text',
                        'default' => 'Medical (PCB), Non-Medical (PCM), Commerce, and Humanities / Arts.',
                        'help' => 'First feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_f2_title',
                        'label' => 'Stage 5 Feature 2 Title',
                        'type' => 'text',
                        'default' => 'Practical Mastery',
                        'help' => 'Second feature heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_f2_desc',
                        'label' => 'Stage 5 Feature 2 Description',
                        'type' => 'text',
                        'default' => 'Full syllabus practicals in physics, chemistry, biology, and IP/CS labs.',
                        'help' => 'Second feature text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stage5_focus',
                        'label' => 'Stage 5 Focus Tag',
                        'type' => 'text',
                        'default' => 'Focus: Higher Education & Careers',
                        'help' => 'Bottom focus bar text.'
                    ]
                ]
            ],

            // Section 4: Senior Secondary Academic Streams
            [
                'title' => 'Section 4: Senior Secondary Academic Streams (Science, Commerce, Arts)',
                'icon'  => 'category',
                'desc'  => 'Titles, descriptions, focus badges, and core subjects for Science, Commerce, and Arts streams.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'streams_eyebrow',
                        'label' => 'Streams Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Class 11 & 12 Streams',
                        'help' => 'Top eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'streams_heading',
                        'label' => 'Streams Section Heading',
                        'type' => 'text',
                        'default' => 'Senior Secondary Academic Streams',
                        'help' => 'Main section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'streams_desc',
                        'label' => 'Streams Section Subtitle',
                        'type' => 'text',
                        'default' => 'Tailored academic pathways equipping students for HBSE board excellence and leading university admissions.',
                        'help' => 'Section overview text.'
                    ],

                    // Stream 1: Science
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
                        'help' => 'Science stream description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_tag',
                        'label' => 'Stream 1 Focus Tag',
                        'type' => 'text',
                        'default' => 'Medical & Engineering Focus',
                        'help' => 'Bottom tag line.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_sub1',
                        'label' => 'Stream 1 Subject 1',
                        'type' => 'text',
                        'default' => 'Physics & Chemistry',
                        'help' => 'Core subject 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_sub2',
                        'label' => 'Stream 1 Subject 2',
                        'type' => 'text',
                        'default' => 'Mathematics / Biology',
                        'help' => 'Core subject 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_sub3',
                        'label' => 'Stream 1 Subject 3',
                        'type' => 'text',
                        'default' => 'Computer Science / Physical Education',
                        'help' => 'Core subject 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream1_sub4',
                        'label' => 'Stream 1 Subject 4',
                        'type' => 'text',
                        'default' => 'English Core',
                        'help' => 'Core subject 4.'
                    ],

                    // Stream 2: Commerce
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
                        'help' => 'Commerce stream description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_tag',
                        'label' => 'Stream 2 Focus Tag',
                        'type' => 'text',
                        'default' => 'Commerce & Finance Track',
                        'help' => 'Bottom tag line.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_sub1',
                        'label' => 'Stream 2 Subject 1',
                        'type' => 'text',
                        'default' => 'Accountancy',
                        'help' => 'Core subject 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_sub2',
                        'label' => 'Stream 2 Subject 2',
                        'type' => 'text',
                        'default' => 'Business Studies',
                        'help' => 'Core subject 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_sub3',
                        'label' => 'Stream 2 Subject 3',
                        'type' => 'text',
                        'default' => 'Economics & Mathematics / IP',
                        'help' => 'Core subject 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream2_sub4',
                        'label' => 'Stream 2 Subject 4',
                        'type' => 'text',
                        'default' => 'English Core',
                        'help' => 'Core subject 4.'
                    ],

                    // Stream 3: Arts & Humanities
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
                        'help' => 'Arts stream description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_tag',
                        'label' => 'Stream 3 Focus Tag',
                        'type' => 'text',
                        'default' => 'Civil Services & Law Track',
                        'help' => 'Bottom tag line.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_sub1',
                        'label' => 'Stream 3 Subject 1',
                        'type' => 'text',
                        'default' => 'History & Political Science',
                        'help' => 'Core subject 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_sub2',
                        'label' => 'Stream 3 Subject 2',
                        'type' => 'text',
                        'default' => 'Geography / Economics',
                        'help' => 'Core subject 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_sub3',
                        'label' => 'Stream 3 Subject 3',
                        'type' => 'text',
                        'default' => 'Hindi / Physical Education',
                        'help' => 'Core subject 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stream3_sub4',
                        'label' => 'Stream 3 Subject 4',
                        'type' => 'text',
                        'default' => 'English Core',
                        'help' => 'Core subject 4.'
                    ]
                ]
            ],

            // Section 5: Pedagogical Approach / Teaching Methodology
            [
                'title' => 'Section 5: Pedagogical Approach & Teaching Methodology',
                'icon'  => 'psychology',
                'desc'  => '4 methodology pillars: Concept clarity, practical labs, testing, and individual care.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'pedagogy_eyebrow',
                        'label' => 'Pedagogy Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Pedagogical Approach',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pedagogy_heading',
                        'label' => 'Pedagogy Main Heading',
                        'type' => 'text',
                        'default' => 'How We Teach at Sun Rise',
                        'help' => 'Section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'pedagogy_desc',
                        'label' => 'Pedagogy Subtitle Description',
                        'type' => 'text',
                        'default' => 'Combining traditional teacher mentorship with modern smart-class technology and experimental learning.',
                        'help' => 'Overview text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step1_title',
                        'label' => 'Pillar 1 Title',
                        'type' => 'text',
                        'default' => 'Concept Clarity',
                        'help' => 'Pillar 1 title.'
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
                        'key' => 'step1_tag',
                        'label' => 'Pillar 1 Bottom Tag',
                        'type' => 'text',
                        'default' => 'Core Understanding',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step2_title',
                        'label' => 'Pillar 2 Title',
                        'type' => 'text',
                        'default' => 'Practical Labs',
                        'help' => 'Pillar 2 title.'
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
                        'key' => 'step2_tag',
                        'label' => 'Pillar 2 Bottom Tag',
                        'type' => 'text',
                        'default' => 'Experiential Learning',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step3_title',
                        'label' => 'Pillar 3 Title',
                        'type' => 'text',
                        'default' => 'Regular Testing',
                        'help' => 'Pillar 3 title.'
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
                        'key' => 'step3_tag',
                        'label' => 'Pillar 3 Bottom Tag',
                        'type' => 'text',
                        'default' => 'Exam Readiness',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_title',
                        'label' => 'Pillar 4 Title',
                        'type' => 'text',
                        'default' => 'Individual Care',
                        'help' => 'Pillar 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_desc',
                        'label' => 'Pillar 4 Description',
                        'type' => 'text',
                        'default' => 'Remedial classes for students needing extra help and personalized attention for every scholar.',
                        'help' => 'Pillar 4 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_tag',
                        'label' => 'Pillar 4 Bottom Tag',
                        'type' => 'text',
                        'default' => 'Personal Mentorship',
                        'help' => 'Tag line at the card bottom.'
                    ]
                ]
            ],

            // Section 6: Examination System & School Timings
            [
                'title' => 'Section 6: Examination System, Medium of Instruction & School Timings',
                'icon'  => 'assignment_turned_in',
                'desc'  => '4 evaluation exam types (Mid-term, Monthly, Class & Surprise Tests), Medium of Instruction, and Official Timings.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'exam_eyebrow',
                        'label' => 'Exam Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Continuous & Comprehensive Assessment',
                        'help' => 'Top eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam_heading',
                        'label' => 'Exam Section Heading',
                        'type' => 'text',
                        'default' => 'Examination & Evaluation System',
                        'help' => 'Main section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam_desc',
                        'label' => 'Exam Section Subtitle',
                        'type' => 'text',
                        'default' => 'At Sun Rise Sr. Sec. School, our evaluation framework ensures continuous learning, diagnostic feedback, and thorough board examination readiness.',
                        'help' => 'Overview paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam1_title',
                        'label' => 'Evaluation Type 1 Title',
                        'type' => 'text',
                        'default' => 'Mid-Term & Annual Exams',
                        'help' => 'Exam 1 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam1_desc',
                        'label' => 'Evaluation Type 1 Description',
                        'type' => 'text',
                        'default' => 'Comprehensive term-end examinations patterned on HBSE board standards, evaluating overall mastery and practical performance.',
                        'help' => 'Exam 1 details.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam1_tag',
                        'label' => 'Evaluation Type 1 Tag',
                        'type' => 'text',
                        'default' => 'Major Milestones',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam2_title',
                        'label' => 'Evaluation Type 2 Title',
                        'type' => 'text',
                        'default' => 'Monthly Unit Tests',
                        'help' => 'Exam 2 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam2_desc',
                        'label' => 'Evaluation Type 2 Description',
                        'type' => 'text',
                        'default' => 'Scheduled at the close of every month across all subjects to track topic-wise retention and ensure continuous revision.',
                        'help' => 'Exam 2 details.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam2_tag',
                        'label' => 'Evaluation Type 2 Tag',
                        'type' => 'text',
                        'default' => 'Monthly Assessment',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam3_title',
                        'label' => 'Evaluation Type 3 Title',
                        'type' => 'text',
                        'default' => 'Regular Class Tests',
                        'help' => 'Exam 3 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam3_desc',
                        'label' => 'Evaluation Type 3 Description',
                        'type' => 'text',
                        'default' => 'Frequent chapter-end evaluations conducted by subject educators to identify learning gaps and reinforce key concepts.',
                        'help' => 'Exam 3 details.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam3_tag',
                        'label' => 'Evaluation Type 3 Tag',
                        'type' => 'text',
                        'default' => 'Topic-by-Topic',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam4_title',
                        'label' => 'Evaluation Type 4 Title',
                        'type' => 'text',
                        'default' => 'Surprise Tests',
                        'help' => 'Exam 4 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam4_desc',
                        'label' => 'Evaluation Type 4 Description',
                        'type' => 'text',
                        'default' => 'Unannounced quick assessments encouraging students to maintain daily revision habits and stay prepared throughout the year.',
                        'help' => 'Exam 4 details.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam4_tag',
                        'label' => 'Evaluation Type 4 Tag',
                        'type' => 'text',
                        'default' => 'Continuous Readiness',
                        'help' => 'Tag line at the card bottom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'medium_title',
                        'label' => 'Medium of Instruction Title',
                        'type' => 'text',
                        'default' => 'English Medium (Nursery to Class XII)',
                        'help' => 'Main language highlight.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'medium_desc',
                        'label' => 'Medium of Instruction Subtitle',
                        'type' => 'text',
                        'default' => 'With strong Hindi and regional language foundations',
                        'help' => 'Language clarification.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_summer',
                        'label' => 'Official Summer Timings',
                        'type' => 'text',
                        'default' => '7:30 AM – 1:30 PM',
                        'help' => 'Summer school hours.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_winter',
                        'label' => 'Official Winter Timings',
                        'type' => 'text',
                        'default' => '8:30 AM – 2:30 PM',
                        'help' => 'Winter school hours.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'exam_calendar_file_img',
                        'label' => 'Upload Exam Calendar / Date Sheet Image (For Download)',
                        'default' => 'assets/images/pop-up image.webp',
                        'alt' => 'Sun Rise School Exam Calendar Date Sheet',
                        'help' => 'Upload or replace the examination schedule / date sheet image or PDF that students & parents can download.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'exam_calendar_btn_text',
                        'label' => 'Exam Calendar Download Button Text',
                        'type' => 'text',
                        'default' => 'Download Exam Date Sheet & Schedule',
                        'help' => 'Label text shown on the download button in Academics page.'
                    ]
                ]
            ],

            // Section 7: Board Examination Results & Toppers Spotlight
            [
                'title' => 'Section 7: Board Results, Merit Distinction & Toppers Spotlight',
                'icon'  => 'military_tech',
                'desc'  => 'Manage board results highlights, pass record stats, and upload the Board Toppers & Achievers poster.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'toppers_eyebrow',
                        'label' => 'Toppers Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Academic Distinction',
                        'help' => 'Top eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_heading',
                        'label' => 'Toppers Section Heading',
                        'type' => 'text',
                        'default' => 'Board Examination Results & Toppers',
                        'help' => 'Main section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_desc',
                        'label' => 'Toppers Section Subtitle',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School proudly celebrates a consistent 100% HBSE board examination pass rate, producing district and block rank holders.',
                        'help' => 'Section overview text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_card_badge',
                        'label' => 'Achievers Card Pill Badge',
                        'type' => 'text',
                        'default' => 'HBSE Board Star Achievers',
                        'help' => 'Badge inside dark banner card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_card_title',
                        'label' => 'Achievers Card Main Title',
                        'type' => 'text',
                        'default' => 'Celebrating Academic Excellence & Merit Ranks',
                        'help' => 'Title inside the banner card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_card_desc',
                        'label' => 'Achievers Card Description',
                        'type' => 'text',
                        'default' => 'Through systematic syllabus completion, doubt resolution clinics, and regular testing, our Class X and XII students achieve top percentiles in Haryana Board examinations year after year.',
                        'help' => 'Body text inside the banner card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat1_num',
                        'label' => 'Achievers Stat 1 Number',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'First statistic figure.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat1_lbl',
                        'label' => 'Achievers Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Board Pass Record',
                        'help' => 'First statistic description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat2_num',
                        'label' => 'Achievers Stat 2 Number',
                        'type' => 'text',
                        'default' => 'Nursery – XII',
                        'help' => 'Second statistic figure.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat2_lbl',
                        'label' => 'Achievers Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Comprehensive Spectrum',
                        'help' => 'Second statistic description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat3_num',
                        'label' => 'Achievers Stat 3 Number',
                        'type' => 'text',
                        'default' => '3 Streams',
                        'help' => 'Third statistic figure.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_stat3_lbl',
                        'label' => 'Achievers Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Science, Commerce, Arts',
                        'help' => 'Third statistic description.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'toppers_poster',
                        'label' => 'Board Toppers Poster / Photo Slot',
                        'default' => 'assets/images/pop-up image.webp',
                        'alt' => 'Sun Rise Board Toppers Poster',
                        'help' => 'Upload or replace the Board Toppers & Merit Rank Holders poster with live preview and lightbox zoom.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'toppers_poster_hint',
                        'label' => 'Poster Click Hint Label',
                        'type' => 'text',
                        'default' => 'Click to view toppers poster',
                        'help' => 'Hint below poster thumbnail.'
                    ]
                ]
            ]
        ]
    ],
    'admissions' => [
        'title' => 'Admissions Page',
        'icon'  => 'assignment_turned_in',
        'desc'  => 'Live Admission Registration, 8 Grade Stream Vacancies & Fees, Bus Transit, UPI Checkout, Fee Matrix Table, Concessions, Documents & FAQs',
        'sections' => [
            // Section 1: Top Hero Banner & Status
            [
                'title' => 'Section 1: Top Hero Banner, Background Image & Key Badges',
                'icon'  => 'flag',
                'desc'  => 'Campus background photo (with blur effect), academic session registration status, main headline, introductory summary, and 4 institutional trust badges.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_bg_image',
                        'label' => 'Hero Section Background Campus Image (Blurred)',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Sun Rise Sr. Sec. School Campus',
                        'help' => 'Campus background photo shown with a stylish blur & soft illumination behind the Admissions Hero section. Select any campus photo or upload a new one.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'session_badge',
                        'label' => 'Session Status Pill Badge',
                        'type' => 'text',
                        'default' => 'Academic Session 2026–27 Registrations Open',
                        'help' => 'Pill banner with pulsing indicator at the top.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Admissions Page Headline',
                        'type' => 'text',
                        'default' => 'Admissions Open: Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Main headline on the admissions page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_desc',
                        'label' => 'Admissions Overview Description',
                        'type' => 'textarea',
                        'default' => 'Cultivating scholarship, strong character, and competitive excellence in Hisar district. Select your grade stream, verify student credentials, choose village transit, and secure provisional seat enrollment instantly via direct digital checkout.',
                        'help' => 'Introductory summary text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'school_affiliation_tag',
                        'label' => 'School Credential Affiliation Tag',
                        'type' => 'text',
                        'default' => 'Affiliated to HBSE, Haryana',
                        'help' => 'Small eyebrow tag in the school crest card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'school_location_tag',
                        'label' => 'School Location Tag',
                        'type' => 'text',
                        'default' => 'Dobhi, Dist. Hisar, Haryana – 125001',
                        'help' => 'Address line in the school crest card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'admission_status_pill',
                        'label' => 'Admission Status Indicator Pill',
                        'type' => 'text',
                        'default' => 'Active Now',
                        'help' => 'Status pill in the school crest card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_HBSE',
                        'label' => 'Badge 1 (HBSE Affiliation)',
                        'type' => 'text',
                        'default' => 'HBSE Affiliation #530XXX (Dobhi, Hisar)',
                        'help' => 'First key highlight badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_digital',
                        'label' => 'Badge 2 (Digital Entry)',
                        'type' => 'text',
                        'default' => '100% Digital Fast-Track Entry',
                        'help' => 'Second key highlight badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_token',
                        'label' => 'Badge 3 (Seat Allocation)',
                        'type' => 'text',
                        'default' => 'Instant Seat Allocation Token',
                        'help' => 'Third key highlight badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'badge_escrow',
                        'label' => 'Badge 4 (Payment Security)',
                        'type' => 'text',
                        'default' => 'RBI & PCI-DSS 256-Bit Escrow',
                        'help' => 'Fourth key highlight badge.'
                    ]
                ]
            ],

            // Section 2: Multi-Step Admission Process Tracker
            [
                'title' => 'Section 2: Multi-Step Admission Process Tracker (Steps 1–4)',
                'icon'  => 'linear_scale',
                'desc'  => 'Labels and headings for each of the 4 horizontal steps in the registration progress bar.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'step1_title',
                        'label' => 'Step 01 Title',
                        'type' => 'text',
                        'default' => 'Class & Stream Choice',
                        'help' => 'Title for Step 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step2_title',
                        'label' => 'Step 02 Title',
                        'type' => 'text',
                        'default' => 'Student Profile Info',
                        'help' => 'Title for Step 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step3_title',
                        'label' => 'Step 03 Title',
                        'type' => 'text',
                        'default' => 'Transit & Documents',
                        'help' => 'Title for Step 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'step4_title',
                        'label' => 'Step 04 Title',
                        'type' => 'text',
                        'default' => 'Fee Review & Checkout',
                        'help' => 'Title for Step 4.'
                    ]
                ]
            ],

            // Section 3: Class & Stream Matrix Intro & Vacancies
            [
                'title' => 'Section 3: Class Selection Matrix & 8 Grade Cards (Seats & Fees)',
                'icon'  => 'table_view',
                'desc'  => 'Section headers plus seats left, monthly tuition fees, registration fees, and age criteria across all 8 grade options.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_eyebrow',
                        'label' => 'Selector Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Select Admission Grade',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_heading',
                        'label' => 'Selector Main Heading',
                        'type' => 'text',
                        'default' => 'Available Classes & Available Vacancies',
                        'help' => 'Main section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'grade_selector_desc',
                        'label' => 'Selector Subtitle',
                        'type' => 'text',
                        'default' => 'Choose the prospective level to populate academic fees, syllabi criteria, and batch schedules.',
                        'help' => 'Instructions below heading.'
                    ],

                    // Card 1: Class 11 Non-Med
                    [
                        'kind' => 'text',
                        'key' => 'c1_name',
                        'label' => 'Card 1 Title (Class 11 Non-Med)',
                        'type' => 'text',
                        'default' => 'Class XI – Science (Non-Med)',
                        'help' => 'Card 1 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c1_desc',
                        'label' => 'Card 1 Description',
                        'type' => 'text',
                        'default' => 'Physics, Chemistry, Math + Comp. Science / Physical Edu with NDA & JEE Foundation Track.',
                        'help' => 'Card 1 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c1_seats',
                        'label' => 'Card 1 Vacancy Badge',
                        'type' => 'text',
                        'default' => '12 Seats Left',
                        'help' => 'Card 1 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c1_age',
                        'label' => 'Card 1 Age Criteria',
                        'type' => 'text',
                        'default' => '15 - 17 Years',
                        'help' => 'Card 1 age.'
                    ],

                    // Card 2: Class 11 Med
                    [
                        'kind' => 'text',
                        'key' => 'c2_name',
                        'label' => 'Card 2 Title (Class 11 Medical)',
                        'type' => 'text',
                        'default' => 'Class XI – Science (Medical)',
                        'help' => 'Card 2 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c2_desc',
                        'label' => 'Card 2 Description',
                        'type' => 'text',
                        'default' => 'Physics, Chemistry, Biology + Biotech/IP with dedicated NEET coaching orientation lab.',
                        'help' => 'Card 2 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c2_seats',
                        'label' => 'Card 2 Vacancy Badge',
                        'type' => 'text',
                        'default' => '8 Seats Left',
                        'help' => 'Card 2 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c2_age',
                        'label' => 'Card 2 Age Criteria',
                        'type' => 'text',
                        'default' => '15 - 17 Years',
                        'help' => 'Card 2 age.'
                    ],

                    // Card 3: Class 11 Commerce & Arts
                    [
                        'kind' => 'text',
                        'key' => 'c3_name',
                        'label' => 'Card 3 Title (Class 11 Commerce & Arts)',
                        'type' => 'text',
                        'default' => 'Class XI – Commerce & Arts',
                        'help' => 'Card 3 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c3_desc',
                        'label' => 'Card 3 Description',
                        'type' => 'text',
                        'default' => 'Accountancy, Business Studies, Economics, Pol. Science, Geography & Applied Mathematics.',
                        'help' => 'Card 3 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c3_seats',
                        'label' => 'Card 3 Vacancy Badge',
                        'type' => 'text',
                        'default' => '22 Seats Available',
                        'help' => 'Card 3 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c3_age',
                        'label' => 'Card 3 Age Criteria',
                        'type' => 'text',
                        'default' => '15 - 17 Years',
                        'help' => 'Card 3 age.'
                    ],

                    // Card 4: Secondary Class 9 & 10
                    [
                        'kind' => 'text',
                        'key' => 'c4_name',
                        'label' => 'Card 4 Title (Secondary Classes 9 & 10)',
                        'type' => 'text',
                        'default' => 'Class IX & X (Secondary)',
                        'help' => 'Card 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c4_desc',
                        'label' => 'Card 4 Description',
                        'type' => 'text',
                        'default' => 'Holistic HBSE syllabus with Robotics lab, Vedic Math, Sports academy & NTSE training module.',
                        'help' => 'Card 4 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c4_seats',
                        'label' => 'Card 4 Vacancy Badge',
                        'type' => 'text',
                        'default' => '16 Seats Open',
                        'help' => 'Card 4 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c4_age',
                        'label' => 'Card 4 Age Criteria',
                        'type' => 'text',
                        'default' => '13 - 15 Years',
                        'help' => 'Card 4 age.'
                    ],

                    // Card 5: Middle Wing 6 to 8
                    [
                        'kind' => 'text',
                        'key' => 'c5_name',
                        'label' => 'Card 5 Title (Middle Wing Classes 6 to 8)',
                        'type' => 'text',
                        'default' => 'Class VI – VIII (Middle Wing)',
                        'help' => 'Card 5 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c5_desc',
                        'label' => 'Card 5 Description',
                        'type' => 'text',
                        'default' => 'Foundational STEM concepts, computer coding, Hindi & English debate, and agricultural science basics.',
                        'help' => 'Card 5 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c5_seats',
                        'label' => 'Card 5 Vacancy Badge',
                        'type' => 'text',
                        'default' => '19 Seats Available',
                        'help' => 'Card 5 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c5_age',
                        'label' => 'Card 5 Age Criteria',
                        'type' => 'text',
                        'default' => '10 - 13 Years',
                        'help' => 'Card 5 age.'
                    ],

                    // Card 6: Primary Wing 1 to 5
                    [
                        'kind' => 'text',
                        'key' => 'c6_name',
                        'label' => 'Card 6 Title (Primary School Classes 1 to 5)',
                        'type' => 'text',
                        'default' => 'Class I – V (Primary School)',
                        'help' => 'Card 6 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c6_desc',
                        'label' => 'Card 6 Description',
                        'type' => 'text',
                        'default' => 'Activity-based learning, phonetics, environmental studies, performing arts, and physical fitness.',
                        'help' => 'Card 6 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c6_seats',
                        'label' => 'Card 6 Vacancy Badge',
                        'type' => 'text',
                        'default' => '25 Seats Available',
                        'help' => 'Card 6 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c6_age',
                        'label' => 'Card 6 Age Criteria',
                        'type' => 'text',
                        'default' => '5 - 10 Years',
                        'help' => 'Card 6 age.'
                    ],

                    // Card 7: Pre-Primary Nursery & KG
                    [
                        'kind' => 'text',
                        'key' => 'c7_name',
                        'label' => 'Card 7 Title (Pre-Primary Nursery & KG)',
                        'type' => 'text',
                        'default' => 'Pre-Primary (Nursery, KG)',
                        'help' => 'Card 7 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c7_desc',
                        'label' => 'Card 7 Description',
                        'type' => 'text',
                        'default' => 'Montessori-inspired play gym, sensorimotor training, creative storytelling & air-conditioned playzones.',
                        'help' => 'Card 7 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c7_seats',
                        'label' => 'Card 7 Vacancy Badge',
                        'type' => 'text',
                        'default' => '30 Seats Available',
                        'help' => 'Card 7 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c7_age',
                        'label' => 'Card 7 Age Criteria',
                        'type' => 'text',
                        'default' => '3 - 5 Years',
                        'help' => 'Card 7 age.'
                    ],

                    // Card 8: Class 12 Transfer Entry
                    [
                        'kind' => 'text',
                        'key' => 'c8_name',
                        'label' => 'Card 8 Title (Class 12 Transfer Entry)',
                        'type' => 'text',
                        'default' => 'Class XII – Transfer Entry',
                        'help' => 'Card 8 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c8_desc',
                        'label' => 'Card 8 Description',
                        'type' => 'text',
                        'default' => 'Direct admission subject to HBSE Regional Office clearance, TC from previous affiliated institution.',
                        'help' => 'Card 8 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c8_seats',
                        'label' => 'Card 8 Vacancy Badge',
                        'type' => 'text',
                        'default' => '5 Seats Only',
                        'help' => 'Card 8 seat status.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'c8_age',
                        'label' => 'Card 8 Age Criteria',
                        'type' => 'text',
                        'default' => '16 - 18 Years',
                        'help' => 'Card 8 age.'
                    ]
                ]
            ],

            // Section 4: School Bus Transit Facility & Required Documents
            [
                'title' => 'Section 4: School Bus Transit & Document Verification Checklist',
                'icon'  => 'directions_bus',
                'desc'  => 'Bus network coverage description, default route details, and required document upload item titles.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'bus_facility_title',
                        'label' => 'Bus Transit Facility Heading',
                        'type' => 'text',
                        'default' => 'Residence & Daily School Bus Facility',
                        'help' => 'Heading above the bus transit options.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'bus_facility_desc',
                        'label' => 'Bus Transit Coverage Description',
                        'type' => 'text',
                        'default' => 'Fleet covering 35+ villages in Hisar and neighboring rural belts',
                        'help' => 'Subtitle describing bus coverage.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'bus_route_label',
                        'label' => 'Default Bus Route Name',
                        'type' => 'text',
                        'default' => 'Route 4: Dobhi Village & Balsamand',
                        'help' => 'Primary bus route title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'bus_route_desc',
                        'label' => 'Default Bus Route Details & Fee Note',
                        'type' => 'text',
                        'default' => 'Pick-up at Main Stand / Doorway (₹300/month)',
                        'help' => 'Bus route details.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc1_title',
                        'label' => 'Document 1 Name',
                        'type' => 'text',
                        'default' => '1. Student Birth Certificate / 10th TC',
                        'help' => 'First document upload card title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc1_sub',
                        'label' => 'Document 1 Note',
                        'type' => 'text',
                        'default' => 'Official date of birth validation',
                        'help' => 'First document note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc2_title',
                        'label' => 'Document 2 Name',
                        'type' => 'text',
                        'default' => '2. Class 10 / Prior Marksheet',
                        'help' => 'Second document title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc2_sub',
                        'label' => 'Document 2 Note',
                        'type' => 'text',
                        'default' => 'Provisional web copy accepted',
                        'help' => 'Second document note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc3_title',
                        'label' => 'Document 3 Name',
                        'type' => 'text',
                        'default' => '3. Student & Parent Aadhaar Card',
                        'help' => 'Third document title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc3_sub',
                        'label' => 'Document 3 Note',
                        'type' => 'text',
                        'default' => 'Residence proof & biometric ID',
                        'help' => 'Third document note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc4_title',
                        'label' => 'Document 4 Name',
                        'type' => 'text',
                        'default' => '4. Passport Sized Photos (4)',
                        'help' => 'Fourth document title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'upload_doc4_sub',
                        'label' => 'Document 4 Note',
                        'type' => 'text',
                        'default' => 'Formal school uniform or plain bg',
                        'help' => 'Fourth document note.'
                    ]
                ]
            ],

            // Section 5: Live Admission Checkout Box & UPI Gateway Settings
            [
                'title' => 'Section 5: Live Admission Checkout Box & UPI Gateway Settings',
                'icon'  => 'shopping_cart_checkout',
                'desc'  => 'Manage fee concessions, lock seat token amount, official UPI VPA address, and payment security notes.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'checkout_subheading',
                        'label' => 'Checkout Tag / Session Banner',
                        'type' => 'text',
                        'default' => 'Session 2026–27 Enrollment',
                        'help' => 'Eyebrow tag in the sticky checkout box.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'checkout_heading',
                        'label' => 'Checkout Main Title',
                        'type' => 'text',
                        'default' => 'Live Admission Checkout',
                        'help' => 'Main headline in the sticky checkout box.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'checkout_cta_btn',
                        'label' => 'Checkout Primary Button Text',
                        'type' => 'text',
                        'default' => 'Proceed to Secure Checkout & Reserve Seat →',
                        'help' => 'Label for the main checkout button.'
                    ]
                ]
            ],


            // Section 8: Document Verification Checklist & Campus Tour Booking
            [
                'title' => 'Section 8: Document Verification Checklist & Campus Tour Booking',
                'icon'  => 'fact_check',
                'desc'  => 'Titles and descriptions for 5 physical verification documents, plus the campus visit prompt box.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'docs_eyebrow',
                        'label' => 'Documents Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Verification Standards',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'docs_heading',
                        'label' => 'Documents Section Heading',
                        'type' => 'text',
                        'default' => 'Required Documents & Eligibility',
                        'help' => 'Main section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'docs_desc',
                        'label' => 'Documents Section Subtitle',
                        'type' => 'text',
                        'default' => 'Carry original copies during document physical verification at Dobhi campus.',
                        'help' => 'Section subtitle.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc1_title',
                        'label' => 'Required Doc 1 Title',
                        'type' => 'text',
                        'default' => 'Original Transfer Certificate (TC)',
                        'help' => 'Document 1 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc1_desc',
                        'label' => 'Required Doc 1 Details',
                        'type' => 'text',
                        'default' => 'Countersigned by District Education Officer (if transferring from other state board).',
                        'help' => 'Document 1 instructions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc2_title',
                        'label' => 'Required Doc 2 Title',
                        'type' => 'text',
                        'default' => 'Municipal Birth Certificate',
                        'help' => 'Document 2 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc2_desc',
                        'label' => 'Required Doc 2 Details',
                        'type' => 'text',
                        'default' => 'Mandatory for Nursery to Class 1 admissions for proof of age cut-off.',
                        'help' => 'Document 2 instructions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc3_title',
                        'label' => 'Required Doc 3 Title',
                        'type' => 'text',
                        'default' => 'Aadhaar Card (Student & Both Parents)',
                        'help' => 'Document 3 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc3_desc',
                        'label' => 'Required Doc 3 Details',
                        'type' => 'text',
                        'default' => 'Clear photocopy for Haryana Parivar Pehchan Patra (PPP) linkage.',
                        'help' => 'Document 3 instructions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc4_title',
                        'label' => 'Required Doc 4 Title',
                        'type' => 'text',
                        'default' => 'Recent Passport-Size Photographs',
                        'help' => 'Document 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc4_desc',
                        'label' => 'Required Doc 4 Details',
                        'type' => 'text',
                        'default' => '4 copies of student and 2 joint photos with mother and father.',
                        'help' => 'Document 4 instructions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc5_title',
                        'label' => 'Required Doc 5 Title',
                        'type' => 'text',
                        'default' => 'Caste / Category Certificate (If Applicable)',
                        'help' => 'Document 5 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'doc5_desc',
                        'label' => 'Required Doc 5 Details',
                        'type' => 'text',
                        'default' => 'SC/ST/OBC/EWS certificate issued by competent Tehsildar or SDM authority.',
                        'help' => 'Document 5 instructions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_box_title',
                        'label' => 'Campus Tour Prompt Title',
                        'type' => 'text',
                        'default' => 'Prefer an In-Person Campus Tour?',
                        'help' => 'Title in the visit card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_box_desc',
                        'label' => 'Campus Tour Visiting Hours',
                        'type' => 'text',
                        'default' => 'Visit Dobhi campus Monday to Saturday between 9:00 AM – 2:30 PM.',
                        'help' => 'Visiting schedule.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_box_btn',
                        'label' => 'Campus Tour Button Text',
                        'type' => 'text',
                        'default' => 'Book Visit',
                        'help' => 'Button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_box_link',
                        'label' => 'Campus Tour Button Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination link.'
                    ]
                ]
            ],

            // Section 9: Parents' Admission FAQ Desk (5 FAQs)
            [
                'title' => 'Section 9: Parents\' Admission FAQ Desk (5 FAQs)',
                'icon'  => 'quiz',
                'desc'  => 'Questions and detailed answers addressing common parent queries about admissions, fees, streams, and bus routes.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'faq_eyebrow',
                        'label' => 'FAQ Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Parents\' FAQ Desk',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq_heading',
                        'label' => 'FAQ Section Heading',
                        'type' => 'text',
                        'default' => 'Frequently Asked Admission Questions',
                        'help' => 'Section heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq1_q',
                        'label' => 'FAQ 1 Question',
                        'type' => 'text',
                        'default' => 'What happens immediately after paying the admission checkout fee?',
                        'help' => 'Question 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq1_a',
                        'label' => 'FAQ 1 Answer',
                        'type' => 'textarea',
                        'default' => 'You will receive an automated SMS and WhatsApp confirmation containing the provisional Student Enrolment ID, downloadable fee receipt PDF, and scheduled date for the baseline interaction/diagnostic test at Sun Rise Sr. Sec. School, Dobhi.',
                        'help' => 'Answer 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq2_q',
                        'label' => 'FAQ 2 Question',
                        'type' => 'text',
                        'default' => 'Can we pay the monthly tuition fee easily online or at school?',
                        'help' => 'Question 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq2_a',
                        'label' => 'FAQ 2 Answer',
                        'type' => 'textarea',
                        'default' => 'Yes. Monthly tuition fees (around ₹600 to ₹1,000 / month) can be paid through UPI QR, net banking, debit/credit cards, or directly at the school cash counter by the 10th of every month.',
                        'help' => 'Answer 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq3_q',
                        'label' => 'FAQ 3 Question',
                        'type' => 'text',
                        'default' => 'How are Science/Commerce streams allocated in Class 11?',
                        'help' => 'Question 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq3_a',
                        'label' => 'FAQ 3 Answer',
                        'type' => 'textarea',
                        'default' => 'Science (Medical & Non-Medical) stream requires an aggregate minimum of 60% in Class 10 Board examinations with strong interest in Science & Mathematics. Commerce and Humanities are allotted based on student preference and aptitude evaluation.',
                        'help' => 'Answer 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq4_q',
                        'label' => 'FAQ 4 Question',
                        'type' => 'text',
                        'default' => 'Which villages are covered under the Dobhi bus transit network?',
                        'help' => 'Question 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq4_a',
                        'label' => 'FAQ 4 Answer',
                        'type' => 'textarea',
                        'default' => 'Our GPS-enabled bus network covers: Dobhi, Balsamand, Arya Nagar, Rawalwas Kalan, Rawalwas Khurd, Bandaheri, Chaudhariwas, Muklan, Mirzapur, and major rural arterial stops within a 22 km radius. Female attendants accompany all pre-primary and junior bus routes.',
                        'help' => 'Answer 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq5_q',
                        'label' => 'FAQ 5 Question',
                        'type' => 'text',
                        'default' => 'Is the registration fee refundable if we decide to withdraw?',
                        'help' => 'Question 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq5_a',
                        'label' => 'FAQ 5 Answer',
                        'type' => 'textarea',
                        'default' => 'If the student does not qualify in the assessment test or if a transfer posting is documented prior to April 1st, all deposited advance tuition fees and security deposits are 100% refundable without deductions. The application prospectus fee covers processing administrative overheads.',
                        'help' => 'Answer 5.'
                    ]
                ]
            ],

            // Section 10: Direct Admissions Helpline & Support Banner
            [
                'title' => 'Section 10: Direct Admissions Helpline & Support Banner',
                'icon'  => 'support_agent',
                'desc'  => 'Office hours, admissions directorate helpline phone, and direct WhatsApp contact link.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'help_eyebrow',
                        'label' => 'Helpdesk Directorate Tag',
                        'type' => 'text',
                        'default' => 'Admissions Directorate – Dobhi Campus',
                        'help' => 'Eyebrow tag in the bottom support banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_heading',
                        'label' => 'Helpdesk Main Heading',
                        'type' => 'text',
                        'default' => 'Need Assistance with Online Admissions?',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_desc',
                        'label' => 'Helpdesk Description & Timings',
                        'type' => 'textarea',
                        'default' => 'Our administrative office is open Monday to Saturday (Summer: 7:30 AM to 1:30 PM | Winter: 8:30 AM to 2:30 PM) to assist parents with document verification, fee concessions, and transport routes.',
                        'help' => 'Office schedule and assistance note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_phone',
                        'label' => 'Helpdesk Phone Number',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Calling number for admissions desk.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_whatsapp',
                        'label' => 'Helpdesk WhatsApp Number (without +)',
                        'type' => 'text',
                        'default' => '917015890094',
                        'help' => 'WhatsApp destination number for chat.'
                    ]
                ]
            ]
        ]
    ],
    'campus' => [
        'title' => 'Campus & Facilities',
        'icon'  => 'domain',
        'desc'  => 'Hero Banner, 4 Campus Stats, 9 Core Infrastructure Facilities, 24/7 CCTV Safety & Experience CTA',
        'sections' => [
            // Section 1: Hero Banner & Quick Actions
            [
                'title' => 'Section 1: Hero Banner & Quick Actions',
                'icon'  => 'flag',
                'desc'  => 'Top hero background image, eyebrow badge, main title, subtitle, and CTA action buttons.',
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
                        'help' => 'Pill badge above headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Campus Hero Headline',
                        'type' => 'text',
                        'default' => 'A Vibrant & Safe Campus Built for Excellence',
                        'help' => 'Main headline on campus.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Campus Hero Subtitle',
                        'type' => 'textarea',
                        'default' => 'Explore our purpose-built campus in Dobhi, Haryana designed to nurture academic focus, athletic vigor, scientific curiosity, and cultural creativity.',
                        'help' => 'Descriptive summary below the headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_text',
                        'label' => 'Primary Button Text',
                        'type' => 'text',
                        'default' => 'Explore Facilities',
                        'help' => 'Gold action button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_link',
                        'label' => 'Primary Button Target Link',
                        'type' => 'text',
                        'default' => '#facilities-grid',
                        'help' => 'Target anchor or page link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_text',
                        'label' => 'Secondary Button Text',
                        'type' => 'text',
                        'default' => 'Book Campus Tour',
                        'help' => 'White outline button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_link',
                        'label' => 'Secondary Button Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Target link for tour booking.'
                    ]
                ]
            ],

            // Section 2: Campus Quick Stats Strip (4 Highlights)
            [
                'title' => 'Section 2: Campus Quick Stats Strip (4 Highlights)',
                'icon'  => 'analytics',
                'desc'  => 'Four prominent metric highlights floating beneath the hero section.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Value (Campus Area)',
                        'type' => 'text',
                        'default' => '5+ Acres',
                        'help' => 'Number or metric.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Sprawling Green Campus',
                        'help' => 'Label under stat 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Value (Classrooms)',
                        'type' => 'text',
                        'default' => '30+',
                        'help' => 'Number or metric.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Smart Tech Classrooms',
                        'help' => 'Label under stat 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Value (Transport Coverage)',
                        'type' => 'text',
                        'default' => '35+',
                        'help' => 'Number or metric.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Villages Bus Transit Network',
                        'help' => 'Label under stat 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Value (Safety & Security)',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Number or metric.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'CCTV & Campus Perimeter Monitored',
                        'help' => 'Label under stat 4.'
                    ]
                ]
            ],

            // Section 3: Campus Infrastructure Section Header
            [
                'title' => 'Section 3: Campus Infrastructure Section Header',
                'icon'  => 'info',
                'desc'  => 'Introductory eyebrow, main heading, and overview subtitle for the facilities directory.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'facilities_eyebrow',
                        'label' => 'Facilities Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Campus Infrastructure',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'facilities_heading',
                        'label' => 'Facilities Section Main Heading',
                        'type' => 'text',
                        'default' => 'Facilities for Holistic Growth',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'facilities_desc',
                        'label' => 'Facilities Overview Subtitle',
                        'type' => 'textarea',
                        'default' => 'Every wing of Sun Rise Sr. Sec. School is thoughtfully equipped to ensure total safety, hygiene, modern learning tools, and joyful childhood development.',
                        'help' => 'Overview description.'
                    ]
                ]
            ],

            // Section 4: Academic & Digital Infrastructure (4 Facilities)
            [
                'title' => 'Section 4: Academic & Digital Infrastructure (Classrooms, Labs, Computers, Library)',
                'icon'  => 'school',
                'desc'  => 'Manage photos, tags, titles, descriptions, and feature bullet labels for academic spaces.',
                'fields' => [
                    // Facility 1: Smart Classrooms
                    [
                        'kind' => 'image',
                        'key' => 'fac1_img',
                        'label' => 'Facility 1 Photo (Smart Classrooms)',
                        'default' => 'assets/images/sunrise school image/children_sitting.webp',
                        'alt' => 'Spacious Smart Classrooms',
                        'help' => 'Photo for classrooms.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_tag',
                        'label' => 'Facility 1 Category Tag',
                        'type' => 'text',
                        'default' => '30+ Classrooms',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_title',
                        'label' => 'Facility 1 Title',
                        'type' => 'text',
                        'default' => 'Smart Classrooms',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_desc',
                        'label' => 'Facility 1 Description',
                        'type' => 'textarea',
                        'default' => 'More than 30 spacious, well-ventilated technical and smart classrooms equipped with multimedia audio-visual aids and ergonomic furniture for interactive learning.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac1_feature',
                        'label' => 'Facility 1 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Interactive AV Learning',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 2: Composite Science Labs
                    [
                        'kind' => 'image',
                        'key' => 'fac2_img',
                        'label' => 'Facility 2 Photo (Composite Science Labs)',
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
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_title',
                        'label' => 'Facility 2 Title',
                        'type' => 'text',
                        'default' => 'Composite Science Labs',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_desc',
                        'label' => 'Facility 2 Description',
                        'type' => 'textarea',
                        'default' => 'Fully equipped practical laboratories for Physics, Chemistry, and Biology adhering to HBSE standards, enabling students to perform curriculum practicals and state-level science models.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac2_feature',
                        'label' => 'Facility 2 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Physics, Chem & Bio',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 3: Modern Computer Lab
                    [
                        'kind' => 'image',
                        'key' => 'fac_comp_img',
                        'label' => 'Facility 3 Photo (Modern Computer Lab)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Modern Computer Laboratory',
                        'help' => 'Photo for computer lab.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_comp_tag',
                        'label' => 'Facility 3 Category Tag',
                        'type' => 'text',
                        'default' => 'Digital Education',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_comp_title',
                        'label' => 'Facility 3 Title',
                        'type' => 'text',
                        'default' => 'Modern Computer Lab',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_comp_desc',
                        'label' => 'Facility 3 Description',
                        'type' => 'textarea',
                        'default' => 'Dedicated IT workstation lab providing students from Primary to Senior Secondary with essential digital literacy, coding, practical typing, and computer science applications.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_comp_feature',
                        'label' => 'Facility 3 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'IT & Digital Literacy',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 4: School Library & Resource Center
                    [
                        'kind' => 'image',
                        'key' => 'fac_lib_img',
                        'label' => 'Facility 4 Photo (School Library)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'School Library & Reading Room',
                        'help' => 'Photo for library.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_lib_tag',
                        'label' => 'Facility 4 Category Tag',
                        'type' => 'text',
                        'default' => 'Resource Center',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_lib_title',
                        'label' => 'Facility 4 Title',
                        'type' => 'text',
                        'default' => 'School Library & Reading Room',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_lib_desc',
                        'label' => 'Facility 4 Description',
                        'type' => 'textarea',
                        'default' => 'A peaceful reading sanctuary housing an extensive repository of curriculum textbooks, reference guides, competitive test series, periodicals, and children literature.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_lib_feature',
                        'label' => 'Facility 4 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Enriched Reading Repository',
                        'help' => 'Bottom highlight badge.'
                    ]
                ]
            ],

            // Section 5: Sports, Wellness & Community Spaces (5 Facilities)
            [
                'title' => 'Section 5: Sports, Wellness & Community Spaces (Playground, Transport, Yoga, Exhibition, Assembly)',
                'icon'  => 'sports_soccer',
                'desc'  => 'Athletic grounds, bus transit fleet, yoga hall, innovation project hall, and morning assembly area.',
                'fields' => [
                    // Facility 5: Expansive Sports Ground
                    [
                        'kind' => 'image',
                        'key' => 'fac3_img',
                        'label' => 'Facility 5 Photo (Sports Ground & Athletics)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'Sports Ground & Athletics',
                        'help' => 'Photo for sports ground.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_tag',
                        'label' => 'Facility 5 Category Tag',
                        'type' => 'text',
                        'default' => 'Sports & Fitness',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_title',
                        'label' => 'Facility 5 Title',
                        'type' => 'text',
                        'default' => 'Expansive Sports Ground',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_desc',
                        'label' => 'Facility 5 Description',
                        'type' => 'textarea',
                        'default' => 'Spacious open athletic grounds equipped for cricket, kabaddi, volleyball, track events, wrestling, kickboxing, and daily morning drills under experienced coaches.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac3_feature',
                        'label' => 'Facility 5 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Athletics & Games',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 6: Transport Facility
                    [
                        'kind' => 'image',
                        'key' => 'fac_trans_img',
                        'label' => 'Facility 6 Photo (School Bus Transport)',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Transport Facility and Bus Fleet',
                        'help' => 'Photo for buses/transport.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_trans_tag',
                        'label' => 'Facility 6 Category Tag',
                        'type' => 'text',
                        'default' => 'Safe Commute',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_trans_title',
                        'label' => 'Facility 6 Title',
                        'type' => 'text',
                        'default' => 'Transport Transit Facility',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_trans_desc',
                        'label' => 'Facility 6 Description',
                        'type' => 'textarea',
                        'default' => 'A dependable, dedicated school bus fleet connecting Dobhi with 35+ surrounding villages and townships, operated by trained drivers and safety staff.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac_trans_feature',
                        'label' => 'Facility 6 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Doorstep Rural Routes',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 7: Yoga & Meditation Arena
                    [
                        'kind' => 'image',
                        'key' => 'fac4_img',
                        'label' => 'Facility 7 Photo (Yoga & Meditation Arena)',
                        'default' => 'assets/images/sunrise school image/yoga.webp',
                        'alt' => 'Yoga & Meditation Arena',
                        'help' => 'Photo for yoga hall.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_tag',
                        'label' => 'Facility 7 Category Tag',
                        'type' => 'text',
                        'default' => 'Mind & Body',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_title',
                        'label' => 'Facility 7 Title',
                        'type' => 'text',
                        'default' => 'Yoga & Meditation Arena',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_desc',
                        'label' => 'Facility 7 Description',
                        'type' => 'textarea',
                        'default' => 'Daily morning pranayama, Surya Namaskar, and guided mindfulness sessions helping students cultivate razor-sharp concentration and calm emotional health.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac4_feature',
                        'label' => 'Facility 7 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Daily Mindfulness & Asanas',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 8: Exhibition & Project Hall
                    [
                        'kind' => 'image',
                        'key' => 'fac5_img',
                        'label' => 'Facility 8 Photo (Exhibition & Project Hall)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Exhibition & Project Hall',
                        'help' => 'Photo for exhibition hall.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_tag',
                        'label' => 'Facility 8 Category Tag',
                        'type' => 'text',
                        'default' => 'Creative Expression',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_title',
                        'label' => 'Facility 8 Title',
                        'type' => 'text',
                        'default' => 'Exhibition & Project Hall',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_desc',
                        'label' => 'Facility 8 Description',
                        'type' => 'textarea',
                        'default' => 'Dedicated space for student science models, social science exhibitions, art displays, and community awareness presentations.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac5_feature',
                        'label' => 'Facility 8 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Science Fairs & Art Displays',
                        'help' => 'Bottom highlight badge.'
                    ],

                    // Facility 9: Morning Assembly Courtyard
                    [
                        'kind' => 'image',
                        'key' => 'fac6_img',
                        'label' => 'Facility 9 Photo (Morning Assembly Courtyard)',
                        'default' => 'assets/images/sunrise school image/children_praying.webp',
                        'alt' => 'Morning Assembly Courtyard',
                        'help' => 'Photo for assembly courtyard.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_tag',
                        'label' => 'Facility 9 Category Tag',
                        'type' => 'text',
                        'default' => 'Character & Values',
                        'help' => 'Gold category tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_title',
                        'label' => 'Facility 9 Title',
                        'type' => 'text',
                        'default' => 'Morning Assembly Courtyard',
                        'help' => 'Card heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_desc',
                        'label' => 'Facility 9 Description',
                        'type' => 'textarea',
                        'default' => 'Where the whole school unites each morning for prayers, national anthem, news recitation, inspirational speeches, and student felicitations.',
                        'help' => 'Detailed description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'fac6_feature',
                        'label' => 'Facility 9 Feature Highlight Tag',
                        'type' => 'text',
                        'default' => 'Daily Moral Assembly',
                        'help' => 'Bottom highlight badge.'
                    ]
                ]
            ],

            // Section 6: 24/7 CCTV Security, Boundary & Hygiene Standards
            [
                'title' => 'Section 6: 24/7 CCTV Security, Boundary & Hygiene Standards',
                'icon'  => 'security',
                'desc'  => 'Safety showcase photo, headline, security overview, 4 safety pillars, and campus visit action button.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'safety_img',
                        'label' => 'Campus Safety Showcase Photo',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Secure CCTV Monitored Campus',
                        'help' => 'Night/security photo for safety banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_tag',
                        'label' => 'Safety Tagline',
                        'type' => 'text',
                        'default' => 'Comprehensive Security',
                        'help' => 'Gold eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_title',
                        'label' => 'Safety Headline',
                        'type' => 'text',
                        'default' => 'CCTV Security & Campus Safety',
                        'help' => 'Section title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_desc',
                        'label' => 'Safety Description',
                        'type' => 'textarea',
                        'default' => 'Sun Rise Sr. Sec. School provides a strictly secure campus with comprehensive 24/7 CCTV surveillance covering classrooms, corridors, main gate, and playfields, complemented by secure boundary fencing, pure RO filtered water, and emergency medical kits.',
                        'help' => 'Detailed security and health description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_feat1',
                        'label' => 'Safety Feature 1 Label',
                        'type' => 'text',
                        'default' => '24/7 CCTV Cameras',
                        'help' => 'Feature 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_feat2',
                        'label' => 'Safety Feature 2 Label',
                        'type' => 'text',
                        'default' => 'Boundary Enclosure',
                        'help' => 'Feature 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_feat3',
                        'label' => 'Safety Feature 3 Label',
                        'type' => 'text',
                        'default' => 'RO Pure Water',
                        'help' => 'Feature 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_feat4',
                        'label' => 'Safety Feature 4 Label',
                        'type' => 'text',
                        'default' => 'PHC Proximity',
                        'help' => 'Feature 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_badge_text',
                        'label' => 'Safety Assurance Subtitle',
                        'type' => 'text',
                        'default' => 'Peace of Mind for Parents',
                        'help' => 'Left bottom label in safety card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_btn_text',
                        'label' => 'Safety Card Button Text',
                        'type' => 'text',
                        'default' => 'Plan a Campus Visit',
                        'help' => 'CTA button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'safety_btn_link',
                        'label' => 'Safety Card Button Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination link.'
                    ]
                ]
            ],

            // Section 7: Campus Experience & Visit Invitation CTA Banner
            [
                'title' => 'Section 7: Campus Experience & Visit Invitation CTA Banner',
                'icon'  => 'explore',
                'desc'  => 'Bottom invitation banner encouraging parents to view photo gallery or schedule an in-person tour.',
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
                        'label' => 'CTA Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Experience Sun Rise School',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'CTA Main Headline',
                        'type' => 'text',
                        'default' => 'Want to see more campus moments?',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'CTA Detailed Description',
                        'type' => 'textarea',
                        'default' => 'Browse through our full visual chronicle containing photographs from academic exhibitions, sports days, award ceremonies, and everyday school celebrations.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_text',
                        'label' => 'Button 1 Text (Gallery)',
                        'type' => 'text',
                        'default' => 'Explore Photo Gallery',
                        'help' => 'Gold button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_link',
                        'label' => 'Button 1 Target Link',
                        'type' => 'text',
                        'default' => 'gallery.php',
                        'help' => 'Gold button link.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_text',
                        'label' => 'Button 2 Text (Tour)',
                        'type' => 'text',
                        'default' => 'Book Campus Visit',
                        'help' => 'Outline button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_link',
                        'label' => 'Button 2 Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Outline button link.'
                    ]
                ]
            ]
        ]
    ],
    'events' => [
        'title' => 'Events & News',
        'icon'  => 'celebration',
        'desc'  => 'Featured Highlight Event, School News Grid, Academic Agenda, 12 Co-Curricular Functions & Hall of Fame Accolades',
        'sections' => [
            // Section 1: Featured Highlight Event Banner
            [
                'title' => 'Section 1: Featured Highlight Event Banner',
                'icon'  => 'star',
                'desc'  => 'Top featured event showcase with background banner, timing, campus venue, and visitor CTA button.',
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
                        'type' => 'textarea',
                        'default' => 'Experience the ingenuity of our students as they demonstrate live working science models, robotics experiments, sustainable agriculture concepts, and artistic creations.',
                        'help' => 'Summary text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_session_tag',
                        'label' => 'Session / Occasion Tag',
                        'type' => 'text',
                        'default' => 'Annual Session',
                        'help' => 'Left pill item under description.'
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
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_btn_text',
                        'label' => 'Hero CTA Button Text',
                        'type' => 'text',
                        'default' => 'Inquire / Visit Campus',
                        'help' => 'Action button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'featured_btn_link',
                        'label' => 'Hero CTA Button Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Action button link.'
                    ]
                ]
            ],

            // Section 2: School News & Key Highlights (Dynamic Event Cards Manager)
            [
                'title' => 'Section 2: School News & Key Highlights (Event Cards Manager)',
                'icon'  => 'newspaper',
                'desc'  => 'Add, edit, or remove news cards, event highlights, dates, tags, photos and links.',
                'type'  => 'event_news_cards',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'news_eyebrow',
                        'label' => 'News Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Happenings & Notices',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'news_heading',
                        'label' => 'News Section Main Heading',
                        'type' => 'text',
                        'default' => 'School News & Key Highlights',
                        'help' => 'Main headline.'
                    ]
                ]
            ],

            // Section 3: Academic Calendar Box & Agenda Notices
            [
                'title' => 'Section 3: Academic Calendar Box & Agenda Notices',
                'icon'  => 'calendar_month',
                'desc'  => 'Sidebar academic schedule highlight card and 3 upcoming agenda items with dates and times.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'calendar_eyebrow',
                        'label' => 'Calendar Box Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Academic Schedule',
                        'help' => 'Tag inside the blue calendar card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'calendar_title',
                        'label' => 'Calendar Box Heading',
                        'type' => 'text',
                        'default' => 'School Calendar',
                        'help' => 'Sidebar calendar title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'calendar_desc',
                        'label' => 'Calendar Box Description',
                        'type' => 'textarea',
                        'default' => 'Check term schedules, periodic unit tests, quarterly assessments, board pre-boards, and gazetted school holidays.',
                        'help' => 'Calendar summary.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'calendar_file_img',
                        'label' => 'Upload School Calendar Image / PDF (For Download)',
                        'default' => '',
                        'alt' => 'Sun Rise School Academic Calendar',
                        'help' => 'Upload your academic calendar image or schedule here. When visitors click the button on events.php, this calendar file will be downloaded to their device.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'calendar_btn_text',
                        'label' => 'Calendar Box Button Text',
                        'type' => 'text',
                        'default' => 'Download School Calendar',
                        'help' => 'Calendar CTA button label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'calendar_btn_link',
                        'label' => 'Calendar Alternative Target Link (Optional if Image Uploaded)',
                        'type' => 'text',
                        'default' => 'academics.php',
                        'help' => 'Fallback link if no image is uploaded.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda_heading',
                        'label' => 'Agenda Card Main Heading',
                        'type' => 'text',
                        'default' => 'Upcoming Agenda',
                        'help' => 'Heading of agenda mini-list.'
                    ],

                    // Agenda 1
                    [
                        'kind' => 'text',
                        'key' => 'agenda1_date',
                        'label' => 'Agenda 1 Date (e.g. 10 OCT)',
                        'type' => 'text',
                        'default' => '10 OCT',
                        'help' => 'Day & Month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda1_title',
                        'label' => 'Agenda 1 Title',
                        'type' => 'text',
                        'default' => 'Parent-Teacher Meeting (PTM)',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda1_time',
                        'label' => 'Agenda 1 Time / Schedule',
                        'type' => 'text',
                        'default' => '09:00 AM - 01:00 PM',
                        'help' => 'Time.'
                    ],

                    // Agenda 2
                    [
                        'kind' => 'text',
                        'key' => 'agenda2_date',
                        'label' => 'Agenda 2 Date (e.g. 14 NOV)',
                        'type' => 'text',
                        'default' => '14 NOV',
                        'help' => 'Day & Month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda2_title',
                        'label' => 'Agenda 2 Title',
                        'type' => 'text',
                        'default' => "Children's Day Cultural Fest",
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda2_time',
                        'label' => 'Agenda 2 Time / Schedule',
                        'type' => 'text',
                        'default' => 'Full School Day',
                        'help' => 'Time.'
                    ],

                    // Agenda 3
                    [
                        'kind' => 'text',
                        'key' => 'agenda3_date',
                        'label' => 'Agenda 3 Date (e.g. 22 DEC)',
                        'type' => 'text',
                        'default' => '22 DEC',
                        'help' => 'Day & Month.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda3_title',
                        'label' => 'Agenda 3 Title',
                        'type' => 'text',
                        'default' => 'National Mathematics Day Quiz',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda3_time',
                        'label' => 'Agenda 3 Time / Schedule',
                        'type' => 'text',
                        'default' => '10:00 AM - 12:30 PM',
                        'help' => 'Time.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda_footer_text',
                        'label' => 'Agenda Footer Inquiry Link Text',
                        'type' => 'text',
                        'default' => 'Contact School Office for Inquiries →',
                        'help' => 'Bottom link label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'agenda_footer_link',
                        'label' => 'Agenda Footer Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Bottom link destination.'
                    ]
                ]
            ],

            // Section 4: Functions & Student Co-Curricular Activities (12 Cards)
            [
                'title' => 'Section 4: Functions & Student Co-Curricular Activities (12 Cards)',
                'icon'  => 'theater_comedy',
                'desc'  => 'Header details and custom titles/descriptions for all 12 co-curricular school function cards.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'functions_eyebrow',
                        'label' => 'Functions Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Holistic Development',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'functions_heading',
                        'label' => 'Functions Section Main Heading',
                        'type' => 'text',
                        'default' => 'Functions & Student Activities',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'functions_desc',
                        'label' => 'Functions Section Overview Subtitle',
                        'type' => 'textarea',
                        'default' => 'From cultural pageants and annual sports meets to science exhibitions and academic olympiads, our students flourish across a vibrant calendar of events.',
                        'help' => 'Overview description.'
                    ],

                    // 1. Annual Function
                    [
                        'kind' => 'text',
                        'key' => 'func1_title',
                        'label' => 'Function 1 Title',
                        'type' => 'text',
                        'default' => 'Annual Function',
                        'help' => 'Card 1 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func1_desc',
                        'label' => 'Function 1 Description',
                        'type' => 'text',
                        'default' => 'Grand cultural showcase featuring theatrical acts, music, and dance.',
                        'help' => 'Card 1 description.'
                    ],

                    // 2. Result Declaration Day
                    [
                        'kind' => 'text',
                        'key' => 'func2_title',
                        'label' => 'Function 2 Title',
                        'type' => 'text',
                        'default' => 'Result Declaration Day',
                        'help' => 'Card 2 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func2_desc',
                        'label' => 'Function 2 Description',
                        'type' => 'text',
                        'default' => 'Annual academic felicitation day honoring class and board rankers.',
                        'help' => 'Card 2 description.'
                    ],

                    // 3. Annual Sports Meet
                    [
                        'kind' => 'text',
                        'key' => 'func3_title',
                        'label' => 'Function 3 Title',
                        'type' => 'text',
                        'default' => 'Annual Sports Meet',
                        'help' => 'Card 3 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func3_desc',
                        'label' => 'Function 3 Description',
                        'type' => 'text',
                        'default' => 'Inter-house track and field competitions, relay races, and games.',
                        'help' => 'Card 3 description.'
                    ],

                    // 4. Cultural Fest
                    [
                        'kind' => 'text',
                        'key' => 'func4_title',
                        'label' => 'Function 4 Title',
                        'type' => 'text',
                        'default' => 'Cultural Fest',
                        'help' => 'Card 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func4_desc',
                        'label' => 'Function 4 Description',
                        'type' => 'text',
                        'default' => 'Folk traditions, patriotic celebrations, skits, and instrumental music.',
                        'help' => 'Card 4 description.'
                    ],

                    // 5. Farewell Ceremony
                    [
                        'kind' => 'text',
                        'key' => 'func5_title',
                        'label' => 'Function 5 Title',
                        'type' => 'text',
                        'default' => 'Farewell Ceremony',
                        'help' => 'Card 5 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func5_desc',
                        'label' => 'Function 5 Description',
                        'type' => 'text',
                        'default' => 'Blessings, mentorship, and warm send-off for passing-out Class 12 batches.',
                        'help' => 'Card 5 description.'
                    ],

                    // 6. Alumni Meet
                    [
                        'kind' => 'text',
                        'key' => 'func6_title',
                        'label' => 'Function 6 Title',
                        'type' => 'text',
                        'default' => 'Alumni Meet',
                        'help' => 'Card 6 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func6_desc',
                        'label' => 'Function 6 Description',
                        'type' => 'text',
                        'default' => 'Reconnecting former students serving in administration, defence, and academia.',
                        'help' => 'Card 6 description.'
                    ],

                    // 7. Quiz Competition
                    [
                        'kind' => 'text',
                        'key' => 'func7_title',
                        'label' => 'Function 7 Title',
                        'type' => 'text',
                        'default' => 'Quiz Competition',
                        'help' => 'Card 7 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func7_desc',
                        'label' => 'Function 7 Description',
                        'type' => 'text',
                        'default' => 'Block and district level GK, science, and history quiz contests.',
                        'help' => 'Card 7 description.'
                    ],

                    // 8. Science Exhibition
                    [
                        'kind' => 'text',
                        'key' => 'func8_title',
                        'label' => 'Function 8 Title',
                        'type' => 'text',
                        'default' => 'Science Exhibition',
                        'help' => 'Card 8 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func8_desc',
                        'label' => 'Function 8 Description',
                        'type' => 'text',
                        'default' => 'Interactive working models in robotics, physics, ecology, and chemistry.',
                        'help' => 'Card 8 description.'
                    ],

                    // 9. Rangoli Competitions
                    [
                        'kind' => 'text',
                        'key' => 'func9_title',
                        'label' => 'Function 9 Title',
                        'type' => 'text',
                        'default' => 'Rangoli Competitions',
                        'help' => 'Card 9 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func9_desc',
                        'label' => 'Function 9 Description',
                        'type' => 'text',
                        'default' => 'Festive creativity celebrating Indian heritage, colors, and art forms.',
                        'help' => 'Card 9 description.'
                    ],

                    // 10. Debate Competitions
                    [
                        'kind' => 'text',
                        'key' => 'func10_title',
                        'label' => 'Function 10 Title',
                        'type' => 'text',
                        'default' => 'Debate Competitions',
                        'help' => 'Card 10 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func10_desc',
                        'label' => 'Function 10 Description',
                        'type' => 'text',
                        'default' => 'Honing articulate expression, critical thinking, and public speaking.',
                        'help' => 'Card 10 description.'
                    ],

                    // 11. Olympiad Participation
                    [
                        'kind' => 'text',
                        'key' => 'func11_title',
                        'label' => 'Function 11 Title',
                        'type' => 'text',
                        'default' => 'Olympiad Participation',
                        'help' => 'Card 11 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func11_desc',
                        'label' => 'Function 11 Description',
                        'type' => 'text',
                        'default' => 'National science, mathematics, and cyber olympiad competitive testing.',
                        'help' => 'Card 11 description.'
                    ],

                    // 12. Educational Seminars & Tours
                    [
                        'kind' => 'text',
                        'key' => 'func12_title',
                        'label' => 'Function 12 Title',
                        'type' => 'text',
                        'default' => 'Seminars & Tours',
                        'help' => 'Card 12 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'func12_desc',
                        'label' => 'Function 12 Description',
                        'type' => 'text',
                        'default' => 'Career guidance workshops and educational excursions to historic and scientific sites.',
                        'help' => 'Card 12 description.'
                    ]
                ]
            ],

            // Section 5: Hall of Fame — Sports Achievements
            [
                'title' => 'Section 5: Hall of Fame — Sports Achievements (4 Honors)',
                'icon'  => 'trophy',
                'desc'  => 'Card headers, medals, championship titles, and achievement descriptions for state & national athletics.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'sports_achieve_tag',
                        'label' => 'Sports Card Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'State & National Honors',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_achieve_title',
                        'label' => 'Sports Card Main Heading',
                        'type' => 'text',
                        'default' => 'Sports Achievements',
                        'help' => 'Headline.'
                    ],

                    // Sports Item 1
                    [
                        'kind' => 'text',
                        'key' => 'sports_item1_badge',
                        'label' => 'Honor 1 Medal Emoji/Icon',
                        'type' => 'text',
                        'default' => '🥇',
                        'help' => 'Medal emoji or badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item1_sub',
                        'label' => 'Honor 1 Year & Championship Name',
                        'type' => 'text',
                        'default' => '2023 • National Sub-Junior Wrestling Championship',
                        'help' => 'Championship headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item1_title',
                        'label' => 'Honor 1 Medal Count / Position',
                        'type' => 'text',
                        'default' => '2 Gold Medals',
                        'help' => 'Position won.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item1_desc',
                        'label' => 'Honor 1 Summary Description',
                        'type' => 'text',
                        'default' => 'Outstanding national glory in sub-junior wrestling representing Haryana.',
                        'help' => 'Honor summary.'
                    ],

                    // Sports Item 2
                    [
                        'kind' => 'text',
                        'key' => 'sports_item2_badge',
                        'label' => 'Honor 2 Medal Emoji/Icon',
                        'type' => 'text',
                        'default' => '🥈',
                        'help' => 'Medal emoji or badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item2_sub',
                        'label' => 'Honor 2 Year & Championship Name',
                        'type' => 'text',
                        'default' => '2018 & 2019 • State Level Kickboxing Championship',
                        'help' => 'Championship headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item2_title',
                        'label' => 'Honor 2 Medal Count / Position',
                        'type' => 'text',
                        'default' => '2 Silver Medals & 1 Bronze Medal (2018)',
                        'help' => 'Position won.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item2_desc',
                        'label' => 'Honor 2 Summary Description',
                        'type' => 'text',
                        'default' => 'Continuous podium finishes at the Haryana State Kickboxing Tournaments.',
                        'help' => 'Honor summary.'
                    ],

                    // Sports Item 3
                    [
                        'kind' => 'text',
                        'key' => 'sports_item3_badge',
                        'label' => 'Honor 3 Medal Emoji/Icon',
                        'type' => 'text',
                        'default' => '🥉',
                        'help' => 'Medal emoji or badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item3_sub',
                        'label' => 'Honor 3 Year & Championship Name',
                        'type' => 'text',
                        'default' => '2017 • District Kickboxing Tournament',
                        'help' => 'Championship headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item3_title',
                        'label' => 'Honor 3 Medal Count / Position',
                        'type' => 'text',
                        'default' => '1 Bronze Medal',
                        'help' => 'Position won.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item3_desc',
                        'label' => 'Honor 3 Summary Description',
                        'type' => 'text',
                        'default' => 'Remarkable district level combat sports victory in Hisar.',
                        'help' => 'Honor summary.'
                    ],

                    // Sports Item 4
                    [
                        'kind' => 'text',
                        'key' => 'sports_item4_badge',
                        'label' => 'Honor 4 Medal Emoji/Icon',
                        'type' => 'text',
                        'default' => '🏃',
                        'help' => 'Medal emoji or badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item4_sub',
                        'label' => 'Honor 4 Year & Championship Name',
                        'type' => 'text',
                        'default' => '2014, 2015 & 2016 • SPAT Athletic Competition',
                        'help' => 'Championship headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item4_title',
                        'label' => 'Honor 4 Medal Count / Position',
                        'type' => 'text',
                        'default' => '5 Students Selected in Sports Physical Aptitude Test',
                        'help' => 'Position won.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_item4_desc',
                        'label' => 'Honor 4 Summary Description',
                        'type' => 'text',
                        'default' => 'Selected for government athletic sponsorship through rigorous athletic testing.',
                        'help' => 'Honor summary.'
                    ],

                    [
                        'kind' => 'text',
                        'key' => 'sports_achieve_footer',
                        'label' => 'Sports Card Footer Disciplines Note',
                        'type' => 'text',
                        'default' => 'Disciplines: Wrestling • Kickboxing • Athletics',
                        'help' => 'Left bottom label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_achieve_link_text',
                        'label' => 'Sports Card Link Text',
                        'type' => 'text',
                        'default' => 'Sports Ground →',
                        'help' => 'Right bottom link text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'sports_achieve_link_url',
                        'label' => 'Sports Card Target Link',
                        'type' => 'text',
                        'default' => 'campus.php#sports',
                        'help' => 'Right bottom destination.'
                    ]
                ]
            ],

            // Section 6: Hall of Fame — Institutional & Academic Awards
            [
                'title' => 'Section 6: Hall of Fame — Institutional & Academic Awards (4 Accolades)',
                'icon'  => 'workspace_premium',
                'desc'  => 'Titles, prize positions, and recognition details for institutional competitions and science fairs.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'school_awards_tag',
                        'label' => 'Awards Card Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Institutional Triumphs',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'school_awards_title',
                        'label' => 'Awards Card Main Heading',
                        'type' => 'text',
                        'default' => 'Awards Achieved by School',
                        'help' => 'Headline.'
                    ],

                    // Award 1
                    [
                        'kind' => 'text',
                        'key' => 'award_item1_badge',
                        'label' => 'Award 1 Star/Icon',
                        'type' => 'text',
                        'default' => '★',
                        'help' => 'Badge icon.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item1_sub',
                        'label' => 'Award 1 Year & Competition Name',
                        'type' => 'text',
                        'default' => '2022 • Block Level Quiz Competition',
                        'help' => 'Event name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item1_title',
                        'label' => 'Award 1 Position Won',
                        'type' => 'text',
                        'default' => '1st Position / Winner',
                        'help' => 'Rank/Position.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item1_desc',
                        'label' => 'Award 1 Summary Description',
                        'type' => 'text',
                        'default' => 'Outperformed top regional institutions with deep general awareness and speed.',
                        'help' => 'Summary.'
                    ],

                    // Award 2
                    [
                        'kind' => 'text',
                        'key' => 'award_item2_badge',
                        'label' => 'Award 2 Star/Icon',
                        'type' => 'text',
                        'default' => '★',
                        'help' => 'Badge icon.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item2_sub',
                        'label' => 'Award 2 Year & Competition Name',
                        'type' => 'text',
                        'default' => '2017 • Talent Search Examination (Block Level)',
                        'help' => 'Event name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item2_title',
                        'label' => 'Award 2 Position Won',
                        'type' => 'text',
                        'default' => 'Winner & Rural Topper • 1st, 2nd & 3rd Positions',
                        'help' => 'Rank/Position.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item2_desc',
                        'label' => 'Award 2 Summary Description',
                        'type' => 'text',
                        'default' => 'Swept top 3 ranks among participants from more than 25 schools and over 1,500 students.',
                        'help' => 'Summary.'
                    ],

                    // Award 3
                    [
                        'kind' => 'text',
                        'key' => 'award_item3_badge',
                        'label' => 'Award 3 Star/Icon',
                        'type' => 'text',
                        'default' => '★',
                        'help' => 'Badge icon.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item3_sub',
                        'label' => 'Award 3 Year & Competition Name',
                        'type' => 'text',
                        'default' => '2016 • Physics Point Prize Test',
                        'help' => 'Event name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item3_title',
                        'label' => 'Award 3 Position Won',
                        'type' => 'text',
                        'default' => 'Best School Award • 10 Students in Top 200',
                        'help' => 'Rank/Position.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item3_desc',
                        'label' => 'Award 3 Summary Description',
                        'type' => 'text',
                        'default' => 'Conferred Best School Award; 10 students ranked within top 200 out of 2,700+ participants.',
                        'help' => 'Summary.'
                    ],

                    // Award 4
                    [
                        'kind' => 'text',
                        'key' => 'award_item4_badge',
                        'label' => 'Award 4 Star/Icon',
                        'type' => 'text',
                        'default' => '★',
                        'help' => 'Badge icon.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item4_sub',
                        'label' => 'Award 4 Year & Competition Name',
                        'type' => 'text',
                        'default' => '2013 • Science Exhibition at CCSHAU, Hisar',
                        'help' => 'Event name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item4_title',
                        'label' => 'Award 4 Position Won',
                        'type' => 'text',
                        'default' => 'State Level Selection (2 Students)',
                        'help' => 'Rank/Position.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'award_item4_desc',
                        'label' => 'Award 4 Summary Description',
                        'type' => 'text',
                        'default' => 'Recognized for innovative scientific project design and state-level representation.',
                        'help' => 'Summary.'
                    ],

                    [
                        'kind' => 'text',
                        'key' => 'school_awards_footer',
                        'label' => 'Awards Card Footer Pass Record Note',
                        'type' => 'text',
                        'default' => 'Board Examination: 100% Pass Record',
                        'help' => 'Left bottom label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'school_awards_link_text',
                        'label' => 'Awards Card Link Text',
                        'type' => 'text',
                        'default' => 'View Board Toppers →',
                        'help' => 'Right bottom link text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'school_awards_link_url',
                        'label' => 'Awards Card Target Link',
                        'type' => 'text',
                        'default' => 'academics.php#toppers',
                        'help' => 'Right bottom destination.'
                    ]
                ]
            ]
        ]
    ],
    'faculty' => [
        'title' => 'Faculty & Staff',
        'icon'  => 'groups',
        'desc'  => 'Complete Faculty Page Control: SEO Meta, Hero Banner, 6 Staff Gallery Photos & Badges, 4 Academic Faculties, and Recruitment CTA',
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
            // Section 2: Faculty Showcase & Story (Horizontal Image & Narrative)
            [
                'title' => 'Section 2: Faculty Showcase & Story (Horizontal Image & Narrative)',
                'icon'  => 'badge',
                'desc'  => 'Configure the faculty showcase horizontal image, heading, badge, and descriptive paragraphs with expandable Read More support.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'staff_section_eyebrow',
                        'label' => 'Showcase Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Our Teaching Force',
                        'help' => 'Small uppercase gold text above title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_section_title',
                        'label' => 'Showcase Heading / Title',
                        'type' => 'text',
                        'default' => 'Mentors in Action',
                        'help' => 'Main showcase heading.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_showcase_img',
                        'label' => 'Faculty Showcase Landscape Photo',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Teaching Faculty - Sun Rise Sr. Sec. School',
                        'help' => 'Upload horizontal/landscape group photo of the teaching staff.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_badge',
                        'label' => 'Image Badge (Overlay)',
                        'type' => 'text',
                        'default' => 'Dedicated Faculty',
                        'help' => 'Gold category badge on the bottom-left of the photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_story_p1',
                        'label' => 'Faculty Story Paragraph 1',
                        'type' => 'html',
                        'default' => 'At Sun Rise Sr. Sec. School, our faculty represents a dedicated team of passionate educators, subject specialists, and compassionate mentors committed to nurturing every student\'s intellectual, creative, and moral growth.',
                        'help' => 'First story paragraph visible upfront.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_story_p2',
                        'label' => 'Faculty Story Paragraph 2',
                        'type' => 'html',
                        'default' => 'Our teachers combine traditional pedagogical rigor with modern interactive teaching techniques, ensuring students develop conceptual clarity, critical thinking, and confidence in every academic discipline.',
                        'help' => 'Second story paragraph visible upfront.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_story_p3',
                        'label' => 'Faculty Story Paragraph 3 (Read More)',
                        'type' => 'html',
                        'default' => 'Through personalized guidance, regular remedial sessions, and co-curricular mentorship, our educators foster a vibrant learning environment where curiosity thrives and values endure.',
                        'help' => 'Additional narrative paragraph (appears under Read More button).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_story_p4',
                        'label' => 'Faculty Story Paragraph 4 (Read More)',
                        'type' => 'html',
                        'default' => '',
                        'help' => 'Optional fourth story paragraph (appears under Read More button).'
                    ]
                ]
            ],
            // Section 3: Academic Departments & Subject Faculties (4 Disciplines)
            [
                'title' => 'Section 3: Academic Departments & Subject Faculties (4 Disciplines)',
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
                        'label' => 'Dept 3 Icon (e.g. trending_up, account_balance)',
                        'type' => 'text',
                        'default' => 'trending_up',
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
            // Section 4: Join Our Teaching Team CTA
            [
                'title' => 'Section 4: Join Our Teaching Team CTA Banner',
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
                        'help' => 'Destination URL (e.g. contact-us.php).'
                    ]
                ]
            ]
        ]
    ],
    'gallery' => [
        'title' => 'Photo Gallery',
        'icon'  => 'photo_library',
        'desc'  => 'Hero Banner, Visual Stats Strip, Filter Bar Intro, 12 High-Res Showcase Cards, Campus Life Highlights & Visit CTA',
        'sections' => [
            // Section 1: Hero Banner & Quick Actions
            [
                'title' => 'Section 1: Hero Banner & Quick Actions',
                'icon'  => 'flag',
                'desc'  => 'Main header background banner, eyebrow badge, headline, subtitle, archive badge, and CTA buttons.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Gallery Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/exhibition1.webp',
                        'alt' => 'Visual Chronicle Banner',
                        'help' => 'Top background image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Visual Chronicle',
                        'help' => 'Badge tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Gallery Main Heading',
                        'type' => 'text',
                        'default' => 'Life & Moments at Sun Rise School',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Gallery Subtitle Description',
                        'type' => 'textarea',
                        'default' => 'Explore photographs capturing academic curiosity, hands-on science exhibitions, athletic triumphs, yoga mornings, and merit celebrations across our Dobhi campus.',
                        'help' => 'Description paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_archive_badge',
                        'label' => 'Hero Archive Pill Badge',
                        'type' => 'text',
                        'default' => 'Official School Photo Archive • 100+ High-Resolution Moments',
                        'help' => 'Pill text above/below description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_text',
                        'label' => 'Hero Primary Action Button Text',
                        'type' => 'text',
                        'default' => 'Browse Photo Categories',
                        'help' => 'Scroll to filter bar.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn1_link',
                        'label' => 'Hero Primary Action Button Link',
                        'type' => 'text',
                        'default' => '#gallery-filters',
                        'help' => 'Destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_text',
                        'label' => 'Hero Secondary Action Button Text',
                        'type' => 'text',
                        'default' => 'Schedule Campus Visit',
                        'help' => 'Secondary CTA.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn2_link',
                        'label' => 'Hero Secondary Action Button Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination.'
                    ]
                ]
            ],

            // Section 2: Campus Visual Metrics Strip
            [
                'title' => 'Section 2: Campus Visual Metrics Strip (4 Highlights)',
                'icon'  => 'speed',
                'desc'  => 'Prominent 4-metric statistics strip floating beneath the hero section.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Metric 1 Value',
                        'type' => 'text',
                        'default' => '1,200+',
                        'help' => 'Stat 1 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Metric 1 Label',
                        'type' => 'text',
                        'default' => 'Active Students',
                        'help' => 'Stat 1 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Metric 2 Value',
                        'type' => 'text',
                        'default' => '25+',
                        'help' => 'Stat 2 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Metric 2 Label',
                        'type' => 'text',
                        'default' => 'Annual Events & Fests',
                        'help' => 'Stat 2 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Metric 3 Value',
                        'type' => 'text',
                        'default' => '5+ Acres',
                        'help' => 'Stat 3 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Metric 3 Label',
                        'type' => 'text',
                        'default' => 'Lush Green Campus',
                        'help' => 'Stat 3 description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Metric 4 Value',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Stat 4 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Metric 4 Label',
                        'type' => 'text',
                        'default' => 'Memorable Moments',
                        'help' => 'Stat 4 description.'
                    ]
                ]
            ],

            // Section 3: Photo Directory Overview & Category Navigation
            [
                'title' => 'Section 3: Photo Directory Overview & Category Navigation',
                'icon'  => 'filter_list',
                'desc'  => 'Header eyebrow, title, and descriptive narrative introducing the category filter buttons.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'gallery_intro_eyebrow',
                        'label' => 'Directory Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Curated Photographic Archive',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_intro_title',
                        'label' => 'Directory Main Heading',
                        'type' => 'text',
                        'default' => 'Moments That Define Our School',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_intro_desc',
                        'label' => 'Directory Overview Description',
                        'type' => 'textarea',
                        'default' => 'Filter by category to explore cultural fests, annual result declaration days, school activities, academic competitions, Diwali celebrations, and media coverage.',
                        'help' => 'Summary text.'
                    ]
                ]
            ],

            // Section 4: Category — Media Coverage
            [
                'title'   => 'Category 1: Media Coverage',
                'icon'    => 'newspaper',
                'desc'    => 'Add or manage Media Coverage photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'media',
                'fields'  => []
            ],

            // Section 5: Category — Annual Result Declaration Day
            [
                'title'   => 'Category 2: Annual Result Declaration Day',
                'icon'    => 'workspace_premium',
                'desc'    => 'Add or manage Annual Result Declaration Day photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'result',
                'fields'  => []
            ],

            // Section 6: Category — Cultural Fest
            [
                'title'   => 'Category 3: Cultural Fest',
                'icon'    => 'celebration',
                'desc'    => 'Add or manage Cultural Fest photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'cultural',
                'fields'  => []
            ],

            // Section 7: Category — School Activity
            [
                'title'   => 'Category 4: School Activity',
                'icon'    => 'sports_kabaddi',
                'desc'    => 'Add or manage School Activity photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'activity',
                'fields'  => []
            ],

            // Section 8: Category — Competition
            [
                'title'   => 'Category 5: Competition',
                'icon'    => 'emoji_events',
                'desc'    => 'Add or manage Competition photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'competition',
                'fields'  => []
            ],

            // Section 9: Category — Diwali Celebration
            [
                'title'   => 'Category 6: Diwali Celebration',
                'icon'    => 'festival',
                'desc'    => 'Add or manage Diwali Celebration photo cards. Each card only requires an image and a single heading.',
                'type'    => 'gallery_category',
                'cat_key' => 'diwali',
                'fields'  => []
            ],

            // Section 10: Campus Life Highlights & Traditions
            [
                'title' => 'Section 10: Campus Life Highlights & Traditions (3 Feature Pillars)',
                'icon'  => 'auto_stories',
                'desc'  => 'Header titles and 3 holistic student experience cards covering prayer assemblies, fests, and sports.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'life_eyebrow',
                        'label' => 'Life Section Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Holistic Student Experience',
                        'help' => 'Eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life_heading',
                        'label' => 'Life Section Main Heading',
                        'type' => 'text',
                        'default' => 'Vibrant Campus Life Beyond Classrooms',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life_desc',
                        'label' => 'Life Section Subtitle Description',
                        'type' => 'textarea',
                        'default' => 'At Sun Rise School, education flourishes through daily morning assemblies, active sports clubs, cultural celebrations, and community values.',
                        'help' => 'Summary.'
                    ],

                    // Life Pillar 1
                    [
                        'kind' => 'text',
                        'key' => 'life1_icon',
                        'label' => 'Pillar 1 Material Icon Name',
                        'type' => 'text',
                        'default' => 'self_improvement',
                        'help' => 'e.g. self_improvement, school, groups'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life1_title',
                        'label' => 'Pillar 1 Title',
                        'type' => 'text',
                        'default' => 'Morning Assembly & Moral Values',
                        'help' => 'Pillar 1 Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life1_desc',
                        'label' => 'Pillar 1 Description',
                        'type' => 'textarea',
                        'default' => 'Daily prayer, news recitation, motivational thought sharing, and patriotic anthems shaping disciplined character.',
                        'help' => 'Pillar 1 summary.'
                    ],

                    // Life Pillar 2
                    [
                        'kind' => 'text',
                        'key' => 'life2_icon',
                        'label' => 'Pillar 2 Material Icon Name',
                        'type' => 'text',
                        'default' => 'celebration',
                        'help' => 'e.g. celebration, theater_comedy, sports_score'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life2_title',
                        'label' => 'Pillar 2 Title',
                        'type' => 'text',
                        'default' => 'Annual Cultural Pageants & Fests',
                        'help' => 'Pillar 2 Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life2_desc',
                        'label' => 'Pillar 2 Description',
                        'type' => 'textarea',
                        'default' => 'Theatrical productions, folk dance performances, music recitals, and national festival celebrations on campus.',
                        'help' => 'Pillar 2 summary.'
                    ],

                    // Life Pillar 3
                    [
                        'kind' => 'text',
                        'key' => 'life3_icon',
                        'label' => 'Pillar 3 Material Icon Name',
                        'type' => 'text',
                        'default' => 'sports_gymnastics',
                        'help' => 'e.g. sports_gymnastics, sports_soccer, trophy'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life3_title',
                        'label' => 'Pillar 3 Title',
                        'type' => 'text',
                        'default' => 'Inter-House Athletics & Yoga Drills',
                        'help' => 'Pillar 3 Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'life3_desc',
                        'label' => 'Pillar 3 Description',
                        'type' => 'textarea',
                        'default' => 'Dedicated sports periods, athletics conditioning, yoga asanas, and district-level tournament coaching.',
                        'help' => 'Pillar 3 summary.'
                    ]
                ]
            ],

            // Section 6: Guided Campus Tour & Visit Invitation CTA Banner
            [
                'title' => 'Section 6: Guided Campus Tour & Visit Invitation CTA Banner',
                'icon'  => 'tour',
                'desc'  => 'Full-width bottom invitation banner with background image, title, and action buttons.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'cta_bg',
                        'label' => 'CTA Background Image',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Campus Evening View',
                        'help' => 'Banner background image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_eyebrow',
                        'label' => 'CTA Eyebrow Tag',
                        'type' => 'text',
                        'default' => 'Experience In Person',
                        'help' => 'Small tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'CTA Headline Title',
                        'type' => 'text',
                        'default' => 'Witness the Vibrant Energy of Sun Rise School',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'CTA Description Paragraph',
                        'type' => 'textarea',
                        'default' => 'Photographs only tell part of the story. Visit our Dobhi campus to experience our smart classrooms, open playgrounds, science labs, and meet our teachers.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_text',
                        'label' => 'CTA Button 1 Label (Primary)',
                        'type' => 'text',
                        'default' => 'Schedule Campus Visit',
                        'help' => 'Primary button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_link',
                        'label' => 'CTA Button 1 Target Link',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_text',
                        'label' => 'CTA Button 2 Label (Secondary)',
                        'type' => 'text',
                        'default' => 'Admissions Information',
                        'help' => 'Secondary button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn2_link',
                        'label' => 'CTA Button 2 Target Link',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Destination.'
                    ]
                ]
            ]
        ]
    ],
    'alumni' => [
        'title' => 'Alumni Page',
        'icon'  => 'diversity_3',
        'desc'  => 'Hero Banner, 4 Stat Milestones, Dynamic Alumni Success Profile Cards (Add & Delete), and Reconnect CTA Banner',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Milestones Stat Strip',
                'icon'  => 'flag',
                'desc'  => 'Top hero background image, badge tag, main headline, description, and 4 statistical highlight counters matching About Us.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Alumni Page Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'Sun Rise School Alumni Network',
                        'help' => 'Top background image on alumni.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Badge / Tagline',
                        'type' => 'text',
                        'default' => 'Our Global Legacy & Pride',
                        'help' => 'Small rounded badge at top of hero banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Hero Main Heading',
                        'type' => 'text',
                        'default' => 'Sun Rise Alumni Network',
                        'help' => 'Main headline on alumni.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Subtitle / Overview',
                        'type' => 'text',
                        'default' => 'Celebrating the journeys, accomplishments, and inspiring contributions of our past students excelling across defence, medicine, technology, academia, and public service worldwide.',
                        'help' => 'Hero subtitle paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Figure',
                        'type' => 'text',
                        'default' => '2007',
                        'help' => 'First counter number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Year Established',
                        'help' => 'First counter label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Figure',
                        'type' => 'text',
                        'default' => '1500+',
                        'help' => 'Second counter number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Graduated Alumni',
                        'help' => 'Second counter label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Figure',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Third counter number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Board Pass Record',
                        'help' => 'Third counter label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Figure',
                        'type' => 'text',
                        'default' => '50+',
                        'help' => 'Fourth counter number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'Global Careers & Fields',
                        'help' => 'Fourth counter label.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Dynamic Alumni Profile Cards (Add / Remove)',
                'icon'  => 'groups',
                'desc'  => 'Add and manage alumni success story cards. Each card includes photo, name, batch year, current role, university/organization, memory quote, and LinkedIn/profile link.',
                'type'  => 'alumni_cards',
                'fields' => []
            ],
            [
                'title' => 'Section 3: Reconnect & Join Network CTA Banner',
                'icon'  => 'campaign',
                'desc'  => 'Bottom banner encouraging past students to get in touch, submit profiles, or connect on WhatsApp.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'cta_title',
                        'label' => 'CTA Heading',
                        'type' => 'text',
                        'default' => 'Are You a Sun Rise Alumnus?',
                        'help' => 'Title of the bottom call to action banner.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'CTA Description',
                        'type' => 'text',
                        'default' => 'Join our official alumni network to mentor graduating batches, attend annual reunions, and share your inspiring career milestones with your alma mater.',
                        'help' => 'Description text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_text',
                        'label' => 'CTA Button Text',
                        'type' => 'text',
                        'default' => 'Submit Alumni Profile',
                        'help' => 'Button text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_btn1_url',
                        'label' => 'CTA Button URL',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Button link target.'
                    ]
                ]
            ]
        ]
    ],
    'contact' => [
        'title' => 'Contact Us',
        'icon'  => 'contact_support',
        'desc'  => 'Hero Banner, Inquiry Form, Office Hours, 4 Department Desks, Interactive Google Map, WhatsApp Banner & FAQ Accordion',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Quick Contact Links',
                'icon'  => 'flag',
                'desc'  => 'Top banner image, badge, headline, subtitle, quick info pill badges, and direct call-to-action button.',
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
                        'help' => 'Top pill tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Contact Page Title',
                        'type' => 'text',
                        'default' => 'Connect with Sun Rise School',
                        'help' => 'Main headline on contact page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Contact Subtitle',
                        'type' => 'textarea',
                        'default' => 'We welcome parents, prospective students, and guardians to visit our campus or get in touch for admissions, bus routes, and general inquiries.',
                        'help' => 'Intro text for contact page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_pill1_text',
                        'label' => 'Hero Contact Pill 1',
                        'type' => 'text',
                        'default' => 'Dobhi, Hisar (Haryana)',
                        'help' => 'Location pill badge in hero.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_pill2_text',
                        'label' => 'Hero Contact Pill 2',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Phone helpline pill in hero.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_pill3_text',
                        'label' => 'Hero Contact Pill 3',
                        'type' => 'text',
                        'default' => 'Mon–Sat: 8:00 AM – 2:30 PM',
                        'help' => 'Timings pill in hero.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn_text',
                        'label' => 'Hero CTA Button Text',
                        'type' => 'text',
                        'default' => 'Send an Online Message',
                        'help' => 'CTA button label scrolling to inquiry form.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_btn_link',
                        'label' => 'Hero CTA Button Anchor/Link',
                        'type' => 'text',
                        'default' => '#inquiry-form',
                        'help' => 'Target anchor or URL for hero button.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Inquiry Desk & Contact Form Header',
                'icon'  => 'mail',
                'desc'  => 'Form eyebrow tag, main heading, explanatory note, submit button label, and submission confirmation message.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'form_eyebrow',
                        'label' => 'Form Eyebrow',
                        'type' => 'text',
                        'default' => 'Inquiry Desk',
                        'help' => 'Small uppercase tag above form title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_heading',
                        'label' => 'Form Heading',
                        'type' => 'text',
                        'default' => 'Send Us a Message',
                        'help' => 'Main heading for the contact form.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_desc',
                        'label' => 'Form Description',
                        'type' => 'textarea',
                        'default' => 'Fill out the quick form below and our administrative team will respond to your queries promptly.',
                        'help' => 'Helpful note above the form fields.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_btn_text',
                        'label' => 'Form Submit Button Text',
                        'type' => 'text',
                        'default' => 'Submit Message',
                        'help' => 'Text inside the gold submit button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'form_success_msg',
                        'label' => 'Form Success Alert Message',
                        'type' => 'textarea',
                        'default' => 'Thank you for reaching out to Sun Rise Sr. Sec. School. Your message has been received by our office desk and we will contact you shortly.',
                        'help' => 'Alert message displayed to parents upon submission.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Campus Office Information & Visiting Hours',
                'icon'  => 'schedule',
                'desc'  => 'Campus office address, phone lines, email address, seasonal timings, weekly visiting days, and photo card.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'info_card_title',
                        'label' => 'Campus Information Card Title',
                        'type' => 'text',
                        'default' => 'Campus Information',
                        'help' => 'Card header title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'info_address_title',
                        'label' => 'Address Block Title',
                        'type' => 'text',
                        'default' => 'School Address',
                        'help' => 'Label for address section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'info_phone_title',
                        'label' => 'Phone Helpline Title',
                        'type' => 'text',
                        'default' => 'Office Helpline',
                        'help' => 'Label for phone numbers.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'info_email_title',
                        'label' => 'Email Block Title',
                        'type' => 'text',
                        'default' => 'Official Email',
                        'help' => 'Label for official email.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_title',
                        'label' => 'Timings Block Title',
                        'type' => 'text',
                        'default' => 'School & Office Timings',
                        'help' => 'Header for timings schedule.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_summer',
                        'label' => 'Summer Season Timings',
                        'type' => 'text',
                        'default' => 'Summer Season: 7:30 AM – 1:30 PM',
                        'help' => 'Summer working hours.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_winter',
                        'label' => 'Winter Season Timings',
                        'type' => 'text',
                        'default' => 'Winter Season: 8:30 AM – 2:30 PM',
                        'help' => 'Winter working hours.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timing_days',
                        'label' => 'Visiting Days & Off Note',
                        'type' => 'text',
                        'default' => 'Visiting Days: Monday to Saturday (Sunday Closed)',
                        'help' => 'Visiting policy note.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'info_status_badge',
                        'label' => 'Admissions Desk Status Badge',
                        'type' => 'text',
                        'default' => 'Admissions Desk Open',
                        'help' => 'Status pill badge at the bottom of the contact card (e.g. Admissions Desk Open).'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Key Departmental Desks & Helplines',
                'icon'  => 'support_agent',
                'desc'  => 'Four specialized point-of-contact desks for Admissions, Transport, Accounts, and Principal Office.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'desks_eyebrow',
                        'label' => 'Desks Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Direct Helplines',
                        'help' => 'Small eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desks_heading',
                        'label' => 'Desks Section Heading',
                        'type' => 'text',
                        'default' => 'Key Departmental Contacts',
                        'help' => 'Main section title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk1_name',
                        'label' => 'Desk 1 Title (Admissions)',
                        'type' => 'text',
                        'default' => 'Admissions & Student Enrollment',
                        'help' => 'Desk 1 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk1_role',
                        'label' => 'Desk 1 Department Tag',
                        'type' => 'text',
                        'default' => 'Admission Counselor Cell',
                        'help' => 'Desk 1 badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk1_contact',
                        'label' => 'Desk 1 Helpline Number',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Desk 1 contact phone.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk1_timing',
                        'label' => 'Desk 1 Available Hours',
                        'type' => 'text',
                        'default' => '8:00 AM – 2:30 PM (Mon–Sat)',
                        'help' => 'Desk 1 working timing.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk2_name',
                        'label' => 'Desk 2 Title (Transport)',
                        'type' => 'text',
                        'default' => 'School Bus & Transport Incharge',
                        'help' => 'Desk 2 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk2_role',
                        'label' => 'Desk 2 Department Tag',
                        'type' => 'text',
                        'default' => 'Fleet & Route Operations',
                        'help' => 'Desk 2 badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk2_contact',
                        'label' => 'Desk 2 Helpline Number',
                        'type' => 'text',
                        'default' => '+91 99920 89284',
                        'help' => 'Desk 2 contact phone.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk2_timing',
                        'label' => 'Desk 2 Available Hours',
                        'type' => 'text',
                        'default' => '7:00 AM – 3:30 PM (School Days)',
                        'help' => 'Desk 2 working timing.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk3_name',
                        'label' => 'Desk 3 Title (Accounts)',
                        'type' => 'text',
                        'default' => 'Accounts & Fee Counter',
                        'help' => 'Desk 3 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk3_role',
                        'label' => 'Desk 3 Department Tag',
                        'type' => 'text',
                        'default' => 'Finance & Scholarship Desk',
                        'help' => 'Desk 3 badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk3_contact',
                        'label' => 'Desk 3 Helpline / Email',
                        'type' => 'text',
                        'default' => '+91 70158 90094 / accounts@sunrisesrsecschool.com',
                        'help' => 'Desk 3 contact info.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk3_timing',
                        'label' => 'Desk 3 Available Hours',
                        'type' => 'text',
                        'default' => '9:00 AM – 2:00 PM (Working Days)',
                        'help' => 'Desk 3 working timing.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk4_name',
                        'label' => 'Desk 4 Title (Principal Office)',
                        'type' => 'text',
                        'default' => 'Principal Office & Appointments',
                        'help' => 'Desk 4 heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk4_role',
                        'label' => 'Desk 4 Department Tag',
                        'type' => 'text',
                        'default' => 'Executive Administration',
                        'help' => 'Desk 4 badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk4_contact',
                        'label' => 'Desk 4 Email / Helpline',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsecschool.com',
                        'help' => 'Desk 4 contact info.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'desk4_timing',
                        'label' => 'Desk 4 Available Hours',
                        'type' => 'text',
                        'default' => '11:00 AM – 1:30 PM (By Prior Appointment)',
                        'help' => 'Desk 4 working timing.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Interactive Google Map & Campus Location',
                'icon'  => 'map',
                'desc'  => 'Google Map embed URL, location headings, landmark directions, and external map link.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'map_eyebrow',
                        'label' => 'Map Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Find Us on Map',
                        'help' => 'Tag above the map.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_heading',
                        'label' => 'Map Section Heading',
                        'type' => 'text',
                        'default' => 'Campus Location & Driving Directions',
                        'help' => 'Main headline above Google Map.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_desc',
                        'label' => 'Map Section Description',
                        'type' => 'textarea',
                        'default' => 'Conveniently situated on Balsamand Road in Dobhi, Hisar with direct highway connectivity and dedicated school bus bays.',
                        'help' => 'Subtext providing travel directions.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_landmark',
                        'label' => 'Prominent Landmark & Address Note',
                        'type' => 'text',
                        'default' => 'Landmark: Near Balsamand Road, Village Dobhi, Tehsil & Distt. Hisar, Haryana - 125001',
                        'help' => 'Landmark details for visiting parents.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_btn_text',
                        'label' => 'Map Button Text',
                        'type' => 'text',
                        'default' => 'Open in Google Maps',
                        'help' => 'Label for directions button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_btn_link',
                        'label' => 'Map Button Target URL',
                        'type' => 'text',
                        'default' => 'https://maps.google.com/?q=Sun+Rise+Sr+Sec+School+Dobhi+Hisar',
                        'help' => 'URL opened when clicking map button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'map_embed_url',
                        'label' => 'Google Maps Embed iframe URL',
                        'type' => 'textarea',
                        'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3493.5786358172945!2d75.5898517!3d29.0718507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391235bc6cfa35d3%3A0xe54ec09228d7b379!2sSun%20Rise%20Sr.%20Sec.%20School!5e0!3m2!1sen!2sin!4v1710000000000!5m2!1sen!2sin',
                        'help' => 'Embed src URL for Google Maps iframe.'
                    ]
                ]
            ],
            [
                'title' => 'Section 6: Quick WhatsApp Helpline Banner',
                'icon'  => 'chat',
                'desc'  => 'WhatsApp instant chat strip eyebrow, heading, description, and direct chat link.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'wa_eyebrow',
                        'label' => 'WhatsApp Strip Eyebrow',
                        'type' => 'text',
                        'default' => 'Quick WhatsApp Helpline',
                        'help' => 'Eyebrow badge above WhatsApp title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wa_heading',
                        'label' => 'WhatsApp Strip Heading',
                        'type' => 'text',
                        'default' => 'Chat Instantly with Admission Desk',
                        'help' => 'Main headline on WhatsApp card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wa_desc',
                        'label' => 'WhatsApp Strip Description',
                        'type' => 'textarea',
                        'default' => 'Have quick questions regarding admissions, transport routes, or fees? Reach us directly on WhatsApp.',
                        'help' => 'Explanatory text for WhatsApp helpline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wa_btn_text',
                        'label' => 'WhatsApp Button Text',
                        'type' => 'text',
                        'default' => 'Open WhatsApp Chat',
                        'help' => 'Text inside WhatsApp button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'wa_btn_link',
                        'label' => 'WhatsApp Chat Link / Phone URL',
                        'type' => 'text',
                        'default' => 'https://wa.me/917015890094',
                        'help' => 'Direct WhatsApp click-to-chat URL.'
                    ]
                ]
            ],
            [
                'title' => 'Section 7: Frequently Asked Questions (FAQ) Accordion',
                'icon'  => 'help',
                'desc'  => 'Four common inquiries regarding visiting hours, appointments, transport routes, and response times.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'faq_eyebrow',
                        'label' => 'FAQ Section Eyebrow',
                        'type' => 'text',
                        'default' => 'Frequently Asked Questions',
                        'help' => 'Small eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq_heading',
                        'label' => 'FAQ Section Heading',
                        'type' => 'text',
                        'default' => 'Common Contact & Visiting Inquiries',
                        'help' => 'Main heading for FAQ accordion.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq1_q',
                        'label' => 'FAQ 1 Question',
                        'type' => 'text',
                        'default' => 'What are the ideal hours for visiting the campus for admission inquiries?',
                        'help' => 'Question 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq1_a',
                        'label' => 'FAQ 1 Answer',
                        'type' => 'textarea',
                        'default' => 'Our campus admissions desk is active Monday through Saturday from 8:00 AM to 2:30 PM. We recommend visiting before 1:00 PM for guided campus walk-throughs and counselor consultations.',
                        'help' => 'Answer 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq2_q',
                        'label' => 'FAQ 2 Question',
                        'type' => 'text',
                        'default' => 'Is prior appointment required to meet the Principal?',
                        'help' => 'Question 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq2_a',
                        'label' => 'FAQ 2 Answer',
                        'type' => 'textarea',
                        'default' => 'Yes, to ensure dedicated time without interruptions, we request parents to schedule appointments with the Principal office by calling +91 70158 90094 or emailing info@sunrisesrsecschool.com.',
                        'help' => 'Answer 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq3_q',
                        'label' => 'FAQ 3 Question',
                        'type' => 'text',
                        'default' => 'How can I check if school bus transportation covers our village or neighborhood?',
                        'help' => 'Question 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq3_a',
                        'label' => 'FAQ 3 Answer',
                        'type' => 'textarea',
                        'default' => 'You can call our dedicated Transport Coordinator helpline at +91 99920 89284 or indicate your residential area in the contact form. We operate 15+ GPS-tracked bus routes covering 30+ villages around Dobhi.',
                        'help' => 'Answer 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq4_q',
                        'label' => 'FAQ 4 Question',
                        'type' => 'text',
                        'default' => 'How soon can I expect a response to my online inquiry?',
                        'help' => 'Question 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'faq4_a',
                        'label' => 'FAQ 4 Answer',
                        'type' => 'textarea',
                        'default' => 'Our administrative team typically reviews and replies to online inquiry desk messages within 24 business hours. For urgent inquiries, please call our primary helpline directly.',
                        'help' => 'Answer 4.'
                    ]
                ]
            ]
        ]
    ],
    'general' => [
        'title' => 'General Settings',
        'icon'  => 'settings',
        'desc'  => 'School Branding, Logo, Global Helplines, Header Navbar, Top Utility Bar, and Complete Footer Links',
        'sections' => [
            [
                'title' => 'Section 1: Identity, Official Logo & Branding',
                'icon'  => 'shield',
                'desc'  => 'Official School Name, Logo Image, Header Subtitle, Affiliation Motto, and Foundation Year.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'site_logo',
                        'label' => 'Official School Logo / Crest',
                        'default' => 'assets/images/logo.svg',
                        'alt' => 'Sun Rise Sr. Sec. School Crest',
                        'help' => 'Displayed across header navbar, mobile drawer, and site crests.'
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
                        'key' => 'nav_sub_title',
                        'label' => 'Header Logo Subtitle',
                        'type' => 'text',
                        'default' => 'Dobhi, Hisar • HBSE Affiliated',
                        'help' => 'Small subtitle directly below school name in navbar and mobile drawer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_tagline',
                        'label' => 'School Tagline / Affiliation Motto',
                        'type' => 'text',
                        'default' => 'Nurturing Knowledge, Character & Academic Excellence | Affiliated to HBSE',
                        'help' => 'Header tagline and SEO description default.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_affiliation',
                        'label' => 'Affiliation Board',
                        'type' => 'text',
                        'default' => 'HBSE',
                        'help' => 'Education Board name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_estd',
                        'label' => 'Established Year',
                        'type' => 'text',
                        'default' => '2007',
                        'help' => 'Founding year.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Global Helplines, Emails & Campus Address',
                'icon'  => 'contact_phone',
                'desc'  => 'Primary and secondary phone lines, inquiry emails, postal address, and seasonal timings.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'site_phone',
                        'label' => 'Primary Contact Phone',
                        'type' => 'text',
                        'default' => '+91 70158 90094',
                        'help' => 'Click-to-call phone number in top bar, header, and footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_phone_alt',
                        'label' => 'Secondary Contact Phone',
                        'type' => 'text',
                        'default' => '+91 79882 35710',
                        'help' => 'Secondary phone number displayed in footer and contact desks.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_email',
                        'label' => 'Official Inquiries Email',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsecschool.com',
                        'help' => 'Main school inbox displayed in header top bar and footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_info_email',
                        'label' => 'Admissions Desk Email',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsecschool.com',
                        'help' => 'Admissions inquiries inbox.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_address',
                        'label' => 'Physical Campus Address',
                        'type' => 'textarea',
                        'default' => 'Main Road Dobhi, Near Primary Health Center, Dobhi, Hisar (Haryana) - 125001',
                        'help' => 'Full postal address displayed in footer and schema data.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timings_summer',
                        'label' => 'Summer Season School Timings',
                        'type' => 'text',
                        'default' => '7:30 AM to 1:30 PM',
                        'help' => 'Summer working hours shown in footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'timings_winter',
                        'label' => 'Winter Season School Timings',
                        'type' => 'text',
                        'default' => '8:30 AM to 2:30 PM',
                        'help' => 'Winter working hours shown in footer.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Header Top Utility Bar & Online Registration Link',
                'icon'  => 'tab',
                'desc'  => 'Top bar utility links (Home, Student Login, Alumni, Mandatory Disclosure) and pulsing Online Registration badge.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'top_link1_text',
                        'label' => 'Top Bar Link 1 Text',
                        'type' => 'text',
                        'default' => 'Home',
                        'help' => 'Label for top bar link 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link1_url',
                        'label' => 'Top Bar Link 1 URL',
                        'type' => 'text',
                        'default' => 'index.php',
                        'help' => 'URL for top bar link 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link2_text',
                        'label' => 'Top Bar Link 2 Text',
                        'type' => 'text',
                        'default' => 'Student Login',
                        'help' => 'Label for top bar link 2 (opens student login modal).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link2_url',
                        'label' => 'Top Bar Link 2 URL',
                        'type' => 'text',
                        'default' => '#student-portal',
                        'help' => 'URL or modal anchor for top bar link 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link3_text',
                        'label' => 'Top Bar Link 3 Text',
                        'type' => 'text',
                        'default' => 'Alumni',
                        'help' => 'Label for top bar link 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link3_url',
                        'label' => 'Top Bar Link 3 URL',
                        'type' => 'text',
                        'default' => 'alumni.php',
                        'help' => 'URL for top bar link 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link4_text',
                        'label' => 'Top Bar Link 4 Text',
                        'type' => 'text',
                        'default' => 'Mandatory Disclosure',
                        'help' => 'Label for top bar link 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_link4_url',
                        'label' => 'Top Bar Link 4 URL',
                        'type' => 'text',
                        'default' => '#mandatory-disclosure',
                        'help' => 'URL or modal anchor for top bar link 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_reg_text',
                        'label' => 'Blinking Registration Badge Text',
                        'type' => 'text',
                        'default' => 'Online Registration 2026-27',
                        'help' => 'Text inside the animated pulsing badge in top bar & mobile drawer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'top_reg_url',
                        'label' => 'Blinking Registration Target URL',
                        'type' => 'text',
                        'default' => 'admission.php#register-form',
                        'help' => 'Destination link for the registration badge.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Main Navigation Bar Menu Items & Mobile Drawer',
                'icon'  => 'menu',
                'desc'  => 'All 7 main navigation menu links, mobile drawer quick CTA button, and mobile WhatsApp chat link.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'nav_item1_text',
                        'label' => 'Menu Item 1 Label (About Us)',
                        'type' => 'text',
                        'default' => 'ABOUT US',
                        'help' => 'First navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item1_url',
                        'label' => 'Menu Item 1 URL',
                        'type' => 'text',
                        'default' => 'about-us.php',
                        'help' => 'First navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item2_text',
                        'label' => 'Menu Item 2 Label (Admissions)',
                        'type' => 'text',
                        'default' => 'ADMISSIONS',
                        'help' => 'Second navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item2_url',
                        'label' => 'Menu Item 2 URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Second navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item3_text',
                        'label' => 'Menu Item 3 Label (Academics)',
                        'type' => 'text',
                        'default' => 'ACADEMICS',
                        'help' => 'Third navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item3_url',
                        'label' => 'Menu Item 3 URL',
                        'type' => 'text',
                        'default' => 'academics.php',
                        'help' => 'Third navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item4_text',
                        'label' => 'Menu Item 4 Label (Activities)',
                        'type' => 'text',
                        'default' => 'ACTIVITIES',
                        'help' => 'Fourth navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item4_url',
                        'label' => 'Menu Item 4 URL',
                        'type' => 'text',
                        'default' => 'events.php',
                        'help' => 'Fourth navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item5_text',
                        'label' => 'Menu Item 5 Label (Campus)',
                        'type' => 'text',
                        'default' => 'BOARDING AND CAMPUS',
                        'help' => 'Fifth navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item5_url',
                        'label' => 'Menu Item 5 URL',
                        'type' => 'text',
                        'default' => 'campus.php',
                        'help' => 'Fifth navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item6_text',
                        'label' => 'Menu Item 6 Label (Gallery)',
                        'type' => 'text',
                        'default' => 'GALLERY',
                        'help' => 'Sixth navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item6_url',
                        'label' => 'Menu Item 6 URL',
                        'type' => 'text',
                        'default' => 'gallery.php',
                        'help' => 'Sixth navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item7_text',
                        'label' => 'Menu Item 7 Label (Connect)',
                        'type' => 'text',
                        'default' => 'CONNECT',
                        'help' => 'Seventh navbar item label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_item7_url',
                        'label' => 'Menu Item 7 URL',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Seventh navbar item destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_mobile_cta_text',
                        'label' => 'Mobile Drawer CTA Button Text',
                        'type' => 'text',
                        'default' => 'Enquire Now / Apply Online',
                        'help' => 'Gold button text at bottom of mobile menu.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_mobile_cta_url',
                        'label' => 'Mobile Drawer CTA Button URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Target link for mobile drawer button.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'nav_mobile_wa_url',
                        'label' => 'Mobile Drawer WhatsApp URL',
                        'type' => 'text',
                        'default' => 'https://wa.me/918307560664',
                        'help' => 'WhatsApp link inside mobile menu.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Footer Column 1 & 2 (Quick Contact & Quick Links)',
                'icon'  => 'link',
                'desc'  => 'Footer Column 1 headers and all 6 Column 2 Quick Links with custom titles and destinations.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'footer_col1_title',
                        'label' => 'Footer Column 1 Heading',
                        'type' => 'text',
                        'default' => 'Quick Contact',
                        'help' => 'First column header.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_timings_title',
                        'label' => 'Footer Timings Block Label',
                        'type' => 'text',
                        'default' => 'School Timings:',
                        'help' => 'Header above summer/winter timings.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_title',
                        'label' => 'Footer Column 2 Heading',
                        'type' => 'text',
                        'default' => 'Quick Links',
                        'help' => 'Second column header.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link1_text',
                        'label' => 'Col 2 - Link 1 Text',
                        'type' => 'text',
                        'default' => 'Student & Staff ERP',
                        'help' => 'Link 1 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link1_url',
                        'label' => 'Col 2 - Link 1 URL',
                        'type' => 'text',
                        'default' => '#student-portal',
                        'help' => 'Link 1 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link2_text',
                        'label' => 'Col 2 - Link 2 Text',
                        'type' => 'text',
                        'default' => 'Annual Calendar',
                        'help' => 'Link 2 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link2_url',
                        'label' => 'Col 2 - Link 2 URL',
                        'type' => 'text',
                        'default' => 'academics.php#academic-calendar',
                        'help' => 'Link 2 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link3_text',
                        'label' => 'Col 2 - Link 3 Text',
                        'type' => 'text',
                        'default' => 'Admission Procedure',
                        'help' => 'Link 3 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link3_url',
                        'label' => 'Col 2 - Link 3 URL',
                        'type' => 'text',
                        'default' => 'admission.php',
                        'help' => 'Link 3 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link4_text',
                        'label' => 'Col 2 - Link 4 Text',
                        'type' => 'text',
                        'default' => 'Mandatory Disclosure',
                        'help' => 'Link 4 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link4_url',
                        'label' => 'Col 2 - Link 4 URL',
                        'type' => 'text',
                        'default' => 'about-us.php#mandatory-disclosure',
                        'help' => 'Link 4 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link7_text',
                        'label' => 'Col 2 - Link 5 Text (Careers)',
                        'type' => 'text',
                        'default' => 'Careers & Vacancies',
                        'help' => 'Link 5 label in footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col2_link7_url',
                        'label' => 'Col 2 - Link 5 URL',
                        'type' => 'text',
                        'default' => 'contact-us.php#careers',
                        'help' => 'Link 5 destination in footer.'
                    ]
                ]
            ],
            [
                'title' => 'Section 6: Footer Column 3 & 4 (Social Connect & Campus Map)',
                'icon'  => 'map',
                'desc'  => 'Column 3 Heading & description, and Column 4 Google Map embed iframe with external map button.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'footer_col3_title',
                        'label' => 'Footer Column 3 Heading',
                        'type' => 'text',
                        'default' => 'School Timings',
                        'help' => 'Third column header (School Timings).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_social_title',
                        'label' => 'Social Media Section Label',
                        'type' => 'text',
                        'default' => 'Social Media Accounts',
                        'help' => 'Sub-heading displayed above social media icons below School Timings.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_col4_title',
                        'label' => 'Footer Column 4 Heading',
                        'type' => 'text',
                        'default' => 'Location Map',
                        'help' => 'Fourth column header.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_map_embed',
                        'label' => 'Footer Map Embed iframe URL',
                        'type' => 'textarea',
                        'default' => 'https://maps.google.com/maps?q=Sun+Rise+Sr.+Sec.+School,+Dobhi,+Hisar,+Haryana&t=&z=14&ie=UTF8&iwloc=&output=embed',
                        'help' => 'Google Maps embed iframe URL.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_map_btn_text',
                        'label' => 'Footer Map Button Text',
                        'type' => 'text',
                        'default' => 'View on Google Maps',
                        'help' => 'Label for button under map.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_map_btn_link',
                        'label' => 'Footer Map Button URL',
                        'type' => 'text',
                        'default' => 'https://maps.google.com/?q=Sun+Rise+Sr.+Sec.+School+Dobhi+Hisar+Haryana',
                        'help' => 'External Google Maps link.'
                    ]
                ]
            ],
            [
                'title' => 'Section 7: Footer Bottom Bar, Legal Links & Admin Link',
                'icon'  => 'copyright',
                'desc'  => 'Copyright statement suffix, Privacy Policy, Terms of Service, Sitemap, and Admin Portal link.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'footer_copyright_note',
                        'label' => 'Copyright Note Suffix',
                        'type' => 'text',
                        'default' => 'All rights reserved.',
                        'help' => 'Appears after "(Year) School Name." in bottom bar.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link1_text',
                        'label' => 'Legal Link 1 Text',
                        'type' => 'text',
                        'default' => 'Privacy Policy',
                        'help' => 'Bottom bar link 1 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link1_url',
                        'label' => 'Legal Link 1 URL',
                        'type' => 'text',
                        'default' => 'about-us.php',
                        'help' => 'Bottom bar link 1 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link2_text',
                        'label' => 'Legal Link 2 Text',
                        'type' => 'text',
                        'default' => 'Terms of Service',
                        'help' => 'Bottom bar link 2 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link2_url',
                        'label' => 'Legal Link 2 URL',
                        'type' => 'text',
                        'default' => 'about-us.php',
                        'help' => 'Bottom bar link 2 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link3_text',
                        'label' => 'Legal Link 3 Text',
                        'type' => 'text',
                        'default' => 'Sitemap',
                        'help' => 'Bottom bar link 3 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_bottom_link3_url',
                        'label' => 'Legal Link 3 URL',
                        'type' => 'text',
                        'default' => 'contact-us.php',
                        'help' => 'Bottom bar link 3 destination.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_admin_link_text',
                        'label' => 'Admin Portal Link Text',
                        'type' => 'text',
                        'default' => 'Admin Portal',
                        'help' => 'Bottom bar admin link label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'footer_admin_link_url',
                        'label' => 'Admin Portal Link URL',
                        'type' => 'text',
                        'default' => 'admin/login.php',
                        'help' => 'Bottom bar admin link destination.'
                    ]
                ]
            ],
            [
                'title' => 'Section 8: Social Media Channels & Links',
                'icon'  => 'share',
                'desc'  => 'Official Social Media Handles displayed in the site footer (Facebook, Instagram, YouTube, WhatsApp, and X/Twitter).',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'social_facebook',
                        'label' => 'Facebook Page URL',
                        'type' => 'text',
                        'default' => 'https://www.facebook.com/sunrise6691/',
                        'help' => 'Link to official school Facebook page.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'social_instagram',
                        'label' => 'Instagram Profile URL',
                        'type' => 'text',
                        'default' => 'https://www.instagram.com/sunrise_sr.sec.school?stkn=YWhqZ3B6dGZiM3J4',
                        'help' => 'Link to official school Instagram profile.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'social_youtube',
                        'label' => 'YouTube Channel URL',
                        'type' => 'text',
                        'default' => 'https://www.youtube.com/@sunriseschool06691',
                        'help' => 'Link to official school YouTube channel.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'social_whatsapp',
                        'label' => 'WhatsApp Helpline / Chat Link',
                        'type' => 'text',
                        'default' => 'https://wa.me/918307560664',
                        'help' => 'Direct WhatsApp chat URL (e.g. https://wa.me/91XXXXXXXXXX).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'social_twitter',
                        'label' => 'X (Twitter) Profile URL',
                        'type' => 'text',
                        'default' => 'https://twitter.com',
                        'help' => 'Link to official school X / Twitter handle.'
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
                            'management' => 'management.php',
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
                    $is_gal_cat    = (!empty($sec['type']) && $sec['type'] === 'gallery_category');
                    $is_event_news = (!empty($sec['type']) && $sec['type'] === 'event_news_cards');
                    $is_alumni     = (!empty($sec['type']) && $sec['type'] === 'alumni_cards');

                    if ($is_gal_cat) {
                        $cat_key   = $sec['cat_key'];
                        $cat_cards = get_gallery_category_cards($cat_key, true);
                        $cat_slots = get_gallery_category_slots($cat_key);
                    } elseif ($is_event_news) {
                        $event_cards = get_event_news_cards(true);
                        $event_slots = get_event_news_slots();
                    } elseif ($is_alumni) {
                        $alumni_cards_admin = get_alumni_cards(true);
                        $alumni_slots_admin = get_alumni_slots();
                    }
                ?>
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden" id="sec_<?= $sec_idx ?>">
                        
                        <!-- Section Header -->
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white flex flex-wrap items-center justify-between gap-3">
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

                            <?php if ($is_gal_cat): ?>
                                <div class="flex items-center gap-2.5">
                                    <span id="cat_count_badge_<?= htmlspecialchars($cat_key) ?>" class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                        <?= count($cat_cards) ?> Card(s)
                                    </span>
                                    <button 
                                        type="button" 
                                        onclick="addGalleryCategoryCard('<?= htmlspecialchars($cat_key) ?>', '<?= htmlspecialchars(addslashes($sec['title'])) ?>')"
                                        class="px-3.5 py-2 bg-[#001129] hover:bg-[#071f45] text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition flex items-center gap-1.5 cursor-pointer"
                                    >
                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">add_circle</span>
                                        <span>+ Add Card</span>
                                    </button>
                                </div>
                            <?php elseif ($is_event_news): ?>
                                <div class="flex items-center gap-2.5">
                                    <span id="event_news_count_badge" class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                        <?= count($event_cards) ?> Card(s)
                                    </span>
                                    <button 
                                        type="button" 
                                        onclick="addEventNewsCard()"
                                        class="px-3.5 py-2 bg-[#001129] hover:bg-[#071f45] text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition flex items-center gap-1.5 cursor-pointer"
                                    >
                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">add_circle</span>
                                        <span>+ Add Event Card</span>
                                    </button>
                                </div>
                            <?php elseif ($is_alumni): ?>
                                <div class="flex items-center gap-2.5">
                                    <span id="alumni_count_badge" class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                        <?= count($alumni_cards_admin) ?> Card(s)
                                    </span>
                                    <button 
                                        type="button" 
                                        onclick="addAlumniCard()"
                                        class="px-3.5 py-2 bg-[#001129] hover:bg-[#071f45] text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition flex items-center gap-1.5 cursor-pointer"
                                    >
                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">add_circle</span>
                                        <span>+ Add Alumni Card</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                    <?= count($sec['fields']) ?> item(s)
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if ($is_gal_cat): ?>
                            <!-- Gallery Category Cards Grid (Only Image + Single Heading per Card) -->
                            <div class="p-6" data-cat-section="<?= htmlspecialchars($cat_key) ?>" data-cat-slots="<?= htmlspecialchars(implode(',', $cat_slots)) ?>">
                                <div id="gal_cat_grid_<?= htmlspecialchars($cat_key) ?>" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <?php foreach ($cat_cards as $c_num => $card): 
                                        $slot = $card['slot'];
                                        $preview_url = !empty($card['img']) ? get_admin_img_preview($card['img']) : '../assets/images/logo.svg';
                                        $img_preview_id = "gal_prv_{$cat_key}_{$slot}";
                                    ?>
                                        <div class="gallery-admin-card rounded-2xl border border-gray-200 bg-gray-50/40 p-5 shadow-sm hover:border-[#C9A24B]/60 transition flex flex-col justify-between" data-cat="<?= htmlspecialchars($cat_key) ?>" data-slot="<?= (int)$slot ?>">
                                            <form method="POST" action="?tab=gallery" onsubmit="return handleGalleryCardSubmit(event, this)" class="gallery-card-unified-form space-y-4" data-cat="<?= htmlspecialchars($cat_key) ?>" data-slot="<?= (int)$slot ?>" data-preview-id="<?= htmlspecialchars($img_preview_id) ?>">
                                                <!-- Card Top Bar -->
                                                <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num"><?= $c_num + 1 ?></span>
                                                        <span class="font-bold text-gray-800 text-sm">Photo Card</span>
                                                    </div>
                                                    <button 
                                                        type="button" 
                                                        onclick="removeGalleryCategoryCard('<?= htmlspecialchars($cat_key) ?>', <?= (int)$slot ?>, this)"
                                                        class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                                                        title="Remove this card"
                                                    >
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                        <span>Remove</span>
                                                    </button>
                                                </div>

                                                <!-- 1. Image Preview & Upload -->
                                                <div class="space-y-3">
                                                    <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm aspect-video flex items-center justify-center">
                                                        <img 
                                                            id="<?= htmlspecialchars($img_preview_id) ?>" 
                                                            src="<?= htmlspecialchars($preview_url) ?>" 
                                                            alt="<?= htmlspecialchars($card['title']) ?>"
                                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                                            onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                                                        />
                                                        <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/75 text-white text-[10px] font-medium backdrop-blur-sm flex items-center gap-1">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                            Card Image
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Upload Photo (Auto-converted to WEBP &bull; Max 2.5MB)
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            name="image_file" 
                                                            accept="image/jpeg,image/png,image/webp"
                                                            onchange="previewImage(this, '<?= htmlspecialchars($img_preview_id) ?>')"
                                                            class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                                                        />
                                                    </div>

                                                    <div>
                                                        <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                                            Or Select School Image / Custom Path:
                                                        </label>
                                                        <div class="flex flex-col sm:flex-row gap-2">
                                                            <select 
                                                                onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                                                class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                            >
                                                                <option value="">-- Choose School Photo --</option>
                                                                <?php foreach ($available_school_images as $img_file): ?>
                                                                    <option value="<?= htmlspecialchars($img_file) ?>" <?= (strpos($card['img'], $img_file) !== false) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($img_file) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input 
                                                                type="text" 
                                                                name="custom_path" 
                                                                placeholder="assets/images/... or https://..."
                                                                value="<?= (strpos($card['img'], 'uploads/') === false) ? htmlspecialchars(rawurldecode($card['img'])) : '' ?>"
                                                                onchange="if(this.value){ const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                                                class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2. Single Heading Input (Only Heading on Image) -->
                                                <div>
                                                    <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">title</span>
                                                        <span>Heading on Image</span>
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="card_heading" 
                                                        value="<?= htmlspecialchars($card['title']) ?>"
                                                        placeholder="Enter heading to display on photo..."
                                                        class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-900 text-sm font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                                                    />
                                                </div>

                                                <!-- Save Button -->
                                                <div class="pt-1">
                                                    <button 
                                                        type="submit" 
                                                        class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                                                    >
                                                        <span class="btn-icon material-symbols-outlined text-base">save</span>
                                                        <span class="btn-text">Save Card</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Add New Card Tile (+) -->
                                    <button 
                                        type="button" 
                                        id="add_tile_<?= htmlspecialchars($cat_key) ?>"
                                        onclick="addGalleryCategoryCard('<?= htmlspecialchars($cat_key) ?>', '<?= htmlspecialchars(addslashes($sec['title'])) ?>')"
                                        class="min-h-[260px] rounded-2xl border-2 border-dashed border-gray-300 hover:border-[#C9A24B] bg-gray-50/40 hover:bg-[#C9A24B]/5 transition flex flex-col items-center justify-center gap-2.5 p-6 text-gray-500 hover:text-[#001129] group cursor-pointer"
                                    >
                                        <div class="w-12 h-12 rounded-full bg-white border border-gray-200 group-hover:border-[#C9A24B] group-hover:bg-[#001129] group-hover:text-[#C9A24B] flex items-center justify-center shadow-sm transition">
                                            <span class="material-symbols-outlined text-2xl">add</span>
                                        </div>
                                        <span class="font-bold text-sm">Add New Card</span>
                                        <span class="text-xs text-gray-400 text-center">Click + to add a new photo &amp; heading in <?= htmlspecialchars($sec['title']) ?></span>
                                    </button>
                                </div>
                            </div>
                        <?php elseif ($is_event_news): ?>
                            <!-- Event News Dynamic Cards Grid -->
                            <div class="p-6 space-y-6" data-event-news-section="1" data-event-slots="<?= htmlspecialchars(implode(',', $event_slots)) ?>">
                                <!-- Section Top Header Text (Eyebrow & Heading) -->
                                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Section Eyebrow Tag</label>
                                            <input type="text" id="ev_news_eyebrow" value="<?= htmlspecialchars(get_text('events', 'news_eyebrow', 'Happenings & Notices')) ?>" onchange="saveQuickField('events', 'news_eyebrow', this.value)" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Section Main Heading</label>
                                            <input type="text" id="ev_news_heading" value="<?= htmlspecialchars(get_text('events', 'news_heading', 'School News & Key Highlights')) ?>" onchange="saveQuickField('events', 'news_heading', this.value)" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs font-semibold" />
                                        </div>
                                    </div>
                                </div>

                                <div id="event_news_grid" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <?php foreach ($event_cards as $c_num => $card): 
                                        $slot = $card['slot'];
                                        $preview_url = !empty($card['img']) ? get_admin_img_preview($card['img']) : '../assets/images/logo.svg';
                                        $img_preview_id = "event_news_prv_{$slot}";
                                    ?>
                                        <div class="event-news-admin-card rounded-2xl border border-gray-200 bg-gray-50/40 p-5 shadow-sm hover:border-[#C9A24B]/60 transition flex flex-col justify-between" data-slot="<?= (int)$slot ?>">
                                            <form method="POST" action="?tab=events" onsubmit="return handleEventNewsCardSubmit(event, this)" class="event-card-unified-form space-y-4" data-slot="<?= (int)$slot ?>" data-preview-id="<?= htmlspecialchars($img_preview_id) ?>">
                                                <!-- Card Top Bar -->
                                                <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num"><?= $c_num + 1 ?></span>
                                                        <span class="font-bold text-gray-800 text-sm">Event / News Card</span>
                                                    </div>
                                                    <button 
                                                        type="button" 
                                                        onclick="removeEventNewsCard(<?= (int)$slot ?>, this)"
                                                        class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                                                        title="Remove this card"
                                                    >
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                        <span>Remove</span>
                                                    </button>
                                                </div>

                                                <!-- 1. Image Preview & Upload -->
                                                <div class="space-y-3">
                                                    <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm aspect-video flex items-center justify-center">
                                                        <img 
                                                            id="<?= htmlspecialchars($img_preview_id) ?>" 
                                                            src="<?= htmlspecialchars($preview_url) ?>" 
                                                            alt="<?= htmlspecialchars($card['title']) ?>"
                                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                                            onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                                                        />
                                                        <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/75 text-white text-[10px] font-medium backdrop-blur-sm flex items-center gap-1">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                            Event Photo
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Upload Photo (Auto-converted to WEBP &bull; Max 2.5MB)
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            name="image_file" 
                                                            accept="image/jpeg,image/png,image/webp"
                                                            onchange="previewImage(this, '<?= htmlspecialchars($img_preview_id) ?>')"
                                                            class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                                                        />
                                                    </div>

                                                    <div>
                                                        <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                                            Or Select School Image / Custom Path:
                                                        </label>
                                                        <div class="flex flex-col sm:flex-row gap-2">
                                                            <select 
                                                                onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                                                class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                            >
                                                                <option value="">-- Choose School Photo --</option>
                                                                <?php foreach ($available_school_images as $img_file): ?>
                                                                    <option value="<?= htmlspecialchars($img_file) ?>" <?= (strpos($card['img'], $img_file) !== false) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($img_file) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input 
                                                                type="text" 
                                                                name="custom_path" 
                                                                placeholder="assets/images/... or https://..."
                                                                value="<?= (strpos($card['img'], 'uploads/') === false) ? htmlspecialchars(rawurldecode($card['img'])) : '' ?>"
                                                                onchange="if(this.value){ const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                                                class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2. Date, Tag & Filter Category -->
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">calendar_month</span>
                                                            <span>Date (Day &amp; Month)</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_date" 
                                                            value="<?= htmlspecialchars($card['date']) ?>"
                                                            placeholder="e.g. 24 OCT"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#C9A24B] outline-none uppercase"
                                                        />
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">label</span>
                                                            <span>Tag on Image</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_tag" 
                                                            value="<?= htmlspecialchars($card['tag']) ?>"
                                                            placeholder="e.g. Science Fair, Honors"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                        />
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">filter_list</span>
                                                            <span>Filter Category</span>
                                                        </label>
                                                        <select 
                                                            name="card_category"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none cursor-pointer"
                                                        >
                                                            <option value="academic" <?= ($card['category'] === 'academic') ? 'selected' : '' ?>>Academic</option>
                                                            <option value="cultural" <?= ($card['category'] === 'cultural') ? 'selected' : '' ?>>Celebrations</option>
                                                            <option value="campus" <?= ($card['category'] === 'campus') ? 'selected' : '' ?>>Campus</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- 3. Headline & Description -->
                                                <div class="space-y-3">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-base">title</span>
                                                            <span>Headline / Title</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_title" 
                                                            value="<?= htmlspecialchars($card['title']) ?>"
                                                            placeholder="Enter event / news title..."
                                                            class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-900 text-sm font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                                                        />
                                                    </div>

                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-base">notes</span>
                                                            <span>Short Description / Summary</span>
                                                        </label>
                                                        <textarea 
                                                            name="card_desc" 
                                                            rows="2"
                                                            placeholder="Enter brief summary of the event..."
                                                            class="w-full p-3 bg-white border border-gray-300 rounded-xl text-gray-900 text-xs focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none resize-none leading-relaxed"
                                                        ><?= htmlspecialchars($card['desc']) ?></textarea>
                                                    </div>
                                                </div>

                                                <!-- 4. Read More Link -->
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Button Text</label>
                                                        <input 
                                                            type="text" 
                                                            name="card_link_text" 
                                                            value="<?= htmlspecialchars($card['link_text']) ?>"
                                                            placeholder="Read More"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs"
                                                        />
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Target Page URL</label>
                                                        <input 
                                                            type="text" 
                                                            name="card_link_url" 
                                                            value="<?= htmlspecialchars($card['link_url']) ?>"
                                                            placeholder="gallery.php / about-us.php"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono"
                                                        />
                                                    </div>
                                                </div>

                                                <!-- Save Button -->
                                                <div class="pt-1">
                                                    <button 
                                                        type="submit" 
                                                        class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                                                    >
                                                        <span class="btn-icon material-symbols-outlined text-base">save</span>
                                                        <span class="btn-text">Save Event Card</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Add New Card Tile (+) -->
                                    <button 
                                        type="button" 
                                        id="add_tile_event_news"
                                        onclick="addEventNewsCard()"
                                        class="min-h-[300px] rounded-2xl border-2 border-dashed border-gray-300 hover:border-[#C9A24B] bg-gray-50/40 hover:bg-[#C9A24B]/5 transition flex flex-col items-center justify-center gap-2.5 p-6 text-gray-500 hover:text-[#001129] group cursor-pointer"
                                    >
                                        <div class="w-12 h-12 rounded-full bg-white border border-gray-200 group-hover:border-[#C9A24B] group-hover:bg-[#001129] group-hover:text-[#C9A24B] flex items-center justify-center shadow-sm transition">
                                            <span class="material-symbols-outlined text-2xl">add</span>
                                        </div>
                                        <span class="font-bold text-sm">Add New Event / News Card</span>
                                        <span class="text-xs text-gray-400 text-center">Click + to add a new event card with photo, date, tag &amp; summary</span>
                                    </button>
                                </div>
                            </div>
                        <?php elseif ($is_alumni): ?>
                            <!-- Alumni Dynamic Profile Cards Grid -->
                            <div class="p-6 space-y-6" data-alumni-section="1" data-alumni-slots="<?= htmlspecialchars(implode(',', $alumni_slots_admin)) ?>">
                                <!-- Section Top Header Text (Eyebrow, Heading & Desc) -->
                                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Section Eyebrow Tag</label>
                                            <input type="text" id="al_cards_eyebrow" value="<?= htmlspecialchars(get_text('alumni', 'cards_eyebrow', 'Distinguished Ex-Students')) ?>" onchange="saveQuickField('alumni', 'cards_eyebrow', this.value)" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Section Main Heading</label>
                                            <input type="text" id="al_cards_heading" value="<?= htmlspecialchars(get_text('alumni', 'cards_heading', 'Inspiring Journeys & Success Stories')) ?>" onchange="saveQuickField('alumni', 'cards_heading', this.value)" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs font-semibold" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1">Section Description</label>
                                        <input type="text" id="al_cards_desc" value="<?= htmlspecialchars(get_text('alumni', 'cards_desc', 'Our alumni continue to make notable strides across industries and institutions. Discover their career milestones and fond memories from their formative years at Sun Rise.')) ?>" onchange="saveQuickField('alumni', 'cards_desc', this.value)" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs" />
                                    </div>
                                </div>

                                <div id="alumni_cards_grid" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <?php foreach ($alumni_cards_admin as $c_num => $card): 
                                        $slot = $card['slot'];
                                        $preview_url = !empty($card['photo']) ? get_admin_img_preview($card['photo']) : '../assets/images/logo.svg';
                                        $img_preview_id = "alumni_prv_{$slot}";
                                    ?>
                                        <div class="alumni-admin-card rounded-2xl border border-gray-200 bg-gray-50/40 p-5 shadow-sm hover:border-[#C9A24B]/60 transition flex flex-col justify-between" data-slot="<?= (int)$slot ?>">
                                            <form method="POST" action="?tab=alumni" onsubmit="return handleAlumniCardSubmit(event, this)" class="alumni-card-unified-form space-y-4" data-slot="<?= (int)$slot ?>" data-preview-id="<?= htmlspecialchars($img_preview_id) ?>">
                                                <!-- Card Top Bar -->
                                                <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num"><?= $c_num + 1 ?></span>
                                                        <span class="font-bold text-gray-800 text-sm">Alumni Card</span>
                                                    </div>
                                                    <button 
                                                        type="button" 
                                                        onclick="removeAlumniCard(<?= (int)$slot ?>, this)"
                                                        class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                                                        title="Remove this alumni card"
                                                    >
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                        <span>Remove</span>
                                                    </button>
                                                </div>

                                                <!-- 1. Photo Preview & Upload -->
                                                <div class="space-y-3">
                                                    <div class="flex items-center gap-4">
                                                        <div class="relative group rounded-full overflow-hidden border-2 border-[#C9A24B] bg-gray-100 shadow-sm w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 flex items-center justify-center">
                                                            <img 
                                                                id="<?= htmlspecialchars($img_preview_id) ?>" 
                                                                src="<?= htmlspecialchars($preview_url) ?>" 
                                                                alt="<?= htmlspecialchars($card['name']) ?>" 
                                                                class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                                                onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                                                            />
                                                        </div>
                                                        <div class="flex-1 space-y-1.5">
                                                            <label class="block text-xs font-semibold text-gray-700">
                                                                Upload Alumni Photo (WEBP / JPG &bull; Max 2.5MB)
                                                            </label>
                                                            <input 
                                                                type="file" 
                                                                name="image_file" 
                                                                accept="image/jpeg,image/png,image/webp"
                                                                onchange="previewImage(this, '<?= htmlspecialchars($img_preview_id) ?>')"
                                                                class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                                            Or Select School Photo / Custom Path:
                                                        </label>
                                                        <div class="flex flex-col sm:flex-row gap-2">
                                                            <select 
                                                                onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                                                class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                            >
                                                                <option value="">-- Choose School Photo --</option>
                                                                <?php foreach ($available_school_images as $img_file): ?>
                                                                    <option value="<?= htmlspecialchars($img_file) ?>" <?= (strpos($card['photo'], $img_file) !== false) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($img_file) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input 
                                                                type="text" 
                                                                name="custom_path" 
                                                                placeholder="assets/images/... or https://..."
                                                                value="<?= (strpos($card['photo'], 'uploads/') === false) ? htmlspecialchars(rawurldecode($card['photo'])) : '' ?>"
                                                                onchange="if(this.value){ const prv = document.getElementById('<?= htmlspecialchars($img_preview_id) ?>'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                                                class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2. Name & Passing Batch -->
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">person</span>
                                                            <span>Alumnus Full Name</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_name" 
                                                            value="<?= htmlspecialchars($card['name']) ?>"
                                                            placeholder="e.g. Pooja Sharma"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                            required
                                                        />
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">school</span>
                                                            <span>Passing Year / Batch</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_batch" 
                                                            value="<?= htmlspecialchars($card['batch']) ?>"
                                                            placeholder="e.g. Batch of 2017"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                        />
                                                    </div>
                                                </div>

                                                <!-- 3. Current Role & University / Company -->
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">work</span>
                                                            <span>Current Role / Profession</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_role" 
                                                            value="<?= htmlspecialchars($card['role']) ?>"
                                                            placeholder="e.g. Software Engineer, Doctor, Captain"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                        />
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                                            <span class="material-symbols-outlined text-[#C9A24B] text-sm">account_balance</span>
                                                            <span>Organization / University</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="card_org" 
                                                            value="<?= htmlspecialchars($card['org']) ?>"
                                                            placeholder="e.g. Microsoft India, AIIMS, IIT Delhi"
                                                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                        />
                                                    </div>
                                                </div>

                                                <!-- 4. Memory Quote / Story -->
                                                <div>
                                                    <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">format_quote</span>
                                                        <span>Alumni Quote / Message</span>
                                                    </label>
                                                    <textarea 
                                                        name="card_quote" 
                                                        rows="2"
                                                        placeholder="Enter short tribute or memory about Sun Rise School..."
                                                        class="w-full px-3.5 py-2 bg-white border border-gray-300 rounded-xl text-gray-900 text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                                                    ><?= htmlspecialchars($card['quote']) ?></textarea>
                                                </div>

                                                <!-- 5. Profile Link / LinkedIn -->
                                                <div>
                                                    <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                                        <span class="material-symbols-outlined text-[#C9A24B] text-base">link</span>
                                                        <span>LinkedIn / Social / Profile URL</span>
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="card_link" 
                                                        value="<?= htmlspecialchars($card['link']) ?>"
                                                        placeholder="https://linkedin.com/in/... (optional)"
                                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                                    />
                                                </div>

                                                <!-- Save Button -->
                                                <div class="pt-1">
                                                    <button 
                                                        type="submit" 
                                                        class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                                                    >
                                                        <span class="btn-icon material-symbols-outlined text-base">save</span>
                                                        <span class="btn-text">Save Alumni Card</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Add New Alumni Card Tile (+) -->
                                    <button 
                                        type="button" 
                                        id="add_tile_alumni"
                                        onclick="addAlumniCard()"
                                        class="min-h-[260px] rounded-2xl border-2 border-dashed border-gray-300 hover:border-[#C9A24B] bg-gray-50/40 hover:bg-[#C9A24B]/5 transition flex flex-col items-center justify-center gap-2.5 p-6 text-gray-500 hover:text-[#001129] group cursor-pointer"
                                    >
                                        <div class="w-12 h-12 rounded-full bg-white border border-gray-200 group-hover:border-[#C9A24B] group-hover:bg-[#001129] group-hover:text-[#C9A24B] flex items-center justify-center shadow-sm transition">
                                            <span class="material-symbols-outlined text-2xl">add</span>
                                        </div>
                                        <span class="font-bold text-sm">Add New Alumni Card</span>
                                        <span class="text-xs text-gray-400 text-center">Click + to add a new alumni profile to the directory</span>
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
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
                                                            <span>Upload New Photo (Auto-converted to WEBP &bull; Max 2.5MB)</span>
                                                            <span class="text-[10px] text-emerald-700 bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded font-bold">Auto WebP</span>
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
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </main>
        </div>
    </div>

    <!-- Floating Toast Notification Container -->
    <div id="adminToastContainer" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 max-w-md w-full pointer-events-none px-4" aria-live="polite"></div>

    <!-- Interactive Scripts: Live Image Preview, Quill, Seamless AJAX & Scroll Restoration -->
    <script>
        const ADMIN_CSRF_TOKEN = <?= json_encode(csrf_token()) ?>;
        const AVAILABLE_SCHOOL_IMAGES = <?= json_encode(array_values($available_school_images)) ?>;
        const MAX_IMAGE_BYTES = Math.floor(2.5 * 1024 * 1024); // 2.5 MB

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

        // Convert any selected JPG/PNG File object into a high-efficiency WebP File object
        function convertImageFileToWebp(file, quality = 0.86) {
            return new Promise((resolve) => {
                if (!file || file.type === 'image/webp') {
                    resolve(file);
                    return;
                }
                const img = new Image();
                const objectUrl = URL.createObjectURL(file);
                img.onload = function() {
                    URL.revokeObjectURL(objectUrl);
                    const canvas = document.createElement('canvas');
                    canvas.width = img.naturalWidth || img.width;
                    canvas.height = img.naturalHeight || img.height;
                    const ctx = canvas.getContext('2d');
                    if (!ctx) {
                        resolve(file);
                        return;
                    }
                    ctx.drawImage(img, 0, 0);
                    canvas.toBlob((blob) => {
                        if (!blob) {
                            resolve(file);
                            return;
                        }
                        const baseName = file.name.replace(/\.[^/.]+$/, "");
                        const webpFile = new File([blob], `${baseName}.webp`, {
                            type: 'image/webp',
                            lastModified: Date.now()
                        });
                        resolve(webpFile);
                    }, 'image/webp', quality);
                };
                img.onerror = function() {
                    URL.revokeObjectURL(objectUrl);
                    resolve(file);
                };
                img.src = objectUrl;
            });
        }

        // Live image preview reader + automatic WebP conversion
        async function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (file.size > MAX_IMAGE_BYTES) {
                    showToast("Selected file is larger than 2.5MB. Please choose an image up to 2.5MB.", "error");
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

                // Auto-convert JPG/PNG to WebP in-place inside the file input
                if (file.type !== 'image/webp') {
                    const webpFile = await convertImageFileToWebp(file);
                    if (webpFile && webpFile.type === 'image/webp' && typeof DataTransfer !== 'undefined') {
                        const dt = new DataTransfer();
                        dt.items.add(webpFile);
                        input.files = dt.files;
                    }
                }
            }
        }

        // Helper: Persist active slots list for a gallery category
        async function saveCategorySlotsList(catKey, slotsArray) {
            const val = slotsArray.length > 0 ? slotsArray.join(',') : 'NONE';
            const fd = new FormData();
            fd.append('csrf_token', ADMIN_CSRF_TOKEN);
            fd.append('page_key', 'gallery');
            fd.append('section_key', `gal_${catKey}_slots`);
            fd.append('content_type', 'text');
            fd.append('content_value', val);
            fd.append('ajax', '1');

            await fetch('save_content.php', {
                method: 'POST',
                body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
        }

        // Helper: Renumber visible cards & update badge count in a category
        function refreshCategoryCardNumbers(catKey) {
            const grid = document.getElementById(`gal_cat_grid_${catKey}`);
            if (!grid) return;
            const cards = grid.querySelectorAll('.gallery-admin-card');
            cards.forEach((card, idx) => {
                const numBadge = card.querySelector('.card-seq-num');
                if (numBadge) numBadge.textContent = idx + 1;
            });
            const badge = document.getElementById(`cat_count_badge_${catKey}`);
            if (badge) {
                badge.textContent = `${cards.length} Card(s)`;
            }
        }

        // Unified submit handler for a Gallery Category Card form (Never reloads page)
        async function handleGalleryCardSubmit(e, form) {
            if (e) e.preventDefault();
            if (!form) return false;

            const catKey    = form.getAttribute('data-cat');
            const slot      = parseInt(form.getAttribute('data-slot'), 10);
            const previewId = form.getAttribute('data-preview-id');
            const heading   = (form.elements['card_heading'] ? form.elements['card_heading'].value : '').trim();
            const fileInput = form.elements['image_file'];
            const customInp = form.elements['custom_path'];
            const hasFile   = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasCustom = customInp && customInp.value.trim() !== '';

            if (hasFile && fileInput.files[0].size > MAX_IMAGE_BYTES) {
                showToast("Selected file is larger than 2.5MB. Please choose an image up to 2.5MB.", "error");
                return false;
            }

            const btn     = form.querySelector('.submit-btn');
            const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
            const btnText = btn ? btn.querySelector('.btn-text') : null;

            if (btn) btn.disabled = true;
            if (btnText) btnText.textContent = 'Saving Card...';
            if (btnIcon) {
                btnIcon.textContent = 'progress_activity';
                btnIcon.classList.add('animate-spin');
            }

            try {
                // 1. Ensure slot is saved in category's active slots list
                const secWrap = document.querySelector(`[data-cat-section="${catKey}"]`);
                if (secWrap) {
                    const rawSlots = secWrap.getAttribute('data-cat-slots') || '';
                    const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
                    if (!slots.includes(slot)) {
                        slots.push(slot);
                        secWrap.setAttribute('data-cat-slots', slots.join(','));
                    }
                    await saveCategorySlotsList(catKey, slots);
                }

                // 2. Save Heading text via save_content.php
                const textFd = new FormData();
                textFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                textFd.append('page_key', 'gallery');
                textFd.append('section_key', `gal_${catKey}_title_${slot}`);
                textFd.append('content_type', 'text');
                textFd.append('content_value', heading);
                textFd.append('ajax', '1');

                const textRes = await fetch('save_content.php', {
                    method: 'POST',
                    body: textFd,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const textJson = await textRes.json();
                if (!textJson.success) {
                    throw new Error(textJson.message || 'Failed to save card heading.');
                }

                // 3. Save Image if uploaded or selected (auto-converted to WebP)
                if (hasFile || hasCustom) {
                    const imgFd = new FormData();
                    imgFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                    imgFd.append('page_key', 'gallery');
                    imgFd.append('image_key', `gal_${catKey}_img_${slot}`);
                    imgFd.append('alt_text', heading || 'Gallery Photo');
                    imgFd.append('ajax', '1');
                    if (hasFile) {
                        const webpFile = await convertImageFileToWebp(fileInput.files[0]);
                        imgFd.append('image_file', webpFile);
                    } else if (hasCustom) {
                        imgFd.append('custom_path', customInp.value.trim());
                    }

                    const imgRes = await fetch('upload_image.php', {
                        method: 'POST',
                        body: imgFd,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const imgJson = await imgRes.json();
                    if (!imgJson.success) {
                        throw new Error(imgJson.message || 'Failed to save card image.');
                    }
                    if (imgJson.preview_url && previewId) {
                        const prv = document.getElementById(previewId);
                        if (prv) prv.src = imgJson.preview_url;
                    }
                    if (hasFile) {
                        fileInput.value = '';
                        if (customInp) customInp.value = '';
                    }
                }

                showToast('Gallery card saved (WebP optimized)!', 'success');

                if (btn) {
                    btn.classList.remove('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    btn.classList.add('!bg-emerald-700', '!text-white');
                }
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'check';
                }
                if (btnText) btnText.textContent = 'Card Saved!';

                setTimeout(() => {
                    if (btn) {
                        btn.disabled = false;
                        btn.classList.remove('!bg-emerald-700', '!text-white');
                        btn.classList.add('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    }
                    if (btnIcon) btnIcon.textContent = 'save';
                    if (btnText) btnText.textContent = 'Save Card';
                }, 2000);
            } catch (err) {
                showToast(err.message || 'Error saving gallery card.', 'error');
                if (btn) btn.disabled = false;
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'save';
                }
                if (btnText) btnText.textContent = 'Save Card';
            }
            return false;
        }

        // Bind unified save handler to a Gallery Category Card form
        function bindGalleryCardForm(form) {
            if (!form || form.getAttribute('data-bound') === '1') return;
            form.setAttribute('data-bound', '1');
            form.onsubmit = (e) => handleGalleryCardSubmit(e, form);
        }

        // Add a new card slot dynamically to a Gallery Category
        async function addGalleryCategoryCard(catKey, catTitle) {
            const secWrap = document.querySelector(`[data-cat-section="${catKey}"]`);
            const grid    = document.getElementById(`gal_cat_grid_${catKey}`);
            const addTile = document.getElementById(`add_tile_${catKey}`);
            if (!secWrap || !grid || !addTile) return;

            const rawSlots = secWrap.getAttribute('data-cat-slots') || '';
            const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
            const nextSlot = slots.length > 0 ? (Math.max(...slots) + 1) : 1;
            slots.push(nextSlot);
            secWrap.setAttribute('data-cat-slots', slots.join(','));

            const previewId = `gal_prv_${catKey}_${nextSlot}`;
            const optionsHtml = AVAILABLE_SCHOOL_IMAGES.map(img => 
                `<option value="${img.replace(/"/g, '&quot;')}">${img}</option>`
            ).join('');

            const cardEl = document.createElement('div');
            cardEl.className = 'gallery-admin-card rounded-2xl border-2 border-[#C9A24B] bg-amber-50/20 p-5 shadow-md transition flex flex-col justify-between';
            cardEl.setAttribute('data-cat', catKey);
            cardEl.setAttribute('data-slot', nextSlot);

            cardEl.innerHTML = `
                <form method="POST" action="?tab=gallery" onsubmit="return handleGalleryCardSubmit(event, this)" class="gallery-card-unified-form space-y-4" data-cat="${catKey}" data-slot="${nextSlot}" data-preview-id="${previewId}">
                    <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num">${slots.length}</span>
                            <span class="font-bold text-gray-800 text-sm">New Photo Card</span>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-amber-100 text-amber-800">New</span>
                        </div>
                        <button 
                            type="button" 
                            onclick="removeGalleryCategoryCard('${catKey}', ${nextSlot}, this)"
                            class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                            title="Remove this card"
                        >
                            <span class="material-symbols-outlined text-sm">delete</span>
                            <span>Remove</span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm aspect-video flex items-center justify-center">
                            <img 
                                id="${previewId}" 
                                src="../assets/images/logo.svg" 
                                alt="New Card Preview"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                            />
                            <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/75 text-white text-[10px] font-medium backdrop-blur-sm flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                Select or Upload Image
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">
                                Upload Photo (Auto-converted to WEBP &bull; Max 2.5MB)
                            </label>
                            <input 
                                type="file" 
                                name="image_file" 
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewImage(this, '${previewId}')"
                                class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                            />
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                Or Select School Image / Custom Path:
                            </label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select 
                                    onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('${previewId}'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                    class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                >
                                    <option value="">-- Choose School Photo --</option>
                                    ${optionsHtml}
                                </select>
                                <input 
                                    type="text" 
                                    name="custom_path" 
                                    placeholder="assets/images/... or https://..."
                                    value=""
                                    onchange="if(this.value){ const prv = document.getElementById('${previewId}'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                    class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#C9A24B] text-base">title</span>
                            <span>Heading on Image</span>
                        </label>
                        <input 
                            type="text" 
                            name="card_heading" 
                            value=""
                            placeholder="Enter heading to display on photo..."
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-900 text-sm font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                        />
                    </div>

                    <div class="pt-1">
                        <button 
                            type="submit" 
                            class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                        >
                            <span class="btn-icon material-symbols-outlined text-base">save</span>
                            <span class="btn-text">Save Card</span>
                        </button>
                    </div>
                </form>
            `;

            grid.insertBefore(cardEl, addTile);
            const newForm = cardEl.querySelector('.gallery-card-unified-form');
            if (newForm) bindGalleryCardForm(newForm);

            refreshCategoryCardNumbers(catKey);
            await saveCategorySlotsList(catKey, slots);

            cardEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            const headingInp = cardEl.querySelector('input[name="card_heading"]');
            if (headingInp) setTimeout(() => headingInp.focus(), 300);
            showToast('New card added! Upload an image and enter a heading, then click Save Card.', 'success');
        }

        // Remove a card from a Gallery Category
        async function removeGalleryCategoryCard(catKey, slot, btnEl) {
            if (!confirm('Are you sure you want to remove this photo card?')) return;
            const secWrap = document.querySelector(`[data-cat-section="${catKey}"]`);
            if (!secWrap) return;

            const rawSlots = secWrap.getAttribute('data-cat-slots') || '';
            const slots = rawSlots
                .split(',')
                .map(n => parseInt(n, 10))
                .filter(n => n > 0 && n !== slot);

            secWrap.setAttribute('data-cat-slots', slots.join(','));
            const cardEl = btnEl.closest('.gallery-admin-card');
            if (cardEl) cardEl.remove();

            refreshCategoryCardNumbers(catKey);
            await saveCategorySlotsList(catKey, slots);
            showToast('Card removed from category.', 'success');
        }

        // Helper: Quick save single text field (e.g. section eyebrow or heading)
        async function saveQuickField(pageKey, sectionKey, val) {
            const fd = new FormData();
            fd.append('csrf_token', ADMIN_CSRF_TOKEN);
            fd.append('page_key', pageKey);
            fd.append('section_key', sectionKey);
            fd.append('content_type', 'text');
            fd.append('content_value', val);
            fd.append('ajax', '1');

            try {
                const res = await fetch('save_content.php', {
                    method: 'POST',
                    body: fd,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                if (data.success) {
                    showToast('Section heading updated!', 'success');
                }
            } catch (err) {
                console.error(err);
            }
        }

        // Helper: Persist active slots list for Event News Cards
        async function saveEventNewsSlotsList(slotsArray) {
            const val = slotsArray.length > 0 ? slotsArray.join(',') : 'NONE';
            const fd = new FormData();
            fd.append('csrf_token', ADMIN_CSRF_TOKEN);
            fd.append('page_key', 'events');
            fd.append('section_key', 'event_news_slots');
            fd.append('content_type', 'text');
            fd.append('content_value', val);
            fd.append('ajax', '1');

            await fetch('save_content.php', {
                method: 'POST',
                body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
        }

        // Helper: Renumber visible Event Cards & update badge count
        function refreshEventNewsCardNumbers() {
            const grid = document.getElementById('event_news_grid');
            if (!grid) return;
            const cards = grid.querySelectorAll('.event-news-admin-card');
            cards.forEach((card, idx) => {
                const numBadge = card.querySelector('.card-seq-num');
                if (numBadge) numBadge.textContent = idx + 1;
            });
            const badge = document.getElementById('event_news_count_badge');
            if (badge) {
                badge.textContent = `${cards.length} Card(s)`;
            }
        }

        // Unified submit handler for an Event News Card form (Zero reload)
        async function handleEventNewsCardSubmit(e, form) {
            if (e) e.preventDefault();
            if (!form) return false;

            const slot        = parseInt(form.getAttribute('data-slot'), 10);
            const previewId   = form.getAttribute('data-preview-id');
            const cardDate    = (form.elements['card_date'] ? form.elements['card_date'].value : '').trim();
            const cardTag     = (form.elements['card_tag'] ? form.elements['card_tag'].value : '').trim();
            const cardCategory= (form.elements['card_category'] ? form.elements['card_category'].value : 'academic').trim();
            const cardTitle   = (form.elements['card_title'] ? form.elements['card_title'].value : '').trim();
            const cardDesc    = (form.elements['card_desc'] ? form.elements['card_desc'].value : '').trim();
            const cardLinkText= (form.elements['card_link_text'] ? form.elements['card_link_text'].value : 'Read More').trim();
            const cardLinkUrl = (form.elements['card_link_url'] ? form.elements['card_link_url'].value : 'gallery.php').trim();
            const fileInput   = form.elements['image_file'];
            const customInp   = form.elements['custom_path'];
            const hasFile     = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasCustom   = customInp && customInp.value.trim() !== '';

            if (hasFile && fileInput.files[0].size > MAX_IMAGE_BYTES) {
                showToast("Selected file is larger than 2.5MB. Please choose an image up to 2.5MB.", "error");
                return false;
            }

            const btn     = form.querySelector('.submit-btn');
            const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
            const btnText = btn ? btn.querySelector('.btn-text') : null;

            if (btn) btn.disabled = true;
            if (btnText) btnText.textContent = 'Saving Card...';
            if (btnIcon) {
                btnIcon.textContent = 'progress_activity';
                btnIcon.classList.add('animate-spin');
            }

            try {
                // 1. Ensure slot is in event_news_slots list
                const secWrap = document.querySelector('[data-event-news-section="1"]');
                if (secWrap) {
                    const rawSlots = secWrap.getAttribute('data-event-slots') || '';
                    const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
                    if (!slots.includes(slot)) {
                        slots.push(slot);
                        secWrap.setAttribute('data-event-slots', slots.join(','));
                    }
                    await saveEventNewsSlotsList(slots);
                }

                // 2. Save text fields
                const fieldsToSave = [
                    { key: `news${slot}_date`, val: cardDate },
                    { key: `news${slot}_tag`, val: cardTag },
                    { key: `news${slot}_cat`, val: cardCategory },
                    { key: `news${slot}_title`, val: cardTitle },
                    { key: `news${slot}_desc`, val: cardDesc },
                    { key: `news${slot}_link_text`, val: cardLinkText },
                    { key: `news${slot}_link_url`, val: cardLinkUrl }
                ];

                for (const item of fieldsToSave) {
                    const textFd = new FormData();
                    textFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                    textFd.append('page_key', 'events');
                    textFd.append('section_key', item.key);
                    textFd.append('content_type', 'text');
                    textFd.append('content_value', item.val);
                    textFd.append('ajax', '1');

                    await fetch('save_content.php', {
                        method: 'POST',
                        body: textFd,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                }

                // 3. Save Image if uploaded or selected
                if (hasFile || hasCustom) {
                    const imgFd = new FormData();
                    imgFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                    imgFd.append('page_key', 'events');
                    imgFd.append('image_key', `news${slot}_img`);
                    imgFd.append('alt_text', cardTitle || 'Event Highlight Photo');
                    imgFd.append('ajax', '1');
                    if (hasFile) {
                        const webpFile = await convertImageFileToWebp(fileInput.files[0]);
                        imgFd.append('image_file', webpFile);
                    } else if (hasCustom) {
                        imgFd.append('custom_path', customInp.value.trim());
                    }

                    const imgRes = await fetch('upload_image.php', {
                        method: 'POST',
                        body: imgFd,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const imgJson = await imgRes.json();
                    if (!imgJson.success) {
                        throw new Error(imgJson.message || 'Failed to save event photo.');
                    }
                    if (imgJson.preview_url && previewId) {
                        const prv = document.getElementById(previewId);
                        if (prv) prv.src = imgJson.preview_url;
                    }
                    if (hasFile) {
                        fileInput.value = '';
                        if (customInp) customInp.value = '';
                    }
                }

                showToast('Event card saved successfully!', 'success');

                if (btn) {
                    btn.classList.remove('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    btn.classList.add('!bg-emerald-700', '!text-white');
                }
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'check';
                }
                if (btnText) btnText.textContent = 'Card Saved!';

                setTimeout(() => {
                    if (btn) {
                        btn.disabled = false;
                        btn.classList.remove('!bg-emerald-700', '!text-white');
                        btn.classList.add('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    }
                    if (btnIcon) btnIcon.textContent = 'save';
                    if (btnText) btnText.textContent = 'Save Event Card';
                }, 2000);
            } catch (err) {
                showToast(err.message || 'Error saving event card.', 'error');
                if (btn) btn.disabled = false;
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'save';
                }
                if (btnText) btnText.textContent = 'Save Event Card';
            }
            return false;
        }

        // Bind handler to an Event News Card form
        function bindEventNewsCardForm(form) {
            if (!form || form.getAttribute('data-bound') === '1') return;
            form.setAttribute('data-bound', '1');
            form.onsubmit = (e) => handleEventNewsCardSubmit(e, form);
        }

        // Add a new dynamic Event News Card
        async function addEventNewsCard() {
            const secWrap = document.querySelector('[data-event-news-section="1"]');
            const grid    = document.getElementById('event_news_grid');
            const addTile = document.getElementById('add_tile_event_news');
            if (!secWrap || !grid || !addTile) return;

            const rawSlots = secWrap.getAttribute('data-event-slots') || '';
            const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
            const nextSlot = slots.length > 0 ? (Math.max(...slots) + 1) : 1;
            slots.push(nextSlot);
            secWrap.setAttribute('data-event-slots', slots.join(','));

            const previewId = `event_news_prv_${nextSlot}`;
            const optionsHtml = AVAILABLE_SCHOOL_IMAGES.map(img => 
                `<option value="${img.replace(/"/g, '&quot;')}">${img}</option>`
            ).join('');

            const cardEl = document.createElement('div');
            cardEl.className = 'event-news-admin-card rounded-2xl border-2 border-[#C9A24B] bg-amber-50/20 p-5 shadow-md transition flex flex-col justify-between';
            cardEl.setAttribute('data-slot', nextSlot);

            const now = new Date();
            const months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
            const defaultDate = `${String(now.getDate()).padStart(2, '0')} ${months[now.getMonth()]}`;

            cardEl.innerHTML = `
                <form method="POST" action="?tab=events" onsubmit="return handleEventNewsCardSubmit(event, this)" class="event-card-unified-form space-y-4" data-slot="${nextSlot}" data-preview-id="${previewId}">
                    <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num">${slots.length}</span>
                            <span class="font-bold text-gray-800 text-sm">New Event Card</span>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-amber-100 text-amber-800">New</span>
                        </div>
                        <button 
                            type="button" 
                            onclick="removeEventNewsCard(${nextSlot}, this)"
                            class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                            title="Remove this card"
                        >
                            <span class="material-symbols-outlined text-sm">delete</span>
                            <span>Remove</span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div class="relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-100 shadow-sm aspect-video flex items-center justify-center">
                            <img 
                                id="${previewId}" 
                                src="../assets/images/logo.svg" 
                                alt="Event Image"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                            />
                            <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/75 text-white text-[10px] font-medium backdrop-blur-sm flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                New Image
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">
                                Upload Photo (Auto-converted to WEBP &bull; Max 2.5MB)
                            </label>
                            <input 
                                type="file" 
                                name="image_file" 
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewImage(this, '${previewId}')"
                                class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                            />
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                Or Select School Image / Custom Path:
                            </label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select 
                                    onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('${previewId}'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                    class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                >
                                    <option value="">-- Choose School Photo --</option>
                                    ${optionsHtml}
                                </select>
                                <input 
                                    type="text" 
                                    name="custom_path" 
                                    placeholder="assets/images/... or https://..."
                                    value=""
                                    onchange="if(this.value){ const prv = document.getElementById('${previewId}'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                    class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">calendar_month</span>
                                <span>Date (Day &amp; Month)</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_date" 
                                value="${defaultDate}"
                                placeholder="e.g. 24 OCT"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#C9A24B] outline-none uppercase"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">label</span>
                                <span>Tag on Image</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_tag" 
                                value="Event"
                                placeholder="e.g. Science Fair, Honors"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">filter_list</span>
                                <span>Filter Category</span>
                            </label>
                            <select 
                                name="card_category"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none cursor-pointer"
                            >
                                <option value="academic" selected>Academic</option>
                                <option value="cultural">Celebrations</option>
                                <option value="campus">Campus</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[#C9A24B] text-base">title</span>
                                <span>Headline / Title</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_title" 
                                value=""
                                placeholder="Enter event / news title..."
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-900 text-sm font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[#C9A24B] text-base">notes</span>
                                <span>Short Description / Summary</span>
                            </label>
                            <textarea 
                                name="card_desc" 
                                rows="2"
                                placeholder="Enter brief summary of the event..."
                                class="w-full p-3 bg-white border border-gray-300 rounded-xl text-gray-900 text-xs focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none resize-none leading-relaxed"
                            ></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Button Text</label>
                            <input 
                                type="text" 
                                name="card_link_text" 
                                value="Read More"
                                placeholder="Read More"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Target Page URL</label>
                            <input 
                                type="text" 
                                name="card_link_url" 
                                value="gallery.php"
                                placeholder="gallery.php / about-us.php"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono"
                            />
                        </div>
                    </div>

                    <div class="pt-1">
                        <button 
                            type="submit" 
                            class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                        >
                            <span class="btn-icon material-symbols-outlined text-base">save</span>
                            <span class="btn-text">Save Event Card</span>
                        </button>
                    </div>
                </form>
            `;

            grid.insertBefore(cardEl, addTile);
            const newForm = cardEl.querySelector('.event-card-unified-form');
            if (newForm) bindEventNewsCardForm(newForm);

            refreshEventNewsCardNumbers();
            await saveEventNewsSlotsList(slots);

            cardEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            const titleInp = cardEl.querySelector('input[name="card_title"]');
            if (titleInp) setTimeout(() => titleInp.focus(), 300);
            showToast('New event card added! Fill in the details and click Save Event Card.', 'success');
        }

        // Remove an Event News Card
        async function removeEventNewsCard(slot, btnEl) {
            if (!confirm('Are you sure you want to remove this event card?')) return;
            const secWrap = document.querySelector('[data-event-news-section="1"]');
            if (!secWrap) return;

            const rawSlots = secWrap.getAttribute('data-event-slots') || '';
            const slots = rawSlots
                .split(',')
                .map(n => parseInt(n, 10))
                .filter(n => n > 0 && n !== slot);

            secWrap.setAttribute('data-event-slots', slots.join(','));
            const cardEl = btnEl.closest('.event-news-admin-card');
            if (cardEl) cardEl.remove();

            refreshEventNewsCardNumbers();
            await saveEventNewsSlotsList(slots);
            showToast('Event card removed.', 'success');
        }

        // ==========================================
        // ALUMNI DYNAMIC CARDS MANAGER (Zero Reload)
        // ==========================================
        async function saveAlumniSlotsList(slotsArray) {
            const val = slotsArray.length > 0 ? slotsArray.join(',') : 'NONE';
            const fd = new FormData();
            fd.append('csrf_token', ADMIN_CSRF_TOKEN);
            fd.append('page_key', 'alumni');
            fd.append('section_key', 'alumni_slots');
            fd.append('content_type', 'text');
            fd.append('content_value', val);
            fd.append('ajax', '1');

            await fetch('save_content.php', {
                method: 'POST',
                body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
        }

        function refreshAlumniCardNumbers() {
            const cards = document.querySelectorAll('#alumni_cards_grid .alumni-admin-card');
            cards.forEach((card, idx) => {
                const seq = card.querySelector('.card-seq-num');
                if (seq) seq.textContent = idx + 1;
            });
            const badge = document.getElementById('alumni_count_badge');
            if (badge) badge.textContent = `${cards.length} Card(s)`;
        }

        async function handleAlumniCardSubmit(e, form) {
            if (e) e.preventDefault();
            if (!form) return false;

            const slot        = parseInt(form.getAttribute('data-slot'), 10);
            const previewId   = form.getAttribute('data-preview-id');
            const cardName    = (form.elements['card_name'] ? form.elements['card_name'].value : '').trim();
            const cardBatch   = (form.elements['card_batch'] ? form.elements['card_batch'].value : '').trim();
            const cardRole    = (form.elements['card_role'] ? form.elements['card_role'].value : '').trim();
            const cardOrg     = (form.elements['card_org'] ? form.elements['card_org'].value : '').trim();
            const cardQuote   = (form.elements['card_quote'] ? form.elements['card_quote'].value : '').trim();
            const cardLink    = (form.elements['card_link'] ? form.elements['card_link'].value : '').trim();
            const fileInput   = form.elements['image_file'];
            const customInp   = form.elements['custom_path'];
            const hasFile     = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasCustom   = customInp && customInp.value.trim() !== '';

            if (!cardName) {
                showToast("Please provide the alumnus full name.", "error");
                return false;
            }

            if (hasFile && fileInput.files[0].size > MAX_IMAGE_BYTES) {
                showToast("Selected file is larger than 2.5MB. Please choose an image up to 2.5MB.", "error");
                return false;
            }

            const btn     = form.querySelector('.submit-btn');
            const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
            const btnText = btn ? btn.querySelector('.btn-text') : null;

            if (btn) btn.disabled = true;
            if (btnText) btnText.textContent = 'Saving Card...';
            if (btnIcon) {
                btnIcon.textContent = 'progress_activity';
                btnIcon.classList.add('animate-spin');
            }

            try {
                // 1. Ensure slot is in alumni_slots list
                const secWrap = document.querySelector('[data-alumni-section="1"]');
                if (secWrap) {
                    const rawSlots = secWrap.getAttribute('data-alumni-slots') || '';
                    const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
                    if (!slots.includes(slot)) {
                        slots.push(slot);
                        secWrap.setAttribute('data-alumni-slots', slots.join(','));
                    }
                    await saveAlumniSlotsList(slots);
                }

                // 2. Save text fields
                const fieldsToSave = [
                    { key: `alumni_${slot}_name`, val: cardName },
                    { key: `alumni_${slot}_batch`, val: cardBatch },
                    { key: `alumni_${slot}_role`, val: cardRole },
                    { key: `alumni_${slot}_org`, val: cardOrg },
                    { key: `alumni_${slot}_quote`, val: cardQuote },
                    { key: `alumni_${slot}_link`, val: cardLink }
                ];

                for (const item of fieldsToSave) {
                    const textFd = new FormData();
                    textFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                    textFd.append('page_key', 'alumni');
                    textFd.append('section_key', item.key);
                    textFd.append('content_type', 'text');
                    textFd.append('content_value', item.val);
                    textFd.append('ajax', '1');

                    await fetch('save_content.php', {
                        method: 'POST',
                        body: textFd,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                }

                // 3. Save Image if uploaded or selected
                if (hasFile || hasCustom) {
                    const imgFd = new FormData();
                    imgFd.append('csrf_token', ADMIN_CSRF_TOKEN);
                    imgFd.append('page_key', 'alumni');
                    imgFd.append('image_key', `alumni_${slot}_photo`);
                    imgFd.append('alt_text', cardName + ' - Sun Rise Alumni');
                    imgFd.append('ajax', '1');
                    if (hasFile) {
                        const webpFile = await convertImageFileToWebp(fileInput.files[0]);
                        imgFd.append('image_file', webpFile);
                    } else if (hasCustom) {
                        imgFd.append('custom_path', customInp.value.trim());
                    }

                    const imgRes = await fetch('upload_image.php', {
                        method: 'POST',
                        body: imgFd,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const imgJson = await imgRes.json();
                    if (!imgJson.success) {
                        throw new Error(imgJson.message || 'Failed to save alumni photo.');
                    }
                    if (imgJson.preview_url && previewId) {
                        const prv = document.getElementById(previewId);
                        if (prv) prv.src = imgJson.preview_url;
                    }
                    if (hasFile) {
                        fileInput.value = '';
                        if (customInp) customInp.value = '';
                    }
                }

                showToast('Alumni card saved successfully!', 'success');

                if (btn) {
                    btn.classList.remove('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    btn.classList.add('!bg-emerald-700', '!text-white');
                }
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'check';
                }
                if (btnText) btnText.textContent = 'Card Saved!';

                setTimeout(() => {
                    if (btn) {
                        btn.disabled = false;
                        btn.classList.remove('!bg-emerald-700', '!text-white');
                        btn.classList.add('bg-[#C9A24B]', 'hover:bg-[#B38C37]', 'text-[#001129]');
                    }
                    if (btnIcon) btnIcon.textContent = 'save';
                    if (btnText) btnText.textContent = 'Save Alumni Card';
                }, 2000);
            } catch (err) {
                showToast(err.message || 'Error saving alumni card.', 'error');
                if (btn) btn.disabled = false;
                if (btnIcon) {
                    btnIcon.classList.remove('animate-spin');
                    btnIcon.textContent = 'save';
                }
                if (btnText) btnText.textContent = 'Save Alumni Card';
            }
            return false;
        }

        function bindAlumniCardForm(form) {
            if (!form || form.getAttribute('data-bound') === '1') return;
            form.setAttribute('data-bound', '1');
            form.onsubmit = (e) => handleAlumniCardSubmit(e, form);
        }

        async function addAlumniCard() {
            const secWrap = document.querySelector('[data-alumni-section="1"]');
            const grid    = document.getElementById('alumni_cards_grid');
            const addTile = document.getElementById('add_tile_alumni');
            if (!secWrap || !grid || !addTile) return;

            const rawSlots = secWrap.getAttribute('data-alumni-slots') || '';
            const slots = rawSlots ? rawSlots.split(',').map(n => parseInt(n, 10)).filter(n => n > 0) : [];
            const nextSlot = slots.length > 0 ? (Math.max(...slots) + 1) : 1;
            slots.push(nextSlot);
            secWrap.setAttribute('data-alumni-slots', slots.join(','));

            const previewId = `alumni_prv_${nextSlot}`;
            const optionsHtml = AVAILABLE_SCHOOL_IMAGES.map(img => 
                `<option value="${img.replace(/"/g, '&quot;')}">${img}</option>`
            ).join('');

            const cardEl = document.createElement('div');
            cardEl.className = 'alumni-admin-card rounded-2xl border-2 border-[#C9A24B] bg-amber-50/20 p-5 shadow-md transition flex flex-col justify-between';
            cardEl.setAttribute('data-slot', nextSlot);

            cardEl.innerHTML = `
                <form method="POST" action="?tab=alumni" onsubmit="return handleAlumniCardSubmit(event, this)" class="alumni-card-unified-form space-y-4" data-slot="${nextSlot}" data-preview-id="${previewId}">
                    <div class="flex items-center justify-between border-b border-gray-200/80 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#001129] text-[#C9A24B] text-xs font-bold flex items-center justify-center card-seq-num">${slots.length}</span>
                            <span class="font-bold text-gray-800 text-sm">New Alumni Profile</span>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-amber-100 text-amber-800">New</span>
                        </div>
                        <button 
                            type="button" 
                            onclick="removeAlumniCard(${nextSlot}, this)"
                            class="text-xs text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-lg font-semibold flex items-center gap-1 transition cursor-pointer"
                            title="Remove this card"
                        >
                            <span class="material-symbols-outlined text-sm">delete</span>
                            <span>Remove</span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <div class="relative group rounded-full overflow-hidden border-2 border-[#C9A24B] bg-gray-100 shadow-sm w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 flex items-center justify-center">
                                <img 
                                    id="${previewId}" 
                                    src="../assets/images/logo.svg" 
                                    alt="Alumni Photo" 
                                    class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                    onerror="this.onerror=null; this.src='../assets/images/logo.svg';"
                                />
                            </div>
                            <div class="flex-1 space-y-1.5">
                                <label class="block text-xs font-semibold text-gray-700">
                                    Upload Alumni Photo (WEBP / JPG &bull; Max 2.5MB)
                                </label>
                                <input 
                                    type="file" 
                                    name="image_file" 
                                    accept="image/jpeg,image/png,image/webp"
                                    onchange="previewImage(this, '${previewId}')"
                                    class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-white"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">
                                Or Select School Photo / Custom Path:
                            </label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select 
                                    onchange="if(this.value){ const inp = this.form.elements['custom_path']; inp.value = 'assets/images/sunrise school image/' + this.value; const prv = document.getElementById('${previewId}'); if(prv){ prv.src = '../assets/images/sunrise%20school%20image/' + encodeURIComponent(this.value); } }" 
                                    class="sm:w-1/2 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                >
                                    <option value="">-- Choose School Photo --</option>
                                    ${optionsHtml}
                                </select>
                                <input 
                                    type="text" 
                                    name="custom_path" 
                                    placeholder="assets/images/... or https://..."
                                    value=""
                                    onchange="if(this.value){ const prv = document.getElementById('${previewId}'); if(prv){ prv.src = (this.value.startsWith('http') ? this.value : '../' + this.value); } }"
                                    class="flex-1 px-2.5 py-1.5 bg-white border border-gray-300 rounded-lg text-gray-800 text-xs focus:ring-2 focus:ring-[#C9A24B] outline-none font-mono"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">person</span>
                                <span>Alumnus Full Name</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_name" 
                                value=""
                                placeholder="e.g. Alumnus Name"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#C9A24B] outline-none"
                                required
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">school</span>
                                <span>Passing Year / Batch</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_batch" 
                                value="Batch of 2022"
                                placeholder="e.g. Batch of 2018"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">work</span>
                                <span>Current Role / Profession</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_role" 
                                value=""
                                placeholder="e.g. Software Engineer, Doctor, Officer"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[#C9A24B] text-sm">account_balance</span>
                                <span>Organization / University</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_org" 
                                value=""
                                placeholder="e.g. Company or University Name"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] outline-none"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#C9A24B] text-base">format_quote</span>
                            <span>Alumni Quote / Message</span>
                        </label>
                        <textarea 
                            name="card_quote" 
                            rows="2"
                            placeholder="Enter short tribute or memory about Sun Rise School..."
                            class="w-full px-3.5 py-2 bg-white border border-gray-300 rounded-xl text-gray-900 text-xs font-medium focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] outline-none"
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#C9A24B] text-base">link</span>
                            <span>LinkedIn / Social / Profile URL</span>
                        </label>
                        <input 
                            type="text" 
                            name="card_link" 
                            value=""
                            placeholder="https://linkedin.com/in/... (optional)"
                            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-xl text-xs font-mono text-gray-700 focus:ring-2 focus:ring-[#C9A24B] outline-none"
                        />
                    </div>

                    <div class="pt-1">
                        <button 
                            type="submit" 
                            class="submit-btn w-full py-2.5 px-4 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-xl shadow-sm hover:shadow transition flex items-center justify-center gap-1.5 cursor-pointer"
                        >
                            <span class="btn-icon material-symbols-outlined text-base">save</span>
                            <span class="btn-text">Save Alumni Card</span>
                        </button>
                    </div>
                </form>
            `;

            grid.insertBefore(cardEl, addTile);
            bindAlumniCardForm(cardEl.querySelector('form'));
            refreshAlumniCardNumbers();
            await saveAlumniSlotsList(slots);

            const nameInp = cardEl.querySelector('input[name="card_name"]');
            if (nameInp) setTimeout(() => nameInp.focus(), 300);
            showToast('New alumni card added! Fill in the details and click Save Alumni Card.', 'success');
        }

        async function removeAlumniCard(slot, btnEl) {
            if (!confirm('Are you sure you want to remove this alumni card?')) return;
            const secWrap = document.querySelector('[data-alumni-section="1"]');
            if (!secWrap) return;

            const rawSlots = secWrap.getAttribute('data-alumni-slots') || '';
            const slots = rawSlots
                .split(',')
                .map(n => parseInt(n, 10))
                .filter(n => n > 0 && n !== slot);

            secWrap.setAttribute('data-alumni-slots', slots.join(','));
            const cardEl = btnEl.closest('.alumni-admin-card');
            if (cardEl) cardEl.remove();

            refreshAlumniCardNumbers();
            await saveAlumniSlotsList(slots);
            showToast('Alumni card removed.', 'success');
        }

        // Global map of Quill editor instances
        window.quillMap = {};

        // Initialize all active Quill Rich Text Editors
        document.addEventListener('DOMContentLoaded', () => {
            // Bind all Gallery Category Card forms, Event News Card forms & Alumni Card forms
            document.querySelectorAll('.gallery-card-unified-form').forEach(bindGalleryCardForm);
            document.querySelectorAll('.event-card-unified-form').forEach(bindEventNewsCardForm);
            document.querySelectorAll('.alumni-card-unified-form').forEach(bindAlumniCardForm);

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

            // 4. AJAX Submission for Image Forms (Zero Page Reload, Auto WebP Conversion & Instant Preview)
            document.querySelectorAll('.ajax-image-form').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const fileInput = form.querySelector('input[type="file"]');
                    const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
                    if (hasFile && fileInput.files[0].size > MAX_IMAGE_BYTES) {
                        showToast("Selected file is larger than 2.5MB. Please choose an image up to 2.5MB.", "error");
                        return;
                    }

                    const btn = form.querySelector('.submit-btn');
                    const btnIcon = btn ? btn.querySelector('.btn-icon') : null;
                    const btnText = btn ? btn.querySelector('.btn-text') : null;
                    const origText = btnText ? btnText.textContent : 'Save / Replace Image';
                    const origIcon = btnIcon ? btnIcon.textContent : 'cloud_upload';
                    const previewId = form.getAttribute('data-preview-id');

                    // Save current scroll position
                    sessionStorage.setItem('admin_scroll_y', window.scrollY);

                    if (btn) btn.disabled = true;
                    if (btnText) btnText.textContent = 'Converting & Saving...';
                    if (btnIcon) {
                        btnIcon.textContent = 'progress_activity';
                        btnIcon.classList.add('animate-spin');
                    }

                    try {
                        const formData = new FormData(form);
                        if (hasFile) {
                            const webpFile = await convertImageFileToWebp(fileInput.files[0]);
                            formData.set('image_file', webpFile);
                        }

                        const response = await fetch('upload_image.php', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            showToast(result.message || 'Image converted to WebP and saved!', 'success');

                            // Instant live preview update
                            if (result.preview_url && previewId) {
                                const previewImg = document.getElementById(previewId);
                                if (previewImg) {
                                    previewImg.src = result.preview_url;
                                }
                            }

                            // Clear file input
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
