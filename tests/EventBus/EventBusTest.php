<?php
declare(strict_types=1);

namespace Dominoes\EventBus;

use Dominoes\Entity\TileTest;
use Dominoes\Events\GameStarting;
use PHPUnit\Framework\TestCase;

class EventBusTest extends TestCase
{
    /** @var EventBus */
    private $eventBus;

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
        $event = new GameStarting(TileTest::stub());
        $this->eventBus->addEvent($event);
        $this->assertEquals(1, count($this->eventBus->serialize()));
    }

}
