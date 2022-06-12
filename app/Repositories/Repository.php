<?php

namespace App\Repositories;

use App\Core\Container\ContainerInterface;
use App\Core\Db\DbInterface;
use App\FactoryMethods\Repository\AffectedRowsFactoryMethod;

abstract class Repository implements RepositoryInterface
{
    use AffectedRowsFactoryMethod;

    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    protected DbInterface $db;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primaryKey = 'id';

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $container->db();
        $this->table = $this->tableName();
    }

    /**
     * @return string
     */
    abstract protected function tableName(): string;
}
