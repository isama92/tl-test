<?php

namespace App\Core\Response;

use App\Core\CoreAbstract;
use App\Exceptions\Response\InvalidStatusCodeException;

class Response extends CoreAbstract implements ResponseInterface
{
    /**
     * @var string
     */
    protected string $response;

    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @param string $response
     * @param int    $statusCode
     *
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function __construct(string $response = '', int $statusCode = self::HTTP_STATUS_CODE_OK)
    {
        $this->setResponse($response);
        $this->setStatus($statusCode);
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
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function setStatus(int $statusCode): void
    {
        if(!in_array($statusCode, self::HTTP_STATUS)) {
            throw new InvalidStatusCodeException($statusCode);
        }
        $this->statusCode = $statusCode;
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): int
    {
        return $this->statusCode;
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
