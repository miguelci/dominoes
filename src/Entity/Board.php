<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Service\Generator;

class Board
{
    /** @var Player[] */
    private $players;

    /** @var Tile[] */
    private $tilesToPlay;

    /** @var Line */
    private $line;

    /**
     * @param Player[] $players
     * @param Tile[] $tilesToPlay
     */
    private function __construct(Line $line, array $players, array $tilesToPlay)
    {
        $this->line = $line;
        $this->players = $players;
        $this->tilesToPlay = $tilesToPlay;
    }

    /** @return Player[] */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /** @return Tile[] */
    public function getTilesToPlay(): array
    {
        return $this->tilesToPlay;
    }

    public function getLine(): Line
    {
        return $this->line;
    }

    /** @param Tile[] $tilesToPlay */
    public function setTilesToPlay(array $tilesToPlay)
    {
        $this->tilesToPlay = $tilesToPlay;
    }

    public function setLine(Line $line)
    {
        $this->line = $line;
    }

    public static function init(Generator $tileGenerator): Board
    {
        $alice = new Player('Alice');
        $bob = new Player('Bob');

        $tiles = $tileGenerator::generate();

        $remainingTiles = $alice->takeTiles($tiles);
        $remainingTiles = $bob->takeTiles($remainingTiles);

        list ($line, $remainingTiles) = Line::pickFirstTile($remainingTiles);

        $players = [$alice, $bob];
        shuffle($players); // random order for players

        return new self($line, $players, $remainingTiles);
    }
}
