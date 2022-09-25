<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

use Kit\FileSystem\Directory;

class LocalRepository
{
    public const DIR_NAME = 'objects';

    protected string $path;

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::DIR_NAME;
    }

    public function init()
    {
        if (! is_dir($this->path)) {
            Directory::create($this->path);
        }
    }
}
