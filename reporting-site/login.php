<?php
session_start();
$error = "";

$config = require __DIR__ . '/../../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Compare against the hidden config values
    if ($username === $config['dash_user'] && $password === $config['dash_pass']) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Analytics Dashboard</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 100px; background: #0f172a; color: white; }
        .login-card { background: #1e293b; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        input { display: block; margin: 10px 0; padding: 8px; width: 100%; }
        button { width: 100%; padding: 10px; background: #3b82f6; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Analytics Login</h2>
        <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>