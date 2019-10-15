<?php
declare(strict_types=1);

namespace Dominoes\EventBus;

use Dominoes\Events\Event;

class EventBus
{
    /** @var Event[] */
    private $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function addEvent(Event $event): void
    {
        $this->events[] = [
            'payload' => (string)$event
        ];
    }

    public function serialize(): array
    {
        return $this->events;
    }
}
