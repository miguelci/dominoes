<?php

namespace Dominoes\Entity;


class TileSide
{

    /** @var int */
    private $value;

    /**
     * TileSide constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
