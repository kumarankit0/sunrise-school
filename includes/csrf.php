<?php
/**
 * CSRF Protection Helper
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Protects forms from Cross-Site Request Forgery (CSRF) attacks using
 * cryptographically secure random tokens and timing-attack-safe comparison.
 */

// Ensure session is started before accessing session tokens
if (session_status() === PHP_SESSION_NONE) {
    // Configure secure cookie defaults if not already set
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $is_https,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

/**
 * Generates and returns a CSRF token stored in the user's session
 *
 * @return string
 */
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Returns a ready-to-use HTML hidden input field with the CSRF token
 *
 * @return string
 */
function csrf_field() {
    $token = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * Verifies a submitted CSRF token using timing-safe comparison
 *
 * @param string|null $token The token submitted via POST
 * @return bool True if valid, false otherwise
 */
function verify_csrf_token($token) {
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
