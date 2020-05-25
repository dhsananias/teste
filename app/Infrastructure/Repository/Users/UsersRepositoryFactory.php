<?php

namespace Mosyle\Infrastructure\Repository\Users;

use Mosyle\Domain\Users\Entity\UserEntity;
use Mosyle\Infrastructure\Database\DatabaseServiceInterface;
use Psr\Container\ContainerInterface;

/**
 * Class UsersRepositoryFactory
 * @package Mosyle\Infrastructure\Repository\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UsersRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(DatabaseServiceInterface::class);
        $entidade = $container->get(UserEntity::class);
        return new UsersRepository($database, $entidade);
    }
}