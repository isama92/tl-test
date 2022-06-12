<?php

namespace App\Core\Storage;

interface StorageInterface
{
    const MODE_R = 'r';

    /**
     * @param string $filePath
     *
     * @return string
     */
    public function get(string $filePath): string;

    /**
     * @param string $filePath
     * @param string $content
     *
     * @return void
     */
    public function put(string $filePath, string $content): void;

    /**
     * @param string $filePath
     *
     * @return bool
     */
    public function has(string $filePath): bool;

    /**
     * @param string $dirPath
     *
     * @return array
     */
    public function list(string $dirPath): array;

    /**
     * @param string $filePath
     * @param string $separator
     * @param string $enclosure
     * @param string $escape
     *
     * @return array
     */
    public function getCsv(
        string $filePath,
        string $separator = ',',
        string $enclosure = '"',
        string $escape = '\\',
        bool $hasHeaders = true
    ): array;
}
