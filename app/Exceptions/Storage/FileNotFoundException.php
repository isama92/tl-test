<?php

namespace App\Exceptions\Storage;

use App\Exceptions\ExceptionAbstract;

class FileNotFoundException extends ExceptionAbstract
{
    /**
     * @param string $file
     */
    public function __construct(string $file)
    {
        parent::__construct("File '{$file}' not found");
    }
}
