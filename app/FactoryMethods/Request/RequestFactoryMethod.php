<?php

namespace App\FactoryMethods\Request;

use App\Core\Request\Request;
use App\Core\Request\RequestInterface;

trait RequestFactoryMethod
{
    /**
     * @return \App\Core\Request\RequestInterface
     */
    protected function createRequest(): RequestInterface
    {
        return new Request();
    }
}
