<?php

namespace App\Components\CsvHandler\UseCases\ImportCsvInDb;

use App\Components\CsvHandler\Repositories\CsvHandlerRepository;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\FactoryMethods\Domain\CsvRowFactoryMethod;
use App\FactoryMethods\Helper\ParserHelperFactoryMethod;
use App\FactoryMethods\Repository\AffectedRowsFactoryMethod;

class CollaboratorsFactory extends CsvHandlerUseCaseCollaboratorsFactory
{
    use ParserHelperFactoryMethod;
    use CsvRowFactoryMethod;
    use AffectedRowsFactoryMethod;

    /**
     * @return \App\Components\CsvHandler\Repositories\CsvHandlerRepository
     */
    public function createCsvHandlerRepository(): CsvHandlerRepository
    {
        return new CsvHandlerRepository($this->container);
    }
}
