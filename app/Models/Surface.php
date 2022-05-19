<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coordinate; 

class Surface extends Model
{
    use HasFactory;

    private const MAX_HEIGHT = 200;
    private const MAX_WIDTH = 200;

    /**
     * @var array obstacles
     */
    private $obstacles = [];

    /**
     * Direction constructor.
     * @param int x and y directions
     */
    public function __construct(array $obstacles)
    {
        $this->obstacles = $obstacles;
    }

    /**
     * @return Coordinate
     */
    public function moveInSurface(Coordinate $coordinate, string $direction) 
    {
        $x = $coordinate->getValueX();
        $y = $coordinate->getValueY();

        // module (%) to wrap when rover gets to the end
        if($direction == 'N'){
            $y = ($y + 1) % self::MAX_HEIGHT;
        }
        if($direction == 'E'){
            $x = ($x + 1) % self::MAX_WIDTH;
        }
        if($direction == 'W'){
            $x = ($x > 0) ? $x - 1 : self::MAX_WIDTH - 1;
        }
        if($direction == 'S'){
            $y = ($y > 0) ? $y - 1 : self::MAX_HEIGHT - 1;
        }

        $newCoordinate = new Coordinate ($x, $y);

        if($newCoordinate->isObstacle($this)){
            $obstacle_array = [
                'obstacle' => $newCoordinate,
                'last_coordinate' => $coordinate
            ];
            return $obstacle_array;
        }
        return $newCoordinate;
    }

    /**
     * @return array
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }
}
