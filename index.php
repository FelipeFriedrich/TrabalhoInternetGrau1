<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


include_once('Modelo.php');
include_once('ModeloDAO.php');
include_once('Usuario.php');
include_once('UsuarioDAO.php');
require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();


$app->get('/api/modelos', function (Request $request, Response $response, array $args) {
    $dao = new ModeloDao;  
    $modelos = $dao->listar();
    $response = $response->withJSON($modelos);
    return $response;
});
//Alterado para usar o ParsedBody
//Teste com Postman adicionando um modelo no formato JSON
$app->post('/api/modelos', function (Request $request, Response $response, array $args) {
    //Adicione nome e preço no request (formato JSON)
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

$app->get('/api/modelos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO;  
    $modelo = $dao->buscarPorId($args['id']);
    $response = $response->withJSON($modelo);
    return $response;
});

$app->put('/api/modelos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO; 
    $data = $request->getParsedBody();
    $nome = $data['nome'];
    $preco = $data['preco'];
    $modelo = new modelo($args['id'], $nome, $preco);
    $dao->atualizar($modelo);
    $response->getBody()->write("Alterando modelo com id=".$args['id']);
    return $response;
});

$app->delete('/api/modelos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new modeloDAO;
    $dao->deletar($args['id']);	
    $response->getBody()->write("Removendo modelo com id=".$args['id']);
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