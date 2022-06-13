<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Container\Container;

class ContainerMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Container::class;
    }
}
