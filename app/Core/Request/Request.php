<?php

namespace App\Core\Request;

use App\Core\CoreAbstract;
use App\Exceptions\Request\InvalidMethodException;

class Request extends CoreAbstract implements RequestInterface
{
    /**
     * @var string
     */
    protected string $route;

    public function __construct()
    {
        $this->route = strtok($_SERVER['REQUEST_URI'], '?');
    }

    /**
     * @inheritDoc
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Request\InvalidMethodException
     */
    public function getMethod(): string
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if(!in_array($method, self::METHODS)) {
            throw new InvalidMethodException($method);
        }
        return $method;
    }
}
