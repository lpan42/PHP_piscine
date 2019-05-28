<?php
class Vector{
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0.0;
    static $verbose = FALSE;

    function __construct($arr){
        if(isset($arr['x']) && isset($arr['y']) && isset($arr['z'])){
            $this->_x = $arr['x'];
            $this->_y = $arr['y'];
            $this->_z = $arr['z'];
            if(isset($arr['w'])){
                $this->_w = $arr['w'];
            }
            if(isset($arr['color'])){
                $this->_color = $arr['color'];
            }else{
                $this->_color = new Color(array('red' => 255, 'green'=> 255, 'blue'=> 255));
            }
            if(Self::$verbose == TRUE){
                echo $this->__toString() . " constructed.\n";
            }
        }
    }

    function __toString(){
        if(Self::$verbose == TRUE) {
            return (sprintf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", 
                $this->_x, $this->_y, $this->_z, $this->_w, 
                $this->_color->red, $this->_color->red, $this->_color->red));
        }else{
            return (sprintf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f )", 
                $this->_x, $this->_y, $this->_z, $this->_w));
        }
    }

    function __destruct() {
        if (Self::$verbose == TRUE) {
            echo $this->__toString() . " desctructed.\n";
        }
    }
        
    static function doc() {
        echo file_get_contents("Vertex.doc.txt");
    }
}
?>