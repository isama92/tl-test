<?php

namespace App\Contracts;

use App\Presenters\Presenter;

interface UseCaseContract
{
    /**
     * @param array $requestData
     *
     * @return mixed
     */
    public function execute(array $requestData = []): Presenter;
}
