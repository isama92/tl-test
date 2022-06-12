<?php

namespace App\Exceptions\Csv;

use App\Core\Response\ResponseInterface;
use App\Exceptions\ExceptionAbstract;

class CsvFileNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $file
     */
    public function __construct(string $file)
    {
        parent::__construct("There are no CSV files named '{$file}'");
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return ResponseInterface::HTTP_STATUS_CODE_NOT_FOUND;
    }
}
