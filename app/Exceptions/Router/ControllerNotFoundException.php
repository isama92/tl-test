<?php

namespace App\Exceptions\Router;

use App\Exceptions\ExceptionAbstract;

class ControllerNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $controllerName
     * @param string $controllerMethod
     */
    public function __construct(string $controllerName, string $controllerMethod)
    {
        parent::__construct("Controller or controller method do not exist: {$controllerName}:$controllerMethod");
    }
}
