<?php

namespace Mosyle\Domain\Users;

use Mosyle\Domain\Users\Repository\UsersRepositoryInterface;
use Mosyle\Infrastructure\Auth\AuthServiceInterface;
use Psr\Container\ContainerInterface;

/**
 * Class UsersServiceFactory
 * @package Mosyle\Domain\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UsersServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return UsersService
     */
    public function __invoke(ContainerInterface $container)
    {
        $authService = $container->get(AuthServiceInterface::class);
        $repository = $container->get(UsersRepositoryInterface::class);

        return new UsersService($authService, $repository);
    }
}