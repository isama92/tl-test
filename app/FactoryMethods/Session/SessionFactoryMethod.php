<?php

namespace App\FactoryMethods\Session;

use App\Core\Session\Session;
use App\Core\Session\SessionInterface;

trait SessionFactoryMethod
{
    /**
     * @return \App\Core\Session\SessionInterface
     */
    protected function createSession(): SessionInterface
    {
        return new Session();
    }
}
