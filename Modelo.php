<?php
    class Modelo {
        public $codigo;
        public $descricao;
        public $marca;
        
        function __construct($codigo,$descricao,$marca){
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->marca = $marca;
        }
    }
?>