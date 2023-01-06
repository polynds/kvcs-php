<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command\Formater;

class DefaultFormater implements FormaterContract
{
    public function format(string $message): string
    {
        return $message . PHP_EOL;
    }
}
