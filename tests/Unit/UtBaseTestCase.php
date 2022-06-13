<?php

namespace Tests\Unit;

use Tests\TestCase;

abstract class UtBaseTestCase extends TestCase
{
    /**
     * @var string
     */
    protected string $rootDir;

    /**
     * @var string
     */
    protected string $configDirName;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->rootDir = realpath(
            __DIR__
        ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

        $this->configDirName = 'config';

        parent::setUp();
    }
}
