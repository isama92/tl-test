<?php

namespace App\Components\App;

use App\Components\Container\ContainerInterface;

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
     * @return \App\Components\Container\ContainerInterface
     */
    public function container(): ContainerInterface;
}
