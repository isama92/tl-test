<?php

namespace App\Exceptions\Response;

use App\Exceptions\ExceptionAbstract;

class InvalidStatusCodeException extends ExceptionAbstract
{
    /**
     * @param int $statusCode
     */
    public function __construct(int $statusCode)
    {
        $statusCode = (string)$statusCode;
        parent::__construct("Invalid status code: {$statusCode}");
    }
}
