<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Service\TileGeneratorTest;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /** @var Player */
    private $player;

    protected function setUp(): void
    {
        parent::setUp();
        $this->player = new Player('player_name');
    }

    public function testAPlayerCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Player::class, $this->player);
    }


    public function testAPlayerCanTakeTheTilesToInitialize(): void
    {
        $tiles = TileGeneratorTest::stub();

        $this->assertEquals(0, count($this->player->getTiles()));
        $this->player->takeTiles($tiles);
        $this->assertEquals(7, count($this->player->getTiles()));
    }

    public function testAPlayerCanAddTilesToTheLine(): void
    {
        /** @var Line $initializeLine */
        $initializeLine = LineTest::stub();

        $tiles = TileGeneratorTest::stub();
        $this->player->takeTiles($tiles);

        list( $_, $line, $connected ) = $this->player->move($initializeLine);

        $this->assertEquals(2, count($line->getTiles()));
        $this->assertInstanceOf(Tile::class, $connected);

    }
}
