<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    private const LEFT_SIDE = 1;
    private const RIGHT_SIDE = 2;

    public function testItCanBeCorrectlyInstantiated(): void
    {
        $tile = new Tile(new TileSide(self::LEFT_SIDE), new TileSide(self::RIGHT_SIDE));

        self::assertInstanceOf(Tile::class, $tile);
        self::assertEquals(1, $tile->getLeftSide()->getValue());
        self::assertEquals(2, $tile->getRightSide()->getValue());
    }

    public static function stub(): Tile
    {
        return new Tile(new TileSide(1), new TileSide(2));
    }

    public static function stubForLine(): array
    {
        return [new Tile(new TileSide(1), new TileSide(2))];
    }
}
