<?php

namespace Tests\Unit\App\Core\Storage;

use App\Components\CsvHandler\CsvHandlerComponentInterface;
use App\Core\Storage\StorageInterface;
use Tests\Helpers\Unit\Builders\Core\Container\ContainerBuilder;
use Tests\Helpers\Unit\Builders\Core\Storage\Classes\StorageWithFakeCollaborator;
use Tests\Helpers\Unit\Builders\Mocks\{
    ConfigMockBuilder,
    DbMockBuilder,
    LoggerMockBuilder,
    RendererMockBuilder,
    RequestMockBuilder,
    ResponseMockBuilder,
    RouterMockBuilder,
    SessionMockBuilder,
    SplFileObjectMockBuilder,
    StorageMockBuilder,
};

class GetStorageUtTest extends StorageUtTestCase
{
    /**
     * @return void
     * @throws \App\Exceptions\Storage\FileNotFoundException
     * @throws \App\Exceptions\Storage\InvalidModeException
     */
    public function objectsCollaboration_ReadFromHappyPath_ContentReturned(): void
    {
        // Arrange
        $filePath = CsvHandlerComponentInterface::STORAGE_CSV_DIR . 'test1.csv';
        $configStorageDir = 'storage' . DIRECTORY_SEPARATOR;
        $fullFilePath = $this->rootDir . $configStorageDir . $filePath;
        $fileMode = StorageInterface::MODE_R;
        $expectedContent = 'abcdef';
        $expectedContentLength = strlen($expectedContent);

        // Collaboration

        $splFileObjectMock = (new SplFileObjectMockBuilder())->make([$fullFilePath, $fileMode]);
        $configMock = (new ConfigMockBuilder())->make();
        $dbMock = (new DbMockBuilder())->make();
        $loggerMock = (new LoggerMockBuilder())->make();
        $requestMock = (new RequestMockBuilder())->make();
        $responseMock = (new ResponseMockBuilder())->make();
        $rendererMock = (new RendererMockBuilder())->make();
        $routerMock = (new RouterMockBuilder())->make();
        $sessionMock = (new SessionMockBuilder())->make();
        $storageMock = (new StorageMockBuilder())->make();

        $configMock->shouldReceive('get')
            ->once()
            ->with(StorageInterface::CONFIG_STORAGE_DIR)
            ->andReturn($configStorageDir);

        $splFileObjectMock->shouldReceive('getSize')
            ->once()
            ->withNoArgs()
            ->andReturn($expectedContentLength);
        $splFileObjectMock->shouldReceive('fread')
            ->once()
            ->with($expectedContentLength)
            ->andReturn($expectedContent);

        $container = ContainerBuilder::makeWithFakeCollaborators(
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

        $storage = new StorageWithFakeCollaborator($container, $splFileObjectMock);

        // Act
        $content = $storage->get($filePath);

        // Assert
        $this->assertEquals($expectedContent, $content);
    }
}
