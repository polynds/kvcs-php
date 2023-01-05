<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Objects;

interface KObject
{
    public const BLOB_OBJECT = 'blob';

    public const COMMIT_OBJECT = 'commit';

    public const TREE_OBJECT = 'tree';

    public const TAG_OBJECT = 'tag';

    public function hash(): Hash;

    public function type(): string;
}
