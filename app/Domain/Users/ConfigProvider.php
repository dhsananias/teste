<?php

namespace Mosyle\Domain\Users;

use Mosyle\Domain\Users\Entity\UserEntity;

/**
 * Class ConfigProvider
 * @package Mosyle\Domain\Users
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'services'           => [],
            'invokables'         => [
                UserEntity::class => UserEntity::class
            ],
            'factories'          => [
                UsersServiceInterface::class => UsersServiceFactory::class
            ],
            'abstract_factories' => [],
            'delegators'         => [],
            'aliases'            => [],
            'initializers'       => [],
            'lazy_services'      => [],
            'shared'             => [],
            'shared_by_default'  => true,
        ];
    }
}