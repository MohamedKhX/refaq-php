<?php

namespace database\migrations;

use database\Data;
use database\migrations\interface\MigrationInterface;
use mysql_xdevapi\Exception;

class Create_subjects_table extends Migration
{
    public function create(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            code VARCHAR(255),
            name VARCHAR(255),
            root VARCHAR(255),
            units INT,
            status BOOLEAN,
            allowed BOOLEAN,
            requiredUnits INT DEFAULT 0,
            PRIMARY KEY (code)
        )";

        $this->database->exec($sql);
    }

    public function insertData(): void
    {
        foreach (Data::getData() as $item) {
            $this->database->insert($this->table_name, $item);
        }
    }

    public function drop(): void
    {
        $sql = "DROP TABLE IF EXISTS $this->table_name";

        $this->database->exec($sql);
    }
}