<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;

class StartSessionMiddleware extends Middleware
{
    /**
     * @inheritDoc
     */
    protected function handle(RequestInterface $request): RequestInterface
    {
        $session = $this->container->session();
        if (!$session->hasStarted()) {
            $session->start();
        }
        return $request;
    }
}
