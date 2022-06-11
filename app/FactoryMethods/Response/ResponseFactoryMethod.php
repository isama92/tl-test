<?php

namespace App\FactoryMethods\Response;

use App\Core\Response\Response;
use App\Core\Response\ResponseInterface;

trait ResponseFactoryMethod
{
    /**
     * @return \App\Core\Response\ResponseInterface
     */
    protected function createResponse(): ResponseInterface
    {
        return new Response();
    }

    /**
     * @param string $response
     * @param int    $statusCode
     *
     * @return \App\Core\Response\ResponseInterface
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    protected function createResponseWithResponseAndStatus(string $response, int $statusCode): ResponseInterface
    {
        return new Response($response, $statusCode);
    }
}
