<?php
/**
 * Image Upload & Replacement Handler
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Validates, renames, and safely saves uploaded images to the /uploads/ folder.
 * Stores binary data URI in `site_images.image_data` for permanent survival across
 * Docker container rebuilds and Git pushes on Render / cloud platforms.
 * Updates the `site_images` table with prepared statements and cleans up old uploads.
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

function respond_image($success, $message, $page_key = 'home', $file_path = '', $preview_url = '') {
    global $is_ajax;
    if ($is_ajax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success'     => $success,
            'message'     => $message,
            'page_key'    => $page_key,
            'file_path'   => $file_path,
            'preview_url' => $preview_url
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
    respond_image(false, 'Invalid request method. Expected POST.');
}

// Validate CSRF token
$submitted_token = $_POST['csrf_token'] ?? '';
if (!verify_csrf_token($submitted_token)) {
    respond_image(false, 'Security error: Invalid or expired CSRF token. Please refresh.');
}

$page_key    = trim($_POST['page_key'] ?? '');
$image_key   = trim($_POST['image_key'] ?? '');
$alt_text    = trim($_POST['alt_text'] ?? '');
$custom_path = trim($_POST['custom_path'] ?? '');

if (empty($page_key) || empty($image_key)) {
    respond_image(false, 'Missing required page key or image identifier.', $page_key ?: 'home');
}

// Validate page and image keys format
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $page_key) || !preg_match('/^[a-zA-Z0-9_-]+$/', $image_key)) {
    respond_image(false, 'Invalid characters in image identifier.', $page_key);
}

$db = get_db_connection();
if (!$db) {
    respond_image(false, 'Database connection failed.', $page_key);
}

// Helper to upsert site_images with image_data
function upsert_site_image($db, $page_key, $image_key, $file_path, $alt_text, $image_data = null) {
    $driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
    
    // Check if image_data column exists
    $has_image_data_col = true;
    try {
        if ($driver === 'pgsql') {
            $col_check = $db->query("SELECT column_name FROM information_schema.columns WHERE table_name='site_images' AND column_name='image_data'")->fetch();
            if (!$col_check) {
                $db->exec("ALTER TABLE site_images ADD COLUMN IF NOT EXISTS image_data TEXT;");
            }
        }
    } catch (Exception $e) {
        $has_image_data_col = false;
    }

    if ($driver === 'pgsql') {
        if ($has_image_data_col) {
            $stmt = $db->prepare("
                INSERT INTO site_images (page_key, image_key, file_path, alt_text, image_data)
                VALUES (:page_key, :image_key, :file_path, :alt_text, :image_data)
                ON CONFLICT (page_key, image_key)
                DO UPDATE SET 
                    file_path = EXCLUDED.file_path,
                    alt_text = EXCLUDED.alt_text,
                    image_data = COALESCE(EXCLUDED.image_data, site_images.image_data),
                    updated_at = CURRENT_TIMESTAMP
            ");
            return $stmt->execute([
                ':page_key'   => $page_key,
                ':image_key'  => $image_key,
                ':file_path'  => $file_path,
                ':alt_text'   => $alt_text,
                ':image_data' => $image_data
            ]);
        } else {
            $stmt = $db->prepare("
                INSERT INTO site_images (page_key, image_key, file_path, alt_text)
                VALUES (:page_key, :image_key, :file_path, :alt_text)
                ON CONFLICT (page_key, image_key)
                DO UPDATE SET 
                    file_path = EXCLUDED.file_path,
                    alt_text = EXCLUDED.alt_text,
                    updated_at = CURRENT_TIMESTAMP
            ");
            return $stmt->execute([
                ':page_key'   => $page_key,
                ':image_key'  => $image_key,
                ':file_path'  => $file_path,
                ':alt_text'   => $alt_text
            ]);
        }
    } else {
        // MySQL / MariaDB
        if ($has_image_data_col) {
            $stmt = $db->prepare("
                INSERT INTO site_images (page_key, image_key, file_path, alt_text, image_data)
                VALUES (:page_key, :image_key, :file_path, :alt_text, :image_data)
                ON DUPLICATE KEY UPDATE 
                    file_path = VALUES(file_path),
                    alt_text = VALUES(alt_text),
                    image_data = IF(VALUES(image_data) IS NOT NULL, VALUES(image_data), image_data),
                    updated_at = CURRENT_TIMESTAMP
            ");
            return $stmt->execute([
                ':page_key'   => $page_key,
                ':image_key'  => $image_key,
                ':file_path'  => $file_path,
                ':alt_text'   => $alt_text,
                ':image_data' => $image_data
            ]);
        } else {
            $stmt = $db->prepare("
                INSERT INTO site_images (page_key, image_key, file_path, alt_text)
                VALUES (:page_key, :image_key, :file_path, :alt_text)
                ON DUPLICATE KEY UPDATE 
                    file_path = VALUES(file_path),
                    alt_text = VALUES(alt_text),
                    updated_at = CURRENT_TIMESTAMP
            ");
            return $stmt->execute([
                ':page_key'   => $page_key,
                ':image_key'  => $image_key,
                ':file_path'  => $file_path,
                ':alt_text'   => $alt_text
            ]);
        }
    }
}

// -----------------------------------------------------------------------------
// Case 1: Custom Image Path or URL was specified (Git-tracked asset or external URL)
// -----------------------------------------------------------------------------
if (!empty($custom_path) && (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] === UPLOAD_ERR_NO_FILE)) {
    // Sanitize path or URL
    $clean_path = trim($custom_path);
    // Remove any accidental leading slashes or ../
    if (strpos($clean_path, 'http://') !== 0 && strpos($clean_path, 'https://') !== 0 && strpos($clean_path, 'data:') !== 0) {
        $clean_path = preg_replace('#^(\.\./|/)+#', '', $clean_path);
    }
    
    try {
        upsert_site_image($db, $page_key, $image_key, $clean_path, $alt_text, null);
        $preview = (strpos($clean_path, 'http://') === 0 || strpos($clean_path, 'https://') === 0) 
            ? $clean_path 
            : ('../' . ltrim($clean_path, '/'));
        respond_image(true, "Image [{$image_key}] updated to chosen path successfully!", $page_key, $clean_path, $preview);
    } catch (PDOException $e) {
        respond_image(false, "Database update error: " . $e->getMessage(), $page_key);
    }
}

// -----------------------------------------------------------------------------
// Case 2: No File Uploaded (Update Alt Text only)
// -----------------------------------------------------------------------------
if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] === UPLOAD_ERR_NO_FILE) {
    try {
        $stmt = $db->prepare("UPDATE site_images SET alt_text = ? WHERE page_key = ? AND image_key = ?");
        $stmt->execute([$alt_text, $page_key, $image_key]);
        respond_image(true, "Alt text for [{$image_key}] updated successfully.", $page_key);
    } catch (PDOException $e) {
        respond_image(false, "Database update error: " . $e->getMessage(), $page_key);
    }
}

// -----------------------------------------------------------------------------
// Case 3: File Upload Processing (With Base64 DB Backup for Push Safety)
// -----------------------------------------------------------------------------
$file = $_FILES['image_file'];

// Check upload error status
if ($file['error'] !== UPLOAD_ERR_OK) {
    $upload_errors = [
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the maximum allowed file size.',
        UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'
    ];
    $msg = $upload_errors[$file['error']] ?? 'Unknown upload error occurred.';
    respond_image(false, $msg, $page_key);
}

// Validate File Size: Max 2MB (2,097,152 bytes)
$max_size = 2 * 1024 * 1024;
if ($file['size'] > $max_size) {
    respond_image(false, 'File exceeds the maximum allowed size of 2MB.', $page_key);
}

// Validate Extension
$raw_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
if (!in_array($raw_ext, $allowed_extensions, true)) {
    respond_image(false, 'Invalid file extension. Only JPG, JPEG, PNG, and WEBP formats are allowed.', $page_key);
}

// Validate Real MIME type via FileInfo
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

$allowed_mimes = [
    'image/jpeg',
    'image/png',
    'image/webp'
];

if (!in_array($mime_type, $allowed_mimes, true)) {
    respond_image(false, "Security rejection: Detected MIME type ({$mime_type}) is not a permitted image type.", $page_key);
}

// Validate genuine image header dimensions
$image_info = @getimagesize($file['tmp_name']);
if ($image_info === false) {
    respond_image(false, 'The uploaded file could not be verified as a valid image.', $page_key);
}

// Define destination folder
$upload_dir = __DIR__ . '/../uploads/';
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        respond_image(false, 'Failed to create uploads directory on server. Check folder permissions.', $page_key);
    }
}

// Generate an unguessable unique filename
$safe_ext = ($raw_ext === 'jpeg') ? 'jpg' : $raw_ext;
$random_hash = bin2hex(random_bytes(10));
$timestamp = time();
$new_filename = "img_{$page_key}_{$image_key}_{$timestamp}_{$random_hash}.{$safe_ext}";
$destination_path = $upload_dir . $new_filename;
$relative_db_path = "uploads/" . $new_filename;

// Move the uploaded file from PHP temporary storage
if (!move_uploaded_file($file['tmp_name'], $destination_path)) {
    respond_image(false, 'Failed to save the uploaded image to the server disk.', $page_key);
}

// Read binary data and generate persistent Base64 Data URI for DB storage
$raw_binary = @file_get_contents($destination_path);
$base64_data_uri = null;
if ($raw_binary !== false) {
    $base64_data_uri = 'data:' . $mime_type . ';base64,' . base64_encode($raw_binary);
}

try {
    // 1. Fetch current file path to clean up old uploaded image
    $check_stmt = $db->prepare("SELECT file_path FROM site_images WHERE page_key = ? AND image_key = ? LIMIT 1");
    $check_stmt->execute([$page_key, $image_key]);
    $old_record = $check_stmt->fetch();
    $old_file_path = $old_record['file_path'] ?? '';

    // 2. Insert or update the new image path AND persistent image_data
    upsert_site_image($db, $page_key, $image_key, $relative_db_path, $alt_text, $base64_data_uri);

    // 3. Delete old file ONLY if it was located in uploads/ (protect original assets/ directory)
    if (!empty($old_file_path) && strpos($old_file_path, 'uploads/') === 0 && $old_file_path !== $relative_db_path) {
        $old_disk_file = __DIR__ . '/../' . $old_file_path;
        if (file_exists($old_disk_file) && is_file($old_disk_file)) {
            @unlink($old_disk_file);
        }
    }

    $preview_url = '../' . $relative_db_path;
    respond_image(true, "Image [{$image_key}] uploaded and saved permanently!", $page_key, $relative_db_path, $preview_url);
} catch (PDOException $e) {
    // If DB fails, remove newly moved file to prevent orphaned images
    @unlink($destination_path);
    error_log("Failed to update site_images: " . $e->getMessage());
    respond_image(false, "Database error: " . $e->getMessage(), $page_key);
}
