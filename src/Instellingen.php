<?php

require_once("VormFactory.php");

class Instellingen
{
    /**
     * 
     * @var string
     */
    protected $moduleName = 'boog';
    
    /**
     * type bovenboog 
     * @var int
     */
    protected $bovenboog = VormFactory::ELLIPS;
    
    /**
     * type onderboog
     * @var int
     */
    protected $onderboog = VormFactory::ELLIPS;
    
    /**
     * kruin is de hoogte
     *  
     * @var float
     */
    protected $kruin = 0.0;
    
    /** 
     * spanning is de breedte
     * 
     * @var float
     */
    protected $spanning = 0.0;
    
    /**
     *  aantal stenen in de boog
     * 
     * @var integer
     */
    protected $stenen = 13;
    
    /** 
     * steenhoogte
     * 
     * @var float
     */
    protected $steenhoogte = 10.0;
    
    /**
     * aantal lagen
     * 
     * @var float
     */
    protected $lagen = 2.5;
    
    /**
     * de voegfactor om voegen te tekenen
     * 
     * @var float
     */
    protected $voegfactor = 0.84;
    
    /** 
     * voegdikte tussen bogen
     * 
     * @var float
     */
    protected $voegdikte = 0.7;
    
    /** 
     * sluitsteen: factor
     * 
     * @var float
     */
    protected $sluitFactor = 1.5;
    
    /**
     * sluitsteen: aantal lagen
     * 
     * @var float
     */
    protected $sluitLagen = 3.0;
    
    /** sluitsteen: aantal stenen
     * 
     * @var integer
     */
    protected $sluitStenen = 0;
    
    /** 
     * sluitsteen: voegfactor
     * 
     * @var float
     */
    protected $sluitVoegfactor = 0.9;
    
    /**
     * geboorte: horizontaal
     * 
     * @var bool
     */
    protected $geboorteHorizontaal = true;
    
    /**
     * geboorte: voegfactor
     * 
     * @var float
     */
    protected $geboorteVoegfactor = 0.84;
    
    /**
     * geboorte: aantal stenen
     * 
     * @var integer
     */
    protected $geboorteStenen = 8;
    
    /**
     * halve stenen in de boog
     * 
     * @var bool
     */
    protected $halvenInBoog = true;
    
    public function __construct(float $kruin, float $spanning)
    {
        $this->setKruin($kruin);
        $this->setSpanning($spanning);
    }
    /**
     * @return number $bovenboog
     */
    public function getBovenboog(): Instellingen
    {
        return $this->bovenboog;
    }

    /**
     * @return number $onderboog
     */
    public function getOnderboog()
    {
        return $this->onderboog;
    }

    /**
     * @return number $kruin
     */
    public function getKruin()
    {
        return $this->kruin;
    }

    /**
     * @return number $spanning
     */
    public function getSpanning()
    {
        return $this->spanning;
    }
    
    /**
     * 
     * @return number
     */
    public function getStraal()
    {
        return $this->spanning / 2;
    }

    /**
     * @return number $stenen
     */
    public function getStenen()
    {
        return $this->stenen;
    }

    /**
     * @return number $steenhoogte
     */
    public function getSteenhoogte()
    {
        return $this->steenhoogte;
    }

    /**
     * @return number $lagen
     */
    public function getLagen()
    {
        return $this->lagen;
    }

    /**
     * @return number $voegfactor
     */
    public function getVoegfactor()
    {
        return $this->voegfactor;
    }

    /**
     * @return number $voegdikte
     */
    public function getVoegdikte()
    {
        return $this->voegdikte;
    }

    /**
     * @return number $sluitFactor
     */
    public function getSluitFactor()
    {
        return $this->sluitFactor;
    }

    /**
     * @return number $sluitLagen
     */
    public function getSluitLagen()
    {
        return $this->sluitLagen;
    }

    /**
     * @return number $sluitStenen
     */
    public function getSluitStenen()
    {
        return $this->sluitStenen;
    }

    /**
     * @return number $sluitVoegfactor
     */
    public function getSluitVoegfactor()
    {
        return $this->sluitVoegfactor;
    }

    /**
     * @return boolean $geboorteHorizontaal
     */
    public function getGeboorteHorizontaal()
    {
        return $this->geboorteHorizontaal;
    }

