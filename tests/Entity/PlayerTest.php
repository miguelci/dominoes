<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Service\TileGeneratorTest;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    private Player $player;

    protected function setUp(): void
    {
        $this->player = new Player('player_name');
    }

    public function testAPlayerCanTakeTheCorrectAmountOfTiles(): void
    {
        $tiles = TileGeneratorTest::stub();

        self::assertCount(0, $this->player->getTiles());

        $remainingTiles = $this->player->takeTiles($tiles);
        self::assertCount(7, $this->player->getTiles());
        self::assertCount(21, $remainingTiles);
    }

    public function testAPlayerCanAddTilesToTheLine(): void
    {
        /** @var Line $initializeLine */
        $initializeLine = LineTest::stub();

        $tiles = TileGeneratorTest::stub();
        $this->player->takeTiles($tiles);

        [$_, $line, $connected] = $this->player->move($initializeLine);

        self::assertCount(2, $line->getTiles());
        self::assertInstanceOf(Tile::class, $connected);
    }

    public function testAPlayerWillAddACorrectTileToTheLine(): void
    {
        $tiles = [...TileGeneratorTest::stub(), new Tile(new TileSide(1), new TileSide(1))];
        $this->player->takeTiles($tiles);

        /** @var Line $line */
        [$_1, $line, $_2] = $this->player->move(LineTest::stub());

        /** @var Tile[] $tiles */
        $tiles = $line->getTiles();
        self::assertEquals($tiles[0]->getRightSide(), $tiles[1]->getLeftSide());
    }
}
