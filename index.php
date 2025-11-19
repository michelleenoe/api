<?php
require __DIR__ . "/routes/index.php";

$allowed_origins = [
    "http://localhost",
    "http://127.0.0.1:5500",
    "http://127.0.0.1:5173",
    "http://localhost:5173",
    "https://michelleenoe.com",
    "https://www.michelleenoe.com"
];

if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}
require_once __DIR__ . "/db.php";

$path   = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

$path = rtrim($path, "/");

if ($path === "/login" && $method === "POST") {
    require __DIR__ . "/routes/login.php";
    exit;
}

if ($path === "/users" && $method === "GET") {
    require __DIR__ . "/routes/users.php";
    exit;
}

if ($path === "/posts" && $method === "GET") {
    require __DIR__ . "/routes/posts.php";
    exit;
}

if ($path === "/person" && $method === "GET") {
    require __DIR__ . "/routes/person.php";
    exit;
}

if ($path === "/swagger" && $method === "GET") {
    require __DIR__ . "/swagger.php";
    exit;
}

http_response_code(404);
echo json_encode(["error" => "Not found"]);
exit;