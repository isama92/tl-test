<?php

namespace App\Core\Container;

use App\Core\Config\ConfigInterface;
use App\Core\Db\DbInterface;
use App\Core\Router\RouterInterface;

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

    /**
     * @return \App\Core\Router\RouterInterface
     */
    public function router(): RouterInterface;
}
