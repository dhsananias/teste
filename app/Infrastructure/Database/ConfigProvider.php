<?php


namespace Mosyle\Infrastructure\Database;

use Mosyle\Infrastructure\Database\Service\DatabaseService;

/**
 * Class ConfigProvider
 * @package Mosyle\Infrastructure\Database
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
                DatabaseServiceInterface::class => DatabaseServiceFactory::class
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