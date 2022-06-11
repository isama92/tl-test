<?php

namespace App\Core\Router;

use App\Core\Response\ResponseInterface;

interface RouterInterface
{
    /**
     * @return \App\Core\Response\ResponseInterface
     */
    public function handle(): ResponseInterface;
}
