<?php

namespace Tests\Helpers\Unit\Builders\Db\Router;

use App\Core\Db\DbInterface;
use PDO;
use Tests\Helpers\Unit\Builders\Core\Db\Classes\DbWithFakeCollaborator;

class DbBuilder
{
    /**
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @param \PDO   $pdoMock
     *
     * @return \App\Core\Db\DbInterface
     */
    public static function makeWithFakeCollaborators(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbname,
        string $charset,
        PDO $pdoMock
    ): DbInterface {
        return new DbWithFakeCollaborator($host, $port, $user, $password, $dbname, $charset, $pdoMock);
    }
}
