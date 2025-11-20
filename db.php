<?php
require_once __DIR__ . "/vendor/autoload.php";

// Load .env only in local development
if (file_exists(__DIR__ . "/.env")) {
    Dotenv\Dotenv::createImmutable(__DIR__)->load();
}

// Railway uses true environment variables (not .env)
$host = $_ENV["DB_HOST"]       ?? getenv("DB_HOST")       ?? null;
$port = $_ENV["DB_PORT"]       ?? getenv("DB_PORT")       ?? null;
$name = $_ENV["DB_NAME"]       ?? getenv("DB_NAME")       ?? null;
$user = $_ENV["DB_USER"]       ?? getenv("DB_USER")       ?? null;
$pass = $_ENV["DB_PASSWORD"]   ?? getenv("DB_PASSWORD")   ?? null;

// Construct DSN
$dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}