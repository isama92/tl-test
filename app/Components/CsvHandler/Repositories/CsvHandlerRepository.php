<?php

namespace App\Components\CsvHandler\Repositories;

use App\Components\CsvHandler\Domains\CsvRowInterface;
use App\FactoryMethods\Domain\CsvRowFactoryMethod;
use App\Repositories\AffectedRowsInterface;
use App\Repositories\Repository;

class CsvHandlerRepository extends Repository implements CsvHandlerRepositoryInterface
{
    use CsvRowFactoryMethod;

    protected string $primaryKey = CsvRowInterface::ID;

    /**
     * @var string
     */
    protected $fieldId = CsvRowInterface::ID;

    /**
     * @var string
     */
    protected $fieldAuthor = CsvRowInterface::AUTHOR;

    /**
     * @var string
     */
    protected $fieldTitle = CsvRowInterface::TITLE;

    /**
     * @inheritDoc
     */
    protected function tableName(): string
    {
        return 'testtable';
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?CsvRowInterface
    {
        $row = $this->db->selectOne("SELECT * FROM {$this->table} WHERE {$this->primaryKey}=:id", [
            'id' => $id,
        ]);

        if (is_null($row)) {
            return $row;
        }

        return $this->createCsvRow(
            $row->{$this->fieldAuthor},
            $row->{$this->fieldTitle},
            $row->{$this->fieldId}
        );
    }

    /**
     * @inheritDoc
     */
    public function create(CsvRowInterface $csvRow): AffectedRowsInterface
    {
        $values = $csvRow->getAllValues();

        $affectedRows = $this->db->insert(
            "
                INSERT INTO {$this->table} ({$this->fieldId}, {$this->fieldAuthor}, {$this->fieldTitle})
                VALUES (:{$this->fieldId}, :{$this->fieldAuthor}, :{$this->fieldTitle})
            ",
            $values
        );
        return $this->createAffectedRowsWithCreated($affectedRows);
    }

    /**
     * @inheritDoc
     */
    public function updateById(int $id, CsvRowInterface $csvRow): AffectedRowsInterface
    {
        $values = $csvRow->getAllValues();

        $affectedRows = $this->db->update(
            "
                UPDATE {$this->table}
                SET
                    {$this->fieldAuthor}=:{$this->fieldAuthor},
                    {$this->fieldTitle}=:{$this->fieldTitle}
                WHERE {$this->fieldId}=:{$this->fieldId}
            ",
            $values
        );
        return $this->createAffectedRowsWithUpdated($affectedRows);
    }

    /**
     * @inheritDoc
     */
    public function upsertCsvRow(int $id, CsvRowInterface $newCsvRow): AffectedRowsInterface
    {
        $csvRow = $this->findById($id);

        if (is_null($csvRow)) {
            return $this->create($newCsvRow);
        }

        return $this->updateById($id, $newCsvRow);
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $data = [];

        $dbRows = $this->db->select("SELECT * FROM {$this->table}");

        foreach ($dbRows as $row) {
            $data[] = $this->createCsvRow(
                $row->{CsvRowInterface::AUTHOR},
                $row->{CsvRowInterface::TITLE},
                $row->{CsvRowInterface::ID}
            );
        }

        return $data;
    }
}
