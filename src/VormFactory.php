<?php

require_once('Vorm.php');
require_once('Ellips.php');

class VormFactory
{
    const ELLIPS = 0;
    const LIJN = 1;
    
    static public function create(int $type, float $breedte = 0.0, float $hoogte = 0.0): Vorm
    {
        switch($type) {
            default:
            case self::ELLIPS:
                return new Ellips($breedte, $hoogte);
        }
    }
}