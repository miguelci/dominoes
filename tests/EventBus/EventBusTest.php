<?php


namespace Dominoes\EventBus;


use Dominoes\Entity\TileTest;
use Dominoes\Events\GameStarting;
use PHPUnit\Framework\TestCase;

class EventBusTest extends TestCase
{
    /** @var EventBus */
    private $eventBus;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->eventBus = EventBusFactory::makeEventBus();
    }

    public function testItCanBeInitialized()
    {
        $this->assertInstanceOf(EventBus::class, $this->eventBus);
    }

    public function testEventsCanBeAdded()
    {
        $event = new GameStarting(TileTest::stub());
        $this->eventBus->addEvent($event);
        $this->assertEquals(1, count($this->eventBus->serialize()));
    }

}
