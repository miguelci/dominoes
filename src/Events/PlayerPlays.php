<?php
declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Player;
use Dominoes\Entity\Tile;

class PlayerPlays implements Event
{
    /** @var Player */
    private $player;

    /** @var Tile */
    private $tile;

    /** @var Tile */
    private $connected;

    public function __construct(Player $player, Tile $tile, Tile $connected)
    {
        $this->player = $player;
        $this->tile = $tile;
        $this->connected = $connected;
    }

    public function __toString(): string
    {
        return $this->player->getName() . ' plays ' . $this->tile . ' to connect to tile ' . $this->connected . ' on the board.';
    }
}
