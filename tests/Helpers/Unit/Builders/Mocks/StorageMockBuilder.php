<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Storage\Storage;

class StorageMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Storage::class;
    }
}
