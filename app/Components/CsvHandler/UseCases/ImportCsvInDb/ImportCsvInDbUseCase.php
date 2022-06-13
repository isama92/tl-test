<?php

namespace App\Components\CsvHandler\UseCases\ImportCsvInDb;

use App\Components\CsvHandler\CsvHandlerComponentInterface;
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
        $csvString = $this->container->request()->post(CsvHandlerComponentInterface::CONTENT_TEXTAREA_NAME, '');

        $collabFactory = $this->createCollaboratorsFactory();

        $repo = $collabFactory->createCsvHandlerRepository();
        $storage = $this->container->storage();
        $parserHelper = $collabFactory->createParserHelper();
        $affectedRows = $collabFactory->createAffectedRows();

        $csvFiles = $storage->list(CsvHandlerComponentInterface::STORAGE_CSV_DIR);

        // csv string to array

        $csvArray = [];
        if (is_string($csvString)) {
            $csvArray = $parserHelper->csvToArray($csvString, CsvHandlerComponentInterface::CSV_SEPARATOR);
        }

        // if csv array is empty then is not valid

        if (!count($csvArray)) {
            $errMsg = "Invalid CSV";
            return $this->handleCsvError($collabFactory, $csvFiles, $csvString, $errMsg);
        }

        // validate id column

        $ids = array_column($csvArray, self::CSV_HEADER_ID);
        $notIntIds = array_filter($ids, function ($el) {
            return $el !== ((string)(int)$el);
        });

        if (count($notIntIds)) {
            $notIntIdsKeys = array_keys($notIntIds);
            $notIntIdsKeys = array_map(function ($el) {
                return $el + 2;
            }, $notIntIdsKeys);
            $notIntIdsKeysStr = implode(', ', $notIntIdsKeys);
            $errMsg = "All id values must be of type integer, check the following lines: {$notIntIdsKeysStr}";
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

        // write to db

        foreach ($csvArray as $csvArrayRow) {
            $csvRow = $collabFactory->createCsvRow(
                $csvArrayRow[self::CSV_HEADER_AUTHOR],
                $csvArrayRow[self::CSV_HEADER_TITLE],
                $csvArrayRow[self::CSV_HEADER_ID],
            );
            $queryAffectedRows = $repo->upsertCsvRow($csvRow->getId(), $csvRow);
            $affectedRows->sum($queryAffectedRows);
        }

        // output

        return $collabFactory->createHtmlPresenter(
            $this->container->renderer()->render('csv/import.twig', [
                'queryStringFileName' => CsvHandlerComponentInterface::QUERY_STRING_FILE_NAME,
                'fieldTextAreaName' => CsvHandlerComponentInterface::CONTENT_TEXTAREA_NAME,
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
        $activeFileName = $this->container->request()->get(CsvHandlerComponentInterface::QUERY_STRING_FILE_NAME);

        return $collabFactory->createHtmlPresenter(
            $this->container->renderer()->render('csv/index.twig', [
                'queryStringFileName' => CsvHandlerComponentInterface::QUERY_STRING_FILE_NAME,
                'fieldTextAreaName' => CsvHandlerComponentInterface::CONTENT_TEXTAREA_NAME,
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
