Game of Life
============

[![Build Status](https://api.travis-ci.org/vladislav-ciobanu/game-of-life.svg?branch=master)](https://travis-ci.org/vladislav-ciobanu/game-of-life)
[![Code Climate](https://codeclimate.com/github/vladislav-ciobanu/game-of-life/badges/gpa.svg)](https://codeclimate.com/github/vladislav-ciobanu/game-of-life)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vladislav-ciobanu/game-of-life/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vladislav-ciobanu/game-of-life/?branch=master)
[![Coverage Status](https://coveralls.io/repos/vladislav-ciobanu/game-of-life/badge.svg?branch=master)](https://coveralls.io/r/vladislav-ciobanu/game-of-life?branch=master)
[![License](http://img.shields.io/:license-MIT-blue.svg)](https://github.com/vladislav-ciobanu/game-of-life/blob/master/LICENSE)

An implementation of Conway's Game of Life

See [wiki](http://en.wikipedia.org/wiki/Conway%27s_Game_of_Life) for more information.

Prerequisites
--------------------

*   PHP >= 5.3
*   [Composer](https://getcomposer.org/)
```shell
curl -s https://getcomposer.org/installer | php
```

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
