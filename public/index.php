<?php
header("Content-Type: application/json");

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Preflight
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/../db.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Health check
if ($path === "/" || $path === "") {
    echo json_encode(["status" => "API running"]);
    exit;
}

// LOGIN
if ($path === "/api/login" && $method === "POST") {
    require __DIR__ . "/../routes/login.php";
    exit;
}

// USERS
if ($path === "/api/users" && $method === "GET") {
    require __DIR__ . "/../routes/users.php";
    exit;
}

http_response_code(404);
echo json_encode([
    "error" => "Route not found",
    "route" => $path
]);
exit;