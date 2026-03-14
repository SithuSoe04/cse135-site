<?php 
// 1. Authorization & Security
include 'auth_check.php'; 

// Extract permissions from the JSON array in your database
$permissions = $_SESSION['permissions'] ?? [];
$isSuperAdmin = ($_SESSION['role'] === 'super_admin');
$username = $_SESSION['username'] ?? 'User';

$config = require __DIR__ . '/../../db_config.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // --- Category 1: Demographic Data (Database key: 'static') ---
    $logStmt = $pdo->query("SELECT payload FROM logs WHERE event_type = 'static'");
    $platformCounts = ['Windows' => 0, 'macOS' => 0, 'Linux' => 0, 'Mobile' => 0, 'Other' => 0];
    foreach ($logStmt as $row) {
        $payload = json_decode($row['payload'], true);
        $ua = $payload['data']['ua'] ?? $payload['ua'] ?? $payload['data']['user_agent'] ?? '';
        if (stripos($ua, 'Win') !== false) $platformCounts['Windows']++;
        elseif (stripos($ua, 'Mac') !== false) $platformCounts['macOS']++;
        elseif (stripos($ua, 'Android') !== false || stripos($ua, 'iPhone') !== false) $platformCounts['Mobile']++;
        elseif (stripos($ua, 'Linux') !== false) $platformCounts['Linux']++;
        else $platformCounts['Other']++;
    }

    // --- Category 2: Behavioral Data (Database key: 'behavioral') ---
    $pageStmt = $pdo->query("SELECT page_url, COUNT(*) as count FROM logs GROUP BY page_url");
    $pageData = $pageStmt->fetchAll(PDO::FETCH_ASSOC);

    // --- Category 3: Performance Data (Database key: 'performance') ---
    // Filtering by payload content since 'type' is nested in the JSON
    $perfStmt = $pdo->query("SELECT payload FROM logs WHERE payload LIKE '%\"type\":\"performance\"%' LIMIT 100");
    $loadTimes = [];

    foreach ($perfStmt as $row) {
        $p = json_decode($row['payload'], true);
        $t = $p['data']['raw'] ?? null;
        if ($t) {
            // Use domComplete based on your log structure
            $val = $t['domComplete'] ?? $t['domInteractive'] ?? 0;
            if ($val > 0) {
                $loadTimes[] = $val;
            }
        }
    }
    $avgLoad = count($loadTimes) > 0 ? round(array_sum($loadTimes) / count($loadTimes), 2) : "Calculating...";

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Executive Analytics Report | CSE 135</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root { --bg: #0f172a; --card: #1e293b; --accent: #3b82f6; --text: #f1f5f9; --muted: #94a3b8; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); line-height: 1.6; }
        nav { background: var(--card); padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155; }
        nav a { color: var(--muted); text-decoration: none; margin-right: 25px; font-weight: 500; transition: 0.3s; }
        nav a:hover { color: var(--accent); }
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .report-card { background: var(--card); border-radius: 12px; padding: 35px; margin-bottom: 40px; border: 1px solid #334155; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .chart-box { height: 350px; margin: 25px 0; }
        .analyst-box { background: var(--bg); border-left: 5px solid var(--accent); padding: 25px; border-radius: 6px; margin-top: 25px; }
        .analyst-title { color: var(--accent); font-weight: bold; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; display: block; margin-bottom: 10px; }
        .btn-export { background: var(--accent); color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-export:hover { background: #2563eb; transform: translateY(-2px); }
        h1 { font-size: 2.25rem; margin-bottom: 5px; }
        h2 { color: var(--accent); font-size: 1.5rem; margin-bottom: 20px; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        .stat-value { font-size: 3rem; font-weight: 800; color: #10b981; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: var(--bg); border-radius: 8px; overflow: hidden; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #334155; }
        th { background: #1e293b; color: var(--muted); font-size: 0.8rem; }
        
        @media print {
            body { background: #0f172a !important; }
            .report-card { break-inside: avoid; }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="grid.php">Logs Grid</a>
        <a href="charts.php" style="color: var(--accent);">Reporting</a>
    </div>
    <button class="btn-export" onclick="downloadPDF()">Download PDF Report</button>
</nav>

<div class="container" id="printable-content">
    <header style="margin-bottom: 50px;">
        <h1>Presentational Analytics Summary</h1>
        <p style="color: var(--muted);">
            Prepared by: <strong><?php echo htmlspecialchars($username); ?></strong> | 
            Access Level: <strong><?php echo strtoupper($_SESSION['role']); ?></strong> | 
            Date: <?php echo date('F j, Y'); ?>
        </p>
    </header>

    <?php if ($isSuperAdmin || in_array('static', $permissions)): ?>
    <div class="report-card">
        <h2>I. Audience Demographic Profile</h2>
        <div class="chart-box"><canvas id="platformChart"></canvas></div>
        <table>
            <thead><tr><th>Platform</th><th>Session Count</th></tr></thead>
            <tbody>
                <?php foreach($platformCounts as $label => $val): ?>
                <tr><td><?php echo $label; ?></td><td><?php echo $val; ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="analyst-box">
            <span class="analyst-title">Analyst Strategic Insight</span>
            <p>Our data reveals a heavy tilt toward <strong>macOS and high-end mobile devices</strong>. This suggests our primary audience consists of users with premium hardware, likely students within the UCSD ecosystem.</p>
            <p><strong>Recommendation:</strong> Prioritize "Retina" asset optimization and ensure CSS handles macOS's default display scaling gracefully.</p>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($isSuperAdmin || in_array('behavioral', $permissions)): ?>
    <div class="report-card">
        <h2>II. Content Engagement Trends</h2>
        <div class="chart-box"><canvas id="pageChart"></canvas></div>
        <div class="analyst-box">
            <span class="analyst-title">Analyst Strategic Insight</span>
            <p>Traffic distribution indicates a <strong>low depth of navigation</strong> into sub-routes. While the index page captures 100% of the initial 'static' hits, behavioral logs show a significant drop-off before users reach conversion pages.</p>
            <p><strong>Recommendation:</strong> Implement clearer Call-to-Action (CTA) buttons on the landing page to drive deeper funnel engagement.</p>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($isSuperAdmin || in_array('performance', $permissions)): ?>
    <div class="report-card">
        <h2>III. Infrastructure Health Metrics</h2>
        <div class="stat-value"><?php echo $avgLoad; ?> <span style="font-size: 1.2rem; color: var(--muted); font-weight: normal;">ms</span></div>
        <p>Mean System Load Time (DOM Complete Metric)</p>
        <div class="analyst-box">
            <span class="analyst-title">Analyst Strategic Insight</span>
            <p>With a mean load time of <strong><?php echo $avgLoad; ?>ms</strong>, the system is performing well. However, payload decoding reveals latency spikes during peak concurrent sessions.</p>
            <p><strong>Recommendation:</strong> Defer non-critical JavaScript until after the <code>loadEventEnd</code> to maintain this edge.</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    // PRO PDF Export Settings
    function downloadPDF() {
        const element = document.getElementById('printable-content');
        const opt = {
            margin:       10,
            filename:     'Executive_Analytics_Report.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { 
                scale: 2, 
                backgroundColor: '#0f172a',
                useCORS: true 
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }

    // Platform Chart (Doughnut)
    new Chart(document.getElementById('platformChart'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode(array_keys($platformCounts)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($platformCounts)); ?>,
                backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444', '#94a3b8'],
                borderWidth: 0
            }]
        },
        options: { 
            maintainAspectRatio: false,
            plugins: { legend: { position: 'right', labels: { color: '#f1f5f9', font: { size: 14 } } } }
        }
    });

    // Page Chart (Bar)
    new Chart(document.getElementById('pageChart'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_column($pageData, 'page_url')); ?>,
            datasets: [{
                label: 'Sessions',
                data: <?php echo json_encode(array_column($pageData, 'count')); ?>,
                backgroundColor: '#3b82f6',
                borderRadius: 5
            }]
        },
        options: { 
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { ticks: { color: '#94a3b8' }, grid: { color: '#334155' } },
                x: { ticks: { color: '#94a3b8' }, grid: { display: false } }
            }
        }
    });
</script>
</body>
</html>