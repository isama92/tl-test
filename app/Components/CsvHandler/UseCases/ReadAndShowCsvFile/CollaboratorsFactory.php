<?php

namespace App\Components\CsvHandler\UseCases\ReadAndShowCsvFile;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\FactoryMethods\Helper\ParserHelperFactoryMethod;

class CollaboratorsFactory extends CsvHandlerUseCaseCollaboratorsFactory
{
    use ParserHelperFactoryMethod;
}
