<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;
use App\Exceptions\Middleware\PostTooLargeException;

class ValidatePostSizeMiddleware extends Middleware
{
    /**
     * @inheritDoc
     * @throws \App\Exceptions\Middleware\PostTooLargeException
     */
    protected function handle(RequestInterface $request): RequestInterface
    {
        $max = $this->getMaxPostSize();

        $postSize = $_SERVER['CONTENT_LENGTH'] ?? 0;

        if ($max > 0 && $postSize > $max) {
            throw new PostTooLargeException($postSize, $max);
        }

        return $request;
    }

    /**
     * Get max post size
     *
     * @return int
     */
    protected function getMaxPostSize(): int
    {
        $postMaxSize = ini_get('post_max_size');

        if (is_numeric($postMaxSize)) {
            return (int) $postMaxSize;
        }

        $metric = strtoupper(substr($postMaxSize, -1));
        $postMaxSize = (int) $postMaxSize;

        switch ($metric) {
            case 'K':
                return $postMaxSize * 1024;
            case 'M':
                return $postMaxSize * 1048576;
            case 'G':
                return $postMaxSize * 1073741824;
            default:
                return $postMaxSize;
        }
    }
}
