<?php
declare(strict_types=1);

namespace Dominoes\Entity;

class Line
{
    /** @var Tile[] */
    private $tiles;

    /** @param Tile[] $tiles */
    private function __construct(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /** @return Tile[] */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    /** @param Tile[] $tiles */
    public function setTiles(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /** @param Tile[] $tiles */
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

    /** @return TileSide[] */
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

    public function addLeftTile(Tile $tile): void
    {
        array_unshift($this->tiles, $tile);
    }

    public function addRightTile(Tile $tile): void
    {
        array_push($this->tiles, $tile);
    }

    public function __toString(): string
    {
        $currentLine = '';
        foreach ($this->getTiles() as $tile) {
            $currentLine .= (string)$tile . ' ';
        }

        return $currentLine;
    }

}
