<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

class FileMode
{
    public const EMPTY = 0;

    public const DIRECTORY = 40000;

    public const NORMAL_FILES = 100644;

    public const EXECUTABLE = 100755;

    public const SYMLINK = 120000;

    protected int $mode;

    public function __construct(int $mode)
    {
        $this->mode = $mode;
    }

    public function getMode(): int
    {
        return $this->mode;
    }

    public static function init(int $mode): static
    {
        return new static($mode);
    }
}
