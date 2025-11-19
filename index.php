<?php
header("Content-Type: application/json");

// CORS – Railway frontend må kalde API’et
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// OPTIONS preflight
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/db.php";

$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Base route
if ($path === "/api" && $method === "GET") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

// LOGIN
if ($path === "/api/login" && $method === "POST") {
    require __DIR__ . "/routes/login.php";
    exit;
}

http_response_code(404);
echo json_encode(["error" => "Route not found", "route" => $path]);
exit;