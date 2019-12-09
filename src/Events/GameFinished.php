<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Symfony\Contracts\EventDispatcher\Event;

final class GameFinished extends Event
{
    public static function createEvent(): self
    {
        return new self();
    }

    public function __toString(): string
    {
        return '';
    }
}
