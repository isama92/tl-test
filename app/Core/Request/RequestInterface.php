<?php

namespace App\Core\Request;

interface RequestInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    const METHODS = [
        self::METHOD_GET,
        self::METHOD_POST,
    ];

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return string
     */
    public function getMethod(): string;
}
