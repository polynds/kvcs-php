<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Exception;

use Exception;

class CommandDoesNotExistException extends Exception
{
    public function __construct()
    {
        parent::__construct('command does not exist');
    }
}
