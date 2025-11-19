<?php
require __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();
var_dump($_ENV['DB_HOST']);