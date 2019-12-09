<?php

declare(strict_types=1);

namespace Dominoes\Controller;

use Dominoes\{Entity\Board};

class BoardController
{
    private Board $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function execute(): void
    {
        $this->board
            ->startBoard()
            ->play();
    }
}
