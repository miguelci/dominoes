<?php

declare(strict_types=1);

namespace Dominoes\Entity;

use Dominoes\Events\{BoardIsNow, GameFinished, GameStarting, NoMoreTiles, PlayerDrawsTile, PlayerPlays, PlayerWon};
use Dominoes\Service\Generator;
use RuntimeException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

use function array_rand;
use function min;

class DominoesBoard implements Board
{
    private const MAX_FINISHING_ATTEMPTS = 3;

    private Generator $generator;
    private EventDispatcherInterface $boardEventsDispatcher;

    public Line $line;
    /** @var Player[] */
    public array $players = [];
    public array $tilesToPlay = [];

    private int $finishingAttempts = 0;
    private bool $someoneFinished = false;

    public function __construct(Generator $generator, EventDispatcherInterface $boardEventsDispatcher)
    {
        $this->generator = $generator;
        $this->boardEventsDispatcher = $boardEventsDispatcher;
    }

    public function startBoard(): self
    {
        $alice = new Player('Alice');
        $bob = new Player('Bob');
        $this->players = [$alice, $bob];

        $remainingTiles = $alice->takeTiles($this->generator->generate());
        $remainingTiles = $bob->takeTiles($remainingTiles);
        $index = array_rand($remainingTiles, 1);

        $firstTile = $remainingTiles[$index];
        unset($remainingTiles[$index]);

        shuffle($this->players); // random order for players

        $this->line = new Line([$firstTile]);
        $this->tilesToPlay = $remainingTiles;

        $this->boardEventsDispatcher->dispatch(GameStarting::createEvent($this->line->getTiles()[0]));

        return $this;
    }

    public function play(): void
    {
        if ($this->players === []) {
            throw new RuntimeException(
                'Dominoes board needs to be initialized. Call "startBoard" before starting to play.'
            );
        }

        while (! $this->someoneFinished) {
            foreach ($this->players as $player) {
                $this->movePlayerOnTheBoard($player);

                if ($player->hasNoMoreTilesToPlay()) {
                    $this->someoneFinished = true;
                    $this->boardEventsDispatcher->dispatch(new PlayerWon($player));
                    break;
                }

                if ($this->availableAttemptsAreOver()) {
                    $this->someoneFinished = true;
                    $this->boardEventsDispatcher->dispatch(new NoMoreTiles(min($this->players[0], $this->players[1])));
                    break;
                }
            }
        }
        $this->boardEventsDispatcher->dispatch(GameFinished::createEvent());
    }

    private function movePlayerOnTheBoard(Player $player): void
    {
        $tile = null;
        while ($tile === null) {
            [$tile, $line, $connected] = $player->move($this->line);

            if ($tile) {
                $this->line = $line;
                $this->boardEventsDispatcher->dispatch(new PlayerPlays($player, $tile, $connected));
                $this->boardEventsDispatcher->dispatch(new BoardIsNow($this->line));
                break;
            }

            if (empty($this->tilesToPlay)) {
                $this->finishingAttempts++;
                break;
            }

            [$remainingTiles, $takenTile] = $player->takeOneTile($this->tilesToPlay);
            $this->boardEventsDispatcher->dispatch(new PlayerDrawsTile($player, $takenTile));
            $this->tilesToPlay = $remainingTiles;
        }
    }

    private function availableAttemptsAreOver(): bool
    {
        return $this->finishingAttempts > self::MAX_FINISHING_ATTEMPTS;
    }
}
