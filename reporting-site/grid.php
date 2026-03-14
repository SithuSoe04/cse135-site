<?php
include 'auth_check.php';
$config = require __DIR__ . '/../../db_config.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
    $stmt = $pdo->query("SELECT * FROM logs ORDER BY created_at DESC");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Grid - Analytics</title>
    <style>
        :root { --bg: #0f172a; --card: #1e293b; --accent: #3b82f6; --text: #f1f5f9; --muted: #94a3b8; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        nav {
            background: var(--card);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #334155;
        }
        .nav-links a { color: var(--muted); text-decoration: none; margin-right: 25px; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: var(--accent); }
        .nav-links a.active { color: var(--accent); }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user { font-size: 0.875rem; color: var(--muted); }
        .nav-user strong { color: var(--text); }
        .btn-logout { color: #ef4444; text-decoration: none; font-size: 0.875rem; font-weight: 500; }
        .container { max-width: 1400px; margin: 40px auto; padding: 0 20px; }
        h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.25rem; }
        .sub { color: var(--muted); margin-bottom: 1.5rem; }
        table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 10px; overflow: hidden; border: 1px solid #334155; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #334155; text-align: left; font-size: 0.875rem; }
        th { background: #1e293b; color: var(--muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.05em; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #243044; }
        .payload-cell { max-width: 400px; font-family: monospace; font-size: 0.75rem; color: #94a3b8; }
        .payload-cell pre { white-space: pre-wrap; word-break: break-all; margin: 0; }
        .event-badge {
            display: inline-block; padding: 0.15rem 0.5rem; border-radius: 9999px;
            font-size: 0.7rem; font-weight: 600; text-transform: uppercase;
        }
        .badge-activity    { background: #1a3a2a; color: #34d399; }
        .badge-performance { background: #3a2a10; color: #fbbf24; }
        .badge-static      { background: #1e3a5f; color: #60a5fa; }
    </style>
</head>
<body>
<nav>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="grid.php" class="active">Data Grid</a>
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
    <h1>Raw Data Logs</h1>
    <p class="sub">Displaying all <?php echo count($logs); ?> collected analytics events.</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Type</th>
                <th>Session ID</th>
                <th>Page</th>
                <th>Payload (JSON)</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?php echo htmlspecialchars($log['id']); ?></td>
                <td>
                    <span class="event-badge badge-<?php echo htmlspecialchars($log['event_type']); ?>">
                        <?php echo htmlspecialchars($log['event_type']); ?>
                    </span>
                </td>
                <td><?php echo htmlspecialchars(substr($log['session_id'], 0, 8)) . '...'; ?></td>
                <td><?php echo htmlspecialchars($log['page_url']); ?></td>
                <td class="payload-cell">
                    <pre><?php
                        $json = json_decode($log['payload'], true);
                        echo htmlspecialchars($json
                            ? json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                            : $log['payload']);
                    ?></pre>
                </td>
                <td><?php echo htmlspecialchars($log['created_at']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
