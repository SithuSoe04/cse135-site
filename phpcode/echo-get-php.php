<?php
header('Content-Type: application/json');

$response = [
    "hostname"   => gethostname(),
    "date_time"  => date('Y-m-d H:i:s'),
    "user_agent" => $_SERVER['HTTP_USER_AGENT'],
    "ip_address" => $_SERVER['REMOTE_ADDR'],
    "method"     => $_SERVER['REQUEST_METHOD'],
    "echo_data"  => $_GET
];

echo json_encode($response, JSON_PRETTY_PRINT);
