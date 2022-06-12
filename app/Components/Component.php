<?php

namespace App\Components;

use App\Contracts\UseCaseFactoryContract;
use App\Core\Container\ContainerInterface;

abstract class Component
{
    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @var \App\Contracts\UseCaseFactoryContract
     */
    protected UseCaseFactoryContract $useCaseFactory;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->useCaseFactory = $this->createUseCaseFactory();
    }

    /**
     * @return \App\Contracts\UseCaseFactoryContract
     */
    abstract protected function createUseCaseFactory(): UseCaseFactoryContract;
}
