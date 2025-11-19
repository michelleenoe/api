<?php
require __DIR__ . "/db.php";
require __DIR__ . "/faker/autoload.php";

$faker = Faker\Factory::create();

for ($i = 0; $i < 10; $i++) {
    $stmt = $db->prepare("
        INSERT INTO person (person_username, person_first_name)
        VALUES (?, ?)
    ");

    $stmt->execute([
        $faker->userName,
        $faker->firstName
    ]);
}

echo "10 fake persons inserted";
