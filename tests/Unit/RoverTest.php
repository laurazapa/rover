<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Rover; 


class RoverTest extends TestCase
{
    public function test_rover_rotates_right()
    {
        $result = Rover::execute('R', 'N', 0, 0);
        $expected = '0:0:E';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RR', 'N', 0, 0);
        $expected = '0:0:S';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRR', 'N', 0, 0);
        $expected = '0:0:W';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRRR', 'N', 0, 0);
        $expected = '0:0:N';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_rotates_left()
    {
        $result = Rover::execute('L', 'N', 0, 0);
        $expected = '0:0:W';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('LL', 'N', 0, 0);
        $expected = '0:0:S';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('LLL', 'N', 0, 0);
        $expected = '0:0:E';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('LLLL', 'N', 0, 0);
        $expected = '0:0:N';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_moves_north()
    {
        $result = Rover::execute('F', 'N', 0, 0);
        $expected = '0:1:N';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('FFF', 'N', 0, 0);
        $expected = '0:3:N';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_moves_east()
    {
        $result = Rover::execute('RF', 'N', 0, 0);
        $expected = '1:0:E';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RFFF', 'N', 0, 0);
        $expected = '3:0:E';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_moves_south()
    {
        $result = Rover::execute('RRF', 'N', 0, 5);
        $expected = '0:4:S';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRFFF', 'N', 0, 5);
        $expected = '0:2:S';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_moves_west()
    {
        $result = Rover::execute('RRRF', 'N', 5, 0);
        $expected = '4:0:W';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRRFFF', 'N', 5, 0);
        $expected = '2:0:W';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_wraps_from_top_to_bottom_and_viceversa_at_the_end_of_the_surface()
    {
        $result = Rover::execute(str_repeat('F',200), 'N', 0, 0);
        $expected = '0:0:N';
        $this->assertEquals($expected, $result);

        $result = Rover::execute(str_repeat('F',205), 'N', 0, 0);
        $expected = '0:5:N';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRF', 'N', 0, 0);
        $expected = '0:199:S';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('RRFFFFF', 'N', 0, 0);
        $expected = '0:195:S';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_wraps_from_right_to_left_and_viceversa_at_the_end_of_the_surface()
    {
        $result = Rover::execute('R'.str_repeat('F',200), 'N', 0, 0);
        $expected = '0:0:E';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('R'.str_repeat('F',205), 'N', 0, 0);
        $expected = '5:0:E';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('LF', 'N', 0, 0);
        $expected = '199:0:W';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('LFFFFF', 'N', 0, 0);
        $expected = '195:0:W';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_stops_before_obstacle()
    {
        $result = Rover::execute('F', 'N', 8, 7);
        $expected = 'Obstacle detected at position 8:8. Last position reached 8:7:N';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('FRFFFF', 'N', 8, 7);
        $expected = 'Obstacle detected at position 8:8. Last position reached 8:7:N';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_only_accepts_correct_inputs()
    {
        $result = Rover::execute('AAA', 'N', 0, 0);
        $expected = 'Wrong command input. Must be either R, L or F.';
        $this->assertEquals($expected, $result);

        $result = Rover::execute('FRFFFF', 'Q', 0, 0);
        $expected = 'Wrong direction input. Direction must be either N, S, E or W.';
        $this->assertEquals($expected, $result);
    }

    public function test_rover_cannot_start_at_obstacle()
    {
        $result = Rover::execute('FFF', 'N', 8, 8);
        $expected = 'The first coordinate is an obstacle.';
        $this->assertEquals($expected, $result);
    }
    
}
