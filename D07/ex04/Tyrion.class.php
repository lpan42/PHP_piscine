<?php
class Tyrion{
    public function sleepWith($args){
        if($args instanceof Lannister){
            print "Not even if I'm drunk !\n";
        }
        else{
            print "Let's do this.\n";
        }
    }
}
?>