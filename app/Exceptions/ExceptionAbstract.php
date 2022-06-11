<?php

namespace App\Exceptions;

use App\Core\Response\ResponseInterface;
use Exception;

abstract class ExceptionAbstract extends Exception
{
    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return ResponseInterface::HTTP_STATUS_CODE_ERROR;
    }
}
