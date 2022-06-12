<?php

$get = \App\Core\Request\RequestInterface::METHOD_GET;
$post = \App\Core\Request\RequestInterface::METHOD_POST;

return [
    '/' => [
        $get => [\App\Controllers\CsvHandlerController::class, 'index'],
    ],
    '/import' => [
        $post => [\App\Controllers\CsvHandlerController::class, 'import'],
    ],
    '/db' => [
        $get => [\App\Controllers\CsvHandlerController::class, 'db'],
    ],
];
