<?php

require __DIR__ . "/../db.php";

// run all seeds
require __DIR__ . "/seed_users.php";
require __DIR__ . "/seed_posts.php";
require __DIR__ . "/seed_person.php";

echo "\nSEED COMPLETE\n";