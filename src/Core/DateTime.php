<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

class DateTime
{
    public static function getMillisecond(): string
    {
        $msectime = (float) sprintf('%f', floatval(microtime(true)) * 1000);
        return substr((string) $msectime, 0, 13);
    }
}
