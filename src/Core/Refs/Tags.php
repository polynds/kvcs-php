<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Refs;

use Kit\Core\FileSystem\Directory;

class Tags
{
    public const DIR_NAME = 'tags';

    protected string $path;

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::DIR_NAME;
    }

    public function init()
    {
        Directory::create($this->path);
    }
}
