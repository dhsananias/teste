<?php

namespace Mosyle\Infrastructure\Auth;

/**
 * Class AuthServiceFactory
 * @package Mosyle\Infrastructure\Auth
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class AuthServiceFactory
{
    /**
     * @return AuthService
     */
    public function __invoke()
    {
        return new AuthService();
    }
}