<?php

namespace Tests\Helpers\Unit\Builders\Core\Renderer;

use App\Core\Container\ContainerInterface;
use App\Core\Renderer\RendererInterface;
use Tests\Helpers\Unit\Builders\Core\Renderer\Classes\RendererWithFakeCollaborator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RendererBuilder
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \Twig\Loader\FilesystemLoader          $filesystemLoaderMock
     * @param \Twig\Environment                      $environmentMock
     *
     * @return \App\Core\Renderer\RendererInterface
     */
    public static function makeWithFakeCollaborators(
        ContainerInterface $container,
        FilesystemLoader $filesystemLoaderMock,
        Environment $environmentMock
    ): RendererInterface {
        return new RendererWithFakeCollaborator(
            $container,
            $filesystemLoaderMock,
            $environmentMock
        );
    }
}
