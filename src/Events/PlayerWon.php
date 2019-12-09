<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Player;
use Symfony\Contracts\EventDispatcher\Event;

class PlayerWon extends Event
{
    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function __toString(): string
    {
        return 'Player ' . $this->player->getName() . ' has won!';
    }
}
