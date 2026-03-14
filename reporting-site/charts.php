<?php 
// 1. Authorization & Security
include 'auth_check.php'; 

$sections = $_SESSION['allowed_sections'] ?? [];
$isSuperAdmin = ($_SESSION['role'] === 'super_admin');
$isAnalyst = ($_SESSION['role'] === 'analyst');
$username = $_SESSION['username'] ?? 'User';
$saveMsg = '';
$saveMsgType = '';

$config = require __DIR__ . '/../../db_config.php';

// Handle save report form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_report'])) {
    $title   = trim($_POST['title'] ?? '');
    $section = trim($_POST['section'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $validSections = ['static', 'behavioral', 'performance'];

    if ($title === '' || !in_array($section, $validSections)) {
        $saveMsg = 'Please provide a title and valid section.';
        $saveMsgType = 'error';
    } else {
        try {
            $pdo2 = new PDO(
                "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4",
                $config['user'], $config['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $stmt = $pdo2->prepare("INSERT INTO reports (title, section, analyst_comment, created_by) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $section, $comment, $_SESSION['user_id']]);
            $saveMsg = 'Report saved successfully. Viewers can now see it in Saved Reports.';
            $saveMsgType = 'success';
        } catch (PDOException $e) {
            $saveMsg = 'Failed to save report.';
            $saveMsgType = 'error';
        }
    }
}

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

    // --- Category 2: Behavioral Data ---
    $pageStmt = $pdo->query("SELECT page_url, COUNT(*) as count FROM logs GROUP BY page_url");
    $pageData = $pageStmt->fetchAll(PDO::FETCH_ASSOC);

    // --- Category 3: Performance Data ---
    $perfStmt = $pdo->query("SELECT payload FROM logs WHERE payload LIKE '%domComplete%' LIMIT 150");
    $loadTimes = [];

    foreach ($perfStmt as $row) {
        $p = json_decode($row['payload'], true);
        $val = $p['data']['raw']['domComplete'] ?? null;
        
        if ($val !== null && (float)$val > 0) {
            $loadTimes[] = (float)$val;
        }
    }

    $avgLoad = count($loadTimes) > 0 ? round(array_sum($loadTimes) / count($loadTimes), 2) : "Gathering data...";

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
        .nav-right { display: flex; align-items: center; gap: 1rem; flex-shrink: 0; }
        .nav-user { font-size: 0.875rem; color: var(--muted); white-space: nowrap; }
        .nav-user strong { color: var(--text); }
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .report-card { background: var(--card); border-radius: 12px; padding: 35px; margin-bottom: 40px; border: 1px solid #334155; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .chart-box { height: 350px; margin: 25px 0; }
        .analyst-box { background: var(--bg); border-left: 5px solid var(--accent); padding: 25px; border-radius: 6px; margin-top: 25px; }
        .analyst-title { color: var(--accent); font-weight: bold; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em; display: block; margin-bottom: 10px; }
        .btn-export { background: var(--accent); color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-export:hover { background: #2563eb; transform: translateY(-2px); }
        .btn-export:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        h1 { font-size: 2.25rem; margin-bottom: 5px; }
        h2 { color: var(--accent); font-size: 1.5rem; margin-bottom: 20px; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        .stat-value { font-size: 3rem; font-weight: 800; color: #10b981; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: var(--bg); border-radius: 8px; overflow: hidden; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #334155; }
        th { background: #1e293b; color: var(--muted); font-size: 0.8rem; }

        .save-report-section {
            background: var(--card);
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 40px;
        }
        .save-report-section h2 { color: var(--accent); font-size: 1.25rem; margin-bottom: 1.25rem; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        .form-row { display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .form-group { display: flex; flex-direction: column; gap: 0.4rem; flex: 1; min-width: 200px; }
        .form-group label { font-size: 0.8rem; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        .form-group input, .form-group select, .form-group textarea {
            background: var(--bg);
            border: 1px solid #334155;
            border-radius: 6px;
            color: var(--text);
            padding: 0.6rem 0.875rem;
            font-size: 0.95rem;
            font-family: inherit;
        }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: var(--accent); }
        .btn-save { background: #10b981; color: white; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.95rem; transition: background 0.2s; }
        .btn-save:hover { background: #059669; }
        .alert-success { background: #052e16; border: 1px solid #16a34a; color: #86efac; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-error { background: #450a0a; border: 1px solid #dc2626; color: #fca5a5; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.875rem; }

        /* ── PDF / print-friendly white theme ── */
        body.pdf-mode {
            background: #ffffff !important;
            color: #111827 !important;
        }
        body.pdf-mode nav,
        body.pdf-mode .save-report-section {
            display: none !important;
        }
        body.pdf-mode .container {
            margin-top: 0 !important;
        }
        body.pdf-mode .report-card {
            background: #f9fafb !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: none !important;
        }
        body.pdf-mode h1 {
            color: #111827 !important;
        }
        body.pdf-mode h2 {
            color: #1e3a5f !important;
            border-bottom-color: #d1d5db !important;
        }
        body.pdf-mode p,
        body.pdf-mode td,
        body.pdf-mode li {
            color: #374151 !important;
        }
        body.pdf-mode th {
            background: #e5e7eb !important;
            color: #4b5563 !important;
        }
        body.pdf-mode td {
            border-bottom-color: #e5e7eb !important;
        }
        body.pdf-mode table {
            background: #ffffff !important;
        }
        body.pdf-mode .analyst-box {
            background: #eff6ff !important;
            border-left: 5px solid #3b82f6 !important;
        }
        body.pdf-mode .analyst-title {
            color: #1d4ed8 !important;
        }
        body.pdf-mode .analyst-box p {
            color: #1e3a5f !important;
        }
        body.pdf-mode .analyst-box strong {
            color: #111827 !important;
        }
        body.pdf-mode .stat-value {
            color: #059669 !important;
        }
        body.pdf-mode code {
            background: #e5e7eb !important;
            color: #111827 !important;
            padding: 2px 5px;
            border-radius: 4px;
        }
        body.pdf-mode header p,
        body.pdf-mode header p strong {
            color: #6b7280 !important;
        }

        @media print {
            body { background: #ffffff !important; color: #111827 !important; }
            nav, .save-report-section { display: none !important; }
            .report-card { break-inside: avoid; background: #f9fafb !important; border: 1px solid #e5e7eb !important; }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="grid.php">Data Grid</a>
        <a href="charts.php" style="color: var(--accent);">Reporting</a>
        <a href="saved_reports.php">Saved Reports</a>
        <?php if ($_SESSION['role'] === 'super_admin'): ?>
            <a href="users.php">Users</a>
        <?php endif; ?>
    </div>
    <div class="nav-right" style="display:flex;align-items:center;gap:1rem;">
        <span style="font-size:0.875rem;color:var(--muted);">Signed in as <strong style="color:var(--text);"><?php echo htmlspecialchars($username); ?></strong></span>
        <a href="logout.php" style="color:#ef4444;text-decoration:none;font-size:0.875rem;font-weight:500;">Logout</a>
        <button class="btn-export" onclick="downloadPDF()">Download PDF Report</button>
    </div>
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

    <?php if ($isSuperAdmin || $isAnalyst): ?>
    <div class="save-report-section">
        <h2>Save a Report</h2>
        <?php if ($saveMsg): ?>
            <div class="alert-<?php echo $saveMsgType; ?>"><?php echo htmlspecialchars($saveMsg); ?></div>
        <?php endif; ?>
        <form method="POST" action="charts.php">
            <input type="hidden" name="save_report" value="1">
            <div class="form-row">
                <div class="form-group">
                    <label for="report-title">Report Title</label>
                    <input type="text" id="report-title" name="title" placeholder="e.g. Weekly Performance Summary" required>
                </div>
                <div class="form-group" style="max-width: 220px;">
                    <label for="report-section">Section</label>
                    <select id="report-section" name="section" required>
                        <option value="">-- Select --</option>
                        <?php if ($isSuperAdmin || in_array('static', $sections)): ?>
                            <option value="static">Demographic (Static)</option>
                        <?php endif; ?>
                        <?php if ($isSuperAdmin || in_array('behavioral', $sections)): ?>
                            <option value="behavioral">Behavioral</option>
                        <?php endif; ?>
                        <?php if ($isSuperAdmin || in_array('performance', $sections)): ?>
                            <option value="performance">Performance</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="report-comment">Analyst Comment</label>
                <textarea id="report-comment" name="comment" placeholder="Write your interpretation and recommendations here..."></textarea>
            </div>
            <button type="submit" class="btn-save">Save Report</button>
        </form>
    </div>
    <?php endif; ?>

    <?php if ($isSuperAdmin || in_array('static', $sections)): ?>
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

    <?php if ($isSuperAdmin || in_array('behavioral', $sections)): ?>
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

    <?php if ($isSuperAdmin || in_array('performance', $sections)): ?>
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
    // ── Chart instances (named so toDataURL() works at export time) ──
    const platformChart = new Chart(document.getElementById('platformChart'), {
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

    const pageChart = new Chart(document.getElementById('pageChart'), {
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

    // ── PDF Export ──
    function downloadPDF() {
        const btn = document.querySelector('.btn-export');
        btn.textContent = 'Generating…';
        btn.disabled = true;

        // Step 1: snapshot every Chart.js canvas into a static <img>
        // so html2canvas captures the chart pixels reliably
        const canvasSwaps = [];
        document.querySelectorAll('canvas').forEach(canvas => {
            const img = document.createElement('img');
            img.src = canvas.toDataURL('image/png');
            img.style.width  = canvas.offsetWidth  + 'px';
            img.style.height = canvas.offsetHeight + 'px';
            img.style.display = 'block';
            canvas.parentNode.insertBefore(img, canvas);
            canvas.style.display = 'none';
            canvasSwaps.push({ canvas, img });
        });

        // Step 2: switch to the print-friendly white theme
        document.body.classList.add('pdf-mode');

        const element = document.getElementById('printable-content');
        const opt = {
            margin:      [12, 12, 12, 12],
            filename:    'Analytics_Report.pdf',
            image:       { type: 'jpeg', quality: 0.97 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff',
                logging: false
            },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            // Step 3: restore dark theme and live canvases
            document.body.classList.remove('pdf-mode');
            canvasSwaps.forEach(({ canvas, img }) => {
                canvas.style.display = '';
                img.remove();
            });
            btn.textContent = 'Download PDF Report';
            btn.disabled = false;
        });
    }
</script>
</body>
</html>