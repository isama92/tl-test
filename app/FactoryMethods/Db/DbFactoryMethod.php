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
    protected function createDb(string $host, string $user, string $password, string $dbname, string $charset, int $port = 3306): DbInterface
    {
        return new Db($host, $user, $password, $dbname, $charset, $port);
    }
}
