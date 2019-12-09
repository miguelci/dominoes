<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use function array_pop;
use function array_rand;

class Player
{
    private const INITIAL_TILES = 7;

    private string $name;
    /** @var Tile[] */
    private array $tiles;
    private array $optionsToPlay = ['leftSide' => [], 'rightSide' => []];

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tiles = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTiles(): array
    {
        return $this->tiles;
    }

    public function takeTiles(array $tiles): array
    {
        foreach (array_rand($tiles, self::INITIAL_TILES) as $tileIndex) {
            $this->tiles[(string) $tiles[$tileIndex]->getId()] = $tiles[$tileIndex];
            unset($tiles[$tileIndex]);
        }

        return $tiles;
    }

    public function hasNoMoreTilesToPlay(): bool
    {
        return count($this->tiles) === 0;
    }

    public function takeOneTile(array $tiles): array
    {
        if (empty($tiles)) {
            return [[], []];
        }

        $tileIndex = array_rand($tiles, 1);
        $takenTile = $tiles[$tileIndex];

        $this->tiles[(string) $tiles[$tileIndex]->getId()] = $takenTile;
        unset($tiles[$tileIndex]);

        return [$tiles, $takenTile];
    }

    public function move(Line $line): array
    {
        $tileToAdd = $connected = $firstOption = null;
        [$leftSideToPlay, $rightSideToPlay] = $line->getSideTilesToPlay();

        $this->preparePossibleOptionsToPlay($leftSideToPlay, $rightSideToPlay);
        $totalLeftOptions = count($this->optionsToPlay['leftSide']);
        $totalRightOptions = count($this->optionsToPlay['rightSide']);

        if (
            $this->optionsToPlay['leftSide'] === [] &&
            $this->optionsToPlay['rightSide'] === []
        ) {
            return [$firstOption, $line, $connected];
        }

        if ($totalLeftOptions >= $totalRightOptions) {
            $tileToAdd = array_pop($this->optionsToPlay['leftSide']);
            [$firstOption, $connected] = $this->addToTheLeft(
                $line,
                $tileToAdd,
                $leftSideToPlay
            );
        } elseif ($totalRightOptions >= $totalLeftOptions) {
            $tileToAdd = array_pop($this->optionsToPlay['rightSide']);
            [$firstOption, $connected] = $this->addToTheRight(
                $line,
                $tileToAdd,
                $rightSideToPlay
            );
        }
        unset($this->tiles[(string) $tileToAdd->getId()]);

        return [$firstOption, $line, $connected];
    }

    private function preparePossibleOptionsToPlay(TileSide $leftSideToPlay, TileSide $rightSideToPlay): void
    {
        foreach ($this->tiles as $tile) {
            foreach ($tile->getSides() as $side) {
                if ($leftSideToPlay->getValue() === $side->getValue()) {
                    $this->optionsToPlay['leftSide'][] = $tile;
                }
                if ($rightSideToPlay->getValue() === $side->getValue()) {
                    $this->optionsToPlay['rightSide'][] = $tile;
                }
            }
        }
    }

    private function addToTheLeft(Line $line, Tile $tile, TileSide $leftSideToPlay): array
    {
        if ($tile->getRightSide()->getValue() !== $leftSideToPlay->getValue()) {
            $tile = Tile::toInvertedTile($tile);
        }
        $line->addLeftTile($tile);

        return [$tile, $line->getTiles()[1]];
    }

    private function addToTheRight(Line $line, Tile $tile, TileSide $rightSideToPlay): array
    {
        if ($tile->getLeftSide()->getValue() !== $rightSideToPlay->getValue()) {
            $tile = Tile::toInvertedTile($tile);
        }
        $line->addRightTile($tile);

        return [$tile, $line->getTiles()[count($line->getTiles()) - 2]];
    }
}
