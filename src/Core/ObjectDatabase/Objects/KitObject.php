<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase\Objects;

use Kit\Core\Hash;

interface KitObject
{
    public function hash(): Hash;

    public function type(): KitObjectType;
}
