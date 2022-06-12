<?php

namespace App\Components\CsvHandler\UseCases\ImportCsvInDb;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Presenters\PresenterInterface;

class ImportCsvInDbUseCase extends CsvHandlerUseCaseAbstract
{
    public const CSV_HEADER_ID = 'id';
    public const CSV_HEADER_AUTHOR = 'author';
    public const CSV_HEADER_TITLE = 'title';

    /**
     * @const CSV headers must be equals to these
     */
    public const CSV_HEADERS = [self::CSV_HEADER_ID, self::CSV_HEADER_AUTHOR, self::CSV_HEADER_TITLE];

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Response\InvalidStatusCodeException
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $csvString = $this->container->request()->post(self::CONTENT_TEXTAREA_NAME, '');

        $collabFactory = $this->createCollaboratorsFactory();

        $repo = $collabFactory->createCsvHandlerRepository();
        $storage = $this->container->storage();
        $parserHelper = $collabFactory->createParserHelper();
        $affectedRows = $collabFactory->createAffectedRows();

        $csvFiles = $storage->list(self::STORAGE_CSV_DIR);

        $csvArray = [];
        if (is_string($csvString)) {
            $csvArray = $parserHelper->csvToArray($csvString, self::CSV_SEPARATOR);
        }

        if (!count($csvArray)) {
            $errMsg = "Invalid CSV";
            return $this->handleCsvError($collabFactory, $csvFiles, $csvString, $errMsg);
        }

        // validate headers

        $headers = array_keys($csvArray[0]);
        $headersDiff = array_diff($headers, self::CSV_HEADERS);
        if (count($headersDiff)) {
            $headersDiff = array_map(function ($el) {
                return "'{$el}'";
            }, $headersDiff);
            $headersDiffStr = implode(', ', $headersDiff);
            $errMsg = "Invalid headers: {$headersDiffStr}";
            return $this->handleCsvError($collabFactory, $csvFiles, $csvString, $errMsg);
        }

        // TODO: validate csv headers and content: it must be a string and have 3 cols with the given headers

        foreach ($csvArray as $csvArrayRow) {
            $csvRow = $collabFactory->createCsvRow(
                $csvArrayRow[self::CSV_HEADER_AUTHOR],
                $csvArrayRow[self::CSV_HEADER_TITLE],
                $csvArrayRow[self::CSV_HEADER_ID],
            );
            $queryAffectedRows = $repo->upsertCsvRow($csvRow->getId(), $csvRow);
            $affectedRows->sum($queryAffectedRows);
        }

        return $collabFactory->createHtmlPresenter(
            $this->container->renderer()->render('csv/import.twig', [
                'queryStringFileName' => self::QUERY_STRING_FILE_NAME,
                'fieldTextAreaName' => self::CONTENT_TEXTAREA_NAME,
                'filesList' => $csvFiles,
                'affectedRows' => $affectedRows,
                'textareaCsvContent' => $csvString,
            ])
        );
    }

    protected function handleCsvError(
        CollaboratorsFactory $collabFactory,
        array $csvFiles,
        string $oldValue,
        string $error
    ): PresenterInterface {
        $activeFileName = $this->container->request()->get(self::QUERY_STRING_FILE_NAME);

        return $collabFactory->createHtmlPresenter(
            $this->container->renderer()->render('csv/index.twig', [
                'queryStringFileName' => self::QUERY_STRING_FILE_NAME,
                'fieldTextAreaName' => self::CONTENT_TEXTAREA_NAME,
                'filesList' => $csvFiles,
                'listActiveCsv' => $activeFileName,
                'textareaCsvContent' => $oldValue,
                'error' => $error,
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
