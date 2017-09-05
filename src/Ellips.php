<?php

class Ellips extends Vorm
{    
    
    /**
     * 
     * {@inheritDoc}
     * @see Vorm::snijpunt()
     */
    public function snijpunt(float $m, float $c): Punt
    {
        $a = $this->getBreedte();
        $b = $this->getHoogte();
        
        $a2 = $a * $a;
        $b2 = $b * $b;
        
        $m2 = $m * $m;
        $c2 = $c * $c;
        
        if(($a2*$m2+$b2-$c2) < 0) {
            return null;
        }
        
        $x1 = (-1*$a2*$m*$c + $a*$b*sqrt($a2*$m2+$b2-$c2))/($a2*$m2+$b2);
        $x2 = (-1*$a2*$m*$c - $a*$b*sqrt($a2*$m2+$b2-$c2))/($a2*$m2+$b2);
        
        $y1 = $m*$x1+$c;
        $y2 = $m*$x2+$c;
        
        if (($x1 >= 0) && ($y1 >= 0))
            return new Punt($x1, $y1);
        elseif (($x2 >= 0) && ($y2 >= 0))
            return new Punt($x2, $y2);
        else
            return null;
    }

    
}