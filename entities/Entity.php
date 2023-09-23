<?php

namespace entities;

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

        $pdo = \Container::getDatabase()->getPDO();

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
}