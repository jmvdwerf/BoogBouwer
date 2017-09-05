<?php

require_once('Instellingen.php');
require_once('VormFactory.php');
require_once('Vierhoek.php');
require_once('Punt.php');

class Boog
{
    // deze bevat alle bogen. Zijn er minimaal 2: binnenboog en buitenboog
    protected $bogen = array();
    
    /**
     * 
     * @var Instellingen
     */
    protected $settings = null;
    
    
    protected $stenen = array();
    
    protected $pp_links = null;
    protected $pp_midden = null;
    protected $pp_rechts = null;
    
    protected $max = null;
    
    public function __construct(Instellingen $instellingen)
    {
        $this->settings = $instellingen;
        
        $this->max = new Punt();
        
        // bereken porringpunten
        $hsp = $this->settings->getStraal();
        $kruin = $this->settings->getKruin();
        
        $this->pp_midden = new Punt(0, $kruin - ($hsp*$hsp/$kruin));
        
        $this->pp_rechts = new Punt($hsp-(($kruin*$kruin)/$hsp), 0);
        $this->pp_links = $this->pp_rechts->mirrorX();
        
        $this->setBogen();
        
        $this->render();
    }
    
    protected function setBogen()
    {
        $grootte = $this->settings->getStraal();
        $kruin = $this->settings->getKruin();
        
        $extra = 0;
        for($i = 0 ; $i < 2*max($this->settings->getLagen(), $this->settings->getSluitLagen()); $i++) {
            $this->bogen[] = VormFactory::create($this->settings->getOnderboog(), $grootte+$extra, $kruin+$extra);
            $extra += $this->settings->getSteenhoogte() / 2;
            $this->bogen[] = VormFactory::create($this->settings->getOnderboog(), $grootte+$extra, $kruin+$extra);
            $extra += $this->settings->getVoegdikte(); // $voeg_dikte;
        }
    }
    
    /**
     * 
     * @return float
     */
    public function maxCoefficientGeboorte()
    {
        return abs($this->pp_midden->getY() / $this->settings->getStraal());
    }
    
    /**
     * 
     * @return float
     */
    public function maxCoefficientPorringMidden()
    {
        return ($this->settings->getStraal() / $this->settings->getKruin());
    }
    
    
    protected function render()
    {   
        $maxrc = ($this->settings->getGeboorteHorizontaal()) 
            ? $this->maxCoefficientPorringMidden() 
            : $this->maxCoefficientGeboorte();
        
        // een halve boog bestaat uit $this->settings->getStenen plus een halve sluitsteen
        $stap = (pi()/2 - atan($this->maxCoefficientGeboorte()))/($this->settings->getStenen() + 0.5);
        $starthoek = pi()/2 - ($stap * $this->settings->getSluitFactor());
        
        $cur = 1;
        $hoek = $starthoek;
        
        while(tan($hoek) > $maxrc) {
            $hk = 0;
            if ($maxrc < tan($hoek-($stap * $this->settings->getVoegfactor()))) {
                $hk2 = $hoek-($stap*$this->settings->getVoegfactor());
            } else {
                $hk2 = atan($maxrc)+($stap*(1-$this->settings->getVoegfactor()));
            }
            
            // maak een stenenrij
            $this->maakStenenRij(
                ($cur %2) == 1, 
                $hoek, 
                $hk2, 
                $this->pp_midden->getY(), 
                $this->pp_midden->getY(),
                ($cur <= $this->settings->getSluitStenen()) ? $this->settings->getSluitLagen() : $this->settings->getLagen()
            );
            
            $hoek -= $stap;
            $cur++;
        }
        
        if ($this->settings->getGeboorteHorizontaal())
        {
            $hoek = atan(($this->settings->getStraal()) / $this->settings->getKruin());
            $hstep = $hoek / ($this->settings->getGeboorteStenen());
            
            while ($hoek > 0) {
                $hk2 = ($hoek - ($hstep * $this->settings->getGeboorteVoegfactor())) > 0 ? $hoek-($hstep*$this->settings->getGeboorteVoegfactor()) : 0;
                    
                $this->maakStenenRij(
                    ($cur%2)==1, 
                    $hoek, 
                    $hk2, 
                    -1*tan($hoek)*$this->pp_rechts->getX(), 
                    -1*tan($hk2)*$this->pp_rechts->getX(), 
                    $this->settings->getLagen()
                );
                
                $hoek -= $hstep;
                $cur++;
            }
        }
        
        // tenslotte de sluitsteen
        for($i = 0 ; $i < 4*$this->settings->getSluitLagen(); $i+=4) {
            $bot = $i;
            $top = min($bot + 3, count($this->bogen)-1);
            $this->stenen[] = $this->maakSluitsteen(
                pi()/2 - ($stap * $this->settings->getSluitVoegfactor() * $this->settings->getSluitFactor()),
                $this->pp_midden->getY(),
                $this->bogen[$bot],
                $this->bogen[$top]
            );
        }
    }
    
