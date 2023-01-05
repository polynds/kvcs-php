<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\Core\FileSystem\Directory;
use Kit\Core\FileSystem\FileWriter;
use Kit\Core\Objects\AbstractKitObject;

class ObjectDatabase
{
    public const DIR_NAME = 'objects';

    protected string $path;

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::DIR_NAME;
    }

    public function init(): void
    {
        if (! is_dir($this->path)) {
            Directory::create($this->path);
        }
    }

    public function store(AbstractKitObject $object): void
    {
        $hash = $object->getHashString();
        $fileName = $this->path . DIRECTORY_SEPARATOR . substr($hash, 0, 2) . DIRECTORY_SEPARATOR . $hash;
        if (! file_exists($fileName)) {
            FileWriter::writeAndCreateFiles($fileName, $object->encode());
        }
    }
}
