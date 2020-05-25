<?php

namespace Mosyle\Infrastructure\Database;

/**
 * Interface DatabaseServiceInterface
 * @package Mosyle\Infrastructure\Database
 * @author Diego Ananias <diegohsananias@gmail.com>
 * @copyright Teste Mosyle 2020
 */
interface DatabaseServiceInterface
{
    /**
     * @param \mysqli_result $result
     * @return array
     */
    public function fetchAssoc(\mysqli_result $result): array;

    /**
     * @param string $query
     */
    public function query(string $query);
}