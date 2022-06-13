<?php

namespace Tests\Helpers\Unit\Builders\Core\Container\Classes;

use App\Core\Config\ConfigInterface;
use App\Core\Container\Container;
use App\Core\Container\ContainerInterface;
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
     * @inheritDoc
     */
    public function createConfig(string $configDirPath): ConfigInterface
    {
        return $this->fakeConfig;
    }

    /**
     * @inheritDoc
     */
    public function createDb(string $host, int $port, string $user, string $password, string $dbname, string $charset): DbInterface
    {
        return $this->fakeDb;
    }

    /**
     * @inheritDoc
     */
    public function createLogger(ContainerInterface $container): LoggerInterface
    {
        return $this->fakeLogger;
    }

    /**
     * @inheritDoc
     */
    public function createRequest(): RequestInterface
    {
        return $this->fakeRequest;
    }

    /**
     * @inheritDoc
     */
    public function createResponse(): ResponseInterface
    {
        return $this->fakeResponse;
    }

    /**
     * @inheritDoc
     */
    protected function createResponseWithResponseAndStatus(string $response, int $statusCode): ResponseInterface
    {
        return $this->fakeResponse;
    }

    /**
     * @inheritDoc
     */
    public function createRenderer(ContainerInterface $container): RendererInterface
    {
        return $this->fakeRenderer;
    }

    /**
     * @inheritDoc
     */
    public function createRouter(ContainerInterface $container): RouterInterface
    {
        return $this->fakeRouter;
    }

    /**
     * @inheritDoc
     */
    public function createSession(): SessionInterface
    {
        return $this->fakeSession;
    }

    /**
     * @inheritDoc
     */
    public function createStorage(ContainerInterface $container): StorageInterface
    {
        return $this->fakeStorage;
    }
}
