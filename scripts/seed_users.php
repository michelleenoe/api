<?php

global $db;
$faker = Faker\Factory::create();

for ($i = 0; $i < 20; $i++) {
    $stmt = $db->prepare("
        INSERT INTO users (user_pk, user_username, user_email, user_password, user_full_name)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        bin2hex(random_bytes(16)),
        $faker->userName,
        $faker->safeEmail,
        password_hash("test123", PASSWORD_DEFAULT),
        $faker->name
    ]);
}

echo "20 fake users inserted\n";