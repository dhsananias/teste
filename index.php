<?php

require 'vendor/autoload.php';

use Mosyle\Controllers\UsersController;
use Mosyle\Domain\Users\UsersServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator([
    \Mosyle\Domain\Users\ConfigProvider::class,
    \Mosyle\Infrastructure\Database\ConfigProvider::class,
    \Mosyle\Infrastructure\Repository\ConfigProvider::class,
    \Mosyle\Infrastructure\Auth\ConfigProvider::class
]);

global $serviceManager;
$serviceManager = new \Laminas\ServiceManager\ServiceManager($aggregator->getMergedConfig());

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new \Laminas\Diactoros\ResponseFactory();

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router   = (new League\Route\Router)->setStrategy($strategy);

$router->map('GET', '/', function (ServerRequestInterface $request) : array {
    return ['message' => 'Teste Mosyle Diego Ananias'];
});



$router->post('/login', [new UsersController(), 'login']);
$router->post('/users', [new UsersController(), 'registrar']);

$router
    ->group('/users', function ($router) {
        $router->get('/', [new UsersController(), 'obter']);
        $router->get('/{id}', [new UsersController(), 'obterPorId']);
        $router->put('/{id}', [new UsersController(), 'editar']);
    })
    ->middleware(new \Mosyle\Middleware\AuthMiddleware());

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);