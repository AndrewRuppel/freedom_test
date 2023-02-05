<?php

namespace App;

class Connector
{
    private \PDO $connection;
    private string $dsn = 'mysql:dbname=testtask;host=testtask-mysql';
    private ?string $username = 'root';
    private ?string $password = 'root';
    private ?array $options = [];

    public function __construct()
    {
        $this->connection = new \PDO($this->dsn, $this->username, $this->password, $this->options);
        $this->connection->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}