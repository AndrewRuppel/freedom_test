<?php

namespace App;

class Database
{
    private Connector $connector;

    public function __construct()
    {
        $this->connector = new Connector();
    }

    public function fetchAll(string $sql, ?array $data = null, int $mode = \PDO::FETCH_ASSOC) {
        $statement = $this->fetch($sql, $data);

        return $statement->fetchAll($mode);
    }

    public function fetchOne(string $sql, ?array $data = null, int $mode = \PDO::FETCH_ASSOC)
    {
        $statement = $this->fetch($sql, $data);

        return $statement->fetch($mode);
    }

    private function fetch(string $sql, ?array $data = null): \PDOStatement {
        $connection = $this->connector->getConnection();

        $statement = $connection->prepare($sql);

        if (isset($data) && is_array($data)) {
            $data = array_values($data);
        }

        $statement->execute($data);

        return $statement;
    }
}