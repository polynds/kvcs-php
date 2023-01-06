<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\StagingArea;

use Kit\Core\FileSystem\FileMode;

class IndexEntry
{
    /**
     * 上次修改时间.
     */
    protected ?int $mtime = null;

    /**
     * 创建时间.
     */
    protected ?int $ctime = null;

    protected ?string $fileName = null;

    protected ?string $dirHash = null;

    protected ?string $fileHash = null;

    protected ?FileMode $mode = null;

    public function __toString(): string
    {
        $hash = $this->getFileHash() ?: ($this->getDirHash() ?: '');
        return sprintf(
            '%d %s %s',
            $this->mode->getMode(),
            $hash,
            $this->fileName
        );
    }

    public function getMtime(): ?int
    {
        return $this->mtime;
    }

    public function setMtime(?int $mtime): self
    {
        $this->mtime = $mtime;
        return $this;
    }

    public function getCtime(): ?int
    {
        return $this->ctime;
    }

    public function setCtime(?int $ctime): self
    {
        $this->ctime = $ctime;
        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getDirHash(): ?string
    {
        return $this->dirHash;
    }

    public function setDirHash(?string $dirHash): self
    {
        $this->dirHash = $dirHash;
        return $this;
    }

    public function getFileHash(): ?string
    {
        return $this->fileHash;
    }

    public function setFileHash(?string $fileHash): self
    {
        $this->fileHash = $fileHash;
        return $this;
    }

    public function getMode(): ?FileMode
    {
        return $this->mode;
    }

    public function setMode(?FileMode $mode): self
    {
        $this->mode = $mode;
        return $this;
    }
}
