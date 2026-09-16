<?php
/**
 * Content Block Save Handler
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Saves or updates text and rich-HTML blocks in `site_content` table
 * using PDO prepared statements with CSRF validation and XSS filtering.
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/db.php';

// Enforce superuser authentication
require_login();

// Helper to determine if request was sent via JavaScript fetch/AJAX
$is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        || (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false)
        || isset($_POST['ajax']);

function respond($success, $message, $page_key = 'home') {
    global $is_ajax;
    if ($is_ajax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'page_key' => $page_key
        ]);
        exit;
    } else {
        $type = $success ? 'success' : 'error';
        $redirect = "dashboard.php?tab=" . urlencode($page_key) . "&{$type}=" . urlencode($message);
        header("Location: " . $redirect);
        exit;
    }
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method. Expected POST.');
}

// Validate CSRF token
$submitted_token = $_POST['csrf_token'] ?? '';
if (!verify_csrf_token($submitted_token)) {
    respond(false, 'Security error: Invalid or expired CSRF token. Please refresh.');
}

// Extract and sanitize input parameters
$page_key      = trim($_POST['page_key'] ?? '');
$section_key   = trim($_POST['section_key'] ?? '');
$content_type  = trim($_POST['content_type'] ?? 'text');
$content_value = $_POST['content_value'] ?? '';

// Whitelist and format validation
if (empty($page_key) || empty($section_key)) {
    respond(false, 'Missing required page key or section key.', $page_key ?: 'home');
}

// Restrict page_key and section_key to alphanumeric, underscore, hyphen
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $page_key) || !preg_match('/^[a-zA-Z0-9_-]+$/', $section_key)) {
    respond(false, 'Invalid characters in section identifier.', $page_key);
}

if (!in_array($content_type, ['text', 'html'], true)) {
    $content_type = 'text';
}

// Sanitize Content based on type
if ($content_type === 'text') {
    // For plain text, strip tags entirely
    $clean_value = trim(strip_tags($content_value));
} else {
    // For HTML, allow safe formatting tags while neutralizing scripts & event handlers
    $allowed_tags = '<p><br><strong><b><em><i><u><strike><s><a><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><span><div><hr><table><thead><tbody><tr><th><td>';
    $clean_value = strip_tags($content_value, $allowed_tags);
    
    // Strip malicious javascript attributes like onerror=, onload=, onclick=, and javascript: protocols
    $clean_value = preg_replace('/on[a-zA-Z]+\s*=\s*"[^"]*"/i', '', $clean_value);
    $clean_value = preg_replace('/on[a-zA-Z]+\s*=\s*\'[^\']*\'/i', '', $clean_value);
    $clean_value = preg_replace('/href\s*=\s*"javascript:[^"]*"/i', 'href="#"', $clean_value);
    $clean_value = preg_replace('/href\s*=\s*\'javascript:[^\']*\'/i', 'href="#"', $clean_value);
}

$db = get_db_connection();
if (!$db) {
    respond(false, 'Database connection error.', $page_key);
}

try {
    // Upsert into site_content using prepared statement
    $sql = "INSERT INTO site_content (page_key, section_key, content_type, content_value)
            VALUES (:page_key, :section_key, :content_type, :content_value)
            ON DUPLICATE KEY UPDATE 
                content_value = VALUES(content_value),
                content_type = VALUES(content_type),
                updated_at = CURRENT_TIMESTAMP";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':page_key'      => $page_key,
        ':section_key'   => $section_key,
        ':content_type'  => $content_type,
        ':content_value' => $clean_value
    ]);

    respond(true, "Content for [{$section_key}] saved successfully!", $page_key);
} catch (PDOException $e) {
    error_log("Failed to save content block: " . $e->getMessage());
    respond(false, "Database update error: " . $e->getMessage(), $page_key);
}
