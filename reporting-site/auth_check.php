<?php
session_start();
// If the session variable isn't set, redirect them to the login page immediately
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}
?>