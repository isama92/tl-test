<?php

namespace App\Components\CsvHandler\UseCases\ImportCsvInDb;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\FactoryMethods\Helpers\ParserHelperFactoryMethod;

class CollaboratorsFactory extends CsvHandlerUseCaseCollaboratorsFactory
{
    use ParserHelperFactoryMethod;
}
