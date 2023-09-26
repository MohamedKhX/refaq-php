<?php

namespace src\entities;

use PDO;

abstract class Entity
{
    protected string $table_name;

    public function __construct()
    {
        $this->setTableName();
    }

    abstract protected function setTableName(): static;

    public static function all(): array
    {
        $instance = new static();
        $table_name = $instance->table_name;

        $query = "SELECT * FROM $table_name";

        $pdo = \src\app\Container::getDatabase()->getPDO();

        $statement = $pdo->query($query);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $objects = [];
        foreach ($rows as $row) {
            $object = new static();
            foreach ($row as $key => $value) {
                $object->$key = $value;
            }
            $objects[] = $object;
        }
        return $objects;
    }

    public static function create(array $data): null|static
    {
        $instance = new static();
        $table_name = $instance->table_name;

        // Prepare the column names and placeholders
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        // Prepare the query
        $query = "INSERT INTO $table_name ($columns) VALUES ($placeholders)";

        $pdo = \src\app\Container::getDatabase()->getPDO();

        // Prepare and execute the statement
        $statement = $pdo->prepare($query);
        $statement->execute($data);

        // Retrieve the ID of the newly inserted row
        $id = $pdo->lastInsertId();

        // Retrieve the created object by ID
        return static::find($id);
    }

    public static function delete($id): bool
    {
        $instance = new static();
        $table_name = $instance->table_name;

        // Prepare the query
        $query = "DELETE FROM $table_name WHERE id = :id";

        $pdo = \src\app\Container::getDatabase()->getPDO();

        // Prepare and execute the statement
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

    public static function update(array $data): void
    {
        $instance = new static();
        $table_name = $instance->table_name;

        // Build the SET clause for the UPDATE statement
        $set_values = '';
        foreach ($data as $column => $value) {
            $set_values .= "$column = :$column, ";
        }
        $set_values = rtrim($set_values, ', ');

        // Build the WHERE clause for the UPDATE statement
        $where_clause = "id = :id";

        $query = "UPDATE $table_name SET $set_values WHERE $where_clause";

        $pdo = \src\app\Container::getDatabase()->getPDO();
        $statement = $pdo->prepare($query);

        // Bind the values for each column
        foreach ($data as $column => $value) {
            $statement->bindValue(":$column", $value);
        }

        // Bind the ID value for the WHERE clause
        $statement->bindValue(":id", $data['id']);

        $statement->execute();
    }

    public static function find($id): null|static
    {
        $instance = new static();
        $table_name = $instance->table_name;

        $query = "SELECT * FROM $table_name WHERE id = :id";

        $pdo = \src\app\Container::getDatabase()->getPDO();

        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // Return null if no record found
        }

        $object = new static();
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    public static function findByKey($key, $value): null|static
    {
        $instance = new static();
        $table_name = $instance->table_name;

        $query = "SELECT * FROM $table_name WHERE $key = :$key";

        $pdo = \src\app\Container::getDatabase()->getPDO();
        $statement = $pdo->prepare($query);
        $statement->bindParam(":$key", $value);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // Return null if no record found
        }

        $object = new static();
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }
    //Sofian
    public static function findByKeys(array $keys): ?self
    {
        $instance = new static();
        $table_name = $instance->table_name;

        $conditions = [];
        $bindings = [];

        foreach ($keys as $key => $value) {
            $conditions[] = "$key = :$key";
            $bindings[":$key"] = $value;
        }

        $query = "SELECT * FROM $table_name WHERE " . implode(' AND ', $conditions);

        $pdo = \src\app\Container::getDatabase()->getPDO();
        $statement = $pdo->prepare($query);
        $statement->execute($bindings);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // Return null if no record found
        }

        $object = new static();
        foreach ($row as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    public static function getLastId(): int
    {
        $instance = new static();
        $table_name = $instance->table_name;

        $query = "SELECT MAX(id) AS last_id FROM $table_name";

        $pdo = \src\app\Container::getDatabase()->getPDO();
        $statement = $pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result || is_null($result['last_id'])) {
            return 0; // Return 0 if no record found or last_id is NULL
        }

        return (int)$result['last_id'];
    }
}