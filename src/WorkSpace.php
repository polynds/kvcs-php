<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

class WorkSpace
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function readFile()
    {
    }

    public function createFile()
    {
    }

    public function clear()
    {
    }
}
