<?php

declare(strict_types=1);

namespace Dominoes\EventBus;

use Dominoes\Entity\TileTest;
use Dominoes\Events\{GameFinished, GameStarting};
use PHPUnit\Framework\TestCase;

class EventBusTest extends TestCase
{
    private EventBus $eventBus;

    protected function setUp(): void
    {
        $this->eventBus = EventBusFactory::makeEventBus();
    }

    public function testItCanBeInitialized(): void
    {
        $this->assertInstanceOf(EventBus::class, $this->eventBus);
    }

    public function testEventsCanBeAdded(): void
    {
        $this->eventBus->addEvent(GameStarting::createEvent(TileTest::stub()));
        self::assertCount(1, $this->eventBus->getEvents());
        $this->eventBus->addEvent(GameFinished::createEvent());
        $this->assertCount(2, $this->eventBus->getEvents());
    }
}
