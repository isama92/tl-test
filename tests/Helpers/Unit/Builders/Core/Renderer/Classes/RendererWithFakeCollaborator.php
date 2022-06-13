<?php

namespace Tests\Helpers\Unit\Builders\Core\Renderer\Classes;

use App\Core\Container\ContainerInterface;
use App\Core\Renderer\Renderer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RendererWithFakeCollaborator extends Renderer
{
    /**
     * @var \Twig\Loader\FilesystemLoader
     */
    public FilesystemLoader $fakeFilesystemLoader;

    /**
     * @var \Twig\Environment
     */
    public Environment $fakeEnvironment;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \Twig\Loader\FilesystemLoader          $filesystemLoader
     * @param \Twig\Environment                      $environment
     */
    public function __construct(
        ContainerInterface $container,
        FilesystemLoader $filesystemLoader,
        Environment $environment
    ) {
        $this->fakeFilesystemLoader = $filesystemLoader;
        $this->fakeEnvironment = $environment;
        parent::__construct($container);
    }

    /**
     * @return \Twig\Loader\FilesystemLoader
     */
    protected function createTwigFilesystemLoader(): FilesystemLoader
    {
        return $this->fakeFilesystemLoader;
    }

    /**
     * @param \Twig\Loader\FilesystemLoader $loader
     * @param array                         $configs
     *
     * @return \Twig\Environment
     */
    protected function createTwigEnvironment(FilesystemLoader $loader, array $configs = []): Environment
    {
        return $this->fakeEnvironment;
    }
}
