<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Player;
use Symfony\Contracts\EventDispatcher\Event;

class NoMoreTiles extends Event
{
    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function __toString(): string
    {
        return "No more tiles.\n" . $this->player->getName() . ' has won because the player has less tiles!';
    }
}
