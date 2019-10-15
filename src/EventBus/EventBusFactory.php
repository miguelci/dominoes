<?php
declare(strict_types=1);

namespace Dominoes\EventBus;

class EventBusFactory
{
    public static function makeEventBus(): EventBus
    {
        return new EventBus();
    }
}
