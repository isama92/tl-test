<?php

namespace App\Core\Db;

interface DbInterface
{
    /**
     * @param string $host
     * @param int    $port
     * @param string $user
     * @param string $password
     * @param string $dbname
     * @param string $charset
     *
     * @return void
     */
    public function connect(string $host, int $port, string $user, string $password, string $dbname, string $charset): void;

    /**
     * @return void
     */
    public function disconnect(): void;

    /**
     * @param string $query
     * @param array  $params
     *
     * @return array
     */
    public function select(string $query, array $params = []): array;

    /**
     * @param string $query
     * @param array  $params
     *
     * @return object
     */
    public function selectOne(string $query, array $params = []): object;

    /**
     * @param string $query
     * @param array  $params
     *
     * @return int Affected rows
     */
    public function insert(string $query, array $params = []): int;

    /**
     * @param string $query
     * @param array  $params
     *
     * @return int Affected rows
     */
    public function delete(string $query, array $params = []): int;
}
