<?php

namespace Dominoes\Entity;

use Ramsey\Uuid\Uuid;

class Tile
{

    /** @var Uuid */
    private $id;

    /** @var TileSide[] */
    private $sides;

    /**
     * Tile constructor.
     *
     * @param TileSide[] $sides
     *
     * @throws \Exception
     */
    public function __construct($sides)
    {
        $this->id    = Uuid::uuid4();
        $this->sides = $sides;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return TileSide[]
     */
    public function getSides(): array
    {
        return $this->sides;
    }

    public function __toString()
    {
        return '<' . $this->getSides()[0]->getValue() . ':' . $this->getSides()[1]->getValue() . '>';
    }

}
