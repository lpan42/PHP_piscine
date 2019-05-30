<?php
    abstract class Fighter{
        private $_soldier;
        public function __construct($args){
            $this->_soldier = $args;
        }
        public function get_soldier()
        {
            return $this->_soldier;
        }
        abstract public function fight($args);
    }
?>