<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

// Viewers can only access saved_reports.php — redirect them away from everything else
if ($_SESSION['role'] === 'viewer') {
    $allowed = ['saved_reports.php'];
    $current = basename($_SERVER['PHP_SELF']);
    if (!in_array($current, $allowed)) {
        header("Location: saved_reports.php");
        exit;
    }
}
