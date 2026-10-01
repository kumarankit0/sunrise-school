<?php
/**
 * Frontend Content & Image Helper
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * This file provides easy, drop-in helper functions to display dynamic
 * content and images on any school website page.
 *
 * Performance Feature:
 * Loads all content blocks and images for a given page key in a SINGLE query
 * and caches them in memory. Repeated calls on the same page take 0ms!
 */

require_once __DIR__ . '/db.php';

define('CMS_CACHE_DIR', __DIR__ . '/../cache');
define('CMS_CACHE_FILE', CMS_CACHE_DIR . '/cms_content_cache.json');

/**
 * In-memory storage for loaded page content & images
 */
$GLOBALS['cms_content_cache'] = [];
$GLOBALS['cms_images_cache']  = [];
$GLOBALS['cms_cache_loaded']  = false;

/**
 * Clears the file-based CMS content cache (called after admin changes)
 */
function cms_clear_cache() {
    $GLOBALS['cms_cache_loaded'] = false;
    $GLOBALS['cms_content_cache'] = [];
    $GLOBALS['cms_images_cache']  = [];
    if (file_exists(CMS_CACHE_FILE)) {
        @unlink(CMS_CACHE_FILE);
    }
}

/**
 * Loads entire CMS cache from file or warms it up from the database in a single pass.
 */
