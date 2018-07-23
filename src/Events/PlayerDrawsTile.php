<?php


namespace Dominoes\Events;


use Dominoes\Entity\Player;
use Dominoes\Entity\Tile;

class PlayerDrawsTile implements Event
{
    /**
     * @var Player
     */
    private $player;
    /**
     * @var Tile
     */
    private $takenTile;

    /**
     * PlayerDrawsTile constructor.
     *
     * @param Player $player
     * @param Tile   $takenTile
     */
    public function __construct(Player $player, Tile $takenTile)
    {
        $this->player    = $player;
        $this->takenTile = $takenTile;
    }

    public function __toString()
    {
        return $this->player->getName() . ' can\'t play, drawing tile ' . $this->takenTile;
    }
}
