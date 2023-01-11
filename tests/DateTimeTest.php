<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class DateTimeTest extends TestCase
{
    public function testGetMillisecond()
    {
        $millisecond = DateTime::getMillisecond();
        $this->assertNotEmpty($millisecond);
    }
}
