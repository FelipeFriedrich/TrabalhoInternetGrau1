<?php
    include_once 'usuario.php';
	include_once 'PDOFactory.php';

    class UsuarioDAO
    {
        public function buscarPorLogin($login)
        {
 		    $query = 'SELECT * FROM usuario WHERE login=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':login', $login);
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            if($result){
                return new Usuario($result->id,$result->nome,$result->login,$result->senha);           
        
            }
            return null;
		}
    }
?>