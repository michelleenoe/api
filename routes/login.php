<?php
$input = json_decode(file_get_contents("php://input"), true);

$email = $input["email"] ?? null;
$password = $input["password"] ?? null;

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(["error" => "missing_credentials"]);
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

if (!$user) {
    http_response_code(401);
    echo json_encode(["error" => "invalid_login"]);
    exit;
}

if (!password_verify($password, $user["user_password"])) {
    http_response_code(401);
    echo json_encode(["error" => "invalid_login"]);
    exit;
}

unset($user["user_password"]);

echo json_encode([
    "success" => true,
    "user" => $user
]);
exit;