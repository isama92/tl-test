<?php

namespace App\Components\CsvHandler;

use App\Presenters\Presenter;

interface CsvHandlerComponentInterface
{
    /**
     * @return \App\Presenters\Presenter
     */
    public function readAndShowCsvFile(): Presenter;
}
