<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Events\GameFinished;
use Dominoes\Events\GameStarting;
use Dominoes\Service\{Generator, TileGeneratorTest};
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DominoesBoardTest extends TestCase
{
    private DominoesBoard $board;
    private Generator $generator;
    private EventDispatcherInterface $dispatcher;

    protected function setUp(): void
    {
        $this->generator = $this->createMock(Generator::class);
        $this->dispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->board = new DominoesBoard($this->generator, $this->dispatcher);
    }

    public function testABoardHasTheExpectedValuesOnInitialize(): void
    {
        $this->generator->expects(self::once())
            ->method('generate')
            ->willReturn(TileGeneratorTest::stub());
        $this->dispatcher->expects(self::once())
            ->method('dispatch');

        $this->board->startBoard();

        self::assertCount(2, $this->board->players);
        self::assertCount(1, $this->board->line->getTiles());
        self::assertCount(13, $this->board->tilesToPlay);
        self::assertCount(7, $this->board->players[0]->getTiles());
        self::assertCount(7, $this->board->players[1]->getTiles());
    }

    public function testPlayWithoutStartingTheBoard(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Dominoes board needs to be initialized. Call "startBoard" before starting to play.'
        );
        $this->board->play();
    }
}
