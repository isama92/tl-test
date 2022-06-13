<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Response\Response;

class ResponseMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Response::class;
    }
}
