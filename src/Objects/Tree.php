<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

class Tree extends AbstractKitObject
{
    protected string $hash;

    /**
     * @var TreeEntry[]
     */
    protected array $entries;

    public function getHashString(): string
    {
        // TODO: Implement getHashString() method.
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

    public function hash(): Hash
    {
        // TODO: Implement hash() method.
    }

    public function type(): string
    {
        // TODO: Implement type() method.
    }
}
