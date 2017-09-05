<?php


class Punt
{
    private $x = 0.0;
    private $y = 0.0;
    
    public function __construct(float $x = 0.0, float $y = 0.0)
    {
        $this->setX($x);
        $this->setY($y);
    }
    
    /**
     * @return $x
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return $y
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param number $x
     * @return /Point
     */
    public function setX(float $x)
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @param number $y
     * @return /Point
     */
    public function setY(float $y)
    {
        $this->y = $y;
        return $this;
    }
    
    public function mirrorX(): Punt
    {
        return new Punt(-1* $this->getX(), $this->getY());
    }
    
    public function mirrorY(): Punt
    {
        return new Punt($this->getX(), -1 * $this->getY());
    }
    
    public function printScad(): string
    {
        return '[ '. $this->__tostring() .' ]';
    }
    
    public function __tostring(): string
    {
        return $this->getX() . ', '. $this->getY();
    }
    
    public function updateToMax(Punt $pt)
    {
        if ($pt->getX() > $this->getX()) {
            $this->setX($pt->getX());
        }
        if ($pt->getY() > $this->getY()) {
            $this->setY($pt->getY());
        }
    }
    
    public function add(Punt $pt): Punt
    {
        return new Punt($this->getX() + $pt->getX(), $this->getY() + $pt->getY());
    }
    
    public function multiply(Punt $pt): Punt
    {
        return new Punt($this->getX() * $pt->getX(), $this->getY() * $pt->getY());
    }
}