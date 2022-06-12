<?php

namespace App\Components\CsvHandler\UseCases\ShowFromDb;

use App\Components\CsvHandler\Repositories\CsvHandlerRepository;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;

class CollaboratorsFactory extends CsvHandlerUseCaseCollaboratorsFactory
{
    /**
     * @return \App\Components\CsvHandler\Repositories\CsvHandlerRepository
     */
    public function createCsvHandlerRepository(): CsvHandlerRepository
    {
        return new CsvHandlerRepository($this->container);
    }
}
