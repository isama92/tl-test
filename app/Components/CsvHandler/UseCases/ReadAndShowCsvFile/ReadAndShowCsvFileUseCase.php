<?php

namespace App\Components\CsvHandler\UseCases\ReadAndShowCsvFile;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Exceptions\Csv\CsvFileNotFoundException;
use App\Presenters\PresenterInterface;

class ReadAndShowCsvFileUseCase extends CsvHandlerUseCaseAbstract
{
    /**
     * @inheritDoc
     * @throws \App\Exceptions\Csv\CsvFileNotFoundException
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $collabFactory = $this->createCollaboratorsFactory();
        $storage = $this->container->storage();
        $parserHelper = $collabFactory->createParserHelper();
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

        return $collabFactory->createHtmlPresenter(
                $this->container->renderer()->render('csv/index.twig', [
                    'queryStringFileName' => self::QUERY_STRING_FILE_NAME,
                    'fieldTextAreaName' => self::CONTENT_TEXTAREA_NAME,
                    'filesList' => $csvFiles,
                    'listActiveCsv' => $activeFileName,
                    'textareaCsvContent' => $activeFileContent,
                    'tableArrayRows' => $activeFileArray,
                    'tableArrayHeaders' => $activeFileHeaders,
                ])
            );
    }

    /**
     * @inheritDoc
     */
    protected function createCollaboratorsFactory(): CollaboratorsFactory
    {
        return new CollaboratorsFactory($this->container);
    }
}
