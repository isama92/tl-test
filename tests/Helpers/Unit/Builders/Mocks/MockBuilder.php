<?php

namespace Tests\Helpers\Unit\Builders\Mocks;

use Mockery;

/**
 * Class MockBuilder.
 *
 * It Used to Wrap the Mockery lib, it is the only class that can import Mockery.
 * It will be very useful if in the future there will be some issues with some new Mockery version or to replace it
 * with another Mock Lib.
 *
 * @package Tests\Helpers\Unit\Builders\Mocks
 */
abstract class MockBuilder
{
    /**
     * @var string
     */
    protected string $className;

    public function __construct()
    {
        $this->setConcreteClassName();
    }

    /**
     * @param mixed ...$args
     *
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface|string
     */
    public function make(...$args)
    {
        return Mockery::mock($this->className, ...$args);
    }

    /**
     * @return void
     */
    protected function setConcreteClassName(): void
    {
        $this->className = $this->setClassName();
    }

    /**
     * Must return the name of the class that will be mocked
     *
     * @return string
     */
    abstract protected function setClassName(): string;
}
