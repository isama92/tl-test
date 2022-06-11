<?php

namespace App\Exceptions\Router;

use App\Exceptions\ExceptionAbstract;

class RouteNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $routePath
     */
    public function __construct(string $routePath)
    {
        parent::__construct("Route not found: {$routePath}");
    }
}
