<?php

namespace App\Core\Config;

use App\Core\CoreAbstract;
use App\Exceptions\Config\ConfigNotFoundException;

class Config extends CoreAbstract implements ConfigInterface
{
    /**
     * @var string Path to the config directory
     */
    protected string $configDirPath;

    /**
     * @var mixed[] Config values
     */
    protected array $configs;

    /**
     * @param string $configDirPath
     */
    public function __construct(string $configDirPath)
    {
        $this->configDirPath = $configDirPath;
        $this->configs = $this->readConfigs();
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Config\ConfigNotFoundException
     */
    public function get(string $path): mixed
    {
        $keys = explode('.', $path);

        $config = $this->configs;
        do {
            $key = array_shift($keys);

            if (!array_key_exists($key, $config)) {
                throw new ConfigNotFoundException($path);
            }

            $config = $config[$key];
        } while (count($keys));

        return $config;
    }

    /**
     * Read config files from the config directory
     *
     * @return mixed[]
     */
    protected function readConfigs(): array
    {
        // read file names
        $excludeFiles = ['.', '..'];

        /**
         * @var string[] $files
         */
        $files = scandir($this->configDirPath);
        $files = $files ?: [];
        $files = array_filter($files, function ($f) use ($excludeFiles) {
            return !in_array($f, $excludeFiles);
        });
        $files = array_values($files);

        // get configs from files
        $configs = [];
        foreach ($files as $f) {
            $key = str_replace('.php', '', $f);
            $configs[$key] = require($this->configDirPath . $f);
        }

        return $configs;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Config\ConfigNotFoundException
     */
    public function isLocal(): bool
    {
        return $this->get('app.environment') === self::ENV_LOCAL;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Config\ConfigNotFoundException
     */
    public function isStaging(): bool
    {
        return $this->get('app.environment') === self::ENV_STAGING;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Config\ConfigNotFoundException
     */
    public function isProduction(): bool
    {
        return $this->get('app.environment') === self::ENV_PRODUCTION;
    }
}
