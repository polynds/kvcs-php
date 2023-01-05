<?php

declare(strict_types=1);
/**
 * happy coding!!!
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

    public function getMtime(): int
    {
        return $this->mtime;
    }

    public function setMtime(int $mtime): self
    {
        $this->mtime = $mtime;
        return $this;
    }

    public function getCtime(): int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): self
    {
        $this->ctime = $ctime;
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getDirHash(): string
    {
        return $this->dirHash;
    }

    public function setDirHash(string $dirHash): self
    {
        $this->dirHash = $dirHash;
        return $this;
    }

    public function getFileHash(): string
    {
        return $this->fileHash;
    }

    public function setFileHash(string $fileHash): self
    {
        $this->fileHash = $fileHash;
        return $this;
    }
}
