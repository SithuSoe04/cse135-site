<?php 
include 'auth_check.php'; 
$config = require __DIR__ . '/../../db_config.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
    
    $pageStmt = $pdo->query("SELECT page_url, COUNT(*) as count FROM logs GROUP BY page_url");
    $pageData = $pageStmt->fetchAll(PDO::FETCH_ASSOC);

    $logStmt = $pdo->query("SELECT payload FROM logs");
    $platformCounts = ['Windows' => 0, 'macOS' => 0, 'Linux' => 0, 'Mobile' => 0, 'Other' => 0];
    
    foreach ($logStmt as $row) {
        $payload = json_decode($row['payload'], true);
        $ua = $payload['data']['ua'] ?? $payload['ua'] ?? '';
        if (stripos($ua, 'Win') !== false) $platformCounts['Windows']++;
        elseif (stripos($ua, 'Mac') !== false) $platformCounts['macOS']++;
        elseif (stripos($ua, 'Android') !== false || stripos($ua, 'iPhone') !== false) $platformCounts['Mobile']++;
        elseif (stripos($ua, 'Linux') !== false) $platformCounts['Linux']++;
        else $platformCounts['Other']++;
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Analytics Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f8fafc; }
        nav { background: #1e293b; padding: 1rem; }
        nav a { color: #3b82f6; margin-right: 20px; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; display: flex; flex-wrap: wrap; gap: 20px; }
        .chart-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); width: 45%; min-width: 400px; }
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
        <div class="chart-box">
            <h3>Page Views Distribution</h3>
            <canvas id="pageChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Visitor Platforms</h3>
            <canvas id="platformChart"></canvas>
        </div>
    </div>

    <script>
        // Data from PHP for Page Chart
        const pageLabels = <?php echo json_encode(array_column($pageData, 'page_url')); ?>;
        const pageCounts = <?php echo json_encode(array_column($pageData, 'count')); ?>;

        new Chart(document.getElementById('pageChart'), {
            type: 'bar',
            data: {
                labels: pageLabels,
                datasets: [{ label: 'Visits', data: pageCounts, backgroundColor: '#3b82f6' }]
            }
        });

        const platformLabels = <?php echo json_encode(array_keys($platformCounts)); ?>;
        const platformData = <?php echo json_encode(array_values($platformCounts)); ?>;

        new Chart(document.getElementById('platformChart'), {
            type: 'pie',
            data: {
                labels: platformLabels,
                datasets: [{ data: platformData, backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444', '#94a3b8'] }]
            }
        });
    </script>
</body>
</html>