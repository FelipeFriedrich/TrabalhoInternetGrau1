<?php
    class NotaFiscal {
        private $id;
        private $notaFiscal;
        private $data;
        private $veiculo;
        
        function __construct($id, $notaFiscal, $data,$veiculo){
        $this->id = $id;
        $this->notaFiscal = $notaFiscal;
        $this->data = $data;
        $this->veiculo = $veiculo;
        }
    }
?>