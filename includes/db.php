<?php
/**
 * Database Connection Configuration (PDO)
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * This file sets up a secure, reusable PDO database connection to MySQL.
 * Configured with prepared statement emulation disabled for maximum security.
 */

// Define MySQL Database Credentials (adjust if your hosting/XAMPP uses different settings)
define('DB_HOST', 'localhost');
define('DB_NAME', 'sunrise_school');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

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
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    
    $options = [
        // Throw PDOException on errors so they can be handled cleanly
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        // Return query results as associative arrays by default
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Force true prepared statements at the MySQL server level (prevents SQL injection)
        PDO::ATTR_EMULATE_PREPARES   => false,
        // Persistent connections off by default for clean connection cycling
        PDO::ATTR_PERSISTENT         => false,
        // Short timeout in case MySQL is offline
        PDO::ATTR_TIMEOUT            => 2,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Log the error internally without exposing credentials to visitors
        error_log("Database connection error: " . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}
