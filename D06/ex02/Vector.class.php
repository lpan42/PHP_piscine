<?php
require_once('Vertex.class.php');
class Vector{
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0.0;
    static $verbose = FALSE;

    function __construct($arr){
        if(isset($arr['dest']) && $arr['dest'] instanceof Vertex){
            if(isset($arr['orig']) && $arr['orig'] instanceof Vertex){
                $orig = new Vertex(array('x' => $arr['orig']->get_x(), 
                                        'y' => $arr['orig']->get_y(),
                                        'z' => $arr['orig']->get_z()));
            }else{
                $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w'=> 1));
            }
            $this->_x = $arr['dest']->get_x() - $orig->get_x();
            $this->_y = $arr['dest']->get_y() - $orig->get_y();
            $this->_z = $arr['dest']->get_z() - $orig->get_z();
            if(Self::$verbose == TRUE){
                echo $this->__toString() . " constructed\n";
            }
        }
    }

    function __toString(){
        if(Self::$verbose == TRUE) {
            return (sprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", 
                    $this->_x, $this->_y, $this->_z, $this->_w));
        }
    }

    function __destruct() {
        if (Self::$verbose == TRUE) {
            echo $this->__toString() . " destructed\n";
        }
    }
        
    static function doc() {
        echo file_get_contents("Vector.doc.txt");
    }

    public function get_x(){
        return $this->_x;
    }

    public function get_y(){
        return $this->_y;
    }

    public function get_z(){
        return $this->_z;
    }

    public function magnitude(){
        return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
    }

    public function normalize(){
        $length = $this->magnitude();
        if ($length === 1){
            return (new vector(array('orig'=> $arr['orig'], 'dest' => $arr['dest'])));
        }else{
            return (new vector(array('dest' => new Vertex(array('x'=>$this->_x / $length,
                                                                'y'=>$this->_y / $length,
                                                                'z'=>$this->_z / $length)))));
        }
    }

    public function  add(Vector $rhs){
        return (new Vector(array('dest' => new Vertex(array('x' => $this->_x + $rhs->get_x(),
                                                            'y' => $this->_y + $rhs->get_y(),
                                                            'z' => $this->_z + $rhs->get_z())))));
    }

    public function  sub(Vector $rhs){
        return (new Vector(array('dest' => new Vertex(array('x' => $this->_x - $rhs->get_x(),
                                                            'y' => $this->_y - $rhs->get_y(),
                                                            'z' => $this->_z - $rhs->get_z())))));
    }

    public function  opposite(){
        return (new Vector(array('dest' => new Vertex(array('x' => $this->_x * (-1),
                                                            'y' => $this->_y * (-1),
                                                            'z' => $this->_z * (-1))))));
    }

    public function  scalarProduct($k){
        return (new Vector(array('dest' => new Vertex(array('x' => $this->_x * $k,
                                                            'y' => $this->_y * $k,
                                                            'z' => $this->_z * $k)))));
    }

    public function  dotProduct(Vector $rhs){
        return ($this->_x * $rhs->get_x()+ $this->_y * $rhs->get_y() + $this->_z * $rhs->get_z());
    }

    public function  cos(Vector $rhs){
        return ($this->dotProduct($rhs) / ($this->magnitude() * sqrt(pow($rhs->get_x(), 2) + pow($rhs->get_y(), 2) + pow($rhs->get_z(), 2))));
    }

    public function crossProduct(Vector $rhs){
       return (new Vector(array('dest' => new Vertex(array('x' => ($this->_y * $rhs->get_z() - $this->_z * $rhs->get_y()),
                                                            'y' => ($this->_z * $rhs->get_x() - $this->_x * $rhs->get_z()),
                                                            'z' => ($this->_x * $rhs->get_y() - $this->_y * $rhs->get_x()))))));
    }
}
?>