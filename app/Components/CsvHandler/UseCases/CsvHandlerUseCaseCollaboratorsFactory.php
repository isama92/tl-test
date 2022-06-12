<?php

namespace App\Components\CsvHandler\UseCases;

use App\Contracts\UseCaseCollaboratorsFactoryContract;
use App\FactoryMethods\Presenter\PresenterFactoryMethod;

abstract class CsvHandlerUseCaseCollaboratorsFactory implements UseCaseCollaboratorsFactoryContract
{
    use PresenterFactoryMethod;
}
