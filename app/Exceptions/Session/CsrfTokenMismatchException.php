<?php

namespace App\Exceptions\Session;

use App\Exceptions\ExceptionAbstract;

class CsrfTokenMismatchException extends ExceptionAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct("CSRF token mismatch");
    }
}
