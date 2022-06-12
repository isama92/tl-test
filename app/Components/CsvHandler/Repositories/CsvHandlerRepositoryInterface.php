<?php

namespace App\Components\CsvHandler\Repositories;

use App\Components\CsvHandler\Domains\CsvRowInterface;
use App\Repositories\AffectedRowsInterface;

interface CsvHandlerRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Components\CsvHandler\Domains\CsvRowInterface|null
     */
    public function findById(int $id): ?CsvRowInterface;

    /**
     * @param int                                                $id
     * @param \App\Components\CsvHandler\Domains\CsvRowInterface $newCsvRow
     *
     * @return \App\Repositories\AffectedRowsInterface
     */
    public function upsertCsvRow(int $id, CsvRowInterface $newCsvRow): AffectedRowsInterface;
}
