<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Logger\Logger;

class LoggerMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Logger::class;
    }
}
