<?php
header("Access-Control-Allow-Origin: https://test.cse135phyosithu.site");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST, OPTIONS');
    exit;
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($data) {
    // Reference the file outside the public web root
    $config = require __DIR__ . '/../../db_config.php';

    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
        $pdo = new PDO($dsn, $config['user'], $config['pass']);
        
        $stmt = $pdo->prepare("INSERT INTO logs (session_id, event_type, page_url, payload) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['s_id'],
            $data['type'],
            $data['page'],
            $json
        ]);
        
        http_response_code(200);
    } catch (PDOException $e) {
        error_log("Database Connection Failed: " . $e->getMessage());
        http_response_code(500);
    }
}