<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Cache;

class IndexEntry
{
    /**
     * 上次修改时间.
     */
    protected int $mtime;

    /**
     * 创建时间.
     */
    protected int $ctime;

    protected string $fileName;

    protected string $dirHash;

    protected string $fileHash;
}
