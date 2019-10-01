<?php

include_once('Veiculo.php');
include_once('VeiculoDAO.php');
include_once('Nota_Fiscal.php');
include_once('Nota_FiscalDao.php');

class NotaFiscalController {

    public function listar($request, $response, $args){
        $dao = new notaFiscalDAO;  
        $notafiscal = $dao->listar();
        $response = $response->withJSON($notafiscal);
        return $response;
    }

    public function inserir($request, $response, $args) {
        $dao = new notaFiscalDAO;
        $dao2 = new VeiculoDAO;
        $data = $request->getParsedBody();
        $numeroNotaFiscal = $data['notaFiscal'];
        $datanota = $data['data'];
        $idVeiculo = $data['veiculo'];
        $veiculo = $dao2->buscarPorId($idVeiculo);
        $notaFiscal = new notaFiscal(0, $veiculo, $datanota, $numeroNotaFiscal);
        $notaFiscal = $dao->inserir($notaFiscal);
        $response->getBody()->write("Notafiscal de numero ".$numeroNotaFiscal ." inserido com sucesso!");
        return $response
        ->withStatus(201);
    }

    public function buscarPorId($request, $response, $args) {
        $dao = new notaFiscalDAO;  
        $modelo = $dao->buscarPorId($args['id']);
        $response = $response->withJSON($modelo);
        return $response;
    }
    
    public function atualizar($request, $response, $args) {
        $dao = new notaFiscalDAO;
        $dao2 = new VeiculoDAO;
        $data = $request->getParsedBody();
        $numeroNotaFiscal = $data['notaFiscal'];
        $datanota = $data['data'];
        $idVeiculo = $data['veiculo'];
        $veiculo = $dao2->buscarPorId($idVeiculo);
        $notaFiscal = new notaFiscal($args['id'], $veiculo, $datanota, $numeroNotaFiscal);
        $dao->atualizar($notaFiscal);
        $response->getBody()->write("Alterada a nota fiscal com id=".$args['id']);
        return $response;
    }
    
    public function deletar($request, $response, $args) {
        $dao = new notaFiscalDAO;
        $dao->deletar($args['id']);	
        $response->getBody()->write("Removendo nota fiscal com id=".$args['id']);
        return $response;
    }
}
?>