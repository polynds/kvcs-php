<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\ObjectDatabase\Objects;

class KitObjectType
{
    public const BLOB_OBJECT = 'blob';

    public const COMMIT_OBJECT = 'commit';

    public const TREE_OBJECT = 'tree';

    public const TAG_OBJECT = 'tag';

    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public static function init(string $type): static
    {
        return new static($type);
    }

    public function isBlobObject(): bool
    {
        return $this->type === self::BLOB_OBJECT;
    }

    public function isCommitObject(): bool
    {
        return $this->type === self::COMMIT_OBJECT;
    }

    public function isTreeObject(): bool
    {
        return $this->type === self::TREE_OBJECT;
    }

    public function isTagObject(): bool
    {
        return $this->type === self::TAG_OBJECT;
    }
}
