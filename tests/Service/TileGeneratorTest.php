<?php
declare(strict_types=1);

namespace Dominoes\Service;

use PHPUnit\Framework\TestCase;

class TileGeneratorTest extends TestCase
{
    public function testItCanGenerateTiles(): void
    {
        $tiles = TileGenerator::generate();
        $this->assertNotEmpty($tiles);
        $this->assertEquals(28, count($tiles));
    }

    public static function stub(): array
    {
        return TileGenerator::generate();
    }
}
