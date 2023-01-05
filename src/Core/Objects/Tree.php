<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Objects;

class Tree extends AbstractKitObject
{
    /**
     * @var TreeEntry[]
     */
    protected array $entries;

    public function __construct()
    {
        $this->hash = new Hash($this->content);
        $this->setKitObjectType(KitObjectType::init(KitObjectType::TREE_OBJECT));
    }

    public function toArray(): array
    {
        return [];
    }
}
