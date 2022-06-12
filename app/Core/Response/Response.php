<?php

namespace App\Core\Response;

use App\Core\CoreAbstract;
use App\Exceptions\Response\InvalidStatusCodeException;
use App\Traits\HttpStatusCodeTrait;

class Response extends CoreAbstract implements ResponseInterface
{
    use HttpStatusCodeTrait;

    /**
     * @var string
     */
    protected string $response;

    /**
     * @param string $response
     * @param int    $statusCode
     *
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function __construct(string $response = '', int $statusCode = self::HTTP_STATUS_CODE_OK)
    {
        $this->setResponse($response);
        $this->setStatusCode($statusCode);
    }

    /**
     * @inheritDoc
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function output(): string
    {
        http_response_code($this->statusCode);
        return $this->response;
    }
}
