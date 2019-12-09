<?php

declare(strict_types=1);

namespace Dominoes\Dispatcher\Listener;

use Dominoes\EventBus\EventBusFactory;
use Dominoes\Writer\ConsoleWriter;

final class BoardHistoryListenerFactory
{
    public static function create(): BoardHistoryListener
    {
        return new BoardHistoryListener(
            EventBusFactory::makeEventBus(),
            new ConsoleWriter()
        );
    }
}
