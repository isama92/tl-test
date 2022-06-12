<?php

namespace App\Core\Logger;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;
use App\Exceptions\Logger\InvalidLogLevelException;

class Logger extends CoreAbstract implements LoggerInterface
{
    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @var string
     */
    protected string $loggingPath;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->loggingPath = $container->config()->get('logger.path');
    }

    /**
     * @param string $level
     * @param string $message
     *
     * @return void
     * @throws \App\Exceptions\Logger\InvalidLogLevelException
     */
    protected function write(string $level, string $message): void
    {
        if (!in_array($level, self::LOG_LEVELS)) {
            throw new InvalidLogLevelException($level);
        }

        $message = $this->formatter($message);

        $this->container->storage()->append($this->loggingPath, $message);
    }

    /**
     * @param string $message
     *
     * @return string
     */
    protected function formatter(string $message): string
    {
        $now = date('Y-m-d H:i:s');
        return "[{$now}] {$message}" . PHP_EOL;
    }

    /**
     * @inheritDoc
     */
    public function emergency(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function alert(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function critical(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function error(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function warning(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function notice(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function info(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }

    /**
     * @inheritDoc
     */
    public function debug(string $message): void
    {
        $level = strtoupper(__FUNCTION__);
        $this->write($level, $message);
    }
}
