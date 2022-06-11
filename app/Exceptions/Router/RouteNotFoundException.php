<?php

namespace App\Exceptions\Router;

use App\Core\Response\ResponseInterface;
use App\Exceptions\ExceptionAbstract;

class RouteNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $route
     */
    public function __construct(string $route)
    {
        parent::__construct("Page not found '{$route}'");
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return ResponseInterface::HTTP_STATUS_CODE_NOT_FOUND;
    }
}
