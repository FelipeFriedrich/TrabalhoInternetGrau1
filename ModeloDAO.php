<?php
    include_once 'modelo.php';
	include_once 'PDOFactory.php';

    class ProdutoDAO
    {
        public function inserirModelo(Modelo $modelo)
        {
            $qInserir = "INSERT INTO modelo(codigo,descricao,marca) VALUES (:codigo,:descricao,marca)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":codigo",$modelo->nome);
            $comando->bindParam(":descricao",$modelo->preco);
            $comando->bindParam(":marca",$modelo->preco);
            $comando->execute();
            $produto->id = $pdo->lastInsertId();
            return $produto;
        }

        public function deletarModelo($id)
        {
            $qDeletar = "DELETE from modelo WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizarModelo(Modelo $modelo)
        {
            $qAtualizar = "UPDATE modelo SET codigo=:codigo, descricao=:descricao, marca=:marca WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":codigo",$modelo->codigo);
            $comando->bindParam(":descricao",$modelo->descricao);
            $comando->bindParam(":marca",$modelo->marca);
            $comando->bindParam(":id",$produto->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM modelo';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $modelos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $modelos[] = new Modelo($row->id,$row->codigo,$row->descricao,$row->marca);
            }
            return $modelos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM modelo WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Modelo($row->id,$row->codigo,$row->descricao,$row->marca);          
        }
    }
?>