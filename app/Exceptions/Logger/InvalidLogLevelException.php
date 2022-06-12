<?php

namespace App\Exceptions\Logger;

use App\Exceptions\ExceptionAbstract;

class InvalidLogLevelException extends ExceptionAbstract
{
    /**
     * @param string $logLevel
     */
    public function __construct(string $logLevel)
    {
        parent::__construct("Invalid log level ({$logLevel})");
    }
}
