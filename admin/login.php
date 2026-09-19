<?php
/**
 * Superuser Admin Login Page
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Provides a secure, responsive login interface protected with CSRF tokens,
 * bcrypt validation, and progressive brute-force rate-limiting.
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';

// If user is already authenticated, direct to dashboard immediately
if (is_logged_in()) {
    header("Location: dashboard.php");
    exit;
}

$error_message = '';
$success_message = '';

if (isset($_GET['logged_out'])) {
    $success_message = 'You have been safely logged out.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted_token = $_POST['csrf_token'] ?? '';
    
    // Validate CSRF token
    if (!verify_csrf_token($submitted_token)) {
        $error_message = 'Security validation failed (Invalid or expired CSRF token). Please refresh and try again.';
    } else {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $login_result = attempt_login($username, $password);
        
        if ($login_result['success']) {
            $ref = $_GET['ref'] ?? 'dashboard.php';
            // Sanitize redirect target to avoid open redirect vulnerabilities
            if (empty($ref) || strpos($ref, 'http') === 0 || strpos($ref, '//') === 0) {
                $ref = 'dashboard.php';
            }
            header("Location: " . $ref);
            exit;
        } else {
            $error_message = $login_result['error'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Superuser Admin Login | Sun Rise Sr. Sec. School</title>
    
    <!-- Google Fonts & Material Symbols Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    
    <!-- Tailwind CSS CDN -->
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
                        sans: ['"Inter"', 'sans-serif'],
                        serif: ['"Poppins"', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#001129] font-sans min-h-screen flex items-center justify-center p-4 sm:p-6 selection:bg-[#C9A24B] selection:text-[#001129]">

    <!-- Background Decorative Lighting -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-40">
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-[#C9A24B]/20 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl"></div>
    </div>

    <!-- Login Container Card -->
    <div class="relative z-10 w-full max-w-md bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 p-8 sm:p-10">
        
        <!-- School Brand Header -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-[#001129] flex items-center justify-center text-[#C9A24B] shadow-lg mb-4 ring-4 ring-[#C9A24B]/20">
                <span class="material-symbols-outlined text-3xl">admin_panel_settings</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-[#001129] tracking-tight">Superuser Portal</h1>
            <p class="text-xs sm:text-sm text-gray-600 mt-1 font-medium">Sun Rise Sr. Sec. School, Dobhi</p>
            <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#C9A24B]/15 text-[#8c6b1e] text-[11px] font-bold uppercase tracking-wider">
                <span class="material-symbols-outlined text-[14px]">lock</span>
                Content Management System
            </div>
        </div>

        <!-- Alert Feedback Messages -->
        <?php if (!empty($error_message)): ?>
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-red-500 mt-0.5 text-xl flex-shrink-0">error</span>
                <span class="leading-relaxed"><?= htmlspecialchars($error_message) ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                <span><?= htmlspecialchars($success_message) ?></span>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="" class="space-y-5" autocomplete="off">
            <!-- CSRF Protection Field -->
            <?= csrf_field() ?>

            <!-- Username Field -->
            <div>
                <label for="username" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                    Username or Admin ID
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <span class="material-symbols-outlined text-xl">person</span>
                    </span>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required 
                        autofocus
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        placeholder="e.g. admin"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] focus:bg-white outline-none transition"
                    />
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <span class="material-symbols-outlined text-xl">key</span>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="••••••••••••"
                        class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-[#C9A24B] focus:border-[#C9A24B] focus:bg-white outline-none transition"
                    />
                    <button 
                        type="button" 
                        id="toggle-password" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-700 focus:outline-none"
                    >
                        <span class="material-symbols-outlined text-xl" id="eye-icon">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 bg-[#001129] hover:bg-[#071f45] text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 group text-sm"
            >
                <span>Authenticate &amp; Enter CMS</span>
                <span class="material-symbols-outlined text-lg text-[#C9A24B] group-hover:translate-x-1 transition-transform">login</span>
            </button>
        </form>

        <!-- Footer / Return Links -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between text-xs text-gray-500">
            <a href="../index.php" class="hover:text-[#001129] flex items-center gap-1 transition">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Back to Website</span>
            </a>
            <span class="text-gray-400">Secure TLS &bull; Bcrypt</span>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        const toggleBtn = document.getElementById('toggle-password');
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (toggleBtn && passInput && eyeIcon) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passInput.type === 'password';
                passInput.type = isPassword ? 'text' : 'password';
                eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
            });
        }
    </script>
</body>
</html>
