<?php

$get = \App\Core\Request\RequestInterface::METHOD_GET;
$post = \App\Core\Request\RequestInterface::METHOD_POST;

return [
    '/' => [
        $get => [\App\Controllers\CsvController::class, 'index'],
    ],
];
