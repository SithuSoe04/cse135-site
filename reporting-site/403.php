<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>403 Forbidden | Security Policy</title>

<style>
:root { --bg: #0f172a; --card: #1e293b; --accent: #3b82f6; --err: #ef4444; --text: #f1f5f9; }
body { background: var(--bg); color: var(--text); font-family: 'Inter', system-ui, sans-serif; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;}
.card { background:var(--card); padding:50px; border-radius:16px; border:1px solid #334155; text-align:center; max-width:450px;}
h1 { color:var(--err); font-size:6rem; margin:0;}
.btn { padding:.75rem 1.5rem; background:var(--accent); color:white; border:none; border-radius:6px; cursor:pointer;}
</style>

</head>

<body>

<div class="card">
<h1>403</h1>
<h2>Access Denied</h2>

<p>Your account (<strong><?php echo htmlspecialchars($_SESSION['role'] ?? 'User'); ?></strong>) is not authorized to access this resource.</p>

<button onclick="goBackOrHome()" class="btn">Go Back</button>
</div>

<script>
function goBackOrHome() {
    if (document.referrer) {
        window.history.back();
    } else {
        window.location.href = "logout.php";
    }
}
</script>

</body>
</html>