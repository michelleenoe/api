<?php
header("Content-Type: application/json");

require __DIR__ . "/../db.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

if ($path === "/api/login" && $method === "POST") {
    require __DIR__ . "/login.php";
    exit;
}

if ($path === "/api/users" && $method === "GET") {
    require __DIR__ . "/users.php";
    exit;
}

http_response_code(404);
echo json_encode(["error" => "Not found"]);