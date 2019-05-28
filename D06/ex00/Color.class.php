<?php
class Color{
    public $red;
    public $green;
    public $blue;
    static $verbose = FALSE;

    function __construct($arr){
        if(array_key_exists('rgb', $arr))
        {
            $color = intval($arr['rgb']);
            $this->red = ($color >> 16) & 0xff;
            $this->green = ($color >> 8) & 0xff;
            $this->blue = $color & 0xff;
        }
        else if(array_key_exists('red', $arr) && array_key_exists('green', $arr) && array_key_exists('blue', $arr))
        {
            $this->red = intval($arr['red']);
            $this->green = intval($arr['green']);
            $this->blue = intval($arr['blue']);
        }
        if(self::$verbose == TRUE)
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