    /**
     * @return number $geboorteVoegfactor
     */
    public function getGeboorteVoegfactor()
    {
        return $this->geboorteVoegfactor;
    }

    /**
     * @return boolean $halvenInBoog
     */
    public function getHalvenInBoog()
    {
        return $this->halvenInBoog;
    }

    /**
     * @param number $bovenboog
     * @return Instellingen
     */
    public function setBovenboog($bovenboog): Instellingen
    {
        $this->bovenboog = $bovenboog;
        return $this;
    }

    /**
     * @param number $onderboog
     * @return Instellingen
     */
    public function setOnderboog($onderboog): Instellingen
    {
        $this->onderboog = $onderboog;
        return $this;
    }

    /**
     * @param number $kruin
     * @return Instellingen
     */
    public function setKruin($kruin): Instellingen
    {
        $this->kruin = $kruin;
        return $this;
    }

    /**
     * @param number $spanning
     * @return Instellingen
     */
    public function setSpanning($spanning): Instellingen
    {
        $this->spanning = $spanning;
        return $this;
    }

    /**
     * @param number $stenen
     * @return Instellingen
     */
    public function setStenen($stenen): Instellingen
    {
        $this->stenen = $stenen;
        return $this;
    }

    /**
     * @param number $steenhoogte
     * @return Instellingen
     */
    public function setSteenhoogte($steenhoogte): Instellingen
    {
        $this->steenhoogte = $steenhoogte;
        return $this;
    }

    /**
     * @param number $lagen
     * @return Instellingen
     */
    public function setLagen($lagen): Instellingen
    {
        $this->lagen = $lagen;
        return $this;
    }

    /**
     * @param number $voegfactor
     * @return Instellingen
     */
    public function setVoegfactor($voegfactor): Instellingen
    {
        $this->voegfactor = $voegfactor;
        return $this;
    }

    /**
     * @param number $voegdikte
     * @return Instellingen
     */
    public function setVoegdikte($voegdikte): Instellingen
    {
        $this->voegdikte = $voegdikte;
        return $this;
    }

    /**
     * @param number $sluitFactor
     * @return Instellingen
     */
    public function setSluitFactor($sluitFactor): Instellingen
    {
        $this->sluitFactor = $sluitFactor;
        return $this;
    }

    /**
     * @param number $sluitLagen
     * @return Instellingen
     */
    public function setSluitLagen($sluitLagen): Instellingen
    {
        $this->sluitLagen = $sluitLagen;
        return $this;
    }

    /**
     * @param number $sluitStenen
     * @return Instellingen
     */
    public function setSluitStenen($sluitStenen): Instellingen
    {
        $this->sluitStenen = $sluitStenen;
        return $this;
    }

    /**
     * @param number $sluitVoegfactor
     * @return Instellingen
     */
    public function setSluitVoegfactor($sluitVoegfactor): Instellingen
    {
        $this->sluitVoegfactor = $sluitVoegfactor;
        return $this;
    }

    /**
     * @param boolean $geboorteHorizontaal
     * @return Instellingen
     */
    public function setGeboorteHorizontaal($geboorteHorizontaal): Instellingen
    {
        $this->geboorteHorizontaal = $geboorteHorizontaal;
        return $this;
    }

    /**
     * @param number $geboorteVoegfactor
     * @return Instellingen
     */
    public function setGeboorteVoegfactor($geboorteVoegfactor): Instellingen
    {
        $this->geboorteVoegfactor = $geboorteVoegfactor;
        return $this;
    }

    /**
     * @param boolean $halvenInBoog
     * @return Instellingen
     */
    public function setHalvenInBoog($halvenInBoog): Instellingen
    {
        $this->halvenInBoog = $halvenInBoog;
        return $this;
    }
    /**
     * @return number $geboorteStenen
     */
    public function getGeboorteStenen()
    {
        return $this->geboorteStenen;
    }

    /**
     * @param number $geboorteStenen
     * @return Instellingen
     */
    public function setGeboorteStenen($geboorteStenen): Instellingen
    {
        $this->geboorteStenen = $geboorteStenen;
        return $this;
    }
    /**
     * @return string $moduleName
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @param string $moduleName
     * @return Instellingen
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        return $this;
    }



    
}