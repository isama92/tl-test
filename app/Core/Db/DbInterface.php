<?php

namespace App\Core\Db;

interface DbInterface
{
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
