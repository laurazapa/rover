<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    private const NORTH = 'N';
    private const SOUTH = 'S';
    private const EAST  = 'E';
    private const WEST  = 'W';

    private const LEFT_TO_RIGHT_DIRECTIONS = [
        self::NORTH => self::WEST,
        self::WEST  => self::SOUTH,
        self::SOUTH => self::EAST,
        self::EAST  => self::NORTH,
    ];

    private const RIGHT_TO_LEFT_DIRECTIONS = [
        self::NORTH => self::EAST,
        self::EAST  => self::SOUTH,
        self::SOUTH => self::WEST,
        self::WEST  => self::NORTH,
    ];

    /**
     * @var string $direction
     */
    private $direction = '';

    /**
     * Direction constructor.
     * @param string $direction
     */
    public function __construct(string $direction)
    {
        $direction = strtoupper($direction);
        $this->direction = $direction;
    }

     /**
     * @return Direction
     */
    public function rotate(string $rotation): self
    {
        if ($rotation == 'R') {
            return new self(self::RIGHT_TO_LEFT_DIRECTIONS[$this->direction]);
        }
        return new self(self::LEFT_TO_RIGHT_DIRECTIONS[$this->direction]);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->direction;
    }



}
