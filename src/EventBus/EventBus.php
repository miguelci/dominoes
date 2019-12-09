<?php

declare(strict_types=1);

namespace Dominoes\EventBus;

use Symfony\Contracts\EventDispatcher\Event;

class EventBus
{
    /** @var Event[] */
    private array $events = [];

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(Event $event): void
    {
        $this->events = [...$this->events, (string) $event];
    }
}
