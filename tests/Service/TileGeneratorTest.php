<?php


namespace Dominoes\Service;


use PHPUnit\Framework\TestCase;

class TileGeneratorTest extends TestCase
{

    public function testItCanGenerateTiles()
    {
        $tiles = TileGenerator::generate();
        $this->assertNotEmpty($tiles);
        $this->assertEquals(28, count($tiles));
    }

    public static function stub()
    {
        return TileGenerator::generate();
    }

}
