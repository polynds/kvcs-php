<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase;

use Kit\ApplicationContext;
use Kit\Core\Hash;
use Kit\Core\ObjectDatabase\Objects\AbstractKitObject;
use Kit\Core\ObjectDatabase\Objects\Blob;
use Kit\Core\ObjectDatabase\Objects\Commit;
use Kit\Core\ObjectDatabase\Objects\KitObjectType;
use Kit\Core\ObjectDatabase\Objects\Tree;

class ObjectFactory
{
    public static function decode(string $content): ?AbstractKitObject
    {
        $object = unserialize($content);
        $type = $object['type'];
        return match ($type->getType()) {
            KitObjectType::TREE_OBJECT => static::toTreeObject($object),
            KitObjectType::BLOB_OBJECT => static::toBlobObject($object),
            default => null
        };
    }

    public static function toTreeObject(array $object): Tree
    {
        $tree = (new Tree($object['name'], $object['path']));
        foreach ($object['entries'] as $entry) {
            $tree->addEntry(unserialize($entry));
        }
        return $tree;
    }

    public static function createTree(string $dirName, string $path): Tree
    {
        return new Tree($dirName, $path);
    }

    public static function toBlobObject(array $object): Blob
    {
        return new Blob($object['content']);
    }

    public static function createBlob(string $content): Blob
    {
        return new Blob($content);
    }

    public static function createCommit(Hash $tree, string $message): Commit
    {
        return (new Commit($tree))->setMessage($message);
    }

    public static function findForName(string $name): ?AbstractKitObject
    {
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        return $objectDatabase->read((new Hash($name))->getHashString());
    }

    public static function findForHash(string $hash): ?AbstractKitObject
    {
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        return $objectDatabase->read($hash);
    }

    public static function exists(string $dirName): bool
    {
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        return $objectDatabase->exists((new Hash($dirName))->getHashString());
    }
}
