<?php

namespace App\Core\Session;

use App\Core\CoreAbstract;

class Session extends CoreAbstract implements SessionInterface
{
    /**
     * @inheritDoc
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * @inheritDoc
     */
    public function stop(): void
    {
        session_destroy();
    }

    /**
     * @inheritDoc
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $_SESSION);
    }

    /**
     * @inheritDoc
     */
    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $_SESSION[$name] ?? $defaultValue;
    }

    /**
     * @inheritDoc
     */
    public function set(string $name, mixed $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $name): void
    {
        unset($_SESSION[$name]);
    }
}
