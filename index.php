<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();

include_once('UsuarioController.php');
include_once('ModeloController.php');
include_once('VeiculoController.php');
include_once('Nota_FiscalController.php');

$app->post('/api/usuarios','UsuarioController:inserir');

$app->group('/api/modelos', function($app){
    $app->get('', 'ModeloController:listar');
    $app->post('', 'ModeloController:inserir');

    $app->get('/{codigo}', 'ModeloController:buscarPorId');    
    $app->put('/{codigo}', 'ModeloController:atualizar');
    $app->delete('/{codigo}', 'ModeloController:deletar');
});/*->add('UsuarioController:validarToken');*/


$app->group('/api/veiculos', function($app){
    $app->get('', 'VeiculoController:listar');
    $app->post('', 'VeiculoController:inserir');

    $app->get('/{id}', 'VeiculoController:buscarPorId');    
    $app->put('/{id}', 'VeiculoController:atualizar');
    $app->delete('/{id}', 'VeiculoController:deletar');
});/*->add('UsuarioController:validarToken');*/


$app->group('/api/notasFiscais', function($app){
    $app->get('', 'NotaFiscalController:listar');
    $app->post('', 'NotaFiscalController:inserir');

    $app->get('/{id}', 'NotaFiscalController:buscarPorId');    
    $app->put('/{id}', 'NotaFiscalController:atualizar');
    $app->delete('/{id}', 'NotaFiscalController:deletar');
})->add('UsuarioController:validarToken');



$app->post('/api/auth','UsuarioController:autenticar');

$app->run();


// Para pegar algum outro parametro
//$request.getQuerryparam()['nome']
//ou $request.getQuerryparams()['nome']

//////////////// INICIAR O PHP ///////////////
// ENTRAR NA PASTA DO LOCAL DO ARQUIVO e RODAR O COMANDO
// php -S localhost:8080  