<?php

namespace database\migrations;

use database\migrations\interface\MigrationInterface;

abstract class Migration implements MigrationInterface
{
    public \database\Database $database;
    public string $table_name = 'subjects';

    public function __construct($database)
    {
        $this->database = $database;

        $this->create();

        $this->insertData();
    }
}