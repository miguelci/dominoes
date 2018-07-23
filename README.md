
# Dominoes programming exercise:

Write a program which allows two players to play Dominoes against each other:
- The 28 tiles are shuffled face down and form the stock. Each player draws seven tiles.
- Pick a random tile to start the line of play.
- The players alternately extend the line of play with one tile at one of its two ends;
- A tile may only be placed next to another tile, if their respective values on the
connecting ends are identical.
- If a player is unable to place a valid tile, they must keep on pulling tiles from the stock
until they can.
- The game ends when one player wins by playing their last tile.
- You're not supposed to create an interactive application. Just write a program that will
follow the rules above.

## To use the application do:
    - composer install
    - php app.php
    
## To run the tests:
    - bin/phpunit tests/ --color
    
## Requires:
- PHP 7

#### Notes
- Sometimes it's not possible to finish the game because there are no more possibilities
- Three attempts are made possible and then the game stops
- The player with less tiles wins.
