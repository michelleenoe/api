<?php
require_once __DIR__ . "/vendor/autoload.php";

if (file_exists(__DIR__ . "/.env")) {
    Dotenv\Dotenv::createImmutable(__DIR__)->load();
}

$host = $_ENV["DB_HOST"] ?? null;
$port = $_ENV["DB_PORT"] ?? null;
$name = $_ENV["DB_NAME"] ?? null;
$user = $_ENV["DB_USER"] ?? null;
$pass = $_ENV["DB_PASSWORD"] ?? null;

$dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}