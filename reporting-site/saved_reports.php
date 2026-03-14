<?php
include 'auth_check.php';
$config = require __DIR__ . '/../../db_config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4",
        $config['user'],
        $config['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->query("
        SELECT r.id, r.title, r.section, r.analyst_comment, r.created_at,
               u.username as author
        FROM reports r
        LEFT JOIN users u ON r.created_by = u.id
        ORDER BY r.created_at DESC
    ");
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Reports - Analytics</title>
    <noscript><style>.js-only { display: none; }</style></noscript>
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
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user { font-size: 0.875rem; color: var(--muted); }
        .nav-user strong { color: var(--text); }
        .btn-logout { color: #ef4444; text-decoration: none; font-size: 0.875rem; font-weight: 500; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 700; }
        .page-header p { color: var(--muted); margin-top: 0.25rem; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge-static { background: #1e3a5f; color: #60a5fa; }
        .badge-behavioral { background: #1a3a2a; color: #34d399; }
        .badge-performance { background: #3a2a10; color: #fbbf24; }
        .report-card {
            background: var(--card);
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .report-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .report-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.35rem; }
        .report-meta { font-size: 0.8rem; color: var(--muted); }
        .report-comment {
            background: var(--bg);
            border-left: 4px solid var(--accent);
            padding: 1rem 1.25rem;
            border-radius: 4px;
            font-size: 0.9rem;
            line-height: 1.6;
            color: #cbd5e1;
            white-space: pre-wrap;
        }
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--muted);
        }
        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; }
        .empty-state h2 { font-size: 1.25rem; color: var(--text); margin-bottom: 0.5rem; }
        .noscript-warning {
            background: #422006;
            border: 1px solid #d97706;
            color: #fcd34d;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
<nav>
    <div class="nav-links">
        <?php if ($role !== 'viewer'): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="grid.php">Data Grid</a>
            <a href="charts.php">Reporting</a>
        <?php endif; ?>
        <a href="saved_reports.php" style="color: var(--accent);">Saved Reports</a>
    </div>
    <div class="nav-right">
        <span class="nav-user">Signed in as <strong><?php echo htmlspecialchars($username); ?></strong></span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</nav>

<div class="container">
    <noscript>
        <div class="noscript-warning">JavaScript is disabled. This page works without it.</div>
    </noscript>

    <div class="page-header">
        <h1>Saved Reports</h1>
        <p>Analyst-authored reports available for viewing.</p>
    </div>

    <?php if (empty($reports)): ?>
        <div class="empty-state">
            <div class="icon">📋</div>
            <h2>No reports yet</h2>
            <p>Analysts haven't saved any reports yet. Check back later.</p>
        </div>
    <?php else: ?>
        <?php foreach ($reports as $r): ?>
        <div class="report-card">
            <div class="report-card-header">
                <div>
                    <div class="report-title"><?php echo htmlspecialchars($r['title']); ?></div>
                    <div class="report-meta">
                        By <strong><?php echo htmlspecialchars($r['author'] ?? 'Unknown'); ?></strong>
                        &middot; <?php echo date('M j, Y g:i A', strtotime($r['created_at'])); ?>
                    </div>
                </div>
                <span class="badge badge-<?php echo htmlspecialchars($r['section']); ?>">
                    <?php echo htmlspecialchars(ucfirst($r['section'])); ?>
                </span>
            </div>
            <?php if (!empty($r['analyst_comment'])): ?>
            <div class="report-comment"><?php echo htmlspecialchars($r['analyst_comment']); ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
