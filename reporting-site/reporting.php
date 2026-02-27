<?php
// reporting.php
header("Content-Type: application/json");

// Reuse the secure config located one level above public_html
$config = require __DIR__ . '/../../db_config.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
    $method = $_SERVER['REQUEST_METHOD'];
    
    // Simple routing logic to grab the ID from the URL if present
    $pathInfo = $_SERVER['PATH_INFO'] ?? '/';
    $pathParts = explode('/', trim($pathInfo, '/'));
    $resource = $pathParts[0] ?? '';
    $id = $pathParts[1] ?? null;

    if ($resource !== 'static') {
        http_response_code(404);
        echo json_encode(["error" => "Resource not found"]);
        exit;
    }

    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM logs WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
            } else {
                $stmt = $pdo->query("SELECT * FROM logs WHERE event_type = 'static'");
                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            }
            break;

        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("INSERT INTO logs (session_id, event_type, page_url, payload) VALUES (?, 'static', ?, ?)");
            $stmt->execute([$input['s_id'], $input['page'], json_encode($input['data'])]);
            echo json_encode(["status" => "Created", "id" => $pdo->lastInsertId()]);
            break;

        case 'PUT':
            if (!$id) exit;
            $input = json_decode(file_get_contents('php://input'), true);
            // Example update logic
            $stmt = $pdo->prepare("UPDATE logs SET payload = ? WHERE id = ?");
            $stmt->execute([json_encode($input['data']), $id]);
            echo json_encode(["status" => "Updated"]);
            break;

        case 'DELETE':
            if (!$id) exit;
            $stmt = $pdo->prepare("DELETE FROM logs WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["status" => "Deleted"]);
            break;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}