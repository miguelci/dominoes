<?php


namespace Dominoes\Events;


use Dominoes\Entity\Player;
use Dominoes\Entity\Tile;

class PlayerPlays implements Event
{
    /** @var Player */
    private $player;
    /**
     * @var Tile
     */
    private $tile;
    /**
     * @var Tile
     */
    private $connected;

    /**
     * PlayerPlays constructor.
     *
     * @param Player $player
     * @param Tile   $tile
     * @param Tile   $connected
     */
    public function __construct(Player $player, Tile $tile, Tile $connected)
    {
        $this->player    = $player;
        $this->tile      = $tile;
        $this->connected = $connected;
    }

    public function __toString()
    {
        return $this->player->getName() . ' plays ' . $this->tile . ' to connect to tile ' . $this->connected . ' on the board.';
    }


}
