<?php

namespace App\Components\CsvHandler\Domains;

interface CsvRowInterface
{
    /**
     * @const DB ID key
     */
    public const ID = 'thing_id';

    /**
     * @const DB AUTHOR key
     */
    public const AUTHOR = 'thing_name';

    /**
     * @const DB TITLE key
     */
    public const TITLE = 'thing_title';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Data ready for DB
     *
     * @return array
     */
    public function getAllValues(): array;
}
