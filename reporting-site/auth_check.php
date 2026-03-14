<?php
session_start();

// 1. Unauthenticated Case
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? 'guest';

if ($current_page === '403.php' || $current_page === '404.php') {
    return; 
}

// 2. Viewer Lockdown
if ($role === 'viewer') {
    $viewer_allowed = ['saved_reports.php', 'logout.php'];
    if (!in_array($current_page, $viewer_allowed)) {
        header("Location: 403.php");
        exit;
    }
} 

// 3. Analyst Lockdown
elseif ($role === 'analyst') {
    if ($current_page === 'grid.php') {
        header("Location: 403.php");
        exit;
    }
}

// 4. Admin Check for Grid
if ($current_page === 'grid.php' && $role !== 'super_admin') {
    header("Location: 403.php");
    exit;
}
?>