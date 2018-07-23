<?php


namespace Dominoes\EventBus;


class EventBusFactory
{
    /**
     * @return EventBus
     */
    public static function makeEventBus()
    {
        return new EventBus();
    }

}
