<?php


namespace Dominoes\Events;


use Dominoes\Entity\Player;

class NoMoreTiles implements Event
{

    /** Player $player */
    private $player;

    /**
     * PlayerWon constructor.
     *
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function __toString()
    {
        return "No more tiles.\nPlayer " . $this->player->getName() . ' has won because he has less tiles!';
    }
}
