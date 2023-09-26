<?php

namespace src\database;
use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $port;
    private string $database;
    private string $username;
    private string $password;
    private PDO $pdo;

    public function __construct($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    private function connect(): void
    {
        $dsn = "mysql:host={$this->host};port={$this->port}";

        $this->pdo = new PDO($dsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createDatabase($databaseName): static
    {
        try {
            $sql = "CREATE DATABASE IF NOT EXISTS {$databaseName}";
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
        }

        return $this;
    }

    public function use(string $databaseName): static
    {
        $this->pdo->exec("USE $databaseName");

        return $this;
    }

    public function exec($sql): false|int
    {
        return $this->pdo->exec($sql);
    }

    public function insert($tableName, $data): static
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";

            $values = array_values($data);

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);

        } catch (PDOException $e) {
        }

        return $this;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}