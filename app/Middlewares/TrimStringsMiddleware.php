<?php

namespace App\Middlewares;

class TrimStringsMiddleware extends TransformMiddleware
{
    /**
     * @inheritDoc
     */
    protected array $except = [
        'password',
        'password_confirmation',
    ];

    /**
     * @inheritDoc
     */
    protected function transform(string $key, mixed $value): mixed
    {
        return trim($value);
    }
}
