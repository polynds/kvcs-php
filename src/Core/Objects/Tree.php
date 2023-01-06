<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Objects;

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

    public function __construct(string $name)
    {
        $this->name = $name;
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
        return [];
    }
}
