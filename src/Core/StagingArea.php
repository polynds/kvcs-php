<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\Core\FileSystem\FileWriter;

class StagingArea
{
    public const FILE_NAME = 'index';

    protected string $filename;

    /**
     * @var IndexEntry[]
     */
    protected array $index = [];

    public function __construct(string $repositoryPath)
    {
        $this->filename = $repositoryPath . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): StagingArea
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return IndexEntry[]
     */
    public function getIndex(): array
    {
        return $this->index;
    }

    public function addIndex(IndexEntry $indexEntry): StagingArea
    {
        $this->index[] = $indexEntry;
        return $this;
    }

    public function init(): void
    {
        if (! file_exists($this->filename)) {
            FileWriter::write($this->filename, '');
        }
    }

    public function store(): void
    {
        FileWriter::write($this->filename, serialize($this->index));
    }
}
