<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\Core\FileSystem\Finder;

use function str_starts_with;

class WorkSpace
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function readFiles(string $dirName, array $ignoreFiles): Finder
    {
        $finder = Finder::open($this->path . (str_starts_with($dirName, DIRECTORY_SEPARATOR) ? '' : DIRECTORY_SEPARATOR) . $dirName);
        foreach ($ignoreFiles as $file) {
            $finder->ignore($file);
        }
        return $finder;
    }

    public function createFile()
    {
    }

    public function clear()
    {
    }
}
