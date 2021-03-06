<?php

namespace App\Core\Container;

use App\Core\CoreAbstract;
use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Renderer\RendererInterface;
use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;
use App\Core\Router\RouterInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use App\FactoryMethods\Config\ConfigFactoryMethod;
use App\FactoryMethods\Db\DbFactoryMethod;
use App\FactoryMethods\Logger\LoggerFactoryMethod;
use App\FactoryMethods\Renderer\RendererFactoryMethod;
use App\FactoryMethods\Request\RequestFactoryMethod;
use App\FactoryMethods\Response\ResponseFactoryMethod;
use App\FactoryMethods\Router\RouterFactoryMethod;
use App\FactoryMethods\Session\SessionFactoryMethod;
use App\FactoryMethods\Storage\StorageFactoryMethod;

class Container extends CoreAbstract implements ContainerInterface
{
    use ConfigFactoryMethod;
    use DbFactoryMethod;
    use LoggerFactoryMethod;
    use RequestFactoryMethod;
    use ResponseFactoryMethod;
    use RendererFactoryMethod;
    use RouterFactoryMethod;
    use SessionFactoryMethod;
    use StorageFactoryMethod;

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
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    /**
     * @inheritDoc
     */
    public function config(): ConfigInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            // $configDirPath
            $this->rootDir . $this->configDirName . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function db(): DbInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            $this->config()->get('db.host'),
            $this->config()->get('db.port'),
            $this->config()->get('db.user'),
            $this->config()->get('db.password'),
            $this->config()->get('db.dbname'),
            $this->config()->get('db.charset'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function logger(): LoggerInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            $this,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function request(): RequestInterface
    {
        return $this->getCoreInstance(__FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function response(): ResponseInterface
    {
        return $this->getCoreInstance(__FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function renderer(): RendererInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            $this,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function router(): RouterInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            $this,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function session(): SessionInterface
    {
        return $this->getCoreInstance(__FUNCTION__);
    }

    /**
     * @inheritDoc
     */
    public function storage(): StorageInterface
    {
        return $this->getCoreInstance(__FUNCTION__, [
            $this,
        ]);
    }

    /**
     * @param string  $camelCaseComponent Component name in camel case
     * @param mixed[] $params             New instance params
     *
     * @return mixed Instance of the given component
     */
    protected function getCoreInstance(string $camelCaseComponent, array $params = []): mixed
    {
        $pascalCaseComponent = ucfirst($camelCaseComponent);
        $factoryMethod = "create{$pascalCaseComponent}";

        if (!isset($this->{$camelCaseComponent})) {
            $this->{$camelCaseComponent} = $this->{$factoryMethod}(...$params);
        }

        return $this->{$camelCaseComponent};
    }
}
