<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Request\Request;

class RequestMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Request::class;
    }
}
