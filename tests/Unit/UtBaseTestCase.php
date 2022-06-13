<?php

namespace Tests\Unit;

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
    protected string $rootDir;
    protected string $configDirName;

    protected function setUp(): void
    {
        $this->rootDir = realpath(
            __DIR__
        ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $this->configDirName = 'config';
        parent::setUp();
    }

    protected function createContainer()
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
