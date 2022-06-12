<?php

namespace App\Components\CsvHandler\UseCases;

use App\Contracts\UseCaseCollaboratorsFactoryContract;
use App\Core\Container\ContainerInterface;
use App\FactoryMethods\Presenter\PresenterFactoryMethod;

abstract class CsvHandlerUseCaseCollaboratorsFactory implements UseCaseCollaboratorsFactoryContract
{
    use PresenterFactoryMethod;

    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
