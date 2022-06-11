<?php

namespace App\FactoryMethods\Config;

use App\Core\Config\Config;
use App\Core\Config\ConfigInterface;

trait ConfigFactoryMethod
{
    /**
     * @param string $configDirPath
     *
     * @return \App\Core\Config\ConfigInterface
     */
    protected function createConfig(string $configDirPath): ConfigInterface
    {
        return new Config($configDirPath);
    }
}
