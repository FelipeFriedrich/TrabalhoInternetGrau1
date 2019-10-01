<?php
    class Veiculo {
        public $id;
        public $chassi;
        public $situacao;
        public $preco;
        public $modelo;
        
        function __construct($id, $chassi, $situacao,$preco,$modelo ){
        $this->id = $id;
        $this->chassi = $chassi;
        $this->situacao = $situacao;
        $this->preco = $preco;
        $this->modelo = $modelo;
        }
    }
?>