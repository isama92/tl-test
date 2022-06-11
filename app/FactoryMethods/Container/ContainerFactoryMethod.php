<?php

namespace App\FactoryMethods\Container;

use App\Core\Container\Container;
use App\Core\Container\ContainerInterface;

trait ContainerFactoryMethod
{
    /**
     * @param string $rootDir
     * @param string $configDirName
     *
     * @return \App\Core\Container\ContainerInterface
     */
    protected function createContainer(string $rootDir, string $configDirName): ContainerInterface
    {
        return new Container($rootDir, $configDirName);
    }
}
