<?php
    include_once 'Nota_Fiscal.php';
	include_once 'PDOFactory.php';

    class NotaFiscalDAO
    {
        public function Vender(NotaFiscal $notaFiscal)
        {
            $qInserir = "INSERT INTO nota_fiscal(notaFiscal,data,id_veiculo) VALUES (:notaFiscal,:data,:veiculo)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":notaFiscal",$notaFiscal->notaFiscal);
            $comando->bindParam(":data",$notaFiscal->data);
            $comando->bindParam(":veiculo",$notaFiscal->veiculo);
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

        public function atualizar(NotaFiscal $notaFiscal)
        {
            $qAtualizar = "UPDATE nota_fiscal SET notaFiscal=:notaFiscal, data=:data, id_veiculo=:veiculo WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":notaFiscal",$notaFiscal->notaFiscal);
            $comando->bindParam(":data",$notaFiscal->data);
            $comando->bindParam(":veiculo",$notaFiscal->veiculo);
            $comando->bindParam(":id",$notaFiscal->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM nota_fiscal';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $notasFiscais =array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $notasFiscais[] = new NotaFiscal($row->id,$row->id_veiculo,$row->data,$row->notaFiscal);
            }
            return $notasFiscais;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM nota_fiscal WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return  new NotaFiscal($row->id,$row->id_veiculo,$row->data,$row->notaFiscal);        
        }
    }
?>