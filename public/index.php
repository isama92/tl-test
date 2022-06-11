<?php

// root dir
$rootDir = realpath(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
const CONFIG_DIR_NAME = 'config';

// composer files
require $rootDir . 'vendor/autoload.php';

// env
(new josegonzalez\Dotenv\Loader($rootDir . '.env'))
    ->parse()
    ->toEnv();

// app
$app = new \App\Core\App\App($rootDir, CONFIG_DIR_NAME);
$app->run();
$app->terminate();