    protected function maakStenenRij($oneven, $hk1, $hk2, $y1, $y2, $aantal)
    {
        $start = 0;
        
        if ($oneven && $this->settings->getHalvenInBoog()) {
            $steen = $this->maakSteen($hk1, $hk2, $y1, $y2, $this->bogen[0], $this->bogen[1]);
            $this->stenen[] = $steen;
            $this->stenen[] = $steen->mirrorX();
            $start = 2;
        }
        
        for($i = $start ; $i < 4 * $aantal ; $i += 4) {
            $bot = $i;
            $top = min($bot + 3, (4*$aantal) -1);
            $steen = $this->maakSteen($hk1, $hk2, $y1, $y2, $this->bogen[$bot], $this->bogen[$top]);
            $this->stenen[] = $steen;
            $this->stenen[] = $steen->mirrorX();
        }
        
    }
    
    protected function maakSteen(float $hk1, float $hk2, float $y1, float $y2, Vorm $binnen, Vorm $buiten): Vierhoek
    {
        $vk = new Vierhoek(
            $binnen->snijpunt(tan($hk1), $y1),
            $buiten->snijpunt(tan($hk1), $y1),
            $buiten->snijpunt(tan($hk2), $y2),
            $binnen->snijpunt(tan($hk2), $y2)
        );
        
        $this->updateMax($vk);
        
        return $vk;
    }
    
    protected function maakSluitsteen(float $hoek, float $y, Vorm $binnen, Vorm $buiten): Vierhoek
    {
        $pt1 = $binnen->snijpunt(tan($hoek), $y);
        $pt2 = $buiten->snijpunt(tan($hoek), $y);
        $vk = new Vierhoek(
            $pt1,
            $pt2,
            $pt2->mirrorX(),
            $pt1->mirrorX()
        );
        
        $this->updateMax($vk);
        
        return $vk;
    }
    
    protected function updateMax(Vierhoek $vk)
    {
        $this->max->updateToMax($vk->getLinksBoven());
        $this->max->updateToMax($vk->getLinksOnder());
        $this->max->updateToMax($vk->getRechtsBoven());
        $this->max->updateToMax($vk->getRechtsOnder());
    }
    
    public function getStenen(): array
    {
        return $this->stenen;
    }
    
    public function printScad($indent = 0): string
    {
        $ind = '';
        for ($i = 0 ; $i < $indent ; $i++) {
            $ind .= "\t";
        }
        $str = $ind.'module '.$this->settings->getModuleName().'() {'."\n";
        foreach($this->getStenen() as $steen) {
            $str .= $steen->printScad($indent+1)."\n";
        }
        $str .= $ind.'}';
        
        return $str;
    }
    
    public function printSVG($color = 'blue', $scaleX = 3): string
    {
        $scale = new Punt($scaleX, $scaleX);
        
        $str = '<svg width="'.(2*$this->max->multiply($scale)->getX()).'" height="'.($this->max->multiply($scale)->getY()).'">'."\n\t";
        $offset = $this->max->multiply($scale);
        
        $scale->setY(-1*$scale->getY());
        
        foreach($this->getStenen() as $steen) {
            $str .= $steen->printSVG($color, $offset, $scale)."\n\t";
        }
        
        $str .= '</svg>';
        
        return $str;
        
    }
    
}