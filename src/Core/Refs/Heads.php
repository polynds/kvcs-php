<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Refs;

use Kit\Core\FileSystem\Directory;

class Heads
{
    public const DIR_NAME = 'heads';

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
