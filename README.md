Game of Life
============

An implementation of Conway's Game of Life

See [wiki](http://en.wikipedia.org/wiki/Conway%27s_Game_of_Life) for more information.

[![Build Status](https://api.travis-ci.org/vladislav-ciobanu/game-of-life.svg?branch=master)](https://travis-ci.org/vladislav-ciobanu/game-of-life)


Prerequisites
--------------------

*   PHP >= 5.3
*   [Composer](https://getcomposer.org/)


Installation
--------------------
*   Clone the repository: 
```shell
git clone https://github.com/vladislav-ciobanu/game-of-life.git
```
*   Inside the project root:
```shell
composer install
```

Usage
--------------------
All the commands should be executed inside the project root:

*   List application help   
```shell
bin/console
```
*   Run the default configuration of the game:
```shell
bin/console play
```

*   Display the additional options of the game:
```shell
bin/console help play
```