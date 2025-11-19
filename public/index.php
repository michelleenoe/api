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

// Normalize route
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, "/");
if ($route === "") { $route = "/"; }

// Static root route
if ($route === "/") {
    echo json_encode([
        "status" => "API running",
        "message" => "Root OK"
    ]);
    exit;
}

// /api health
if ($route === "/api") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

// Login
if ($route === "/api/login") {
    require __DIR__ . "/../routes/login.php";
    exit;
}

// Users
if ($route === "/api/users") {
    require __DIR__ . "/../routes/users.php";
    exit;
}

// Posts
if ($route === "/api/posts") {
    require __DIR__ . "/../routes/posts.php";
    exit;
}

// Default 404
http_response_code(404);
echo json_encode(["error" => "Route not found", "route" => $route]);
exit;