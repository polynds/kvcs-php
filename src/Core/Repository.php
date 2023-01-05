<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\Core\FileSystem\Directory;
use Kit\Core\ObjectDatabase\ObjectDatabase;
use Kit\Core\Refs\Refs;
use Kit\Exception\DirectoryNotExistException;

/**
 * 版本库.
 */
class Repository
{
    public const DIR_NAME = '.kit';

    public const DIR_GIT_NAME = '.git';

    /**
     * 暂存区.
     */
    protected StagingArea $stagingArea;

    /**
     * 版本数据库.
     */
    protected ObjectDatabase $objectDatabase;

    protected string $path;

    protected Head  $head;

    protected Refs  $refs;

    public function __construct(string $basePath)
    {
        $this->path = $basePath . DIRECTORY_SEPARATOR . self::DIR_NAME;
        $this->stagingArea = new StagingArea($this->path);
        $this->objectDatabase = new ObjectDatabase($this->path);
        $this->head = new Head($this->path);
        $this->refs = new Refs($this->path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getStagingArea(): StagingArea
    {
        return $this->stagingArea;
    }

    public function getObjectDatabase(): ObjectDatabase
    {
        return $this->objectDatabase;
    }

    public function init()
    {
        Directory::create($this->path);
        $this->stagingArea->init();
        $this->objectDatabase->init();
        $this->head->init();
        $this->refs->init();
    }

    private function check()
    {
        if (! is_dir($this->path)) {
            throw new DirectoryNotExistException(self::DIR_NAME);
        }
    }
}
