<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\{Player, Tile};
use Symfony\Contracts\EventDispatcher\Event;

class PlayerPlays extends Event
{
    private Player $player;
    private Tile $tile;
    private Tile $connected;

    public function __construct(Player $player, Tile $tile, Tile $connected)
    {
        $this->player = $player;
        $this->tile = $tile;
        $this->connected = $connected;
    }

    public function __toString(): string
    {
        return $this->player->getName() .
            ' plays ' . $this->tile . ' to connect to tile ' . $this->connected . ' on the board.';
    }
}
