<?php

namespace Tests\Helpers\Unit\Builders\Core\Container;

use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Renderer\RendererInterface;
use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;
use App\Core\Router\RouterInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use Tests\Helpers\Unit\Builders\Core\Container\Classes\ContainerWithFakeCollaborator;

class ContainerBuilder
{
    /**
     * @param string                               $rootDir
     * @param string                               $configDirName
     * @param \App\Core\Config\ConfigInterface     $configMock
     * @param \App\Core\Db\DbInterface             $dbMock
     * @param \App\Core\Logger\LoggerInterface     $loggerMock
     * @param \App\Core\Request\RequestInterface   $requestMock
     * @param \App\Core\Response\ResponseInterface $responseMock
     * @param \App\Core\Renderer\RendererInterface $rendererMock
     * @param \App\Core\Router\RouterInterface     $routerMock
     * @param \App\Core\Session\SessionInterface   $sessionMock
     * @param \App\Core\Storage\StorageInterface   $storagMock
     *
     * @return \Tests\Helpers\Unit\Builders\Core\Container\Classes\ContainerWithFakeCollaborator
     */
    public static function makeWithFakeCollaborators(
        string $rootDir,
        string $configDirName,
        ConfigInterface $configMock,
        DbInterface $dbMock,
        LoggerInterface $loggerMock,
        RequestInterface $requestMock,
        ResponseInterface $responseMock,
        RendererInterface $rendererMock,
        RouterInterface $routerMock,
        SessionInterface $sessionMock,
        StorageInterface $storagMock
    ) {
        return new ContainerWithFakeCollaborator(
            $rootDir,
            $configDirName,
            $configMock,
            $dbMock,
            $loggerMock,
            $requestMock,
            $responseMock,
            $rendererMock,
            $routerMock,
            $sessionMock,
            $storagMock
        );
    }
}
