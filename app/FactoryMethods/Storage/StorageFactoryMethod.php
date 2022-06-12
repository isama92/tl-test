<?php

namespace App\FactoryMethods\Storage;

use App\Core\Container\ContainerInterface;
use App\Core\Storage\Storage;
use App\Core\Storage\StorageInterface;

trait StorageFactoryMethod
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     *
     * @return \App\Core\Storage\StorageInterface
     */
    protected function createStorage(ContainerInterface $container): StorageInterface
    {
        return new Storage($container);
    }
}
