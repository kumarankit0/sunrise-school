<?php
/**
 * Image Upload & Replacement Handler
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Validates, renames, and safely saves uploaded images to the /uploads/ folder.
 * Updates the `site_images` table with prepared statements and cleans up old uploads.
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/db.php';

// Enforce superuser authentication
require_login();

function redirect_with_message($page_key, $is_success, $message) {
    $type = $is_success ? 'success' : 'error';
    $redirect = "dashboard.php?tab=" . urlencode($page_key) . "&{$type}=" . urlencode($message);
    header("Location: " . $redirect);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_message('home', false, 'Invalid request method. Expected POST.');
}

// Validate CSRF token
$submitted_token = $_POST['csrf_token'] ?? '';
if (!verify_csrf_token($submitted_token)) {
    redirect_with_message('home', false, 'Security error: Invalid or expired CSRF token. Please refresh.');
}

$page_key  = trim($_POST['page_key'] ?? '');
$image_key = trim($_POST['image_key'] ?? '');
$alt_text  = trim($_POST['alt_text'] ?? '');

if (empty($page_key) || empty($image_key)) {
    redirect_with_message('home', false, 'Missing required page key or image identifier.');
}

// Validate page and image keys format
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $page_key) || !preg_match('/^[a-zA-Z0-9_-]+$/', $image_key)) {
    redirect_with_message($page_key, false, 'Invalid characters in image identifier.');
}

// Check if file was uploaded
if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] === UPLOAD_ERR_NO_FILE) {
    // If only alt text was updated without uploading a new image:
    $db = get_db_connection();
    if ($db) {
        $stmt = $db->prepare("UPDATE site_images SET alt_text = ? WHERE page_key = ? AND image_key = ?");
        $stmt->execute([$alt_text, $page_key, $image_key]);
        redirect_with_message($page_key, true, "Alt text for [{$image_key}] updated successfully.");
    }
    redirect_with_message($page_key, false, 'No image file was selected for upload.');
}

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
    redirect_with_message($page_key, false, $msg);
}

// Validate File Size: Max 2MB (2,097,152 bytes)
$max_size = 2 * 1024 * 1024;
if ($file['size'] > $max_size) {
    redirect_with_message($page_key, false, 'File exceeds the maximum allowed size of 2MB.');
}

// Validate Extension
$raw_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
if (!in_array($raw_ext, $allowed_extensions, true)) {
    redirect_with_message($page_key, false, 'Invalid file extension. Only JPG, JPEG, PNG, and WEBP formats are allowed.');
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
    redirect_with_message($page_key, false, "Security rejection: Detected MIME type ({$mime_type}) is not a permitted image type.");
}

// Validate genuine image header dimensions
$image_info = @getimagesize($file['tmp_name']);
if ($image_info === false) {
    redirect_with_message($page_key, false, 'The uploaded file could not be verified as a valid image.');
}

// Define destination folder
$upload_dir = __DIR__ . '/../uploads/';
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        redirect_with_message($page_key, false, 'Failed to create uploads directory on server. Check folder permissions.');
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
    redirect_with_message($page_key, false, 'Failed to save the uploaded image to the server disk.');
}

// Database Update with PDO
$db = get_db_connection();
if (!$db) {
    // Delete newly uploaded file if DB connection is lost
    @unlink($destination_path);
    redirect_with_message($page_key, false, 'Database connection failed. Upload canceled.');
}

try {
    // 1. Fetch current file path to clean up old uploaded image
    $check_stmt = $db->prepare("SELECT file_path FROM site_images WHERE page_key = ? AND image_key = ? LIMIT 1");
    $check_stmt->execute([$page_key, $image_key]);
    $old_record = $check_stmt->fetch();
    $old_file_path = $old_record['file_path'] ?? '';

    // 2. Insert or update the new image path
    $driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
    if ($driver === 'pgsql') {
        $upsert_stmt = $db->prepare("
            INSERT INTO site_images (page_key, image_key, file_path, alt_text)
            VALUES (:page_key, :image_key, :file_path, :alt_text)
            ON CONFLICT (page_key, image_key)
            DO UPDATE SET 
                file_path = EXCLUDED.file_path,
                alt_text = EXCLUDED.alt_text,
                updated_at = CURRENT_TIMESTAMP
        ");
    } else {
        $upsert_stmt = $db->prepare("
            INSERT INTO site_images (page_key, image_key, file_path, alt_text)
            VALUES (:page_key, :image_key, :file_path, :alt_text)
            ON DUPLICATE KEY UPDATE 
                file_path = VALUES(file_path),
                alt_text = VALUES(alt_text),
                updated_at = CURRENT_TIMESTAMP
        ");
    }

    $upsert_stmt->execute([
        ':page_key'   => $page_key,
        ':image_key'  => $image_key,
        ':file_path'  => $relative_db_path,
        ':alt_text'   => $alt_text
    ]);

    // 3. Delete old file ONLY if it was located in uploads/ (protect original assets/ directory)
    if (!empty($old_file_path) && strpos($old_file_path, 'uploads/') === 0) {
        $old_disk_file = __DIR__ . '/../' . $old_file_path;
        if (file_exists($old_disk_file) && is_file($old_disk_file)) {
            @unlink($old_disk_file);
        }
    }

    redirect_with_message($page_key, true, "Image [{$image_key}] uploaded and replaced successfully!");
} catch (PDOException $e) {
    // If DB fails, remove newly moved file to prevent orphaned images
    @unlink($destination_path);
    error_log("Failed to update site_images: " . $e->getMessage());
    redirect_with_message($page_key, false, "Database error: " . $e->getMessage());
}
