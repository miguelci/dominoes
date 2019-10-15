<?php
declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Player;

class PlayerWon implements Event
{
    /** Player $player */
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function __toString(): string
    {
        return 'Player ' . $this->player->getName() . ' has won!';
    }
}
