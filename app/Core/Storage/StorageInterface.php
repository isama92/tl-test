<?php

namespace App\Core\Storage;

interface StorageInterface
{
    public const MODE_R = 'r';
    public const MODE_A = 'a';
    public const MODE_W = 'w';

    public const MODES = [self::MODE_R, self::MODE_W, self::MODE_A];

    public const CONFIG_STORAGE_DIR = 'storage.dir';

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
     * @param string $content
     *
     * @return void
     */
    public function append(string $filePath, string $content): void;

    /**
     * @param string $filePath
     *
     * @return bool
     */
    public function exists(string $filePath): bool;

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
     * @param bool   $hasHeaders
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
