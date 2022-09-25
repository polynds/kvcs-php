<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Command;

interface CommandContract
{
    public function execute(array $parameter = []);
}
