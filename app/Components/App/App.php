<?php

namespace App\Components\App;

use App\Components\ComponentAbstract;
use App\Components\Container\ContainerInterface;
use App\FactoryMethods\Container\ContainerFactoryMethod;

class App extends ComponentAbstract implements AppInterface
{
    use ContainerFactoryMethod;

    /**
     * @var \App\Components\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param string $rootDir Absolute path to project root directory
     * @param string $configDirName
     */
    public function __construct(string $rootDir, string $configDirName)
    {
        $this->container = $this->createContainer($rootDir, $configDirName);
    }

    /**
     * @inheritDoc
     */
    public function run(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function terminate(): void
    {
        // TODO: Implement terminate() method.
    }

    /**
     * @inheritDoc
     */
    public function container(): ContainerInterface
    {
        return $this->container;
    }
}
