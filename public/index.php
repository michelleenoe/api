<?php
header("Content-Type: application/json");

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../db.php';
require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Normalize route
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, '/');
if ($route === "") $route = "/";


/* ---------- STATIC ROOT ---------- */
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