<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Exception;

class ObjectNotExistException extends \Exception
{
    public function __construct(string $fileName, string $error)
    {
        parent::__construct(sprintf('Object does not exist: %s (%s)', $fileName, $error));
    }
}
