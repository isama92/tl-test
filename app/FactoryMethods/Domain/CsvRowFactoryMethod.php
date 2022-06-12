<?php

namespace App\FactoryMethods\Domain;

use App\Components\CsvHandler\Domains\CsvRow;
use App\Components\CsvHandler\Domains\CsvRowInterface;

trait CsvRowFactoryMethod
{
    /**
     * @param string   $author
     * @param string   $title
     * @param int|null $id
     *
     * @return \App\Components\CsvHandler\Domains\CsvRowInterface
     */
    public function createCsvRow(string $author, string $title, ?int $id): CsvRowInterface
    {
        return new CsvRow($author, $title, $id);
    }
}
