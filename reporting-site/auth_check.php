<?php
session_start();

// 1. Unauthenticated Case
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? 'guest';

// 2. Role-Based Access Control (RBAC)
if ($role === 'viewer') {
    // Viewers are strictly locked to saved_reports.php
    $allowed = ['saved_reports.php', 'logout.php'];
    if (!in_array($current_page, $allowed)) {
        header('HTTP/1.1 403 Forbidden');
        include '403.php';
        exit;
    }
} 

elseif ($role === 'analyst') {
    // Analysts can access reports but NEVER the raw Data Grid
    $forbidden = ['grid.php'];
    if (in_array($current_page, $forbidden)) {
        header('HTTP/1.1 403 Forbidden');
        include '403.php';
        exit;
    }
}

// 3. Admin Check for Grid
if ($current_page === 'grid.php' && $role !== 'super_admin') {
    header('HTTP/1.1 403 Forbidden');
    include '403.php';
    exit;
}
?>