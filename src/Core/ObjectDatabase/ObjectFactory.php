<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase;

use Kit\Core\ObjectDatabase\Objects\AbstractKitObject;
use Kit\Core\ObjectDatabase\Objects\KitObjectType;
use Kit\Core\ObjectDatabase\Objects\Tree;

class ObjectFactory
{
    public static function decode(string $content): ?AbstractKitObject
    {
        $object = unserialize($content);
        $type = (new KitObjectType($object['type'] ?? ''));
        return match ($type->getType()) {
            KitObjectType::TREE_OBJECT => static::toTreeObject($object),
            default => null
        };
    }

    public static function toTreeObject($object): Tree
    {
        $tree = (new Tree($object['name']));
        foreach ($object['entries'] as $entry) {
            $tree->addEntry(unserialize($entry));
        }
        return $tree;
    }
}
