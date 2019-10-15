<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Entity\Tile;
use Exception;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    /** @var Tile */
    private $tile;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->tile = new Tile(TileSideTest::stubForTile());
    }

    public function testItCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Tile::class, $this->tile);
    }

    /**
     * @return Tile
     * @throws Exception
     */
    public static function stub(): Tile
    {
        return new Tile(TileSideTest::stubForTile());
    }

    /**
     * @return Tile[]
     * @throws Exception
     */
    public static function stubForLine(): array
    {
        return [new Tile(TileSideTest::stubForTile())];
    }

    /**
     * @return Tile[]
     * @throws Exception
     */
    public static function stubForLineSameValue(): array
    {
        return [new Tile(TileSideTest::stubForTileSameValue())];
    }
}
