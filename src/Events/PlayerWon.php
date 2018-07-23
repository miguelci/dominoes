<?php


namespace Dominoes\Events;


use Dominoes\Entity\Player;

class PlayerWon implements Event
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
        return 'Player ' . $this->player->getName() . ' has won!';
    }
}
