<?php
    class Modelo {
        private $id;
        private $codigo;
        private $descricao;
        private $marca;
        
        function __construct($id, $codigo, $descricao,$marca ){
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->marca = $marca;
        }
    }
?>