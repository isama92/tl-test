<?php

namespace App\Exceptions\Router;

use App\Core\Response\ResponseInterface;
use App\Exceptions\ExceptionAbstract;

class RouteMethodNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $route
     * @param string $method
     */
    public function __construct(string $route, string $method)
    {
        parent::__construct("Route method not found: {$method} {$route}");
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return ResponseInterface::HTTP_STATUS_CODE_METHOD_NOT_ALLOWED;
    }
}
