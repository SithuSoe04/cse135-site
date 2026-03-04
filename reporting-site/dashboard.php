<?php include 'auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Analytics</title>
    <style>
        nav { background: #1e293b; padding: 1rem; margin-bottom: 2rem; }
        nav a { color: #3b82f6; margin-right: 20px; text-decoration: none; font-weight: bold; }
        body { font-family: sans-serif; margin: 0; background: #f8fafc; }
        .container { padding: 20px; }
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
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <p>Select a report from the navigation menu to begin analyzing your collected data.</p>
    </div>
</body>
</html>