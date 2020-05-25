<?php

namespace Mosyle\Infrastructure\Database;

use Mosyle\Infrastructure\Database\DatabaseService;

/**
 * Class DatabaseServiceFactory
 * @package Mosyle\Infrastructure\Database
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class DatabaseServiceFactory
{
    /** @var string $host */
    private $host;

    /** @var string $user */
    private $user;

    /** @var string $password */
    private $password;

    /** @var string $database */
    private $database;

    /**
     * @return DatabaseService
     */
    public function __invoke()
    {
        $this->host = '127.0.0.1';
        $this->user = 'root';
        $this->password = 'root';
        $this->database = 'teste_mosyle';
        $connection = mysqli_connect($this->host,$this->user,$this->password,$this->database); //new \PDO($this->dsn, $this->user, $this->password);

        return new DatabaseService($connection);
    }
}