<?php

namespace App\Core\Container;

use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;

interface ContainerInterface
{
    /**
     * @return \App\Core\Config\ConfigInterface
     */
    public function config(): ConfigInterface;

    /**
     * @return \App\Core\Db\DbInterface
     */
    public function db(): DbInterface;
}
