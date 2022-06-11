<?php

namespace App\Core\Container;

use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Renderer\RendererInterface;
use App\Core\Router\RouterInterface;

interface ContainerInterface
{
    /**
     * @return string
     */
    public function getRootDir(): string;

    /**
     * @return \App\Core\Config\ConfigInterface
     */
    public function config(): ConfigInterface;

    /**
     * @return \App\Core\Db\DbInterface
     */
    public function db(): DbInterface;

    /**
     * @return \App\Core\Router\RouterInterface
     */
    public function router(): RouterInterface;

    /**
     * @return \App\Core\Renderer\RendererInterface
     */
    public function renderer(): RendererInterface;
}
