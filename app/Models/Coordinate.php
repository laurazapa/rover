<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Surface; 


class Coordinate extends Model
{
    use HasFactory;

    /**
     * @var integer x and y coordinates
     */
    private $x = 0;
    private $y = 0;

    /**
     * coordinate constructor.
     * @param int x and y coordinates
     */
    public function __construct(int $x , int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Coordinate is obstacle
     * @param Surface
     */
    public function isObstacle(Surface $surface): bool
    {
        foreach($surface->getObstacles() as $obstacle){
            if( $this == $obstacle ){
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getValueX(): string
    {
        return $this->x;
    }

    /**
     * @return string
     */
    public function getValueY(): string
    {
        return $this->y;
    }
}
