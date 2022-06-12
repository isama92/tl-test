<?php

$cachePath = 'storage' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

return [
    'dir' => 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
    'cache' => $_ENV['TEMPLATE_CACHE'] ? $cachePath : null,
];
