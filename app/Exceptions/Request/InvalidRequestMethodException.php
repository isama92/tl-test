<?php

namespace App\Exceptions\Request;

use App\Exceptions\ExceptionAbstract;

class InvalidRequestMethodException extends ExceptionAbstract
{
    /**
     * @param string $method
     */
    public function __construct(string $method)
    {
        parent::__construct("Invalid request method: {$method}");
    }
}
