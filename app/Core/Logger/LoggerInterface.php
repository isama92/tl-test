<?php

namespace App\Core\Logger;

interface LoggerInterface
{
    const LOG_LEVEL_EMERGENCY = 'EMERGENCY';
    const LOG_LEVEL_ALERT = 'ALERT';
    const LOG_LEVEL_CRITICAL = 'CRITICAL';
    const LOG_LEVEL_ERROR = 'ERROR';
    const LOG_LEVEL_WARNING = 'WARNING';
    const LOG_LEVEL_NOTICE = 'NOTICE';
    const LOG_LEVEL_INFO = 'INFO';
    const LOG_LEVEL_DEBUG = 'DEBUG';

    /**
     * @const Log levels ordered by importance
     */
    const LOG_LEVELS = [
        0 => self::LOG_LEVEL_EMERGENCY,
        2 => self::LOG_LEVEL_ALERT,
        3 => self::LOG_LEVEL_CRITICAL,
        4 => self::LOG_LEVEL_ERROR,
        5 => self::LOG_LEVEL_WARNING,
        6 => self::LOG_LEVEL_NOTICE,
        7 => self::LOG_LEVEL_INFO,
        8 => self::LOG_LEVEL_DEBUG,
    ];

    /**
     * @param string $message
     *
     * @return void
     */
    public function emergency(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function alert(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function critical(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function error(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function warning(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function notice(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function info(string $message): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function debug(string $message): void;
}
