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

    protected string $path;

    /**
     * @var IndexEntry[]
     */
    protected array $index = [];

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): StagingArea
    {
        $this->path = $path;
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
        if (! file_exists($this->path)) {
            FileWriter::write($this->path, '');
        }
    }

    public function store(): void
    {
        FileWriter::write($this->path, serialize($this->index));
    }
}
