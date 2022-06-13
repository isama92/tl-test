<?php

namespace Tests\Unit\App\Core\Storage;

use App\Components\CsvHandler\CsvHandlerComponentInterface;

class GetStorageUtTest extends StorageUtTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function objectsCollaboration_ReadFromHappyPath_ContentReturned(): void
    {
        // Arrange
        $container = $this->container;
        $filePath = CsvHandlerComponentInterface::STORAGE_CSV_DIR . 'test1.csv';
        $content = '';

        // Collaboration
        // mock container + spl file object

        // Act

        // Assert
        // TODO
        $this->assertTrue(true);
    }
}
