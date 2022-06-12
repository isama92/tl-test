<?php

namespace App\Contracts;

use App\Presenters\PresenterInterface;

interface UseCaseContract
{
    /**
     * @param array $requestData
     *
     * @return \App\Presenters\PresenterInterface
     */
    public function execute(array $requestData = []): PresenterInterface;
}
