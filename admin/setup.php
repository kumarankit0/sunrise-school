<?php
/**
 * 1-Click Database Setup & Superuser Installer
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Checks database connectivity, creates tables from schema.sql,
 * and sets up the initial superuser account without manual phpMyAdmin queries.
 */

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/csrf.php';

$step_results = [];
$can_connect = false;
$setup_done = false;
$error = '';

// Test raw MySQL connection
try {
    $raw_dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $raw_pdo = new PDO($raw_dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $can_connect = true;
} catch (PDOException $e) {
    $error = "Cannot connect to MySQL server (" . DB_HOST . "): " . $e->getMessage();
}

// Handle Setup Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $can_connect) {
    $token = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($token)) {
        $error = 'Security check failed. Please refresh.';
    } else {
        $admin_user = trim($_POST['admin_user'] ?? 'admin');
        $admin_pass = $_POST['admin_pass'] ?? 'Admin@12345';

        if (empty($admin_user) || empty($admin_pass)) {
            $error = 'Please provide both admin username and password.';
        } else {
            try {
                // 1. Create Database if not exists
                $raw_pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $step_results[] = "Database `" . DB_NAME . "` checked/created successfully.";

                // Connect to the specific database
                $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);

                // 2. Read schema.sql
                $schema_file = __DIR__ . '/../schema.sql';
                if (!file_exists($schema_file)) {
                    throw new Exception("schema.sql file not found at {$schema_file}");
                }

                $sql = file_get_contents($schema_file);

                // Split statements safely
                $statements = array_filter(array_map('trim', explode(';', $sql)));

                foreach ($statements as $stmt_sql) {
                    if (empty($stmt_sql)) continue;
                    // Skip USE or CREATE DATABASE commands since we handled that
                    if (stripos($stmt_sql, 'CREATE DATABASE') === 0 || stripos($stmt_sql, 'USE ') === 0) {
                        continue;
                    }
                    $db->exec($stmt_sql);
                }
                $step_results[] = "Tables (`admins`, `site_content`, `site_images`) created and seeded.";

                // 3. Create or Update the chosen Admin user with bcrypt hash
                $hash = password_hash($admin_pass, PASSWORD_BCRYPT);
                $adminStmt = $db->prepare("
                    INSERT INTO admins (username, password_hash, failed_attempts, locked_until)
                    VALUES (?, ?, 0, NULL)
                    ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), failed_attempts = 0, locked_until = NULL
                ");
                $adminStmt->execute([$admin_user, $hash]);
                $step_results[] = "Superuser account [{$admin_user}] configured with encrypted bcrypt password.";

                // 4. Ensure uploads directory exists
                $upload_dir = __DIR__ . '/../uploads';
                if (!is_dir($upload_dir)) {
                    @mkdir($upload_dir, 0755, true);
                }
                $step_results[] = "Uploads directory (/uploads/) verified and prepared.";

                $setup_done = true;
            } catch (Exception $ex) {
                $error = "Setup failed: " . $ex->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CMS Database Setup &amp; Verification | Sun Rise School</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center p-6 text-gray-800">
    <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
        
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-[#001129] flex items-center justify-center text-[#C9A24B] shadow-md">
                <span class="material-symbols-outlined text-2xl">database</span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">CMS Database Setup &amp; Diagnostics</h1>
                <p class="text-xs text-gray-500">Sun Rise Sr. Sec. School, Dobhi</p>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-red-500 text-xl flex-shrink-0">error</span>
                <div>
                    <strong>Setup Encountered an Issue:</strong>
                    <p class="mt-1 font-mono text-xs"><?= htmlspecialchars($error) ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($setup_done): ?>
            <div class="mb-6 p-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-3">
                <div class="flex items-center gap-2 text-emerald-700 font-bold">
                    <span class="material-symbols-outlined text-2xl">task_alt</span>
                    <span>Database Initialized Successfully!</span>
                </div>
                <ul class="text-xs space-y-1 pl-7 list-disc text-emerald-800">
                    <?php foreach ($step_results as $res): ?>
                        <li><?= htmlspecialchars($res) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="login.php" class="flex-1 py-3 px-4 bg-[#001129] hover:bg-[#071f45] text-white font-bold text-sm text-center rounded-xl shadow transition flex items-center justify-center gap-2">
                    <span>Proceed to Admin Login</span>
                    <span class="material-symbols-outlined text-base text-[#C9A24B]">arrow_forward</span>
                </a>
                <a href="../index.php" class="py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm text-center rounded-xl transition">
                    View Website
                </a>
            </div>
        <?php else: ?>
            <form method="POST" action="" class="space-y-5">
                <?= csrf_field() ?>

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-xs space-y-2">
                    <div class="font-bold text-gray-700 uppercase tracking-wider text-[11px]">Database Configuration (from includes/db.php):</div>
                    <div class="grid grid-cols-2 gap-2 text-gray-600 font-mono">
                        <div>Host: <strong><?= DB_HOST ?></strong></div>
                        <div>Database: <strong><?= DB_NAME ?></strong></div>
                        <div>User: <strong><?= DB_USER ?></strong></div>
                        <div>Status: <strong class="<?= $can_connect ? 'text-emerald-600' : 'text-red-600' ?>"><?= $can_connect ? 'Connected' : 'Unreachable' ?></strong></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                            Superuser Username
                        </label>
                        <input 
                            type="text" 
                            name="admin_user" 
                            value="admin" 
                            required 
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-[#C9A24B] outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                            Superuser Password
                        </label>
                        <input 
                            type="text" 
                            name="admin_pass" 
                            value="Admin@12345" 
                            required 
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-mono focus:ring-2 focus:ring-[#C9A24B] outline-none"
                        />
                        <p class="text-[11px] text-gray-500 mt-1">Default is set to <code class="font-mono bg-gray-100 px-1 rounded">Admin@12345</code> (you can change it anytime).</p>
                    </div>
                </div>

                <button 
                    type="submit" 
                    <?= !$can_connect ? 'disabled' : '' ?>
                    class="w-full py-3.5 px-4 bg-[#001129] hover:bg-[#071f45] disabled:bg-gray-400 text-white font-bold text-sm rounded-xl shadow transition flex items-center justify-center gap-2"
                >
                    <span class="material-symbols-outlined text-lg text-[#C9A24B]">play_circle</span>
                    <span>Run 1-Click Database Setup &amp; Create Tables</span>
                </button>
            </form>
        <?php endif; ?>

    </div>
</body>
</html>
