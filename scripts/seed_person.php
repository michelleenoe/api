<?php

global $db;
$faker = Faker\Factory::create();

for ($i = 0; $i < 0; $i++) {
    $stmt = $db->prepare("
        INSERT INTO person (person_username, person_first_name)
        VALUES (?, ?)
    ");

    $stmt->execute([
        $faker->userName(),
        $faker->firstName(),
    ]);
}

echo "10 fake persons inserted\n";