<?php

namespace App\Core\Request;

use App\Core\CoreAbstract;
use App\Exceptions\Request\InvalidRequestMethodException;

class Request extends CoreAbstract implements RequestInterface
{
    /**
     * @var string
     */
    protected string $route;

    /**
     * @var array
     */
    protected array $get;

    /**
     * @var array
     */
    protected array $post;

    public function __construct()
    {
        $this->setRoute();;
        $this->setGet();;
        $this->setPost();;
    }

    /**
     * @return void
     */
    protected function setRoute(): void
    {
        $this->route = strtok($_SERVER['REQUEST_URI'], '?');
    }

    /**
     * @return void
     */
    protected function setGet(): void
    {
        $this->get = [];
        foreach ($_GET as $k => $v) {
            $this->get[$k] = $v;
        }
    }

    /**
     * @return void
     */
    protected function setPost(): void
    {
        $this->post = [];
        foreach ($_POST as $k => $v) {
            $this->get[$k] = $v;
        }
    }

    /**
     * @inheritDoc
     */
    public function get(?string $key = null, mixed $defaultValue = null): mixed
    {
        $params = $this->get;

        if (is_null($key)) {
            return $params;
        }

        return $params[$key] ?? $defaultValue;
    }

    /**
     * @inheritDoc
     */
    public function updateGet(string $key, mixed $value): void
    {
        $this->get[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function post(?string $key = null, mixed $defaultValue = null): mixed
    {
        $params = $this->post;

        if (is_null($key)) {
            return $params;
        }

        return $params[$key] ?? $defaultValue;
    }

    /**
     * @inheritDoc
     */
    public function updatePost(string $key, mixed $value): void
    {
        $this->post[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    /**
     * @inheritDoc
     */
    public function input(?string $key = null, mixed $defaultValue = null): mixed
    {
        $params = $this->all();

        if (is_null($key)) {
            return $params;
        }

        return $params[$key] ?? $defaultValue;
    }

    /**
     * @inheritDoc
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Request\InvalidRequestMethodException
     */
    public function getMethod(): string
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (!in_array($method, self::METHODS)) {
            throw new InvalidRequestMethodException($method);
        }
        return $method;
    }
}
