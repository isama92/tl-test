<?php

namespace App\FactoryMethods\Router;

use App\Core\Container\ContainerInterface;
use App\Core\Router\Router;
use App\Core\Router\RouterInterface;

trait RouterFactoryMethod
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     *
     * @return \App\Core\Router\RouterInterface
     */
    protected function createRouter(ContainerInterface $container): RouterInterface
    {
        return new Router($container);
    }
}
