<?php

namespace App\Components\CsvHandler\UseCases;

use App\Components\CsvHandler\UseCases\ReadAndShowCsvFile\ReadAndShowCsvFileUseCase;
use App\Contracts\UseCaseContract;
use App\Contracts\UseCaseFactoryContract;
use App\Core\Container\ContainerInterface;

class CsvHandlerUseCaseFactory implements UseCaseFactoryContract
{
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

    /**
     * @return \App\Contracts\UseCaseContract
     */
    public function makeReadAndShowCsvFile(): UseCaseContract
    {
        return new ReadAndShowCsvFileUseCase($this->container);
    }
}
