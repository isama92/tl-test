<?php

namespace App\Traits;

use App\Core\Response\ResponseInterface;
use App\Exceptions\Response\InvalidStatusCodeException;

trait HttpStatusCodeTrait
{
    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @param int $statusCode
     *
     * @return void
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function setStatusCode(int $statusCode): void
    {
        if (!in_array($statusCode, ResponseInterface::HTTP_STATUS)) {
            throw new InvalidStatusCodeException($statusCode);
        }
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
