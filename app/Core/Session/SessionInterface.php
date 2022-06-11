<?php

namespace App\Core\Session;

interface SessionInterface
{
    /**
     * @return void
     */
    public function start(): void;

    /**
     * @return void
     */
    public function stop(): void;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function get(string $name, mixed $defaultValue): mixed;

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $name, mixed $value): void;

    /**
     * @param string $name
     *
     * @return void
     */
    public function remove(string $name): void;
}
