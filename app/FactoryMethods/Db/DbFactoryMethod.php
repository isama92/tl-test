<?php

namespace App\FactoryMethods\Db;

use App\Core\Db\Db;
use App\Core\Db\DbInterface;

trait DbFactoryMethod
{
    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @param int    $port
     *
     * @return \App\Core\Db\DbInterface
     */
    protected function createDb(string $host, int $port, string $user, string $password, string $dbname, string $charset): DbInterface
    {
        return new Db($host, $port, $user, $password, $dbname, $charset);
    }
}
