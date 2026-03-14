<?php
include 'auth_check.php';

// Only super_admin can access this page
if ($_SESSION['role'] !== 'super_admin') {
    http_response_code(403);
    include '403.php';
    exit;
}

$config = require __DIR__ . '/../../db_config.php';
$msg = '';
$msgType = '';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4",
        $config['user'], $config['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Handle actions
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $uname    = trim($_POST['username'] ?? '');
        $pass     = $_POST['password'] ?? '';
        $role     = $_POST['role'] ?? '';
        $sections = $_POST['sections'] ?? [];
        $validRoles = ['super_admin', 'analyst', 'viewer'];

        if ($uname === '' || $pass === '' || !in_array($role, $validRoles)) {
            $msg = 'Username, password, and a valid role are required.';
            $msgType = 'error';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $allowedSections = ($role === 'analyst' && !empty($sections))
                ? json_encode(array_values($sections))
                : null;
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role, allowed_sections) VALUES (?, ?, ?, ?)");
            $stmt->execute([$uname, $hash, $role, $allowedSections]);
            $msg = "User '{$uname}' added successfully.";
            $msgType = 'success';
        }
    }

    if ($action === 'delete') {
        $uid = (int)($_POST['user_id'] ?? 0);
        if ($uid === $_SESSION['user_id']) {
            $msg = 'You cannot delete your own account.';
            $msgType = 'error';
        } elseif ($uid > 0) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$uid]);
            $msg = 'User deleted.';
            $msgType = 'success';
        }
    }

    if ($action === 'update_sections') {
        $uid      = (int)($_POST['user_id'] ?? 0);
        $sections = $_POST['sections'] ?? [];
        $allowedSections = !empty($sections) ? json_encode(array_values($sections)) : null;
        $stmt = $pdo->prepare("UPDATE users SET allowed_sections = ? WHERE id = ? AND role = 'analyst'");
        $stmt->execute([$allowedSections, $uid]);
        $msg = 'Sections updated.';
        $msgType = 'success';
    }

    // Fetch all users
    $users = $pdo->query("SELECT id, username, role, allowed_sections FROM users ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Analytics</title>
    <style>
        :root { --bg: #0f172a; --card: #1e293b; --accent: #3b82f6; --text: #f1f5f9; --muted: #94a3b8; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        nav { background: var(--card); padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155; }
        .nav-links a { color: var(--muted); text-decoration: none; margin-right: 25px; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--accent); }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        .nav-user { font-size: 0.875rem; color: var(--muted); }
        .nav-user strong { color: var(--text); }
        .btn-logout { color: #ef4444; text-decoration: none; font-size: 0.875rem; font-weight: 500; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.25rem; }
        .page-sub { color: var(--muted); margin-bottom: 2rem; }
        .card { background: var(--card); border: 1px solid #334155; border-radius: 12px; padding: 1.75rem; margin-bottom: 2rem; }
        .card h2 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1.25rem; color: var(--accent); }
        .form-row { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1rem; }
        .form-group { display: flex; flex-direction: column; gap: 0.35rem; flex: 1; min-width: 150px; }
        label { font-size: 0.8rem; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        input[type="text"], input[type="password"], select {
            background: var(--bg); border: 1px solid #334155; border-radius: 6px;
            color: var(--text); padding: 0.6rem 0.875rem; font-size: 0.9rem;
        }
        input:focus, select:focus { outline: none; border-color: var(--accent); }
        .sections-group { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem; }
        .sections-group label { text-transform: none; font-size: 0.875rem; color: var(--text); display: flex; align-items: center; gap: 0.4rem; cursor: pointer; }
        .btn { padding: 0.6rem 1.25rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem; transition: background 0.2s; }
        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: #2563eb; }
        .btn-danger { background: #dc2626; color: white; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #334155; font-size: 0.9rem; }
        th { color: var(--muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; }
        .badge-super_admin { background: #4c1d95; color: #c4b5fd; }
        .badge-analyst { background: #1e3a5f; color: #60a5fa; }
        .badge-viewer { background: #1a3a2a; color: #34d399; }
        .alert { padding: 0.75rem 1rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .alert-success { background: #052e16; border: 1px solid #16a34a; color: #86efac; }
        .alert-error { background: #450a0a; border: 1px solid #dc2626; color: #fca5a5; }
        .sections-inline { font-size: 0.8rem; color: var(--muted); }
        #sections-row { display: none; }
    </style>
</head>
<body>
<nav>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="grid.php">Data Grid</a>
        <a href="charts.php">Reporting</a>
        <a href="saved_reports.php">Saved Reports</a>
        <a href="users.php" class="active">Users</a>
    </div>
    <div class="nav-right">
        <span class="nav-user">Signed in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</nav>

<div class="container">
    <h1>User Management</h1>
    <p class="page-sub">Manage accounts and access levels.</p>

    <?php if ($msg): ?>
        <div class="alert alert-<?php echo $msgType; ?>"><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <!-- Add User -->
    <div class="card">
        <h2>Add New User</h2>
        <form method="POST" action="users.php">
            <input type="hidden" name="action" value="add">
            <div class="form-row">
                <div class="form-group">
                    <label for="new-username">Username</label>
                    <input type="text" id="new-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Password</label>
                    <input type="password" id="new-password" name="password" required>
                </div>
                <div class="form-group" style="max-width: 180px;">
                    <label for="new-role">Role</label>
                    <select id="new-role" name="role" required onchange="toggleSections(this.value)">
                        <option value="">-- Select --</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="analyst">Analyst</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
            </div>
            <div id="sections-row" style="margin-bottom: 1rem;">
                <label>Allowed Sections</label>
                <div class="sections-group">
                    <label><input type="checkbox" name="sections[]" value="static"> Demographic (Static)</label>
                    <label><input type="checkbox" name="sections[]" value="behavioral"> Behavioral</label>
                    <label><input type="checkbox" name="sections[]" value="performance"> Performance</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <!-- User List -->
    <div class="card">
        <h2>All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Allowed Sections</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['username']); ?></td>
                    <td><span class="badge badge-<?php echo $u['role']; ?>"><?php echo str_replace('_', ' ', $u['role']); ?></span></td>
                    <td class="sections-inline">
                        <?php
                        if ($u['role'] === 'super_admin') echo '<em>All</em>';
                        elseif ($u['allowed_sections']) echo implode(', ', json_decode($u['allowed_sections'], true));
                        else echo '<em>None</em>';
                        ?>
                    </td>
                    <td>
                        <?php if ($u['id'] !== $_SESSION['user_id']): ?>
                        <form method="POST" action="users.php" style="display:inline"
                              onsubmit="return confirm('Delete user <?php echo htmlspecialchars($u['username']); ?>?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <?php else: ?>
                        <em style="color: var(--muted); font-size: 0.8rem;">You</em>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleSections(role) {
    document.getElementById('sections-row').style.display = role === 'analyst' ? 'block' : 'none';
}
</script>
</body>
</html>
