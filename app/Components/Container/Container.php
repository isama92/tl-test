<?php

namespace App\Components\Container;

use App\Components\ComponentAbstract;
use App\Components\Config\ConfigInterface;
use App\FactoryMethods\Config\ConfigFactoryMethod;

class Container extends ComponentAbstract implements ContainerInterface
{
    use ConfigFactoryMethod;

    /**
     * @var \App\Components\Config\ConfigInterface
     */
    protected ConfigInterface $config;

    /**
     * @var string Absolute path to project root directory
     */
    protected string $rootDir;

    /**
     * @var string
     */
    protected string $configDirName;

    /**
     * @param string $rootDir
     * @param string $configDirName
     */
    public function __construct(string $rootDir, string $configDirName)
    {
        $this->rootDir = $rootDir;
        $this->configDirName = $configDirName;
    }

    /**
     * @inheritDoc
     */
    public function config(): ConfigInterface
    {
        return $this->singleton(__FUNCTION__, [
            // $configDirPath
            $this->rootDir . $this->configDirName . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @param string  $camelCaseComponent Component name in camel case
     * @param mixed[] $params             New instance params
     *
     * @return mixed Instance of the given component
     */
    protected function singleton(string $camelCaseComponent, array $params = []): mixed
    {
        $pascalCaseComponent = ucfirst($camelCaseComponent);
        $factoryMethod = "create{$pascalCaseComponent}";

        if (!isset($this->{$camelCaseComponent})) {
            $this->{$camelCaseComponent} = $this->{$factoryMethod}(...$params);
        }

        return $this->{$camelCaseComponent};
    }
}
