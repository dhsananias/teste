<?php

namespace Mosyle\Infrastructure\Auth;

use Carbon\Carbon;

/**
 * Trait Token
 * @package Mosyle\Infrastructure\Auth
 */
trait Token
{
    /**
     * @param array $credenciais
     * @return string
     */
    public function gerarToken(array $credenciais): string
    {
        $usuario = $credenciais['usuario'];
        $senha = $credenciais['senha'];

        return base64_encode($usuario) .".". base64_encode($senha) . "." . base64_encode(Carbon::now());
    }
}