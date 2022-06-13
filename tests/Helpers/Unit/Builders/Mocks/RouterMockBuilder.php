<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Router\Router;

class RouterMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Router::class;
    }
}
