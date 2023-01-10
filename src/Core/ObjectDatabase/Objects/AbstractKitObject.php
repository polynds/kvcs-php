<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase\Objects;

use Kit\Core\Hash;

abstract class AbstractKitObject implements KitObject
{
    protected Hash $hash;

    protected KitObjectType $kitObjectType;

    public function hash(): Hash
    {
        return $this->hash;
    }

    public function type(): KitObjectType
    {
        return $this->kitObjectType;
    }

    public function setKitObjectType(KitObjectType $kitObjectType): self
    {
        $this->kitObjectType = $kitObjectType;
        return $this;
    }

    public function getHashString(): string
    {
        return $this->hash->getHashString();
    }

    abstract public function toArray(): array;

    public function encode(): string
    {
        return serialize($this->toArray() + [
            'hash' => $this->getHashString(),
            'type' => $this->type()->getType(),
        ]);
    }
}
