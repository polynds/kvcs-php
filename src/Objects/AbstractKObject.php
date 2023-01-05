<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

abstract class AbstractKObject implements KObject
{
    public function isBlobObject(): bool
    {
        return $this->type() === KObject::BLOB_OBJECT;
    }

    abstract public function toArray(): array;

    abstract public function encode(): string;

    abstract public function decode(): string;
}
