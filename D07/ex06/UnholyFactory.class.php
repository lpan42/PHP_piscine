<?php
include_once('Fighter.class.php');
    class UnholyFactory{
        public $arr = array();
        public function absorb($args){
           // echo $args->get_soldier();
            if($args instanceof Fighter)
            {
                if (in_array($args, $this->arr)){
                    echo "(Factory already absorbed a fighter of type " . $args->get_soldier() . ")\n";
                }
                else{
                    $this->arr[$args->get_soldier()] = $args; 
                    echo "(Factory absorbed a fighter of type " . $args->get_soldier() . ")\n";
                }
            }
            else{
                echo "(Factory can't absorb this, it's not a fighter)\n";
            }
        }

        public function fabricate($rf){
            if (array_key_exists($rf, $this->arr)){
                echo "(Factory fabricates a fighter of type " . $rf . ")\n";
                return ($this->arr[$rf]);
            }
            else{
                echo "(Factory hasn't absorbed any fighter of type " . $rf . ")\n";
                return NULL;
            }
        }
    }
?>