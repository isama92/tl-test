<?php

namespace App\Presenters;

use App\Core\Response\ResponseInterface;

class HtmlPresenter extends Presenter
{
    /**
     * @var string
     */
    protected string $html;

    /**
     * @param string $html
     * @param int    $statusCode
     *
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function __construct(string $html, int $statusCode = ResponseInterface::HTTP_STATUS_CODE_OK)
    {
        $this->setHtml($html);
        $this->setStatusCode($statusCode);
    }

    /**
     * @param string $html
     *
     * @return void
     */
    protected function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    protected function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function present(): ResponseInterface
    {
        return $this->createResponseWithResponseAndStatus($this->getHtml(), $this->getStatusCode());
    }
}
