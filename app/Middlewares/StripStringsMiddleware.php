<?php

namespace App\Middlewares;

class StripStringsMiddleware extends TransformMiddleware
{
    /**
     * @inheritDoc
     */
    protected function transform(string $key, mixed $value): mixed
    {
        return htmlspecialchars((string)$value);
    }
}
