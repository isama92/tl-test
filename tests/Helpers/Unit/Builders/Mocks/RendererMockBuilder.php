<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Renderer\Renderer;

class RendererMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Renderer::class;
    }
}
