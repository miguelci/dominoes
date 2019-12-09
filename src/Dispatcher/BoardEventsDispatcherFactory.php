<?php

declare(strict_types=1);

namespace Dominoes\Dispatcher;

use Dominoes\{Events\BoardIsNow,
    Events\GameFinished,
    Events\GameStarting,
    Events\NoMoreTiles,
    Events\PlayerDrawsTile,
    Events\PlayerPlays,
    Events\PlayerWon
};
use Dominoes\Dispatcher\Listener\BoardHistoryListenerFactory;

final class BoardEventsDispatcherFactory
{
    public static function create(): BoardEventsDispatcher
    {
        $dispatcher = new BoardEventsDispatcher();

        $boardHistoryListener = BoardHistoryListenerFactory::create();

        $dispatcher->addListener(GameStarting::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(BoardIsNow::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(NoMoreTiles::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(PlayerDrawsTile::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(PlayerPlays::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(PlayerWon::class, [$boardHistoryListener, 'onEvent']);
        $dispatcher->addListener(GameFinished::class, [$boardHistoryListener, 'onGameFinish']);

        return $dispatcher;
    }
}
