<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;

class SecureHeadersMiddleware extends Middleware
{
    /**
     * @inheritDoc
     */
    protected function handle(RequestInterface $request): RequestInterface
    {
        $unsetHeaders = [
            'X-Powered-By',
            'Server',
        ];

        $setHeaders = [
            'X-Frame-Options' => 'deny',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Permissions-Policy' => "camera=(), microphone=()",
            'Content-Security-Policy' => "style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; font-src 'self' 'unsafe-inline' data:",
        ];

        foreach ($unsetHeaders as $h) {
            header_remove($h);
        }

        foreach ($setHeaders as $k => $v) {
            header("{$k}: {$v}");
        }

        return $request;
    }
}
