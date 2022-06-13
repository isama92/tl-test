<?php

namespace Tests\Helpers\Unit\Builders\Core\Db\Classes;

use App\Core\Db\Db;
use PDO;

class DbWithFakeCollaborator extends Db
{
    /**
     * @var \PDO
     */
    public PDO $fakePdo;

    /**
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @param \PDO   $pdo
     */
    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbname,
        string $charset,
        PDO $pdo
    ) {
        $this->fakePdo = $pdo;
        parent::__construct($host, $port, $user, $password, $dbname, $charset);
    }

    /**
     * @param string $dsn
     * @param string $user
     * @param string $password
     * @param array  $options
     *
     * @return \PDO
     */
    protected function createPDO(string $dsn, string $user, string $password, array $options = []): PDO
    {
        return $this->fakePdo;
    }
}
