<?php
session_start();

// 1. Unauthenticated — send to login
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? '';

// 2. Error pages are always accessible — skip access checks
if (in_array($current_page, ['403.php', '404.php'])) {
    return;
}

// 3. Allowlist per role
$allowed_pages = match($role) {
    'viewer'      => ['saved_reports.php', 'logout.php'],
    'analyst'     => ['dashboard.php', 'reporting.php', 'saved_reports.php', 'logout.php'],
    'super_admin' => ['dashboard.php', 'reporting.php', 'saved_reports.php', 'users.php', 'grid.php', 'logout.php'],
    default       => [],
};

// 4. Access granted — update the last safe page
if (in_array($current_page, $allowed_pages)) {
    $_SESSION['last_safe_page'] = $current_page;
    return;
}

// 5. Access denied — redirect to 403
header("Location: 403.php");
exit;