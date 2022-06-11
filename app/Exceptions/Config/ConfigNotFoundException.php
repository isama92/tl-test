<?php

namespace App\Exceptions\Config;

use App\Exceptions\ExceptionAbstract;

class ConfigNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $configPath
     */
    public function __construct(string $configPath)
    {
        parent::__construct("Config not found: {$configPath}");
    }
}
