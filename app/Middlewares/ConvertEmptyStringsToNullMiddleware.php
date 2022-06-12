<?php

namespace App\Middlewares;

class ConvertEmptyStringsToNullMiddleware extends TransformMiddleware
{
    /**
     * @inheritDoc
     */
    protected function transform(string $key, mixed $value): mixed
    {
        return $value !== '' ? $value : null;
    }
}
