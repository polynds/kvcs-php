<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

use Kit\Exception\DirectoryNotExistException;
use Kit\FileSystem\Directory;

class Repository
{
    public const DIR_NAME = '.kit';
    public const DIR_GIT_NAME = '.git';

    protected StagingArea $stagingArea;

    protected LocalRepository $localRepository;

    protected string $path;

    public function __construct(string $basePath)
    {
        $this->path = $basePath . DIRECTORY_SEPARATOR . self::DIR_NAME;
        $this->stagingArea = new StagingArea($this->path);
        $this->localRepository = new LocalRepository($this->path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getStagingArea(): StagingArea
    {
        return $this->stagingArea;
    }

    public function getLocalRepository(): LocalRepository
    {
        return $this->localRepository;
    }

    public function init()
    {
        Directory::create($this->path);
        $this->stagingArea->init();
        $this->localRepository->init();
    }

    private function check()
    {
        if (! is_dir($this->path)) {
            throw new DirectoryNotExistException(self::DIR_NAME);
        }
    }
}
