<?php

namespace App\Components\CsvHandler;

use App\Presenters\PresenterInterface;

interface CsvHandlerComponentInterface
{
    /**
     * @return \App\Presenters\Presenter
     */
    public function readAndShowCsvFile(): PresenterInterface;

    /**
     * @return \App\Presenters\Presenter
     */
    public function importCsvInDb(): PresenterInterface;

    /**
     * @return \App\Presenters\Presenter
     */
    public function showFromDb(): PresenterInterface;
}
