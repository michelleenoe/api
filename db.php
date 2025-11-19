<?php

$url = getenv("DATABASE_URL");
$parts = parse_url($url);

$host = $parts["host"];
$port = $parts["port"];
$user = $parts["user"];
$pass = $parts["pass"];
$dbname = ltrim($parts["path"], "/");

$db = new PDO(
    "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4",
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);