<?php

namespace Tests\Helpers\Unit\Builders\Core\Storage;

use App\Core\Container\ContainerInterface;
use App\Core\Storage\StorageInterface;
use SplFileObject;
use Tests\Helpers\Unit\Builders\Core\Storage\Classes\StorageWithFakeCollaborator;

class StorageBuilder
{
    /**
     * @param \App\Core\Container\ContainerInterface $container
     * @param \SplFileObject                         $splFileObjectMock
     *
     * @return \App\Core\Storage\StorageInterface
     */
    public static function makeWithFakeCollaborators(
        ContainerInterface $container,
        SplFileObject $splFileObjectMock
    ): StorageInterface {
        return new StorageWithFakeCollaborator($container, $splFileObjectMock);
    }
}
