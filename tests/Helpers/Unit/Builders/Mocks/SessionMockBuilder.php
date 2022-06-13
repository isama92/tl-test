<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Session\Session;

class SessionMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Session::class;
    }
}
