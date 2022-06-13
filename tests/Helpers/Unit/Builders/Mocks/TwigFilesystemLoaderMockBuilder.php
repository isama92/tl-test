<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use Twig\Loader\FilesystemLoader;

class TwigFilesystemLoaderMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return FilesystemLoader::class;
    }
}
