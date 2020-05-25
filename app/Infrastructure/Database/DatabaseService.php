<?php

namespace Mosyle\Infrastructure\Database;

use Mosyle\Infrastructure\Database\DatabaseServiceInterface;

/**
 * Class DatabaseService
 * @package Mosyle\Infrastructure\Database\Service
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
class DatabaseService implements DatabaseServiceInterface
{
    private $database;

    public function __construct(\mysqli $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function fetchAssoc(\mysqli_result $result): array
    {
        $resultado = $result->fetch_assoc();
        $data = [];
        while ($resultado) {
            $data[] = $resultado;
            $resultado = $result->fetch_assoc();
        }

        return (array) $data;
    }

    /**
     * @inheritDoc
     */
    public function query(string $query)
    {
        return $this->database->query($query);
    }
}