<?php

namespace App\Core\Container;

use App\Core\CoreAbstract;
use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Router\RouterInterface;
use App\FactoryMethods\Config\ConfigFactoryMethod;
use App\FactoryMethods\Db\DbFactoryMethod;
use App\FactoryMethods\Router\RouterFactoryMethod;

class Container extends CoreAbstract implements ContainerInterface
{
    use ConfigFactoryMethod;
    use DbFactoryMethod;
    use RouterFactoryMethod;

    /**
     * @var \App\Core\Config\ConfigInterface
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
     * @inheritDoc
     */
    public function db(): DbInterface
    {
        return $this->singleton(__FUNCTION__, [
            $this->config()->get('db.host'),
            $this->config()->get('db.user'),
            $this->config()->get('db.password'),
            $this->config()->get('db.dbname'),
            $this->config()->get('db.charset'),
            $this->config()->get('db.port'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function router(): RouterInterface
    {
        return $this->singleton(__FUNCTION__, [
            $this,
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
