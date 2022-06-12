<?php

namespace App\Contracts;

use App\Presenters\PresenterInterface;

interface UseCaseContract
{
    /**
     * @param array $requestData
     *
     * @return mixed
     */
    public function execute(array $requestData = []): PresenterInterface;
}
