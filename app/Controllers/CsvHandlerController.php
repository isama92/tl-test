<?php

namespace App\Controllers;

use App\Components\CsvHandler\CsvHandlerComponent;
use App\Presenters\PresenterInterface;

class CsvHandlerController extends Controller
{
    /**
     * @return \App\Presenters\PresenterInterface
     */
    public function index(): PresenterInterface
    {
        return (new CsvHandlerComponent($this->container))
            ->readAndShowCsvFile();
    }

    /**
     * @return \App\Presenters\PresenterInterface
     */
    public function import(): PresenterInterface
    {
        return (new CsvHandlerComponent($this->container))
            ->importCsvInDb();
    }

    /**
     * @return \App\Presenters\PresenterInterface
     */
    public function db(): PresenterInterface
    {
        return (new CsvHandlerComponent($this->container))
            ->showFromDb();
    }
}
