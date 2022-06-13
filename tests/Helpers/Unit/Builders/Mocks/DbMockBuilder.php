<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use App\Core\Db\Db;

class DbMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return Db::class;
    }
}
