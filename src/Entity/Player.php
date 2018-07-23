<?php


namespace Dominoes\Entity;


class Player
{
    const TILES_TO_TAKE = 7;

    /** @var string */
    private $name;

    /** @var Tile[] */
    private $tiles;

    /**
     * Player constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name  = $name;
        $this->tiles = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    /**
     * @param array $tiles
     *
     * @return array
     */
    public function takeTiles(array $tiles): array
    {
        foreach (array_rand($tiles, self::TILES_TO_TAKE) as $tileIndex) {
            $this->tiles[(string)$tiles[$tileIndex]->getId()] = $tiles[$tileIndex];
            unset($tiles[$tileIndex]);
        }

        return $tiles;
    }

    public function takeOneTile($tiles)
    {
        if (empty($tiles)) {
            return [[], []];
        }

        $tileIndex = array_rand($tiles, 1);
        $takenTile = $tiles[$tileIndex];

        $this->tiles[(string)$tiles[$tileIndex]->getId()] = $takenTile;
        unset($tiles[$tileIndex]);
        return [
            $tiles,
            $takenTile
        ];

    }

    /**
     * @param Line $line
     *
     * @return array
     * @throws \Exception
     */
    public function move(Line $line)
    {
        /** @var Tile $endTiles */
        $endTiles = $line->getSideTilesToPlay();

        $leftSideToPlay  = $endTiles[0];
        $rightSideToPlay = $endTiles[1];
        $index           = null;
        $connected       = null;
        $firstOption     = null;

        $options = $this->getPossibleOptionsToPlay($leftSideToPlay, $rightSideToPlay);

        $totalLeftOptions  = count($options['left_side_options']);
        $totalRightOptions = count($options['right_side_options']);

        if (! $options['left_side_options'] && ! $options['right_side_options']) {
            return [$firstOption, $line, $connected];
        }

        if ($totalLeftOptions >= $totalRightOptions) {
            $firstOption = array_pop($options['left_side_options']);
            $index       = (string)$firstOption->getId();
            $sides       = $firstOption->getSides();

            if ($sides[1]->getValue() !== $leftSideToPlay->getValue()) {
                $firstOption = new Tile([$sides[1], $sides[0]]);
            }

            $connected = $line->getTiles()[0];
            $line->addLeftTile($firstOption);

        } elseif ($totalRightOptions >= $totalLeftOptions) {

            $firstOption = array_pop($options['right_side_options']);
            $index       = (string)$firstOption->getId();

            $sides = $firstOption->getSides();
            if ($sides[0]->getValue() !== $rightSideToPlay->getValue()) {
                $firstOption = new Tile([$sides[1], $sides[0]]);
            }

            $connected = end($line->getTiles());
            $line->addRightTile($firstOption);
        }

        unset($this->tiles[$index]);
        return [$firstOption, $line, $connected];
    }

    /**
     * @param $leftSideToPlay
     * @param $rightSideToPlay
     *
     * @return mixed
     */
    private function getPossibleOptionsToPlay($leftSideToPlay, $rightSideToPlay)
    {
        $options = [];
        foreach ($this->tiles as $tile) {
            foreach ($tile->getSides() as $side) {
                if ($leftSideToPlay->getValue() === $side->getValue()) {
                    $options['left_side_options'][] = $tile;
                }
                if ($rightSideToPlay->getValue() === $side->getValue()) {
                    $options['right_side_options'][] = $tile;
                }
            }
        }
        return $options;
    }

}
