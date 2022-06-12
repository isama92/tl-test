<?php

namespace App\Components\CsvHandler\UseCases;

use App\Contracts\UseCaseContract;
use App\Core\Container\ContainerInterface;

abstract class CsvHandlerUseCaseAbstract implements UseCaseContract
{
    /**
     * @const Where csv files are stored
     */
    const STORAGE_CSV_DIR = 'csv/';

    /**
     * @const Csv separator
     */
    const CSV_SEPARATOR = ';';

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
     * @return \App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory
     */
    abstract protected function createCollaboratorsFactory(): CsvHandlerUseCaseCollaboratorsFactory;
}
