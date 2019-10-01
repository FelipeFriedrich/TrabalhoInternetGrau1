<?php
    class NotaFiscal {
        public $id;
        public $notaFiscal;
        public $data;
        public $veiculo;
        
        function __construct($id,$veiculo,$data,$notaFiscal){
        $this->id = $id;
        $this->notaFiscal = $notaFiscal;
        $this->data = $data;
        $this->veiculo = $veiculo;
        }
    }
?>