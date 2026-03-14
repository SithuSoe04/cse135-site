<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Check authentication
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? 'guest';

// Prevent loops
if ($current_page === '403.php' || $current_page === '404.php') {
    return;
}

// Helper function for redirect
function deny_access() {
    $from = urlencode($_SERVER['REQUEST_URI']);
    header("Location: 403.php?from=$from");
    exit;
}

// 2. Viewer Lockdown
if ($role === 'viewer') {

    $viewer_allowed = [
        'saved_reports.php',
        'logout.php'
    ];

    if (!in_array($current_page, $viewer_allowed)) {
        deny_access();
    }
}

// 3. Analyst Lockdown
elseif ($role === 'analyst') {

    if ($current_page === 'grid.php') {
        deny_access();
    }
}

// 4. Super Admin only page
if ($current_page === 'grid.php' && $role !== 'super_admin') {
    deny_access();
}