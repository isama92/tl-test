<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use Twig\Environment;

class TwigEnvironmentMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Environment::class;
    }
}
