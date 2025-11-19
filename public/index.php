<?php
header("Content-Type: application/json");

// Normalize route
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = rtrim($route, "/");
if ($route === "" || !$route) { $route = "/"; }

// Root
if ($route === "/") {
    echo json_encode(["status" => "API running"]);
    exit;
}

// Login
if ($route === "/api/login") {
    require __DIR__ . "/../routes/login.php";
    exit;
}

// Fallback
http_response_code(404);
echo json_encode(["error" => "Route not found", "route" => $route]);