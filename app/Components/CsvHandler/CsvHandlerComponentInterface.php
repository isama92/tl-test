<?php

namespace App\Components\CsvHandler;

use App\Presenters\PresenterInterface;

interface CsvHandlerComponentInterface
{
    /**
     * @const Where csv files are stored
     */
    public const STORAGE_CSV_DIR = 'csv/';

    /**
     * @const Csv separator
     */
    public const CSV_SEPARATOR = ';';

    /**
     * @const Name of the query string parameter where the file name is passed
     */
    public const QUERY_STRING_FILE_NAME = 'file';

    /**
     * Name of the textarea field that contains the CSV string
     */
    public const CONTENT_TEXTAREA_NAME = 'content';

    /**
     * @return \App\Presenters\Presenter
     */
    public function readAndShowCsvFile(): PresenterInterface;

    /**
     * @return \App\Presenters\Presenter
     */
    public function importCsvInDb(): PresenterInterface;

    /**
     * @return \App\Presenters\Presenter
     */
    public function showFromDb(): PresenterInterface;
}
