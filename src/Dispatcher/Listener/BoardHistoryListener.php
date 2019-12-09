<?php

declare(strict_types=1);

namespace Dominoes\Dispatcher\Listener;

use Dominoes\EventBus\EventBus;
use Dominoes\Writer\Writer;
use Symfony\Contracts\EventDispatcher\Event;

use function array_map;

final class BoardHistoryListener
{
    private EventBus $eventBus;
    private Writer $writer;

    public function __construct(EventBus $eventBus, Writer $writer)
    {
        $this->eventBus = $eventBus;
        $this->writer = $writer;
    }

    public function onEvent(Event $event): void
    {
        $this->eventBus->addEvent($event);
    }

    public function onGameFinish(): void
    {
        array_map(fn($event) => $this->writer->write($event), $this->eventBus->getEvents());
    }
}
