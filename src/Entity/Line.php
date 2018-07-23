<?php


namespace Dominoes\Entity;


class Line
{

    /** @var Tile[] */
    private $tiles;

    /**
     * Line constructor.
     *
     * @param Tile[] $tiles
     */
    private function __construct(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    /**
     * @param Tile[] $tiles
     */
    public function setTiles(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /**
     * @param Tile[] $tiles
     *
     * @return array
     */
    public static function pickFirstTile(array $tiles): array
    {
        $index = array_rand($tiles, 1);
        $sides = [];

        foreach ($tiles[$index]->getSides() as $key => $tileSides) {
            $sides[] = $tileSides;
        }
        $firstTile = $tiles[$index];
        unset($tiles[$index]);

        return [
            new self([$firstTile]),
            $tiles
        ];
    }

    /**
     * @return TileSide[]
     */
    public function getSideTilesToPlay(): array
    {
        if (count($this->tiles) === 1) {
            return [
                $this->tiles[0]->getSides()[0],
                $this->tiles[0]->getSides()[1]
            ];
        }
        return [
            $this->tiles[0]->getSides()[0],
            end($this->tiles)->getSides()[1]
        ];
    }

    /**
     * @param Tile $tile
     */
    public function addLeftTile($tile)
    {
        array_unshift($this->tiles, $tile);
    }

    /**
     * @param Tile $tile
     */
    public function addRightTile($tile)
    {
        array_push($this->tiles, $tile);
    }

    public function __toString()
    {
        $currentLine = '';
        foreach ($this->getTiles() as $tile) {
            $currentLine .= (string)$tile . ' ';
        }

        return $currentLine;
    }

}
