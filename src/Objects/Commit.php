<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

class Commit extends AbstractKObject
{
    protected string $hash;

    protected string $committer;

    protected string $message;

    protected string $treeHash;

    protected array $parentHash;

    public function hash(): Hash
    {
        // TODO: Implement hash() method.
    }

    public function type(): string
    {
        // TODO: Implement type() method.
    }

    public function write(): string
    {
        // TODO: Implement write() method.
    }

    public function read(string $bytes): array
    {
        // TODO: Implement read() method.
    }
}
