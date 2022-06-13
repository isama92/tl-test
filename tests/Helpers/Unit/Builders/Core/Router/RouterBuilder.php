<?php

namespace Tests\Helpers\Unit\Builders\Core\Router;

use App\Core\Container\ContainerInterface;
use App\Core\Router\RouterInterface;
use App\Presenters\HtmlPresenter;
use Tests\Helpers\Unit\Builders\Core\Router\Classes\RouterWithFakeCollaborator;

class RouterBuilder
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \App\Presenters\HtmlPresenter          $htmlPresenterMock
     *
     * @return \App\Core\Router\RouterInterface
     */
    public static function makeWithFakeCollaborators(
        ContainerInterface $container,
        HtmlPresenter $htmlPresenterMock
    ): RouterInterface {
        return new RouterWithFakeCollaborator($container, $htmlPresenterMock);
    }
}
