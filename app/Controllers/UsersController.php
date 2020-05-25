<?php

namespace Mosyle\Controllers;

use Laminas\Diactoros\Response;
use League\Container\Container;
use Mosyle\Domain\Users\UsersServiceInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UsersController
 * @package Mosyle\Controllers
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UsersController
{
    /** @var UsersServiceInterface $service */
    private $service;

    /** @var Response $response */
    private $response;

    public function __construct()
    {
        global $serviceManager;

        $this->response = new Response;
        $this->service = $serviceManager->get(UsersServiceInterface::class);
    }

    /**
     * Controller.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request) : ResponseInterface
    {

        $dados = $request->getParsedBody();
        $token = $this->service->login($dados['usuario'], $dados['senha']);

        $response = clone $this->response;

        if (!$token) {

            $response->getBody()->write(json_encode([
                'status' => 404,
                'message' => 'Credenciais inválidas'
            ]));

            return $response;
        }

        $response->getBody()->write(json_encode([
            'status' => 200,
            'token' => $token
        ]));

        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function obter(ServerRequestInterface $request) : ResponseInterface
    {
        $response = clone $this->response;

        $dados = $this->service->obter();

        $response->getBody()->write(json_encode([
            'status' => 200,
            'dados' => $dados
        ]));

        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function obterPorId(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $response = clone $this->response;

        $dados = $this->service->obterPorId($args['id']);

        $response->getBody()->write(json_encode([
            'status' => 200,
            'dados' => $dados
        ]));

        return $response;
    }


    /**
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function registrar(ServerRequestInterface $request)
    {
        $dados = $request->getParsedBody();

        $response = clone $this->response;

        if (is_array($this->validar($dados))) {
            $response->getBody()->write(json_encode([
                'status' => 400,
                'mensagem' => $this->validar($dados),
            ]));

            return $response;
        }

        $resultado = $this->service->registrar($dados);

        if (is_string($resultado)) {

            $response->getBody()->write(json_encode([
                'status' => 400,
                'mensagem' => $resultado
            ]));

            return $response;
        }

        $response->getBody()->write(json_encode([
            'status' => 201,
            'mensagem' => 'Usuario criado com sucesso',
            'dados' => $resultado
        ]));

        return $response;
    }

    /**
     * @param array $dados
     * @return bool|array
     */
    private function validar(array $dados)
    {
        $erro = [];

        if (
            empty($dados['nome'])
            || strlen($dados['nome']) <= 3
        ) {
            $erro[] = 'Nome muito curto, precisa ser maior do que 3 caracteres';
        }

        if (
            empty($dados['usuario'])
            || strlen($dados['usuario']) <= 3
        ) {
            $erro[] = 'Usuario muito curto, precisa ser maior do que 3 caracteres';
        }

        if (
            empty($dados['senha'])
            || strlen($dados['senha']) <= 5
        ) {
            $erro[] = 'Senha muito curto, precisa ser maior do que 6 caracteres';
        }

        if (
            empty($dados['email'])
            || strlen($dados['email']) <= 5
        ) {
            $erro[] = 'Email muito curto';
        }


        if (
            empty($dados['confirmar'])
            || ($dados['senha'] !== $dados['confirmar'])
        ) {
            $erro[] = 'Erro ao tentar confirmar sua senha';
        }

        if (count($erro) == 0) {
            return true;
        }

        return $erro;
    }

    public function editar(ServerRequestInterface $request, $args) : ResponseInterface
    {
        $dados = $request->getParsedBody();

        $dadosNovos = [
            'email' => $dados['email'],
            'nome' => $dados['nome'],
            'senha' => password_hash($dados['senha'])
        ];

        $resultado = $this->service->atualizar($args['id'], $dadosNovos);

        $response = clone $this->response;

        $response->getBody()->write(json_encode([
            'status' => 200,
            'mensagem' => 'Atualizado com sucesso!'
        ]));

        return $response;
    }
}