<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Objects;

abstract class AbstractKObject implements KObject
{
    public function isBlobObject(): bool
    {
        return $this->type() === KObject::BLOB_OBJECT;
    }
}
