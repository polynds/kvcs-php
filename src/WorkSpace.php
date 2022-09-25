<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

use Kit\FileSystem\Finder;

class WorkSpace
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function readFiles(): array
    {
        $files = Finder::open($this->path)->tree();
        return $files;
    }

    public function createFile()
    {
    }

    public function clear()
    {
    }
}
