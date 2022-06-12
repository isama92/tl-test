<?php

namespace App\Components\CsvHandler;

use App\Presenters\PresenterInterface;

interface CsvHandlerComponentInterface
{
    /**
     * @return \App\Presenters\Presenter
     */
    public function readAndShowCsvFile(): PresenterInterface;
}
