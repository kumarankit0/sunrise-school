<?php
/**
 * Sun Rise Sr. Sec. School, Dobhi - Configuration & Constants
 */

// Load CMS Dynamic Content Helper
require_once __DIR__ . '/../includes/content_helper.php';

// Site Information (Dynamic with fallback defaults)
$site_name           = get_text('general', 'site_name', 'Sun Rise Sr. Sec. School, Dobhi');
$site_tagline        = get_text('general', 'site_tagline', 'Nurturing Knowledge, Character & Academic Excellence | Affiliated to HBSE');
$site_phone          = get_text('general', 'site_phone', '+91 70158 90094');
$site_phone_alt      = get_text('general', 'site_phone_alt', '+91 79883 5710');
$site_email          = get_text('general', 'site_email', 'info@sunrisesrsecschool.com');
$site_info_email     = get_text('general', 'site_info_email', 'info@sunrisesrsecschool.com');
$site_address        = get_text('general', 'site_address', 'Main Road Dobhi, Near Primary Health Center, Dobhi, Hisar (Haryana) - 125001');
$site_timings_summer = get_text('general', 'timings_summer', '7:30 AM to 1:30 PM');
$site_timings_winter = get_text('general', 'timings_winter', '8:30 AM to 2:30 PM');
$site_estd           = get_text('general', 'site_estd', '2007');
$site_affiliation    = get_text('general', 'site_affiliation', 'HBSE');
$site_logo           = get_image('general', 'site_logo', 'assets/images/logo.svg');

// Base path for original school images
define('SCHOOL_IMG_DIR', 'assets/images/sunrise school image/');
define('SCHOOL_IMG_URI', 'assets/images/sunrise%20school%20image/');

/**
 * Helper function to return encoded image URI for CSS background-image and src attributes
 */
function school_img($filename) {
    return 'assets/images/sunrise%20school%20image/' . rawurlencode($filename);
}

