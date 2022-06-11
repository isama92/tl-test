<?php

namespace App\Core\Config;

interface ConfigInterface
{
    /**
     * Returns the config value based on its path (file . array_key_1 . array_key_n)
     *
     * @param string $path
     *
     * @return mixed
     */
    public function get(string $path): mixed;
}
