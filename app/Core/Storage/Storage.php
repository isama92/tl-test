<?php

namespace App\Core\Storage;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;

class Storage extends CoreAbstract implements StorageInterface
{
    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @var string
     */
    protected string $storagePath;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->storagePath = $container->getRootDir() . $this->container->config()->get('storage.dir');
    }

    /**
     * @inheritDoc
     */
    public function get(string $filePath): string
    {
        $path = $this->storagePath . $filePath;
        $content = file_get_contents($path);
        return $content === false ? '' : $content;
    }

    /**
     * @inheritDoc
     */
    public function put(string $filePath, string $content): void
    {
        $path = $this->storagePath . $filePath;
        file_put_contents($path, $content);
    }

    /**
     * @inheritDoc
     */
    public function has(string $filePath): bool
    {
        $path = $this->storagePath . $filePath;
        return file_exists($path);
    }

    /**
     * @inheritDoc
     */
    public function list(string $dirPath): array
    {
        $excludeFiles = ['.', '..'];
        $path = $this->storagePath . $dirPath;

        $files = scandir($path);
        $files = $files ?: [];
        $files = array_filter($files, function ($f) use ($excludeFiles) {
            return !in_array($f, $excludeFiles);
        });

        return array_values($files);
    }

    /**
     * @inheritDoc
     */
    public function getCsv(
        string $filePath,
        string $separator = ',',
        string $enclosure = '"',
        string $escape = '\\',
        bool $hasHeaders = true
    ): array {
        $path = $this->storagePath . $filePath;
        $fh = fopen($path, self::MODE_R);
        $data = [];

        $headers = [];
        if($hasHeaders) {
            $headers = fgetcsv($fh, null, $separator, $enclosure, $escape);
        }

        while(($row = fgetcsv($fh, null, $separator, $enclosure, $escape)) !== false) {
            $rowData = [];
            foreach($row as $i => $v) {
                $key = $hasHeaders? $headers[$i] : $i;
                $rowData[$key] = $v;
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
