<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\Core\FileSystem\FileWriter;

class Head
{
    public const FILE_NAME = 'HEAD';

    protected string $filename;

    public function __construct(string $repositoryPath)
    {
        $this->filename = $repositoryPath . DIRECTORY_SEPARATOR . self::FILE_NAME;
    }

    public function init(): void
    {
        if (! file_exists($this->filename)) {
            FileWriter::write($this->filename, 'ref: refs/heads/master');
        }
    }
}
