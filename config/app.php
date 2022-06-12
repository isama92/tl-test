<?php

return [
    'middlewares' => [
        \App\Middlewares\StartSessionMiddleware::class,
        \App\Middlewares\TrimStringsMiddleware::class,
        \App\Middlewares\StripStringsMiddleware::class,
        \App\Middlewares\ConvertEmptyStringsToNullMiddleware::class,
        \App\Middlewares\VerifyCsrfTokenMiddleware::class,
    ],
];
