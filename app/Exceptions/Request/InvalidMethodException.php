<?php

namespace App\Exceptions\Request;

use App\Exceptions\ExceptionAbstract;

class InvalidMethodException extends ExceptionAbstract
{
    /**
     * @param string $method
     */
    public function __construct(string $method)
    {
        parent::__construct("Invalid method: {$method}");
    }
}
