<?php

declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Line;
use Symfony\Contracts\EventDispatcher\Event;

class BoardIsNow extends Event
{
    private Line $line;

    public function __construct(Line $line)
    {
        $this->line = $line;
    }

    public function __toString(): string
    {
        return 'Board is now: ' . $this->line;
    }
}
