<?php

declare(strict_types=1);

namespace Dominoes\Entity;

class Line
{
    /** @var Tile[] array  */
    private array $tiles;

    public function __construct(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /** @return TileSide[] */
    public function getSideTilesToPlay(): array
    {
        if (count($this->tiles) === 1) {
            return [
                $this->tiles[0]->getLeftSide(),
                $this->tiles[0]->getRightSide(),
            ];
        }

        return [
            $this->tiles[0]->getLeftSide(),
            end($this->tiles)->getRightSide(),
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
            $currentLine .= (string) $tile . ' ';
        }

        return $currentLine;
    }

    public function getTiles(): array
    {
        return $this->tiles;
    }
}
