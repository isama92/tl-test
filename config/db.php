<?php

return [
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'port' => $_ENV['DB_PORT'] ?? 3306,
    'user' => $_ENV['DB_USER'] ?? 'user',
    'password' => $_ENV['DB_PASSWORD'] ?? 'password',
    'dbname' => $_ENV['DB_DBNAME'] ?? 'dbname',
];
