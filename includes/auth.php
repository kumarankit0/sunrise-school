<?php
/**
 * Authentication & Session Management Module
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Handles superuser authentication, bcrypt password validation,
 * session fixation prevention, and progressive brute-force lockout protection.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/csrf.php';

// Brute-force protection constants
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_DURATION_MINUTES', 15);

/**
 * Checks if the current visitor is authenticated as an admin
 *
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Enforces admin authentication; redirects unauthorized visitors to login.php
 */
function require_login() {
    if (!is_logged_in()) {
        // Save current page URL for return redirection if desired
        $redirect = 'login.php';
        if (!empty($_SERVER['REQUEST_URI'])) {
            $redirect .= '?ref=' . urlencode($_SERVER['REQUEST_URI']);
        }
        header("Location: " . $redirect);
        exit;
    }
}

/**
 * Returns current logged-in administrator information
 *
 * @return array|null
 */
function get_logged_in_user() {
    if (!is_logged_in()) {
        return null;
    }
    return [
        'id'       => $_SESSION['admin_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? 'Superuser'
    ];
}

/**
 * Authenticates a superuser with brute-force rate-limiting
 *
 * @param string $username
 * @param string $password
 * @return array ['success' => bool, 'error' => string|null]
 */
function attempt_login($username, $password) {
    $db = get_db_connection();
    if (!$db) {
        $errMsg = !empty($GLOBALS['db_last_error']) ? $GLOBALS['db_last_error'] : 'Please check includes/db.php configuration.';
        return [
            'success' => false,
            'error'   => 'Database connection failed: ' . $errMsg
        ];
    }

    $username = trim($username);
    if (empty($username) || empty($password)) {
        return [
            'success' => false,
            'error'   => 'Please provide both username and password.'
        ];
    }

    // 1. Check if user exists and whether the account is currently locked
    $stmt = $db->prepare("SELECT id, username, password_hash, failed_attempts, locked_until FROM admins WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin) {
        // Check lockout status
        if (!empty($admin['locked_until'])) {
            $lockTime = strtotime($admin['locked_until']);
            $currentTime = time();
            if ($lockTime > $currentTime) {
                $minutesRemaining = ceil(($lockTime - $currentTime) / 60);
                return [
                    'success' => false,
                    'error'   => "Account is temporarily locked due to too many failed attempts. Try again in {$minutesRemaining} minute(s)."
                ];
            }
        }
    }

    // 2. Validate password with bcrypt
    $password_valid = $admin && password_verify($password, $admin['password_hash']);

    if (!$password_valid) {
        // Delay 1 second to throttle automated brute-force attacks
        usleep(1000000);

        if ($admin) {
            $newAttempts = $admin['failed_attempts'] + 1;
            $lockedUntil = ($newAttempts >= MAX_LOGIN_ATTEMPTS) 
                ? date('Y-m-d H:i:s', time() + (LOCKOUT_DURATION_MINUTES * 60)) 
                : $admin['locked_until'];

            $updateStmt = $db->prepare("UPDATE admins SET failed_attempts = ?, locked_until = ? WHERE id = ?");
            $updateStmt->execute([$newAttempts, $lockedUntil, $admin['id']]);

            if ($newAttempts >= MAX_LOGIN_ATTEMPTS) {
                return [
                    'success' => false,
                    'error'   => "Account has been locked for " . LOCKOUT_DURATION_MINUTES . " minutes due to multiple failed login attempts."
                ];
            }
        }

        return [
            'success' => false,
            'error'   => 'Invalid username or password.'
        ];
    }

    // 3. Successful Login: Reset failed attempts, update last login
    $resetStmt = $db->prepare("UPDATE admins SET failed_attempts = 0, locked_until = NULL, last_login = NOW() WHERE id = ?");
    $resetStmt->execute([$admin['id']]);

    // Regenerate session ID to eradicate session fixation attacks
    session_regenerate_id(true);

    // Populate session
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id']        = $admin['id'];
    $_SESSION['admin_username']  = $admin['username'];
    $_SESSION['login_time']      = time();

    return [
        'success' => true,
        'error'   => null
    ];
}

/**
 * Completely terminates the superuser session and clears cookies
 */
function logout() {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}
