<?php
/**
 * Sun Rise Sr. Sec. School - Dobhi
 * Vercel Serverless Function Entrypoint & Front-Controller Router
 */

// Retrieve normalized request URI path
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$parsed_path = parse_url($request_uri, PHP_URL_PATH) ?: '/';
$path = rawurldecode($parsed_path);
$path = '/' . ltrim($path, '/');

// Base directory (project root is parent of api/)
$root = dirname(__DIR__);

// Set current working directory to project root so all relative paths & requires work identically to Apache/Nginx
chdir($root);

// 1. Root Homepage Request
if ($path === '/' || $path === '/index.php' || $path === '') {
    require $root . '/index.php';
    exit;
}

// 2. Direct File Match (PHP or Static fallback)
$direct_file = $root . $path;
if (file_exists($direct_file) && is_file($direct_file)) {
    $ext = strtolower(pathinfo($direct_file, PATHINFO_EXTENSION));
    
    // Execute PHP scripts
    if ($ext === 'php') {
        require $direct_file;
        exit;
    }
    
    // Serve static files if Vercel serverless function catches them
    $mimes = [
        'css'   => 'text/css; charset=utf-8',
        'js'    => 'application/javascript; charset=utf-8',
        'json'  => 'application/json; charset=utf-8',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'webp'  => 'image/webp',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'pdf'   => 'application/pdf',
        'txt'   => 'text/plain; charset=utf-8',
        'xml'   => 'application/xml; charset=utf-8',
    ];
    
    $content_type = $mimes[$ext] ?? 'application/octet-stream';
    header('Content-Type: ' . $content_type);
    header('Cache-Control: public, max-age=31536000, immutable');
    header('Content-Length: ' . filesize($direct_file));
    readfile($direct_file);
    exit;
}

// 3. Clean URLs without .php extension (e.g. /about-us -> /about-us.php)
$clean_php = $root . $path . '.php';
if (file_exists($clean_php) && is_file($clean_php)) {
    require $clean_php;
    exit;
}

// 4. Admin Portal Routes (/admin, /admin/)
if ($path === '/admin' || $path === '/admin/') {
    require $root . '/admin/login.php';
    exit;
}

// 5. Clean Admin Sub-routes without .php (e.g. /admin/dashboard -> /admin/dashboard.php)
if (strpos($path, '/admin/') === 0) {
    $admin_sub = substr($path, strlen('/admin/'));
    $admin_target = $root . '/admin/' . $admin_sub . '.php';
    if (file_exists($admin_target) && is_file($admin_target)) {
        require $admin_target;
        exit;
    }
}

// 6. 404 Handler / Fallback
http_response_code(404);
if (file_exists($root . '/404.php')) {
    require $root . '/404.php';
} else {
    require $root . '/index.php';
}
exit;
