<?php

namespace App\Components\CsvHandler\UseCases;

use App\Contracts\UseCaseContract;
use App\Core\Container\ContainerInterface;

abstract class CsvHandlerUseCaseAbstract implements UseCaseContract
{
    /**
     * @const Where csv files are stored
     */
    public const STORAGE_CSV_DIR = 'csv/';

    /**
     * @const Csv separator
     */
    public const CSV_SEPARATOR = ';';

    /**
     * @const Name of the query string parameter where the file name is passed
     */
    public const QUERY_STRING_FILE_NAME = 'file';

    /**
     * Name of the textarea field that contains the CSV string
     */
    public const CONTENT_TEXTAREA_NAME = 'content';

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
