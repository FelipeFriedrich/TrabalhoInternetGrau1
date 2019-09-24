<?php
    class Nota_Fiscal {
        private $id;
        private $nota_fiscal;
        private $data;
        private $veiculo;
        
        function __construct($id, $nota_fiscal, $data,$veiculo){
        $this->id = $id;
        $this->nota_fiscal = $nota_fiscal;
        $this->data = $data;
        $this->veiculo = $veiculo;
        }
    }
?>