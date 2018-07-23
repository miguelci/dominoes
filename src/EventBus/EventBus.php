<?php


namespace Dominoes\EventBus;


use Dominoes\Events\Event;

class EventBus
{

    /**
     * @var Event[]
     */
    private $events;

    /**
     * EventBus constructor.
     */
    public function __construct()
    {
        $this->events = [];
    }

    /**
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        $this->events[] = [
            'payload' => (string)$event
        ];
    }

    /**
     * Returns with the current events on the event bus
     *
     * @return array
     */
    public function serialize(): array
    {
        return $this->events;
    }

}
