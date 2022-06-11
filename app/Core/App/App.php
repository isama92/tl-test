<?php

namespace App\Core\App;

use App\Core\CoreAbstract;
use App\Core\Container\ContainerInterface;
use App\FactoryMethods\Container\ContainerFactoryMethod;

class App extends CoreAbstract implements AppInterface
{
    use ContainerFactoryMethod;

    /**
     * @var \App\Core\Container\ContainerInterface
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
        // TODO: Implement run() method.
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
