<?php

namespace App\Middlewares;

use App\Core\Request\RequestInterface;

abstract class TransformMiddleware extends Middleware
{
    /**
     * Fields to skip
     *
     * @var string[]
     */
    protected array $except = [];

    /**
     * @inheritDoc
     */
    protected function handle(RequestInterface $request): RequestInterface
    {
        $getParams = $request->get();
        $postParams = $request->post();

        foreach ($getParams as $k => $v) {
            if (in_array($k, $this->except)) {
                continue;
            }
            $newVal = $this->transform($k, $v);
            $request->updateGet($k, $newVal);
        }

        foreach ($postParams as $k => $v) {
            if (in_array($k, $this->except)) {
                continue;
            }
            $newVal = $this->transform($k, $v);
            $request->updatePost($k, $newVal);
        }

        return $request;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    abstract protected function transform(string $key, mixed $value): mixed;
}
