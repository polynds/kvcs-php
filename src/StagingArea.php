<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

use Kit\File\FileWriter;
use Kit\Objects\Hash;

class StagingArea
{
    public const FILE_NAME = 'index';

    protected string $path;

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

    public function getIndexs(): array
    {
        return $this->index;
    }

    public function addIndex(string $path, Hash $hash): StagingArea
    {
        $this->index[$path] = $hash;
        return $this;
    }

    public function init()
    {
        if (! file_exists($this->path)) {
            FileWriter::write($this->path, '');
        }
    }
}
