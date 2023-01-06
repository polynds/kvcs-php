<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;
use Kit\Exception\ParameterErrorException;

class CatFileCommand extends AbstractCommand
{
    protected function handle(array $parameter = [])
    {
        $hash = $parameter[0] ?? '';
        $database = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        $this->print($database->cat($hash) ?? '');
    }

    protected function validated(array $parameter = []): array
    {
        $hash = $parameter[0] ?? '';
        if (! $hash) {
            throw new ParameterErrorException('The file name cannot be empty.');
        }
        return $parameter;
    }
}
