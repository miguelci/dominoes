# Dominoes - programming exercise

Dominoes is a family of games played with rectangular tiles. Each tile is divided into two square ends.
Each end is marked with a number (one to six) of spots or is blank. There are 28 tiles,
one for each combination of spots and blanks.

## Requirements

To run this app locally you will need to be running locally php 7.4 and have 
[composer](https://getcomposer.org/doc/00-intro.md).
 
In alternative, you'll need to have [docker](https://docs.docker.com/v17.09/engine/installation/) running locally.

### With php 7.4 installed locally

1. Do `composer install` in the root of the project
2. Do `php app.php` to see the application running
3. Do `bin/phpunit` to run the tests

### With Docker

There are 3 script files available in the root folder:
1. `run.sh` builds the docker image (if not available) and runs the application
2. `run_tests.sh` builds the docker image (if not available) and runs the tests
3. `edit.sh` to go into the container with the current path as mounted volume

* note: all of these files need to have execute flag, run `chmod +x {filename}`
