<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    private Line $line;

    protected function setUp(): void
    {
        $this->line = new Line(TileTest::stubForLine());
    }

    public function testReturnsCorrectSidesForFirstTile(): void
    {
        [$left, $right] = $this->line->getSideTilesToPlay();
        self::assertEquals(1, $left->getValue());
        self::assertEquals(2, $right->getValue());
    }

    public function testReturnsCorrectSidesWhenAddingToTheLeft(): void
    {
        $this->line->addLeftTile(new Tile(new TileSide(3), new TileSide(4)));
        [$left, $right] = $this->line->getSideTilesToPlay();

        self::assertEquals(3, $left->getValue());
        self::assertEquals(2, $right->getValue());
    }

    public function testReturnsCorrectSidesWhenAddingToTheRight(): void
    {
        $this->line->addRightTile(new Tile(new TileSide(3), new TileSide(4)));
        [$left, $right] = $this->line->getSideTilesToPlay();

        self::assertEquals(1, $left->getValue());
        self::assertEquals(4, $right->getValue());
    }

    public static function stub(): Line
    {
        return new Line(TileTest::stubForLine());
    }
}
