<?php

declare(strict_types=1);

namespace Dominoes\Service;

use Dominoes\{Entity\Tile, Entity\TileSide};

class TileGenerator implements Generator
{
    const TILE_START = 0;
    const TILE_END = 6;

    public function generate(): array
    {
        $tiles = [];

        for ($leftTile = self::TILE_END; $leftTile >= self::TILE_START; $leftTile--) {
            for ($rightTile = self::TILE_START; $rightTile <= $leftTile; $rightTile++) {
                $tiles[] = new Tile(new TileSide($leftTile), new TileSide($rightTile));
            }
        }
        shuffle($tiles);

        return $tiles;
    }
}
