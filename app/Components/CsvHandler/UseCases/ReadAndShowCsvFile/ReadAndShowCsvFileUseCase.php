<?php

namespace App\Components\CsvHandler\UseCases\ReadAndShowCsvFile;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\Exceptions\Csv\CsvFileNotFoundException;
use App\Presenters\PresenterInterface;

class ReadAndShowCsvFileUseCase extends CsvHandlerUseCaseAbstract
{
    /**
     * @const Name of the query string parameter where the file name is passed
     */
    const QUERY_STRING_FILE_NAME = 'file';

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Csv\CsvFileNotFoundException
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $storage = $this->container->storage();
        $parserHelper = $this->createCollaboratorsFactory()->createParserHelper();
        $csvFiles = $storage->list(self::STORAGE_CSV_DIR);

        $activeFileName = $this->container->request()->get(self::QUERY_STRING_FILE_NAME);

        // file content as text
        $activeFileContent = '';

        // file content as array
        $activeFileHeaders = [];
        $activeFileArray = [];

        // if a file name is passed in query string
        if (!is_null($activeFileName)) {
            // if file do not exist
            if (!in_array($activeFileName, $csvFiles)) {
                throw new CsvFileNotFoundException((string)$activeFileName);
            }

            $activeFilePath = self::STORAGE_CSV_DIR . $activeFileName;
            $activeFileContent = $storage->get($activeFilePath);
            $activeFileArray = $parserHelper->csvToArray($activeFileContent, self::CSV_SEPARATOR);

            // if it has at least one line then get headers
            if (count($activeFileArray) > 0) {
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
     * @inheritDoc
     */
    protected function createCollaboratorsFactory(): CsvHandlerUseCaseCollaboratorsFactory
    {
        return new CollaboratorsFactory();
    }
}
