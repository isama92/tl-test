<?php

namespace App\Components\Config;

use App\Components\ComponentAbstract;
use App\Exceptions\Config\ConfigNotFoundException;

class Config extends ComponentAbstract implements ConfigInterface
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

        // get configs from files
        $configs = [];
        foreach ($files as $f) {
            $key = str_replace('.php', '', $f);
            $configs[$key] = require($this->configDirPath . $f);
        }

        return $configs;
    }
}
