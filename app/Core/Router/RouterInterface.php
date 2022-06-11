<?php

namespace App\Core\Router;

use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;

interface RouterInterface
{
    /**
     * @param \App\Core\Request\RequestInterface $request
     *
     * @return \App\Core\Response\ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface;
}
