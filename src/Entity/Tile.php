<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use Ramsey\Uuid\Uuid;

class Tile
{
    private string $id;
    private TileSide $leftSide;
    private TileSide $rightSide;
    /** @var TileSide[] */
    private array $sides;

    public function __construct(TileSide $leftSide, TileSide $rightSide)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->leftSide = $leftSide;
        $this->rightSide = $rightSide;
        $this->sides = [$leftSide, $rightSide];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return '<' . $this->getLeftSide()->getValue() . ':' . $this->getRightSide()->getValue() . '>';
    }

    public function getLeftSide(): TileSide
    {
        return $this->leftSide;
    }

    public function getRightSide(): TileSide
    {
        return $this->rightSide;
    }

    public function getSides(): array
    {
        return $this->sides;
    }

    public static function toInvertedTile(Tile $tile): self
    {
        return new self($tile->getRightSide(), $tile->getLeftSide());
    }
}
