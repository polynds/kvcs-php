<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Refs;

use Kit\Core\FileSystem\Directory;

class Refs
{
    public const DIR_NAME = 'refs';

    protected Heads $heads;

    protected Tags $tags;

    protected string $path;

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::DIR_NAME;
        $this->heads = new Heads($this->path);
        $this->tags = new Tags($this->path);
    }

    public function init()
    {
        Directory::create($this->path);
        $this->heads->init();
        $this->tags->init();
    }
}
