<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Direction; 
use App\Models\Surface; 
use App\Models\Coordinate; 



/* COSES A MILLORAR

- que es pugui posar starting position
IMPORTANT:
- repassar readme
- provar tests i que funcionin

. pujar projecte a real, mirar que es veu be readme. Descarregarlo de nou i comprovar que tot funciona!!!!!

*/

class Rover extends Model
{
    use HasFactory;

    public static function execute(string $commands = '', string $direction = '', int $starting_x = 0, int $starting_y = 0){
        // check that direction provided is right
        if( !in_array(strtoupper($direction), ['N', 'S', 'E', 'W'])){
            return 'Wrong direction input. Direction must be either N, S, E or W.';
        }

        //initialize variables
        $direction = new Direction($direction);
        $commands = str_split($commands);
        $coordinate = new Coordinate($starting_x, $starting_y);
        $obstacles = [ new Coordinate (8, 8), new Coordinate (5, 2) ];
        $surface = new Surface($obstacles);

        // check that starting coordinate is not an obstacle
        if($coordinate->isObstacle($surface)){
            return 'The first coordinate is an obstacle.';
        }
        
        // iterate through passed commands
        foreach($commands as $command){
            $command = strtoupper($command);

            // check that command provided is right
            if( !in_array($command, ['R', 'L', 'F'])){
                return 'Wrong command input. Must be either R, L or F.';
            }
            //rotation
            if($command == 'R' || $command == 'L'){
                $direction = $direction->rotate($command);
            }
            //move forward
            if($command == 'F'){
                $coordinate = $surface->moveInSurface($coordinate, $direction->getValue());
                if(is_array($coordinate)){
                    $last_coordinate = $coordinate['last_coordinate'];
                    $obstacle = $coordinate['obstacle'];
                    $result = 'Obstacle detected at position ' . $obstacle->getValueX() . ':' . $obstacle->getValueY();
                    $result .= '. Last position reached ' . $last_coordinate->getValueX() . ':' . $last_coordinate->getValueY() . ':' . $direction->getValue();
                    return $result;
                }
            }
        }

        $result = $coordinate->getValueX() . ":" . $coordinate->getValueY() . ":".$direction->getValue();
        return $result;
    }

}
