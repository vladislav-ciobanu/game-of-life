Game of Life
============

[![Build Status](https://api.travis-ci.org/vladislav-ciobanu/game-of-life.svg?branch=master)](https://travis-ci.org/vladislav-ciobanu/game-of-life)
[![License](http://img.shields.io/:license-MIT-blue.svg)](https://github.com/vladislav-ciobanu/game-of-life/blob/master/LICENSE)

An implementation of Conway's Game of Life

See [wiki](http://en.wikipedia.org/wiki/Conway%27s_Game_of_Life) for more information.

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
*   Install dependencies:
```shell
composer install
```

Usage
--------------------
All the commands should be executed inside the project root:

*   List application help:
```shell
bin/console
```
*   Run the game with the default configuration:
```shell
bin/console play
```

*   Display the additional options of the game:
```shell
bin/console help play
```