<?php

include_once('Veiculo.php');
include_once('VeiculoDAO.php');
include_once('Modelo.php');
include_once('ModeloDAO.php');

class VeiculoController {

    public function listar($request, $response, $args){
        $dao = new VeiculoDAO;  
        $veiculos = $dao->listar();
        $response = $response->withJSON($veiculos);
        return $response;
    }

    public function inserir($request, $response, $args) {
        $dao = new VeiculoDAO;
        $dao2 = new ModeloDAO;
        $data = $request->getParsedBody();
        $chassi = $data['chassi'];
        $situacao = $data['situacao'];
        $preco = $data['preco'];
        $codigoModelo = $data['modelo'];
        $veiculo = new Veiculo(0, $chassi, $situacao, $preco, $codigoModelo);
        $veiculo = $dao->inserir($veiculo);
        $response->getBody()->write("Veiculo de ".$chassi." inserido com sucesso!");
        return $response
        ->withStatus(201);
    }

    public function buscarPorId($request, $response, $args) {
        $dao = new VeiculoDAO;  
        $modelo = $dao->buscarPorId($args['id']);
        $response = $response->withJSON($modelo);
        return $response;
    }
    
    public function atualizar($request, $response, $args) {
        $dao = new VeiculoDAO;
       $dao2 = new ModeloDAO;
      $data = $request->getParsedBody();
      $chassi = $data['chassi'];
      $situacao = $data['situacao'];
      $preco = $data['preco'];
      $codigoModelo = $data['modelo'];
      $veiculo = new Veiculo($args['id'], $chassi, $situacao, $preco, $codigoModelo);
      $dao->atualizar($veiculo);
      $response->getBody()->write("Alterando veiculo com id=".$args['id']);
      return $response;
    }
    
    public function deletar($request, $response, $args) {
        $dao = new VeiculoDAO;
        $dao->deletar($args['id']);	
        $response->getBody()->write("Removendo veiculo com id=".$args['id']);
        return $response;
    }
}
?>