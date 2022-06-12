<?php

namespace App\Exceptions\Middleware;

use App\Exceptions\ExceptionAbstract;

class PostTooLargeException extends ExceptionAbstract
{
    public function __construct(int $postSize, int $maxPostSize)
    {
        parent::__construct("Post is too large ({$postSize} / {$maxPostSize})");
    }
}
