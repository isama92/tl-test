<?php

// env
$defaultEnvValue = \App\Core\Config\ConfigInterface::ENV_PRODUCTION;
$env = strtolower($_ENV['ENV'] ?? $defaultEnvValue);
if (!in_array($env, \App\Core\Config\ConfigInterface::ENVS)) {
    $env = $defaultEnvValue;
}

return [
    'environment' => $env,
    'middlewares' => [
        \App\Middlewares\StartSessionMiddleware::class,
        \App\Middlewares\ValidatePostSizeMiddleware::class,
        \App\Middlewares\TrimStringsMiddleware::class,

        // it breaks csv parsing if no enclosure char is set
        //\App\Middlewares\StripStringsMiddleware::class,

        \App\Middlewares\ConvertEmptyStringsToNullMiddleware::class,
        \App\Middlewares\VerifyCsrfTokenMiddleware::class,
        \App\Middlewares\SecureHeadersMiddleware::class,
    ],
];
