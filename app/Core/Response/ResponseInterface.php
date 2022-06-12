<?php

namespace App\Core\Response;

interface ResponseInterface
{
    public const HTTP_STATUS_CODE_OK = 200;
    public const HTTP_STATUS_CODE_BAD_REQUEST = 400;
    public const HTTP_STATUS_CODE_UNAUTHORIZED = 401;
    public const HTTP_STATUS_CODE_FORBIDDEN = 403;
    public const HTTP_STATUS_CODE_NOT_FOUND = 404;
    public const HTTP_STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    public const HTTP_STATUS_CODE_ERROR = 500;

    public const HTTP_STATUS = [
        self::HTTP_STATUS_CODE_OK,
        self::HTTP_STATUS_CODE_BAD_REQUEST,
        self::HTTP_STATUS_CODE_UNAUTHORIZED,
        self::HTTP_STATUS_CODE_FORBIDDEN,
        self::HTTP_STATUS_CODE_NOT_FOUND,
        self::HTTP_STATUS_CODE_METHOD_NOT_ALLOWED,
        self::HTTP_STATUS_CODE_ERROR,
    ];

    /**
     * @param string $response
     *
     * @return void
     */
    public function setResponse(string $response): void;

    /**
     * @param int $statusCode
     *
     * @return void
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function output(): string;
}
