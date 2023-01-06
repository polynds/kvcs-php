<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command\Formater;

class LogFormater implements FormaterContract
{
    public function format(string $message): string
    {
        return '[' . date('Y-m-d H:i:s') . ']' . $message . PHP_EOL;
    }
}
