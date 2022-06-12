<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;

interface MiddlewareInterface
{
    /**
     * @param \App\Middlewares\MiddlewareInterface $handler
     *
     * @return \App\Middlewares\MiddlewareInterface
     */
    public function setNext(MiddlewareInterface $handler): MiddlewareInterface;

    /**
     * @param \App\Core\Request\RequestInterface $request
     *
     * @return \App\Core\Request\RequestInterface
     */
    public function execute(RequestInterface $request): RequestInterface;
}
