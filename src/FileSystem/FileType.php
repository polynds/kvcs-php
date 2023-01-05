<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\FileSystem;

class FileType
{
    public const TYPE_DIR = 'directory';

    public const TYPE_FILE = 'file';

    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }

    public static function init(string $type): static
    {
        return new static($type);
    }

    public function isDirectory(): bool
    {
        return $this->type === self::TYPE_DIR;
    }

    public function isFile(): bool
    {
        return $this->type === self::TYPE_FILE;
    }
}
