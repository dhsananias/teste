<?php


namespace Mosyle\Domain\Users;

use Mosyle\Domain\Users\Entity\UserEntity;

/**
 * Interface UsersServiceInterface
 * @package Mosyle\Domain\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
interface UsersServiceInterface
{
    /**
     * @param string $usuario
     * @param string $password
     * @return string
     */
    public function login(string $usuario, string $password): string;

    /**
     * @param array $dados
     * @return UserEntity|bool
     */
    public function registrar(array $dados);

    /**
     * @return array
     */
    public function obter(): array;

    /**
     * @param int $id
     * @return array
     */
    public function obterPorId(int $id): array;

    /**
     * @param array $dados
     * @param int $id
     * @return array
     */
    public function atualizar(array $dados, int $id): array;
}