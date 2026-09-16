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
        if (strpos($src, 'http://') === 0 || strpos($src, 'https://') === 0) {
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

// Define all editable sections grouped by page, ordered strictly from top to bottom
$pages_config = [
    'home' => [
        'title' => 'Home Page',
        'icon'  => 'home',
        'desc'  => 'Main landing page: Hero, Legacy Stats, 3 Pillars, Principal Message, Events, Glimpses & CTA',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Main Headings',
                'icon'  => 'flag',
                'desc'  => 'Top full-screen banner, affiliation badge, main headline, and intro subtitle.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Hero Banner Background Image',
                        'default' => 'assets/images/sunrise school image/school_home1.webp',
                        'alt' => 'Sun Rise School Main Entrance and Campus',
                        'help' => 'Large background photo at the top of the homepage (recommended: 1920x1080).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Affiliation Badge / Eyebrow',
                        'type' => 'text',
                        'default' => 'AFFILIATED TO HBSC • PRE-PRIMARY TO SENIOR SECONDARY (10+2)',
                        'help' => 'Top pill badge displayed in the hero section.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Main Hero Headline',
                        'type' => 'html',
                        'default' => 'Empowering Minds, Inspiring Character & <span class="text-[#C9A24B] italic">Academic Excellence</span>',
                        'help' => 'Primary headline on homepage (rich formatting allowed).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Hero Intro Paragraph',
                        'type' => 'text',
                        'default' => 'Welcome to Sun Rise Sr. Sec. School, Dobhi. We foster an enriching educational environment combining rigorous HBSC scholarship, moral values, modern technology, and sportsmanship.',
                        'help' => 'Subtitle text below the main hero headline.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: The Sun Rise Legacy & Key Statistics',
                'icon'  => 'history_edu',
                'desc'  => 'Institutional overview, mission statement, and 5 highlight stat counters.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'legacy_tagline',
                        'label' => 'Spotlight Eyebrow Tagline',
                        'type' => 'text',
                        'default' => 'THE SUN RISE LEGACY',
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
                        'default' => "At Sun Rise Sr. Sec. School, Dobhi, we are dedicated to nurturing each student's intellectual, physical, and moral growth. Through cutting-edge science labs, dedicated sports facilities, and exemplary faculty mentorship, our students consistently achieve top honours in HBSC board exams and competitive Olympiads.",
                        'help' => 'Detailed introductory overview paragraph.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_pass_rate',
                        'label' => 'Stat 1: HBSC Board Pass Result',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Percentage or number for board pass rate.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_student_ratio',
                        'label' => 'Stat 2: Teacher-to-Student Ratio',
                        'type' => 'text',
                        'default' => '1:15',
                        'help' => 'Class ratio of teachers to students.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_years_service',
                        'label' => 'Stat 3: Years of Service',
                        'type' => 'text',
                        'default' => '20+',
                        'help' => 'Number of years school has been operating.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_enrolled_scholars',
                        'label' => 'Stat 4: Enrolled Scholars',
                        'type' => 'text',
                        'default' => '1,500+',
                        'help' => 'Total enrolled student count.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat_dedicated_staff',
                        'label' => 'Stat 5: Dedicated Staff',
                        'type' => 'text',
                        'default' => '50+',
                        'help' => 'Total faculty and staff members.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Three Pillars of Holistic Development',
                'icon'  => 'view_column',
                'desc'  => 'Three feature cards: Academics & Labs, Sports & Fitness, Innovation & Art.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'pillars_eyebrow',
                        'label' => 'Pillars Eyebrow',
                        'type' => 'text',
                        'default' => 'WHY CHOOSE SUN RISE',
                        'help' => 'Small uppercase tag above the section headline.'
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
                        'label' => 'Pillar 1 Card Image (Academics)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Science Labs and Academic Exhibition',
                        'help' => 'Photo for the Academics & Labs card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card1_tag',
                        'label' => 'Pillar 1 Category Tag',
                        'type' => 'text',
                        'default' => 'HBSC CURRICULUM',
                        'help' => 'Tag for card 1.'
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
                    // Pillar 2
                    [
                        'kind' => 'image',
                        'key' => 'card2_image',
                        'label' => 'Pillar 2 Card Image (Sports)',
                        'default' => 'assets/images/sunrise school image/students_ground.webp',
                        'alt' => 'School Playground and Sports Arena',
                        'help' => 'Photo for the Sports & Athletics card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card2_tag',
                        'label' => 'Pillar 2 Category Tag',
                        'type' => 'text',
                        'default' => 'ATHLETICS & FITNESS',
                        'help' => 'Tag for card 2.'
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
                    // Pillar 3
                    [
                        'kind' => 'image',
                        'key' => 'card3_image',
                        'label' => 'Pillar 3 Card Image (Innovation)',
                        'default' => 'assets/images/sunrise school image/exhibition.webp',
                        'alt' => 'Innovation and Student Projects',
                        'help' => 'Photo for the Innovation & Exhibitions card.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'card3_tag',
                        'label' => 'Pillar 3 Category Tag',
                        'type' => 'text',
                        'default' => 'INNOVATION & ART',
                        'help' => 'Tag for card 3.'
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
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Leadership / Principal\'s Message',
                'icon'  => 'format_quote',
                'desc'  => 'School leadership portrait, featured inspirational quote, and executive address.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'leader_photo',
                        'label' => 'Principal / Leader Portrait Photo',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'School Leadership and Principal',
                        'help' => 'Portrait photo displayed alongside the quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_tagline',
                        'label' => 'Leadership Tagline',
                        'type' => 'text',
                        'default' => 'LEADERSHIP MESSAGE',
                        'help' => 'Eyebrow label above quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_heading',
                        'label' => 'Leadership Section Heading',
                        'type' => 'text',
                        'default' => 'Guiding Young Minds Towards Bright Futures',
                        'help' => 'Heading for leadership message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_quote',
                        'label' => 'Featured Leadership Quote',
                        'type' => 'text',
                        'default' => '“Education at Sun Rise is not only about securing top marks, but about cultivating strong character, moral courage, and curiosity to achieve lasting success in life.”',
                        'help' => 'Prominent blockquote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_paragraph',
                        'label' => 'Principal / Management Address Paragraph',
                        'type' => 'text',
                        'default' => 'At Sun Rise Sr. Sec. School, Dobhi, we provide an inspiring sanctuary of learning where every child is valued and encouraged to realize their maximum potential. Our devoted faculty strives tirelessly to ensure each student shines bright like the rising sun.',
                        'help' => 'Main address message.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_name',
                        'label' => 'Leader Signature Name',
                        'type' => 'text',
                        'default' => 'School Leadership & Principal',
                        'help' => 'Signatory name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_title',
                        'label' => 'Leader Designation',
                        'type' => 'text',
                        'default' => 'Sun Rise Sr. Sec. School, Dobhi',
                        'help' => 'Official designation.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Notices & School Happenings',
                'icon'  => 'event_note',
                'desc'  => 'Events & news cards displayed on homepage.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'events_eyebrow',
                        'label' => 'Happenings Eyebrow',
                        'type' => 'text',
                        'default' => 'NOTICES & HAPPENINGS',
                        'help' => 'Eyebrow label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'events_heading',
                        'label' => 'Happenings Heading',
                        'type' => 'text',
                        'default' => 'School Events & News',
                        'help' => 'Main section heading.'
                    ],
                    // Event 1
                    [
                        'kind' => 'text',
                        'key' => 'event1_title',
                        'label' => 'Notice 1 Title',
                        'type' => 'text',
                        'default' => 'Annual Science & Innovation Exhibition',
                        'help' => 'Title for notice 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event1_desc',
                        'label' => 'Notice 1 Description',
                        'type' => 'text',
                        'default' => 'Students display innovative working models, robotics experiments, and environmental science projects.',
                        'help' => 'Description for notice 1.'
                    ],
                    // Event 2
                    [
                        'kind' => 'text',
                        'key' => 'event2_title',
                        'label' => 'Notice 2 Title',
                        'type' => 'text',
                        'default' => 'Prize Distribution & Felicitation Day',
                        'help' => 'Title for notice 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event2_desc',
                        'label' => 'Notice 2 Description',
                        'type' => 'text',
                        'default' => 'Honouring board exam toppers, scholarship achievers, and sports champions with merit awards.',
                        'help' => 'Description for notice 2.'
                    ],
                    // Event 3
                    [
                        'kind' => 'text',
                        'key' => 'event3_title',
                        'label' => 'Notice 3 Title',
                        'type' => 'text',
                        'default' => 'National Festivals & Cultural Assemblies',
                        'help' => 'Title for notice 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'event3_desc',
                        'label' => 'Notice 3 Description',
                        'type' => 'text',
                        'default' => 'Flag hoisting ceremony, patriotic songs, cultural dances, and speeches commemorating national heritage.',
                        'help' => 'Description for notice 3.'
                    ]
                ]
            ],
            [
                'title' => 'Section 6: Campus Glimpses Showcase',
                'icon'  => 'photo_library',
                'desc'  => '6 photo slots highlighting campus facilities, classrooms, faculty, and student life.',
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
                        'help' => 'Heading.'
                    ],
                    // Glimpse 1
                    [
                        'kind' => 'image',
                        'key' => 'glimpse1_img',
                        'label' => 'Glimpse 1 Photo (Campus Night View)',
                        'default' => 'assets/images/sunrise school image/school_nightview.webp',
                        'alt' => 'Main Campus Building Night View',
                        'help' => 'Photo slot 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse1_title',
                        'label' => 'Glimpse 1 Title',
                        'type' => 'text',
                        'default' => 'Main Campus Building',
                        'help' => 'Caption title.'
                    ],
                    // Glimpse 2
                    [
                        'kind' => 'image',
                        'key' => 'glimpse2_img',
                        'label' => 'Glimpse 2 Photo (Interactive Classrooms)',
                        'default' => 'assets/images/sunrise school image/children_sitting.webp',
                        'alt' => 'Smart Classrooms',
                        'help' => 'Photo slot 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse2_title',
                        'label' => 'Glimpse 2 Title',
                        'type' => 'text',
                        'default' => 'Interactive Classrooms',
                        'help' => 'Caption title.'
                    ],
                    // Glimpse 3
                    [
                        'kind' => 'image',
                        'key' => 'glimpse3_img',
                        'label' => 'Glimpse 3 Photo (Dedicated Teaching Faculty)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Teaching Faculty',
                        'help' => 'Photo slot 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse3_title',
                        'label' => 'Glimpse 3 Title',
                        'type' => 'text',
                        'default' => 'Dedicated Teaching Faculty',
                        'help' => 'Caption title.'
                    ],
                    // Glimpse 4
                    [
                        'kind' => 'image',
                        'key' => 'glimpse4_img',
                        'label' => 'Glimpse 4 Photo (Student Community)',
                        'default' => 'assets/images/sunrise school image/students_grouppic.webp',
                        'alt' => 'Student Community',
                        'help' => 'Photo slot 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse4_title',
                        'label' => 'Glimpse 4 Title',
                        'type' => 'text',
                        'default' => 'Student Community',
                        'help' => 'Caption title.'
                    ],
                    // Glimpse 5
                    [
                        'kind' => 'image',
                        'key' => 'glimpse5_img',
                        'label' => 'Glimpse 5 Photo (Yoga & Holistic Health)',
                        'default' => 'assets/images/sunrise school image/yoga.webp',
                        'alt' => 'Yoga and Physical Health',
                        'help' => 'Photo slot 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse5_title',
                        'label' => 'Glimpse 5 Title',
                        'type' => 'text',
                        'default' => 'Yoga & Holistic Health',
                        'help' => 'Caption title.'
                    ],
                    // Glimpse 6
                    [
                        'kind' => 'image',
                        'key' => 'glimpse6_img',
                        'label' => 'Glimpse 6 Photo (Science Projects)',
                        'default' => 'assets/images/sunrise school image/project.webp',
                        'alt' => 'Science Projects Showcase',
                        'help' => 'Photo slot 6.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'glimpse6_title',
                        'label' => 'Glimpse 6 Title',
                        'type' => 'text',
                        'default' => 'Science Projects',
                        'help' => 'Caption title.'
                    ]
                ]
            ],
            [
                'title' => 'Section 7: Final Admissions Call to Action (CTA)',
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
                        'key' => 'cta_btn2_text',
                        'label' => 'Button 2 Text (Contact Link)',
                        'type' => 'text',
                        'default' => 'Contact Campus Office',
                        'help' => 'Label for the secondary button.'
                    ]
                ]
            ]
        ]
    ],
    'about' => [
        'title' => 'About Us Page',
        'icon'  => 'info',
        'desc'  => 'Institutional Legacy, Vision, Mission, History Milestones & Campus Visual Tour',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Intro',
                'icon'  => 'flag',
                'desc'  => 'Top banner image, eyebrow badge, page title, and mission summary.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'About Us Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/school_home2.webp',
                        'alt' => 'Sun Rise School Building and Assembly Area',
                        'help' => 'Header banner image for about-us.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Institutional Legacy & Future Vision',
                        'help' => 'Eyebrow pill above About Us title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'About Us Hero Title',
                        'type' => 'text',
                        'default' => 'About Sun Rise Sr. Sec. School',
                        'help' => 'Primary title for about-us.php.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'About Us Subtitle',
                        'type' => 'text',
                        'default' => 'Cultivating academic rigor, moral integrity, and lifelong curiosity within a vibrant and disciplined campus environment in Dobhi, Haryana.',
                        'help' => 'Hero paragraph on About Us page.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Milestone Statistics Strip',
                'icon'  => 'pin_drop',
                'desc'  => '4 key achievement numbers shown in the floating strip.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'stat1_num',
                        'label' => 'Stat 1 Number',
                        'type' => 'text',
                        'default' => '20+',
                        'help' => 'Stat 1 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat1_lbl',
                        'label' => 'Stat 1 Label',
                        'type' => 'text',
                        'default' => 'Years of Excellence',
                        'help' => 'Stat 1 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_num',
                        'label' => 'Stat 2 Number',
                        'type' => 'text',
                        'default' => '100%',
                        'help' => 'Stat 2 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat2_lbl',
                        'label' => 'Stat 2 Label',
                        'type' => 'text',
                        'default' => 'Board Results',
                        'help' => 'Stat 2 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_num',
                        'label' => 'Stat 3 Number',
                        'type' => 'text',
                        'default' => '1,500+',
                        'help' => 'Stat 3 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat3_lbl',
                        'label' => 'Stat 3 Label',
                        'type' => 'text',
                        'default' => 'Alumni & Students',
                        'help' => 'Stat 3 label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_num',
                        'label' => 'Stat 4 Number',
                        'type' => 'text',
                        'default' => '1:15',
                        'help' => 'Stat 4 number.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'stat4_lbl',
                        'label' => 'Stat 4 Label',
                        'type' => 'text',
                        'default' => 'Teacher-Student Ratio',
                        'help' => 'Stat 4 label.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Core Philosophy, Vision & Mission',
                'icon'  => 'visibility',
                'desc'  => 'Educational philosophy, school vision, and institutional mission cards.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'philosophy_tag',
                        'label' => 'Philosophy Tagline',
                        'type' => 'text',
                        'default' => 'Our Core Philosophy',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'philosophy_heading',
                        'label' => 'Philosophy Section Heading',
                        'type' => 'text',
                        'default' => 'Guiding Principles of Education',
                        'help' => 'Section headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_title',
                        'label' => 'Vision Card Title',
                        'type' => 'text',
                        'default' => 'To Enlighten Every Mind Like the Rising Sun',
                        'help' => 'Title for vision.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'vision_text',
                        'label' => 'Vision Description',
                        'type' => 'html',
                        'default' => 'Sun Rise Sr. Sec. School envisions building a forward-looking student community rooted in timeless values, academic distinction, ethical integrity, and technological readiness to lead with compassion and confidence.',
                        'help' => 'Vision statement (HTML allowed).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'mission_title',
                        'label' => 'Mission Card Title',
                        'type' => 'text',
                        'default' => 'Holistic Education for Mind, Body & Soul',
                        'help' => 'Title for mission.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'mission_text',
                        'label' => 'Mission Description',
                        'type' => 'html',
                        'default' => 'We are dedicated to delivering a comprehensive HBSC curriculum enriched by hands-on science laboratories, digital learning, sportsmanship, moral values, and cultural activities that nurture well-rounded global citizens.',
                        'help' => 'Mission statement (HTML allowed).'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: History Milestones Timeline',
                'icon'  => 'timeline',
                'desc'  => '4 chronological journey milestones from foundation to present day.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'history_eyebrow',
                        'label' => 'Timeline Eyebrow',
                        'type' => 'text',
                        'default' => 'Our Growth Journey',
                        'help' => 'Eyebrow label.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'history_heading',
                        'label' => 'Timeline Section Heading',
                        'type' => 'text',
                        'default' => 'Milestones in Our History',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_title',
                        'label' => 'Milestone 1 Title (Foundation)',
                        'type' => 'text',
                        'default' => 'Establishment of Sun Rise School',
                        'help' => 'Milestone 1 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm1_desc',
                        'label' => 'Milestone 1 Description',
                        'type' => 'text',
                        'default' => 'Founded with the noble aspiration to bring quality, modern, value-based English and Hindi medium education to the youth of Dobhi and surrounding regions.',
                        'help' => 'Milestone 1 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_title',
                        'label' => 'Milestone 2 Title (Upgradation)',
                        'type' => 'text',
                        'default' => 'HBSC Affiliation & Senior Secondary Streams',
                        'help' => 'Milestone 2 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm2_desc',
                        'label' => 'Milestone 2 Description',
                        'type' => 'text',
                        'default' => 'Upgraded to Senior Secondary (10+2) under HBSC with specialized streams in Science (Medical/Non-Medical), Commerce, and Arts alongside modern physics, chemistry, and biology labs.',
                        'help' => 'Milestone 2 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_title',
                        'label' => 'Milestone 3 Title (Infrastructure)',
                        'type' => 'text',
                        'default' => 'Modern Science Labs, Computer Lab & Sports Ground',
                        'help' => 'Milestone 3 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm3_desc',
                        'label' => 'Milestone 3 Description',
                        'type' => 'text',
                        'default' => 'Inauguration of modern digital smart classrooms, a high-tech computer laboratory, a wide athletic sports ground, and annual science exhibitions.',
                        'help' => 'Milestone 3 text.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_title',
                        'label' => 'Milestone 4 Title (Today)',
                        'type' => 'text',
                        'default' => 'Empowering Future Generations',
                        'help' => 'Milestone 4 title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'm4_desc',
                        'label' => 'Milestone 4 Description',
                        'type' => 'text',
                        'default' => 'Consistently achieving 100% board results, district academic merit awards, and sports championships, paving pathways to premier universities and professional colleges.',
                        'help' => 'Milestone 4 text.'
                    ]
                ]
            ],
            [
                'title' => 'Section 5: Leadership Address & Quote',
                'icon'  => 'record_voice_over',
                'desc'  => 'Principal and Management Committee message card.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'leader_photo',
                        'label' => 'Leader Photo',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'Principal & Management Committee',
                        'help' => 'Leader portrait.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_tagline',
                        'label' => 'Leadership Tagline',
                        'type' => 'text',
                        'default' => 'Leadership Message',
                        'help' => 'Eyebrow tag.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_quote',
                        'label' => 'Leadership Quote',
                        'type' => 'text',
                        'default' => '“Our mission is to illuminate young minds with knowledge, strengthen their character with discipline, and empower them to become successful citizens of tomorrow.”',
                        'help' => 'Featured quote.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader_title',
                        'label' => 'Signatory Title',
                        'type' => 'text',
                        'default' => 'Principal & Management Committee',
                        'help' => 'Title.'
                    ]
                ]
            ],
            [
                'title' => 'Section 6: Campus Visual Tour Collage',
                'icon'  => 'grid_view',
                'desc'  => '5 collage photo cards showing campus, prayers, exhibition, and mentorship.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'tour_tagline',
                        'label' => 'Tour Tagline',
                        'type' => 'text',
                        'default' => 'Visual Tour',
                        'help' => 'Eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_title',
                        'label' => 'Tour Heading',
                        'type' => 'text',
                        'default' => 'Moments & Campus Life',
                        'help' => 'Heading.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'tour_img1',
                        'label' => 'Tour Photo 1 (Main Building)',
                        'default' => 'assets/images/sunrise school image/school.webp',
                        'alt' => 'Main Campus Building',
                        'help' => 'Photo 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl1',
                        'label' => 'Tour Photo 1 Label',
                        'type' => 'text',
                        'default' => 'Main Campus Building',
                        'help' => 'Label for photo 1.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'tour_img2',
                        'label' => 'Tour Photo 2 (Morning Prayer)',
                        'default' => 'assets/images/sunrise school image/children_praying.webp',
                        'alt' => 'Morning Prayer & Assembly',
                        'help' => 'Photo 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl2',
                        'label' => 'Tour Photo 2 Label',
                        'type' => 'text',
                        'default' => 'Morning Prayer & Assembly',
                        'help' => 'Label for photo 2.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'tour_img3',
                        'label' => 'Tour Photo 3 (Panorama View)',
                        'default' => 'assets/images/sunrise school image/school3.webp',
                        'alt' => 'Campus Panorama View',
                        'help' => 'Photo 3 (Tall center photo).'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl3',
                        'label' => 'Tour Photo 3 Label',
                        'type' => 'text',
                        'default' => 'Campus Panorama View',
                        'help' => 'Label for photo 3.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'tour_img4',
                        'label' => 'Tour Photo 4 (Science Exhibition)',
                        'default' => 'assets/images/sunrise school image/exhibition3.webp',
                        'alt' => 'Student Science Exhibitions',
                        'help' => 'Photo 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl4',
                        'label' => 'Tour Photo 4 Label',
                        'type' => 'text',
                        'default' => 'Student Science Exhibitions',
                        'help' => 'Label for photo 4.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'tour_img5',
                        'label' => 'Tour Photo 5 (Mentorship)',
                        'default' => 'assets/images/sunrise school image/students_teachers.webp',
                        'alt' => 'Interactive Faculty Mentorship',
                        'help' => 'Photo 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'tour_lbl5',
                        'label' => 'Tour Photo 5 Label',
                        'type' => 'text',
                        'default' => 'Interactive Faculty Mentorship',
                        'help' => 'Label for photo 5.'
                    ]
                ]
            ]
        ]
    ],
    'academics' => [
        'title' => 'Academics Page',
        'icon'  => 'school',
        'desc'  => 'HBSC Curriculum, Stages (Pre-Primary to 12th), 3 Streams, and Teaching Methodology',
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
                        'default' => 'Rigorous HBSC Curriculum Designed for Success',
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
                        'default' => 'HBSC Pass Record',
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
                        'key' => 'badge_hbsc',
                        'label' => 'Badge 1 (HBSC Affiliation)',
                        'type' => 'text',
                        'default' => 'HBSC Affiliation #530XXX (Dobhi, Hisar)',
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
                        'default' => 'Our administrative office is open Monday to Saturday from 8:00 AM to 2:30 PM to assist parents with document verification, fee concessions, and transport routes.',
                        'help' => 'Description.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'help_phone',
                        'label' => 'Helpdesk Phone Number',
                        'type' => 'text',
                        'default' => '+91 98123 45678',
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
                        'default' => 'Fully equipped practical laboratories for Physics, Chemistry, and Biology adhering strictly to HBSC safety benchmarks and experimental standards.',
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
                        'default' => 'Prominent regional newspapers report on the extraordinary 100% HBSC board passing rate and high scoring records of our students.',
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
        'desc'  => 'Hero Banner, 3 Leadership Mentors, Staff Collage Photos, Departments & Careers',
        'sections' => [
            [
                'title' => 'Section 1: Hero Banner & Header',
                'icon'  => 'flag',
                'desc'  => 'Top banner image, eyebrow badge, title, and intro paragraph.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'hero_banner',
                        'label' => 'Faculty Hero Banner Image',
                        'default' => 'assets/images/sunrise school image/teachers_and_students.webp',
                        'alt' => 'Teachers and Mentors',
                        'help' => 'Top background image.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_badge',
                        'label' => 'Hero Eyebrow Badge',
                        'type' => 'text',
                        'default' => 'Dedicated Educators',
                        'help' => 'Badge.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_title',
                        'label' => 'Faculty Page Title',
                        'type' => 'text',
                        'default' => 'Our Distinguished Faculty & Staff',
                        'help' => 'Main headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'hero_subtitle',
                        'label' => 'Faculty Page Subtitle',
                        'type' => 'text',
                        'default' => 'Meet the passionate educators, experienced subject mentors, and visionary leadership shaping young minds at Sun Rise Sr. Sec. School, Dobhi.',
                        'help' => 'Subtitle.'
                    ]
                ]
            ],
            [
                'title' => 'Section 2: Academic Leadership (3 Profiles)',
                'icon'  => 'badge',
                'desc'  => 'Managing Committee / Director, Office of Principal, Senior Coordinators.',
                'fields' => [
                    // Leader 1
                    [
                        'kind' => 'image',
                        'key' => 'leader1_photo',
                        'label' => 'Leader 1 Photo (Managing Director)',
                        'default' => 'assets/images/sunrise school image/speaker.webp',
                        'alt' => 'Managing Committee',
                        'help' => 'Director photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_name',
                        'label' => 'Leader 1 Name',
                        'type' => 'text',
                        'default' => 'Managing Committee',
                        'help' => 'Name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_sub',
                        'label' => 'Leader 1 Title',
                        'type' => 'text',
                        'default' => 'Sun Rise Educational Trust, Dobhi',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader1_quote',
                        'label' => 'Leader 1 Quote',
                        'type' => 'text',
                        'default' => '“True education is the bedrock of character, empowering students to rise above ordinary standards and achieve extraordinary goals.”',
                        'help' => 'Quote.'
                    ],
                    // Leader 2
                    [
                        'kind' => 'image',
                        'key' => 'leader2_photo',
                        'label' => 'Leader 2 Photo (Principal Office)',
                        'default' => 'assets/images/sunrise school image/teachers_sitting.webp',
                        'alt' => 'Principal Office',
                        'help' => 'Principal photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_name',
                        'label' => 'Leader 2 Name',
                        'type' => 'text',
                        'default' => 'Office of the Principal',
                        'help' => 'Name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_sub',
                        'label' => 'Leader 2 Title',
                        'type' => 'text',
                        'default' => 'M.A., M.Ed. – Senior Academician',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader2_quote',
                        'label' => 'Leader 2 Quote',
                        'type' => 'text',
                        'default' => '“We cultivate an environment where discipline meets curiosity, ensuring every child discovers their inner spark and thrives academically.”',
                        'help' => 'Quote.'
                    ],
                    // Leader 3
                    [
                        'kind' => 'image',
                        'key' => 'leader3_photo',
                        'label' => 'Leader 3 Photo (Academic Council)',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Academic Council',
                        'help' => 'Coordinators photo.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_name',
                        'label' => 'Leader 3 Name',
                        'type' => 'text',
                        'default' => 'Senior Coordinators',
                        'help' => 'Name.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_sub',
                        'label' => 'Leader 3 Title',
                        'type' => 'text',
                        'default' => 'Post Graduate Teachers (PGT / TGT)',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'leader3_quote',
                        'label' => 'Leader 3 Quote',
                        'type' => 'text',
                        'default' => '“Teamwork, continuous faculty workshops, and individualized student attention form the backbone of our outstanding board results.”',
                        'help' => 'Quote.'
                    ]
                ]
            ],
            [
                'title' => 'Section 3: Mentors in Action Gallery (6 Staff Photos)',
                'icon'  => 'collections',
                'desc'  => '6 photographs highlighting staff group, mentorship, meetings, and team bonding.',
                'fields' => [
                    [
                        'kind' => 'image',
                        'key' => 'staff_img1',
                        'label' => 'Staff Photo 1',
                        'default' => 'assets/images/sunrise school image/all_staffmembers.webp',
                        'alt' => 'Full Staff Group',
                        'help' => 'Staff photo 1.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title1',
                        'label' => 'Staff Photo 1 Title',
                        'type' => 'text',
                        'default' => 'Sun Rise Teaching & Admin Staff',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_img2',
                        'label' => 'Staff Photo 2',
                        'default' => 'assets/images/sunrise school image/teachers_and_students.webp',
                        'alt' => 'Faculty & High Achievers',
                        'help' => 'Staff photo 2.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title2',
                        'label' => 'Staff Photo 2 Title',
                        'type' => 'text',
                        'default' => 'Faculty & High Achievers',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_img3',
                        'label' => 'Staff Photo 3',
                        'default' => 'assets/images/sunrise school image/teachers_sitting.webp',
                        'alt' => 'Faculty Planning Session',
                        'help' => 'Staff photo 3.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title3',
                        'label' => 'Staff Photo 3 Title',
                        'type' => 'text',
                        'default' => 'Faculty Planning & Review',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_img4',
                        'label' => 'Staff Photo 4',
                        'default' => 'assets/images/sunrise school image/school_staff.webp',
                        'alt' => 'Department Educators',
                        'help' => 'Staff photo 4.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title4',
                        'label' => 'Staff Photo 4 Title',
                        'type' => 'text',
                        'default' => 'Department Educators',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_img5',
                        'label' => 'Staff Photo 5',
                        'default' => 'assets/images/sunrise school image/teachers.webp',
                        'alt' => 'Senior School Mentors',
                        'help' => 'Staff photo 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title5',
                        'label' => 'Staff Photo 5 Title',
                        'type' => 'text',
                        'default' => 'Senior School Mentors',
                        'help' => 'Title.'
                    ],
                    [
                        'kind' => 'image',
                        'key' => 'staff_img6',
                        'label' => 'Staff Photo 6',
                        'default' => 'assets/images/sunrise school image/students_teachers.webp',
                        'alt' => 'Student & Mentor Bonding',
                        'help' => 'Staff photo 6.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'staff_title6',
                        'label' => 'Staff Photo 6 Title',
                        'type' => 'text',
                        'default' => 'Student & Mentor Bonding',
                        'help' => 'Title.'
                    ]
                ]
            ],
            [
                'title' => 'Section 4: Join Our Teaching Team CTA',
                'icon'  => 'work',
                'desc'  => 'Recruitment message and call to action button.',
                'fields' => [
                    [
                        'kind' => 'text',
                        'key' => 'cta_eyebrow',
                        'label' => 'Career Eyebrow',
                        'type' => 'text',
                        'default' => 'Career Opportunities',
                        'help' => 'Eyebrow.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_heading',
                        'label' => 'Career Heading',
                        'type' => 'text',
                        'default' => 'Want to Join Our Teaching Team?',
                        'help' => 'Headline.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'cta_desc',
                        'label' => 'Career Subtitle',
                        'type' => 'text',
                        'default' => 'We are always looking for passionate, certified educators who love teaching and inspiring students. Send us your resume.',
                        'help' => 'Subtitle.'
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
                        'alt' => 'HBSC Board Exam Toppers',
                        'help' => 'Photo 5.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'gallery_title5',
                        'label' => 'Photo 5 Title',
                        'type' => 'text',
                        'default' => 'HBSC Board Exam Toppers',
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
                        'default' => 'Class 9 to 12 – HBSC Board, Science (Medical/Non-Med), Commerce & Arts',
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
                        'default' => 'Nurturing Knowledge, Character & Academic Excellence | Affiliated to HBSC',
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
                        'default' => '+91 98123 45678',
                        'help' => 'Click-to-call phone number in header and footer.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_email',
                        'label' => 'Official Inquiries Email',
                        'type' => 'text',
                        'default' => 'info@sunrisesrsec.edu',
                        'help' => 'Main school inbox.'
                    ],
                    [
                        'kind' => 'text',
                        'key' => 'site_info_email',
                        'label' => 'Admissions Desk Email',
                        'type' => 'text',
                        'default' => 'admissions@sunrisesrsec.edu',
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
                        'default' => 'Sun Rise Sr. Sec. School, VPO Dobhi, Hisar, Haryana - 125001',
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
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
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif']
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
                    <div class="flex items-center gap-2">
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
                                        <!-- Image Uploader Field -->
                                        <form method="POST" action="upload_image.php" enctype="multipart/form-data" class="space-y-4">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="page_key" value="<?= htmlspecialchars($active_tab) ?>">
                                            <input type="hidden" name="image_key" value="<?= htmlspecialchars($field['key']) ?>">

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
                                                    <div>
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Select Replacement Image (JPG, PNG, WEBP &bull; Max 2MB)
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            name="image_file" 
                                                            accept="image/jpeg,image/png,image/webp"
                                                            onchange="previewImage(this, '<?= $img_preview_id ?>')"
                                                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#001129] file:text-white hover:file:bg-[#071f45] file:cursor-pointer cursor-pointer border border-gray-300 rounded-xl bg-gray-50/50"
                                                        />
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
                                                            class="px-4 py-2 bg-[#C9A24B] hover:bg-[#B38C37] text-[#001129] font-bold text-xs rounded-lg shadow-sm hover:shadow transition flex items-center gap-1.5"
                                                        >
                                                            <span class="material-symbols-outlined text-base">cloud_upload</span>
                                                            <span>Upload &amp; Replace Image</span>
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
                                        <form id="<?= $form_id ?>" method="POST" action="save_content.php" class="space-y-3">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="page_key" value="<?= htmlspecialchars($active_tab) ?>">
                                            <input type="hidden" name="section_key" value="<?= htmlspecialchars($field['key']) ?>">
                                            <input type="hidden" name="content_type" value="<?= htmlspecialchars($field['type'] ?? 'text') ?>">

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
                                                    class="px-4 py-2 bg-[#001129] hover:bg-[#071f45] text-white text-xs font-bold rounded-lg shadow-sm hover:shadow transition flex items-center gap-1.5"
                                                >
                                                    <span class="material-symbols-outlined text-base text-[#C9A24B]">save</span>
                                                    <span>Save Field</span>
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

    <!-- Interactive Scripts: Live Image Preview & Quill Initializer -->
    <script>
        // Live image preview reader
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (file.size > 2 * 1024 * 1024) {
                    alert("Selected file is larger than 2MB. Please choose a smaller image.");
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

        // Initialize all active Quill Rich Text Editors
        document.addEventListener('DOMContentLoaded', () => {
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

                    const form = document.getElementById('<?= $qe['form_id'] ?>');
                    const textarea = document.getElementById('<?= $qe['txt_id'] ?>');

                    if (form && textarea) {
                        form.addEventListener('submit', () => {
                            textarea.value = quill.root.innerHTML;
                        });
                    }
                })();
            <?php endforeach; ?>
        });
    </script>
</body>
</html>
