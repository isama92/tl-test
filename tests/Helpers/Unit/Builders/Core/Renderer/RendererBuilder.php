<?php

namespace Tests\Helpers\Unit\Builders\Core\Renderer;

use App\Core\Container\ContainerInterface;
use Tests\Helpers\Unit\Builders\Core\Renderer\Classes\RendererWithFakeCollaborator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RendererBuilder
{
    public static function makeWithFakeCollaborators(
        ContainerInterface $container,
        FilesystemLoader $filesystemLoaderMock,
        Environment $environmentMock
    ) {
        return new RendererWithFakeCollaborator(
            $container,
            $filesystemLoaderMock,
            $environmentMock
        );
    }
}
