<?php

namespace App\FactoryMethods\Container;

use App\Components\Container\Container;
use App\Components\Container\ContainerInterface;

trait ContainerFactoryMethod
{
    /**
     * @param string $rootDir
     * @param string $configDirName
     *
     * @return \App\Components\Container\ContainerInterface
     */
    protected function createContainer(string $rootDir, string $configDirName): ContainerInterface
    {
        return new Container($rootDir, $configDirName);
    }
}
