<?php
require_once 'Color.class.php';

class Vertex{
    private $_x;
    private $_y;
    private $_z;
    private $_w = 1.0;
    private $_color;
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

    public function set_x($x){
        $this->_x = $x;
    }
    public function get_x(){
        return $this->_x;
    }

    public function set_y($y){
        $this->_y = $y;
    }
    public function get_y(){
        return $this->_y;
    }

    public function set_z($z){
        $this->_z = $z;
    }
    public function get_z(){
        return $this->_z;
    }

    public function set_w($w){
        $this->_w = $w;
    }
    public function get_w(){
        return $this->_w;
    }

    public function set_color($color){
        $this->_color = $color;
    }
    public function get_color(){
        return $this->_color;
    }
}
?>