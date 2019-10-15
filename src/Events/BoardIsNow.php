<?php
declare(strict_types=1);

namespace Dominoes\Events;

use Dominoes\Entity\Line;

class BoardIsNow implements Event
{
    /** @var Line $line */
    private $line;

    public function __construct(Line $line)
    {
        $this->line = $line;
    }

    public function __toString(): string
    {
        return 'Board is now: ' . $this->line;
    }
}
