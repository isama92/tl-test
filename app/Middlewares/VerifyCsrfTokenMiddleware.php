<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Exceptions\Session\CsrfTokenMismatchException;

class VerifyCsrfTokenMiddleware extends Middleware
{
    /**
     * @param \App\Core\Request\RequestInterface $request
     *
     * @return string
     */
    protected function getTokenFromRequest(RequestInterface $request): string
    {
        return (string)$request->input(RequestInterface::REQUEST_CSRF_TOKEN_KEY);
    }

    /**
     * @return string
     */
    protected function getTokenFromSession(): string
    {
        return $this->container->session()->token();
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Session\CsrfTokenMismatchException
     */
    protected function handle(RequestInterface $request): RequestInterface
    {
        if(in_array($request->getMethod(), [
            RequestInterface::METHOD_GET,
            RequestInterface::METHOD_HEAD,
            RequestInterface::METHOD_OPTIONS,
        ])) {
            return $request;
        }

        $requestToken = $this->getTokenFromRequest($request);
        $sessionToken = $this->getTokenFromSession();

        $match = strlen($sessionToken) === SessionInterface::CSRF_TOKEN_LENGTH
            && hash_equals($sessionToken, $requestToken);

        if(!$match){
            throw new CsrfTokenMismatchException();
        }

        return $request;
    }
}
