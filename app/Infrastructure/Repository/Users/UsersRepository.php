<?php

namespace Mosyle\Infrastructure\Repository\Users;

use Mosyle\Domain\Users\Entity\UserEntity;
use Mosyle\Domain\Users\Repository\UsersRepositoryInterface;
use Mosyle\Infrastructure\Database\DatabaseServiceInterface;
use Psr\Container\ContainerInterface;

/**
 * Class UsersRepository
 * @package Mosyle\Infrastructure\Repository\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UsersRepository implements UsersRepositoryInterface
{
    /** @var DatabaseServiceInterface $database */
    private $database;

    /** @var UserEntity $entidade */
    private $entidade;

    /**
     * UsersRepository constructor.
     * @param DatabaseServiceInterface $database
     */
    public function __construct(DatabaseServiceInterface $database, UserEntity $entity)
    {
        $this->database = $database;
        $this->entidade = $entity;
    }

    /**
     * @inheritDoc
     */
    public function obterCredenciais(array $credenciais): array
    {
        $query = "SELECT usuario, senha 
                FROM `usuarios` 
                WHERE 
                    `usuario` = '{$credenciais['usuario']}'";

        $result = $this->database->query($query);

        if ($result->num_rows === 0) {
            return [];
        }

       $array = $this->database->fetchAssoc($result);

       return $array;
    }


    /**
     * @inheritDoc
     */
    public function registrar(array $dados): UserEntity
    {
        $query = "
            INSERT INTO `usuarios` (`nome`, `usuario`, `senha`, `email`, `drink_counter`, `criado_em`)
            VALUES ('{$dados['nome']}', '{$dados['usuario']}', '{$dados['senha']}', '{$dados['email']}', 
            '0', '{$dados['criado_em']}')
        ";

        $result = $this->database->query($query);

        $entidade = clone $this->entidade;

        if (!$result) {
            return $entidade;
        }

        $entidade->setNome($dados['nome'])
            ->setEmail($dados['email'])
            ->setCriadoEm($dados['criado_em'])
            ->setUsuario($dados['usuario'])
            ->setDrinkCounter(0);


        return $entidade;
    }

    /**
     * @inheritDoc
     */
    public function obterUsuarioPorEmail(string $email): bool
    {
        $query = "SELECT `email` FROM `usuarios` WHERE `email` = '{$email}'";

        $result = $this->database->query($query);

        if ($result->num_rows === 0) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function obterTodos(): array
    {
        $query = "SELECT id, nome, usuario, email, drink_counter, criado_em FROM usuarios";

        $resultado = $this->database->query($query);

        if ($resultado->num_rows === 0) {
            return [];
        }

        $registro = $this->database->fetchAssoc($resultado);

        return $registro;
    }

    /**
     * @inheritDoc
     */
    public function obterPorId(int $id): array
    {
        $query = "SELECT id, nome, usuario, email, drink_counter FROM usuarios WHERE id = '{$id}'";

        $resultado = $this->database->query($query);

        if ($resultado->num_rows === 0) {
            return [];
        }

        $registro = $this->database->fetchAssoc($resultado);

        return $registro;
    }

    /**
     * @inheritDoc
     */
    public function atualizar(array $dados, int $id): array
    {
        $query = "UPDATE usuarios 
                SET email = '{$dados['email']}' AND
                    nome = '{$dados['nome']}'
                    senha = '{$dados['senha']}'
                    WHERE id = '{$id}'
                ";
        $resultado = $this->database->query($query);

        var_dump($resultado);
    }
}