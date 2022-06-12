<?php

namespace App\Components\CsvHandler;

use App\Components\Component;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseFactory;
use App\Contracts\UseCaseFactoryContract;
use App\Presenters\PresenterInterface;

class CsvHandlerComponent extends Component implements CsvHandlerComponentInterface
{
    /**
     * @inheritDoc
     */
    public function readAndShowCsvFile(): PresenterInterface
    {
        return $this->useCaseFactory->makeReadAndShowCsvFile()
            ->execute();
    }

    /**
     * @inheritDoc
     */
    public function importCsvInDb(): PresenterInterface
    {
        return $this->useCaseFactory->makeImportCsvInDb()
            ->execute();
    }

    /**
     * @inheritDoc
     */
    public function showFromDb(): PresenterInterface
    {
        return $this->useCaseFactory->makeShowFromDb()
            ->execute();
    }

    /**
     * @return \App\Components\CsvHandler\UseCases\CsvHandlerUseCaseFactory
     */
    protected function createUseCaseFactory(): CsvHandlerUseCaseFactory
    {
        return new CsvHandlerUseCaseFactory($this->container);
    }
}
