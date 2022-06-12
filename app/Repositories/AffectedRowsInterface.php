<?php

namespace App\Repositories;

interface AffectedRowsInterface
{
    /**
     * @return int
     */
    public function getCreated(): int;

    /**
     * @param int $created
     *
     * @return void
     */
    public function setCreated(int $created): void;

    /**
     * @return int
     */
    public function getUpdated(): int;

    /**
     * @param int $updated
     *
     * @return void
     */
    public function setUpdated(int $updated): void;

    /**
     * @return int
     */
    public function getDeleted(): int;

    /**
     * @param int $deleted
     *
     * @return void
     */
    public function setDeleted(int $deleted): void;

    /**
     * @param \App\Repositories\AffectedRowsInterface $affectedRows
     *
     * @return void
     */
    public function sum(AffectedRowsInterface $affectedRows): void;

    /**
     * @return int
     */
    public function getTotal(): int;
}
