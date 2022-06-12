<?php

namespace App\Core\Config;

interface ConfigInterface
{
    public const ENV_LOCAL = 'local';
    public const ENV_STAGING = 'staging';
    public const ENV_PRODUCTION = 'production';
    public const ENVS = [self::ENV_LOCAL, self::ENV_STAGING, self::ENV_PRODUCTION];

    /**
     * Returns the config value based on its path (file . array_key_1 . array_key_n)
     *
     * @param string $path
     *
     * @return mixed
     */
    public function get(string $path): mixed;

    /**
     * @return bool
     */
    public function isLocal(): bool;

    /**
     * @return bool
     */
    public function isStaging(): bool;

    /**
     * @return bool
     */
    public function isProduction(): bool;
}
