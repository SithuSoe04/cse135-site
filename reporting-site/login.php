<?php
session_start();

// Already logged in — redirect based on role
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header("Location: " . ($_SESSION['role'] === 'viewer' ? 'saved_reports.php' : 'dashboard.php'));
    exit;
}

$config = require __DIR__ . '/../../db_config.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Please enter both username and password.";
    } else {
        try {
            $pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4",
                $config['user'],
                $config['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $stmt = $pdo->prepare("SELECT id, username, password_hash, role, allowed_sections FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['authenticated']    = true;
                $_SESSION['user_id']          = $user['id'];
                $_SESSION['username']         = $user['username'];
                $_SESSION['role']             = $user['role'];
                // null allowed_sections = access to all sections
                $_SESSION['allowed_sections'] = $user['allowed_sections']
                    ? json_decode($user['allowed_sections'], true)
                    : null;

                header("Location: " . ($user['role'] === 'viewer' ? 'saved_reports.php' : 'dashboard.php'));
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $error = "Database error. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Analytics Dashboard</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper { width: 100%; max-width: 400px; padding: 1rem; }
        .login-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo h1 { font-size: 1.5rem; font-weight: 700; color: #f8fafc; }
        .logo p { font-size: 0.85rem; color: #94a3b8; margin-top: 0.25rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.875rem; font-weight: 500; color: #cbd5e1; margin-bottom: 0.5rem; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.625rem 0.875rem;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 6px;
            color: #f1f5f9;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
        }
        .error {
            background: #450a0a;
            border: 1px solid #dc2626;
            color: #fca5a5;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
        button[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button[type="submit"]:hover { background: #2563eb; }
        .noscript-warning {
            background: #422006;
            border: 1px solid #d97706;
            color: #fcd34d;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo">
                <h1>Analytics Dashboard</h1>
                <p>Sign in to your account</p>
            </div>

            <noscript>
                <div class="noscript-warning">
                    JavaScript is disabled. Charts will not render, but data tables will still work.
                </div>
            </noscript>

            <?php if ($error): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                           autocomplete="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           autocomplete="current-password" required>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
