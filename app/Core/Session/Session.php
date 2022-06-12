<?php

namespace App\Core\Session;

use App\Core\CoreAbstract;

class Session extends CoreAbstract implements SessionInterface
{
    /**
     * True if the session is started
     *
     * @var bool
     */
    protected bool $started;

    /**
     * Initialize started value
     */
    public function __construct()
    {
        $this->setStarted(false);
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        session_start();
        if (!$this->has(self::SESSION_CSRF_TOKEN_KEY)) {
            $this->regenerateToken();
        }
        $this->setStarted(true);
    }

    /**
     * @inheritDoc
     */
    public function stop(): void
    {
        if(!$this->hasStarted()) {
            session_destroy();
            $this->setStarted(false);
        }
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

    /**
     * @inheritDoc
     */
    public function token(): string
    {
        return $this->get(self::SESSION_CSRF_TOKEN_KEY);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function regenerateToken(): void
    {
        $bytesToken = random_bytes(self::CSRF_TOKEN_LENGTH);
        $hexToken = bin2hex($bytesToken);
        $this->set(self::SESSION_CSRF_TOKEN_KEY, $hexToken);
    }

    /**
     * @param bool $started
     *
     * @return void
     */
    protected function setStarted(bool $started): void
    {
        $this->started = $started;
    }

    /**
     * @inheritDoc
     */
    public function hasStarted(): bool
    {
        return $this->started;
    }
}
