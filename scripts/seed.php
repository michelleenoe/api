<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../db.php";

echo "Seeding started...\n";

require __DIR__ . "/seed_users.php";
require __DIR__ . "/seed_person.php";
require __DIR__ . "/seed_posts.php";

echo "ALL SEEDS COMPLETED\n";