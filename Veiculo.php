<?php
    class Veiculo {
        private $id;
        private $chassi;
        private $situacao;
        private $preco;
        private $modelo;
        
        function __construct($id, $chassi, $situacao,$preco,$modelo ){
        $this->id = $id;
        $this->chassi = $chassi;
        $this->situacao = $situacao;
        $this->preco = $preco;
        $this->modelo = $modelo;
        }
    }
?>