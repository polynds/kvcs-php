<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\FileSystem;

class FileNode
{
    protected FileType $type;

    protected string $name;

    protected string $path;

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
}
