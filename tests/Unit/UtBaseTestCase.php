<?php

namespace Tests\Unit;

use App\Core\Container\ContainerInterface;
use Tests\Helpers\Unit\Builders\Core\Container\ContainerBuilder;
use Tests\Helpers\Unit\Builders\Mocks\{
    ConfigMockBuilder,
    DbMockBuilder,
    LoggerMockBuilder,
    RendererMockBuilder,
    RequestMockBuilder,
    ResponseMockBuilder,
    RouterMockBuilder,
    SessionMockBuilder,
    StorageMockBuilder
};
use Tests\TestCase;

abstract class UtBaseTestCase extends TestCase
{
    /**
     * @var string
     */
    protected string $rootDir;

    /**
     * @var string
     */
    protected string $configDirName;

    /**
     * @var \App\Core\Container\ContainerInterface|\Tests\Helpers\Unit\Builders\Core\Container\Classes\ContainerWithFakeCollaborator
     */
    protected ContainerInterface $container;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->rootDir = realpath(
            __DIR__
        ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

        $this->configDirName = 'config';

        $this->container = $this->createContainer();

        parent::setUp();
    }

    /**
     * @return \Tests\Helpers\Unit\Builders\Core\Container\Classes\ContainerWithFakeCollaborator
     */
    private function createContainer()
    {
        $configMock = (new ConfigMockBuilder())->make();
        $dbMock = (new DbMockBuilder())->make();
        $loggerMock = (new LoggerMockBuilder())->make();
        $requestMock = (new RequestMockBuilder())->make();
        $responseMock = (new ResponseMockBuilder())->make();
        $rendererMock = (new RendererMockBuilder())->make();
        $routerMock = (new RouterMockBuilder())->make();
        $sessionMock = (new SessionMockBuilder())->make();
        $storageMock = (new StorageMockBuilder())->make();

        return ContainerBuilder::makeWithFakeCollaborators(
            $this->rootDir,
            $this->configDirName,
            $configMock,
            $dbMock,
            $loggerMock,
            $requestMock,
            $responseMock,
            $rendererMock,
            $routerMock,
            $sessionMock,
            $storageMock
        );
    }
}
