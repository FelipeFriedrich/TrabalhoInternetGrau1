<?php

include_once('Modelo.php');
include_once('ModeloDAO.php');

class ModeloController {

    public function listar($request, $response, $args){
        $dao = new ModeloDao;  
        $modelos = $dao->listar();
        $response = $response->withJSON($modelos);
        return $response;
    
    }

    public function inserir($request, $response, $args) {
        $dao = new ModeloDao;  
        $data = $request->getParsedBody();
        $codigo = $data['codigo'];
        $descricao = $data['descricao'];
        $marca = $data['marca'];
        $modelo = new Modelo($codigo, $descricao, $marca);
        $modelo = $dao->inserir($modelo);
        $response->getBody()->write("Modelo ".$descricao." inserido com sucesso!");
        return $response
        ->withStatus(201);
    }

    public function buscarPorId($request, $response, $args) {
        $dao = new modeloDAO;  
        $modelo = $dao->buscarPorId($args['codigo']);
        $response = $response->withJSON($modelo);
        return $response;
    }
    
    public function atualizar($request, $response, $args) {
        $dao = new modeloDAO; 
        $data = $request->getParsedBody();
        $descricao = $data['descricao'];
        $marca = $data['marca'];
        $modelo = new modelo($args['codigo'], $descricao, $marca);
        $dao->atualizar($modelo);
        $response->getBody()->write("Alterando modelo com codigo=".$args['codigo']);
        return $response;
    }
    
    public function deletar($request, $response, $args) {
        $dao = new modeloDAO;
        $dao->deletar($args['codigo']);	
        $response->getBody()->write("Removendo modelo com codigo=".$args['codigo']);
        return $response;
    }
}
?>