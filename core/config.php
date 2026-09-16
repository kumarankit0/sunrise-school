<?php
/**
 * Sun Rise Sr. Sec. School, Dobhi - Configuration & Constants
 */

// Load CMS Dynamic Content Helper
require_once __DIR__ . '/../includes/content_helper.php';

// Site Information (Dynamic with fallback defaults)
$site_name       = get_text('general', 'site_name', 'Sun Rise Sr. Sec. School, Dobhi');
$site_tagline    = get_text('general', 'site_tagline', 'Nurturing Knowledge, Character & Academic Excellence | Affiliated to HBSE');
$site_phone      = get_text('general', 'site_phone', '+91 98123 45678');
$site_email      = get_text('general', 'site_email', 'info@sunrisesrsec.edu');
$site_info_email = get_text('general', 'site_info_email', 'admissions@sunrisesrsec.edu');
$site_address    = get_text('general', 'site_address', 'Sun Rise Sr. Sec. School, VPO Dobhi, Hisar, Haryana - 125001');
$site_logo       = get_image('general', 'site_logo', 'assets/images/logo.svg');

// Base path for original school images
define('SCHOOL_IMG_DIR', 'assets/images/sunrise school image/');
define('SCHOOL_IMG_URI', 'assets/images/sunrise%20school%20image/');

/**
 * Helper function to return encoded image URI for CSS background-image and src attributes
 */
function school_img($filename) {
    return 'assets/images/sunrise%20school%20image/' . rawurlencode($filename);
}

// Navigation Menu Items with Grouped Dropdowns
$nav_menu = [
    'home' => [
        'title' => 'Home',
        'url' => 'index.php',
        'subitems' => [
            'home' => [
                'title' => 'Home Page',
                'url' => 'index.php',
                'icon' => 'home',
                'desc' => 'Welcome & School Overview'
            ],
            'about-us' => [
                'title' => 'About Us',
                'url' => 'about-us.php',
                'icon' => 'info',
                'desc' => 'Vision, Mission & Leadership'
            ],
            'contact' => [
                'title' => 'Contact Us',
                'url' => 'contact-us.php',
                'icon' => 'contact_support',
                'desc' => 'Campus Location & Helpdesk'
            ]
        ]
    ],
    'academics' => [
        'title' => 'Academics',
        'url' => 'academics.php',
        'subitems' => [
            'academics' => [
                'title' => 'Academics Overview',
                'url' => 'academics.php',
                'icon' => 'school',
                'desc' => 'HBSE Curriculum & Streams'
            ],
            'admissions' => [
                'title' => 'Admissions 2026-27',
                'url' => 'admission.php',
                'icon' => 'how_to_reg',
                'desc' => 'Application & Fee Structure'
            ],
            'faculty-staff' => [
                'title' => 'Faculty & Staff',
                'url' => 'faculty.php',
                'icon' => 'groups',
                'desc' => 'Our Teachers & Educators'
            ]
        ]
    ],
    'events' => [
        'title' => 'Events',
        'url' => 'events.php',
        'subitems' => [
            'events-news' => [
                'title' => 'Events & News',
                'url' => 'events.php',
                'icon' => 'celebration',
                'desc' => 'Celebrations & Announcements'
            ],
            'campus-life' => [
                'title' => 'Campus Life',
                'url' => 'campus.php',
                'icon' => 'sports_soccer',
                'desc' => 'Labs, Sports & Infrastructure'
            ],
            'gallery' => [
                'title' => 'Photo Gallery',
                'url' => 'gallery.php',
                'icon' => 'photo_library',
                'desc' => 'Moments Captured on Campus'
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
    if (isset($nav_menu[$key]['subitems']) && array_key_exists($current, $nav_menu[$key]['subitems'])) {
        return true;
    }
    return false;
}
?>
