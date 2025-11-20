<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
if (file_exists(__DIR__ . '/../.env')) {
    Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
}

// Routing baseline
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, '/');
if ($route === "") $route = "/";

// Swagger UI
if ($route === "/swagger") {
    header("Content-Type: text/html");
    readfile(__DIR__ . "/../swagger/index.html");
    exit;
}

// Swagger JSON spec
if ($route === "/openapi.json") {
    header("Content-Type: application/json");
    readfile(__DIR__ . "/../openapi.json");
    exit;
}

// DB
require_once __DIR__ . '/../db.php';

// Root
if ($route === "/") {
    echo json_encode(["status" => "API running"]);
    exit;
}

// API
if ($route === "/api") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

// Users
if ($route === "/api/users") {
    require __DIR__ . "/../routes/users.php";
    exit;
}

// 404
http_response_code(404);
echo json_encode(["error" => "Route not found", "route" => $route]);
exit;