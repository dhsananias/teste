<?php

namespace Mosyle\Domain\Users\Repository;

use Mosyle\Domain\Users\Entity\UserEntity;

/**
 * Interface UsersRepositoryInterface
 * @package Mosyle\Domain\Users\Repository
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
interface UsersRepositoryInterface
{
    /**
     * @param array $credenciais
     * @return array
     */
    public function obterCredenciais(array $credenciais);

    /**
     * @param array $dados
     * @return UserEntity
     */
    public function registrar(array $dados);

    /**
     * @param string $email
     * @return bool
     */
    public function obterUsuarioPorEmail(string $email): bool;

    /**
     * @return array
     */
    public function obterTodos(): array;

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