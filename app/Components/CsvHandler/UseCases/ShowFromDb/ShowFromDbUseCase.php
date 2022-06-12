<?php

namespace App\Components\CsvHandler\UseCases\ShowFromDb;

use App\Components\CsvHandler\UseCases\CsvHandlerUseCaseAbstract;
use App\Presenters\PresenterInterface;

class ShowFromDbUseCase extends CsvHandlerUseCaseAbstract
{
    /**
     * @inheritDoc
     */
    public function execute(array $requestData = []): PresenterInterface
    {
        $collabFactory = $this->createCollaboratorsFactory();

        $repo = $collabFactory->createCsvHandlerRepository();

        $csvRows = $repo->all();

        $tableRows = array_map(function($el) {
            return $el->toArray();
        }, $csvRows);

        $tableHeaders = [];
        if(count($tableRows) > 0) {
            $tableHeaders = array_keys($tableRows[0]);
        }

        return $collabFactory->createHtmlPresenter(
            $this->container->renderer()->render('csv/db.twig', [
                'tableArrayRows' => $tableRows,
                'tableArrayHeaders' => $tableHeaders,
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
