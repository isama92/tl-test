<?php

namespace App\Core\Container;

use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Renderer\RendererInterface;
use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;
use App\Core\Router\RouterInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;

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
     * @return \App\Core\Request\RequestInterface
     */
    public function request(): RequestInterface;

    /**
     * @return \App\Core\Response\ResponseInterface
     */
    public function response(): ResponseInterface;

    /**
     * @return \App\Core\Renderer\RendererInterface
     */
    public function renderer(): RendererInterface;

    /**
     * @return \App\Core\Session\SessionInterface
     */
    public function session(): SessionInterface;

    /**
     * @return \App\Core\Storage\StorageInterface
     */
    public function storage(): StorageInterface;
}
