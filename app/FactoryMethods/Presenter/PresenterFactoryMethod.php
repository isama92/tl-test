<?php

namespace App\FactoryMethods\Presenter;

use App\Core\Response\ResponseInterface;
use App\Presenters\HtmlPresenter;

trait PresenterFactoryMethod
{
    /**
     * @param string $html
     * @param int    $statusCode
     *
     * @return \App\Presenters\HtmlPresenter
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function createHtmlPresenter(
        string $html,
        int $statusCode = ResponseInterface::HTTP_STATUS_CODE_OK
    ): HtmlPresenter {
        return new HtmlPresenter($html, $statusCode);
    }
}
