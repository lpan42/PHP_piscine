<?php
class NightsWatch implements iFighter{
    public $recruits = array(); 
    
    public function recruit($args){
        $this->recruits[] = $args;
    }

    public function fight(){
        foreach ($this->recruits as $value)
        {
            if(method_exists($value, "fight")){
                $value->fight();
            }
        }
    }
}
?>