<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


include_once('Modelo.php');
include_once('ModeloDAO.php');
include_once('Usuario.php');
include_once('UsuarioDAO.php');
include_once('Veiculo.php');
include_once('VeiculoDAO.php');
include_once('Nota_Fiscal.php');
include_once('Nota_FiscalDAO.php');
require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();

///////////////////////////////////////MODELOS////////////////////////////////
//LISTA OS MODELOS//
$app->get('/api/modelos', function (Request $request, Response $response, array $args) {
    $dao = new ModeloDao;  
    $modelos = $dao->listar();
    $response = $response->withJSON($modelos);
    return $response;
});


//Alterado para usar o ParsedBody
//Teste com Postman adicionando um modelo no formato JSON
$app->post('/api/modelos', function (Request $request, Response $response, array $args) {
    $dao = new ModeloDao;  
    $data = $request->getParsedBody();
    $codigo = $data['codigo'];
    $descricao = $data['descricao'];
    $marca = $data['marca'];
    $modelo = new Modelo(0, $codigo, $descricao, $marca);
    $modelo = $dao->inserir($modelo);
    $response->getBody()->write("Modelo ".$descricao." inserido com sucesso!");
    return $response;
});

$app->get('/api/modelos/{codigo}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO;  
    $modelo = $dao->buscarPorId($args['codigo']);
    $response = $response->withJSON($modelo);
    return $response;
});

$app->put('/api/modelos/{codigo}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO; 
    $data = $request->getParsedBody();
    $nome = $data['nome'];
    $preco = $data['preco'];
    $modelo = new modelo($args['codigo'], $nome, $preco);
    $dao->atualizar($modelo);
    $response->getBody()->write("Alterando modelo com codigo=".$args['codigo']);
    return $response;
});

$app->delete('/api/modelos/{codigo}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO;
    $dao->deletar($args['codigo']);	
    $response->getBody()->write("Removendo modelo com codigo=".$args['codigo']);
    return $response;
});

///////////////////////////////////////VEICULOS////////////////////////////////
$app->get('/api/veiculos', function (Request $request, Response $response, array $args) {
    $dao = new VeiculoDAO;  
    $veiculos = $dao->listar();
    $response = $response->withJSON($veiculos);
    return $response;
});


//Alterado para usar o ParsedBody
//Teste com Postman adicionando um modelo no formato JSON
$app->post('/api/veiculos', function (Request $request, Response $response, array $args) {
    $dao = new VeiculoDAO;  
    $data = $request->getParsedBody();
    $chassi = $data['chassi'];
    $situacao = $data['situacao'];
    $preco = $data['preco'];
    $modelo = $data['modelo'];
    $veiculo = new Veiculo(0, $chassi, $situacao, $preco, $modelo);
    $veiculo = $dao->inserir($veiculo);
    $response->getBody()->write("Veiculo de ".$chassi." inserido com sucesso!");
    return $response;
});

$app->get('/api/veiculos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new VeiculoDAO;  
    $modelo = $dao->buscarPorId($args['id']);
    $response = $response->withJSON($modelo);
    return $response;
});

$app->put('/api/veiculos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new VeiculoDAO; 
    $data = $request->getParsedBody();
    $chassi = $data['chassi'];
    $situacao = $data['situacao'];
    $preco = $data['preco'];
    $modelo = $data['modelo'];
    $modelo = new Veiculo($args['id'], $chassi, $situacao, $preco, $modelo);
    $dao->atualizar($modelo);
    $response->getBody()->write("Alterando veiculo com id=".$args['id']);
    return $response;
});

$app->delete('/api/veiculos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new VeiculoDAO;
    $dao->deletar($args['id']);	
    $response->getBody()->write("Removendo veiculo com id=".$args['id']);
    return $response;
});












$app->post('/api/usuario', function (Request $request, Response $response, array $args) {
    $dao = new UsuarioDAO; 
    $data = $request->getParsedBody();
    $login = $data['login'];
    $senha = $data['senha'];
    $usuario = $dao->buscarPorLogin($login);
    if($usuario){
        if($usuario->senha == $senha){
            $response->getBody()->write("TRUE");
        }else{
            $response->getBody()->write("FALSE");
        }

    }else{
        $response->getBody()->write("login invalido");
    }

    
    return $response;
});

$app->run();


// Para pegar algum outro parametro
//$request.getQuerryparam()['nome']
//ou $request.getQuerryparams()['nome']

//////////////// INICIAR O PHP ///////////////
// ENTRAR NA PASTA DO LOCAL DO ARQUIVO e RODAR O COMANDO
// php -S localhost:8080  