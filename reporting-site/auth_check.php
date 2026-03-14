<?php
session_start();

// 1. Unauthenticated Case: Redirect to Login
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);

// 2. Role-Based Access Control (Server-Side Enforcement)
if ($_SESSION['role'] === 'viewer') {
    // Viewers are strictly locked to saved_reports.php
    $allowed = ['saved_reports.php'];
    if (!in_array($current_page, $allowed)) {
        // Explicit 403 response before redirecting
        header('HTTP/1.1 403 Forbidden');
        header("Location: saved_reports.php?error=forbidden");
        exit;
    }
} 

elseif ($_SESSION['role'] === 'analyst') {
    // Analysts can access charts but NOT the raw Data Grid (grid.php)
    $forbidden = ['grid.php'];
    if (in_array($current_page, $forbidden)) {
        header('HTTP/1.1 403 Forbidden');
        // We use die() here to demonstrate server-side control in unexpected cases
        die("<div style='font-family:sans-serif; text-align:center; padding-top:100px;'>
                <h1>403 Forbidden</h1>
                <p>Security Policy Violation: Analysts are restricted from raw data entry/grid views.</p>
                <a href='charts.php'>Return to Reports</a>
             </div>");
    }
}

?>