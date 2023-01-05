<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

class Commit extends AbstractKitObject
{
    protected string $committer;

    protected string $message;

    protected string $treeHash;

    protected array $parentHash;

    public function hash(): Hash
    {
        // TODO: Implement hash() method.
    }

    public function write(): string
    {
        // TODO: Implement write() method.
    }

    public function read(string $bytes): array
    {
        // TODO: Implement read() method.
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }

    public function encode(): string
    {
        // TODO: Implement encode() method.
    }

    public function decode(): string
    {
        // TODO: Implement decode() method.
    }
}
