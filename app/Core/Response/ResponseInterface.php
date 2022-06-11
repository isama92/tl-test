<?php

namespace App\Core\Response;

interface ResponseInterface
{
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_NOT_FOUND = 404;
    const STATUS_CODE_ERROR = 500;

    /**
     * @return string
     */
    public function output(): string;
}
