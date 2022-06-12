<?php

namespace App\FactoryMethods\Repository;

use App\Repositories\AffectedRows;
use App\Repositories\AffectedRowsInterface;

trait AffectedRowsFactoryMethod
{
    /**
     * @return \App\Repositories\AffectedRowsInterface
     */
    public function createAffectedRows(): AffectedRowsInterface
    {
        return new AffectedRows();
    }

    /**
     * @param int $created
     *
     * @return \App\Repositories\AffectedRowsInterface
     */
    public function createAffectedRowsWithCreated(int $created): AffectedRowsInterface
    {
        $ar = new AffectedRows();
        $ar->setCreated($created);
        return $ar;
    }

    /**
     * @param int $updated
     *
     * @return \App\Repositories\AffectedRowsInterface
     */
    public function createAffectedRowsWithUpdated(int $updated): AffectedRowsInterface
    {
        $ar = new AffectedRows();
        $ar->setUpdated($updated);
        return $ar;
    }

    /**
     * @param int $deleted
     *
     * @return \App\Repositories\AffectedRowsInterface
     */
    public function createAffectedRowsWithDeleted(int $deleted): AffectedRowsInterface
    {
        $ar = new AffectedRows();
        $ar->setDeleted($deleted);
        return $ar;
    }
}
