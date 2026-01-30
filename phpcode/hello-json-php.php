<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Los_Angeles');

$data = [
    "title" => "Hello, PHP!",
    "team" => "Sithu Soe and Phyo Thant",
    "language" => "PHP",
    "time" => date('Y-m-d H:i:s'),
    "ip" => $_SERVER['REMOTE_ADDR']
];

echo json_encode($data, JSON_PRETTY_PRINT);