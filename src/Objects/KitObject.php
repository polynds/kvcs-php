<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

interface KitObject
{
    public function hash(): Hash;

    public function type(): KitObjectType;
}
