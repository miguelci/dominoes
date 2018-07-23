<?php


namespace Dominoes\Entity;


use Dominoes\Entity\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    /** @var Tile */
    private $tile;

    /**
     * @throws \Exception
     */
    protected function setUp()
    {
        $this->tile = new Tile(TileSideTest::stubForTile());
    }

    public function testItCanBeInstantiated()
    {
        $this->assertInstanceOf(Tile::class, $this->tile);
    }

    /**
     * @return Tile
     * @throws \Exception
     */
    public static function stub(): Tile
    {
        return new Tile(TileSideTest::stubForTile());
    }

    /**
     * @return Tile[]
     * @throws \Exception
     */
    public static function stubForLine(): array
    {
        return [new Tile(TileSideTest::stubForTile())];
    }

    /**
     * @return Tile[]
     * @throws \Exception
     */
    public static function stubForLineSameValue(): array
    {
        return [new Tile(TileSideTest::stubForTileSameValue())];
    }
}
