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

    public function readFiles(array $ignoreFiles): array
    {
        $finder = Finder::open($this->path);
        foreach ($ignoreFiles as $file) {
            $finder->ignore($file);
        }
        return $finder->find();
    }

    public function createFile()
    {
    }

    public function clear()
    {
    }
}
