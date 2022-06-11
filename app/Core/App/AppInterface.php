<?php

namespace App\Core\App;

use App\Core\Container\ContainerInterface;

interface AppInterface
{
    /**
     * @return void
     */
    public function run(): void;

    /**
     * @return void
     */
    public function terminate(): void;

    /**
     * @return \App\Core\Container\ContainerInterface
     */
    public function container(): ContainerInterface;
}
