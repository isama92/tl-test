<?php

namespace App\Exceptions\Storage;

use App\Exceptions\ExceptionAbstract;

class InvalidModeException extends ExceptionAbstract
{
    /**
     * @param string $mode
     */
    public function __construct(string $mode)
    {
        parent::__construct("Invalid mode: {$mode}");
    }
}
