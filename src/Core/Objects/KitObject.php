<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Objects;

interface KitObject
{
    public function hash(): Hash;

    public function type(): KitObjectType;
}
