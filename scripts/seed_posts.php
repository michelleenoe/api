<?php

global $db;
$faker = Faker\Factory::create();

$users = $db->query("SELECT user_pk FROM users")->fetchAll(PDO::FETCH_COLUMN);

for ($i = 0; $i < 20; $i++) {
    $stmt = $db->prepare("
        INSERT INTO posts (post_pk, post_message, post_image_path, post_user_fk)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        bin2hex(random_bytes(25)),   // 50 chars
        $faker->sentence(12),
        $faker->imageUrl(400, 250),
        $faker->randomElement($users)
    ]);
}

echo "20 fake posts inserted\n";