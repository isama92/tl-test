<?php

namespace App\Components\CsvHandler\Domains;

class CsvRow implements CsvRowInterface
{
    /**
     * @var int|null
     */
    protected ?int $id;

    /**
     * @var string
     */
    protected string $author;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @param string   $author
     * @param string   $title
     * @param int|null $id
     */
    public function __construct(string $author, string $title, ?int $id)
    {
        $this->setId($id);
        $this->setAuthor($author);
        $this->setTitle($title);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    protected function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $author
     *
     * @return void
     */
    protected function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAllValues(): array
    {
        $attributes = [
            self::AUTHOR => $this->author,
            self::TITLE => $this->title,
        ];

        if (!is_null($this->id)) {
            $attributes[self::ID] = $this->id;
        }

        return $attributes;
    }
}
