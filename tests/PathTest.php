<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class PathTest extends TestCase
{
    public function testSplit()
    {
        $map = [
            ['1.php', ['.']],
            ['tests/1.php', ['tests']],
            ['tests/1/1.php', ['tests', 'tests/1']],
            ['tests/tests/1/1.php', ['tests', 'tests/tests', 'tests/tests/1']],
        ];
        foreach ($map as $key => $value) {
            $this->assertSame(Path::split($value[0]), array_reverse($value[1]));
        }
    }
}
