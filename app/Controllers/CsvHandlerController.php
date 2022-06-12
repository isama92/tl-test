<?php

namespace App\Controllers;

use App\Components\CsvHandler\CsvHandlerComponent;
use App\Presenters\Presenter;

class CsvHandlerController extends Controller
{
    public function index(): Presenter
    {
        return (new CsvHandlerComponent($this->container))
            ->readAndShowCsvFile();
    }

    public function import()
    {
        $content = $this->container->request()->post('content');
        dd($content);
        // TODO: parse CSV - D'OH
    }
}
