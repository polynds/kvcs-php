<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

class Hash
{
    protected string $hash;

    protected string $dir_hash;

    protected string $file_hash;

    public function __construct(string $str)
    {
        $this->hash = sha1($str);
        $this->dir_hash = substr($this->hash, 0, 1);
        $this->file_hash = substr($this->hash, 1);
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getDirHash(): string
    {
        return $this->dir_hash;
    }

    public function getFileHash(): string
    {
        return $this->file_hash;
    }
}
