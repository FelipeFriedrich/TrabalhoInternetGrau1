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


$app->get('/api/produtos', function (Request $request, Response $response, array $args) {
    $dao = new ProdutoDAO;  
    $produtos = $dao->listar();
    $response = $response->withJSON($produtos);
    return $response;
});
//Alterado para usar o ParsedBody
//Teste com Postman adicionando um produto no formato JSON
$app->post('/api/produtos', function (Request $request, Response $response, array $args) {
    //Adicione nome e preço no request (formato JSON)
    $dao = new ProdutoDAO;  
    $data = $request->getParsedBody();
    $nome = $data['nome'];
    $preco = $data['preco'];
    $produto = new Produto(0, $nome, $preco);
    $produto = $dao->inserir($produto);
    $response->getBody()->write("Produto ".$nome." inserido com o valor: ".$preco."");
    return $response;
});

$app->get('/api/produtos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new ProdutoDAO;  
    $produto = $dao->buscarPorId($args['id']);
    $response = $response->withJSON($produto);
    return $response;
});

$app->put('/api/produtos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new ProdutoDAO; 
    $data = $request->getParsedBody();
    $nome = $data['nome'];
    $preco = $data['preco'];
    $produto = new Produto($args['id'], $nome, $preco);
    $dao->atualizar($produto);
    $response->getBody()->write("Alterando produto com id=".$args['id']);
    return $response;
});

$app->delete('/api/produtos/{id}', function (Request $request, Response $response, array $args) {
    $dao = new ProdutoDAO;
    $dao->deletar($args['id']);	
    $response->getBody()->write("Removendo produto com id=".$args['id']);
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