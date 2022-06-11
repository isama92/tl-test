<?php

namespace App\Core\Response;

use App\Core\CoreAbstract;

class Response extends CoreAbstract implements ResponseInterface
{
    /**
     * @var string
     */
    protected string $response;

    /**
     * @param string $response
     */
    public function __construct(string $response, int $statusCode = 200)
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function output(): string
    {
        return $this->response;
    }
}
