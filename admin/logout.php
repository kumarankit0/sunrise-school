<?php
/**
 * Admin Logout Handler
 * Sun Rise Sr. Sec. School, Dobhi - CMS Layer
 *
 * Terminates the authenticated superuser session, wipes cookies,
 * and safely redirects back to the login screen.
 */

require_once __DIR__ . '/../includes/auth.php';

logout();

header("Location: login.php?logged_out=1");
exit;
