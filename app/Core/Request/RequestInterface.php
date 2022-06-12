<?php

namespace App\Core\Request;

interface RequestInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';
    public const METHOD_OPTIONS = 'OPTIONS';
    public const METHOD_HEAD = 'HEAD';

    public const METHODS = [
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_PATCH,
        self::METHOD_DELETE,
        self::METHOD_OPTIONS,
        self::METHOD_HEAD,
    ];

    public const REQUEST_CSRF_TOKEN_KEY = '_token';

    /**
     * Return one or all GET variables
     *
     * @param string|null $key
     * @param mixed|null  $defaultValue
     *
     * @return mixed
     */
    public function get(?string $key = null, mixed $defaultValue = null): mixed;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function updateGet(string $key, mixed $value): void;

    /**
     * Return one or all POST variables
     *
     * @param string|null $key
     * @param mixed|null  $defaultValue
     *
     * @return mixed
     */
    public function post(?string $key = null, mixed $defaultValue = null): mixed;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function updatePost(string $key, mixed $value): void;

    /**
     * Return GET and POST variables
     *
     * @return array
     */
    public function all(): array;

    /**
     * Return GET and POST variables, if key is given it will return its value
     *
     * @param string|null $key
     * @param mixed|null  $defaultValue
     *
     * @return array
     */
    public function input(?string $key = null, mixed $defaultValue = null): mixed;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return string
     */
    public function getMethod(): string;
}
