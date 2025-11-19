<?php

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

require __DIR__ . "/../db.php";

require __DIR__ . "/seed_users.php";
require __DIR__ . "/seed_person.php";
require __DIR__ . "/seed_posts.php";

echo "ALL SEEDS COMPLETED\n";