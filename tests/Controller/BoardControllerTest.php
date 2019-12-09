<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Controller\BoardController;
use PHPUnit\Framework\{TestCase};

final class BoardControllerTest extends TestCase
{
    public function testControllerExecution(): void
    {
        $board = $this->createMock(Board::class);
        $controller = new BoardController($board);

        $board->expects(self::at(0))
            ->method('startBoard')
            ->willReturn($board);

        $board->expects(self::at(1))
            ->method('play');

        $controller->execute();
    }
}
