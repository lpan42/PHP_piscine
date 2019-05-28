<?php
    class Color{
        public $red;
        public $green;
        public $blue;
        public static $verbose;
        //verbose to control the displays related to the use of the Class. 
        //initially False.

        
    }
    // An instance must be able to be built, either by passing a value for 
    // the ’rgb’ key which will be split into three red, green and blue 
    // components, either by passing a value for the ’red’, ’green’ and 
    // ’blue’ keys which will directly represent the three components. 
    // Each of the values for the four possible keys will be converted 
    // into an integer before use.
    function __construct($arr){
        
    }

    public function __toString(){

    }

    // add the the components of the current instance to the components of 
    // another instance argument. The resulting color is a new instance.
    public function add(){

    }

    // substract the com- ponents of the current instance to the components 
    //of another instance argument. The resulting color is a new instance.
    public function sub(){
        
    }

    //multiply the com- ponents of the current instance to the components 
    //of of another instance argument. The resulting color is a new instance.
    public function mult(){
        
    }

    // returns the documentation of the class in a string
    public static function doc(){

    }

    public function __destruct(){

    }
?>