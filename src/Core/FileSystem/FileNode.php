<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

class FileNode
{
    protected FileType $type;

    protected string $name;

    protected string $path;

    /**
     * 上次修改时间.
     */
    protected int $mtime;

    /**
     * 创建时间.
     */
    protected int $ctime;

    /**
     * @var FileNode[]
     */
    protected array $files;

    public function getType(): FileType
    {
        return $this->type;
    }

    public function setType(FileType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files): self
    {
        $this->files = $files;
        return $this;
    }

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
}
