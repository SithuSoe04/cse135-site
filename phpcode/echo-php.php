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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response["echo_data"] = $_GET;
} else {
    $input = file_get_contents('php://input');
    $decoded = json_decode($input, true);
    
    if ($decoded) {
        $response["echo_data"] = $decoded;
    } else {
        $response["echo_data"] = $_POST;
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);