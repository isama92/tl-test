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
            $row->{CsvRowInterface::AUTHOR},
            $row->{CsvRowInterface::TITLE},
            $row->{CsvRowInterface::ID}
        );
    }

    /**
     * @inheritDoc
     */
    public function upsertCsvRow(int $id, CsvRowInterface $newCsvRow): AffectedRowsInterface
    {
        // TODO: refactor - create insert and update method

        $csvRow = $this->findById($id);

        $values = $newCsvRow->getAllValues();
        $fieldId = $newCsvRow::ID;
        $fieldAuthor = $newCsvRow::AUTHOR;
        $fieldTitle = $newCsvRow::TITLE;

        if (is_null($csvRow)) {
            // create
            $affectedRows = $this->db->insert(
                "
                INSERT INTO {$this->table} ({$fieldId}, {$fieldAuthor}, {$fieldTitle})
                VALUES (:{$fieldId}, :{$fieldAuthor}, :{$fieldTitle})
            ",
                $values
            );
            return $this->createAffectedRowsWithCreated($affectedRows);
        }

        // updated
        $affectedRows = $this->db->update(
            "
                UPDATE {$this->table}
                SET
                    {$fieldAuthor}=:{$fieldAuthor},
                    {$fieldTitle}=:{$fieldTitle}
                WHERE {$fieldId}=:{$fieldId}
            ",
            $values
        );
        return $this->createAffectedRowsWithUpdated($affectedRows);
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $data = [];

        $dbRows = $this->db->select("SELECT * FROM {$this->table}");

        foreach($dbRows as $row) {
            $data[] = $this->createCsvRow(
                $row->{CsvRowInterface::AUTHOR},
                $row->{CsvRowInterface::TITLE},
                $row->{CsvRowInterface::ID}
            );
        }

        return $data;
    }

}
