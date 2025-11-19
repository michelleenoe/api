<?php
$host = $_ENV["DB_HOST"] ?? getenv("DB_HOST");
$port = $_ENV["DB_PORT"] ?? getenv("DB_PORT");
$db   = $_ENV["DB_DATABASE"] ?? getenv("DB_DATABASE");
$user = $_ENV["DB_USERNAME"] ?? getenv("DB_USERNAME");
$pass = $_ENV["DB_PASSWORD"] ?? getenv("DB_PASSWORD");

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

$db = new PDO(
    $dsn,
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);