<?php


namespace Dominoes\Service;


use Dominoes\Entity\Tile;

interface Generator
{

    /**
     * @return Tile[]
     */
    public static function generate(): array;

}
