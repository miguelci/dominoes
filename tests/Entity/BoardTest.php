<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Service\TileGenerator;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    /** @var Board */
    private $board;

    protected function setUp(): void
    {
        $this->board = Board::init(new TileGenerator());
    }

    public function testABoardCanBeInstantiated(): void
    {
        $this->assertInstanceOf(Board::class, $this->board);
    }

    public function testABoardHasTheExpectedValuesOnInitialize(): void
    {
        $this->assertEquals(2, count($this->board->getPlayers()));
        $this->assertEquals(1, count($this->board->getLine()->getTiles()));
        $this->assertEquals(13, count($this->board->getTilesToPlay()));
    }
}
