<?php

namespace App\Core\Db;

use App\Core\CoreAbstract;
use PDO;
use PDOStatement;

/**
 * PDO wrapper
 */
class Db extends CoreAbstract implements DbInterface
{
    /**
     * @var \PDO|null The value is null when disconnected
     */
    protected PDO|null $db;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @param int    $port
     */
    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbname,
        string $charset
    ) {
        $this->connect($host, $port, $user, $password, $dbname, $charset);
    }

    /**
     * @inheritDoc
     */
    public function connect(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbname,
        string $charset
    ): void {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->db = $this->createPDO($dsn, $user, $password, $options);
    }

    /**
     * @inheritDoc
     */
    public function disconnect(): void
    {
        $this->db = null;
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
        return new PDO($dsn, $user, $password, $options);
    }

    /**
     * @param string $query
     * @param array  $params
     *
     * @return false|\PDOStatement
     */
    protected function prepareAndExecute(string $query, array $params = []): PDOStatement|false
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * @inheritDoc
     */
    public function select(string $query, array $params = []): array
    {
        $stmt = $this->prepareAndExecute($query, $params);
        return $stmt->fetchAll();
    }

    /**
     * @inheritDoc
     */
    public function selectOne(string $query, array $params = []): ?object
    {
        $stmt = $this->prepareAndExecute($query, $params);
        $obj = $stmt->fetch();
        return $obj !== false ? $obj : null;
    }

    /**
     * @inheritDoc
     */
    public function insert(string $query, array $params = []): int
    {
        $stmt = $this->prepareAndExecute($query, $params);
        return $stmt->rowCount();
    }

    /**
     * @inheritDoc
     */
    public function update(string $query, array $params = []): int
    {
        $stmt = $this->prepareAndExecute($query, $params);
        return $stmt->rowCount();
    }

    /**
     * @inheritDoc
     */
    public function delete(string $query, array $params = []): int
    {
        $stmt = $this->prepareAndExecute($query, $params);
        return $stmt->rowCount();
    }
}
