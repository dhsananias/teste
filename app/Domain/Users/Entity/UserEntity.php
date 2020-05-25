<?php

namespace Mosyle\Domain\Users\Entity;

/**
 * Class UserEntity
 * @package Mosyle\Domain\Users\Entity
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class UserEntity
{
    /** @var string $nome */
    protected $nome;

    /** @var string $usuario */
    protected $usuario;

    /** @var string $email */
    protected $email;

    /** @var int $drink_counter */
    protected $drink_counter;

    /** @var string $criado_em */
    protected $criado_em;

    /** @var string $atualizado_em */
    protected $atualizado_em;

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return UserEntity
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     * @return UserEntity
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriadoEm()
    {
        return $this->criado_em;
    }

    /**
     * @param mixed $criado_em
     * @return UserEntity
     */
    public function setCriadoEm($criado_em)
    {
        $this->criado_em = $criado_em;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtualizadoEm()
    {
        return $this->atualizado_em;
    }

    /**
     * @param mixed $atualizado_em
     * @return UserEntity
     */
    public function setAtualizadoEm($atualizado_em)
    {
        $this->atualizado_em = $atualizado_em;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserEntity
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getDrinkCounter(): int
    {
        return $this->drink_counter;
    }

    /**
     * @param int $drink_counter
     * @return UserEntity
     */
    public function setDrinkCounter(int $drink_counter)
    {
        $this->drink_counter = $drink_counter;
        return $this;
    }
}