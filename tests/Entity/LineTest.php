<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Entity\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    /** @var Line */
    private $line;

    protected function setUp(): void
    {
        list($this->line) = Line::pickFirstTile(TileTest::stubForLine());
    }

    public function testCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Line::class, $this->line);
    }

    public static function stub(): Line
    {
        list($line) = Line::pickFirstTile(TileTest::stubForLine());

        return $line;
    }
}
