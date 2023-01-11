<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase\Objects;

use Kit\Core\FileSystem\FileMode;

class TreeEntry
{
    protected FileMode $mode;

    protected string $hash;

    protected string $name;

    protected string $path;

    protected KitObjectType $type;

    public function __construct(FileMode $mode, string $hash, string $name, string $path, KitObjectType $type)
    {
        $this->mode = $mode;
        $this->hash = $hash;
        $this->name = $name;
        $this->path = $path;
        $this->type = $type;
    }

    public function getMode(): FileMode
    {
        return $this->mode;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getType(): KitObjectType
    {
        return $this->type;
    }
}
