<?php

namespace Mosyle\Infrastructure\Auth;

/**
 * Class ConfigProvider
 * @package Mosyle\Infrastructure\Auth
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class ConfigProvider
{
    public function __invoke()
    {
        return [
            'services'           => [],
            'invokables'         => [],
            'factories'          => [
                AuthServiceInterface::class => AuthServiceFactory::class
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