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
