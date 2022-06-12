<?php

namespace App\Controllers;

use App\Exceptions\Csv\CsvFileNotFoundException;

class CsvController extends Controller
{
    /**
     * @return string
     * @throws \App\Exceptions\Csv\CsvFileNotFoundException
     */
    public function index(): string
    {
        $csvPath = 'csv/';
        $storage = $this->container->storage();
        $csvFiles = $storage->list($csvPath);

        $activeFileName = $this->container->request()->get('file');
        $activeFileContent = '';
        $activeFileArray = [];
        $activeFileHeaders = [];

        if(!is_null($activeFileName) && !in_array($activeFileName, $csvFiles)) {
            throw new CsvFileNotFoundException($activeFileName);
        }

        if(!is_null($activeFileName)) {
            $activeFilePath = $csvPath . $activeFileName;
            $activeFileContent = $storage->get($activeFilePath);
            $activeFileArray = $storage->getCsv($activeFilePath, ';');
            if(count($activeFileArray) > 0) {
                $activeFileHeaders = array_keys($activeFileArray[0]);
            }
        }

        return $this->container->renderer()->render('csv/index.twig', [
            'files' => $csvFiles,
            'activeFileName' => $activeFileName,
            'activeFileContent' => $activeFileContent,
            'activeFileArray' => $activeFileArray,
            'activeFileHeaders' => $activeFileHeaders,
        ]);
    }

    public function import()
    {
        dd($this->container->request()->all());
    }
}
