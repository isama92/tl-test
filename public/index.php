<?php

// root dir
$rootDir = realpath(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
$configDirName = 'config';

// composer files
require $rootDir . 'vendor/autoload.php';

// env
(new josegonzalez\Dotenv\Loader($rootDir . '.env'))
    ->parse()
    ->toEnv();

// app
$app = new \App\Components\App\App($rootDir, $configDirName);
$app->run();
$app->terminate();
