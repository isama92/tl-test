<?php

$cacheEnabled = $_ENV['TEMPLATE_CACHE'] ?? false;
$cachePath = 'storage' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

return [
    'dir' => 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
    'cache' => $cacheEnabled ? $cachePath : null,
];
