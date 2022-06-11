<?php

namespace App\FactoryMethods\Renderer;

use App\Core\Container\ContainerInterface;
use App\Core\Renderer\Renderer;
use App\Core\Renderer\RendererInterface;

trait RendererFactoryMethod
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     *
     * @return \App\Core\Renderer\RendererInterface
     */
    protected function createRenderer(ContainerInterface $container): RendererInterface
    {
        return new Renderer($container);
    }
}
