<?php

namespace src\database\migrations;

use src\database\migrations\interface\MigrationInterface;

abstract class Migration implements MigrationInterface
{
    public \src\database\Database $database;
    public string $table_name = 'subjects';

    public function __construct($database)
    {
        $this->database = $database;
        $this->table_name = $this->setTableName();

        $this->create();

        $this->insertData();
    }

    abstract protected function setTableName(): string;
}