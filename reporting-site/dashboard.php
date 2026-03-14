<?php include 'auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Analytics</title>
    <style>
        :root { --bg: #0f172a; --card: #1e293b; --accent: #3b82f6; --text: #f1f5f9; --muted: #94a3b8; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        nav { background: var(--card); padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155; }
        .nav-links a { color: var(--muted); text-decoration: none; margin-right: 25px; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: var(--accent); }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user { font-size: 0.875rem; color: var(--muted); }
        .nav-user strong { color: var(--text); }
        .btn-logout { color: #ef4444; text-decoration: none; font-size: 0.875rem; font-weight: 500; }
        .container { max-width: 1000px; margin: 60px auto; padding: 0 20px; }
        .welcome { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .sub { color: var(--muted); margin-bottom: 2.5rem; }
        .cards { display: flex; gap: 1.25rem; flex-wrap: wrap; }
        .quick-card {
            background: var(--card);
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text);
            flex: 1;
            min-width: 180px;
            transition: border-color 0.2s;
        }
        .quick-card:hover { border-color: var(--accent); }
        .quick-card .icon { font-size: 1.75rem; margin-bottom: 0.75rem; }
        .quick-card h3 { font-size: 1rem; font-weight: 600; margin-bottom: 0.25rem; }
        .quick-card p { font-size: 0.825rem; color: var(--muted); }
        .badge-role {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 0.5rem;
            vertical-align: middle;
        }
        .badge-super_admin { background: #4c1d95; color: #c4b5fd; }
        .badge-analyst { background: #1e3a5f; color: #60a5fa; }
    </style>
</head>
<body>
<nav>
    <div class="nav-links">
        <a href="dashboard.php" style="color: var(--accent);">Dashboard</a>
        <a href="grid.php">Data Grid</a>
        <a href="charts.php">Reporting</a>
        <a href="saved_reports.php">Saved Reports</a>
        <?php if ($_SESSION['role'] === 'super_admin'): ?>
            <a href="users.php">Users</a>
        <?php endif; ?>
    </div>
    <div class="nav-right">
        <span class="nav-user">Signed in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
        <span class="badge-role badge-<?php echo $_SESSION['role']; ?>">
            <?php echo str_replace('_', ' ', $_SESSION['role']); ?>
        </span>
    </div>
    <p class="sub">Select a section from the navigation to begin.</p>

    <div class="cards">
        <a href="charts.php" class="quick-card">
            <div class="icon">📊</div>
            <h3>Reporting</h3>
            <p>View analytics charts and export PDF reports.</p>
        </a>
        <a href="grid.php" class="quick-card">
            <div class="icon">🗃️</div>
            <h3>Data Grid</h3>
            <p>Browse raw collected log data.</p>
        </a>
        <a href="saved_reports.php" class="quick-card">
            <div class="icon">📋</div>
            <h3>Saved Reports</h3>
            <p>View analyst-authored saved reports.</p>
        </a>
        <?php if ($_SESSION['role'] === 'super_admin'): ?>
        <a href="users.php" class="quick-card">
            <div class="icon">👥</div>
            <h3>User Management</h3>
            <p>Add, remove, and configure user access.</p>
        </a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
