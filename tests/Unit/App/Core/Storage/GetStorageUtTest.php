<?php

namespace Tests\Unit\App\Core\Storage;

use App\Components\CsvHandler\CsvHandlerComponentInterface;
use App\Core\Storage\StorageInterface;
use Tests\Helpers\Unit\Builders\Core\Storage\Classes\StorageWithFakeCollaborator;
use Tests\Helpers\Unit\Builders\Mocks\{ConfigMockBuilder,
    ContainerMockBuilder,
    SplFileObjectMockBuilder
};

class GetStorageUtTest extends StorageUtTestCase
{
    /**
     * @test
     *
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
        $containerMock = (new ContainerMockBuilder())->make();

        $containerMock->shouldReceive('getRootDir')
            ->once()
            ->withNoArgs()
            ->andReturn($this->rootDir);

        $containerMock->shouldReceive('config')
            ->once()
            ->withNoArgs()
            ->andReturn($configMock);

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

        $storage = new StorageWithFakeCollaborator($containerMock, $splFileObjectMock);

        // Act
        $content = $storage->get($filePath);

        // Assert
        $this->assertEquals($expectedContent, $content);
    }
}
