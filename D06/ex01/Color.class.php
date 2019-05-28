<?php
class Color{
    public $red;
    public $green;
    public $blue;
    static $verbose = FALSE;

    function __construct($color){
        if(array_key_exists('rgb', $color))
        {
            $rgb = intval($color['rgb']);
            $this->red = ($rgb >> 16) & 0xff;
            $this->green = ($rgb >> 8) & 0xff;
            $this->blue = $rgb & 0xff;
        }
        else if(array_key_exists('red', $color) && array_key_exists('green', $color) && array_key_exists('blue', $color))
        {
            $this->red = intval($color['red']);
            $this->green = intval($color['green']);
            $this->blue = intval($color['blue']);
        }
        if(Self::$verbose == TRUE)
            echo $this->__toString() . " constructed.\n";
    }

    function __toString(){
        return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
    }

    function __destruct(){
        if (Self::$verbose == TRUE)
            echo $this->__toString() . " destructed.\n";
    }

    static function doc(){
        echo file_get_contents("Color.doc.txt");
    }
    
    public function add($arr){
        return (new Color(array('red' => $this->red + $arr->red,
						'blue' => $this->blue + $arr->blue,
						'green' => $this->green + $arr->green)));
    }

    public function sub($arr){
        return (new Color(array('red' => $this->red - $arr->red,
						'blue' => $this->blue - $arr->blue,
						'green' => $this->green - $arr->green)));
    }

    public function mult($i){
        return (new Color(array('red' => $this->red * $i,
						'blue' => $this->blue * $i,
						'green' => $this->green * $i)));
    }
}
?>