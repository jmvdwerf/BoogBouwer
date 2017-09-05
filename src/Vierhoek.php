<?php

require_once('Punt.php');

class Vierhoek
{
    protected $ro = null;
    
    protected $lo = null;
    
    protected $rb = null;
    
    protected $lb = null;
    
    public function __construct(Punt $ro, Punt $rb, Punt $lb, Punt $lo)
    {
        $this->ro = $ro;
        $this->rb = $rb;
        $this->lb = $lb;
        $this->lo = $lo;
    }
    
    public function getRechtsOnder(): Punt
    {
        return $this->ro;
    }
    
    public function getRechtsBoven(): Punt
    {
        return $this->rb;
    }
    
    public function getLinksBoven(): Punt 
    {
        return $this->lb;
    }
    
    public function getLinksOnder(): Punt
    {
        return $this->lo;
    }
    
    public function mirrorX(): Vierhoek
    {
        return new Vierhoek($this->ro->mirrorX(), $this->rb->mirrorX(), $this->lb->mirrorX(), $this->lo->mirrorX());
    }
    
    public function mirrorY(): Vierhoek
    {
        return new Vierhoek($this->ro->mirrorY(), $this->rb->mirrorY(), $this->lb->mirrorY(), $this->lo->mirrorY());
    }
    
    public function printScad($indent = 0): string
    {
        $str = '';
        for ($i = 0 ; $i < $indent ; $i++) {
            $str .= "\t";
        }
        $str .= 'polygon( [';
        $str .= $this->getRechtsOnder()->printScad(). ', ';
        $str .= $this->getRechtsBoven()->printScad(). ', ';
        $str .= $this->getLinksBoven()->printScad(). ', ';
        $str .= $this->getLinksOnder()->printScad(). ' ] );';
            
        return $str;
    }
    
    public function printSVG($color = 'blue', Punt $offset = null, Punt $scale = null): string
    {
        if ($offset == null) $offset = new Punt();
        if ($scale == null) $scale = new Punt(1,1);
        
        $str = '<polygon points="';
        $str .= $this->getRechtsOnder()->multiply($scale)->add($offset). ', ';
        $str .= $this->getRechtsBoven()->multiply($scale)->add($offset). ', ';
        $str .= $this->getLinksBoven()->multiply($scale)->add($offset). ', ';
        $str .= $this->getLinksOnder()->multiply($scale)->add($offset). ', ';
        $str .= '" style="fill:'.$color.';stroke:black;stroke-width:1" />';
        
        return $str;
    }
}