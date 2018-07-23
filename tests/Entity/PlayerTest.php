<?php


namespace Dominoes\Entity;


use Dominoes\Service\TileGeneratorTest;
use PHPUnit\Framework\TestCase;


class PlayerTest extends TestCase
{
    /** @var Player */
    private $player;

    protected function setUp()
    {
        parent::setUp();
        $this->player = new Player('player_name');
    }

    public function testAPlayerCanBeInstantiated()
    {
        $this->assertInstanceOf(Player::class, $this->player);
    }


    public function testAPlayerCanTakeTheTilesToInitialize()
    {
        $tiles = TileGeneratorTest::stub();

        $this->assertEquals(0, count($this->player->getTiles()));
        $this->player->takeTiles($tiles);
        $this->assertEquals(7, count($this->player->getTiles()));
    }

    public function testAPlayerCanAddTilesToTheLine()
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
