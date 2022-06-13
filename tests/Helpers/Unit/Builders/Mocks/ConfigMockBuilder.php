<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Config\Config;

class ConfigMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Config::class;
    }
}
