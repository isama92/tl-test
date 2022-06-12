<?php

namespace App\Components\CsvHandler\UseCases;

use App\Components\CsvHandler\UseCases\ImportCsvInDb\ImportCsvInDbUseCase;
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
     * @return \App\Components\CsvHandler\UseCases\ReadAndShowCsvFile\ReadAndShowCsvFileUseCase
     */
    public function makeReadAndShowCsvFile(): ReadAndShowCsvFileUseCase
    {
        return new ReadAndShowCsvFileUseCase($this->container);
    }

    /**
     * @return \App\Components\CsvHandler\UseCases\ImportCsvInDb\ImportCsvInDbUseCase
     */
    public function makeImportCsvInDb(): ImportCsvInDbUseCase
    {
        return new ImportCsvInDbUseCase($this->container);
    }
}
