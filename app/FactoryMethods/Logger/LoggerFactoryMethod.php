<?php

namespace App\FactoryMethods\Logger;

use App\Core\Container\ContainerInterface;
use App\Core\Logger\Logger;
use App\Core\Logger\LoggerInterface;

trait LoggerFactoryMethod
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     *
     * @return \App\Core\Logger\LoggerInterface
     */
    protected function createLogger(ContainerInterface $container): LoggerInterface
    {
        return new Logger($container);
    }
}
