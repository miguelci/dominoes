<?php


namespace Dominoes\Events;


use Dominoes\Entity\Tile;

class GameStarting implements Event
{
    /** @var Tile */
    private $tile;

    /**
     * GameStarting constructor.
     *
     * @param Tile $tile
     *
     */
    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Game starting with first tile: " . $this->tile;
    }
}
