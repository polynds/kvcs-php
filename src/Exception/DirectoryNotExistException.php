<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Exception;

class DirectoryNotExistException extends \Exception
{
    public function __construct(string $dirName)
    {
        parent::__construct(sprintf('directory %s does not exist', $dirName));
    }
}
