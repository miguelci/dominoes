<?php


namespace Dominoes\Events;


use Dominoes\Entity\Line;

class BoardIsNow implements Event
{

    /** @var Line $line */
    private $line;

    /**
     * BoardIsNow constructor.
     *
     * @param Line $line
     */
    public function __construct(Line $line)
    {
        $this->line = $line;
    }

    public function __toString()
    {
        return 'Board is now: ' . $this->line;
    }
}
