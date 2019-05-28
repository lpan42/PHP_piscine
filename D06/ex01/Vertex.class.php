<?php
Class Vertex{
    private $_x;
    private $_y;
    private $_z;
    private $_w = 1.0;
    private $_color;
    static $verbose = FALSE;

    function __consrtuct(){

    }

    public function set_x($x)
    {
        $this->_x = $x;
    }
    public function set_x($y)
    {
        $this->_y = $y;
    }
    public function set_x($z)
    {
        $this->_z = $z;
    }

?>