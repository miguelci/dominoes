<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Tile;
use Symfony\Contracts\EventDispatcher\Event;

class GameStarting extends Event
{
    private Tile $tile;

    private function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }

    public static function createEvent(Tile $tile): self
    {
        return new self($tile);
    }

    public function __toString(): string
    {
        return "Game starting with first tile: " . $this->tile;
    }
}
