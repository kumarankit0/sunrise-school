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

/**
 * In-memory storage for loaded page content & images
 */
$GLOBALS['cms_content_cache'] = [];
$GLOBALS['cms_images_cache']  = [];

/**
 * Preloads all text content for a given page key into memory
 *
 * @param string $page_key
 */
function preload_page_content($page_key) {
    if (isset($GLOBALS['cms_content_cache'][$page_key])) {
        return; // Already loaded in memory
    }

    $GLOBALS['cms_content_cache'][$page_key] = [];

    $db = get_db_connection();
    if (!$db) {
        return; // Gracefully fallback to default values
    }

    try {
        $stmt = $db->prepare("SELECT section_key, content_type, content_value FROM site_content WHERE page_key = ?");
        $stmt->execute([$page_key]);
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $GLOBALS['cms_content_cache'][$page_key][$row['section_key']] = [
                'type'  => $row['content_type'],
                'value' => $row['content_value']
            ];
        }
    } catch (PDOException $e) {
        error_log("CMS Content preload error: " . $e->getMessage());
    }
}

/**
 * Preloads all images for a given page key into memory
 *
 * @param string $page_key
 */
function preload_page_images($page_key) {
    if (isset($GLOBALS['cms_images_cache'][$page_key])) {
        return; // Already loaded in memory
    }

    $GLOBALS['cms_images_cache'][$page_key] = [];

    $db = get_db_connection();
    if (!$db) {
        return; // Gracefully fallback to default values
    }

    try {
        $stmt = $db->prepare("SELECT image_key, file_path, alt_text FROM site_images WHERE page_key = ?");
        $stmt->execute([$page_key]);
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $GLOBALS['cms_images_cache'][$page_key][$row['image_key']] = [
                'path' => $row['file_path'],
                'alt'  => $row['alt_text']
            ];
        }
    } catch (PDOException $e) {
        error_log("CMS Images preload error: " . $e->getMessage());
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
            if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
                return htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
            }
            $clean = rawurldecode(ltrim($path, '/'));
            $parts = explode('/', $clean);
            $encoded_parts = array_map('rawurlencode', $parts);
            return htmlspecialchars(implode('/', $encoded_parts), ENT_QUOTES, 'UTF-8');
        }
    }

    if (!empty($default)) {
        if (strpos($default, 'http://') === 0 || strpos($default, 'https://') === 0) {
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
