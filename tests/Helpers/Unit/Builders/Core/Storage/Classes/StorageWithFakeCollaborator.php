<?php

namespace Tests\Helpers\Unit\Builders\Core\Storage\Classes;

use App\Core\Container\ContainerInterface;
use App\Core\Storage\Storage;
use SplFileObject;

class StorageWithFakeCollaborator extends Storage
{
    /**
     * @var \SplFileObject
     */
    public SplFileObject $fakeSplFileObject;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \SplFileObject                         $splFileObject
     */
    public function __construct(ContainerInterface $container, SplFileObject $splFileObject)
    {
        $this->fakeSplFileObject = $splFileObject;
        parent::__construct($container);
    }

    /**
     * @param string $fullFilePath
     * @param string $mode
     *
     * @return \SplFileObject
     */
    protected function createSplFileObject(string $fullFilePath, string $mode): SplFileObject
    {
        return $this->fakeSplFileObject;
    }
}
