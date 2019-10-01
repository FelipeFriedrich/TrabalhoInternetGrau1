<?php
    include_once 'veiculo.php';
    include_once 'PDOFactory.php';
    include_once 'ModeloDAO.php';
    include_once 'Modelo.php';

    class VeiculoDAO
    {
        public function inserir(Veiculo $veiculo)
        {
            $qInserir = "INSERT INTO veiculo(chassi,situacao,preco, id_modelo) VALUES (:chassi,:situacao,:preco,:modelo)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":chassi",$veiculo->chassi);
            $comando->bindParam(":situacao",$veiculo->situacao);
            $comando->bindParam(":preco",$veiculo->preco);
            $comando->bindParam(":modelo",$veiculo->modelo->codigo);
            $comando->execute();
            $veiculo->id = $pdo->lastInsertId();
            return $veiculo;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from veiculo WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Veiculo $veiculo)
        {
            $qAtualizar = "UPDATE veiculo SET chassi=:chassi, situacao=:situacao, preco=:preco, id_modelo=:modelo WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":chassi",$veiculo->chassi);
            $comando->bindParam(":situacao",$veiculo->situacao);
            $comando->bindParam(":preco",$veiculo->preco);
            $comando->bindParam(":modelo",$veiculo->modelo->codigo);
            $comando->bindParam(":id",$veiculo->id);
            $comando->execute();        
        }

        public function listar()
        {   
            $dao = new ModeloDAO;
		    $query = 'SELECT * FROM veiculo';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $veiculos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $modelo = $dao->Buscarporid($row->id_modelo);
			    $veiculos[] = new veiculo($row->id,$row->chassi,$row->situacao,$row->preco,$modelo);
            }
            return $veiculos;
        }

        public function buscarPorId($id)
        {
            $dao = new ModeloDAO;
 		    $query = 'SELECT * FROM veiculo WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            $modelo = $dao->Buscarporid($result->id_modelo);
		    return new veiculo($result->id,$result->chassi,$result->situacao,$result->preco, $modelo);         
        }
    }
?>