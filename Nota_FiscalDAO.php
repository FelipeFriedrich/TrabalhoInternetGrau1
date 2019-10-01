<?php
    include_once 'Nota_Fiscal.php';
    include_once 'PDOFactory.php';
    include_once 'VeiculoDAO.php';
    include_once 'Veiculo.php';

    class NotaFiscalDAO
    {
        public function inserir(NotaFiscal $notaFiscal)
        {
            $qInserir = "INSERT INTO nota_fiscal(nota_Fiscal,data,id_veiculo) VALUES (:notaFiscal,STR_TO_DATE(:data,'%d/%m/%Y'),:veiculo)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":notaFiscal",$notaFiscal->notaFiscal);
            $comando->bindParam(":data",$notaFiscal->data);
            $comando->bindParam(":veiculo",$notaFiscal->veiculo->id);
            $comando->execute();
            $notaFiscal->id = $pdo->lastInsertId();
            return $notaFiscal;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from nota_fiscal WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(NotaFiscal $notasFiscal)
        {
            $qAtualizar = "UPDATE nota_fiscal SET nota_Fiscal=:notaFiscal, data=STR_TO_DATE(:data,'%d/%m/%Y'), id_veiculo=:veiculo WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":notaFiscal",$notasFiscal->notaFiscal);
            $comando->bindParam(":data",$notasFiscal->data);
            $comando->bindParam(":veiculo",$notasFiscal->veiculo->id);
            $comando->bindParam(":id",$notasFiscal->id);
            $comando->execute();        
        }

        public function listar()
        {
            $dao = new veiculoDao;
		    $query = 'SELECT * FROM nota_fiscal';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $notasFiscais =array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $veiculo = $dao->Buscarporid($row->id_veiculo);
                $notasFiscais[] = new NotaFiscal($row->id,$veiculo,$row->data,$row->nota_fiscal);
            }
            return $notasFiscais;
        }

        public function buscarPorId($id)
        {
            $dao = new veiculoDao;
 		    $query = 'SELECT * FROM nota_fiscal WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            $veiculo = $dao->Buscarporid($result->id_veiculo);
		    return  new NotaFiscal($result->id,$veiculo,$result->data,$result->nota_fiscal);        
        }
    }
?>