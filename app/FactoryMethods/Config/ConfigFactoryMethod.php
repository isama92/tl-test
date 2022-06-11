<?php

namespace App\FactoryMethods\Config;

use App\Components\Config\Config;
use App\Components\Config\ConfigInterface;

trait ConfigFactoryMethod
{
    /**
     * @param string $configDirPath
     *
     * @return \App\Components\Config\ConfigInterface
     */
    protected function createConfig(string $configDirPath): ConfigInterface
    {
        return new Config($configDirPath);
    }
}
