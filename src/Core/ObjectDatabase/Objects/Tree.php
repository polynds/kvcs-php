<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase\Objects;

use Kit\Core\Hash;

/**
 * 代表项目的一次次的版本.
 */
class Tree extends AbstractKitObject
{
    protected string $name;

    /**
     * @var TreeEntry[]
     */
    protected array $entries;

    protected string $path;

    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->hash = new Hash($this->name);
        $this->setKitObjectType(KitObjectType::init(KitObjectType::TREE_OBJECT));
    }

    public function addEntry(TreeEntry $entry): static
    {
        $this->entries[] = $entry;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'path' => $this->path,
            'entries' => serialize($this->entries),
        ];
    }
}
