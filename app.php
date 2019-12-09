<?php

use Dominoes\{Controller\BoardController,
    Dispatcher\BoardEventsDispatcherFactory,
    Entity\DominoesBoard,
    Service\TileGenerator
};

require_once 'vendor/autoload.php';

$controller = new BoardController(new DominoesBoard(new TileGenerator(), BoardEventsDispatcherFactory::create()));
$controller->execute();
