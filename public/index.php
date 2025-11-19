<?php

require __DIR__ . '/../db.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === '/api/login') {
    require __DIR__ . '/../routes/login.php';
    exit;
}

echo json_encode(['status' => 'ok']);