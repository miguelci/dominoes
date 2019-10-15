<?php
declare(strict_types=1);

namespace Dominoes\Service;

use Dominoes\Entity\Tile;

interface Generator
{
    /** @return Tile[] */
    public static function generate(): array;
}