// Navigation Menu Items matching Reference Header (ABOUT US, ADMISSIONS, ACADEMICS, ACTIVITIES, BOARDING AND CAMPUS, CAREER, CONNECT)
$nav_menu = [
    'about-us' => [
        'title' => get_text('general', 'nav_item1_text', 'ABOUT US'),
        'url' => get_text('general', 'nav_item1_url', 'about-us.php'),
        'subitems' => [
            'about-us' => [
                'title' => 'About Sun Rise',
                'url' => 'about-us.php',
                'icon' => 'school',
                'desc' => 'Our Vision, Mission & Ethos'
            ],
            'leadership' => [
                'title' => 'Leadership & Management',
                'url' => 'about-us.php#leadership',
                'icon' => 'workspace_premium',
                'desc' => 'Message from Chairman & Principal'
            ],
            'disclosure' => [
                'title' => 'Mandatory Disclosure',
                'url' => 'about-us.php#mandatory-disclosure',
                'icon' => 'verified_user',
                'desc' => 'Affiliation, Society & Compliance'
            ],
            'faculty-staff' => [
                'title' => 'Faculty & Mentors',
                'url' => 'faculty.php',
                'icon' => 'groups',
                'desc' => 'Our Experienced Teaching Staff'
            ]
        ]
    ],
    'admissions' => [
        'title' => get_text('general', 'nav_item2_text', 'ADMISSIONS'),
        'url' => get_text('general', 'nav_item2_url', 'admission.php'),
        'subitems' => [
            'admission-proc' => [
                'title' => 'Admission Procedure',
                'url' => 'admission.php',
                'icon' => 'assignment_turned_in',
                'desc' => 'Guidelines & Criteria (Nursery to 12th)'
            ],
            'online-apply' => [
                'title' => 'Online Registration 2026-27',
                'url' => 'admission.php#register-form',
                'icon' => 'how_to_reg',
                'desc' => 'Apply Online for Direct Admission'
            ],
            'fee-struct' => [
                'title' => 'Fee Structure',
                'url' => 'admission.php#fee-structure',
                'icon' => 'payments',
                'desc' => 'Transparent & Affordable Fees'
            ],
            'admission-faq' => [
                'title' => 'Admission FAQs',
                'url' => 'admission.php#faqs',
                'icon' => 'quiz',
                'desc' => 'Frequently Asked Questions'
            ]
        ]
    ],
    'academics' => [
        'title' => get_text('general', 'nav_item3_text', 'ACADEMICS'),
        'url' => get_text('general', 'nav_item3_url', 'academics.php'),
        'subitems' => [
            'curriculum' => [
                'title' => 'Curriculum & Methodology',
                'url' => 'academics.php',
                'icon' => 'menu_book',
                'desc' => 'HBSE Board Standardized Learning'
            ],
            'streams' => [
                'title' => 'Senior Secondary Streams',
                'url' => 'academics.php#streams',
                'icon' => 'science',
                'desc' => 'Medical, Non-Med, Commerce & Arts'
            ],
            'calendar' => [
                'title' => 'Examinations & Calendar',
                'url' => 'academics.php#academic-calendar',
                'icon' => 'calendar_month',
                'desc' => 'Evaluation Schedule & Tests'
            ],
            'toppers' => [
                'title' => 'Academic Achievers & Toppers',
                'url' => 'academics.php#toppers',
                'icon' => 'military_tech',
                'desc' => 'Our Pride & Board Merit Holders'
            ]
        ]
    ],
    'activities' => [
        'title' => get_text('general', 'nav_item4_text', 'ACTIVITIES'),
        'url' => get_text('general', 'nav_item4_url', 'events.php'),
        'subitems' => [
            'events-news' => [
                'title' => 'Events & Annual Functions',
                'url' => 'events.php',
                'icon' => 'celebration',
                'desc' => 'Festivals, Assemblies & Competitions'
            ],
            'sports-meet' => [
                'title' => 'Sports & Physical Education',
                'url' => 'campus.php#sports',
                'icon' => 'sports_cricket',
                'desc' => 'Athletics, Volleyball & Yoga'
            ],
            'gallery' => [
                'title' => 'Photo & Video Gallery',
                'url' => 'gallery.php',
                'icon' => 'photo_library',
                'desc' => 'Memories & Celebrations on Campus'
            ]
        ]
    ],
    'campus' => [
        'title' => get_text('general', 'nav_item5_text', 'BOARDING AND CAMPUS'),
        'url' => get_text('general', 'nav_item5_url', 'campus.php'),
        'subitems' => [
            'campus-life' => [
                'title' => 'Campus Infrastructure',
                'url' => 'campus.php',
                'icon' => 'apartment',
                'desc' => 'Sprawling Green Campus in Dobhi'
            ],
            'smart-labs' => [
                'title' => 'Science & Computer Labs',
                'url' => 'campus.php#labs',
                'icon' => 'biotech',
                'desc' => 'Modern Hands-on Practical Labs'
            ],
            'library' => [
                'title' => 'Library & Learning Center',
                'url' => 'campus.php#library',
                'icon' => 'local_library',
                'desc' => 'Rich Repository of Books & Periodicals'
            ],
            'transport' => [
                'title' => 'Safe Transport & Boarding',
                'url' => 'campus.php#transport',
                'icon' => 'directions_bus',
                'desc' => 'Safe GPS-Enabled Bus Network'
            ]
        ]
    ],
    'career' => [
        'title' => get_text('general', 'nav_item6_text', 'CAREER'),
        'url' => get_text('general', 'nav_item6_url', 'contact-us.php#career'),
        'subitems' => [
            'openings' => [
                'title' => 'Join Our Faculty Team',
                'url' => 'contact-us.php#career',
                'icon' => 'work',
                'desc' => 'Teaching & Non-Teaching Openings'
            ],
            'apply' => [
                'title' => 'Apply Online',
                'url' => 'contact-us.php',
                'icon' => 'upload_file',
                'desc' => 'Submit Resume for Review'
            ]
        ]
    ],
    'connect' => [
        'title' => get_text('general', 'nav_item7_text', 'CONNECT'),
        'url' => get_text('general', 'nav_item7_url', 'contact-us.php'),
        'subitems' => [
            'contact' => [
                'title' => 'Contact Campus Office',
                'url' => 'contact-us.php',
                'icon' => 'support_agent',
                'desc' => 'Phone, Email & Helpdesk'
            ],
            'map' => [
                'title' => 'Campus Location & Map',
                'url' => 'contact-us.php#map',
                'icon' => 'location_on',
                'desc' => 'VPO Dobhi, Hisar (Haryana)'
            ],
            'alumni' => [
                'title' => 'Alumni Network',
                'url' => 'events.php#alumni',
                'icon' => 'diversity_3',
                'desc' => 'Connect with Past Students'
            ]
        ]
    ]
];

/**
 * Check if the navigation item or its children are active
 */
function is_nav_active($key, $current) {
    global $nav_menu;
    if ($key === $current) {
        return true;
    }
    
    // Page to menu category mapping
    $mapping = [
        'about-us' => ['about-us', 'faculty-staff', 'leadership', 'disclosure'],
        'admissions' => ['admissions', 'admission-proc', 'online-apply', 'fee-struct', 'admission-faq'],
        'academics' => ['academics', 'curriculum', 'streams', 'calendar', 'toppers'],
        'activities' => ['events-news', 'gallery', 'sports-meet'],
        'campus' => ['campus-life', 'smart-labs', 'library', 'transport'],
        'career' => ['career', 'openings', 'apply'],
        'connect' => ['contact', 'map', 'alumni']
    ];

    if (isset($mapping[$key]) && in_array($current, $mapping[$key])) {
        return true;
    }

    if (isset($nav_menu[$key]['subitems']) && array_key_exists($current, $nav_menu[$key]['subitems'])) {
        return true;
    }
    return false;
}
?>
