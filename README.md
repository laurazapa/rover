# Mars rover

## Project setup
### Composer installation
This project needs composer to be installed:
```
https://getcomposer.org/download/
```

### Start project
Open a terminal, go to the project root and run:

```
composer install
```

```
php artisan key:generate
```

```
php artisan config:cache
```

```
php artisan serve
```

## Run tests
To run the tests, open a terminal and run from the root:
```
php artisan test
```

## About the project
This project is a software that translates the commands sent from earth to instructions that are understood by a Mars rover.

### Basic information
● You are given the initial starting point (X,Y) of a rover and the direction (N,S,E,W) it is facing.
● The rover receives a collection of commands. (E.g.) FFRRFFFRL
● The rover can move forward (F).
● The rover can move left/right (L,R).
● The planet is square (200x200) and has two obstacles, one at coordinate (8,8) and another one at coordinate (5,2). 
● The rover returns the last position reached and the directioin it is facing. If a given sequence of commands encounters an obstacle, the rover moves up to the last possible point, aborts the sequence and reports the obstacle. If the rover reaches the end of the planet, it wraps to the start.
