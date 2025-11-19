<?php
header("Content-Type: application/json");

require __DIR__ . "/db.php";

// Read input (JSON OR form-urlencoded)
$raw = file_get_contents("php://input");

if (strpos($_SERVER["CONTENT_TYPE"] ?? "", "application/json") !== false) {
    $input = json_decode($raw, true);
} else {
    $input = $_POST;
}

$email = $input["e"] ?? null;
$password = $input["p"] ?? null;
var_dump("RAW INPUT:", $input);
var_dump("EMAIL:", $email);
var_dump("PASSWORD:", $password);
exit;

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(["error" => "Missing credentials"]);
    exit;
}

$stmt = $db->prepare("
    SELECT user_pk, user_username, user_email, user_password, user_full_name
    FROM users
    WHERE user_email = :email
");

$stmt->bindValue(":email", strtolower($email));
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user["user_password"])) {
    http_response_code(401);
    echo json_encode(["error" => "Invalid"]);
    exit;
}

unset($user["user_password"]);
echo json_encode($user);
exit;