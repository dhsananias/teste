<?php

namespace Mosyle\Domain\Users;

use Carbon\Carbon;
use Mosyle\Domain\Users\Entity\UserEntity;
use Mosyle\Domain\Users\Repository\UsersRepositoryInterface;
use Mosyle\Infrastructure\Auth\AuthServiceInterface;

/**
 * Class UsersService
 * @package Mosyle\Domain\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UsersService implements UsersServiceInterface
{
    /** @var AuthServiceInterface $authService */
    private $authService;

    /** @var UsersRepositoryInterface $repositorio */
    private $repositorio;

    /**
     * UsersService constructor.
     * @param AuthServiceInterface $authService
     * @param UsersRepositoryInterface $repositorio
     */
    public function __construct(AuthServiceInterface $authService, UsersRepositoryInterface $repositorio)
    {
        $this->authService = $authService;
        $this->repositorio = $repositorio;
    }

    /**
     * @inheritDoc
     */
    public function login(string $usuario, string $senha): string
    {
        $credenciais = ['usuario' => $usuario];

        $dadosObtidos = $this->repositorio->obterCredenciais($credenciais);

        if (!$dadosObtidos) {
            return false;
        }

        if (!password_verify($senha, $dadosObtidos[0]['senha'])) {
            return false;
        }

        $credenciais['senha'] = $senha;

        return $this->authService->gerarToken($credenciais);
    }

    /**
     * @inheritDoc
     */
    public function registrar(array $dados)
    {
        $dados['criado_em'] = Carbon::now()->format('Y-m-d H:i:s');

        if ($this->obterUsuarioPorEmail($dados['email'])) {
            return 'Já existe um usuario com esse email';
        }

        $options = [
            'cost' => 12,
        ];

        $dados['senha'] = password_hash($dados['senha'], PASSWORD_BCRYPT, $options);
        return $this->repositorio->registrar($dados);
    }

    /**
     * @param string $email
     * @return bool
     */
    public function obterUsuarioPorEmail(string $email): bool
    {
        return $this->repositorio->obterUsuarioPorEmail($email);
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

        if ($this->obterUsuarioPorEmail($dados['email'])) {
            $erro[] = 'Já existe um usuario com esse email';
        }

        if (count($erro) == 0) {
            return true;
        }

        return $erro;
    }

    /**
     * @inheritDoc
     */
    public function obter(): array
    {
        return $this->repositorio->obterTodos();
    }

    /**
     * @inheritDoc
     */
    public function obterPorId(int $id): array
    {
        return $this->repositorio->obterPorId($id);
    }

    /**
     * @param array $dados
     * @param int $id
     * @return array
     */
    public function atualizar(array $dados, int $id): array
    {
        return $this->repositorio->atualizar($dados, $id);
    }
}