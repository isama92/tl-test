<?php

namespace App\Components\CsvHandler;

use App\Components\Component;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseFactory;
use App\Contracts\UseCaseFactoryContract;
use App\Presenters\Presenter;

class CsvHandlerComponent extends Component implements CsvHandlerComponentInterface
{
    /**
     * @inheritDoc
     */
    public function readAndShowCsvFile(): Presenter
    {
        return $this->useCaseFactory->makeReadAndShowCsvFile()
            ->execute();
    }

    /**
     * @return \App\Contracts\UseCaseFactoryContract
     */
    protected function createUseCaseFactory(): UseCaseFactoryContract
    {
        return new CsvHandlerUseCaseFactory($this->container);
    }
}
