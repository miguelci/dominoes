<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use PHPUnit\Framework\TestCase;

class TileSideTest extends TestCase
{
    const SIDE_VALUE = 1;

    public function testItReturnsCorrectValue(): void
    {
        $tileSide = new TileSide(self::SIDE_VALUE);
        self::assertEquals(self::SIDE_VALUE, $tileSide->getValue());
    }
}
