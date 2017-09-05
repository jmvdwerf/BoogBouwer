<?php

abstract class Vorm
{
    protected $breedte = 0.0;
    protected $hoogte = 0.0;
    
    public function __construct(float $breedte = 0.0, float $hoogte = 0.0)
    {
        $this->setBreedte($breedte);
        $this->setHoogte($hoogte);
    }
    
    
    /**
     * @return $breedte
     */
    public function getBreedte(): float
    {
        return $this->breedte;
    }

    /**
     * 
     * @param float $breedte
     * @return Vorm
     */
    public function setBreedte(float $breedte): Vorm
    {
        $this->breedte = $breedte;
        return $this;
    }
    
    /**
     * @return $hoogte
     */
    public function getHoogte(): float
    {
        return $this->hoogte;
    }
    
    /**
     * @param number $hoogte
     */
    public function setHoogte($hoogte): Vorm
    {
        $this->hoogte = $hoogte;
        return $this;
    }
    
    

    /**
     * Deze functie berekent het snijpunt met deze functie en een gegeven lijn
     *  y = m*+c
     *  
     * @param float $m
     * @param float $c
     * @return Punt
     */
    abstract public function snijpunt(float $m, float $c): Punt;

}