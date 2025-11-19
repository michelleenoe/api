<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require __DIR__ . "/db.php";

// Normalize route
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, "/");
if ($route === "") { 
    $route = "/"; 
}

// Root
if ($route === "/") {
    echo json_encode(["status" => "API running"]);
    exit;
}

// /api health check
if ($route === "/api") {
    echo json_encode(["status" => "API OK"]);
    exit;
}

// Login
if ($route === "/api/login" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "/routes/login.php";
    exit;
}

// Users
if ($route === "/api/users") {
    require __DIR__ . "/routes/users.php";
    exit;
}

// Default
http_response_code(404);
echo json_encode([
    "error" => "Route not found",
    "route" => $route
]);