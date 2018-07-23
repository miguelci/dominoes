<?php


namespace Dominoes\Controller;


use Dominoes\Entity\Board;
use Dominoes\Entity\Player;
use Dominoes\EventBus\EventBus;
use Dominoes\EventBus\EventBusFactory;
use Dominoes\Events\BoardIsNow;
use Dominoes\Events\GameStarting;
use Dominoes\Events\NoMoreTiles;
use Dominoes\Events\PlayerDrawsTile;
use Dominoes\Events\PlayerPlays;
use Dominoes\Events\PlayerWon;
use Dominoes\Service\TileGenerator;

class BoardController
{
    /** @var EventBus */
    private $eventBus;

    /** @var Board */
    private $board;

    /**
     * BoardController constructor.
     *
     */
    public function __construct()
    {
        $this->eventBus = EventBusFactory::makeEventBus();
        $this->board    = Board::init(new TileGenerator());
    }

    public function execute()
    {
        $this->eventBus->addEvent(new GameStarting($this->board->getLine()->getTiles()[0]));

        $finishingAttempts = 0;
        $someoneFinished   = false;
        $players           = $this->board->getPlayers();

        while (! $someoneFinished) {

            foreach ($players as $player) {

                $finishingAttempts = $this->movePlayerOnTheBoard($player, $finishingAttempts);

                $this->eventBus->addEvent(new BoardIsNow($this->board->getLine()));

                if ($this->playerTilesFinished($player)) {
                    $someoneFinished = true;
                    break;
                }

                if ($this->availableTilesAreOver($players, $finishingAttempts)) {
                    $someoneFinished = true;
                    break;
                }
            }
        }

        foreach ($this->eventBus->serialize() as $event) {
            echo $event['payload'] . PHP_EOL;
        }
    }

    /**
     * @param $tile
     * @param $player
     * @param $finishingAttempts
     *
     * @return mixed
     */
    private function movePlayerOnTheBoard($player, $finishingAttempts)
    {
        $tile = null;
        while (! isset($tile)) {
            list($tile, $line, $connected) = $player->move($this->board->getLine());

            if ($tile) {
                $this->board->setLine($line);
                $this->eventBus->addEvent(new PlayerPlays($player, $tile, $connected));

            } else {

                if (empty($this->board->getTilesToPlay())) {
                    $finishingAttempts++;
                    break;
                }

                list($remainingTiles, $takenTile) = $player->takeOneTile($this->board->getTilesToPlay());
                $this->board->setTilesToPlay($remainingTiles);
                $this->eventBus->addEvent(new PlayerDrawsTile($player, $takenTile));
            }
        }
        return $finishingAttempts;
    }

    /**
     * @param Player $player
     *
     * @return bool
     */
    private function playerTilesFinished(Player $player): bool
    {
        if (count($player->getTiles()) == 0) {
            $this->eventBus->addEvent(new PlayerWon($player));
            return true;

        }
        return false;
    }

    /**
     * @param Player[] $players
     * @param int      $finishingAttempts
     *
     * @return bool
     */
    private function availableTilesAreOver(array $players, int $finishingAttempts): bool
    {
        if ($finishingAttempts >= 3) {
            $player = min($players[0], $players[1]);
            $this->eventBus->addEvent(new NoMoreTiles($player));
            return true;

        }
        return false;
    }

}
