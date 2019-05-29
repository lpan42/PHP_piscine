<?php
class Jaime extends Lannister{
    public function sleepWith($args){
        if($args instanceof Tyrion){
            print "Not even if I'm drunk !\n";
        }
        else if ($args instanceof Stark){
            print "Let's do this.\n";
        }
        else{
            print "With pleasure, but only in a tower in Winterfell, then.\n";
        }
    }
}
?>