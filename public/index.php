<?php
// ---------------------------------------------------------------------------
// CORS
// ---------------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

// ---------------------------------------------------------------------------
// Autoload + ENV
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
}

// ---------------------------------------------------------------------------
// ROUTING
// ---------------------------------------------------------------------------
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, '/');
if ($route === "") $route = "/";

// ---------------------------------------------------------------------------
// SWAGGER UI  (served from /public/swagger/index.html)
// ---------------------------------------------------------------------------
if ($route === "/swagger") {
    header("Content-Type: text/html");
    readfile(__DIR__ . "/swagger/index.html");
    exit;
}

// ---------------------------------------------------------------------------
// SWAGGER OPENAPI SPEC  (served from /public/swagger/openapi.json)
// ---------------------------------------------------------------------------
if ($route === "/openapi.json") {
    header("Content-Type: application/json");
    readfile(__DIR__ . "/swagger/openapi.json");
    exit;
}

// ---------------------------------------------------------------------------
// DATABASE
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../db.php';

// ---------------------------------------------------------------------------
// ROOT
// ---------------------------------------------------------------------------
if ($route === "/") {
    echo json_encode([
        "status" => "API running",
        "service" => "Forward API",
        "message" => "Operational baseline OK"
    ]);
    exit;
}

// ---------------------------------------------------------------------------
// API ROOT
// ---------------------------------------------------------------------------
if ($route === "/api") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

// ---------------------------------------------------------------------------
// USERS ENDPOINT
// ---------------------------------------------------------------------------
if ($route === "/api/users") {
    require __DIR__ . "/../routes/users.php";
    exit;
}

// ---------------------------------------------------------------------------
// 404 HANDLER
// ---------------------------------------------------------------------------
http_response_code(404);
echo json_encode([
    "error" => "Route not found",
    "route" => $route
]);
exit;