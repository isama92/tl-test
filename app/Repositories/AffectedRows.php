<?php

namespace App\Repositories;

class AffectedRows implements AffectedRowsInterface
{
    /**
     * @var int
     */
    protected int $created;

    /**
     * @var int
     */
    protected int $updated;

    /**
     * @var int
     */
    protected int $deleted;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreated(0);
        $this->setUpdated(0);
        $this->setDeleted(0);
    }

    /**
     * @inheritDoc
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @inheritDoc
     */
    public function setCreated(int $created): void
    {
        $this->created = $created;
    }

    /**
     * @inheritDoc
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * @inheritDoc
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @inheritDoc
     */
    public function getDeleted(): int
    {
        return $this->deleted;
    }

    /**
     * @inheritDoc
     */
    public function setDeleted(int $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @inheritDoc
     */
    public function sum(AffectedRowsInterface $affectedRows): void
    {
        $this->setCreated($this->getCreated() + $affectedRows->getCreated());
        $this->setUpdated($this->getUpdated() + $affectedRows->getUpdated());
        $this->setDeleted($this->getDeleted() + $affectedRows->getDeleted());
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): int
    {
        return $this->getCreated() +
            $this->getUpdated() +
            $this->getDeleted();
    }
}
