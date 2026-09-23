<?php
/**
 * Database Connection Configuration (PDO)
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Supports both:
 * 1. Supabase (Cloud PostgreSQL) - Ideal for Render & live hosting
 * 2. MySQL / MariaDB (Local XAMPP)
 *
 * Can be configured via:
 * - Environment Variable: DATABASE_URL (Render dashboard)
 * - Environment Variables: DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_PORT, DB_DRIVER
 * - Or fallback constants defined below
 */

// -----------------------------------------------------------------------------
// Read Connection Parameters (Render Environment Variables or defaults)
// -----------------------------------------------------------------------------
$raw_db_url = getenv('DATABASE_URL') ?: (getenv('SUPABASE_DB_URL') ?: '');

// Sanitize URL if accidental trailing string was pasted
if (!empty($raw_db_url)) {
    $raw_db_url = trim($raw_db_url);
    if (strpos($raw_db_url, '@[') !== false) {
        $raw_db_url = substr($raw_db_url, 0, strpos($raw_db_url, '@['));
    }
}

$is_render = getenv('RENDER') !== false || isset($_SERVER['RENDER']);

if (!empty($raw_db_url)) {
    // Parse DATABASE_URL / SUPABASE_DB_URL (e.g. postgresql://user:pass@host:port/dbname)
    $parsed = parse_url($raw_db_url);
    $driver = (!empty($parsed['scheme']) && (strpos($parsed['scheme'], 'postgres') !== false || strpos($parsed['scheme'], 'pgsql') !== false)) ? 'pgsql' : 'mysql';
    $host   = $parsed['host'] ?? 'localhost';
    $port   = $parsed['port'] ?? ($driver === 'pgsql' ? 6543 : 3306);
    $user   = isset($parsed['user']) ? urldecode($parsed['user']) : '';
    $pass   = isset($parsed['pass']) ? urldecode($parsed['pass']) : '';
    
    // Auto-correct any typo in project reference if old URL was pasted (pos 11 is 'i')
    if (strpos($user, 'dbobrnclzanltjcvsakm') !== false) {
        $user = str_replace('dbobrnclzanltjcvsakm', 'dbobrnclzanitjcvsakm', $user);
    }
    
    $path_clean = isset($parsed['path']) ? ltrim($parsed['path'], '/') : '';
    if (strpos($path_clean, '@') !== false) {
        $path_clean = explode('@', $path_clean)[0];
    }
    if (strpos($path_clean, '?') !== false) {
        $path_clean = explode('?', $path_clean)[0];
    }
    $dbname = !empty($path_clean) ? $path_clean : ($driver === 'pgsql' ? 'postgres' : 'sunrise_school');
} else {
    // Individual Environment Variables (with Render cloud or local XAMPP defaults)
    if ($is_render) {
        // Fallback to verified Supabase credentials on Render if env var isn't set
        $host   = getenv('DB_HOST') ?: 'aws-0-ap-northeast-1.pooler.supabase.com';
        $port   = getenv('DB_PORT') ?: '6543';
        $dbname = getenv('DB_NAME') ?: 'postgres';
        $user   = getenv('DB_USER') ?: 'postgres.dbobrnclzanitjcvsakm';
        $pass   = getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'MHn.R6c!_W*%Re!';
        $driver = 'pgsql';
    } else {
        // Local XAMPP MySQL defaults (use 127.0.0.1 to avoid Windows IPv6 resolution latency)
        $host   = getenv('DB_HOST') ?: '127.0.0.1';
        $port   = getenv('DB_PORT') ?: '';
        $dbname = getenv('DB_NAME') ?: 'sunrise_school';
        $user   = getenv('DB_USER') ?: 'root';
        $pass   = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $driver = getenv('DB_DRIVER') ?: 'mysql';
    }
}

if (!defined('DB_DRIVER')) define('DB_DRIVER', $driver);
if (!defined('DB_HOST'))   define('DB_HOST', $host);
if (!defined('DB_PORT'))   define('DB_PORT', $port ?: ($driver === 'pgsql' ? 6543 : 3306));
if (!defined('DB_NAME'))   define('DB_NAME', $dbname);
if (!defined('DB_USER'))   define('DB_USER', $user);
if (!defined('DB_PASS'))   define('DB_PASS', $pass);
if (!defined('DB_CHARSET'))define('DB_CHARSET', 'utf8mb4');

/**
 * Returns the active PDO database connection instance (Singleton pattern)
 *
 * @return PDO|null
 */
function get_db_connection() {
    static $pdo = null;
    static $connection_attempted = false;

    if ($connection_attempted) {
        return $pdo;
    }

    $connection_attempted = true;

    if (DB_DRIVER === 'pgsql') {
        // Supabase / PostgreSQL DSN (requires SSL)
        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";sslmode=require";
    } else {
        // MySQL DSN
        $port_str = !empty(DB_PORT) ? ";port=" . DB_PORT : "";
        $dsn = "mysql:host=" . DB_HOST . $port_str . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    }

    $options = [
        // Throw PDOException on errors so they can be handled cleanly
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        // Return query results as associative arrays by default
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Emulate prepares on for PgBouncer pooler compatibility
        PDO::ATTR_EMULATE_PREPARES   => (DB_DRIVER === 'pgsql') ? true : false,
        PDO::ATTR_PERSISTENT         => false,
        PDO::ATTR_TIMEOUT            => (DB_DRIVER === 'pgsql') ? 5 : 1,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // If local MySQL server is offline or unreachable, seamlessly fallback to Supabase cloud database!
        if (DB_DRIVER !== 'pgsql') {
            try {
                $cloud_dsn  = "pgsql:host=aws-0-ap-northeast-1.pooler.supabase.com;port=6543;dbname=postgres;sslmode=require";
                $cloud_user = "postgres.dbobrnclzanitjcvsakm";
                $cloud_pass = "MHn.R6c!_W*%Re!";
                $cloud_opts = $options;
                $cloud_opts[PDO::ATTR_EMULATE_PREPARES] = true;
                $pdo = new PDO($cloud_dsn, $cloud_user, $cloud_pass, $cloud_opts);
                return $pdo;
            } catch (PDOException $ex2) {
                error_log("Supabase fallback connection error: " . $ex2->getMessage());
            }
        }
        $GLOBALS['db_last_error'] = $e->getMessage();
        error_log("Database connection error (" . DB_DRIVER . "): " . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}
