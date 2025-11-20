<?php
header("Content-Type: application/json");

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Preflight
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db.php';

// Load .env only if it exists (local)
if (file_exists(__DIR__ . '/../.env')) {
    Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
}

// Normalize route
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, '/');
if ($route === "") $route = "/";


/* ---------- SWAGGER UI ---------- */
if ($route === "/swagger") {
    header("Content-Type: text/html");
    readfile(__DIR__ . "/swagger/index.html");
    exit;
}

/* ---------- OPENAPI SPEC ---------- */
if ($route === "/openapi.json") {
    header("Content-Type: application/json");
    require __DIR__ . "/../swagger.php";
    exit;
}


/* ---------- ROOT ---------- */
if ($route === "/") {
    echo json_encode([
        "status" => "API running",
        "message" => "Root OK"
    ]);
    exit;
}

/* ---------- API ROOT ---------- */
if ($route === "/api") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

/* ---------- LOGIN ---------- */
if ($route === "/api/login" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "/../routes/login.php";
    exit;
}

/* ---------- USERS ---------- */
if ($route === "/api/users") {
    require __DIR__ . "/../routes/users.php";
    exit;
}

/* ---------- 404 ---------- */
http_response_code(404);
echo json_encode([
    "error" => "Route not found",
    "route" => $route
]);
exit;