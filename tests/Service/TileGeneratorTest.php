<?php

declare(strict_types=1);

namespace Dominoes\Service;

use PHPUnit\Framework\TestCase;

class TileGeneratorTest extends TestCase
{
    public function testItCanGenerateTiles(): void
    {
        $tiles = self::stub();
        self::assertNotEmpty($tiles);
        self::assertCount(28, $tiles);
    }

    public static function stub(): array
    {
        return TileGenerator::generate();
    }
}
