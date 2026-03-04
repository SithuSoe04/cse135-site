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
<html>
<head>
    <title>Data Grid - Analytics</title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f8fafc; }
        nav { background: #1e293b; padding: 1rem; }
        nav a { color: #3b82f6; margin-right: 20px; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        th { background: #f1f5f9; }
        tr:nth-child(even) { background: #f8fafc; }
        .payload-cell { max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-family: monospace; font-size: 12px; }
    </style>
</head>
<body>
    <nav>
        <a href="dashboard.php">Home</a>
        <a href="grid.php">Data Grid</a>
        <a href="charts.php">Charts</a>
        <a href="logout.php" style="color: #ef4444;">Logout</a>
    </nav>
    <div class="container">
        <h1>Raw Data Logs</h1>
        <p>Displaying all collected analytics from the database.</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                    <td><?php echo htmlspecialchars(substr($log['session_id'], 0, 8)) . '...'; ?></td>
                    <td><?php echo htmlspecialchars($log['page_url']); ?></td>
                    <td class="payload-cell">
                        <pre style="margin:0; font-size: 11px; line-height: 1.2;"><?php 
                            $json = json_decode($log['payload'], true);
                            if ($json) {
                                echo htmlspecialchars(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                            } else {
                                echo htmlspecialchars($log['payload']);
                            }
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