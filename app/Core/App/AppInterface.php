<?php

namespace App\Core\App;

use App\Core\Container\ContainerInterface;

interface AppInterface
{
    /**
     * @return \App\Core\Container\ContainerInterface
     */
    public function container(): ContainerInterface;

    /**
     * @return void
     */
    public function run(): void;

    /**
     * @return void
     */
    public function terminate(): void;
}
