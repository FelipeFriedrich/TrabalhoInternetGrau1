<?php
    include_once 'modelo.php';
	include_once 'PDOFactory.php';

    class ModeloDAO
    {
        public function inserir(Modelo $modelo)
        {
            $qInserir = "INSERT INTO modelo(codigo,descricao,marca) VALUES (:codigo,:descricao,marca)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":codigo",$modelo->codigo);
            $comando->bindParam(":descricao",$modelo->descricao);
            $comando->bindParam(":marca",$modelo->marca);
            $comando->execute();
            $modelo->id = $pdo->lastInsertId();
            return $modelo;
        }

        public function deletar($codigo)
        {
            $qDeletar = "DELETE from modelo WHERE codigo=:codigo";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":codigo",$codigo);
            $comando->execute();
        }

        public function atualizar(Modelo $modelo)
        {
            $qAtualizar = "UPDATE modelo SET descricao=:descricao, marca=:marca WHERE codigo=:codigo";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":codigo",$modelo->codigo);
            $comando->bindParam(":descricao",$modelo->descricao);
            $comando->bindParam(":marca",$modelo->marca);
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
			    $modelos[] = new Modelo($row->codigo,$row->descricao,$row->marca);
            }
            return $modelos;
        }

        public function buscarPorId($codigo)
        {
 		    $query = 'SELECT * FROM modelo WHERE codigo=:codigo';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':codigo', $codigo);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Modelo($row->codigo,$row->descricao,$row->marca);          
        }
    }
?>