function cms_load_global_cache() {
    if ($GLOBALS['cms_cache_loaded']) {
        return;
    }

    // 1. Try reading from fast file cache (sub-millisecond)
    if (file_exists(CMS_CACHE_FILE)) {
        $raw = @file_get_contents(CMS_CACHE_FILE);
        if ($raw) {
            $data = @json_decode($raw, true);
            if (is_array($data) && isset($data['content']) && isset($data['images'])) {
                $GLOBALS['cms_content_cache'] = $data['content'];
                $GLOBALS['cms_images_cache']  = $data['images'];
                $GLOBALS['cms_cache_loaded']  = true;
                return;
            }
        }
    }

    // 2. Cache miss: warm up from database
    $db = get_db_connection();
    if (!$db) {
        $GLOBALS['cms_cache_loaded'] = true;
        return;
    }

    try {
        // Query all content blocks
        $stmt = $db->query("SELECT page_key, section_key, content_type, content_value FROM site_content");
        if ($stmt) {
            $c_rows = $stmt->fetchAll();
            foreach ($c_rows as $row) {
                $GLOBALS['cms_content_cache'][$row['page_key']][$row['section_key']] = [
                    'type'  => $row['content_type'],
                    'value' => $row['content_value']
                ];
            }
        }

        // Query all image references (omit bulky image_data for speed)
        $stmt2 = $db->query("SELECT page_key, image_key, file_path, alt_text FROM site_images");
        if ($stmt2) {
            $i_rows = $stmt2->fetchAll();
            foreach ($i_rows as $row) {
                $GLOBALS['cms_images_cache'][$row['page_key']][$row['image_key']] = [
                    'path' => $row['file_path'],
                    'alt'  => $row['alt_text']
                ];
            }
        }

        // Save to file cache for subsequent 0ms page loads
        if (!is_dir(CMS_CACHE_DIR)) {
            @mkdir(CMS_CACHE_DIR, 0777, true);
        }
        @file_put_contents(CMS_CACHE_FILE, json_encode([
            'content' => $GLOBALS['cms_content_cache'],
            'images'  => $GLOBALS['cms_images_cache'],
            'updated' => time()
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $GLOBALS['cms_cache_loaded'] = true;
    } catch (Exception $e) {
        error_log("CMS global cache build error: " . $e->getMessage());
        $GLOBALS['cms_cache_loaded'] = true;
    }
}

/**
 * Preloads all text content for a given page key into memory
 *
 * @param string $page_key
 */
function preload_page_content($page_key) {
    if (!$GLOBALS['cms_cache_loaded']) {
        cms_load_global_cache();
    }
    if (!isset($GLOBALS['cms_content_cache'][$page_key])) {
        $GLOBALS['cms_content_cache'][$page_key] = [];
    }
}

/**
 * Preloads all images for a given page key into memory
 *
 * @param string $page_key
 */
function preload_page_images($page_key) {
    if (!$GLOBALS['cms_cache_loaded']) {
        cms_load_global_cache();
    }
    if (!isset($GLOBALS['cms_images_cache'][$page_key])) {
        $GLOBALS['cms_images_cache'][$page_key] = [];
    }
}

/**
 * Fetches dynamic text or HTML content from the database.
 * Falls back to $default if not found in database or if database is offline.
 *
 * Example Usage:
 *   <h1><?= get_text('home', 'hero_title', 'Welcome to Sun Rise School') ?></h1>
 *
 * @param string $page_key    e.g. 'home', 'about', 'events', 'contact', 'general'
 * @param string $section_key e.g. 'hero_title', 'hero_subtitle', 'phone'
 * @param string $default     Fallback string if no custom content has been saved
 * @return string
 */
function get_text($page_key, $section_key, $default = '') {
    preload_page_content($page_key);

    if (isset($GLOBALS['cms_content_cache'][$page_key][$section_key])) {
        $item = $GLOBALS['cms_content_cache'][$page_key][$section_key];
        return $item['value'];
    }

    return $default;
}

/**
 * Fetches dynamic image path from the database.
 * Falls back to $default if not found in database or if database is offline.
 * Automatically restores uploaded image files from database image_data if disk is wiped on redeploy.
 *
 * Example Usage:
 *   <img src="<?= get_image('home', 'hero_banner', 'assets/images/banner.jpg') ?>"
 *        alt="<?= get_image_alt('home', 'hero_banner', 'School Campus') ?>">
 *
 * @param string $page_key  e.g. 'home', 'about', 'gallery'
 * @param string $image_key e.g. 'hero_banner', 'about_building'
 * @param string $default   Fallback image path (e.g. original asset URL)
 * @return string
 */
function get_image($page_key, $image_key, $default = '') {
    preload_page_images($page_key);

    if (isset($GLOBALS['cms_images_cache'][$page_key][$image_key])) {
        $item = $GLOBALS['cms_images_cache'][$page_key][$image_key];
        if (!empty($item['path'])) {
            $path = $item['path'];
            if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0 || strpos($path, 'data:') === 0) {
                return htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
            }

            $clean = rawurldecode(ltrim($path, '/'));
            $disk_path = __DIR__ . '/../' . $clean;

            // 1. If file exists on disk, serve it cleanly
            if (file_exists($disk_path) && is_file($disk_path)) {
                $parts = explode('/', $clean);
                $encoded_parts = array_map('rawurlencode', $parts);
                return htmlspecialchars(implode('/', $encoded_parts), ENT_QUOTES, 'UTF-8');
            }

            // 2. If file missing from disk (e.g. after Git push / Docker container recreate on Render):
            // Automatically restore the file to uploads/ from persistent database image_data!
            $img_data = $item['image_data'] ?? null;
            if (empty($img_data)) {
                $db = get_db_connection();
                if ($db) {
                    try {
                        $s_lazy = $db->prepare("SELECT image_data FROM site_images WHERE page_key = ? AND image_key = ? LIMIT 1");
                        $s_lazy->execute([$page_key, $image_key]);
                        $img_data = $s_lazy->fetchColumn();
                        $GLOBALS['cms_images_cache'][$page_key][$image_key]['image_data'] = $img_data;
                    } catch (Exception $e) {
                        // Ignore
                    }
                }
            }

            if (!empty($img_data)) {
                $data_parts = explode(',', $img_data, 2);
                if (count($data_parts) === 2) {
                    $decoded = base64_decode($data_parts[1]);
                    if ($decoded !== false) {
                        $dir = dirname($disk_path);
                        if (!is_dir($dir)) {
                            @mkdir($dir, 0755, true);
                        }
                        if (@file_put_contents($disk_path, $decoded) !== false) {
                            $parts = explode('/', $clean);
                            $encoded_parts = array_map('rawurlencode', $parts);
                            return htmlspecialchars(implode('/', $encoded_parts), ENT_QUOTES, 'UTF-8');
                        }
                    }
                }
                // If disk writing is disabled or restricted, output data URI directly
                return htmlspecialchars($img_data, ENT_QUOTES, 'UTF-8');
            }

            // 3. File missing and no image_data: DO NOT return broken 404 URL. Fall through to default!
        }
    }

    if (!empty($default)) {
        if (strpos($default, 'http://') === 0 || strpos($default, 'https://') === 0 || strpos($default, 'data:') === 0) {
            return htmlspecialchars($default, ENT_QUOTES, 'UTF-8');
        }
        $clean = rawurldecode(ltrim($default, '/'));
        $parts = explode('/', $clean);
        $encoded_parts = array_map('rawurlencode', $parts);
        return htmlspecialchars(implode('/', $encoded_parts), ENT_QUOTES, 'UTF-8');
    }

    return '';
}

/**
 * Fetches alt text for a dynamic image from the database.
 *
 * @param string $page_key
 * @param string $image_key
 * @param string $default
 * @return string
 */
function get_image_alt($page_key, $image_key, $default = '') {
    preload_page_images($page_key);

    if (isset($GLOBALS['cms_images_cache'][$page_key][$image_key])) {
        $item = $GLOBALS['cms_images_cache'][$page_key][$image_key];
        if (!empty($item['alt'])) {
            return htmlspecialchars($item['alt'], ENT_QUOTES, 'UTF-8');
        }
    }

    return htmlspecialchars($default, ENT_QUOTES, 'UTF-8');
}

/**
 * Fetches active events for the homepage Live Event Tracker.
 * Reads up to 8 configurable slots from `site_content` table
 * with seamless fallback to verified defaults.
 *
 * @return array
 */
function get_live_tracker_events() {
    $defaults = [
        [
            'title' => 'NORTH ZONE RELIANCE FOOTBALL CHAMPIONSHIP',
            'badge' => '',
            'link'  => 'events.php'
        ],
        [
            'title' => 'Admission Open for New Session 2026-27',
            'badge' => 'NEW',
            'link'  => 'admission.php'
        ],
        [
            'title' => 'Annual Sports Meet & Athletic Championship Trials',
            'badge' => 'NEW',
            'link'  => 'campus.php#sports'
        ],
        [
            'title' => 'State Level Science Exhibition & Robotic Project Display',
            'badge' => '',
            'link'  => 'academics.php'
        ],
        [
            'title' => 'Scholarship Test for Meritorious Students (Classes 6th-12th)',
            'badge' => 'NEW',
            'link'  => 'admission.php'
        ],
        [
            'title' => 'CBSE/HBSE Board Exam Preparation Workshop & Mock Tests',
            'badge' => '',
            'link'  => 'academics.php#academic-calendar'
        ]
    ];

    $events = [];

    // Check up to 8 configurable event slots
    for ($i = 1; $i <= 8; $i++) {
        $default_item = $defaults[$i - 1] ?? null;
        $title_def = $default_item ? $default_item['title'] : '';
        $badge_def = $default_item ? $default_item['badge'] : '';
        $link_def  = $default_item ? $default_item['link']  : 'events.php';

        $title = get_text('home', "event_{$i}_title", $title_def);
        $badge = get_text('home', "event_{$i}_badge", $badge_def);
        $link  = get_text('home', "event_{$i}_link",  $link_def);

        $clean_title = trim(strip_tags($title));
        if (!empty($clean_title)) {
            $events[] = [
                'title' => $clean_title,
                'badge' => trim(strip_tags($badge)),
                'link'  => trim($link) ?: 'events.php'
            ];
        }
    }

    return !empty($events) ? $events : $defaults;
}

/**
 * Returns the structured schema and default cards for each Gallery Category
 * in the exact order displayed on gallery.php and the Admin Panel.
 *
 * @return array
 */
function get_gallery_categories_schema() {
    return [
        'media' => [
            'title' => 'Media Coverage',
            'icon'  => 'newspaper',
            'desc'  => 'Manage newspaper clippings, press releases, and media feature photo cards.',
            'defaults' => [
                1 => [
                    'img'   => 'assets/images/sunrise school image/IMG_20210815_093156~2.webp',
                    'title' => 'Newspaper & Media Feature Coverage'
                ]
            ]
        ],
        'cultural' => [
            'title' => 'Cultural Fest & Celebrations',
            'icon'  => 'celebration',
            'desc'  => 'Manage cultural fest, folk dance, stage pageants, annual result day felicitations, and Diwali celebrations.',
            'defaults' => [
                1 => [
                    'img'   => 'assets/images/sunrise school image/exhibition.webp',
                    'title' => 'Cultural Fest & Folk Performances'
                ],
                2 => [
                    'img'   => 'assets/images/sunrise school image/all_staffmembers.webp',
                    'title' => 'Grand Stage Musical Pageant'
                ],
                3 => [
                    'img'   => 'assets/images/sunrise school image/award_ceremony.webp',
                    'title' => 'Annual Result Declaration & Award Ceremony'
                ],
                4 => [
                    'img'   => 'assets/images/sunrise school image/toppers.webp',
                    'title' => 'HBSE Board Exam Result Celebrations'
                ],
                5 => [
                    'img'   => 'assets/images/sunrise school image/lab_class.webp',
                    'title' => 'Diwali Celebration & Rangoli Contest'
                ],
                6 => [
                    'img'   => 'assets/images/sunrise school image/exhibition3.webp',
                    'title' => 'Eco-Friendly Deepawali Festival'
                ]
            ]
        ],
        'activity' => [
            'title' => 'School Activity',
            'icon'  => 'sports_kabaddi',
            'desc'  => 'Manage outdoor sports, morning assembly, yoga demonstrations, and campus activity photo cards.',
            'defaults' => [
                1 => [
                    'img'   => 'assets/images/sunrise school image/students_ground.webp',
                    'title' => 'Outdoor Sports & Physical Drills'
                ],
                2 => [
                    'img'   => 'assets/images/sunrise school image/yoga.webp',
                    'title' => 'International Yoga Day Demonstrations'
                ],
                3 => [
                    'img'   => 'assets/images/sunrise school image/school_home1.webp',
                    'title' => 'Morning Assembly & Special Celebrations'
                ]
            ]
        ],
        'competition' => [
            'title' => 'Competition',
            'icon'  => 'emoji_events',
            'desc'  => 'Manage inter-school science exhibitions, quiz contests, art, and debate competition photo cards.',
            'defaults' => [
                1 => [
                    'img'   => 'assets/images/sunrise school image/shinning_stars.webp',
                    'title' => 'Inter-School Science & Quiz Competition'
                ],
                2 => [
                    'img'   => 'assets/images/sunrise school image/children_sitting.webp',
                    'title' => 'Art, Essay & Debate Competition'
                ]
            ]
        ]
    ];
}

/**
 * Returns the active slot numbers for a given gallery category.
 *
 * @param string $cat_key
 * @return array<int>
 */
function get_gallery_category_slots($cat_key) {
    $schema = get_gallery_categories_schema();
    if (!isset($schema[$cat_key])) {
        return [];
    }
    $defaults = $schema[$cat_key]['defaults'];
    $default_slots_str = implode(',', array_keys($defaults));
    $raw_slots = get_text('gallery', "gal_{$cat_key}_slots", $default_slots_str);

    if (trim($raw_slots) === 'NONE') {
        return [];
    }

    $parts = array_filter(array_map('intval', explode(',', $raw_slots)), function($n) {
        return $n > 0;
    });

    // Deduplicate while preserving order
    $slots = array_values(array_unique($parts));
    return $slots;
}

/**
 * Returns all cards for a specific gallery category (or all categories if $cat_key is null).
 * Each returned card has:
 *   - 'cat'       => category key
 *   - 'slot'      => slot number
 *   - 'img_key'   => site_images key
 *   - 'title_key' => site_content key
 *   - 'img'       => resolved image URL
 *   - 'raw_img'   => raw default or stored image path
 *   - 'title'     => card heading
 *
 * @param string|null $cat_key
 * @param bool $include_empty Whether to include newly added empty slots (true for Admin, false for Frontend)
 * @return array
 */
function get_gallery_category_cards($cat_key = null, $include_empty = false) {
    $schema = get_gallery_categories_schema();
    $categories_to_load = $cat_key ? [$cat_key => $schema[$cat_key]] : $schema;
    $cards = [];

    foreach ($categories_to_load as $c_key => $c_info) {
        if (!$c_info) continue;
        $slots = get_gallery_category_slots($c_key);
        foreach ($slots as $slot) {
            $def = $c_info['defaults'][$slot] ?? null;
            $img_key   = "gal_{$c_key}_img_{$slot}";
            $title_key = "gal_{$c_key}_title_{$slot}";

            $def_img   = $def ? $def['img'] : '';
            $def_title = $def ? $def['title'] : '';

            $resolved_img = get_image('gallery', $img_key, $def_img);
            $resolved_title = get_text('gallery', $title_key, $def_title);

            if (!$include_empty && empty($resolved_img)) {
                continue;
            }

            $cards[] = [
                'cat'       => $c_key,
                'cat_title' => $c_info['title'],
                'slot'      => $slot,
                'img_key'   => $img_key,
                'title_key' => $title_key,
                'img'       => $resolved_img,
                'def_img'   => $def_img,
                'title'     => $resolved_title,
                'def_title' => $def_title
            ];
        }
    }

    return $cards;
}

/**
 * Returns the default schema for Event & News Highlight Cards on events.php
 *
 * @return array
 */
function get_event_news_schema() {
    return [
        1 => [
            'img'       => 'assets/images/sunrise school image/exhibition.webp',
            'date'      => '14 NOV',
            'tag'       => 'Cultural Fest',
            'category'  => 'cultural',
            'title'     => 'Cultural Fest & Folk Performances',
            'desc'      => 'Students showcased vibrant folk dance, musical theatre, and dramatic pageants celebrating Indian heritage with extraordinary enthusiasm.',
            'link_text' => 'View Gallery',
            'link_url'  => 'gallery.php?cat=cultural#gallery-filters'
        ],
        2 => [
            'img'       => 'assets/images/sunrise school image/students_ground.webp',
            'date'      => '28 OCT',
            'tag'       => 'School Activity',
            'category'  => 'activity',
            'title'     => 'Outdoor Sports & Physical Drills',
            'desc'      => 'Comprehensive physical fitness training, athletic track events, and team games organized across the school sports ground.',
            'link_text' => 'View Gallery',
            'link_url'  => 'gallery.php?cat=activity#gallery-filters'
        ],
        3 => [
            'img'       => 'assets/images/sunrise school image/all_staffmembers.webp',
            'date'      => '05 SEP',
            'tag'       => 'Cultural Fest',
            'category'  => 'cultural',
            'title'     => 'Grand Stage Musical Pageant',
            'desc'      => 'Spectacular annual stage presentations featuring student musical choirs, moral value plays, and mentor felicitation with all staff members.',
            'link_text' => 'View Gallery',
            'link_url'  => 'gallery.php?cat=cultural#gallery-filters'
        ],
        4 => [
            'img'       => 'assets/images/sunrise school image/yoga.webp',
            'date'      => '21 JUN',
            'tag'       => 'School Activity',
            'category'  => 'activity',
            'title'     => 'International Yoga Day Demonstrations',
            'desc'      => 'Students and faculty actively participate in mass yoga asanas and mindful meditation sessions cultivating mental focus and physical health.',
            'link_text' => 'View Gallery',
            'link_url'  => 'gallery.php?cat=activity#gallery-filters'
        ]
    ];
}

/**
 * Returns active slot numbers for Event & News Highlight Cards
 *
 * @return array<int>
 */
function get_event_news_slots() {
    $schema = get_event_news_schema();
    $default_slots_str = implode(',', array_keys($schema));
    $raw_slots = get_text('events', 'event_news_slots', $default_slots_str);

    if (trim($raw_slots) === 'NONE') {
        return [];
    }

    $parts = array_filter(array_map('intval', explode(',', $raw_slots)), function($n) {
        return $n > 0;
    });

    return array_values(array_unique($parts));
}

/**
 * Returns all active event & news cards
 *
 * @param bool $include_empty
 * @return array
 */
function get_event_news_cards($include_empty = false) {
    $schema = get_event_news_schema();
    $slots = get_event_news_slots();
    $cards = [];

    foreach ($slots as $slot) {
        $def = $schema[$slot] ?? [
            'img'       => 'assets/images/sunrise school image/exhibition1.webp',
            'date'      => date('d M'),
            'tag'       => 'Event',
            'category'  => 'cultural',
            'title'     => 'School Event Highlight',
            'desc'      => 'Description of school event and student achievements.',
            'link_text' => 'Read More',
            'link_url'  => 'gallery.php'
        ];

        $img_key       = "news{$slot}_img";
        $date_key      = "news{$slot}_date";
        $tag_key       = "news{$slot}_tag";
        $cat_key       = "news{$slot}_cat";
        $title_key     = "news{$slot}_title";
        $desc_key      = "news{$slot}_desc";
        $link_text_key = "news{$slot}_link_text";
        $link_url_key  = "news{$slot}_link_url";

        $img       = get_image('events', $img_key, $def['img']);
        $date      = get_text('events', $date_key, $def['date']);
        $tag       = get_text('events', $tag_key, $def['tag']);
        $category  = get_text('events', $cat_key, $def['category']);
        $title     = get_text('events', $title_key, $def['title']);
        $desc      = get_text('events', $desc_key, $def['desc']);
        $link_text = get_text('events', $link_text_key, $def['link_text']);
        $link_url  = get_text('events', $link_url_key, $def['link_url']);

        if (!$include_empty && empty($img) && empty($title)) {
            continue;
        }

        $cards[] = [
            'slot'          => $slot,
            'img_key'       => $img_key,
            'date_key'      => $date_key,
            'tag_key'       => $tag_key,
            'cat_key'       => $cat_key,
            'title_key'     => $title_key,
            'desc_key'      => $desc_key,
            'link_text_key' => $link_text_key,
            'link_url_key'  => $link_url_key,
            'img'           => $img,
            'date'          => $date,
            'tag'           => $tag,
            'category'      => $category,
            'title'         => $title,
            'desc'          => $desc,
            'link_text'     => $link_text,
            'link_url'      => $link_url,
            'def'           => $def
        ];
    }

    return $cards;
}

/**
 * Returns the default schema for Alumni Profile Cards on alumni.php
 *
 * @return array
 */
function get_alumni_schema() {
    return [
        1 => [
            'photo' => 'assets/images/sunrise school image/toppers.webp',
            'name'  => 'Pooja Sharma',
            'batch' => 'Batch of 2016',
            'role'  => 'Software Development Engineer',
            'org'   => 'Microsoft India • B.Tech (CSE)',
            'quote' => 'Sun Rise School provided the mathematical clarity, dedicated mentors, and discipline that laid the cornerstone for my engineering career.',
            'link'  => 'https://linkedin.com'
        ],
        2 => [
            'photo' => 'assets/images/sunrise school image/IMG_20210815_093156~2.webp',
            'name'  => 'Dr. Aman Verma',
            'batch' => 'Batch of 2017',
            'role'  => 'Medical Officer (MBBS)',
            'org'   => 'Govt. Medical College • Science (PCB)',
            'quote' => 'The thorough science labs, personal doubt clearing by teachers, and moral values learned here continue to guide my medical service.',
            'link'  => 'https://linkedin.com'
        ],
        3 => [
            'photo' => 'assets/images/sunrise school image/award_ceremony.webp',
            'name'  => 'Vikram Singh',
            'batch' => 'Batch of 2018',
            'role'  => 'Assistant Commandant / Defence',
            'org'   => 'Indian Armed Forces • Commerce & Sports',
            'quote' => 'Rigorous sports drills, NCC discipline, and patriotic values at Sun Rise inspired me to proudly serve our great nation in uniform.',
            'link'  => 'https://linkedin.com'
        ],
        4 => [
            'photo' => 'assets/images/sunrise school image/shinning_stars.webp',
            'name'  => 'Neha Choudhary',
            'batch' => 'Batch of 2019',
            'role'  => 'Chartered Accountant (CA)',
            'org'   => 'Deloitte India • Commerce Stream Ranker',
            'quote' => 'The conceptual rigor in Accountancy and continuous testing culture at Sun Rise made clearing the CA exams on the first attempt possible.',
            'link'  => 'https://linkedin.com'
        ],
        5 => [
            'photo' => 'assets/images/sunrise school image/children_sitting.webp',
            'name'  => 'Rahul Beniwal',
            'batch' => 'Batch of 2020',
            'role'  => 'Data Scientist & AI Researcher',
            'org'   => 'IIT Delhi (M.Tech) • Non-Medical',
            'quote' => 'Encouragement to participate in Science Exhibitions and state Olympiads sparked my passion for research and technology.',
            'link'  => 'https://linkedin.com'
        ],
        6 => [
            'photo' => 'assets/images/sunrise school image/exhibition1.webp',
            'name'  => 'Priya Rani',
            'batch' => 'Batch of 2021',
            'role'  => 'Civil Services Aspirant & Educator',
            'org'   => 'Delhi University • Arts Stream Block Topper',
            'quote' => 'Exceptional literature and social studies mentorship nurtured my analytical writing and public speaking skills.',
            'link'  => 'https://linkedin.com'
        ]
    ];
}

/**
 * Returns active slot numbers for Alumni Cards
 *
 * @return array<int>
 */
function get_alumni_slots() {
    $schema = get_alumni_schema();
    $default_slots_str = implode(',', array_keys($schema));
    $raw_slots = get_text('alumni', 'alumni_slots', $default_slots_str);

    if (trim($raw_slots) === 'NONE') {
        return [];
    }

    $parts = array_filter(array_map('intval', explode(',', $raw_slots)), function($n) {
        return $n > 0;
    });

    return array_values(array_unique($parts));
}

/**
 * Returns all active alumni cards
 *
 * @param bool $include_empty
 * @return array
 */
function get_alumni_cards($include_empty = false) {
    $schema = get_alumni_schema();
    $slots = get_alumni_slots();
    $cards = [];

    foreach ($slots as $slot) {
        $def = $schema[$slot] ?? [
            'photo' => 'assets/images/sunrise school image/toppers.webp',
            'name'  => 'Alumnus Name',
            'batch' => 'Class of ' . (date('Y') - 5),
            'role'  => 'Profession / Designation',
            'org'   => 'Organization / University',
            'quote' => 'A memorable quote or tribute to Sun Rise Sr. Sec. School.',
            'link'  => ''
        ];

        $photo_key = "alumni_{$slot}_photo";
        $name_key  = "alumni_{$slot}_name";
        $batch_key = "alumni_{$slot}_batch";
        $role_key  = "alumni_{$slot}_role";
        $org_key   = "alumni_{$slot}_org";
        $quote_key = "alumni_{$slot}_quote";
        $link_key  = "alumni_{$slot}_link";

        $photo = get_image('alumni', $photo_key, $def['photo']);
        $name  = get_text('alumni', $name_key, $def['name']);
        $batch = get_text('alumni', $batch_key, $def['batch']);
        $role  = get_text('alumni', $role_key, $def['role']);
        $org   = get_text('alumni', $org_key, $def['org']);
        $quote = get_text('alumni', $quote_key, $def['quote']);
        $link  = get_text('alumni', $link_key, $def['link']);

        if (!$include_empty && empty($name) && empty($photo)) {
            continue;
        }

        $cards[] = [
            'slot'      => $slot,
            'photo_key' => $photo_key,
            'name_key'  => $name_key,
            'batch_key' => $batch_key,
            'role_key'  => $role_key,
            'org_key'   => $org_key,
            'quote_key' => $quote_key,
            'link_key'  => $link_key,
            'photo'     => $photo,
            'name'      => $name,
            'batch'     => $batch,
            'role'      => $role,
            'org'       => $org,
            'quote'     => $quote,
            'link'      => $link,
            'def'       => $def
        ];
    }

    return $cards;
}


