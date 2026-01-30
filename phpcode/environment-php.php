<?php
header('Content-Type: text/plain');

echo "Environment Variables (PHP Version):\n";
echo "------------------------------------\n";

foreach ($_SERVER as $key => $value) {
    echo "$key: $value\n";
}