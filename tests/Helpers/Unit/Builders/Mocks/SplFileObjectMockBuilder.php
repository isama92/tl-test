<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use SplFileObject;

class SplFileObjectMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return SplFileObject::class;
    }
}
