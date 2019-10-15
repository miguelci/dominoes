<?php
declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Tile;

class GameStarting implements Event
{
    /** @var Tile */
    private $tile;

    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }

    public function __toString(): string
    {
        return "Game starting with first tile: " . $this->tile;
    }
}
