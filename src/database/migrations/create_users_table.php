<?php

namespace src\database\migrations;


class create_users_table extends Migration
{

    protected function setTableName(): string
    {
        return "users";
    }

    public function create(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            id INT,
            name VARCHAR(255),
            PRIMARY KEY (id)
        )";

        $this->database->exec($sql);
    }

    public function insertData()
    {
        // TODO: Implement insertData() method.
    }

    public function drop()
    {
        // TODO: Implement drop() method.
    }
}