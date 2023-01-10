<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

class Path
{
    public static function explode(string $path): array
    {
        return explode(DIRECTORY_SEPARATOR, dirname($path));
    }
}
