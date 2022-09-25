<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Objects;

class FileMode
{
    public const Empty = 0;

    public const Dir = 0040000;

    public const Regular = 0100644;

    /**
     * git的旧版文件系统，新版已废弃.
     */
    public const Deprecated = 0100664;

    public const Executable = 0100755;

    public const Symlink = 0120000;

    public const Submodule = 0160000;

    protected int $mode;

    public function __construct(int $mode)
    {
        $this->mode = $mode;
    }

    public function getMode(): int
    {
        return $this->mode;
    }
}
