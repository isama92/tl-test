<?php

namespace App\Middlewares;

use App\Core\Container\ContainerInterface;
use App\Core\Request\RequestInterface;

abstract class Middleware implements MiddlewareInterface
{
    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @var \App\Middlewares\MiddlewareInterface
     */
    protected MiddlewareInterface $nextMiddleware;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function setNext(MiddlewareInterface $middleware): MiddlewareInterface
    {
        $this->nextMiddleware = $middleware;
        return $middleware;
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request): RequestInterface
    {
        $request = $this->handle($request);

        if(isset($this->nextMiddleware)) {
            return $this->nextMiddleware->execute($request);
        }

        return $request;
    }

    /**
     * @param \App\Core\Request\RequestInterface $request
     *
     * @return \App\Core\Request\RequestInterface
     */
    abstract protected function handle(RequestInterface $request): RequestInterface;
}
