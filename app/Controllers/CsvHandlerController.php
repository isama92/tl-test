<?php

namespace App\Controllers;

use App\Components\CsvHandler\CsvHandlerComponent;
use App\Presenters\PresenterInterface;

class CsvHandlerController extends Controller
{
    public function index(): PresenterInterface
    {
        return (new CsvHandlerComponent($this->container))
            ->readAndShowCsvFile();
    }

    public function import(): PresenterInterface
    {
        $content = $this->container->request()->post('content');
        dd($content);
        // TODO: parse CSV - D'OH
    }
}
