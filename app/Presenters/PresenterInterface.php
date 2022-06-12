<?php

namespace App\Presenters;

use App\Core\Response\ResponseInterface;

interface PresenterInterface
{
    /**
     * @return \App\Core\Response\ResponseInterface
     */
    public function present(): ResponseInterface;
}
