<?php
    class Modelo {
        private $codigo;
        private $descricao;
        private $marca;
        
        function __construct($codigo, $descricao,$marca ){
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->marca = $marca;
        }
    }
?>