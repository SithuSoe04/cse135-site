<?php
header('Content-Type: application/json');

$response = [
    "hostname"   => gethostname(),
    "date_time"  => date('Y-m-d H:i:s'),
    "user_agent" => $_SERVER['HTTP_USER_AGENT'],
    "ip_address" => $_SERVER['REMOTE_ADDR'],
    "method"     => $_SERVER['REQUEST_METHOD'],
    "echo_data"  => []
];

// Only process body for POST, PUT, DELETE
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Read raw input
    $input = file_get_contents('php://input');

    // Try to decode as JSON first
    $decoded = json_decode($input, true);

    if ($decoded !== null) {
        $response["echo_data"] = $decoded;
    } else {
        // Try to parse as form-urlencoded
        parse_str($input, $parsed);
        if (!empty($parsed)) {
            $response["echo_data"] = $parsed;
        } else {
            // Fall back to $_POST
            $response["echo_data"] = $_POST;
        }
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);
