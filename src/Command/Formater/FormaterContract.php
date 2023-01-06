<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command\Formater;

interface FormaterContract
{
    public function format(string $message): string;
}
