<?php


namespace Dominoes\Entity;


use Dominoes\Entity\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{

    /** @var Line */
    private $line;

    protected function setUp()
    {
        list($this->line) = Line::pickFirstTile(TileTest::stubForLine());
    }

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(Line::class, $this->line);
    }

    public static function stub()
    {
        list($line) = Line::pickFirstTile(TileTest::stubForLine());

        return $line;
    }
}
