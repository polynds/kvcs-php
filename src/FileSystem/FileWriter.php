<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\FileSystem;

use Kit\Exception\CouldNotWriteFileException;

class FileWriter
{
    public static function write(string $fileName, string $contents)
    {
        $success = @file_put_contents($fileName, $contents);
        if ($success === false) {
            $error = error_get_last();
            throw new CouldNotWriteFileException($fileName, $error['message'] ?? 'unknown cause');
        }
    }
}
