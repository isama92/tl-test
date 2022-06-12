<?php

namespace App\Components\CsvHandler\UseCases\ImportCsvInDb;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseCollaboratorsFactory;
use App\Presenters\PresenterInterface;

class ImportCsvInDbUseCase extends CsvHandlerUseCaseAbstract
{
    const CONTENT_TEXTAREA_NAME = 'content';
    /**
     * @inheritDoc
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $csvString = $this->container->request()->post(self::CONTENT_TEXTAREA_NAME);
        $parserHelper = $this->createCollaboratorsFactory()->createParserHelper();

        $csvArray = $parserHelper->csvToArray($csvString, self::CSV_SEPARATOR);
        dd($csvArray);

        // TODO: validate csv
        // TODO: parse CSV - D'OH

        $html = '';
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
