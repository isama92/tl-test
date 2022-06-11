<?php

namespace App\Components\Container;

use App\Components\Config\ConfigInterface;

interface ContainerInterface
{
    /**
     * @return \App\Components\Config\ConfigInterface
     */
    public function config(): ConfigInterface;
}
