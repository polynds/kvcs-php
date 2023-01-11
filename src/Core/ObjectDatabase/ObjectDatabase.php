<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase;

use Kit\Core\FileSystem\Directory;
use Kit\Core\FileSystem\FileReader;
use Kit\Core\FileSystem\FileWriter;
use Kit\Core\ObjectDatabase\Objects\AbstractKitObject;

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
        $fileName = $this->getFileNameFromHash($hash);
        if (! file_exists($fileName)) {
            FileWriter::writeAndCreateFiles($fileName, $object->encode());
        }
    }

    public function cat(string $hash): ?string
    {
        $fileName = $this->getFileNameFromHash($hash);
        if (file_exists($fileName)) {
            return FileReader::read($fileName);
        }
        return null;
    }

    public function read(string $hash): ?AbstractKitObject
    {
        $fileName = $this->getFileNameFromHash($hash);
        if (file_exists($fileName)) {
            $content = FileReader::read($fileName);
            return ObjectFactory::decode($content);
        }
        return null;
    }

    public function exists(string $hash): bool
    {
        return file_exists($this->getFileNameFromHash($hash));
    }

    public function getFileNameFromHash(string $hash): string
    {
        return $this->path . DIRECTORY_SEPARATOR . substr($hash, 0, 2) . DIRECTORY_SEPARATOR . $hash;
    }
}
