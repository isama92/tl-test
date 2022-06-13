<?php

namespace App\Core\Storage;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;
use App\Exceptions\Storage\FileNotFoundException;
use App\Exceptions\Storage\InvalidModeException;
use SplFileObject;

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

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->storagePath = $container->getRootDir() . $this->container->config()->get(self::CONFIG_STORAGE_DIR);
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Storage\InvalidModeException
     * @throws \App\Exceptions\Storage\FileNotFoundException
     */
    public function get(string $filePath): string
    {
        if (!$this->exists($filePath)) {
            throw new FileNotFoundException($filePath);
        }

        $fullFilePath = $this->storagePath . $filePath;
        $fh = $this->createSplFileObject($fullFilePath, self::MODE_R);
        $size = $fh->getSize();
        $content = $size > 0 ? $fh->fread($size) : false;
        return $content === false ? '' : $content;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Storage\InvalidModeException
     */
    public function put(string $filePath, string $content): void
    {
        $fullFilePath = $this->storagePath . $filePath;

        $this->createDirIfNotExists($filePath);

        $fh = $this->createSplFileObject($fullFilePath, self::MODE_W);
        $fh->fwrite($content);
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Storage\InvalidModeException
     */
    public function append(string $filePath, string $content): void
    {
        $fullFilePath = $this->storagePath . $filePath;

        $this->createDirIfNotExists($filePath);

        $fh = $this->createSplFileObject($fullFilePath, self::MODE_A);
        $fh->fwrite($content);
    }

    /**
     * @inheritDoc
     */
    public function exists(string $filePath): bool
    {
        $fullFilePath = $this->storagePath . $filePath;
        return file_exists($fullFilePath);
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
     * @throws \App\Exceptions\Storage\FileNotFoundException
     * @throws \App\Exceptions\Storage\InvalidModeException
     */
    public function getCsv(
        string $filePath,
        string $separator = ',',
        string $enclosure = '"',
        string $escape = '\\',
        bool $hasHeaders = true
    ): array {
        if (!$this->exists($filePath)) {
            throw new FileNotFoundException($filePath);
        }

        $fullFilePath = $this->storagePath . $filePath;
        $fh = $this->createSplFileObject($fullFilePath, self::MODE_R);
        $data = [];

        $headers = [];
        if ($hasHeaders) {
            $headers = $fh->fgetcsv($separator, $enclosure, $escape);
        }

        while (($row = $fh->fgetcsv($separator, $enclosure, $escape)) !== false) {
            $rowData = [];
            foreach ($row as $i => $v) {
                $key = $hasHeaders ? $headers[$i] : $i;
                $rowData[$key] = $v;
            }
            $data[] = $rowData;
        }

        return $data;
    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    protected function createDirIfNotExists(string $filePath): void
    {
        $fullFilePath = $this->storagePath . $filePath;
        $dir = pathinfo($fullFilePath, PATHINFO_DIRNAME);
        if (!$this->exists($filePath)) {
            mkdir($dir);
        }
    }

    /**
     * @param string $fullFilePath
     * @param string $mode
     *
     * @return \SplFileObject
     * @throws \App\Exceptions\Storage\InvalidModeException
     */
    protected function createSplFileObject(string $fullFilePath, string $mode): SplFileObject
    {
        if (!in_array($mode, self::MODES)) {
            throw new InvalidModeException($mode);
        }
        return new SplFileObject($fullFilePath, $mode);
    }
}
