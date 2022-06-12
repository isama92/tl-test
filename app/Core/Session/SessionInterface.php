<?php

namespace App\Core\Session;

interface SessionInterface
{
    public const SESSION_CSRF_TOKEN_KEY = '_token';
    public const CSRF_TOKEN_LENGTH = 40;

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
     * @param string     $name
     * @param mixed|null $defaultValue
     *
     * @return mixed
     */
    public function get(string $name, mixed $defaultValue = null): mixed;

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

    /**
     * Get CSRF token
     *
     * @return string
     */
    public function token(): string;

    /**
     * Generate CSRF token
     *
     * @return void
     */
    public function regenerateToken(): void;

    /**
     * @return bool
     */
    public function hasStarted(): bool;
}
