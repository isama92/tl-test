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
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $csvString = $this->container->request()->post(self::CONTENT_TEXTAREA_NAME);

        $collFactory = $this->createCollaboratorsFactory();

        $repo = $collFactory->createCsvHandlerRepository();
        $storage = $this->container->storage();
        $parserHelper = $collFactory->createParserHelper();

        $csvFiles = $storage->list(self::STORAGE_CSV_DIR);

        $csvArray = [];
        if(is_string($csvString)) {
            $csvArray = $parserHelper->csvToArray($csvString, self::CSV_SEPARATOR);
        }


        // TODO: validate csv headers and content: it must be a string and have 3 cols with the given headers

        $affectedRows = $collFactory->createAffectedRows();
        foreach ($csvArray as $csvArrayRow) {
            $csvRow = $collFactory->createCsvRow(
                $csvArrayRow[self::CSV_HEADER_AUTHOR],
                $csvArrayRow[self::CSV_HEADER_TITLE],
                $csvArrayRow[self::CSV_HEADER_ID],
            );
            $queryAffectedRows = $repo->upsertCsvRow($csvRow->getId(), $csvRow);
            $affectedRows->sum($queryAffectedRows);
        }

        $html = $this->container->renderer()->render('csv/import.twig', [
            'queryStringFileName' => self::QUERY_STRING_FILE_NAME,
            'fieldTextAreaName' => self::CONTENT_TEXTAREA_NAME,
            'filesList' => $csvFiles,
            'affectedRows' => $affectedRows,
        ]);

        return $collFactory->createHtmlPresenter($html);
    }

    /**
     * @inheritDoc
     */
    protected function createCollaboratorsFactory(): CollaboratorsFactory
    {
        return new CollaboratorsFactory($this->container);
    }
}
