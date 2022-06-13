<?php

namespace Tests\Helpers\Unit\Builders\Core\Router\Classes;

use App\Core\Container\ContainerInterface;
use App\Core\Response\ResponseInterface;
use App\Core\Router\Router;
use App\Presenters\HtmlPresenter;

class RouterWithFakeCollaborator extends Router
{
    /**
     * @var \App\Presenters\HtmlPresenter
     */
    public HtmlPresenter $fakePresenter;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \App\Presenters\HtmlPresenter          $presenter
     */
    public function __construct(ContainerInterface $container, HtmlPresenter $presenter)
    {
        $this->fakePresenter = $presenter;
        parent::__construct($container);
    }

    /**
     * @param string $html
     * @param int    $statusCode
     *
     * @return \App\Presenters\HtmlPresenter
     */
    public function createHtmlPresenter(
        string $html,
        int $statusCode = ResponseInterface::HTTP_STATUS_CODE_OK
    ): HtmlPresenter {
        return $this->fakePresenter;
    }
}
