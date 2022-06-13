<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use PDO;

class PDOMockBuilder extends MockBuilder
{
    /**
     * @inheritdoc
     */
    public function setClassName(): string
    {
        return PDO::class;
    }
}
