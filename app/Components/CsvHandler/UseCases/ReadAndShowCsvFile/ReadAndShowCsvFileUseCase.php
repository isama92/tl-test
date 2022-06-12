<?php

namespace App\Components\CsvHandler\UseCases\ReadAndShowCsvFile;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\Exceptions\Csv\CsvFileNotFoundException;
use App\Presenters\Presenter;

class ReadAndShowCsvFileUseCase extends CsvHandlerUseCaseAbstract
{
    /**
     * @inheritDoc
     * @throws \App\Exceptions\Csv\CsvFileNotFoundException
     */
    public function execute(array $requestData = []): Presenter
    {
        $storage = $this->container->storage();
        $csvFiles = $storage->list(self::STORAGE_CSV_DIR);

        $activeFileName = $this->container->request()->get(self::QUERY_STRING_FILE_NAME);

        // file content as text
        $activeFileContent = '';

        // file content as array
        $activeFileHeaders = [];
        $activeFileArray = [];

        // if a file name is passed in query string
        if(!is_null($activeFileName)) {

            // if file do not exist
            if(!in_array($activeFileName, $csvFiles)) {
                throw new CsvFileNotFoundException($activeFileName);
            }

            $activeFilePath = self::STORAGE_CSV_DIR . $activeFileName;
            $activeFileContent = $storage->get($activeFilePath);
            $activeFileArray = $storage->getCsv($activeFilePath, ';');

            // if it has at least one line then get headers
            if(count($activeFileArray) > 0) {
                $activeFileHeaders = array_keys($activeFileArray[0]);
            }
        }

        $html = $this->container->renderer()->render('csv/index.twig', [
            'queryStringFileName' => self::QUERY_STRING_FILE_NAME,
            'filesList' => $csvFiles,
            'activeFileName' => $activeFileName,
            'activeFileContent' => $activeFileContent,
            'activeFileArray' => $activeFileArray,
            'activeFileHeaders' => $activeFileHeaders,
        ]);

        return $this->createCollaboratorsFactory()
            ->createHtmlPresenter($html);
    }

    /**
     * @return \App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory
     */
    protected function createCollaboratorsFactory(): CsvHandlerUseCaseCollaboratorsFactory
    {
        return new CollaboratorsFactory();
    }
}
