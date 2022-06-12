<?php

namespace App\Core\Router;

use App\Core\Response\ResponseInterface;

interface RouterInterface
{
    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return \App\Core\Response\ResponseInterface
     */
    public function handle(): ResponseInterface;
}
