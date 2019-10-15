<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Entity\TileSide;
use PHPUnit\Framework\TestCase;

class TileSideTest extends TestCase
{
    const SIDE_VALUE = 1;

    /** @var TileSide */
    private $tileSide;

    protected function setUp(): void
    {
        $this->tileSide = new TileSide(self::SIDE_VALUE);
    }

    public function testItCanBeInstantiated(): void
    {
        $this->assertInstanceOf(TileSide::class, $this->tileSide);
    }

    public function testItReturnsCorrectInitializationValues(): void
    {
        $this->assertEquals(self::SIDE_VALUE, $this->tileSide->getValue());
    }

    public static function stubForTile(): array
    {
        return [new TileSide(1), new TileSide(2)];
    }

    public static function stubForTileSameValue(): array
    {
        return [new TileSide(3), new TileSide(3)];
    }
}
