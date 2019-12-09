<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Player;
use Dominoes\Entity\Tile;
use Symfony\Contracts\EventDispatcher\Event;

class PlayerDrawsTile extends Event
{
    private Player $player;
    private Tile $takenTile;

    public function __construct(Player $player, Tile $takenTile)
    {
        $this->player = $player;
        $this->takenTile = $takenTile;
    }

    public function __toString(): string
    {
        return $this->player->getName() . ' can\'t play, drawing tile ' . $this->takenTile;
    }
}
