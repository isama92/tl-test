<?php

namespace Tests\Helpers\Unit\Builders\Core\Container\Classes;

use App\Core\Config\ConfigInterface;
use App\Core\Container\Container;
use App\Core\Db\DbInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Renderer\RendererInterface;
use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;
use App\Core\Router\RouterInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;

class ContainerWithFakeCollaborator extends Container
{
    /**
     * @var \App\Core\Config\ConfigInterface
     */
    public ConfigInterface $fakeConfig;

    /**
     * @var \App\Core\Db\DbInterface
     */
    public DbInterface $fakeDb;

    /**
     * @var \App\Core\Router\RouterInterface
     */
    public RouterInterface $fakeRouter;

    /**
     * @var \App\Core\Request\RequestInterface
     */
    public RequestInterface $fakeRequest;

    /**
     * @var \App\Core\Response\ResponseInterface
     */
    public ResponseInterface $fakeResponse;

    /**
     * @var \App\Core\Renderer\RendererInterface
     */
    public RendererInterface $fakeRenderer;

    /**
     * @var \App\Core\Session\SessionInterface
     */
    public SessionInterface $fakeSession;

    /**
     * @var \App\Core\Storage\StorageInterface
     */
    public StorageInterface $fakeStorage;

    /**
     * @var \App\Core\Logger\LoggerInterface
     */
    public LoggerInterface $fakeLogger;

    public function __construct(
        string $rootDir,
        string $configDirName,
        ConfigInterface $config,
        DbInterface $db,
        LoggerInterface $logger,
        RequestInterface $request,
        ResponseInterface $response,
        RendererInterface $renderer,
        RouterInterface $router,
        SessionInterface $session,
        StorageInterface $storage
    ) {
        $this->fakeConfig = $config;
        $this->fakeDb = $db;
        $this->fakeLogger = $logger;
        $this->fakeRequest = $request;
        $this->fakeResponse = $response;
        $this->fakeRenderer = $renderer;
        $this->fakeRouter = $router;
        $this->fakeSession = $session;
        $this->fakeStorage = $storage;

        parent::__construct($rootDir, $configDirName);
    }

    /**
     * @return \App\Core\Config\ConfigInterface
     */
    public function createConfig(): ConfigInterface
    {
        return $this->fakeConfig;
    }

    /**
     * @return \App\Core\Db\DbInterface
     */
    public function createDb(): DbInterface
    {
        return $this->fakeDb;
    }

    /**
     * @return \App\Core\Logger\LoggerInterface
     */
    public function createLogger(): LoggerInterface
    {
        return $this->fakeLogger;
    }

    /**
     * @return \App\Core\Request\RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        return $this->fakeRequest;
    }

    /**
     * @return \App\Core\Response\ResponseInterface
     */
    public function createResponse(): ResponseInterface
    {
        return $this->fakeResponse;
    }

    /**
     * @return \App\Core\Renderer\RendererInterface
     */
    public function createRenderer(): RendererInterface
    {
        return $this->fakeRenderer;
    }

    /**
     * @return \App\Core\Router\RouterInterface
     */
    public function createRouter(): RouterInterface
    {
        return $this->fakeRouter;
    }

    /**
     * @return \App\Core\Session\SessionInterface
     */
    public function createSession(): SessionInterface
    {
        return $this->fakeSession;
    }

    /**
     * @return \App\Core\Storage\StorageInterface
     */
    public function createStorage(): StorageInterface
    {
        return $this->fakeStorage;
    }

}
