<?php
declare(strict_types=1);

namespace Dominoes\Entity;

use Exception;
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
     * @throws Exception
     */
    public function __construct(array $sides)
    {
        $this->id = Uuid::uuid4();
        $this->sides = $sides;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    /** @return TileSide[] */
    public function getSides(): array
    {
        return $this->sides;
    }

    public function __toString(): string
    {
        return '<' . $this->getSides()[0]->getValue() . ':' . $this->getSides()[1]->getValue() . '>';
    }

}
